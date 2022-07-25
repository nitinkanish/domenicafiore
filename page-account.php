<?php
/**
 * The template for the Account page.
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );

?>

<section class="main-content">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'loop-templates/content', 'account' ); ?>

	<?php endwhile; // end of the loop. ?>

</section>

<?php get_footer(); ?>
