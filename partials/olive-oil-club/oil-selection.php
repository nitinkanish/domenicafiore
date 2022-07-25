<?php

  /**
   * Hook Woocommerce_before_single_product.
   *
   * @hooked wc_print_notices - 10
   */
   // Note: this was causing the page to crash due to a conflict with the "WooCommerce Country Restrictions - Advanced Pro" plugin
   // do_action( 'woocommerce_before_single_product' );

  if ( post_password_required() ) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
  }

  $user_id = get_current_user_id();
  $current_user = wp_get_current_user();
?>

<div class="container oil-selection">
  <div class="row">
    <div class="col-12">
      <?php if ( wc_memberships_is_user_active_member( $user_id, 'olive-oil-club' ) ) : ?>
        <h4><?php sprintf( __( 'Welcome Back, %s', 'domenicafiore' ), $current_user->display_name ); ?></h4>
      <?php endif; ?>

      <h2><?php _e( 'Select Your Oils', 'domenicafiore' ); ?></h2>
      <p><?php _e( 'To complete your Olive Oil Club registration please select your six yearly 500-mL bottles of premium oils.', 'domenicafiore' ); ?></p>
    </div>
  </div>
</div>

<div class="df-mnm-product-container">

  <?php

    global $user_country;

    // Show specific versions of this product for specific shop currencies
    if ( get_woocommerce_currency() === "CAD" ) {
      $ooc_product_id = 2003;
    } else {
      $ooc_product_id = 573;
    }

    $args = array(
      'post_type' => 'product',
      'p' => $ooc_product_id
      );
    $product_query = new WP_Query( $args );
    if ( $product_query->have_posts() ) {
      while ( $product_query->have_posts() ) : $product_query->the_post();
    ?>

      <div class="summary entry-summary">
        <?php
          /**
           * Hook: Woocommerce_single_product_summary.
           *
           * @hooked woocommerce_template_single_title - 5
           * @hooked woocommerce_template_single_rating - 10
           * @hooked woocommerce_template_single_price - 10
           * @hooked woocommerce_template_single_excerpt - 20
           * @hooked woocommerce_template_single_add_to_cart - 30
           * @hooked woocommerce_template_single_meta - 40
           * @hooked woocommerce_template_single_sharing - 50
           * @hooked WC_Structured_Data::generate_product_data() - 60
           */
          do_action( 'woocommerce_single_product_summary' );
        ?>
      </div>

      <?php
        /**
         * Hook: woocommerce_after_single_product_summary.
         *
         * @hooked woocommerce_output_product_data_tabs - 10
         * @hooked woocommerce_upsell_display - 15
         * @hooked woocommerce_output_related_products - 20
         */
        do_action( 'woocommerce_after_single_product_summary' );
      ?>
    </div>

    <?php do_action( 'woocommerce_after_single_product' ); ?>

  <?php
      endwhile;
    } else {
      echo __( 'No products found' );
    }
    wp_reset_postdata();
  ?>
