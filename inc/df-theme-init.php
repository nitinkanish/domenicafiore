<?php

// Customize login screen
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
          background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/df-logo-login@2x.png);
      		height:130px;
      		width:125px;
      		background-size: 130px 125px;
      		background-repeat: no-repeat;
        	padding-bottom: 0px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );


if ( ! function_exists( 'understrap_remove_scripts' ) ) {
  function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
  }
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );


if ( ! function_exists( 'theme_enqueue_styles' ) ) {
  function theme_enqueue_styles() {
  	// Get the theme data
  	$the_theme = wp_get_theme();
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'jquery');
  	wp_enqueue_script( 'popper-scripts', get_stylesheet_directory_uri() . '/js/popper.min.js', array(), false);
    wp_enqueue_script( 'breakpoints-js', get_stylesheet_directory_uri() . '/js/breakpoints.min.js', array(), true);
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
    // wp_enqueue_script( 'jsCookie', 'https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.2.1/js.cookie.min.js', array(), true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
    }

    // JS CDNs
    wp_enqueue_script( 'font_awesome', 'https://use.fontawesome.com/releases/v5.0.6/js/all.js', null, null, true );

    // Footer scripts
    wp_enqueue_script( 'footer-scripts', get_stylesheet_directory_uri() . '/js/footer-scripts.js', array('jquery','breakpoints-js'), '1.0', true );
  }
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );


// Admin CSS
function theme_enqueue_admin_styles() {
  $the_theme = wp_get_theme();
  wp_enqueue_style( 'child-understrap-admin-styles', get_stylesheet_directory_uri() . '/css/df-admin-styles.min.css', array(), $the_theme->get( 'Version' ) );
}
add_action( 'admin_enqueue_scripts', 'theme_enqueue_admin_styles' );


/* Modify the read more link on the_excerpt() */
function set_excerpt_length($length) {
  return 50;
}
add_filter('excerpt_length', 'set_excerpt_length');



// Replaces the excerpt "Read More" text by a link
function understrap_all_excerpts_get_more_link( $post_excerpt ) {

  return $post_excerpt . ' [...]<p><a class="btn btn-grey" href="' . esc_url( get_permalink( get_the_ID() )) . '">' . __( 'View',
  'understrap' ) . '</a></p>';
}


// General function for getting items from a specific menu
function df_get_menu_items($menu_name){
    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
        $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
        return wp_get_nav_menu_items($menu->term_id);
    }
}



// Custom Hooks
function df_shop_message() {
   do_action( 'df_shop_message' );
}

add_action( 'df_shop_message', 'wc_print_notices', 9 );



// Custom Widget Areas
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Currency Switcher Widget',
    'before_widget' => '<div class = "currency-switcher-widget">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
    'id' => 'currency-switcher-widget'
  )
);


// Custom function for AutomateWoo -- Handle membership renewal
function df_ooc_set_renewal( $workflow ) {
  global $wpdb;
	// retrieve the workflow data from the data layer
	$customer = $workflow->data_layer()->get_customer();
  $customer_id = $customer->get_user_id();
  $membership_renewal_plan_id = 1798;

  // // The data layer will return a valid data item or false
	if ( ! $customer ) {
		return;
	}

  if ( ! function_exists( 'wc_memberships' ) ) {
    return;
  }

  $args = array(
    'plan_id' => $membership_renewal_plan_id,
    'user_id' => $customer_id,
  );

  // If the created membership is not 'active', change the membership status directly in the database
  if ( wc_memberships_create_user_membership( $args, 'create' )->status !== 'wcm-active' ) {

    $wpdb->update('wp_posts',
      array('post_status' => 'wcm-active'),
      array('post_parent' => $membership_renewal_plan_id,
        'post_author' => $customer_id)
    );
  }
}

// Product Title:
// Returns "product_display_name" if it is set;
// Otherwise it returns the product post title
function df_get_product_name( $product_id ) {
  $product_display_name = get_post_meta( $product_id, 'product_display_name' );

  if ( isset( $product_display_name[0] ) ) {
    $output = $product_display_name[0];
  } else {
    $output = get_the_title( $product_id );
  }

  return $output;
}


// Customize permalink structure for Search queries
function df_change_search_url() {
  if ( is_search() && ! empty( $_GET['s'] ) ) {
    wp_redirect( home_url( "/search/" ) . urlencode( get_query_var( 's' ) ) );
    exit();
  }
}
add_action( 'template_redirect', 'df_change_search_url' );



function df_the_posts_navigation() {
  the_posts_pagination(
    array(
      'mid_size'  => 2,
      'prev_text' => '&laquo;',
      'next_text' => '&raquo;',
    )
  );
}


// Squelch certain warnings
function warning_squelch_wpe(int $errno , string $errstr , string $errfile , int $errline , array $errcontext) {
  if(strstr($errstr, "expected to be a reference")) {
    return true; // squelch matching warnings
  }
  // allow normal handling for non-matching warnings
  return false;
}
set_error_handler("warning_squelch_wpe", E_WARNING);


function user_is_olive_oil_club_member() {
  $user_id = get_current_user_id();
  $membership_plan_id = 6229;
  $old_membership_plan_id = 572;

  if ( wc_memberships_is_user_active_member( $user_id, $old_membership_plan_id ) || wc_memberships_is_user_active_member( $user_id, $membership_plan_id ) ) {
    return true;
  } else {
    return false;
  }
}


function show_olive_oil_club_discount_message() {
  $user_id = get_current_user_id();
  $membership_plan_id = 6229;
  $old_membership_plan_id = 572;
  $message = '';

  if ( wc_memberships_is_user_active_member( $user_id, $old_membership_plan_id ) ) {
    $message = _e( '20% Off (Olive Oil Club)', 'domenicafiore' );
  } elseif ( wc_memberships_is_user_active_member( $user_id, $membership_plan_id ) ) {
    $message = _e( '10% Off (Olive Oil Club)', 'domenicafiore' );
  }

  return $message;
}


//Page Slug Body Class
function add_slug_body_class( $classes ) {
  global $post;
  if ( isset( $post ) ) {
    $classes[] = $post->post_type . '-' . $post->post_name;
  }
  return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );
