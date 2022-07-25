<?php
/**
 * Partial template for Compare Oils
 */

?>
<section class="main-content">
	<?php
		if( have_rows('intro') ):

			while ( have_rows('intro') ) : the_row();

				get_template_part('partials/compare-oils/intro');

			endwhile;

		endif;

		if( have_rows('oils') ):

			get_template_part('partials/compare-oils/oils');

		endif;
	?>
</section>

<?php //get_template_part('partials/scripts/cart-quantity-init'); ?>
