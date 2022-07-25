<?php
/**
 * Template Name: Template - Single Blog Post
 *
 * Template for a single blog post.
 */

  get_header();

 ?>

 <?php while ( have_posts() ) : the_post(); ?>

   <?php get_template_part( 'loop-templates/tpl', 'blog-single' ); ?>

 <?php endwhile; // end of the loop. ?>

 <?php get_footer(); ?>
