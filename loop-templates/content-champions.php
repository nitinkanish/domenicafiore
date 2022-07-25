<?php
/**
 * Partial template for the Champions Page
 */

?>
<section class="main-content">
	<?php
		if( have_rows('content') ):

			while ( have_rows('content') ) : the_row();

				// Intro Section
				if( get_row_layout() == 'intro' ) {
          get_template_part('partials/champions/intro');
				}

				// Champions List
        if( get_row_layout() == 'champions_list' ) {
          get_template_part('partials/champions/champions_list');
				}

				// Rich text row
        if( get_row_layout() == 'rich_text_row' ) {
          get_template_part('partials/champions/rich_text_row');
				}

			endwhile;

		endif;
	?>
</section>
