<?php
/**
 * Template Name: Basket Page
 *
 * Template for the Basket page.
 */

  get_header();

 ?>

 <?php while ( have_posts() ) : the_post(); ?>

   <?php get_template_part( 'loop-templates/content', 'basket' ); ?>

 <?php endwhile; // end of the loop. ?>

 <?php get_footer(); ?>
