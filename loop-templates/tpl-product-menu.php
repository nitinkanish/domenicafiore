<?php
/**
 * Partial template for Product Menu Pages
 */

?>
<section class="main-content">
	<?php
		if( have_rows('content') ):

			while ( have_rows('content') ) : the_row();

				// Header Section
				if( get_row_layout() == 'header' ) {
					get_template_part('partials/template-product-menu/header');
				}

        // Product List
				if( get_row_layout() == 'product_list' ) {
					get_template_part('partials/template-product-menu/product-list');
				}

			endwhile;

		endif;

	?>
</section>
