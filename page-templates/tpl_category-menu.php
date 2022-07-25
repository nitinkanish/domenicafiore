<?php
/**
 * Template Name: Template - Category Menu
 *
 * Template for Category Menu pages.
 */

  get_header();

 ?>

 <?php while ( have_posts() ) : the_post(); ?>
   
   <?php get_template_part( 'loop-templates/tpl', 'category-menu' ); ?>

 <?php endwhile; // end of the loop. ?>

 <?php get_footer(); ?>
