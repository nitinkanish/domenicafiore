<?php
/**
 * Partial template for the top-level Concierge Page
 */

?>
<section class="main-content">
	<?php
		if( have_rows('content') ):

			while ( have_rows('content') ) : the_row();

				// Intro Section
				if( get_row_layout() == 'intro' ) {
          get_template_part('partials/concierge-first-level/intro');
				}

        // Shop-By Links
        if( get_row_layout() == 'shop_by_links' ) {
          get_template_part('partials/concierge-first-level/shop-by-links');
				}

			endwhile;

		endif;
	?>
</section>
