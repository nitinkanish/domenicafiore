<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

defined( 'ABSPATH' ) || exit;

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}

if ( empty( WC()->cart->applied_coupons ) ) {
	$info_message = apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'domenicafiore' ) );
	// $info_message .= ' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', 'domenicafiore' ) . '</a>' );
	// wc_print_notice( $info_message, 'notice' );
}
?>

<div class="card coupon">
	<div class="card-header" id="checkout-accordion-coupons-header">
		<h5 class="mb-0">
			<button class="btn btn-accordion" data-toggle="collapse" data-target="#checkout-accordion-coupons-collapse" aria-expanded="true" aria-controls="checkout-accordion-coupons-collapse">
				<span class="text"><?php _e( 'Coupons', 'domenicafiore' ); ?></span>
				<div class="collapse-arrow"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/collapse-arrow.svg" width="16"></div>
			</button>
		</h5>
	</div>
	<div class="df-accordion-collapse collapse" id="checkout-accordion-coupons-collapse" aria-labelledby="checkout-accordion-coupons-header" data-parent="#checkout-accordion-outer">
		<div class="card-body">
			<?php echo $info_message; ?>
			<form class="checkout_coupon" method="post">

				<p class="form-row form-row-first">
					<input type="text" name="coupon_code" class="form-control" placeholder="<?php esc_attr_e( 'Coupon code', 'domenicafiore' ); ?>" id="checkout_coupon_code" value="" />
				</p>

				<p class="form-row form-row-last">
					<input type="submit" class="btn btn-outline-primary" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'domenicafiore' ); ?>" />
				</p>

				<div class="clear"></div>
			</form>
		</div>
	</div>
</div>
