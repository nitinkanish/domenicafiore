<?php
  remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

  remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
  remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );


  add_filter ( 'woocommerce_account_menu_items', 'df_add_wishlist_link' );
  function df_add_wishlist_link( $menu_links ){

    unset( $menu_links['downloads'] );
    unset( $menu_links['my_account_memberships'] );

  	$new = array( 'new_wishlist_link' => 'Saved Products' );

  	$menu_links = array_slice( $menu_links, 0, 1, true )
  	+ $new
  	+ array_slice( $menu_links, 1, NULL, true );

  	return $menu_links;
  }

  add_filter( 'woocommerce_get_endpoint_url', 'df_wishlist_link_hook_endpoint', 10, 4 );
  function df_wishlist_link_hook_endpoint( $url, $endpoint, $value, $permalink ){
  	if( $endpoint === 'new_wishlist_link' ) {
  		$url = site_url() . '/saved-products';
  	}
  	return $url;
  }

  // Custom Empty Cart message
  add_filter( 'wc_empty_cart_message', 'custom_wc_empty_cart_message' );
  function custom_wc_empty_cart_message() {
    return esc_html__( 'Your basket is currently empty.', 'domenicafiore' );
  }


  /* CHECKOUT: DISABLE AUTOFOCUS ON FIRST NAME */
  function disable_autofocus_firstname($fields) {
    $fields['shipping']['shipping_first_name']['autofocus'] = false;
    $fields['billing']['billing_first_name']['autofocus'] = false;
    return $fields;
  }
  add_filter('woocommerce_checkout_fields', 'disable_autofocus_firstname');


  // WooCommerce Customize Checkout Fields
  add_filter( 'woocommerce_checkout_fields' , 'custom_rename_wc_checkout_fields' );
  function custom_rename_wc_checkout_fields( $fields ) {
    $fields['billing']['billing_first_name']['placeholder'] = esc_html__( 'First Name*', 'domenicafiore' );
    $fields['billing']['billing_last_name']['placeholder'] = esc_html__( 'Last Name*', 'domenicafiore' );
    $fields['billing']['billing_company']['placeholder'] = esc_html__( 'Company', 'domenicafiore' );
    $fields['billing']['billing_city']['placeholder'] = esc_html__( 'City*', 'domenicafiore' );
    $fields['billing']['billing_postcode']['placeholder'] = esc_html__( 'Zip / Postal Code*', 'domenicafiore' );
    $fields['billing']['billing_phone']['placeholder'] = esc_html__( 'Phone*', 'domenicafiore' );
    $fields['billing']['billing_email']['placeholder'] = esc_html__( 'Email*', 'domenicafiore' );

    $fields['shipping']['shipping_first_name']['placeholder'] = esc_html__( 'First Name*', 'domenicafiore' );
    $fields['shipping']['shipping_last_name']['placeholder'] = esc_html__( 'Last Name*', 'domenicafiore' );
    $fields['shipping']['shipping_company']['placeholder'] = esc_html__( 'Company', 'domenicafiore' );
    $fields['shipping']['shipping_city']['placeholder'] = esc_html__( 'City*', 'domenicafiore' );
    $fields['shipping']['shipping_postcode']['placeholder'] = esc_html__( 'Zip / Postal Code*', 'domenicafiore' );
    $fields['shipping']['shipping_phone']['placeholder'] = esc_html__( 'Phone*', 'domenicafiore' );
    $fields['shipping']['shipping_email']['placeholder'] = esc_html__( 'Email*', 'domenicafiore' );

    return $fields;
  }

  add_filter('woocommerce_default_address_fields','custom_address_fields');
  function custom_address_fields($fields) {
    $fields['address_1']['placeholder'] = esc_html__( 'Address*', 'domenicafiore' );
    $fields['address_2']['placeholder'] = esc_html__( 'Address (cont.)', 'domenicafiore' );
    $fields['country']['options'] = array(
      'option_1' => esc_html__( 'Country*', 'domenicafiore' )
    );

    return $fields;
  }

  // Re-order fields
  add_filter( 'woocommerce_checkout_fields', 'custom_move_checkout_fields' );
  function custom_move_checkout_fields( $fields ) {
  	$billing_order = array(
  		"billing_first_name",
  		"billing_last_name",
  		"billing_company",
  		"billing_address_1",
  		"billing_address_2",
      // "billing_message",
      "billing_email",
      "billing_city",
      "billing_state",
  		"billing_postcode",
  		"billing_country",
  		"billing_phone"
  	);
  	foreach($billing_order as $billing_field) {
  	    $billing_fields[$billing_field] = $fields["billing"][$billing_field];
  	}
  	$fields["billing"] = $billing_fields;

  	$shipping_order = array(
      "shipping_first_name",
  		"shipping_last_name",
  		"shipping_company",
  		"shipping_address_1",
  		"shipping_address_2",
      "shipping_email",
      "shipping_city",
      "shipping_state",
  		"shipping_postcode",
  		"shipping_country",
  		"shipping_phone"
  	);
  	foreach($shipping_order as $shipping_field) {
  	    $shipping_fields[$shipping_field] = $fields["shipping"][$shipping_field];
  	}
  	$fields["shipping"] = $shipping_fields;
  	return $fields;
  }

  add_action( 'woocommerce_after_checkout_billing_form', 'custom_billing_form_scripts' );
  function custom_billing_form_scripts() {
    wp_register_script( 'custom-billing-form-script', get_stylesheet_directory_uri() . '/js/checkout-billing-form-custom.js', array( 'jquery' ), WC_VERSION, TRUE );
    wp_localize_script( 'custom-billing-form-script', 'objectL10n', array(
      'contact_for_international_shipping' => esc_html__( 'Please <a href="/contact">contact us</a> for shipping outside of Canada and the US.', 'domenicafiore' ),
      'no_po_boxes' => esc_html__( 'Note that our shipper cannot ship to PO boxes.', 'domenicafiore' )
    ) );
    wp_enqueue_script('custom-billing-form-script');
  }

  add_filter( 'woocommerce_checkout_fields', 'custom_remove_checkout_fields' );
  function custom_remove_checkout_fields( $fields ) {
      unset( $fields['billing_company'] );
      return $fields;
  }


  add_action( 'wp_enqueue_scripts', 'df_enqueue_scripts_for_frontend', 99 );
  function df_enqueue_scripts_for_frontend(){
    $the_theme = wp_get_theme();
      if( is_checkout() ){
          // wp_deregister_script('wc-checkout');
          wp_register_script('checkout-custom', get_stylesheet_directory_uri() . '/js/checkout-custom.js', array( 'jquery', 'woocommerce', 'wc-country-select', 'wc-address-i18n' ), $the_theme->get( 'Version' ), TRUE);
          wp_enqueue_script('checkout-custom');
      }
  }


  // Enable WC Quantity Increment
  add_action( 'wp_enqueue_scripts', 'wcqi_enqueue_polyfill' );
  function wcqi_enqueue_polyfill() {
      wp_enqueue_script( 'wcqi-number-polyfill' );
  }


  // Show Trailing Zeros in Price
  add_filter( 'woocommerce_price_trim_zeros', 'wc_hide_trailing_zeros', 10, 1 );
  function wc_hide_trailing_zeros( $trim ) {
      return false;
  }

  // Exclude hidden products from search query
  add_action( 'pre_get_posts', 'search_query_fix' );
  function search_query_fix( $query = false ) {
    if(!is_admin() && is_search()){
      $query->set( 'tax_query', array(
  		array(
  			'taxonomy' => 'product_visibility',
  			'field'    => 'name',
  			'terms'    => 'exclude-from-search',
  			'operator' => 'NOT IN',
  		)
      ));
    }
  }


  // Prevent PO box shipping

  add_action('woocommerce_after_checkout_validation', 'deny_pobox_postcode');

  function deny_pobox_postcode( $posted ) {
    global $woocommerce;

    $address  = ( isset( $posted['shipping_address_1'] ) ) ? $posted['shipping_address_1'] : $posted['billing_address_1'];
    $postcode = ( isset( $posted['shipping_postcode'] ) ) ? $posted['shipping_postcode'] : $posted['billing_postcode'];

    $replace  = array(" ", ".", ",");
    $address  = strtolower( str_replace( $replace, '', $address ) );
    $postcode = strtolower( str_replace( $replace, '', $postcode ) );

    if ( strstr( $address, 'pobox' ) || strstr( $postcode, 'pobox' ) ) {
      wc_add_notice( sprintf( __( "Unfortunately, our shipping partners cannot ship to PO Boxes. Please provide an alternate address.") ) ,'error' );
    }
  }


  // When coupon code is applied, show discounted price on cart line items
  add_filter( 'woocommerce_cart_item_subtotal', 'show_coupon_item_subtotal_discount', 100, 3 );
  function show_coupon_item_subtotal_discount( $subtotal, $cart_item, $cart_item_key ){
    if( $cart_item['line_subtotal'] !== $cart_item['line_total'] ) {
        $subtotal = sprintf( '<del>%s</del> <ins>%s<ins>',  wc_price($cart_item['line_subtotal']), wc_price($cart_item['line_total']) );
    }
    return $subtotal;
  }


  /**
 * Show a message at the cart/checkout displaying
 * how much to go for free shipping.
 */
  // function my_custom_wc_free_shipping_notice() {
  //
  // 	if ( is_cart() && is_checkout() ) { // Remove partial if you don't want to show it on cart/checkout
  // 		return;
  // 	}
  //
  // 	$cart_total = WC()->cart->get_displayed_subtotal();
  //   $min_amount = 150; //Free Shipping threshold ($150)
  //
  // 	if ( WC()->cart->display_prices_including_tax() ) {
  // 		$cart_total = round( $cart_total - ( WC()->cart->get_discount_total() + WC()->cart->get_discount_tax() ), wc_get_price_decimals() );
  // 	} else {
  // 		$cart_total = round( $cart_total - WC()->cart->get_discount_total(), wc_get_price_decimals() );
  // 	}
  //
  //   if ( $cart_total > ($min_amount - 10) && $cart_total < $min_amount ) {
  //     $remaining = $min_amount - $cart_total;
  //     wc_add_notice( sprintf( 'Add %s more to get free shipping!', wc_price( $remaining ) ) );
  //   }
  //
  // }
  // add_action( 'get_header', 'my_custom_wc_free_shipping_notice' );


  function product_is_oil( $product_id ) {
    if ( has_term( array( 'olive-oil', 'premium-olive-oils', 'everyday-olive-oils' ), 'product_cat', $product_id ) ) {
      return true;
    } else {
      return false;
    }
  }

  // Case of 6 Discount

  function product_is_eligible_for_case_discount( $product_id ) {
    $case_discount_settings = get_field('case_of_6_oil_discount', 'option');
    $excluded_product_ids = $case_discount_settings['discount_message_excluded_products'];

    if ( product_is_oil($product_id) && !in_array( $product_id, $excluded_product_ids ) ) {
      return true;
    } else {
      return false;
    }
  }

  function get_case_discount_message() {
    $case_discount_settings = get_field('case_of_6_oil_discount', 'option');
    $message = $case_discount_settings['discount_popup_message'];

    return ( $message ) ? $message : false;
  }


  /**
   * Tiered Shipping Rates by Weight
   * Shows/hides shipping rates based on cart_contents_weight
   */
  add_filter( 'woocommerce_package_rates', 'df_woocommerce_tiered_shipping', 9999, 2 );
  function df_woocommerce_tiered_shipping( $rates, $package ) {

    // Cart contents less than 1.3 lbs
    if ( WC()->cart->cart_contents_weight <= 589.67 ) {
      if ( isset( $rates['flat_rate:8'] ) )
        unset( $rates['flat_rate:9'], $rates['flat_rate:10'], $rates['flat_rate:15'], $rates['flat_rate:16']);
    }

    // Cart contents up to 4 lbs
    elseif ( WC()->cart->cart_contents_weight <= 1814.37 ) {
      if ( isset( $rates['flat_rate:9'] ) )
        unset( $rates['flat_rate:8'], $rates['flat_rate:10'], $rates['flat_rate:15'], $rates['flat_rate:16'] );
    }

    // Cart contents up to 15 lbs
    elseif ( WC()->cart->cart_contents_weight <= 6803.89 ) {
      if ( isset( $rates['flat_rate:10'] ) )
        unset( $rates['flat_rate:8'], $rates['flat_rate:9'], $rates['flat_rate:15'], $rates['flat_rate:16'] );
    }

    // Cart contents up to 20 lbs
    elseif ( WC()->cart->cart_contents_weight <= 9071.85 ) {
      if ( isset( $rates['flat_rate:15'] ) )
        unset( $rates['flat_rate:8'], $rates['flat_rate:9'], $rates['flat_rate:10'], $rates['flat_rate:16'] );
    }

    // Cart contents over 20 lbs
    else {
      if ( isset( $rates['flat_rate:16'] ) )
        unset( $rates['flat_rate:8'], $rates['flat_rate:9'], $rates['flat_rate:10'], $rates['flat_rate:15'] );
    }

    return $rates;
  }


  /**
   * Gift Box Shipping
   * Hides other shipping methods if order qualifies for Gift Box Shipping
   */
  add_filter( 'woocommerce_package_rates', 'df_gift_box_shipping', 9999, 2 );
  function df_gift_box_shipping( $rates, $package ) {
    $gift_box_shipping_rate_id = '8115';

    if ( isset( $rates[$gift_box_shipping_rate_id] ) )
      unset( $rates['flat_rate:8'], $rates['flat_rate:9'], $rates['flat_rate:10'], $rates['flat_rate:15'], $rates['flat_rate:16']);

    return $rates;
  }


  // Pickup Orders -- Add text to order confirmation emails
  add_action( 'woocommerce_email_order_details', 'df_pickup_order_completed_email', 10, 4 );
  function df_pickup_order_completed_email( $order, $sent_to_admin, $plain_text, $email ) {

    // Only for "Customer Completed Order" email notification
    if( 'customer_completed_order' != $email->id && 'customer_processing_order' != $email->id ) return;

    $found = false;
    foreach($order->get_shipping_methods() as $value){
      $rate_title = $value->get_method_title(); // Get the shipping rate ID
      if ( $rate_title === 'Pick Up' ) {
        $found = true;
      }
    }

    if ($found) {
      echo '<p>Your order will be available for pick up on <b>April 8th</b> from <b>9am to 4pm</b> at <b>2012 McNicoll Avenue, Vancouver, BC.</b></p>';
      echo '<p>For other inquiries, please email info@domenicafiore.com</p>';
    }
  }


  // Feed Vancouver Promo - Add text to order confirmation emails
  // add_action( 'woocommerce_email_order_details', 'df_feed_vancouver_order_completed_email', 10, 4 );
  // function df_feed_vancouver_order_completed_email( $order, $sent_to_admin, $plain_text, $email ) {
  //
  //   // Only for "Customer Completed Order" email notification
  //   if( 'customer_processing_order' != $email->id ) return;
  //
  //   // echo '<pre>',print_r($order,1),'</pre>';
  //   $eligible_cities = array(
  //     'Vancouver',
  //     'Burnaby',
  //     'New Westminster',
  //     'Coquitlam',
  //     'Port Coquitlam',
  //     'Port Moody',
  //     'Surrey',
  //     'Richmond',
  //     'Delta',
  //     'White Rock',
  //     'North Vancouver',
  //     'West Vancouver',
  //     'Langley',
  //     'Abbotsford',
  //     'Pitt Meadows',
  //     'Maple Ridge',
  //     'Mission',
  //     'Chilliwack',
  //     'Hope',
  //     'Squamish',
  //     'Whistler',
  //     'Pemberton',
  //     'Gibsons',
  //     'Sechelt'
  //   );
  //   $product_is_applicable = false;
  //   $city_is_applicable = false;
  //   $show_feed_vancouver_message = false;
  //
  //   // Check for eligible products in order
  //   foreach ( $order->get_items() as $item_id => $item ) {
  //      $product_id = $item->get_product_id();
  //      $name = $item->get_name();
  //      if ( has_term( 'feed-vancouver-promo', 'product_cat', $product_id ) ) {
  //        $applicable_product = true;
  //      }
  //   }
  //
  //   // Check for eligible city in shipping address
  //   foreach ( $eligible_cities as $city ) {
  //     if ( $order->get_shipping_city() ) {
  //       if ( $order->get_shipping_city() == $city ) {
  //         $applicable_city = true;
  //       }
  //     } else {
  //       if ( $order->get_billing_city() == $city ) {
  //         $applicable_city = true;
  //       }
  //     }
  //   }
  //
  //   if ( $applicable_product && $applicable_city ) {
  //     $show_feed_vancouver_message = true;
  //   }
  //
  //   if ($show_feed_vancouver_message) {
  //     echo "<table cellpadding='5' cellspacing='0' border='0' style='color:#000000;margin-bottom:30px;background-color:#c3d600;'><tr><td>";
  //     echo "Thank you for your order. 50% of the eligible product purchases support The Guistra Foundation's Covid-19 Emergency Feeding Initiative.<br>";
  //     echo "<a href='https://domenicafiore.com/domenica-fiore-feeds-vancouver-campaign'>Read more here</a>";
  //     echo "</td></tr></table>";
  //   }
  // }


  // When Free Shipping, Pick Up and Olive Oil Club Free Shipping are available, only show those options
  function df_hide_shipping_when_free_is_available( $rates ) {
  	$free = array();
    $pick_up = array();
    $free_ooc = array();
  	foreach ( $rates as $rate_id => $rate ) {
  		if ( 'Free shipping over $150' === $rate->label ) {
  			$free[ $rate_id ] = $rate;
  		}
      if ( 'Pick Up' === $rate->label ) {
  			$pick_up[ $rate_id ] = $rate;
  		}
      if ( 'Olive Oil Club - Free Shipping' === $rate->label ) {
  			$free_ooc[ $rate_id ] = $rate;
  		}
  	}

    if ( !empty( $free_ooc ) )
      return $free_ooc;

    if ( !empty( $free ) ) {
      if ( !empty( $pick_up ) ) {
        return array_merge( $free, $pick_up );
      } else {
        return $free;
      }
    } else {
      return $rates;
    }
  }
  add_filter( 'woocommerce_package_rates', 'df_hide_shipping_when_free_is_available', 100 );


  /* WooCommerce Advanced Shipping plugin customizations */
  /* Match Subtotal minus Discounts */

  /**
   * Must match the subtotal amount minus the discount.
   *
   * @param bool $match
   * @param string $operator
   * @param mixed $value
   * @return bool
   */

  add_action( 'was_match_condition_subtotal_no_discount', 'was_match_condition_subtotal_no_discount', 10, 3 );
  function was_match_condition_subtotal_no_discount( $match, $operator, $value ) {
  	if ( ! isset( WC()->cart ) ) return;
  	$subtotal_no_discount = WC()->cart->subtotal - ( WC()->cart->get_cart_discount_total() + WC()->cart->get_cart_discount_tax_total() );
  	if ( '==' == $operator ) :
  		$match = ( $subtotal_no_discount == $value );
  	elseif ( '!=' == $operator ) :
  		$match = ( $subtotal_no_discount != $value );
  	elseif ( '>=' == $operator ) :
  		$match = ( $subtotal_no_discount >= $value );
  	elseif ( '<=' == $operator ) :
  		$match = ( $subtotal_no_discount <= $value );
  	endif;
  	return $match;
  }
  add_filter( 'was_conditions', 'was_conditions_add_subtotal_no_discount', 10, 1 );
  function was_conditions_add_subtotal_no_discount( $conditions ) {
  	$conditions['Cart']['subtotal_no_discount'] = 'Subtotal minus discount';
  	return $conditions;
  }
  add_filter( 'was_values', 'was_values_add_subtotal_no_discount', 10, 2 );
  function was_values_add_subtotal_no_discount( $values, $condition ) {
  	switch ( $condition ) {
  		case 'subtotal_no_discount':
  			$values['field'] = 'text';
  			break;
  	}
  	return $values;
  }
  add_filter( 'was_descriptions', 'was_descriptions_subtotal_no_discount' );
  function was_descriptions_subtotal_no_discount( $descriptions ) {
  	$descriptions['subtotal_no_discount'] = __( 'The subtotal cart amount, but minus the discounted amount.', 'woocommerce-advanced-shipping' );
  	return $descriptions;
  }


  // Promo Products
  //
  // add_action( 'was_match_condition_promo_products', 'was_match_condition_promo_products', 10, 3 );
  // function was_match_condition_promo_products( $match, $operator, $value ) {
  // 	if ( ! isset( WC()->cart ) ) return;
  //
  //   $promo_category = 'feed-vancouver-promo';
  //   $eligible_products_count = 0;
  //
  //   // Get all cart items with the promo category
  //   foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
  //     $product = $cart_item['data'];
  //     if ( has_term( $promo_category, 'product_cat', $product->id ) ) {
  //       $eligible_products_count += $cart_item['quantity'];
  //     }
  //   }
  //
  // 	if ( '==' == $operator ) :
  // 		$match = ( $eligible_products_count == $value );
  // 	elseif ( '!=' == $operator ) :
  // 		$match = ( $eligible_products_count != $value );
  // 	elseif ( '>=' == $operator ) :
  // 		$match = ( $eligible_products_count >= $value );
  // 	elseif ( '<=' == $operator ) :
  // 		$match = ( $eligible_products_count <= $value );
  // 	endif;
  //
  // 	return $match;
  // }
  // add_filter( 'was_conditions', 'was_conditions_add_promo_products', 10, 1 );
  // function was_conditions_add_promo_products( $conditions ) {
  // 	$conditions['Cart']['promo_products'] = 'Contains # of promo products';
  // 	return $conditions;
  // }
  // add_filter( 'was_values', 'was_values_add_promo_products', 10, 2 );
  // function was_values_add_promo_products( $values, $condition ) {
  // 	switch ( $condition ) {
  // 		case 'promo_products':
  // 			$values['field'] = 'text';
  // 			break;
  // 	}
  // 	return $values;
  // }
  // add_filter( 'was_descriptions', 'was_descriptions_promo_products' );
  // function was_descriptions_promo_products( $descriptions ) {
  // 	$descriptions['promo_products'] = __( 'Number of promo products in cart', 'woocommerce-advanced-shipping' );
  // 	return $descriptions;
  // }


  // Coupon Rule: di-notte code not applicable
  // to users who are active Olive Oil Club members
  //

  // Check for OOC membership if di-notte coupon code is used
  add_filter( 'woocommerce_coupon_is_valid', 'coupon_membership_check', 10, 2);
  function coupon_membership_check( $valid, $coupon ) {

    // The coupon slug
    $coupon_code_di_notte = 'dinotte10';

    // Invalid membership plan IDs
    $membership_plan_id = 6229;
    $old_membership_plan_id = 572;

    // The coupon code (the one entered by the user in /basket)
    $coupon_code = strtolower($coupon->get_code());

    if ( $coupon_code == $coupon_code_di_notte ) {
      if ( wc_memberships_is_user_active_member( $user_id, $old_membership_plan_id ) || wc_memberships_is_user_active_member( $user_id, $membership_plan_id ) ) {
        return false;
      }
    }

    return true;
  }

  // Check for quantity of di Notte in cart if di-notte coupon code is used
  // (coupon code applies for qty < 6)
  // add_filter( 'woocommerce_coupon_is_valid_for_product', 'filter_woocommerce_coupon_is_valid_for_product', 10, 4 );
  // function filter_woocommerce_coupon_is_valid_for_product($valid, $product, $coupon, $values){
  //   if ( $coupon->code !== 'dinotte10' ) {
  //     return $valid;
  //   }
  //
  //   if ( $values['product_id'] === 8058 ) {
  //
  //     if ( $values['quantity'] < 6 ) {
  //       $valid = true;
  //     } else {
  //       $valid = false;
  //     }
  //   }
  //
  //   return $valid;
  // }



  // Show error message if coupon code is invalid
  add_filter('woocommerce_coupon_error', 'coupon_membership_check_error_message', 10, 3);
  function coupon_membership_check_error_message( $err, $err_code, $coupon ) {

      // The coupon slug
      $coupon_code_di_notte = 'dinotte10';
      // Defined invalid membership plan IDs
      $membership_plan_id = 6229;
      $old_membership_plan_id = 572;

      $coupon_code = strtolower($coupon->get_code());

      if ( $coupon_code == $coupon_code_di_notte ) {
        // Error message for di-notte coupon, where user is an OOC member
        if ( wc_memberships_is_user_active_member( $user_id, $old_membership_plan_id ) || wc_memberships_is_user_active_member( $user_id, $membership_plan_id ) ) {
          if ( intval($err_code) === WC_COUPON::E_WC_COUPON_INVALID_FILTERED ) {
            $err = __( "Coupon code $coupon_code_di_notte is not valid for Olive Oil Club members, and has been removed", "domenicafiore" );
          }
        }
      }

      return $err;
  }



  // Make certain products not purchasable
  //
  add_filter( 'woocommerce_is_purchasable', 'filter_woocommerce_is_purchasable', 10, 2 );
  function filter_woocommerce_is_purchasable( $is_purchasable, $product ) {

    $is_purchasable = true;
    $user_geographic_region = getenv('HTTP_GEOIP_REGION');

    // Make an array of product IDs not purchasable for users outside of BC, AB, SK & MB
    //
    if ( !in_array( $user_geographic_region, array( 'BC', 'AB', 'SK', 'MB' ) ) ) {
      if ( in_array( $product->get_id(), array( 377, 362, 3311, 3314, 316, 351, 3320, 3317, 2676, 3301, 770, 768 ) ) ) {
        $is_purchasable = false;
      }
    }

    return $is_purchasable;
  };


  // Check to see if a product is in the cart (by product ID)
  //
  function df_product_is_in_cart($product_id) {
    $product_cart_id = WC()->cart->generate_cart_id( $product_id );
    if ( WC()->cart->find_product_in_cart( $product_cart_id ) ) {
      return true;
    } else {
      return false;
    }
  }


  // Add messages to order confirmation emails
  // add_action( 'woocommerce_email_order_details', 'df_customize_order_completed_email', 10, 4 );
  // function df_customize_order_completed_email( $order, $sent_to_admin, $plain_text, $email ) {
  //
  //   // Only for "Customer Completed Order" email notification
  //   if( 'customer_processing_order' != $email->id ) return;
  //
  //   $show_ndn2020_message = false;
  //
  //   // Check for specific product IDs in order
  //   foreach ( $order->get_items() as $item_id => $item ) {
  //      $product_id = $item->get_product_id();
  //      // Check for Novello di Notte 2020
  //      if ( $product_id === 8058 ) {
  //        $show_ndn2020_message = true;
  //      }
  //   }
  //
  //   if ($show_ndn2020_message) {
  //     echo "<table cellpadding='5' cellspacing='0' border='0' style='color:#000000;margin-bottom:30px;background-color:#c3d600;'><tr><td>";
  //     echo "Thank you for your order. Please note that the Novello di Notte 2020 is air shipped to North America in early November. Your complete order will be shipped at that time.";
  //     echo "</td></tr></table>";
  //   }
  // }


  // For grouped products, redirect users back to grouped product page after add to cart.
  //
  add_filter( 'woocommerce_add_to_cart_redirect', 'df_grouped_product_add_to_cart_redirect' );
  function df_grouped_product_add_to_cart_redirect( $url ) {
    $referring_product_page = wc_get_product( $_REQUEST['add-to-cart'] );

  	if ( ! isset( $_REQUEST['add-to-cart'] ) || ! is_numeric( $_REQUEST['add-to-cart'] ) ) {
  		return $url;
  	}

    if ( $referring_product_page->is_type('grouped') ) {
      $url = get_permalink( $_REQUEST['add-to-cart'] );
    }

  	return $url;
  }

