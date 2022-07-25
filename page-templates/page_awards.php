<?php
/**
 * Template Name: Awards Page
 *
 * Template for the Awards page.
 */

  get_header();

 ?>

 <?php while ( have_posts() ) : the_post(); ?>

   <?php get_template_part( 'loop-templates/content', 'awards' ); ?>

 <?php endwhile; // end of the loop. ?>

 <?php get_footer(); ?>
