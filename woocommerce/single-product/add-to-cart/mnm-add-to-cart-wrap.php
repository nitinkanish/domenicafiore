<?php
/**
 * Mix and Match Product Add to Cart button wrapper template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/mnm-add-to-cart-wrap.php.
 *
 * HOWEVER, on occasion WooCommerce Mix and Match will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  Kathy Darling
 * @package WooCommerce Mix and Match/Templates
 * @since   1.3.0
 * @version 1.9.5
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ){
	exit;
}

global $product;

if ( ! $product->is_purchasable() ) { return; }

if ( $product->has_available_children() ) :
	$product_price = get_woocommerce_currency_symbol() . $product->get_price() . ' ' . get_woocommerce_currency();
	$product_regular_price = get_woocommerce_currency_symbol() . number_format( (float)$product->get_regular_price(), 2 );
?>
<div class="mnm_cart mnm_data cart" <?php echo $product->get_data_attributes(); ?>>

	<?php

	if ( $product->is_purchasable() ) {

		/**
		 * wc_mnm_before_add_to_cart_button_wrap hook.
		 */
		do_action( 'wc_mnm_before_add_to_cart_button_wrap' );
		?>

		<div class="mnm_button_wrap" style="display:block">

			<div class="mnm_message">
				<div class="woocommerce-info">
					<ul class="msg mnm_message_content">
						<li><?php echo wc_mnm_get_quantity_message( $product ); ?></li>
					</ul>
				</div>
			</div>

			<div class="mnm_price">
				<p class="sale-info"><span class="regular-price"><?php echo $product_regular_price; ?></span></p>
				<p class="price"><?php echo $product_price; ?></p>
			</div>
			<?php

			/**
			 * woocommerce_before_add_to_cart_button hook.
			 */
			do_action( 'woocommerce_before_add_to_cart_button' );

			/**
			 * @since 1.4.0.
			 */
			do_action( 'woocommerce_before_add_to_cart_quantity' );

	 		woocommerce_quantity_input( array(
	 			'min_value' => $product->is_sold_individually() ? 1 : apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
	 			'max_value' => $product->is_sold_individually() ? 1 : apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product ),
	 			'input_value' => isset( $_REQUEST['quantity'] ) ? wc_stock_amount( wp_unslash( $_REQUEST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
	 			) );

			/**
			 * @since 1.4.0.
			 */
	 		do_action( 'woocommerce_after_add_to_cart_quantity' );
	 		?>

	 		<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />

			<button type="submit" class="single_add_to_cart_button mnm_add_to_cart_button btn btn-green"><?php _e( 'Purchase Membership', 'domenicafiore' ); ?></button>

			<?php
			/**
			 * woocommerce_after_add_to_cart_button hook.
			 */
			do_action( 'woocommerce_after_add_to_cart_button' );
			?>

		</div>


		<?php
		/**
		 * wc_mnm_after_add_to_cart_button_wrap hook.
		 */
		do_action( 'wc_mnm_after_add_to_cart_button_wrap' );

	} else {

		echo '<div class="mnm_container_unavailable woocommerce-info">' . __( 'This product is currently unavailable.', 'woocommerce-mix-and-match-products' ) . '</div>';
	}
?>

</div>

<?php endif; ?>
