<?php
/**
 * Template Name: Champions Page
 *
 * Template for the Champions page.
 */

  get_header();

 ?>

 <?php while ( have_posts() ) : the_post(); ?>

   <?php get_template_part( 'loop-templates/content', 'champions' ); ?>

 <?php endwhile; // end of the loop. ?>

 <?php get_footer(); ?>
