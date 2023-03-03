<?php
/**
 * Plugin Name: Employee Management
 * Plugin URI: https://www.example.com
 * Description: A plugin to manage employees.
 * Version: 1.0.0
 * Author: Christine Bai Mboya
 * Author URI: https://www.adminsubmenu.com
 * License: GPL2
 */



function create_employee_page() {
	global $wpdb;

	echo '<div class="container">';
	echo '<h1>Create Employee</h1>';

	if ( isset( $_POST['submit'] ) ) {
		$table_name = $wpdb->prefix . 'employees';

		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];

		$wpdb->insert(
			$table_name,
			array(
				'first_name' => $first_name,
				'last_name' => $last_name,
				'email' => $email,
			)
		);

		echo "<div class='notice notice-success is-dismissible'><p>" . __( 'Employee created successfully!', 'employee-management' ) . "</p></div>";
	}

	echo '<form method="post" action="">';
	echo '<label for="first_name">' . __( 'First Name:', 'employee-management' ) . '</label>';
	echo '<input type="text" name="first_name" id="first_name" required>';
	echo '<label for="last_name">' . __( 'Last Name:', 'employee-management' ) . '</label>';
	echo '<input type="text" name="last_name" id="last_name" required>';
	echo '<label for="email">' . __( 'Email:', 'employee-management' ) . '</label>';
	echo '<input type="email" name="email" id="email" required>';
	echo '<input type="submit" name="submit" value="' . __( 'Create Employee', 'employee-management' ) . '">';
	echo '</form>';

	echo '</div>';
} 
function view_employees_page() {
	global $wpdb;

	echo '<div class="container">';
	echo '<h1>View Employees</h1>';

	$table_name = $wpdb->prefix . 'employees';
	$employees = $wpdb->get_results( "SELECT * FROM $table_name" );

	if ( $employees ) {
		echo '<table class="wp-list-table widefat fixed striped">';
		echo '<thead><tr>';
		echo '<th>' . __( 'ID', 'employee-management' ) . '</th>';
		echo '<th>' . __( 'First Name', 'employee-management' ) . '</th>';
		echo '<th>' . __( 'Last Name', 'employee-management' ) . '</th>';
		echo '<th>' . __( 'Email', 'employee-management' ) . '</th>';
		echo '</tr></thead><tbody>';

		foreach ( $employees as $employee ) {
			echo '<tr>';
			echo '<td>' . $employee->id . '</td>';
			echo '<td>' . $employee->first_name . '</td>';
			echo '<td>' . $employee->last_name . '</td>';
			echo '<td>' . $employee->email . '</td>';
			echo '</tr>';
		}

		echo '</tbody></table>';
	} else {
		echo '<p>' . __( 'No employees found.', 'employee-management' ) . '</p>';
	}

	echo '</div>';
}



?>