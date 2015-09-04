<?php

// Put the logo path into JavaScript for the live preview.
drupal_add_js(array('color' => array('logo' => theme_get_setting('logo', 'floyd'))), 'setting');

$info = array(
  // Available colors and color labels used in theme.
  'fields' => array(
    'base' => t('Main'),
    'text' => t('Text'),
    'link' => t('Link'),    
  ),
  // Pre-defined color schemes.
  'schemes' => array(
    'default' => array(
      'title' => t('Default'),
      'colors' => array(
        'base' => '#d95c5c', 
        'text' => '#333333',     
        'link' => '#999999',        
      ),
    ),
    'green' => array(
      'title' => t('Green'),
      'colors' => array(
        'base' => '#00c077',
        'text' => '#333333',     
        'link' => '#999999',           
      ),
    ),
    'blue' => array(
      'title' => t('Blue'),
      'colors' => array(
        'base' => '#428bca',
        'text' => '#333333',     
        'link' => '#999999',        
      ),
    ),   
    'yellow' => array(
      'title' => t('Yellow'),
      'colors' => array(
        'base' => '#f1c615',
        'text' => '#333333',     
        'link' => '#999999',           
      ),
    ),
    'black' => array(
      'title' => t('Black'),
      'colors' => array(
        'base' => '#333333',
        'text' => '#333333',     
        'link' => '#999999',        
      ),
    ),  
  ),

  // CSS files (excluding @import) to rewrite with new color scheme.
  'css' => array(
    'css/colors.css',
  ),

  // Files to copy.
  'copy' => array(
    'logo.png',
  ),

  // Gradient definitions.
  'gradients' => array(
    array(
      // (x, y, width, height).
      'dimension' => array(0, 0, 0, 0),
      // Direction of gradient ('vertical' or 'horizontal').
      'direction' => 'vertical',
      // Keys of colors to use for the gradient.
      'colors' => array('top', 'bottom'),
    ),
  ),

  // Color areas to fill (x, y, width, height).
  'fill' => array(),

  // Coordinates of all the theme slices (x, y, width, height)
  // with their filename as used in the stylesheet.
  'slices' => array(),

  // Reference color used for blending. Matches the base.png's colors.
  'blend_target' => '#ffffff',

  // Preview files.
  'preview_css' => 'color/preview.css',
  'preview_js' => 'color/preview.js',
  'preview_html' => 'color/preview.html',

  // Base file for image generation.
  'base_image' => 'color/base.png',
);
