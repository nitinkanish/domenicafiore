<?php
/**
 * Partial template for Customer Care
 */

?>
<section class="main-content">
	<?php
		if( have_rows('content') ):

			while ( have_rows('content') ) : the_row();

				// Hero Section
				if( get_row_layout() == 'hero' ) {
					get_template_part('partials/customer-care/hero');
				}

        // Main Copy Section
				if( get_row_layout() == 'main_copy_section' ) {
					get_template_part('partials/customer-care/copy');
				}

        // FAQ Section
				if( get_row_layout() == 'faq' ) {
					get_template_part('partials/customer-care/faq');
				}

			endwhile;

		endif;

	?>
</section>
