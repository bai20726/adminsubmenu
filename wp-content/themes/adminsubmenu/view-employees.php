<?php
/*
Template Name: View Employees
*/

get_header();
?>
<div class="container">
	<h1><?php the_title(); ?></h1>

    <?php
    ?>

    <div class="container">
        <h1><?php the_title(); ?></h1>
        <?php echo do_shortcode('[employee_list]'); ?>
    </div>

<?php get_footer(); ?>
