<?php
/**
 * Mix and Match Item Product Title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/mnm/mnm-product-title.php.
 *
 * HOWEVER, on occasion WooCommerce Mix and Match will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  Kathy Darling
 * @package WooCommerce Mix and Match/Templates
 * @since   1.0.0
 * @version 1.9.0
 */
if ( ! defined( 'ABSPATH' ) ){
	exit; // Exit if accessed directly
}
?>
<?php echo ! $mnm_item->is_type( 'variation' ) && $mnm_item->is_visible() ? '<a href="' . $mnm_item->get_permalink() . '" target="_blank">' . df_get_product_name( $mnm_product->get_ID() ) . '</a>' : df_get_product_name( $mnm_product->get_ID() ); ?>
