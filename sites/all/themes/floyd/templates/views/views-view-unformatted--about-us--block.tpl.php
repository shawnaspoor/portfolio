<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<?php foreach ($rows as $id => $row): ?>
	<?php if ($id%2 == 0): ?>
		<div class="promo-line">
		<?php
			$order = "right";
			$animation = "fadeInLeft";			
		?>		
	<?php else: ?>
		<?php
			$order = "left";
			$animation = "fadeInRight";
		?>	
	<?php endif; ?>  
		<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="row">
				<div class="wow promo <?php print $order; ?> animated <?php print $animation; ?> visible" data-wow-delay=".5s" data-animation="<?php print $animation; ?>">
					<div<?php if ($classes_array[$id]) { print ' class="' . $classes_array[$id] .'"';  } ?>>
				    <?php print $row; ?>			    
				  </div>
			  </div>
		  </div>
	  </div>
  <?php if ($id%2 == 1 || ($id == count($rows) - 1)): ?>
  	</div>
  <?php endif; ?>
<?php endforeach; ?>