<?php

// Changes the default meta content-type tag to the shorter HTML5 version
function bcwsa_html_head_alter(&$head_elements) {
  $head_elements['system_meta_content_type']['#attributes'] = array(
    'charset' => 'utf-8'
  );
}

/** SANITIZE STRING FOR INJECTION 
---------------------------------------------------------- */
function bcwsa_id_safe($string) {
  // Replace with dashes anything that isn't A-Z, numbers, dashes, or underscores.
  $string = strtolower(preg_replace('/[^a-zA-Z0-9_-]+/', '-', $string));
  // If the first character is not a-z, add 'n' in front.
  if (!ctype_lower($string{0})) { // Don't use ctype_alpha since its locale aware.
    $string = 'id'. $string;
  }
  return $string;
}

function bcwsa_preprocess_html(&$vars, $hook) {
  // Classes for body element. Allows advanced theming based on context
  // (home page, node of certain type, etc.)
  if (!$vars['is_front']) {
    // Add unique class for each page.
    $path = drupal_get_path_alias($_GET['q']);
    // Add unique class for each website section.
    list($section, ) = explode('/', $path, 2);
    if (arg(0) == 'node') {
      if (arg(1) == 'add') {
        $section = 'node-add';
      }
      elseif (is_numeric(arg(1)) && (arg(2) == 'edit' || arg(2) == 'delete')) {
        $section = 'node-' . arg(2);
      }
    }
    // add a body class that reflects content placement
    $vars['classes_array'][] = drupal_html_class('section-' . bcwsa_id_safe($section));
    $vars['classes_array'][] = drupal_html_class('path-' . bcwsa_id_safe($path));
  }
  
  // Add js libs and scripts
  $options = array(
    'group' => JS_THEME,
  );
  drupal_add_js(drupal_get_path('theme', 'bcwsa'). '/js/scripts-min.js', $options);
  
  // add conditional stylesheet for old IE browsers that don't support media queries
  drupal_add_css(drupal_get_path('theme', 'bcwsa') . '/css/ie.css',
    array(
      'group' => CSS_THEME,
      'browsers' => array(
        'IE' => '(lt IE 9) &! (IEMobile)',
        '!IE' => FALSE,
      ),
      'weight' => 999,
      'media' => 'screen', 
      'every_page' => TRUE,
    )
  );
  drupal_add_css('//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css',
    array('type' => 'external'));

  global $language;
  $vars['classes_array'][] = 'lang-' . $language->language;
}

// Remove Default Drupal CSS Files
function bcwsa_css_alter(&$css) { 
  $exclude = array(
    // Exclude contributed Module CSS
    'sites/all/modules/views/css/views.css' => FALSE,
    'sites/all/modules/calendar/css/calendar_multiday.css' => FALSE,
    'sites/all/modules/date/date_api/date.css' => FALSE,
    'sites/all/modules/date/date_popup/themes/datepicker.1.7.css' => FALSE,
    'sites/all/modules/date/date_repeat_field/date_repeat_field.css' => FALSE,
    'modules/block/block.css' => FALSE,
    'modules/book/book.css' => FALSE,
    'modules/comment/comment.css' => FALSE,
    'modules/dblog/dblog.css' => FALSE,
    'modules/file/file.css' => FALSE,
    'modules/field/theme/field.css' => FALSE,
    'modules/forum/forum.css' => FALSE,
    'modules/help/help.css' => FALSE,
    'modules/menu/menu.css' => FALSE,
    'modules/node/node.css' => FALSE,
    'modules/openid/openid.css' => FALSE,
    'modules/poll/poll.css' => FALSE,
    'modules/profile/profile.css' => FALSE,
    'modules/syslog/syslog.css' => FALSE,
    'modules/system/admin.css' => FALSE,
    'modules/system/maintenance.css' => FALSE,
    'modules/system/system.css' => FALSE,
    'modules/system/system.admin.css' => FALSE,
    'modules/system/system.base.css' => FALSE,
    'modules/system/system.maintenance.css' => FALSE,
    'modules/system/system.menus.css' => FALSE,
    'modules/system/system.messages.css' => FALSE,
    'modules/system/system.theme.css' => FALSE,
    'modules/taxonomy/taxonomy.css' => FALSE,
    'modules/tracker/tracker.css' => FALSE,
    'modules/update/update.css' => FALSE,
    'modules/user/user.css' => FALSE,
    );
  $css = array_diff_key($css, $exclude);
}

