<?php
/**
 * Template Name: Template - Customer Care
 *
 * Template for Customer Care pages.
 */

  get_header();

 ?>

 <?php while ( have_posts() ) : the_post(); ?>

   <?php get_template_part( 'loop-templates/tpl', 'customer-care' ); ?>

 <?php endwhile; // end of the loop. ?>

 <?php get_footer(); ?>
