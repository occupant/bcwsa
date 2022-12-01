<?php

/**
 * @file
 * Default theme implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE tag.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes String of classes that can be used to style contextually through
 *   CSS.
 *
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see template_process()
 */
?><!DOCTYPE html>
<!--[if IEMobile 7]><html class="no-js iem7 oldie" dir="<?php print $language->dir; ?>"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html class="no-js ie7 oldie" dir="<?php print $language->dir; ?>"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html class="no-js ie8 oldie" dir="<?php print $language->dir; ?>"><![endif]-->
<!--[if (IE 9)&!(IEMobile)]><html class="no-js ie9" lang="dir="<?php print $language->dir; ?>"><![endif]-->
<!--[[if (gt IE 9)|(gt IEMobile 7)]><!--><html class="no-js" dir="<?php print $language->dir; ?>"><!--<![endif]-->
<head>

  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <meta name="viewport" content="width=device-width">
  <?php print $styles; ?>
  <link rel="stylesheet" href="//yui.yahooapis.com/pure/0.4.2/forms-min.css">
  <script src="//use.edgefonts.net/chunk;league-gothic.js"></script>
  <meta http-equiv="cleartype" content="on">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="google-site-verification" content="amypyJvQ7jgKej7R8NkEo_pPYizPlVbqJwf-_vGrsUE" />
  <script src="<?php print base_path() . path_to_theme();?>/js/libs/modernizr.custom.89894.js"></script>
</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>

  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $scripts; ?>
  <?php print $page_bottom; ?>
</body>
</html>