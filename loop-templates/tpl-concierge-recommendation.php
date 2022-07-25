<?php
/**
 * Partial template for Concierge second-level page
 */

?>
<section class="main-content">
	<?php
  	if( have_rows('content') ):
			while ( have_rows('content') ) : the_row();

				// Intro Section
				if( get_row_layout() == 'intro' ) {
					get_template_part('partials/concierge-third-level/intro');
				}

				// Copy Block
				if( get_row_layout() == 'copy_block' ) {
					get_template_part('partials/concierge-third-level/copy-block');
				}

				// Recommendation (recipe + product links)
				if( get_row_layout() == 'products_block' ) {
					get_template_part('partials/concierge-third-level/products-block');
				}

			endwhile;

		endif;
	?>
</section>