function bcwsa_preprocess_page(&$variables) {
  if (isset($variables['node'])) {  
    $variables['theme_hook_suggestions'][] = 'page__type__'. $variables['node']->type;
  }
}

function bcwsa_preprocess_node(&$variables) {
  // Add 'Node Unpublished' to unpublished nodes. 
  if (!$variables['status']) {
    $variables['classes_array'][] = 'node-unpublished';
    $variables['unpublished'] = TRUE;
  }
  else {
    $variables['unpublished'] = FALSE;
  }
  // Grab the node object.
  $node = $variables['node'];
  // Make individual variables for the parts of the date.
  $variables['date_day'] = format_date($node->created, 'custom', 'j');
  $variables['date_month'] = format_date($node->created, 'custom', 'M');
  $variables['date_year'] = format_date($node->created, 'custom', 'Y');
}

// Add some custom text to the search block form
function bcwsa_form_alter(&$form, &$form_state, $form_id) {
  if ($form_id == 'search_block_form') {
    $form['search_block_form']['#title'] = t('Search'); // Change the text on the label element
    $form['search_block_form']['#attributes']['title'] = t('enter your search terms...');
    $form['search_block_form']['#attributes']['placeholder'] = t('enter search terms');
    $form['search_block_form']['#theme_wrappers'] = null;
    $form['search_block_form']['#size'] = 30;  // define size of the textfield
    $form['actions']['#theme_wrappers'] = null;
    $form['actions']['submit']['#value'] = t('go'); // Change the text on the submit button
    $form['actions']['submit']['#attributes'] = array('class' => array('button'));

  }
  // alter views exposed forms
  if ($form_id == 'views_exposed_form') {
    $view = $form_state['view'];
    // define our view and view displays
    if ($view->name == 'article_views' && $view->current_display == ("views-exposed-form-article-views-page-1" || "views-exposed-form-article-views-page")) {
      $form['submit']['#attributes'] = array('class' => array('button', 'btn')); 
      $form['reset']['#attributes'] = array('class' => array('button', 'btn')); 
      $form['field_related_sport_tid']['#theme_wrappers'] = null;
      $form['field_related_sport_tid']['#suffix'] =  ' &nbsp;&nbsp;<strong> | </strong>&nbsp;&nbsp; ';
      $form['field_event_tid']['#theme_wrappers'] = null;
    }
    if ($view->name == 'sports_views') {
      $form['submit']['#attributes'] = array('class' => array('button', 'btn')); 
      $form['reset']['#attributes'] = array('class' => array('button', 'btn')); 
      $form['field_event_tid']['#theme_wrappers'] = null;
    }
  }
}

//Return a themed breadcrumb trail.
function bcwsa_breadcrumb($vars) {
  $breadcrumb = $vars['breadcrumb'];
  // Determine if we are to display the breadcrumb.
  $show_breadcrumb = theme_get_setting('breadcrumb_display');
  if ($show_breadcrumb == 'yes') {

    // Optionally get rid of the homepage link.
    $show_breadcrumb_home = theme_get_setting('breadcrumb_home');
    if (!$show_breadcrumb_home) {
      array_shift($breadcrumb);
    }

    // Return the breadcrumb with separators.
    if (!empty($breadcrumb)) {
      $separator = filter_xss(theme_get_setting('breadcrumb_separator'));
      $trailing_separator = $title = '';

      // Add the title and trailing separator
      if (theme_get_setting('breadcrumb_title')) {
        if ($title = drupal_get_title()) {
          $trailing_separator = $separator;
        }
      }
      // Just add the trailing separator
      elseif (theme_get_setting('breadcrumb_trailing')) {
        $trailing_separator = $separator;
      }

      // Assemble the breadcrumb
      return implode($separator, $breadcrumb) . $trailing_separator . $title;
    }
  }
  // Otherwise, return an empty string.
  return '';
}

