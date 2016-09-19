<?php $items = get_field('meerkat_info_widget_items',$id); ?>
<?php edit_post_link('Edit Items', '<span class="edit-me edit-callout">', '</span>', $id); ?>
<ul class="<?php echo $orientation?>" data-orientation="<?php echo $orientation?>" data-collapse="<?php echo $collapse?>">
<?php
  foreach($items as $item){?>
  	<li>
  		<h3 class="trigger"><?php echo $item['meerkat_info_widget_item_header']?></h3>
  		<div class="target"><?php echo $item['meerkat_info_widget_item_content']?></div>
	</li>
  <?php }
?>
</ul><!-- .<?php echo $this->classname?> -->