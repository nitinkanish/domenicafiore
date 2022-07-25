<?php

  /**
   * @snippet       New version of "wc_customer_bought_product" function (last 365 days)
   * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
   * @sourcecode    https://businessbloomer.com/?p=21885
   * @author        Rodolfo Melogli
   * @compatible    WC 2.6.14, WP 4.7.2, PHP 5.5.9
   */

  function wc_customer_bought_product_last_year( $customer_email, $user_id, $product_id ) {
      global $wpdb;
          $customer_data = array( $user_id );
          $customer_data[] = $customer_email;
          $customer_data = array_map( 'esc_sql', array_filter( array_unique( $customer_data ) ) );

          if ( sizeof( $customer_data ) == 0 ) {
              return false;
          }

          $result = $wpdb->get_col( "
              SELECT im.meta_value FROM {$wpdb->posts} AS p
              INNER JOIN {$wpdb->postmeta} AS pm ON p.ID = pm.post_id
              INNER JOIN {$wpdb->prefix}woocommerce_order_items AS i ON p.ID = i.order_id
              INNER JOIN {$wpdb->prefix}woocommerce_order_itemmeta AS im ON i.order_item_id = im.order_item_id
              WHERE p.post_status IN ( 'wc-completed', 'wc-processing' )
          AND p.post_date > '" . date('Y-m-d', strtotime('-365 days')) . "'
              AND pm.meta_key IN ( '_billing_email', '_customer_user' )
              AND im.meta_key IN ( '_product_id', '_variation_id' )
              AND im.meta_value != 0
              AND pm.meta_value IN ( '" . implode( "','", $customer_data ) . "' )
          " );
          $result = array_map( 'absint', $result );

      return in_array( absint( $product_id ), $result );
  }

?>
