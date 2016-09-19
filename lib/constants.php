<?php
/**
 * Constants used by this plugin
 * 
 * @package Meerkat_Info_Widget
 * 
 * @author Williams Web Team
 * @version 1.0.0
 * @since 1.0.0
 */

// Define these things in case wms-master-widget isn't active.
if(!defined('WMS_WIDGET_PREFIX')) define( 'WMS_WIDGET_PREFIX', '. ');
if(!defined('WMS_WIDGET_WIDTH')) define( 'WMS_WIDGET_WIDTH', 350);
if(!defined('WMS_WIDGET_HEIGHT')) define( 'WMS_WIDGET_HEIGHT', 300);

// The current version of this plugin
if( !defined( 'MEERKATINFO_VERSION' ) ) define( 'MEERKATINFO_VERSION', '1.0.0' );

// The directory the plugin resides in
if( !defined( 'MEERKATINFO_DIRNAME' ) ) define( 'MEERKATINFO_DIRNAME', dirname( dirname( __FILE__ ) ) );

// The URL path of this plugin
if( !defined( 'MEERKATINFO_URLPATH' ) ) define( 'MEERKATINFO_URLPATH', plugin_dir_url( '' ) . plugin_basename( MEERKATINFO_DIRNAME ) );

if( !defined( 'IS_AJAX_REQUEST' ) ) define( 'IS_AJAX_REQUEST', ( !empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' ) );