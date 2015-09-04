<?php
	hide($form['author']);
	$form['subject']['#attributes']['placeholder'] = $form['subject']['#title'];
  unset($form['subject']['#title']);
  $form['comment_body']['und'][0]['value']['#attributes']['placeholder'] = $form['comment_body']['und'][0]['value']['#title'];
  unset($form['comment_body']['und'][0]['value']['#title']);  
?>
<h4 class="Section-title"><span><?php print t('Leave a Comment'); ?></span></h4>
<?php print render($form['subject']); ?>
<?php print render($form['comment_body']); ?>
<?php print render($form['actions']); ?>							
<?php print drupal_render_children($form); ?>