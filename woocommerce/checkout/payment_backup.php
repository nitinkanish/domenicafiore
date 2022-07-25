<?php
/**
 * Checkout Payment Section
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.3
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="payment-container">
	<?php if ( ! is_ajax() ) { do_action( 'woocommerce_review_order_before_payment' ); } ?>
	<?php if ( df_product_is_in_cart(8058) ) : ?>
		<div class="pre-order-confirmation df-block-notice">
			<p><?php _e('Note: Novello di Notte 2020 is air shipped to North America in early November. Your complete order will be shipped at that time.','domenicafiore'); ?></p>
			<button type="button" class="btn btn-grey" id="pre_order_confirmation_accept"><?php _e('I understand','domenicafiore'); ?></button>
		</div>
	<?php endif; ?>
	<div id="payment" <?php echo ( df_product_is_in_cart(8058) ) ? 'class="d-none"' : ''; ?>>
		<?php if ( WC()->cart->needs_payment() ) : ?>
			<ul class="wc_payment_methods payment_methods methods">
				<?php
					if ( ! empty( $available_gateways ) ) {
						foreach ( $available_gateways as $gateway ) {
							wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
						}
					} else {
						echo '<li>' . apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_country() ? __( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'domenicafiore' ) : __( 'Please fill in your details above to see available payment methods.', 'domenicafiore' ) ) . '</li>';
					}
				?>
			</ul>
		<?php endif; ?>
		<div class="form-row place-order">
			<noscript>
				<?php _e( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'domenicafiore' ); ?>
				<br/><input type="submit" class="btn btn-primary" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'domenicafiore' ); ?>" />
			</noscript>

			<?php wc_get_template( 'checkout/terms.php' ); ?>

			<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

			<?php echo apply_filters( 'woocommerce_order_button_html', '<input type="submit" class="btn btn-green" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '" />' ); ?>

			<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

			<?php //wp_nonce_field( 'woocommerce-process_checkout' ); ?>
			<?php wp_nonce_field( 'woocommerce-process_checkout' ); ?>
		</div>
	</div>

	<?php if ( ! is_ajax() ) { do_action( 'woocommerce_review_order_after_payment' ); } ?>
</div>


<script>
	jQuery(document).ready(function($){
		$('#pre_order_confirmation_accept').on('click',function() {
			$('#pre_order_confirmation_accept').addClass('d-none')
			$('#payment').removeClass('d-none')
		})
	})
</script>

<?php
