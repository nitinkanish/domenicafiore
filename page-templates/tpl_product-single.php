<?php
/**
 * Template Name: Template - Single Product
 *
 * Template for Single Product pages.
 */

  get_header();

 ?>

 <?php while ( have_posts() ) : the_post(); ?>

   <?php get_template_part( 'loop-templates/tpl', 'product-single' ); ?>

 <?php endwhile; // end of the loop. ?>

 <?php get_footer(); ?>
