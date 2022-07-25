<?php
/**
 * Template Name: Concierge Page
 *
 * Template for the Concierge page.
 */

  get_header();

 ?>

 <?php while ( have_posts() ) : the_post(); ?>
   
   <?php get_template_part( 'loop-templates/content', 'concierge-top' ); ?>

 <?php endwhile; // end of the loop. ?>

 <?php get_footer(); ?>
