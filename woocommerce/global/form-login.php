<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( is_user_logged_in() ) {
	return;
}

?>
<form method="post" class="df-form df-login" <?php if ( $hidden ) echo 'style="display:none;"'; ?>>
  <input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />

	<?php do_action( 'woocommerce_login_form_start' ); ?>

	<?php if ( $message ) echo wpautop( wptexturize( $message ) ); ?>

  <div class="form-group">
    <input type="text" class="form-control" name="username" id="username" placeholder="<?php _e( 'Username / Email*', 'domenicafiore' ); ?>" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
  </div>

  <div class="form-group">
    <input class="form-control" type="password" name="password" id="password" placeholder="<?php _e( 'Password*', 'domenicafiore' ); ?>" />
  </div>

	<?php do_action( 'woocommerce_login_form' ); ?>

  <div class="row">
    <div class="col lost-password-column">
      <div class="form-check">
        <input name="rememberme" type="checkbox" id="rememberme" value="forever" />
        <label><?php _e( 'Remember me', 'domenicafiore' ); ?></label>
      </div>
    </div>
    <div class="col submit-column">
      <div class="lost-password">
        <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Forgot password?', 'domenicafiore' ); ?></a>
      </div>
      <?php wp_nonce_field( 'woocommerce-login', 'nonce_wc-login' ); ?>
      <button type="submit" class="btn btn-grey" name="login" value="<?php esc_attr_e( 'Sign In', 'domenicafiore' ); ?>"><?php esc_html_e( 'Sign In', 'domenicafiore' ); ?></button>
    </div>
  </div>

	<?php do_action( 'woocommerce_login_form_end' ); ?>

</form>
