<?php
/**
 * Template Name: Template - Product Menu
 *
 * Template for Product Menu pages.
 */

  get_header();

 ?>

 <?php while ( have_posts() ) : the_post(); ?>

   <?php get_template_part( 'loop-templates/tpl', 'product-menu' ); ?>

 <?php endwhile; // end of the loop. ?>

 <?php get_footer(); ?>
