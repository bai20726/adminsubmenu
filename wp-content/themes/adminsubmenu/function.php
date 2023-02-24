<?php

function my_admin_menu() {
	add_menu_page( 'Employees', 'Employees', 'manage_options', 'employees', 'employees_list');
	add_submenu_page( 'employees', 'Create Employee', 'Create Employee', 'manage_options', 'create-employee', 'create_employee');
	add_submenu_page( 'employees', 'View Employees', 'View Employees', 'manage_options', 'view-employees', 'view_employees');
}
add_action( 'admin_menu', 'my_admin_menu' );

function create_employees_table() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'employees';

	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
	  id mediumint(9) NOT NULL AUTO_INCREMENT,
	  first_name varchar(50) NOT NULL,
	  last_name varchar(50) NOT NULL,
	  email varchar(100) NOT NULL,
	  PRIMARY KEY (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}
register_activation_hook( __FILE__, 'create_employees_table' );


function enqueue_plugin_stylesheets() {
	wp_enqueue_style( 'plugin-style', plugins_url( 'custom.css', __FILE__ ) );
}
add_action( 'admin_enqueue_scripts', 'enqueue_plugin_stylesheets' );


function load_plugin_textdomain() {
	load_plugin_textdomain( 'employee-management', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'load_plugin_textdomain' );

function employees_list_shortcode() {
	ob_start();
	view_employees_page();
	return ob_get_clean();
}
add_shortcode( 'employees_list', 'employees_list_shortcode' );
