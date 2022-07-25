<?php
  $hero_image = get_sub_field('hero_image');
?>

<!-- Products repeater -->

<div class="container featured-products df-product-add-to-cart-module">
  <div class="row">
    <div class="col-12">
      <h2><?php the_sub_field('featured_products_headline'); ?></h2>
      <?php if ( get_field('sub_headline') ) : ?>
      <p class="sub-headline"><?php the_sub_field('sub_headline'); ?></p>
    <?php endif; ?>
    </div>
  </div>
  <?php if( have_rows('products') ): ?>
    <div class="row">
      <?php
        // loop through the rows of data
        while ( have_rows('products') ) : the_row();
        $product_obj = get_sub_field('product_select');
        $product = wc_get_product( $product_obj->ID );
        // $product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_obj ), 'single-post-thumbnail' );
        $product_image = get_sub_field('product_image');
        $product_url = get_permalink( $product->get_ID() );
        $product_price = get_woocommerce_currency_symbol() . $product->get_price() . ' ' . get_woocommerce_currency();
        $product_pre_order = get_post_meta( $product->get_id(), '_wc_pre_orders_enabled', true );
      ?>
      <div class="df-product-add-to-cart-module col-6 product-column">
        <div class="product-image">
          <a href="<?php echo $product_url; ?>">
            <img src="<?php echo $product_image; ?>" alt="">
          </a>
          <?php if ( $product->get_stock_quantity() != null && $product->get_stock_quantity() < 25 ):  ?>
            <!-- <div class="df-product-badge">
              <svg class="df-badge circle" width="60" height="60" viewBox="0 0 60 60">
                <path class="shape" d="M30,60A30,30,0,1,0,0,30,30,30,0,0,0,30,60"/>
              </svg>
              <p class="message"><?php //echo $product->get_stock_quantity(); ?> Left</p>
            </div> -->
          <?php elseif ( get_sub_field('show_badge') ) : ?>
            <div class="df-product-badge">
              <?php if ( get_sub_field('badge_type') == 'circle' ) : ?>
                <svg class="df-badge circle" width="60" height="60" viewBox="0 0 60 60">
                  <path class="shape" d="M30,60A30,30,0,1,0,0,30,30,30,0,0,0,30,60"/>
                </svg>
                <p class="message"><?php the_sub_field('badge_text'); ?></p>
              <?php elseif ( get_sub_field('badge_type') == 'wavy' ) : ?>
                <svg class="df-badge star" width="57.52" height="60" viewBox="0 0 57.52 60">
                  <path class="shape" d="M32.71.88,37,4a4.64,4.64,0,0,0,2.71.88h5.25A4.62,4.62,0,0,1,49.31,8l1.62,5a4.63,4.63,0,0,0,1.68,2.31l4.25,3.08a4.62,4.62,0,0,1,1.67,5.16l-1.62,5a4.66,4.66,0,0,0,0,2.86l1.62,5a4.62,4.62,0,0,1-1.67,5.16l-4.25,3.08A4.63,4.63,0,0,0,50.93,47l-1.62,5a4.62,4.62,0,0,1-4.39,3.19H39.67A4.64,4.64,0,0,0,37,56l-4.25,3.09a4.62,4.62,0,0,1-5.42,0L23,56a4.64,4.64,0,0,0-2.71-.88H15.08A4.62,4.62,0,0,1,10.69,52L9.07,47a4.63,4.63,0,0,0-1.68-2.31L3.14,41.58a4.62,4.62,0,0,1-1.67-5.16l1.62-5a4.66,4.66,0,0,0,0-2.86l-1.62-5a4.62,4.62,0,0,1,1.67-5.16l4.25-3.08A4.63,4.63,0,0,0,9.07,13l1.62-5a4.62,4.62,0,0,1,4.39-3.19h5.25A4.64,4.64,0,0,0,23,4L27.29.88a4.62,4.62,0,0,1,5.42,0" transform="translate(-1.24 0)"/>
                </svg>
                <p class="message"><?php the_sub_field('badge_text'); ?></p>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
		   <p>

		  <?php $quick_view_shortcode = '[yith_quick_view product_id=" ' . $product->get_ID() . '"]';
echo do_shortcode( $quick_view_shortcode );

			?>
		  </p>
        <p class="product-description"><?php the_sub_field('product_description'); ?></p>
        <div class="price-container">
          <?php if ( wc_memberships_user_has_member_discount( $product->get_ID() ) ) : ?>
            <p class="sale-info"><span class="regular-price">$<?php echo $product->get_regular_price() ?></span> <?php show_olive_oil_club_discount_message(); ?></p>
          <?php elseif ( $product->is_on_sale() ) : ?>
            <?php $discount_percentage = ( 1 - $product->get_price() / $product->get_regular_price() ) * 100; ?>
            <p class="sale-info"><span class="regular-price">$<?php echo $product->get_regular_price() ?></span> <?php echo round($discount_percentage); ?>% Off</p>
          <?php endif; ?>
          <p class="price">
            <?php echo $product_price; ?>
          </p>
        </div>
        <div class="product-buttons">
          <a class="btn btn-grey" href="<?php echo $product_url; ?>"><?php _e( 'Learn More', 'domenicafiore' ); ?></a>
          <?php if ( !$product->is_type('grouped') ) : ?>
          <a class="btn btn-green" href="<?php echo do_shortcode('[add_to_cart_url id=' . $product->get_ID() . ']') ?>">
            <?php
              if ( $product_pre_order === 'yes' ) {
                _e( 'Pre-Order Now', 'domenicafiore' );
              } else {
                _e( 'Add to Basket', 'domenicafiore' );
              }
            ?>
          </a>
          <?php endif; ?>
        </div>
      </div>
      <?php
        wp_reset_postdata();
        endwhile;
      ?>
    </div>
  <?php
    else :
      // no rows found
    endif;
  ?>
  <div class="row">
    <div class="col">
      <a class="btn btn-black shop-all-btn" href="<?php echo get_permalink( get_page_by_path( 'shop' ) ); ?>"><?php _e( 'Shop All Products', 'domenicafiore' ); ?></a>
    </div>
  </div>
</div>
