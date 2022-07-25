<?php
/**
 * Partial template for Visual Menu Pages
 */

?>
<section class="main-content">
	<?php
		if( have_rows('content') ):

			while ( have_rows('content') ) : the_row();

				// Hero Section
				if( get_row_layout() == 'hero' ) {
					get_template_part('partials/template-category-menu/hero');
				}

        // Main Copy Section
				if( get_row_layout() == 'link_blocks' ) {
					get_template_part('partials/template-category-menu/link-blocks');
				}

			endwhile;

		endif;

	?>
</section>
