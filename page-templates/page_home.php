<?php
/**
 * Template Name: Home Page
 *
 * Template for the Home page.
 */

  get_header();

 ?>

 <?php while ( have_posts() ) : the_post(); ?>

   <?php get_template_part( 'loop-templates/content', 'home' ); ?>

 <?php endwhile; // end of the loop. ?>

 <?php get_footer(); ?>
