<?php 
/**
 * @package Meerkat_Info_Widget
 */
?>
<p class="wms_widget_text">
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title' )?>:
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" />
	</label>
</p>

<p class="wms_widget_select">
<label for="<?php echo $this->get_field_id( 'id' )?>"><?php _e('Choose Info Widget')?>: </label> 
<?php if($items = MeerkatInfoWidgetHelper::get_items()){?>
	<select class="widefat" name="<?php echo $this->get_field_name( 'id' )?>" id="<?php echo $this->get_field_id( 'id' )?>>">
		<?php
	foreach ($items as $item) {?>
		<option value="<?php echo $item->ID?>" <?php selected( $instance['id'], $item->ID ); ?>><?php echo $item->post_title?></option>
	<?php } ?>
	</select>
	<?php } ?>
</p>

<p class="wms_widget_radio">
  	<label for="<?php echo $this->get_field_id('orientation'); ?>"><?php _e('Orientation'); ?></label><br>
    <input type="radio" id="<?php echo $this->get_field_id( 'orientation' ) . '-1' ?>" name="<?php echo $this->get_field_name( 'orientation' )?>" value="horizontal" <?php echo checked( $instance['orientation'] == 'horizontal', true, false )?>><label for="<?php echo $this->get_field_id( 'orientation' ) . '-1'?>"><?php _e('Horizontal')?></label><br>
  	<input type="radio" id="<?php echo $this->get_field_id( 'orientation' ) . '-2' ?>" name="<?php echo $this->get_field_name( 'orientation' )?>" value="vertical" <?php echo checked( $instance['orientation'] == 'vertical', true, false )?>><label for="<?php echo $this->get_field_id( 'orientation' ) . '-2'?>"><?php _e('Vertical')?></label><br>
</p>

<p class="wms_widget_checkbox">
  	<input id="<?php echo $this->get_field_id('collapse'); ?>" name="<?php echo $this->get_field_name('collapse'); ?>" type="checkbox" value="1" <?php echo checked( $instance['collapse'], '1'); ?>/>
	<label for="<?php echo $this->get_field_name('collapse'); ?>"><?php _e('Collapse All'); ?>?</label>
</p>

<p class="acfi">
You can also add this widget via a shortcode using this syntax: <br> <br><code>[wms_info_widget id='info_widget_post_id' title='My Info Widget' orientation='horizontal|vertical' collapse='0|1']</code>.
</p>