// Refer a friend 
  //

function gens_raf_customer_email( $order, $sent_to_admin, $plain_text ) {
    $user_id = ( version_compare( WC_VERSION, '2.7', '<' ) ) ? $order->customer_user : $order->get_customer_id();
    if( ! empty( $user_id ) && ( $code = get_user_meta($user_id, "gens_referral_id", true) ) != '' ){
        if( $plain_text ){
            _e('Your referral code is: ','gens-raf') . $code;
        } else {
            echo '<p style="text-align:left;margin-top:10px;">Your referral code is: ' .get_home_url() .'?raf='. $code . '</p>';
	    echo '<p style="text-align:left;margin-top:10px;">Share it with your friends:</p>';
	    echo '<p style="text-align:left;margin-top:10px;">Share on <a href="http://www.facebook.com/share.php?u='.get_home_url() .'?raf='. $code .'">Facebook.</a> Share on <a href="https://twitter.com/intent/tweet?url='.get_home_url() .'?raf='. $code .'">Twitter.</a>. </p>';
        }
    }    
}
add_action('woocommerce_email_customer_details', 'gens_raf_customer_email', 30, 3 );

// Show shortcode in the thank you page
function show_referral_link(){
	echo "<h2>Refer a friend.</h2><p>Refer a friend and earn rewards. Give 10% and receive 10% when your friend uses the coupon.</p>";
	echo do_shortcode('[WOO_GENS_RAF_ADVANCE guest_text="You must be logged in."]');
}
add_action('woocommerce_thankyou','show_referral_link');

?>
