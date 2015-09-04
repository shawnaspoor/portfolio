<?php

/**
 * @file
 * template.php
 */

function floyd_process_page(&$variables)  {
  // Hook into color.module.
  if (module_exists('color')) {
    _color_page_alter($variables);
  }

  // Add information about the number of sidebars.
  if (!empty($variables['page']['sidebar_first']) && !empty($variables['page']['sidebar_second'])) {
    $variables['content_column_class'] = ' class="col-md-6"';
  }
  elseif (!empty($variables['page']['sidebar_first']) || !empty($variables['page']['sidebar_second'])) {
    $variables['content_column_class'] = ' class="col-md-9"';
  }
  else {
    $variables['content_column_class'] = ' class="col-md-12"';
  }
  
	if (isset($variables ['title'])) {
    $variables ['title'] = strip_tags(html_entity_decode($variables ['title']));
  }

  if ((drupal_is_front_page() || current_path() == 'node/72' || current_path() == 'node/73') && isset($variables ['title'])) {

    unset($variables ['title']);    
    $lat = is_null(theme_get_setting('map_lat')) ? '40.773328' : theme_get_setting('map_lat');
    $long = is_null(theme_get_setting('map_long')) ? '-73.960088' : theme_get_setting('map_long');
    drupal_add_js('http://maps.google.com/maps/api/js?sensor=true', 'external');
    $floyd_path = drupal_get_path('theme', 'floyd');
    drupal_add_js($floyd_path . '/js/gmap3.js');
    drupal_add_js("
      function isMobile() { 
        return ('ontouchstart' in document.documentElement);
      }
      function init_gmap() {
        if ( typeof google == 'undefined' ) return;
        var styles = [
        {
          'featureType': 'water',
          'stylers': [
          {
            'color': '#eee'
          },
          {
            'visibility': 'on'
          }
          ]
        },
        {
          'featureType': 'landscape',
          'stylers': [
          {
            'color': '#f2f2f2'
          }
          ]
        },
        {
          'featureType': 'road',
          'stylers': [
          {
            'saturation': -100
          },
          {
            'lightness': 45
          }
          ]
        },
        {
          'featureType': 'road.highway',
          'stylers': [
          {
            'visibility': 'simplified'
          }
          ]
        },
        {
          'featureType': 'road.arterial',
          'elementType': 'labels.icon',
          'stylers': [
          {
            'visibility': 'off'
          }
          ]
        },
        {
          'featureType': 'administrative',
          'elementType': 'labels.text.fill',
          'stylers': [
          {
            'color': '#444444'
          }
          ]
        },
        {
          'featureType': 'transit',
          'stylers': [
          {
            'visibility': 'off'
          }
          ]
        },
        {
          'featureType': 'poi',
          'stylers': [
          {
            'visibility': 'off'
          }
          ]
        }
       ]
        var options = {
          center: [" . $lat . ", " . $long . "],
          zoom: 16,
          mapTypeControl: false,
          disableDefaultUI: true,
          zoomControl: false,
          scrollwheel: false,
          styles: styles
        }

        if (isMobile()) {
          options.draggable = false;
        }
        var pathToTheme = Drupal.settings.basePath + 'sites/all/themes/floyd';
        var image = pathToTheme + '/images/mapicon.png';    

        jQuery('#map').gmap3({
          map: {
            options: options
          },
          marker: {
            latLng: [" . $lat . ", " . $long . "],
            // options: { icon: image }
          }
        });
      }
      jQuery(document).ready(function() {
        init_gmap();  
      });
      
    ", 'inline');
  }
}

function floyd_preprocess_html(&$variables) {	  
	// Construct page title.
  if (drupal_get_title()) {
    $head_title = array(
      'title' => strip_tags(html_entity_decode(drupal_get_title())),
      'name' => check_plain(strip_tags(html_entity_decode(variable_get('site_name', 'Drupal')))),
    );
  }
  else {
    $head_title = array('name' => check_plain(strip_tags(html_entity_decode(variable_get('site_name', 'Drupal')))));
    if (variable_get('site_slogan', '')) {
      $head_title ['slogan'] = filter_xss_admin(variable_get('site_slogan', ''));
    }
  }  
  $variables ['head_title_array'] = $head_title;
  $variables ['head_title'] = implode(' | ', $head_title);  
}

/**
 * Override or insert variables into the page template for HTML output.
 */
function floyd_process_html(&$variables) {
  // Hook into color.module.
  if (module_exists('color')) {
    _color_html_alter($variables);
  }
}

function floyd_js_alter(&$js) {
  $bootstrap_js_path = drupal_get_path('theme', 'bootstrap') . '/js/bootstrap.js';
  unset($js[$bootstrap_js_path]);     
  $isotope_js_path = drupal_get_path('module', 'views_isotope') . '/views_isotope.js';
  if (isset($js[$isotope_js_path])) {    
    unset($js[$isotope_js_path]);
    drupal_add_js(drupal_get_path('theme', 'floyd') . '/js/views_isotope.js');
  } 
}

/**
 * Overrides theme_menu_link().
 */
function floyd_menu_link(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';

  if ($element['#below']) {
    // Prevent dropdown functions from being added to management menu so it
    // does not affect the navbar module.
    if (($element['#original_link']['menu_name'] == 'management') && (module_exists('navbar'))) {
      $sub_menu = drupal_render($element['#below']);
    }
    elseif ((!empty($element['#original_link']['depth'])) && ($element['#original_link']['depth'] == 1)) {
      // Add our own wrapper.
      unset($element['#below']['#theme_wrappers']);
      $sub_menu = '<ul class="sub-menu">' . drupal_render($element['#below']) . '</ul>';
      // Generate as standard dropdown.
      // $element['#title'] .= ' <span class="caret"></span>';
      $element['#attributes']['class'][] = 'dropdown menu-item-has-children';
      $element['#localized_options']['html'] = TRUE;

      // Set dropdown trigger element to # to prevent inadvertant page loading
      // when a submenu link is clicked.
      $element['#localized_options']['attributes']['data-target'] = '#';
      $element['#localized_options']['attributes']['class'][] = 'dropdown-toggle';
      $element['#localized_options']['attributes']['data-toggle'] = 'dropdown';
    }
  }
  // On primary navigation menu, class 'active' is not set on active menu item.
  // @see https://drupal.org/node/1896674
  if (($element['#href'] == $_GET['q'] || ($element['#href'] == '<front>' && drupal_is_front_page())) && (empty($element['#localized_options']['language']))) {
    // $element['#attributes']['class'][] = 'active';
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

function floyd_menu_tree__primary(&$variables) {  
  return '<ul id="nav" class="nav navbar-nav navbar-right">' . $variables['tree'] . '</ul>';
}

function floyd_theme() {
  $floyd_path = drupal_get_path('theme', 'floyd');
  return array(
    'contact_site_form' => array(
      'render element' => 'form',
      'template' => 'contact-site-form',
      'path' => $floyd_path.'/templates/system',
    ),
    'comment_form__node_blog' => array(
      'render element' => 'form',
      'template' => 'comment-form--node-blog',
      'path' => $floyd_path.'/templates/system',
    ),
  );
}