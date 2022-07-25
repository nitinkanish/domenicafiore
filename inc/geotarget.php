<?php
  // * Backend setup for GeoTarget functions

  // Check if cart contains a product. Returns false if cart contains anything other than the specified product
  function cartOnlyContainsProduct($product_id) {
    if ( WC()->cart->get_cart_contents_count() == 0 )
      return false;

    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
      if ( $cart_item['product_id'] !== $product_id )
        return false;
    }

    return true;
  }

  function geotarget_js() {
    global $post;
    $post_slug = $post->post_name;
    $geo = \WPEngine\GeoIp::instance();
    $country_code = $geo->country();

    wp_enqueue_script( 'jsCookie', 'https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.2.1/js.cookie.min.js', array(), true );

    wp_enqueue_script( 'geotargetJs', get_stylesheet_directory_uri() . '/js/geotarget.js', array( 'jsCookie', 'jquery', 'child-understrap-scripts' ), null, true );
    wp_localize_script( 'geotargetJs', 'geotarget', array(
      'countryCode' => $country_code,
      'country' => $geo->countries[$country_code]['country'],
      'city' => $geo->city(),
      'page' => $post_slug,
      'cartPickupOnly' => cartOnlyContainsProduct(7026)
    ));
  }

  // Uncomment this to enable GeoTarget modal popups
  // 
  // add_action( 'wp_enqueue_scripts', 'geotarget_js' );
?>
