<?php
/**
 * Template Name: Newsletter Page
 *
 * Template for the Newsletter page.
 */

  get_header();

 ?>

 <?php while ( have_posts() ) : the_post(); ?>

   <?php get_template_part( 'loop-templates/content', 'newsletter' ); ?>

 <?php endwhile; // end of the loop. ?>

 <?php get_footer(); ?>
