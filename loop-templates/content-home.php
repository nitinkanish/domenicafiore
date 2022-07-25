<?php
/**
 * Partial template for Template A - Home
 */

?>
<section class="main-content">
	<?php
		if( have_rows('content') ):

			while ( have_rows('content') ) : the_row();

				// Hero Section
				if( get_row_layout() == 'hero' ) {
					get_template_part('partials/home/hero');
				}

        // Featured Products Section
				if( get_row_layout() == 'featured_products' ) {
					get_template_part('partials/home/featured-products');
				}

				// Shop Links Section
				if( get_row_layout() == 'shop_links' ) {
					get_template_part('partials/home/shop-links');
				}

        // Olive Oil Club Section
				if( get_row_layout() == 'olive_oil_club' ) {
					get_template_part('partials/home/olive-oil-club');
				}

        // Newsletter Sign-up Section
				if( get_row_layout() == 'newsletter_sign-up' ) {
					get_template_part('partials/global/newsletter-signup');
				}

        // News Links Section
				if( get_row_layout() == 'news_links' ) {
					get_template_part('partials/home/news-links');
				}

			endwhile;

		endif;

	?>
</section>
