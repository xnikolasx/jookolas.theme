<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

// Create shortcuts to some parameters.
$params     = $this->item->params;
$images = json_decode($this->item->images);
$urls = json_decode($this->item->urls);
$canEdit    = $this->item->params->get('access-edit');
$user       = JFactory::getUser();

?>
<section class="article-info grid_4 alpha">
    <h4 class="outline-only">:article-info</h4>
    <ul>
        
        <li>
            <?php
                echo JText::sprintf(
                    JHtml::_(
                        'date',
                        $this->item->publish_up,
                        JText::_('DATE_FORMAT_LC2')
                    )
                ); 
            ?>
        </li>
        <li>
            <?php
                $title = $this->escape($this->item->category_title);
                $url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)).'">'.$title.'</a>';
                echo JText::sprintf('COM_CONTENT_CATEGORY', $url);
            ?>
        </li>
    </ul>
</section>
<article class="item-page<?php echo $this->pageclass_sfx?> grid_14 omega">
    <h2><?php echo $this->escape($this->item->title); ?></h2>

<?php
if (!empty($this->item->pagination) AND $this->item->pagination && !$this->item->paginationposition && $this->item->paginationrelative)
{
 echo $this->item->pagination;
}
 ?>

<?php if ($canEdit ||  $params->get('show_print_icon') || $params->get('show_email_icon')) : ?>
    <ul class="actions">
    <?php if (!$this->print) : ?>
        <?php if ($params->get('show_print_icon')) : ?>
            <li class="print-icon">
            <?php echo JHtml::_('icon.print_popup',  $this->item, $params); ?>
            </li>
        <?php endif; ?>

        <?php if ($params->get('show_email_icon')) : ?>
            <li class="email-icon">
            <?php echo JHtml::_('icon.email',  $this->item, $params); ?>
            </li>
        <?php endif; ?>

        <?php if ($canEdit) : ?>
            <li class="edit-icon">
            <?php echo JHtml::_('icon.edit', $this->item, $params); ?>
            </li>
        <?php endif; ?>

    <?php else : ?>
        <li>
        <?php echo JHtml::_('icon.print_screen',  $this->item, $params); ?>
        </li>
    <?php endif; ?>

    </ul>
<?php endif; ?>

<?php  if (!$params->get('show_intro')) :
    echo $this->item->event->afterDisplayTitle;
endif; ?>

<?php echo $this->item->event->beforeDisplayContent; ?>


<?php if (isset ($this->item->toc)) : ?>
    <?php echo $this->item->toc; ?>
<?php endif; ?>

<?php if (isset($urls) AND ((!empty($urls->urls_position) AND ($urls->urls_position=='0')) OR  ($params->get('urls_position')=='0' AND empty($urls->urls_position) ))
        OR (empty($urls->urls_position) AND (!$params->get('urls_position')))): ?>
<?php echo $this->loadTemplate('links'); ?>
<?php endif; ?>

<?php if ($params->get('access-view')):?>
<?php  if (isset($images->image_fulltext) and !empty($images->image_fulltext)) : ?>
<?php $imgfloat = (empty($images->float_fulltext)) ? $params->get('float_fulltext') : $images->float_fulltext; ?>
<div class="img-fulltext-<?php echo htmlspecialchars($imgfloat); ?>">
<img
    <?php if ($images->image_fulltext_caption):
        echo 'class="caption"'.' title="' .htmlspecialchars($images->image_fulltext_caption) .'"';
    endif; ?>
    src="<?php echo htmlspecialchars($images->image_fulltext); ?>" alt="<?php echo htmlspecialchars($images->image_fulltext_alt); ?>"/>
</div>
<?php endif; ?>
<?php
if (!empty($this->item->pagination) AND $this->item->pagination AND !$this->item->paginationposition AND !$this->item->paginationrelative):
    echo $this->item->pagination;
 endif;
?>
<?php echo $this->item->text; ?>

<?php
if (!empty($this->item->pagination) AND $this->item->pagination AND $this->item->paginationposition AND!$this->item->paginationrelative):
     echo $this->item->pagination;?>
<?php endif; ?>

<?php if (isset($urls) AND ((!empty($urls->urls_position)  AND ($urls->urls_position=='1')) OR ( $params->get('urls_position')=='1') )): ?>
<?php echo $this->loadTemplate('links'); ?>
<?php endif; ?>
    <?php //optional teaser intro text for guests ?>
<?php elseif ($params->get('show_noauth') == true and  $user->get('guest') ) : ?>
    <?php echo $this->item->introtext; ?>
    <?php //Optional link to let them register to see the whole article. ?>
    <?php if ($params->get('show_readmore') && $this->item->fulltext != null) :
        $link1 = JRoute::_('index.php?option=com_users&view=login');
        $link = new JURI($link1);?>
        <p class="readmore">
        <a href="<?php echo $link; ?>">
        <?php $attribs = json_decode($this->item->attribs);  ?>
        <?php
        if ($attribs->alternative_readmore == null) :
            echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
        elseif ($readmore = $this->item->alternative_readmore) :
            echo $readmore;
            if ($params->get('show_readmore_title', 0) != 0) :
                echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
            endif;
        elseif ($params->get('show_readmore_title', 0) == 0) :
            echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
        else :
            echo JText::_('COM_CONTENT_READ_MORE');
            echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
        endif; ?></a>
        </p>
    <?php endif; ?>
<?php endif; ?>
<?php
if (!empty($this->item->pagination) AND $this->item->pagination AND $this->item->paginationposition AND $this->item->paginationrelative):
     echo $this->item->pagination;?>
<?php endif; ?>

<?php echo $this->item->event->afterDisplayContent; ?>
</article>
