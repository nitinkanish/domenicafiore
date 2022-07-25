<?php
/**
 * The template for displaying all woocommerce pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package understrap
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );

?>

<?php
  $template_name = '\archive-product.php';
  $args = array();
  $template_path = '';
  $default_path = untrailingslashit( plugin_dir_path(__FILE__) ) . '\woocommerce';

    if ( is_singular( 'product' ) ) {

      woocommerce_content();

    // } elseif ( file_exists( $default_path . $template_name ) ) {
    //
    //   //For ANY product archive, Product taxonomy, product search or /shop landing page etc Fetch the template override;
    //   wc_get_template( $template_name, $args, $template_path, $default_path );

    }	else  {

      //If no archive-product.php template exists, default to catchall;
      // woocommerce_content( );
      wc_get_template( 'archive-product.php' );
    }
;?>

<?php get_footer(); ?>
