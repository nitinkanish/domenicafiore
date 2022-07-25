<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package understrap
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );

?>

<div class="container">
	<div class="row not-found-message">
		<div class="col">
			<h2>That page can't be found.</h2>
			<p>It looks like nothing was found at this location.</p>
		</div>
	</div>
</div>

<?php get_footer(); ?>
