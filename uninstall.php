<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

if ( function_exists( 'is_multisite' ) && is_multisite() ) {
	global $wpdb;			
	$blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
	
	if ( $blog_ids !== false ) {
		foreach ( $blog_ids as $blog_id ) {
			switch_to_blog( $blog_id );
			bqw_grid_accordion_lite_delete_all_data();
		}

		restore_current_blog();
	}
} else {
	bqw_grid_accordion_lite_delete_all_data();
}

function bqw_grid_accordion_lite_delete_all_data() {
	if ( ! class_exists( 'BQW_Grid_Accordion' ) ) {
		global $wpdb;
		$prefix = $wpdb->prefix;

		$accordions_table = $prefix . 'gridaccordion_accordions';
		$panels_table = $prefix . 'gridaccordion_panels';
		$layers_table = $prefix . 'gridaccordion_layers';

		$wpdb->query( "DROP TABLE $accordions_table, $panels_table, $layers_table" );

		delete_option( 'grid_accordion_load_stylesheets' );
		delete_option( 'grid_accordion_access' );
		delete_option( 'grid_accordion_version' );
		
		$wpdb->query( "DELETE FROM " . $prefix . "options WHERE option_name LIKE '%grid_accordion_cache%'" );
	}
}