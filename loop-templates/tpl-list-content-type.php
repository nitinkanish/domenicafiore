<?php
/**
 * Partial template for archive pages (e.g., Blog, Recipes, Newsletter)
 */

	$post_type = get_field('post_type');
	$args = '';
	$load_more_shortcode = '[ajax_load_more id="6695315952" post_type="' . $post_type . '" button_label="Load More"]';

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	if ( $post_type === 'recipe' ) {

		$args = array(
			'post_status' => 'publish',
			'category' => 211,
			'paged' => $paged,
			'suppress_filters' => false
		);

	} else {

		$args = array(
			'post_status' => 'publish',
			'paged' => $paged,
			'category__not_in' => array(211),
			'suppress_filters' => false
		);

	}

	$posts = get_posts($args);

?>

<section class="main-content">
	<!-- Hero -->
	<?php get_template_part('partials/template-list-content-type/hero'); ?>

	<!-- Category Filter Buttons -->
	<?php
		// if ( $post_type !== 'recipe' ) { get_template_part('partials/template-list-content-type/category-filter-buttons'); }
	?>

	<!-- Posts -->
	<?php if (!empty($posts)): ?>
		<div class="container posts-list">

			<?php foreach($posts as $post) : ?>

			<?php
				get_template_part( 'partials/template-list-content-type/posts-list' );
			?>

			<?php endforeach; ?>
			<?php // echo do_shortcode($load_more_shortcode); ?>

		</div>
	<?php else: get_template_part( 'partials/template-list-content-type/no-posts-found' ); endif; ?>
	<?php //wp_reset_query(); ?>
</section>
