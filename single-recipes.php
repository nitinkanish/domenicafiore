<?php
/**
 * The template for displaying all single recipes.
 *
 * @package understrap
 */

get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'loop-templates/content', 'recipe-single' ); ?>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
