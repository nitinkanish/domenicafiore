<?php
/**
 * The template for displaying all single recipes.
 *
 * @package understrap
 */

get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'loop-templates/content', 'concierge-single' ); ?>

		<?php understrap_post_nav(); ?>

	<?php
	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
	?>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
