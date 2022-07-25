<?php
/**
 * Template Name: Olive Oil Club Page
 *
 * Template for the Olive Oil Club page.
 */

  get_header();

 ?>

 <?php while ( have_posts() ) : the_post(); ?>

   <?php get_template_part( 'loop-templates/content', 'olive-oil-club' ); ?>

 <?php endwhile; // end of the loop. ?>

 <?php get_footer(); ?>
