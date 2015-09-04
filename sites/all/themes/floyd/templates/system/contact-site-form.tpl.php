<?php        
    hide($form['copy']);
    $form['message']['#resizable'] = FALSE;
    $form['name']['#attributes']['placeholder'] = $form['name']['#title'];
    unset($form['name']['#title']);
    $form['mail']['#attributes']['placeholder'] = $form['mail']['#title'];
    unset($form['mail']['#title']);
    $form['subject']['#attributes']['placeholder'] = $form['subject']['#title'];
    unset($form['subject']['#title']);
    $form['message']['#attributes']['placeholder'] = $form['message']['#title'];
    unset($form['message']['#title']);
?>

<div class="col-md-5 col-sm-5 col-xs-12 wow animated animated slideInLeft" data-wow-delay="0s">
    <div class="form-group">
        <?php print render($form['name']); ?>  
    </div>
    <div class="form-group">
        <?php print render($form['mail']); ?>
    </div>
    <div class="form-group">
        <?php print render($form['subject']); ?>
    </div>
</div>              
<div class="col-md-7 col-sm-7 col-xs-12 animated slideInRight wow" data-wow-delay="0s">
    <div class="form-group">
        <?php print render($form['message']); ?> 
    </div>        
</div>
<div id="submit" class="pull-right up animated animated fadeInUpBig wow" data-wow-delay="0s">
    <?php print render($form['actions']); ?>                             
</div>  

<?php print drupal_render_children($form); ?>