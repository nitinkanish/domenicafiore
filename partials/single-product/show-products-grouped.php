<div class="row grouped">
  <?php
    foreach ( $children as $child_id ) {
      $child = wc_get_product( $child_id );
      $child_product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $child_id ), 'single-post-thumbnail' );
      $child_product_size = $child->get_attribute( 'size' );
      $child_product_price = $child->get_price();
  ?>

    <div class="col-6">
      <img src="<?php echo $child_product_image[0]; ?>" width="50" alt="">
      <p class="size"><?php echo $child_product_size; ?></p>
      <?php woocommerce_quantity_input(); ?>
      <p class="price">$<?php echo $child_product_price; ?></p>
      <div class="buttons">
        <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

    		<button type="submit" class="btn btn-green df-add-to-cart single_add_to_cart_button"><?php _e( 'Add to Basket', 'domenicafiore' ); ?></button>

    		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
        <a class="btn btn-grey" href="<?php echo do_shortcode('[add_to_cart_url id=' . $child_id . ']') ?>"><?php _e( 'Save for Later', 'domenicafiore' ); ?></a>
      </div>
    </div>

  <?php } ?>
</div>
