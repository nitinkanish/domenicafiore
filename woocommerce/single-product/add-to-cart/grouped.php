<?php
/**
 * Grouped product add to cart
 *
 * THIS TEMPLATE IS A DUPLICATE OF grouped_with-product-details.php
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     4.8.0
 */

defined( 'ABSPATH' ) || exit;

global $product, $post;

do_action( 'woocommerce_before_add_to_cart_form' );

$quantites_required      = false;
$previous_post           = $post;
$grouped_product_columns = apply_filters( 'woocommerce_grouped_product_columns', array(
	'quantity',
	'label',
	'price',
), $product );
$child_count = count($grouped_products);

function is_holiday_product($product, $child_product, $product_name) {
	if ( $product->get_slug() === 'shop' ) {
		if ( $product_name === 'reserva' && $child_product->get_id() === 4861 )
			return true;
		if ( $product_name === 'novello' && $child_product->get_id() === 8231 )
			return true;
	}
	return false;
}

?>
<div class="row grouped">

	<?php if ( $product->get_slug() === 'shop' ) : ?>
		<div class="col-12">
			<!-- Holiday Product Page: Product Information -->
			<div class="product-text-columns row">
				<?php foreach ( $grouped_products as $grouped_product ) : $child = wc_get_product( get_post( $grouped_product->get_id() )->ID ); ?>
					<?php if ( is_holiday_product($product, $child, 'reserva') ) : ?>
						<div class="product-text-column col-6">
							<h5>Reserva</h5>
							<p>A complex oil with overtones of artichoke leaves and almonds, Reserva has robust notes of tomato and cooked fennel.</p>
							<p><span class="green-text">Best for:</span> finishing oil for grilled meats and fish.</p>
						</div>
					<?php elseif ( is_holiday_product($product, $child, 'novello') ) : ?>
						<div class="product-text-column col-6">
							<h5>Novello</h5>
							<p>Made from early harvest in October, Novello has bright notes of fresh-cut grass, chicory, tomato leaves and cardoon.</p>
							<p><span class="green-text">Best for:</span> vinaigrettes and dipping bread.</p>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>

	<?php
		foreach ( $grouped_products as $grouped_product ) :
			$post_object        = get_post( $grouped_product->get_id() );
			$quantites_required = $quantites_required || ( $grouped_product->is_purchasable() && ! $grouped_product->has_options() );
			$post               = $post_object; // WPCS: override ok.
			setup_postdata( $post );

			$child = wc_get_product( $post->ID );
			$child_product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
      $child_product_size = $child->get_attribute( 'size' );
      $child_product_price = get_woocommerce_currency_symbol() . $child->get_price() . ' ' . get_woocommerce_currency();
			$child_product_pre_order = get_post_meta( $child->get_id(), '_wc_pre_orders_enabled', true );
			$terms = wp_get_post_terms( $post->ID, 'product_cat' );
			$categories = [];
			foreach ( $terms as $term ) $categories[] = $term->slug;

			$save_for_later_shortcode = '[ti_wishlists_addtowishlist product_id="' . $post->ID . '"]';


	?>

	<div class="df-product-add-to-cart-module <?php if ( $child_count == 1 ) { echo 'col-12'; } elseif ( $child_count == 2 ) { echo 'col-6'; } elseif ( $child_count == 3 ) { echo 'col-6 col-sm-4'; } elseif ( $child_count == 4 ) { echo 'col-6 col-sm-3'; } elseif ( $child_count > 4 ) { echo 'col-6'; } ?>">
		<?php if ( $product->get_slug() !== 'shop' && get_field('show_grouped_product_column', $child->get_id()) ) : $product_column_content = get_field('grouped_product_column', $child->get_id()); ?>
			<div class="product-text-column">
				<h5><?php echo $product_column_content['product_title']; ?></h5>
				<p><?php echo $product_column_content['product_description']; ?></p>
			</div>
		<?php endif; ?>

		<div class="image-container">
			<img src="<?php echo $child_product_image[0]; ?>" width="50" alt="">
			<?php echo wc_get_stock_html( $grouped_product ); ?>
		</div>
		<?php if ( in_array( 'gifts', $categories ) ) : ?>
			<div class="description">
				<h3><?php echo $child->get_title(); ?></h3>
				<p><?php echo $post->post_excerpt; ?></p>
			</div>
		<?php endif; ?>
		<p class="size"><?php echo $child_product_size; ?></p>
		<form class="cart" action="<?php echo esc_url( get_permalink() ); ?>" method="post" enctype='multipart/form-data'>

			<?php
				if ( has_term( 'coming-soon', 'product_tag', $grouped_product->get_id() ) ) { ?>
					<?php _e( 'Coming Soon', 'domenicafiore' ); ?>
			<?php
				} elseif (  ! $grouped_product->is_purchasable()  ) {
					_e( 'This product is currently not available', 'domenicafiore' );
				} elseif ( $grouped_product->has_options() || ! $grouped_product->is_in_stock() ) {
					_e( 'Temporarily out of stock', 'domenicafiore' );
				} elseif ( $grouped_product->is_sold_individually() ) {
					echo '<input type="checkbox" name="' . esc_attr( 'quantity[' . $grouped_product->get_id() . ']' ) . '" value="1" class="wc-grouped-product-add-to-cart-checkbox" />';
				} else {
					do_action( 'woocommerce_before_add_to_cart_quantity' );
					woocommerce_quantity_input( array(
						'input_name'  => 'quantity[' . $grouped_product->get_id() . ']',
						'input_value' => isset( $_POST['quantity'][ $grouped_product->get_id() ] ) ? wc_stock_amount( wc_clean( wp_unslash( $_POST['quantity'][ $grouped_product->get_id() ] ) ) ) : 0, // WPCS: CSRF ok, input var okay, sanitization ok.
						'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 0, $grouped_product ),
						'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $grouped_product->get_max_purchase_quantity(), $grouped_product ),
					) );
					do_action( 'woocommerce_after_add_to_cart_quantity' );

					// Case of 6 Discount Message
					if ( !user_is_olive_oil_club_member() && product_is_eligible_for_case_discount( $grouped_product->get_id() ) ) {
						echo '<div class="case-discount-notice d-none">' . get_case_discount_message() . '</div>';
					}

					// Unique message for Novello di Notte
					// if ( $grouped_product->get_id() === 8058 ) {
					// 	$ndn20_discount_message = __( 'Discount codes for this product can be entered at checkout', 'domenicafiore' );
					// 	echo '<div class="ndn20-discount-notice">' . $ndn20_discount_message . '</div>';
					// }
				}
			?>

			<?php if ( !has_term( 'coming-soon', 'product_tag', $grouped_product->get_id() ) ) : ?>
			<div class="price-container">
				<?php if ( wc_memberships_user_has_member_discount( $child->get_ID() ) ) : ?>
					<p class="sale-info"><span class="regular-price">$<?php echo $child->get_regular_price() ?></span> <?php show_olive_oil_club_discount_message(); ?></p>
				<?php elseif ( $child->is_on_sale() ) : ?>
					<?php
						// Calculate discount percentage
						$discount_percentage = ( 1 - $child->get_price() / $child->get_regular_price() ) * 100;
					?>
					<p class="sale-info"><span class="regular-price">$<?php echo $child->get_regular_price() ?></span> <?php echo round($discount_percentage); ?>% Off</p>
				<?php endif; ?>
				<p class="price">
					<?php echo $child_product_price; ?>
				</p>
			</div>

			<div class="buttons">
				<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />
				<?php if ( $quantites_required && $grouped_product->is_purchasable() && $grouped_product->is_in_stock() ) : ?>
					<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
					<button type="submit" class="single_add_to_cart_button btn btn-green"><?php _e( 'Add to Basket', 'domenicafiore' ); ?></button>
					<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
					<!-- Checkout Now Button -->
					<button class="btn btn-green df-checkout-now df-checkout-<?php echo $post->ID ?>" type="button" data-url="/basket/?add-to-cart=<?php echo $post->ID; ?>&quantity=">
						<?php
							if ( $child_product_pre_order === 'yes' ) {
								_e( 'Pre-Order Now', 'domenicafiore' );
							} else {
								_e( 'Checkout Now', 'domenicafiore' );
							}
						?>
					</button>
					<script>
						// Initialize Checkout Now Button
						var df_checkout_now_button = document.getElementsByClassName("df-checkout-<?php echo $post->ID ?>");
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
				<?php endif; ?>
				<?php echo do_shortcode($save_for_later_shortcode); ?>
			</div>
			<?php endif; ?>
		</form>

	</div>

	<?php
		endforeach;
		$post = $previous_post; // WPCS: override ok.
		setup_postdata( $post );
	?>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>


	<?php if ( $product->get_slug() === 'shop' ) : ?>
		<!-- Holiday Product Page: Product Details -->
		<div class="col-12 holiday-product-details">
			<div class="df-product-details-table container-fluid">
				<div class="df-product-details-table-row row product-info">
					<?php foreach ( $grouped_products as $grouped_product ) : $child = wc_get_product( get_post( $grouped_product->get_id() )->ID ); ?>
						<div class="df-product-details-table-column col-6">
							<h5>Product Information</h5>
							<?php if ( is_holiday_product($product, $child, 'reserva') ) : ?>
								<p>This full-bodied oil is made with a blend of Leccino, Frantoio and Moraiolo olives. All the olives are hand harvested, pressed within four hours and blended to Domenica Fiore's signature taste profile within the exacting DOP Umbria Colli Orvietani standards. The DOP designation, which stands for Denominazione di Origine Protetta, or Protected Designation of Origin, means the oil is certified for using local ingredients and traditional production methods and is of the highest quality.</p>
							<?php elseif ( is_holiday_product($product, $child, 'novello') ) : ?>
								<p>Historically, the new, or novello, oil from the first olive harvest was only available to olive millers, who would savor it while the commercial oil was settling. Even today it is rare to find novello oil outside the country of origin because it is characterized by its extreme freshness. Because Domenica Fiore's first batch of olives of the season is pressed within four hours and then immediately packaged and dispatched, you can enjoy the bright, unfiltered flavor of this unique oil.</p>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="df-product-details-table-row row certifications">
					<?php foreach ( $grouped_products as $grouped_product ) : $child = wc_get_product( get_post( $grouped_product->get_id() )->ID ); ?>
						<div class="df-product-details-table-column col-6">
							<h5>Certifications</h5>
							<?php if ( is_holiday_product($product, $child, 'reserva') ) : ?>
								<div class="certification-logos">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/holiday/certifications/Canada_Organic.png">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/holiday/certifications/USDA_Organic.png">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/holiday/certifications/EU_Certification.png">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/holiday/certifications/DOP.png">
								</div>
							<?php elseif ( is_holiday_product($product, $child, 'novello') ) : ?>
								<div class="certification-logos">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/holiday/certifications/Canada_Organic.png">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/holiday/certifications/USDA_Organic.png">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/holiday/certifications/EU_Certification.png">
								</div>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="df-product-details-table-row row awards">
					<?php foreach ( $grouped_products as $grouped_product ) : $child = wc_get_product( get_post( $grouped_product->get_id() )->ID ); ?>
						<div class="df-product-details-table-column col-6">
							<h5>Recent Awards</h5>
							<?php if ( is_holiday_product($product, $child, 'reserva') ) : ?>
								<div class="award-logos">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/holiday/awards/NYIOOC_Gold_2020.png">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/holiday/awards/Athena_DoubleGold_2020.png">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/holiday/awards/EVO_IOOC_Gold_2020.png">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/holiday/awards/Olive_Japan_Gold_2020.png">
								</div>
							<?php elseif ( is_holiday_product($product, $child, 'novello') ) : ?>
								<div class="award-logos">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/holiday/awards/NYIOOC_Gold_2020.png">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/holiday/awards/Athena_Gold_2020.png">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/holiday/awards/EVO_IOOC_Gold_2020.png">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/holiday/awards/Olive_Japan_Gold_2020.png">
								</div>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="df-product-details-table-row row nutritional">
					<?php foreach ( $grouped_products as $grouped_product ) : $child = wc_get_product( get_post( $grouped_product->get_id() )->ID ); ?>
						<div class="df-product-details-table-column col-6">
							<h5>Nutritional</h5>
							<?php if ( is_holiday_product($product, $child, 'reserva') ) : ?>
								<div class="nutritional-info">
									<p>High in polyphenols<br>
										High in antioxidants<br>
										&nbsp;<br>
										<span class="green-text">Nutrition</span><br>
										Serving Size 1 Tbsp (15 ml/15 g)<br>
										Amount per Serving % Daily Value<br>
										Calories 120<br>
										Fat 14 g 21%<br>
										<span class="indent">Saturated / saturés 2 g 9%<br>
											+ Trans / trans 0 g<br>
											Polyunsaturated 1.5 g<br>
											Monounsaturated 10 g</span>
										Cholesterol 0 g 0%<br>
										Protein 0 g 0%<br>
										Sodium 0 mg 0%<br>
										Total Carbohydrate 0 g 0%
									</p>
								</div>
							<?php elseif ( is_holiday_product($product, $child, 'novello') ) : ?>
								<div class="nutritional-info">
									<p>
										High in polyphenols<br>
										High in antioxidants<br>
										&nbsp;<br>
										<span class="green-text">Nutrition</span><br>
										Serving Size 1 Tbsp (15 ml/15 g)<br>
										Amount per Serving % Daily Value<br>
										Calories 120<br>
										Fat 14 g 21%<br>
										<span class="indent">Saturated / saturés 2 g 9%<br>
										+ Trans / trans 0 g<br>
										Polyunsaturated 1.5 g<br>
										Monounsaturated 10 g</span>
										Cholesterol 0 g 0%<br>
										Protein 0 g 0%<br>
										Sodium 0 mg 0%<br>
										Total Carbohydrate 0 g 0%
									</p>
								</div>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

</div>


<script>
	jQuery(document).ready(function($){
		const discountThreshold = 6
		$('.df-product-add-to-cart-module').each( function() {
			let messageContainer = $(this).find('.case-discount-notice')
			if ( $(messageContainer).length ) {
				// Set visibility of Case Discount message based on quantity button click
				//
				$(this).find('.quantity input[type=button]').on('click', function(event) {
					setTimeout( function() {
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
			}
		} )
	})
</script>
