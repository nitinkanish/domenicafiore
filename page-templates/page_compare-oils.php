<?php
/**
 * Template Name: Compare Oils Page
 *
 * Template for the Compare Oils page.
 */

  get_header();

 ?>

 <?php while ( have_posts() ) : the_post(); ?>

   <?php get_template_part( 'loop-templates/content', 'compare-oils' ); ?>

 <?php endwhile; // end of the loop. ?>

 <?php get_footer(); ?>
