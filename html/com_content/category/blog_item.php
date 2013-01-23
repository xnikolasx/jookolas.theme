<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

// Create a shortcut for params.
$params = &$this->item->params;
$images = json_decode($this->item->images);
$canEdit    = $this->item->params->get('access-edit');
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.framework');

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
                $url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catid)).'">'.$title.'</a>';
                echo JText::sprintf('COM_CONTENT_CATEGORY', $url);
            ?>
        </li>
    </ul>
</section>
<article class="grid_14 omega">

<?php if ($params->get('show_title')) : ?>
    <h2>
        <?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
            <a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid)); ?>">
            <?php echo $this->escape($this->item->title); ?></a>
        <?php else : ?>
            <?php echo $this->escape($this->item->title); ?>
        <?php endif; ?>
    </h2>
<?php endif; ?>

<?php if (!$params->get('show_intro')) : ?>
    <?php echo $this->item->event->afterDisplayTitle; ?>
<?php endif; ?>

<?php echo $this->item->event->beforeDisplayContent; ?>

<?php // to do not that elegant would be nice to group the params ?>

<?php  if (isset($images->image_intro) and !empty($images->image_intro)) : ?>
    <?php $imgfloat = (empty($images->float_intro)) ? $params->get('float_intro') : $images->float_intro; ?>
    <div class="img-intro-<?php echo htmlspecialchars($imgfloat); ?>">
    <img
        <?php if ($images->image_intro_caption):
            echo 'class="caption"'.' title="' .htmlspecialchars($images->image_intro_caption) .'"';
        endif; ?>
        src="<?php echo htmlspecialchars($images->image_intro); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>"/>
    </div>
<?php endif; ?>
<?php echo $this->item->introtext; ?>

<?php if ($params->get('show_readmore') && $this->item->readmore) :
    if ($params->get('access-view')) :
        $link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
    else :
        $menu = JFactory::getApplication()->getMenu();
        $active = $menu->getActive();
        $itemId = $active->id;
        $link1 = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId);
        $returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
        $link = new JURI($link1);
        $link->setVar('return', base64_encode($returnURL));
    endif;
?>
        <p class="read-more">
                <a href="<?php echo $link; ?>">
                    <?php if (!$params->get('access-view')) :
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
</article>
<?php echo $this->item->event->afterDisplayContent; ?>
