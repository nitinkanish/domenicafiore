<?php
/**
 * Mix and Match Product Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/mnm.php.
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
 * @since   1.0.0
 * @version 1.3.0
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ){
	exit;
}

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}
?>

<?php
	if ( $product->has_available_children() ) :
		$product_price = get_woocommerce_currency_symbol() . $product->get_price() . ' ' . get_woocommerce_currency();
?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form method="post" enctype="multipart/form-data" class="mnm_form cart cart_group">

		<div class="container mnm_table">
			<div class="row">
				<?php
					foreach ( $product->get_available_children() as $mnm_item ) {

						/**
						 * 'woocommerce_mnm_item_details' action.
						 *
						 * @param WC_Product $mnm_item
						 * @since  1.3.0
						 *
						 * @hooked wc_mnm_template_child_item_details_wrapper_open 	-   0
						 * @hooked wc_mnm_template_child_item_thumbnail_open 		-  10
						 * @hooked wc_mnm_template_child_item_thumbnail 			-  20
						 * @hooked wc_mnm_template_child_item_section_close 		-  30
						 * @hooked wc_mnm_template_child_item_details_open 			-  40
						 * @hooked wc_mnm_template_child_item_title 				-  50
						 * @hooked wc_mnm_template_child_item_attributes			-  60
						 * @hooked wc_mnm_template_child_item_section_close 		-  70
						 * @hooked wc_mnm_template_child_item_quantity_open 		-  80
						 * @hooked wc_mnm_template_child_item_quantity 				-  90
						 * @hooked wc_mnm_template_child_item_section_close			- 100
						 * @hooked wc_mnm_template_child_item_details_wrapper_close	- 110
						 */
					?>
					<div class="col mnm_item">
					<?php
						do_action( 'woocommerce_mnm_child_item_details', $mnm_item, $product );
					?>
					</div>
					<?php
					}

					// foreach ( $product->get_available_children() as $mnm_product ) {
					// 	// Load the table row for each item.
					// 	wc_get_template(
					// 		'single-product/mnm/mnm-item.php',
					// 		array(
					// 			'product'     => $product,
					// 			'mnm_product' => $mnm_product
					// 		),
					// 		'',
					// 		WC_Mix_and_Match()->plugin_path() . '/templates/'
					// 	);
					// }
				?>
			</div>
		</div>

		<div class="mnm_cart cart" <?php echo $product->get_data_attributes(); ?>>

			<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

			<div class="mnm_button_wrap" style="display:block">
				<div class="mnm_message"><div class="mnm_message_content woocommerce-info"><?php echo wc_mnm_get_quantity_message( $product ); ?></div></div>

				<div class="mnm_price">
					<p class="sale-info"><span class="regular-price">$<?php echo $product->get_regular_price() ?></span></p>
					<p class="price"><?php echo $product_price; ?></p>
				</div>
				<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( WC_MNM_Core_Compatibility::get_id( $product ) ); ?>" />
				<button type="submit" class="single_add_to_cart_button mnm_add_to_cart_button btn btn-green"><?php _e( 'Purchase Membership', 'domenicafiore' ); ?></button>
			</div>
		</div>
		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php else : ?>

	<?php
	// Availability
	$availability      = $product->get_availability();
	$availability_html = empty( $availability[ 'availability' ] ) ? '' : '<p class="stock ' . esc_attr( $availability[ 'class' ] ) . '">' . esc_html( $availability[ 'availability' ] ) . '</p>';

	echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability[ 'availability' ], $product );
?>

<?php endif; ?>
