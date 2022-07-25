<?php
/**
 * Partial template for Basket
 */

global $woocommerce;

?>
<section class="main-content df-basket-outer <?php echo ( WC()->cart->cart_contents_count > 0 ? '' : 'df-empty-cart' ); ?>">
	<div class="container">
		<div class="row">
			<!-- If cart is not empty, show checkout column -->
			<?php //if ( WC()->cart->cart_contents_count > 0 ) : ?>
				<div class="checkout-column col-12 col-md-7">
					<h2 class="conqueror"><?php _e( 'Checkout', 'domenicafiore' ); ?></h2>
					<div class="df-accordion" id="checkout-accordion-outer">
						<?php echo do_shortcode( '[woocommerce_checkout]' ); ?>
					</div>
				</div>
			<?php //endif; ?>
			<div class="cart-column col-12 col-md-5">
				<?php echo do_shortcode( '[woocommerce_cart]' ) ?>
			</div>
		</div>
	</div>
</section>

<?php get_template_part('partials/scripts/basket-page-scripts'); ?>
