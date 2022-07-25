<?php
  global $product, $post;
  $previous_post = $post;

  // Exclude products tagged as 'oil-single'
  $grouped_args = array(
    'type' => 'grouped',
    'limit' => -1
  );
  $grouped_products_query = new WC_Product_Query( $grouped_args );
  $grouped_products = $grouped_products_query->get_products();

  // Exclude unpublished products
  $hidden_args = array(
    'status' => 'draft',
    'limit' => -1
  );
  $hidden_products_query = new WC_Product_Query( $hidden_args );
  $hidden_products = $hidden_products_query->get_products();

  // Exclude products with 'coming-soon' tag
  $coming_soon_product_args = array(
    'tag' => array( 'coming-soon' ),
  );
  $coming_soon_products_query = new WC_Product_Query( $coming_soon_product_args );
  $coming_soon_products = $coming_soon_products_query->get_products();

  $excluded_products = array_merge( $grouped_products, $hidden_products, $coming_soon_products );

  $excluded_product_ids = [];
  foreach ( $excluded_products as $excluded_product ) {
    array_push( $excluded_product_ids, $excluded_product->get_id() );
  }

  $related_products = wc_get_related_products( $product->get_ID(), 2, $excluded_product_ids );
?>

<?php if ( $related_products && $product->get_slug() !== 'black-friday-sale' ) : ?>
<div class="container people-also-viewed">
  <div class="row">
    <div class="col-12">
      <h3><?php _e( 'People Also Viewed', 'domenicafiore' ); ?></h3>
    </div>
  </div>
  <div class="row">
    <?php
      foreach ( $related_products as $related_product_id ) :
        $post_object        = get_post( $related_product_id );
  			$post               = $post_object; // WPCS: override ok.
  			setup_postdata( $post );

        $related_product = wc_get_product( $related_product_id );
        $related_product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $related_product_id ), 'single-post-thumbnail' );
        $related_product_size = $related_product->get_attribute( 'size' );
        $related_product_price = get_woocommerce_currency_symbol() . $related_product->get_price() . ' ' . get_woocommerce_currency();
        $related_product_pre_order = get_post_meta( $related_product->get_id(), '_wc_pre_orders_enabled', true );
    ?>
      <div class="df-product-add-to-cart-module col-6">
        <a href="<?php echo esc_url( get_permalink() ); ?>">
          <img src="<?php echo $related_product_image[0]; ?>" width="50" alt="">
        </a>
		   <p>
			 
		  <?php $quick_view_shortcode = '[yith_quick_view product_id=" ' . $related_product->get_ID() . '"]';
echo do_shortcode( $quick_view_shortcode );
			
			?>
		  </p>
        <h3>
          <a href="<?php echo esc_url( get_permalink() ); ?>">
            <?php echo df_get_product_name( $related_product->get_ID() ); ?>
          </a>
        </h3>
        <p class="size"><?php echo $related_product_size; ?></p>

        <?php if ( has_term( 'coming-soon', 'product_tag', $related_product->get_id() ) ) : ?>
          <p class="coming-soon"><?php _e( 'Coming Soon', 'domenicafiore' ); ?></p>
        <?php else : if ( $related_product->is_in_stock() ) : ?>
        <form class="cart" action="<?php echo esc_url( get_permalink() ); ?>" method="post" enctype='multipart/form-data'>

    			<?php
    				if ( ! $related_product->is_purchasable() ) {
              echo "<p>" . _e( 'This product is currently not available', 'domenicafiore' ) . "</p>";
              echo "</form>";
    					return;
            } elseif ( $related_product->has_options() || ! $related_product->is_in_stock() ) {
              echo "<p>" . _e( 'Temporarily out of stock', 'domenicafiore' ) . "</p>";
              echo "</form>";
    					return;
            } elseif ( $related_product->is_sold_individually() ) {
    					echo '<input type="checkbox" name="' . esc_attr( 'quantity[' . $related_product->get_id() . ']' ) . '" value="1" class="wc-grouped-product-add-to-cart-checkbox" />';
    				} else {
    					do_action( 'woocommerce_before_add_to_cart_quantity' );

    					woocommerce_quantity_input( array(
    						'input_name'  => 'quantity[' . $related_product->get_id() . ']',
    						'input_value' => isset( $_POST['quantity'][ $related_product->get_id() ] ) ? wc_stock_amount( wc_clean( wp_unslash( $_POST['quantity'][ $related_product->get_id() ] ) ) ) : 0, // WPCS: CSRF ok, input var okay, sanitization ok.
    						'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 0, $related_product ),
    						'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $related_product->get_max_purchase_quantity(), $related_product ),
    					) );

    					do_action( 'woocommerce_after_add_to_cart_quantity' );

              // Case of 6 Discount Message
    					if ( !user_is_olive_oil_club_member() && product_is_eligible_for_case_discount( $related_product->get_id() ) ) {
    						echo '<div class="case-discount-notice d-none">' . get_case_discount_message() . '</div>';
    					}
    				}
    			?>

          <div class="price-container">
      			<?php if ( wc_memberships_user_has_member_discount( $related_product->get_ID() ) ) : ?>
      				<p class="sale-info"><span class="regular-price">$<?php echo $related_product->get_regular_price() ?></span> <?php show_olive_oil_club_discount_message(); ?></p>
      			<?php elseif ( $related_product->is_on_sale() ) : ?>
      				<?php $discount_percentage = ( 1 - $related_product->get_price() / $related_product->get_regular_price() ) * 100; ?>
      				<p class="sale-info"><span class="regular-price">$<?php echo $related_product->get_regular_price() ?></span> <?php echo round($discount_percentage); ?>% Off</p>
      			<?php endif; ?>
      			<p class="price">
      				<?php echo $related_product_price; ?>
      			</p>
      		</div>

          <div class="buttons">
    				<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $related_product->get_id() ); ?>" />
  					<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
  					<button type="submit" class="single_add_to_cart_button btn btn-green"><?php _e( 'Add to Basket', 'domenicafiore' ); ?></button>
  					<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
            <!-- Checkout Now Button -->
  					<button class="btn btn-green df-checkout-now df-checkout-<?php echo $related_product->get_id(); ?>" type="button" data-url="/basket/?add-to-cart=<?php echo $related_product->get_id(); ?>&quantity=">
              <?php
                if ( $related_product_pre_order === 'yes' ) {
                  _e( 'Pre-Order Now', 'domenicafiore' );
                } else {
                  _e( 'Checkout Now', 'domenicafiore' );
                }
              ?>
            </button>
  					<script>
  						// Initialize Checkout Now Button
  						var df_checkout_now_button = document.getElementsByClassName("df-checkout-<?php echo $related_product->get_id() ?>");
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
        <?php else : ?>
          <p><?php _e( 'Temporarily out of stock', 'domenicafiore' ); ?></p>
        <?php endif; ?>
        <?php endif; ?>
      </div>
    <?php
      endforeach;
      $post = $previous_post; // WPCS: override ok.
  		setup_postdata( $post );
    ?>
    <?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
  </div>
</div>
<?php endif; ?>
