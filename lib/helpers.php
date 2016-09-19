<?php
/**
 * Template functions for this plugin
 * 
 * Place all functions that may be usable in theme template files here.
 * 
 * @package Meerkat_Info_Widget
 * 
 * @author Williams Web Team
 * @version 1.0.0
 * @since 1.0.0
 */

class MeerkatInfoWidgetHelper{

    function __construct(){}

    static function get_items(){
        $args = array(
        'posts_per_page'    => -1,
        'post_status'       => 'publish',
        'post_type'         => 'meerkat_info_widget'
        );
        return get_posts($args);
    }

    static function setup(){
        register_post_type('meerkat_info_widget', array(	
        'label' => 'Info Widgets',
        'description' => 'Create a collapsible content area to display important information such as timelines, FAQs, etc.',
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => ''),
        'query_var' => true,
        'exclude_from_search' => true,
        'supports' => array('title',),
        'labels' => array (
        'name' => 'Info Widgets',
        'singular_name' => 'Info Widget',
        'menu_name' => 'Info Widgets',
        'add_new' => 'Add Info Widget',
        'add_new_item' => 'Add New Info Widget',
        'edit' => 'Edit',
        'edit_item' => 'Edit Info Widget',
        'new_item' => 'New Info Widget',
        'view' => 'View Info Widget',
        'view_item' => 'View Info Widget',
        'search_items' => 'Search Info Widgets',
        'not_found' => 'No Info Widgets Found',
        'not_found_in_trash' => 'No Info Widgets Found in Trash',
        'parent' => 'Parent Info Widget',
        ),) );
        
        if(function_exists("register_field_group"))
        {
            register_field_group(array (
            'id' => '52446daa547cd',
            'title' => 'Info Widget',
            'fields' =>
            array (
            0 =>
            array (
            'key' => 'field_523c93cf46af1',
            'label' => 'Items',
            'name' => 'meerkat_info_widget_items',
            'type' => 'repeater',
            'instructions' => 'Add new items by clicking the \'Add Item\' button.	You can order the items by dragging the item number up or down.',
            'required' => '0',
            'sub_fields' =>
            array (
            0 =>
            array (
            'key' => 'field_523c93cf46b07',
            'label' => 'Header',
            'name' => 'meerkat_info_widget_item_header',
            'type' => 'text',
            'default_value' => '',
            'formatting' => 'html',
            'order_no' => 0,
            ),
            1 =>
            array (
            'key' => 'field_523c93cf46b0f',
            'label' => 'Content',
            'name' => 'meerkat_info_widget_item_content',
            'type' => 'wysiwyg',
            'toolbar' => 'basic',
            'media_upload' => 'no',
            'the_content' => 'yes',
            'order_no' => 1,
            ),
            ),
            'row_min' => '0',
            'row_limit' => '',
            'layout' => 'row',
            'button_label' => 'Add Item',
            'order_no' => 0,
            ),
            ),
            'location' =>
            array (
            'rules' =>
            array (
            0 =>
            array (
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'meerkat_info_widget',
            'order_no' => 0,
            ),
            ),
            'allorany' => 'all',
            ),
            'options' =>
            array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' =>
            array (
            ),
            ),
            'menu_order' => 0,
            ));
        }
    }

}
