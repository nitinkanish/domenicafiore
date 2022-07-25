<?php
/**
 * Partial template for the Champions Page
 */

?>
<section class="main-content">
	<?php
	if( have_rows('hero') ):

		while ( have_rows('hero') ) : the_row();

			get_template_part('partials/newsletter/hero');

		endwhile;

	endif;
	?>
</section>
