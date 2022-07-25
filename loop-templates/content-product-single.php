<?php
/**
 * Partial template for single products
 */

?>
<section class="main-content">
	<?php
		// Header
		get_template_part('partials/single-product/header');

		// Show products
		get_template_part('partials/single-product/show-products');

		// Accordion Content
		if( have_rows('accordion_content') ):

			get_template_part('partials/single-product/accordion-content');

		endif;

		get_template_part('partials/single-product/people-also-viewed');
	?>
</section>

<?php get_template_part('partials/scripts/cart-quantity-init'); ?>
