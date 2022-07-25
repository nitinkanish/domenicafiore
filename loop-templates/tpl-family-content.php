<?php
/**
 * Partial template for Family Content Pages
 */

?>
<section class="main-content">
	<?php
		if( have_rows('content') ):

			while ( have_rows('content') ) : the_row();

				// Hero Section
				if( get_row_layout() == 'hero' ) {
					get_template_part('partials/template-family-content/hero');
				}

        // Rich Content Block
				if( get_row_layout() == 'rich_content_block' ) {
					get_template_part('partials/template-family-content/rich-content-block');
				}

        // Full-Width Image Block
				if( get_row_layout() == 'full_width_image_block' ) {
					get_template_part('partials/template-family-content/full-width-image-block');
				}

        // Link Button Block
				if( get_row_layout() == 'link_button_block' ) {
					get_template_part('partials/template-family-content/link-button-block');
				}

			endwhile;

		endif;

	?>
</section>
