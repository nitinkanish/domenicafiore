<?php
function menu_location_setup() {
  register_nav_menus( array(
    'main-shop-premium-oils'      => __( 'Main/Shop/Premium Olive Oils' ),
    'main-shop-everyday-oils'     => __( 'Main/Shop/Everyday Olive Oils' ),
    'main-shop-all-premium-oils'  => __( 'Main/Shop/All Premium Oils' ),
    'main-shop-tomato-sauces'     => __( 'Main/Shop/Tomato Sauces' ),
    'main-shop-vinegars'          => __( 'Main/Shop/Vinegars' ),
    'main-shop-honey'             => __( 'Main/Shop/Honey' ),
    'main-shop-gift-baskets'      => __( 'Main/Shop/Gift Baskets' ),
    'main-shop-olive-oil-club'    => __( 'Main/Shop/Olive Oil Club' ),
    'main-shop-account'           => __( 'Main/Shop/Account' ),
    'main-company-about'          => __( 'Main/Company/About' ),
    'main-company-second'         => __( 'Main/Company/Second' ),
    'main-company-third'          => __( 'Main/Company/Third' ),
    'main-company-fourth'         => __( 'Main/Company/Fourth' ),
    'main-company-fifth'          => __( 'Main/Company/Fifth' ),
    'footer-shop'                 => __( 'Footer Shop' ),
    'footer-company'              => __( 'Footer Company' ),
    'footer-customer'             => __( 'Footer Customer' ),
    'footer-privacy'              => __( 'Footer Privacy' )
  ) );
}
add_action( 'after_setup_theme', 'menu_location_setup' );
?>
