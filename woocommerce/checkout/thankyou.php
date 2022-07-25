<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

// function showFeedVancouverMessage($order) {
// 	$eligible_cities = array(
// 		'Vancouver',
// 		'Burnaby',
// 		'New Westminster',
// 		'Coquitlam',
// 		'Port Coquitlam',
// 		'Port Moody',
// 		'Surrey',
// 		'Richmond',
// 		'Delta',
// 		'White Rock',
// 		'North Vancouver',
// 		'West Vancouver',
// 		'Langley',
// 		'Abbotsford',
// 		'Pitt Meadows',
// 		'Maple Ridge',
// 		'Mission',
// 		'Chilliwack',
// 		'Hope',
// 		'Squamish',
// 		'Whistler',
// 		'Pemberton',
// 		'Gibsons',
// 		'Sechelt'
// 	);
// 	$product_is_applicable = false;
// 	$city_is_applicable = false;
//
// 	// Check for eligible products in order
// 	foreach ( $order->get_items() as $item_id => $item ) {
// 		 $product_id = $item->get_product_id();
// 		 $name = $item->get_name();
// 		 if ( has_term( 'feed-vancouver-promo', 'product_cat', $product_id ) ) {
// 			 $applicable_product = true;
// 		 }
// 	}
//
// 	// Check for eligible city in shipping address
// 	foreach ( $eligible_cities as $city ) {
// 		if ( $order->get_shipping_city() ) {
// 			if ( $order->get_shipping_city() == $city ) {
// 				$applicable_city = true;
// 			}
// 		} else {
// 			if ( $order->get_billing_city() == $city ) {
// 				$applicable_city = true;
// 			}
// 		}
// 	}
//
// 	if ( $applicable_product && $applicable_city ) {
// 		return true;
// 	}
// }
?>

<div class="woocommerce-order">

	<?php if ( $order ) : ?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'domenicafiore' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'domenicafiore' ) ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php _e( 'My account', 'domenicafiore' ); ?></a>
				<?php endif; ?>
			</p>

		<?php else : ?>

			<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'domenicafiore' ), $order ); ?></p>

			<!-- Special message - Feed Vancouver promo -->
			<?php //if ( showFeedVancouverMessage($order) ) : ?>
				<!-- <div class="promo-message">
					Thank you for your order. 50% of the eligible product purchases support The Guistra Foundation's Covid-19 Emergency Feeding Initiative. <a href='https://domenicafiore.com/domenica-fiore-feeds-vancouver-campaign'>Read more here</a>
				</div> -->
			<?php //endif; ?>

			<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

				<li class="woocommerce-order-overview__order order">
					<?php _e( 'Order number:', 'domenicafiore' ); ?>
					<strong><?php echo $order->get_order_number(); ?></strong>
				</li>

				<li class="woocommerce-order-overview__date date">
					<?php _e( 'Date:', 'domenicafiore' ); ?>
					<strong><?php echo wc_format_datetime( $order->get_date_created() ); ?></strong>
				</li>

				<?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
					<li class="woocommerce-order-overview__email email">
						<?php _e( 'Email:', 'domenicafiore' ); ?>
						<strong><?php echo $order->get_billing_email(); ?></strong>
					</li>
				<?php endif; ?>

				<li class="woocommerce-order-overview__total total">
					<?php _e( 'Total:', 'domenicafiore' ); ?>
					<strong><?php echo $order->get_formatted_order_total(); ?></strong>
				</li>

				<?php if ( $order->get_payment_method_title() ) : ?>
					<li class="woocommerce-order-overview__payment-method method">
						<?php _e( 'Payment method:', 'domenicafiore' ); ?>
						<strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
					</li>
				<?php endif; ?>

			</ul>

		<?php endif; ?>

		<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
		<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'domenicafiore' ), null ); ?></p>

	<?php endif; ?>

</div>
