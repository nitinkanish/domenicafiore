<?php
/**
 * Template Name: Template - Concierge second-level page
 *
 * Template for Concierge second-level pages.
 */

  get_header();

 ?>

 <?php while ( have_posts() ) : the_post(); ?>

   <?php get_template_part( 'loop-templates/tpl', 'concierge-second-level' ); ?>

 <?php endwhile; // end of the loop. ?>

 <?php get_footer(); ?>
