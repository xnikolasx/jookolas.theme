<?php
/**
 * @package   Joomla.Site
 * @subpackage  Templates.jookolas
 * @copyright Copyright (C) 2013 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
define(TPL_BASE_URL, $this->baseurl . '/templates/' . $this->template);
?>
<!DOCTYPE html>
<html>
<head>
  <jdoc:include type="head" />
  <link rel="stylesheet" href="<?php echo TPL_BASE_URL; ?>/css/960.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo TPL_BASE_URL; ?>/css/layout.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo TPL_BASE_URL; ?>/css/style.css" type="text/css" />
</head>
<body>

<div id="page-wrapper" class="container_24">

  <header class="grid_24">
    <div id="logo" class="grid_6 alpha">
      <span class="double-dot-logo">:</span>
      <h1>jookolas.ru</h1>
    </div>
    <nav class="grid_12 prefix_6 omega">
      <h4 class="outline-only">:navigation</h4>
      <jdoc:include type="modules" name="top" style="xhtml" />
    </nav>
  </header>
  <div class="clear"></div>

  <div id="content-wrapper" class="grid_24 alpha omega">
    <section class="grid_18 alpha">
      <jdoc:include type="message" />
      <jdoc:include type="component" />
    </section>
    <section class="grid_6 omega" id="sidebar">
      <jdoc:include type="modules" name="right" style="xhtml" />
    </section>
  </div>
  <div class="clear"></div><!-- /#content-wrapper -->

  <div id="footer-push"></div>

</div><!-- /#page-wrapper -->

<footer class="container_24">

  <div class="grid_8">
    <p>
      Чтобы достичь простоты необходимо прорыть туннель в недрах сложности.
    </p>
  </div>

  <div class="grid_8">
    <p>
      copyrights &copy; 2013 jookolas.ru<br />
      Простота - крайняя степень изощренности.
    </p>
  </div>

  <div class="grid_8">
    <p>
      Чтобы быть по-настоящему простым нужно добраться до самой глубины.
    </p>
  </div>

  <div class="clear"></div>

</footer>

</body>
</html>
