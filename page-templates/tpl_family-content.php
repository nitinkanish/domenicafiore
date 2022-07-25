<?php
/**
 * Template Name: Template - Family content
 *
 * Template for Family content pages.
 */

  get_header();

 ?>

 <?php while ( have_posts() ) : the_post(); ?>

   <?php get_template_part( 'loop-templates/tpl', 'family-content' ); ?>

 <?php endwhile; // end of the loop. ?>

 <?php get_footer(); ?>
