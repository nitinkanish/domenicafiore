<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $current_user;

wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'domenicafiore' ) );
	return;
}

?>
<form name="checkout" method="post" class="df-form checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
		<!-- Billing / Shipping Address -->
		<div class="card billing-shipping">
			<div class="card-header" id="checkout-accordion-billing-header">
				<h5 class="mb-0">
					<a class="btn btn-accordion" role="button" data-target="#checkout-accordion-billing-collapse" aria-expanded="<?php if ( is_user_logged_in() ) { echo 'true'; } else { echo 'false'; } ?>" aria-controls="checkout-accordion-billing-collapse">
						<span class="text">2. <?php _e( 'Billing Details', 'domenicafiore' ); ?></span>
						<div class="collapse-arrow"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/collapse-arrow.svg" width="16"></div>
					</a>
				</h5>
			</div>
			<div class="df-accordion-collapse collapse <?php if ( is_user_logged_in() ) { echo 'show'; } ?>" id="checkout-accordion-billing-collapse" aria-labelledby="checkout-accordion-billing-header">
				<div class="card-body">
					<?php do_action( 'woocommerce_checkout_billing' ); ?>
					<?php do_action( 'woocommerce_checkout_shipping' ); ?>
					<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
					<button class="btn btn-grey form-continue continue-to-order-review" type="button"><?php _e( 'Next', 'domenicafiore' ); ?></button>
				</div>
			</div>
		</div>

	<?php endif; ?>

	<!-- Order Review -->
	<div class="order-review-container">

		<div class="card review-order">

			<div class="card-header" id="checkout-accordion-review-order-header">
				<h5 class="mb-0">
					<a class="btn btn-accordion" role="button" data-target="#checkout-accordion-review-order-collapse" aria-expanded="false" aria-controls="checkout-accordion-review-order-collapse">
			 			<span class="text">3. <?php _e( 'Order Review & Payment', 'domenicafiore' ); ?></span>
						<div class="collapse-arrow"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/collapse-arrow.svg" width="16"></div>
					</a>
				</h5>
			</div>

			<div class="df-accordion-collapse collapse" id="checkout-accordion-review-order-collapse" aria-labelledby="checkout-accordion-review-order-header">
				<div class="card-body">

					<div class="order-summary-outer">

						<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
						<?php do_action( 'woocommerce_checkout_order_review' ); ?>
						<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

					</div>


				</div>
			</div>
		</div>

	</div>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
