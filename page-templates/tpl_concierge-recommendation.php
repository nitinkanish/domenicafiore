<?php
/**
 * Template Name: Template - Concierge recommendation page
 *
 * Template for Concierge recommendation pages.
 */

  get_header();

 ?>

 <?php while ( have_posts() ) : the_post(); ?>

   <?php get_template_part( 'loop-templates/tpl', 'concierge-recommendation' ); ?>

 <?php endwhile; // end of the loop. ?>

 <?php get_footer(); ?>
