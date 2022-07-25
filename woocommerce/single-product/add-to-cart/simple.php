<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product->is_purchasable() ) {
	echo "<p>" . _e( 'This product is currently not available', 'domenicafiore' ) . "</p>";
	return;
}

$product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'single-post-thumbnail' );
$product_size = $product->get_attribute( 'size' );
$product_price = get_woocommerce_currency_symbol() . $product->get_price() . ' ' . get_woocommerce_currency();
$product_restrictions = $product->get_attribute( 'RestrictedCountry' );
$product_pre_order = get_post_meta( $product->get_id(), '_wc_pre_orders_enabled', true );

?>

<div class="row">
<div class="df-product-add-to-cart-module col-12">
	<div class="image-container">
		<img src="<?php echo $product_image[0]; ?>" width="50" alt="">
		<?php echo wc_get_stock_html( $product ); ?>
	</div>
	<p class="size"><?php echo $product_size; ?></p>

	<?php
		if ( has_term( 'coming-soon', 'product_tag', $product->get_id() ) ) : ?>
		<p><?php _e( 'Coming Soon', 'domenicafiore' ); ?></p>
	<?php
		else :
			// echo wc_get_stock_html( $product );
			if ( $product->is_in_stock() ) :
	?>
	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>
	<form class="cart" action="<?php echo esc_url( get_permalink() ); ?>" method="post" enctype='multipart/form-data'>

		<?php
			/**
			 * @since 2.1.0.
			 */
			do_action( 'woocommerce_before_add_to_cart_button' );

			/**
			 * @since 3.0.0.
			 */
			do_action( 'woocommerce_before_add_to_cart_quantity' );

			woocommerce_quantity_input( array(
				'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
				'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
				'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : $product->get_min_purchase_quantity(),
			) );

			/**
			 * @since 3.0.0.
			 */
			do_action( 'woocommerce_after_add_to_cart_quantity' );

			// Case of 6 Discount Message (available for Olive Oil products only, excluding di Notte 2020)
			if ( !user_is_olive_oil_club_member() && product_is_eligible_for_case_discount( $product->get_ID() ) ) {
				echo '<div class="case-discount-notice d-none">' . get_case_discount_message() . '</div>';
			}

			// Unique message for Novello di Notte
			// if ( $product->get_ID() === 8058 ) {
			// 	$ndn20_discount_message = __( 'Discount codes for this product can be entered at checkout', 'domenicafiore' );
			// 	echo '<div class="ndn20-discount-notice">' . $ndn20_discount_message . '</div>';
			// }
		?>

		<div class="price-container">
			<?php if ( wc_memberships_user_has_member_discount( $product->get_ID() ) ) : ?>
				<p class="sale-info"><span class="regular-price">$<?php echo $product->get_regular_price() ?></span> <?php show_olive_oil_club_discount_message(); ?></p>
			<?php elseif ( $product->is_on_sale() ) : ?>
				<?php
					// Calculate discount percentage
					$discount_percentage = ( 1 - $product->get_price() / $product->get_regular_price() ) * 100;
				?>
				<p class="sale-info"><span class="regular-price">$<?php echo $product->get_regular_price() ?></span> <?php echo round($discount_percentage); ?>% Off</p>
			<?php endif; ?>
			<p class="price">
				<?php echo $product_price; ?>
			</p>
		</div>
		<div class="buttons">
			<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />
			<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
			<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button btn btn-green"><?php _e( 'Add to Basket', 'domenicafiore' ); ?></button>
			<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
			<!-- Checkout Now Button -->
			<button class="btn btn-green df-checkout-now df-checkout-<?php echo $product->get_id(); ?>" type="button" data-url="/basket/?add-to-cart=<?php echo $product->get_id(); ?>&quantity=">
				<?php
					if ( $product_pre_order === 'yes' ) {
						_e( 'Pre-Order Now', 'domenicafiore' );
					} else {
						_e( 'Checkout Now', 'domenicafiore' );
					}
				?>
			</button>
			<script>
				// Initialize Checkout Now Button
				var df_checkout_now_button = document.getElementsByClassName("df-checkout-<?php echo $product->get_id(); ?>");
				console.log( df_checkout_now_button[0] );
				df_checkout_now_button[0].addEventListener("click", function(e){
					e.preventDefault;
					var this_form = e.target.closest('form.cart');
					var quantity = this_form.querySelector('.quantity .qty').value;
					var url = e.target.dataset.url;
					url += quantity;
					window.location.href = '<?php echo get_site_url(); ?>' + url;
				});
			</script>

			<?php echo do_shortcode('[ti_wishlists_addtowishlist]'); ?>
		</div>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
	<?php else:  ?>
		<!-- Out of stock -->
		<p><?php _e( 'Temporarily out of stock', 'domenicafiore' ); ?></p>
	<?php endif; ?>
	<?php endif; ?>
</div>

</div>

<script>
	jQuery(document).ready(function($){
		if ( $('.case-discount-notice').length ) {
			$('form.cart .quantity input[type=button]').on('click', (event) => {
				const discountThreshold = 6
				const messageContainer = $(event.target).closest('form.cart').find('.case-discount-notice')
				setTimeout( () => {
					let itemQuantity = $(event.target).parent().find('.input-text').val()
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
		}
	})
</script>
