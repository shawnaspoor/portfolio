<?php
/**
 * @file
 * theme-settings.php
 *
 * Provides theme settings for floyd themes when admin theme is not.
 *
 * 
 */

/**
 * Implements hook_form_FORM_ID_alter().
 */
function floyd_form_system_theme_settings_alter(&$form, $form_state, $form_id = NULL) {
  // Alter theme settings form.
  $form['floyd'] = array (
    '#type' => 'vertical_tabs',
    '#prefix' => '<h2><small>' . t('floyd SETTINGS') . '</small></h2>',
    '#weight' => -8
  );
  $form['floyd_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('MAP POSITION'),
    '#group' => 'floyd'
  );  
  $form['floyd_settings']['map_lat'] = array(
    '#type' =>'textfield', 
    '#title' => t('Lat'),    
    '#default_value' => theme_get_setting('map_lat')?theme_get_setting('map_lat'):'40.773328',
  );  
  $form['floyd_settings']['map_long'] = array(
    '#type' =>'textfield', 
    '#title' => t('Long'),    
    '#default_value' => theme_get_setting('map_long')?theme_get_setting('map_long'):'-73.960088',
  );

  return $form;
}