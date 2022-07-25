<div class="row single">
  <?php
    global $product;
    $product_size = $product->get_attribute( 'size' );
    $product_price = $product->get_price();
  ?>

  <div class="col-12">
    <p class="size"><?php echo $product_size; ?></p>
    <p>[add to cart interface here]</p>
    <p class="price">$<?php echo $product_price; ?></p>
    <div class="buttons">
      <a class="btn btn-grey" href="#olio-info">Learn More</a>
      <a class="btn btn-green" href="<?php echo do_shortcode('[add_to_cart_url id=' . $product->get_ID() . ']') ?>"><?php _e( 'Add to Basket', 'domenicafiore' ); ?></a>
    </div>
  </div>
</div>