// get rid of the 'menu' class in the main menu
function bcwsa_menu_tree__main_menu($variables){
  return '<ul>' . $variables['tree'] . '</ul>'; 
}

// remove some stuff, add some stuff
function bcwsa_menu_link(array $variables) {
  
  $remove = array('leaf');
  if($remove){
    $variables['element']['#attributes']['class'] = array_diff($variables['element']['#attributes']['class'],$remove);
  }
  
  $element = $variables['element'];
  $sub_menu = '';

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  // Adding a class depending on the TITLE of the link using our safe string
  $element['#attributes']['class'][] = bcwsa_id_safe($element['#title']);
  // Adding an ID depending on the ID of the link
  $element['#attributes']['id'][] = 'mid-' . $element['#original_link']['mlid'];
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

// ZEN TABS (also see custom styles in stylesheet and 'tabs' images folder)
// Customize the PRIMARY and SECONDARY LINKS, to allow the admin tabs to work on all browsers
function bcwsa_menu_local_task($variables) {
  $link = $variables['element']['#link'];
  $link['localized_options']['html'] = TRUE;
  return '<li' . (!empty($variables['element']['#active']) ? ' class="active"' : '') . '>' . l('<span class="tab">' . $link['title'] . '</span>', $link['href'], $link['localized_options']) . "</li>\n";
}

//  Duplicate of theme_menu_local_tasks() but adds clearfix to tabs.
function bcwsa_menu_local_tasks() {
  $output = array();
  if ($primary = menu_primary_local_tasks()) {
    if(menu_secondary_local_tasks()) {
      $primary['#prefix'] = '<ul class="tabs primary with-secondary clearfix">';
    }
    else {
      $primary['#prefix'] = '<ul class="tabs primary clearfix">';
    }
    $primary['#suffix'] = '</ul>';
    $output[] = $primary;
  }
  if ($secondary = menu_secondary_local_tasks()) {
    $secondary['#prefix'] = '<ul class="tabs secondary clearfix">';
    $secondary['#suffix'] = '</ul>';
    $output[] = $secondary;
  }
  return drupal_render($output);
}



/** STATUS MESSAGES
Returns HTML for status and/or error messages, grouped by type.
---------------------------------------------------------- */
function bcwsa_status_messages($vars) {
  $display = $vars['display'];
  $output = '';

  $status_heading = array(
    'status' => t('Status message'),
    'error' => t('Error message'),
    'warning' => t('Warning message'),
  );
  foreach (drupal_get_messages($display) as $type => $messages) {
    $output .= "<div class=\"alert alert-block messages $type\">\n";
    $output .= "  <a class=\"close\" data-dismiss=\"alert\" href=\"#\">x</a>\n";
    if (count($messages) > 1) {
      $output .= " <ul>\n";
      foreach ($messages as $message) {
        $output .= '  <li>' . $message . "</li>\n";
      }
      $output .= " </ul>\n";
    }
    else {
      $output .= $messages[0];
    }
    $output .= "</div>\n";
  }
  return $output;
}

// Quicktabs Fix To Add HTML To Tabs - http://drupal.org/node/1439790
function bcwsa_qt_quicktabs_tabset($vars) {
  $variables = array(
    'attributes' => array(
      'class' => 'quicktabs-tabs quicktabs-style-' . $vars['tabset']['#options']['style'],
    ),
    'items' => array(),
  );
  foreach (element_children($vars['tabset']['tablinks']) as $key) {
    $item = array();
    if (is_array($vars['tabset']['tablinks'][$key])) {
      $tab = $vars['tabset']['tablinks'][$key];
      
      // added the html option
      $tab['#options']['html'] = TRUE;
      
      if ($key == $vars['tabset']['#options']['active']) {
        $item['class'] = array('active');
      }
      $item['data'] = drupal_render($tab);
      $variables['items'][] = $item;
    }
  }
  return theme('item_list', $variables);
}