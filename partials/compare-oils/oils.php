<?php
  global $product, $post;
  $previous_post = $post;
  $oils_array = get_field('oils');

  do_action( 'woocommerce_before_add_to_cart_form' );
?>

<div class="container oils-container">
  <div class="row">
    <div class="col-12 oils-column">

      <!-- Oils Table -->
      <div class="oils-table">

        <div class="oils-table-row bottle-image-row">
          <?php while ( have_rows('oils') ) : the_row(); ?>
            <div class="oils-table-cell bottle-image">
              <img src="<?php the_sub_field('bottle_image'); ?>">
              <h2><?php the_sub_field('oil_name'); ?></h2>
            </div>
    			<?php endwhile; ?>
        </div>

        <div class="oils-table-row mobile-header-row d-sm-none">
          <h3><?php _e( 'Flavors', 'domenicafiore' ); ?></h3>
        </div>

        <div class="oils-table-row  comparison flavours">
          <?php while ( have_rows('oils') ) : the_row(); ?>
            <div class="oils-table-cell flavours">
              <h3 class="d-none d-sm-block"><?php _e( 'Flavors', 'domenicafiore' ); ?></h3>
              <p><?php the_sub_field('flavours'); ?></p>
            </div>
    			<?php endwhile; ?>
        </div>

        <div class="oils-table-row mobile-header-row d-sm-none">
          <h3><?php _e( 'Profile', 'domenicafiore' ); ?></h3>
        </div>

        <div class="oils-table-row  comparison profile">
          <?php while ( have_rows('oils') ) : the_row(); ?>
            <div class="oils-table-cell profile">
              <h3 class="d-none d-sm-block"><?php _e( 'Profile', 'domenicafiore' ); ?></h3>
              <p><?php the_sub_field('profile'); ?></p>
            </div>
    			<?php endwhile; ?>
        </div>

        <div class="oils-table-row mobile-header-row d-sm-none">
          <h3><?php _e( 'Pairing', 'domenicafiore' ); ?></h3>
        </div>

        <div class="oils-table-row  comparison pairing">
          <?php while ( have_rows('oils') ) : the_row(); ?>
            <div class="oils-table-cell pairing">
              <h3 class="d-none d-sm-block"><?php _e( 'Pairing', 'domenicafiore' ); ?></h3>
              <p><?php the_sub_field('pairing'); ?></p>
            </div>
    			<?php endwhile; ?>
        </div>

        <div class="oils-table-row mobile-header-row d-sm-none">
          <h3><?php _e( 'Color', 'domenicafiore' ); ?></h3>
        </div>

        <div class="oils-table-row  comparison Color">
          <?php while ( have_rows('oils') ) : the_row(); ?>
            <div class="oils-table-cell colour">
              <h3 class="d-none d-sm-block"><?php _e( 'Color', 'domenicafiore' ); ?></h3>
              <p><?php the_sub_field('colour'); ?></p>
            </div>
    			<?php endwhile; ?>
        </div>

        <div class="oils-table-row mobile-header-row d-sm-none">
          <h3><?php _e( 'Olives', 'domenicafiore' ); ?></h3>
        </div>

        <div class="oils-table-row  comparison olives">
          <?php while ( have_rows('oils') ) : the_row(); ?>
            <div class="oils-table-cell olives">
              <h3 class="d-none d-sm-block"><?php _e( 'Olives', 'domenicafiore' ); ?></h3>
              <p><?php the_sub_field('olives'); ?></p>
            </div>
    			<?php endwhile; ?>
        </div>

        <div class="oils-table-row mobile-header-row d-sm-none">
          <h3><?php _e( 'Certifications', 'domenicafiore' ); ?></h3>
        </div>

        <div class="oils-table-row  comparison certifications">
          <?php while ( have_rows('oils') ) : the_row(); ?>
            <div class="oils-table-cell certifications">
              <h3 class="d-none d-sm-block"><?php _e( 'Certifications', 'domenicafiore' ); ?></h3>
              <p><?php the_sub_field('certifications'); ?></p>
            </div>
    			<?php endwhile; ?>
        </div>
		  
		   <div class="oils-table-row mobile-header-row d-sm-none">
          <h3><?php _e( 'Polyphenol Count', 'domenicafiore' ); ?></h3>
        </div>

        <div class="oils-table-row  comparison poly">
          <?php while ( have_rows('oils') ) : the_row(); ?>
            <div class="oils-table-cell poly">
              <h3 class="d-none d-sm-block"><?php _e( 'Polyphenol Count', 'domenicafiore' ); ?></h3>
              <p><?php the_sub_field('polyphenol_count'); ?></p>
            </div>
    			<?php endwhile; ?>
        </div>


        <div class="oils-table-row product-add-row">

          <?php foreach ( $oils_array as $oil ) : ?>
            <div class="oils-table-cell product-add">
            <?php
              $oil_id = $oil['product_link'];
              $post_object = get_post( $oil['product_link'] );

              if ( $post_object ) :

                $post = $post_object; // WPCS: override ok.
                setup_postdata( $post );

                $child = wc_get_product( $post->ID );
                $child_product_size = $child->get_attribute( 'size' );
                $child_product_price = get_woocommerce_currency_symbol() . $child->get_price() . ' ' . get_woocommerce_currency();

                $save_for_later = sprintf( '[ti_wishlists_addtowishlist product_id="%1$s"]', $oil_id );
            ?>
              <div class="name d-sm-none"><?php echo $oil['oil_name']; ?></div>
              <!--<p class="size"><?php echo $child_product_size; ?></p>-->

              <?php if ( has_term( 'coming-soon', 'product_tag', $child->get_id() ) ) : ?>
                <p><?php _e( 'Coming Soon', 'domenicafiore' ); ?></p>
              <?php else : ?>
                <form class="cart" action="<?php echo esc_url( get_permalink() ); ?>" method="post" enctype='multipart/form-data'>

            			<?php
            				if ( ! $child->is_purchasable() ) { ?>
                      <p><?php _e( 'Not available', 'domenicafiore' ); ?></p>
                    <?php } elseif ( $child->has_options() || ! $child->is_in_stock() ) { ?>
                      <p><?php _e( 'Out of Stock', 'domenicafiore' ); ?></p>
            				<?php } elseif ( $child->is_sold_individually() ) {
            					echo '<input type="checkbox" name="' . esc_attr( 'quantity[' . $child->get_id() . ']' ) . '" value="1" class="wc-grouped-product-add-to-cart-checkbox" />';
            				} else {
            					do_action( 'woocommerce_before_add_to_cart_quantity' );

            					woocommerce_quantity_input( array(
            						'input_name'  => 'quantity[' . $child->get_id() . ']',
            						'input_value' => isset( $_POST['quantity'][ $child->get_id() ] ) ? wc_stock_amount( wc_clean( wp_unslash( $_POST['quantity'][ $child->get_id() ] ) ) ) : 0, // WPCS: CSRF ok, input var okay, sanitization ok.
            						'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 0, $child ),
            						'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $child->get_max_purchase_quantity(), $child ),
            					) );

            					do_action( 'woocommerce_after_add_to_cart_quantity' );
            				}
            			?>

            			<p class="price"><?php echo $child_product_price; ?></p>

                  <?php if ( $child->is_purchasable() && $child->is_in_stock() ) : ?>
            			<div class="buttons">
            				<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $child->get_id() ); ?>" />
          					<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
          					<button type="submit" class="single_add_to_cart_button btn btn-green"><?php echo esc_html( $child->single_add_to_cart_text() ); ?></button>
          					<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
            				<?php echo do_shortcode( $save_for_later ); ?>
            			</div>
                  <?php else : ?>
                  <div class="buttons">
            				<?php echo do_shortcode( $save_for_later ); ?>
            			</div>
                  <?php endif; ?>
            		</form>
              <?php endif; ?>
            <?php endif; ?>
            </div>
          <?php endforeach; ?>

        </div>

      </div>

    </div>
  </div>
</div>
<?php
  $post = $previous_post; // WPCS: override ok.
  setup_postdata( $post );
  do_action( 'woocommerce_after_add_to_cart_form' );
?>
