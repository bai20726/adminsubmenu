<?php
/*
Template Name: Employees
*/

get_header();
?>

<div class="container">
	<h1><?php the_title(); ?></h1>

	<?php
	if ( isset( $_POST['submit'] ) ) {
		global $wpdb;
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
	?>

	<form method="post" action="">
		<label for="first_name"><?php _e( 'First Name:', 'employee-management' ); ?></label>
		<input type="text" name="first_name" id="first_name" required>
		<label for="last_name"><?php _e( 'Last Name:', 'employee-management' ); ?></label>
		<input type="text" name="last_name" id="last_name" required>
		<label for="email"><?php _e( 'Email:', 'employee-management' ); ?></label>
		<input type="email" name="email" id="email" required>
		<input type="submit" name="submit" value="<?php _e( 'Create Employee', 'employee-management' ); ?>">
	</form>
</div>

<?php get_footer(); ?>
