<?php

/*
	Plugin Name: Grid Accordion
	Plugin URI:  http://bqworks.net/grid-accordion/
	Description: Responsive and touch-enabled grid accordion. The lite version.
	Version:     1.1
	Author:      bqworks
	Author URI:  http://bqworks.com
*/

// if the file is called directly, abort
if ( ! defined( 'WPINC' ) ) {
	die();
}

require_once( plugin_dir_path( __FILE__ ) . 'public/class-grid-accordion.php' );
require_once( plugin_dir_path( __FILE__ ) . 'public/class-accordion-renderer.php' );
require_once( plugin_dir_path( __FILE__ ) . 'public/class-panel-renderer-factory.php' );
require_once( plugin_dir_path( __FILE__ ) . 'public/class-panel-renderer.php' );

require_once( plugin_dir_path( __FILE__ ) . 'includes/class-grid-accordion-activation.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/class-grid-accordion-widget.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/class-grid-accordion-settings.php' );

register_activation_hook( __FILE__, array( 'BQW_Grid_Accordion_Lite_Activation', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'BQW_Grid_Accordion_Lite_Activation', 'deactivate' ) );

add_action( 'plugins_loaded', array( 'BQW_Grid_Accordion_Lite', 'get_instance' ) );
add_action( 'plugins_loaded', array( 'BQW_Grid_Accordion_Lite_Activation', 'get_instance' ) );

// register the widget
add_action( 'widgets_init', 'bqw_gal_register_widget' );

if ( is_admin() ) {
	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-grid-accordion-admin.php' );
	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-grid-accordion-updates.php' );
	add_action( 'plugins_loaded', array( 'BQW_Grid_Accordion_Lite_Admin', 'get_instance' ) );
	add_action( 'admin_init', array( 'BQW_Grid_Accordion_Lite_Updates', 'get_instance' ) );
}