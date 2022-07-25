<?php

// Get the client IP address
function get_client_ip() {
  $ip_keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR');
  foreach ($ip_keys as $key) {
    if (array_key_exists($key, $_SERVER) === true) {
      foreach (explode(',', $_SERVER[$key]) as $ip) {
        // trim for safety measures
        $ip = trim($ip);
        // attempt to validate IP
        // if (validate_ip($ip)) {
        //     return $ip;
        // }

        if ( strpos( $ip, 'for=' ) !== false ) {
          $ip = str_replace('for=', '', $ip);
        }

        return $ip;
      }
    }
  }
  return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : false;
}

// Get user's country by IP address
function get_client_location($ip) {

  global $user_country;

  // Look up location by IP address
  $curl_handle = curl_init();
  $query_url = 'http://extreme-ip-lookup.com/json/' . $ip;

  curl_setopt($curl_handle, CURLOPT_URL, $query_url);
  curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
  curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);

  $query = curl_exec($curl_handle);
  $user_info = json_decode( $query );

  curl_close($curl_handle);

  // console_log($ip);
  // console_log($user_info->countryCode);

  if ( isset($user_info->countryCode) ) {
    $user_country = $user_info->countryCode;
    return $user_country;
  } else {
    return 'US';
  }

}

// Global $user_country variable:
$user_country = get_client_location( get_client_ip() );


// Set currency
add_filter('wcml_client_currency','set_client_currency', 10, 1);
function set_client_currency($client_currency) {
  global $user_country;

  // console_log("Running set_client_currency()");

  if ( isset($_COOKIE['df_currency']) ) {

    // console_log("cookie set");

    // Set currency from cookie
    return $_COOKIE['df_currency'];

  } elseif ( !isset($_COOKIE['df_currency']) ) {

    if ( $user_country == '' ) {
      $user_country = get_client_location( get_client_ip() );
    }

    // Set currency by $user_country
    if ( $user_country == 'CA' ) {
      // console_log("Setting currency to CAD");
      return 'CAD';

    } else {
      // console_log("Setting currency to USD");
      return 'USD';

    }

  }

}

// Change cookie after currecy switcher action
add_action( 'wcml_switch_currency', 'df_switch_client_currency', 10, 1 );
function df_switch_client_currency($new_currency) {
  ob_start();
    setcookie( 'df_currency', $new_currency, time()+60*60*24*30, '/' );
  ob_end_flush();
}


// Set Currency Cookies
add_action( 'init', 'set_currency_cookies' );
function set_currency_cookies() {

  global $user_country;
  $user_country = get_client_location( get_client_ip() );

  // console_log("Your IP: " . get_client_ip() . " (" . $user_country . ")");

  // Set Cookie
  if ( !isset($_COOKIE['df_currency']) ) {

    // console_log("Cookie not set");

    if ( $user_country == 'CA' ) {
      setcookie( 'df_currency', 'CAD', time()+60*60*24*30, '/' );

      // Refresh page if cookie value does not match WC currency
      if ( get_woocommerce_currency() !== 'CAD' ) {
        echo "<script language='javascript'>";
        echo "if ( navigator.cookieEnabled ) {";

          echo 'function getCookie(name) {';
            echo 'var value = "; " + document.cookie;';
            echo 'var parts = value.split("; " + name + "=");';
            echo 'if (parts.length == 2) return parts.pop().split(";").shift();';
          echo '}';

        echo '} else {';
        echo 'console.error("Cookies are not enabled on your browser.");';
        echo '}';
        echo "</script>";
      }

    } else {
      setcookie( 'df_currency', 'USD', time()+60*60*24*30, '/' );
    }

  } else {
    // If cookie is already set
  }

};

function console_log( $message ){
  echo '<script>';
  echo 'console.log('. json_encode($message) .')';
  echo '</script>';
}

?>
