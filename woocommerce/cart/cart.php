<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

wc_print_notices();

global $woocommerce;

do_action( 'woocommerce_before_cart' ); ?>

<section class="df-cart-container">

	<div class="cart-header">
		<h3 class="title">Cart</h3>
		<h3 class="currency"><?php echo get_woocommerce_currency_symbol() . $woocommerce->cart->subtotal; ?> <?php echo get_woocommerce_currency(); ?></h3>
	</div>

	<form class="woocommerce-cart-form df-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
		<?php do_action( 'woocommerce_before_cart_table' ); ?>
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>
		<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product->get_attribute( 'product_display_name' ) ) {
				$product_name = $_product->get_attribute( 'product_display_name' );
			} else {
				$product_name = $_product->get_name();
			}

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );

		?>
			<div class="df-cart-product-row <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
				<div class="df-delete-product">
					<?php
						echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
							'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
							esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
							esc_attr__( 'Remove this item', 'domenicafiore' ),
							esc_attr( $product_id ),
							esc_attr( $_product->get_sku() )
						), $cart_item_key );
					?>
				</div>
				<div class="df-product-image">
					<?php
						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

						if ( ! $product_permalink ) {
							echo $thumbnail;
						} else {
							printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
						}
					?>
				</div>
				<div class="df-product-quantity">
					<?php
						if ( $_product->is_sold_individually() ) {
							$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
						} else {
							$product_quantity = woocommerce_quantity_input( array(
								'input_name'  => "cart[{$cart_item_key}][qty]",
								'input_value' => $cart_item['quantity'],
								'max_value'   => $_product->get_max_purchase_quantity(),
								'min_value'   => '0',
							), $_product, false );
						}

						echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
					?>
				</div>
				<div class="df-product-summary">
					<div class="name">
						<?php
							if ( ! $product_permalink ) {
								echo apply_filters( 'woocommerce_cart_item_name', $product_name, $cart_item, $cart_item_key ) . '&nbsp;';
							} else {
								echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $product_name ), $cart_item, $cart_item_key );
							}

							// Meta data
							echo  wc_get_formatted_cart_item_data( $cart_item );

							// Backorder notification
							if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
								echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'domenicafiore' ) . '</p>';
							}
						?>
					</div>
					<div class="size">
						<?php
							echo $_product->get_attribute( 'size' );
						?>
					</div>
					<?php if ( $cart_item['data']->get_price() !== '0' ) : ?>
					<div class="price">
						<?php
							echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
						?>
						<?php echo get_woocommerce_currency(); ?>
					</div>
					<?php endif; ?>
					<?php if ( $cart_item['data']->get_price() !== '0' ) : ?>
					<div class="subtotal">
						<?php
							echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
						?>
						<?php echo get_woocommerce_currency(); ?>
					</div>
					<?php endif; ?>
					<?php
						// Case of 6 Discount Message (available for Olive Oil products only, excluding di Notte 2020)
						if ( !user_is_olive_oil_club_member() && product_is_eligible_for_case_discount( $product_id ) ) {
							echo '<div class="case-discount-notice d-none">' . get_case_discount_message() . '</div>';
						}
					?>
				</div>
			</div>
			<?php
				}
			}
		?>
		<div class="df-cart-actions-row">
			<div class="button-group">
				<input id="update-cart-button" type="submit" class="btn btn-green"  name="update_cart" value="<?php esc_attr_e( 'Update Cart', 'domenicafiore' ); ?>" />
				<a class="btn btn-grey keep-shopping-button" href="<?php echo get_permalink( get_page_by_path( 'shop' ) ); ?>"><?php _e( 'Keep Shopping', 'domenicafiore' ); ?></a>
			</div>
			<?php if ( wc_coupons_enabled() ) { ?>
				<div class="coupon">
					<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon Code', 'domenicafiore' ); ?>" />
					<input type="submit" class="keep-shopping-button btn btn-green" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'domenicafiore' ); ?>" />
					<?php do_action( 'woocommerce_cart_coupon' ); ?>
				</div>
			<?php } ?>

			<?php do_action( 'woocommerce_cart_actions' ); ?>
			<?php //wp_nonce_field( 'woocommerce-cart' ); ?>
			<?php wp_nonce_field( 'woocommerce-cart' ); ?>
		</div>
		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		<?php do_action( 'woocommerce_after_cart_table' ); ?>
	</form>

	<!-- <div class="cart-collaterals"> -->
		<?php
			/**
			 * woocommerce_cart_collaterals hook.
			 *
			 * @hooked woocommerce_cross_sell_display
			 * @hooked woocommerce_cart_totals - 10
			 */
		 	//do_action( 'woocommerce_cart_collaterals' );
		?>
	<!-- </div> -->

	<?php do_action( 'woocommerce_after_cart' ); ?>

</section>

<script>
	jQuery(document).ready(function($){
		const discountThreshold = 6
		$('.woocommerce-cart-form .df-cart-product-row').each( function() {
			let messageContainer = $(this).find('.case-discount-notice')

			if ( messageContainer.length ) {
				console.log('true')
				// Set initial visibility of Case Discount message
				//
				let itemQuantity = $(this).find('.df-product-quantity input.qty').val()
				if ( itemQuantity < discountThreshold ) {
					if ( messageContainer.hasClass('d-none') ) {
						messageContainer.removeClass('d-none')
					}
				}

				// Set visibility of Case Discount message based on quantity button click
				//
				$(this).find('.df-product-quantity input[type=button]').on('click', (event) => {
					setTimeout( () => {
						let itemQuantity = $(event.target).parent().find('input.qty').val()
						if ( itemQuantity > 0 && itemQuantity < discountThreshold ) {
							if ( messageContainer.hasClass('d-none') ) {
								messageContainer.removeClass('d-none')
							}
						} else {
							if ( !messageContainer.hasClass('d-none') ) {
								messageContainer.addClass('d-none')
							}
						}
					}, 80 );
				})
			} else {
				console.log('false')
			}

		} )
	})
</script>
