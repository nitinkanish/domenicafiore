<?php
/**
 * Checkout login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

global $current_user;
?>
	<div class="card account">
		<div class="card-header" id="checkout-accordion-login-header">
			<h5 class="mb-0">
        <button class="btn btn-accordion" data-target="#checkout-accordion-login-collapse" aria-expanded="<?php if ( is_user_logged_in() ) { echo 'false'; } else { echo 'true'; } ?>" aria-controls="checkout-accordion-login-collapse">
					<span class="text">1. <?php _e( 'Account', 'domenicafiore' ); ?> <?php if ( is_user_logged_in() ) { echo "(Signed In)"; } ?></span>
					<div class="collapse-arrow"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/collapse-arrow.svg" width="16"></div>
        </button>
    	</h5>
		</div>
		<div class="df-accordion-collapse collapse <?php if ( !is_user_logged_in() ) { echo "show"; } ?>" id="checkout-accordion-login-collapse" aria-labelledby="checkout-accordion-login-header">
			<div class="card-body">
				<?php if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) : ?>
					<p><?php _e( 'Signed in as', 'domenicafiore' ); ?> <?php echo $current_user->display_name; ?></p>
					<a class="btn btn-green" href="<?php echo wc_get_page_permalink( 'account' ); ?>"><?php _e( 'Your Account', 'domenicafiore' ); ?></a>
					<a class="btn btn-grey" href="<?php echo wp_logout_url( 'basket' ); ?>">Log Out</a>
				<?php else :
					$info_message  = apply_filters( 'woocommerce_checkout_login_message', __( 'Returning customer', 'domenicafiore' ) );
					echo '<h3>' . $info_message . '</h3>';
				?>
					<div class="form-container">
						<form class="df-form df-login" method="post">
							<?php do_action( 'woocommerce_login_form_start' ); ?>
							<div class="form-group">
								<input type="text" class="form-control" name="username" id="username" placeholder="<?php esc_html_e( 'Username / Email*', 'domenicafiore' ); ?>" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
							</div>

							<div class="form-group">
								<input class="form-control" type="password" name="password" id="password" placeholder="<?php esc_html_e( 'Password*', 'domenicafiore' ); ?>" />
							</div>

							<?php do_action( 'woocommerce_login_form' ); ?>

							<div class="row">
								<div class="col lost-password-column">
									<div class="form-check">
										<input class="form-check-input" name="rememberme" type="checkbox" id="rememberme" value="forever" />
										<label><?php esc_attr_e( 'Remember Me', 'domenicafiore' ); ?></label>
									</div>
								</div>
								<div class="col submit-column">
									<div class="lost-password woocommerce-LostPassword lost_password">
										<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Forgot password?', 'domenicafiore' ); ?></a>
									</div>
									<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
									<button type="submit" class="btn btn-grey" name="login" value="<?php esc_attr_e( 'Sign In', 'domenicafiore' ); ?>"><?php esc_html_e( 'Sign In', 'domenicafiore' ); ?></button>
								</div>
							</div>
							<?php do_action( 'woocommerce_login_form_end' ); ?>
						</form>
					</div>
				<?php
					echo '<button class="btn btn-grey form-continue continue-as-guest" data-target="#checkout-accordion-billing-collapse" aria-controls="checkout-accordion-login-collapse">' . __( 'Checkout as Guest', 'domenicafiore' ) . '</button>';
					endif;
				?>
			</div>
		</div>
	</div>
<?php

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
