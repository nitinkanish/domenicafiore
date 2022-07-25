<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

	$the_theme = wp_get_theme();
	$container = get_theme_mod( 'understrap_container_type' );

	// Get menus
	$shop_menu_items     = df_get_menu_items('footer-shop');
	$company_menu_items     = df_get_menu_items('footer-company');
	$customer_menu_items     = df_get_menu_items('footer-customer');
	$privacy_menu_items     = df_get_menu_items('footer-privacy');
?>

<?php
	if ( !is_page('home') ) {
		get_template_part('partials/global/newsletter-signup');
	}
?>

<footer>
	
	<div class="footer-inner">
		<!-- Footer Nav -->
		<div class="footer-nav-container">
<div class="footer-logo-df"><img class="domenica-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/img/domenica-fiore-icon.svg" alt="Domenica Fiore Logo"></div>
			<!-- Shop -->
			<div class="footer-nav-category">
				<a class="nav-category-header" href="/shop"><?php _e( 'Shop', 'domenicafiore' ); ?></a>
				<ul class="nav-category-links d-none d-sm-block">
					<?php if (isset($shop_menu_items)): foreach ( (array) $shop_menu_items as $key => $menu_item ) : ?>
						<li class="footer-menu-link">
							<a href="<?php echo $menu_item->url; ?>">
								<?php echo $menu_item->title; ?>
							</a>
						</li>
					<?php endforeach; endif; ?>
				</ul>
			</div>
			<!-- Company -->
			<div class="footer-nav-category">
				<a class="nav-category-header" href="/about"><?php _e( 'About', 'domenicafiore' ); ?></a>
				<ul class="nav-category-links d-none d-sm-block">
					<?php if (isset($company_menu_items)): foreach ( (array) $company_menu_items as $key => $menu_item ) : ?>
						<li class="footer-menu-link">
							<a href="<?php echo $menu_item->url; ?>">
								<?php echo $menu_item->title; ?>
							</a>
						</li>
					<?php endforeach; endif; ?>
				</ul>
			</div>
			<!-- Customer -->
			<div class="footer-nav-category">
				<a class="nav-category-header" href="/customer-care"><?php _e( 'Customer', 'domenicafiore' ); ?></a>
				<ul class="nav-category-links d-none d-sm-block">
					<?php if (isset($customer_menu_items)): foreach ( (array) $customer_menu_items as $key => $menu_item ) : ?>
						<li class="footer-menu-link">
							<a href="<?php echo $menu_item->url; ?>">
								<?php echo $menu_item->title; ?>
							</a>
						</li>
					<?php endforeach; endif; ?>
				</ul>
			</div>
			<!-- Privacy -->
			<div class="footer-nav-category">
				<a class="nav-category-header" href="/privacy"><?php _e( 'Privacy', 'domenicafiore' ); ?></a>
				<ul class="nav-category-links d-none d-sm-block">
					<?php if (isset($privacy_menu_items)): foreach ( (array) $privacy_menu_items as $key => $menu_item ) : ?>
						<li class="footer-menu-link">
							<a href="<?php echo $menu_item->url; ?>">
								<?php echo $menu_item->title; ?>
							</a>
						</li>
					<?php endforeach; endif; ?>
				</ul>
			</div>
		</div>
		<!-- Contact Info / Social Media Links -->
		<div class="footer-contact">
			<div class="social-media-links">
				<!-- Facebook -->
				<a href="https://www.facebook.com/domenicafioreevoo/">
					<i class="fab fa-facebook"></i>
				</a>
				<!-- Instagram -->
				<a href="https://www.instagram.com/domenica_fiore/">
					<i class="fab fa-instagram"></i>
				</a>
				<!-- Twitter -->
				<a href="https://twitter.com/domenica_fiore">
					<i class="fab fa-twitter"></i>
				</a>
				<!-- YouTube -->
				<a href="https://www.youtube.com/channel/UCJbsomOB_TtxPjuBGcG-9yg">
					<i class="fab fa-youtube"></i>
				</a>
			</div>
			<div class="contact-info d-none d-sm-block">
				<p>
					Suite 3123-595 Burrard Street<br />
					Three Bentall Centre<br />
					P.O. Box 49139<br />
					Vancouver, BC V7X 1J1 Canada
				</p>
				<p>
					<a href="tel:+16046854554">+1 604 685 4554</a><br />
					<a href="mailto:info@domenicafiore.com">info@domenicafiore.com</a>
				</p>
			</div>
		</div>
	</div>
</footer>


</div><!-- #page we need this extra closing tag here -->

<?php get_template_part('partials/global/modals'); ?>
<?php get_template_part('partials/footer/footer-scripts'); ?>

<?php wp_footer(); ?>
<script type="text/javascript">
jQuery(document).ready(function () {

if (jQuery('.cart-discount td span').hasClass('amount')) {
        jQuery('.case-discount-notice').hide();
    }
	jQuery( document.body ).on( 'updated_cart_totals', function(){
    jQuery('.case-discount-notice').removeClass('d-none');
            jQuery('.case-discount-notice').show();
		jQuery('.woocommerce-cart-form').addClass('remove-coupon');
});
   }); 


</script>
</body>

</html>
