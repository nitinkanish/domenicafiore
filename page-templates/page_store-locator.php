<?php
/**
 * Template Name: Store Locator Page
 *
 * Template for the Store Locator page.
 */

  get_header();

 ?>

 <?php while ( have_posts() ) : the_post(); ?>

   <?php get_template_part( 'loop-templates/content', 'store-locator' ); ?>

 <?php endwhile; // end of the loop. ?>

 <?php get_footer(); ?>
