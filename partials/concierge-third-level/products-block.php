<?php
  global $product, $post;
  $previous_post = $post;
  $products_array = get_sub_field('products');
?>

<!-- Products repeater -->

<div class="container products-block df-product-add-to-cart-module">
  <?php if( have_rows('products') ): ?>
    <div class="row">

      <?php foreach ( $products_array as $product ) : ?>

      <?php
        // var_dump($product['product']);
        $product_id = $product['product'];
        $product_object = get_post( $product_id );

        if ( $product_object ) :

          $product_wc = wc_get_product( $product_id );
          $product_url = get_permalink( $product_id );
          $product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'full' );
          $product_size = $product_wc->get_attribute( 'size' );
          $product_price = get_woocommerce_currency_symbol() . $product_wc->get_price() . ' ' . get_woocommerce_currency();
          $post = $product_object;
          $product_pre_order = get_post_meta( $product_wc->get_id(), '_wc_pre_orders_enabled', true );
          $save_for_later = sprintf( '[ti_wishlists_addtowishlist product_id="%1$s"]', $product_id );

          setup_postdata( $post );
      ?>
        <div class="df-product-add-to-cart-module col-6 product-column">
          <div class="product-image">
            <a href="<?php echo $product_url; ?>">
              <img src="<?php echo $product_image[0]; ?>" alt="">
              <h3><?php echo df_get_product_name( $product_id ); ?></h3>
            </a>
            <p class="size"><?php echo $product_size; ?></p>
            <?php if ( $product_wc->get_stock_quantity() != null && $product_wc->get_stock_quantity() < 25 ):  ?>
              <div class="df-product-badge">
                <svg class="df-badge circle" width="60" height="60" viewBox="0 0 60 60">
                  <path class="shape" d="M30,60A30,30,0,1,0,0,30,30,30,0,0,0,30,60"/>
                </svg>
                <p class="message"><?php echo $product_wc->get_stock_quantity(); ?> Left</p>
              </div>
            <?php endif; ?>
          </div>


          <form class="cart" action="<?php echo esc_url( get_permalink() ); ?>" method="post" enctype='multipart/form-data'>

            <?php
              if ( ! $product_wc->is_purchasable() || $product_wc->has_options() || ! $product_wc->is_in_stock() ) { ?>

                <p><?php _e( 'Out of Stock', 'domenicafiore' ); ?></p>

              <?php } elseif ( $product_wc->is_sold_individually() ) {
                echo '<input type="checkbox" name="' . esc_attr( 'quantity[' . $product_wc->get_id() . ']' ) . '" value="1" class="wc-grouped-product-add-to-cart-checkbox" />';
              } else {
                do_action( 'woocommerce_before_add_to_cart_quantity' );

                woocommerce_quantity_input( array(
                  'input_name'  => 'quantity[' . $product_wc->get_id() . ']',
                  'input_value' => isset( $_POST['quantity'][ $product_wc->get_id() ] ) ? wc_stock_amount( wc_clean( wp_unslash( $_POST['quantity'][ $product_wc->get_id() ] ) ) ) : 0, // WPCS: CSRF ok, input var okay, sanitization ok.
                  'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 0, $product_wc ),
                  'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product_wc->get_max_purchase_quantity(), $product_wc ),
                ) );

                do_action( 'woocommerce_after_add_to_cart_quantity' );
              }
            ?>

            <div class="price-container">
              <?php if ( wc_memberships_user_has_member_discount( $product_wc->get_ID() ) ) : ?>
                <p class="sale-info"><span class="regular-price">$<?php echo $product_wc->get_regular_price() ?></span> <?php show_olive_oil_club_discount_message(); ?></p>
              <?php elseif ( $product_wc->is_on_sale() ) : ?>
                <?php $discount_percentage = ( 1 - $product_wc->get_price() / $product_wc->get_regular_price() ) * 100; ?>
                <p class="sale-info"><span class="regular-price">$<?php echo $product_wc->get_regular_price() ?></span> <?php echo round($discount_percentage); ?>% Off</p>
              <?php endif; ?>
              <p class="price">
                <?php echo $product_price; ?>
              </p>
            </div>

            <?php if ( $product_wc->is_purchasable() && $product_wc->is_in_stock() ) : ?>
            <div class="buttons">
              <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product_wc->get_id() ); ?>" />
              <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
              <button type="submit" class="single_add_to_cart_button btn btn-green"><?php echo esc_html( $product_wc->single_add_to_cart_text() ); ?></button>
              <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
              <!-- Checkout Now Button -->
    					<button class="btn btn-green df-checkout-now df-checkout-<?php echo $product_wc->get_id(); ?>" type="button" data-url="/basket/?add-to-cart=<?php echo $product_wc->get_id(); ?>&quantity=">
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
    						var df_checkout_now_button = document.getElementsByClassName("df-checkout-<?php echo $product_wc->get_id(); ?>");
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
              <?php echo do_shortcode( $save_for_later ); ?>
            </div>
            <?php else : ?>
            <div class="buttons">
              <?php echo do_shortcode( $save_for_later ); ?>
            </div>
            <?php endif; ?>
          </form>


        </div>

      <?php endif; ?>
      <?php endforeach; ?>

      <?php
        // wp_reset_postdata();
        // endwhile;
      ?>

    </div>
  <?php
    else :
      // no rows found
    endif;
  ?>
</div>
<?php
  $post = $previous_post; // WPCS: override ok.
  setup_postdata( $post );
  do_action( 'woocommerce_after_add_to_cart_form' );
?>
