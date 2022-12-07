<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/garland.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 */
?>
<div class="skip"><a href="#navigation">Skip to Navigation</a></div>
<div class="skip"><a href="#content">Skip to Content</a></div>

<header id="header" role="banner">
  <div class="banner">
    <div class="inner clearfix">
      <div class="social hidden-phone">
        <a class="facebook" title="Facebook" href="//www.facebook.com/BCWSA" target="_blank"><span class="fa-stack fa-lg">
          <i class="fa fa-circle fa-stack-2x"></i>
          <i class="fa fa-facebook fa-stack-1x"></i>
        </span></a>
        <a class="twitter" title="Tweet" href="//twitter.com/BCWSA" target="_blank"><span class="fa-stack fa-lg">
          <i class="fa fa-circle fa-stack-2x"></i>
          <i class="fa fa-twitter fa-stack-1x"></i>
        </span></a>
        <a class="youtube" href="//www.youtube.com/user/BCWheelchairSports" title="YouTube" target="_blank"><span class="fa-stack fa-lg">
          <i class="fa fa-circle fa-stack-2x"></i>
          <i class="fa fa-youtube-play fa-stack-1x"></i>
        </span></a>
        <div id="donate-desktop"><a href="/donate" class="donate">Donate</a></div>
      </div>
      <hgroup id="site-name">
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo" >
          <object type="image/svg+xml" data="/sites/all/themes/bcwsa/img/logo.svg" class="logo">
        BC Wheelchair Sports Association
          </object>
        </a>
      </hgroup>
    </div>
    <?php if ($page['search']): ?>
    <div id="search"><?php print render($page['search']); ?></div>
    <?php endif; ?>
  </div>
</header> <!-- /#header -->

<?php if ($page['navigation']): ?>
<nav id="navigation" role="navigation">
  <div class="inner">
  <?php print render($page['navigation']); ?>
  </div>
</nav><!-- /#navigation -->
<?php endif; ?>

<div id="main">
  <div class="inner clearfix">
    <div id="center">
      <div id="inner">
        <div id="content" class="column" role="main">
          <?php if ($page['highlighted']): ?>
          <div id="highlighted"><?php print render($page['highlighted']); ?></div>
          <?php endif; ?>
          <?php if ($breadcrumb): ?>
          <div id="breadcrumb"><?php print $breadcrumb; ?></div>
          <?php endif; ?>
          <?php print $messages; ?>
          <?php print render($title_prefix); ?>
          <?php if ($title): ?>
          <h1 class="title" id="page-title"><?php print $title; ?></h1>
          <?php endif; ?>
          <?php print render($title_suffix); ?>
          <?php if ($tabs): ?>
          <div class="tabs"><?php print render($tabs); ?></div>
          <?php endif; ?>
          <?php print render($page['help']); ?>
          <?php if ($action_links): ?>
          <ul class="action-links"><?php print render($action_links); ?></ul>
          <?php endif; ?>
          <?php print render($page['content']); ?>
          <?php print $feed_icons; ?>
        </div> <!-- /#content -->
      </div> <!-- /#inner -->
    </div> <!-- /#center -->

    <?php if ($page['sidebar_first']): ?>
    <aside id="sidebar-first" class="column sidebar" role="complementary">
      <?php print render($page['sidebar_first']); ?>
    </aside> <!-- /#sidebar-first -->
    <?php endif; ?>

    <?php if ($page['sidebar_second']): ?>
    <aside id="sidebar-second" class="column sidebar" role="complementary">
      <?php print render($page['sidebar_second']); ?>
    </aside> <!-- /#sidebar-second -->
    <?php endif; ?>

    </div> <!-- /.inner -->
    <?php if ($page['content_below']): ?>
    <aside id="content-below" class="column" role="complementary">
      <?php print render($page['content_below']); ?>
    </aside> <!-- /#content_below -->
    <?php endif; ?>
    <?php if ($page['content_bottom']): ?>
    <aside id="content-bottom" class="column" role="complementary">
      <?php print render($page['content_bottom']); ?>
    </aside> <!-- /#content_bottom -->
    <?php endif; ?>
    <?php if ($page['content_tertiary']): ?>
    <aside id="content-tertiary" class="column" role="complementary"><div class="inner">
      <?php print render($page['content_tertiary']); ?></div>
    </aside> <!-- /#content_bottom -->
    <?php endif; ?>
    <?php if ($page['content_quaternary']): ?>
    <aside id="content-quaternary" class="column" role="complementary">
      <?php print render($page['content_quaternary']); ?>
    </aside> <!-- /#content_bottom -->
    <?php endif; ?>
</div> <!-- /#main -->

<footer id="footer" role="contentinfo">
  <section>
    <div id="footer-inner">
      <div class="region footer-region-one">
        <h2>Want to help?</h2>
        <p>Make a donation to BC Wheelchair Sports today.</p>
        <p class="text-right"><a href="/donate" class="button">donate</a></p>
      </div>
      <div class="region footer-region-two">
        <h2>Have you heard?</h2>
        <p>Sign up for our newsletter to stay on top of all of the latest.</p>
        <p class="text-right"><a href="/about-bcwsa/sign-our-newsletter" class="button">sign up now</a></p>
      </div>
      <div class="region footer-region-three">
        <h2>Join today.</h2>
        <p>Renew or sign up for your membership.</p>
        <p class="text-right"><a href="/about-bcwsa/become-member" class="button">sign up</a></p>
      </div>
      <div class="region footer-region-four clearfix">
        <div class="address">
          <h1>BC Wheelchair Sports Association</h1>
          <p>780 SW Marine Drive, Vancouver, BC V6P 5Y7 || Phone: 604.333.3520 | Toll Free: 1.877.737.3090 | <a href="mailto:info@bcwheelchairsports.com">email us</a></p>
        </div>
        <?php if ($page['footer_search']): ?>
          <?php print render($page['footer_search']); ?>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <section>
    <div id="footer-lower">
      <div>
        <div class="social">
          <a class="facebook" title="Facebook" href="//www.facebook.com/BCWSA" target="_blank"><span class="fa-stack fa-lg">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-facebook fa-stack-1x"></i>
          </span></a>
          <a class="twitter" title="Tweet" href="//twitter.com/BCWSA" target="_blank"><span class="fa-stack fa-lg">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-twitter fa-stack-1x"></i>
          </span></a>
          <a class="youtube" href="//www.youtube.com/user/BCWheelchairSports" title="YouTube" target="_blank"><span class="fa-stack fa-lg">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-youtube-play fa-stack-1x"></i>
          </span></a>
          <a class="youtube" href="//www.pinterest.com/bcwsa/" title="Pinterest" target="_blank"><span class="fa-stack fa-lg">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-pinterest fa-stack-1x"></i>
          </span></a>
        </div>
        <p class="copyright">&copy; <?php echo date('Y'); ?>, BC Wheelchair Sports Association | Photography &copy; <a href="http://bogettismith.zenfolio.com" title="Bogetti-Smith Photography.">Bogetti-Smith Photography</a> | Website by <a href="http://www.sodadesign.com" title="soda made this.">soda</a></p>
      </div>
    </div>
  </section>
</footer> <!-- /#footer -->