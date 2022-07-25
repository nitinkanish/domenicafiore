<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="row login-signup-row" id="customer_login">
	<div class="col-12 form-section-title">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/ooc-decorative-leaves@2x.png">
		<h2><?php _e( 'The Olive Oil Club', 'domenicafiore' ); ?></h2>
	</div>

	<!-- Join the Club form -->
	<div class="col-12 col-sm-6 join">
		<div class="form-container-outer">
			<div class="form-container">

				<h2><?php _e( 'Join the Club', 'domenicafiore' ); ?></h2>

				<form method="post" class="df-form df-register register">

					<?php do_action( 'woocommerce_register_form_start' ); ?>

					<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
						<div class="form-group">
							<input type="text" class="form-control woocommerce-Input woocommerce-Input--text" name="username" id="reg_username" placeholder="<?php esc_html_e( 'Username*', 'domenicafiore' ); ?>" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
						</div>
					<?php endif; ?>

					<div class="form-group">
						<input type="email" class="form-control woocommerce-Input woocommerce-Input--text" name="email" id="reg_email" placeholder="<?php esc_html_e( 'Email Address*', 'domenicafiore' ); ?>" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
					</div>

					<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
						<div class="form-group woocommerce-form-row">
							<input type="password" class="form-control woocommerce-Input woocommerce-Input--text" name="password" id="reg_password" placeholder="<?php esc_html_e( 'Password*', 'domenicafiore' ); ?>" />
						</div>
					<?php endif; ?>

					<?php do_action( 'woocommerce_register_form' ); ?>

					<div class="row terms-row">
						<div class="col terms-conditions-column">
							<div class="form-check">
								<input class="form-check-input" name="agree-to-terms" type="checkbox" id="agree-to-terms" value="yes" required />
								<label><a href="<?php echo get_permalink( get_page_by_path( 'terms-of-use' ) ); ?>"><?php esc_attr_e( 'I have read and accept the terms of use', 'domenicafiore' ); ?></a></label>
							</div>
						</div>
					</div>

					<p class="woocommerce-FormRow form-row button-row">
						<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
						<input type="submit" class="btn btn-green woocommerce-Button" name="register" value="<?php esc_attr_e( 'Sign Up', 'understrap' ); ?>" />
					</p>

					<?php do_action( 'woocommerce_register_form_end' ); ?>
				</form>

			</div>
		</div>
	</div>

	<!-- Member Sign-In form -->
	<div class="col-12 col-sm-6 sign-in">
		<div class="form-container-outer">
			<div class="form-container">
				<h2><?php _e( 'Member Sign-In', 'domenicafiore' ); ?></h2>
				<form class="df-form df-login woocommerce-form woocommerce-form-login login" method="post">

					<?php do_action( 'woocommerce_login_form_start' ); ?>
					<div class="form-group">
						<input type="text" class="form-control woocommerce-Input woocommerce-Input--text" name="username" id="username" placeholder="<?php esc_html_e( 'Email Address*', 'domenicafiore' ); ?>" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
					</div>

					<div class="form-group">
						<input class="form-control woocommerce-Input woocommerce-Input--text" type="password" name="password" id="password" placeholder="<?php esc_html_e( 'Password*', 'domenicafiore' ); ?>" />
					</div>

					<?php do_action( 'woocommerce_login_form' ); ?>

					<div class="row lost-password-row">
						<div class="col lost-password-column">
							<div class="form-check">
								<input class="form-check-input" name="rememberme" type="checkbox" id="rememberme" value="forever" />
								<label><?php esc_attr_e( 'Remember Me', 'domenicafiore' ); ?></label>
							</div>
						</div>
						<div class="col lost-password-column">
							<div class="lost-password woocommerce-LostPassword lost_password">
								<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Forgot password?', 'domenicafiore' ); ?></a>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col submit-column">
							<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
							<button type="submit" class="btn btn-form-submit" name="login" value="<?php esc_attr_e( 'Sign In', 'domenicafiore' ); ?>"><?php esc_html_e( 'Sign In', 'domenicafiore' ); ?></button>
						</div>
					</div>

					<?php do_action( 'woocommerce_login_form_end' ); ?>

				</form>

			</div>
		</div>
	</div>

</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
