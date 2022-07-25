<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="row login-signup-row">
	<div class="col-12 col-sm-6">
		<!-- Sign In form -->
		<div class="form-container">

			<h2><?php _e( 'Sign In', 'domenicafiore' ); ?></h2>
			<form class="df-form df-login" method="post">

				<?php do_action( 'woocommerce_login_form_start' ); ?>
				<div class="form-group">
					<input type="text" class="form-control" name="username" id="username" placeholder="<?php esc_html_e( 'Username / Email*', 'woocommerce' ); ?>" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				</div>

				<div class="form-group">
					<input class="form-control" type="password" name="password" id="password" placeholder="<?php esc_html_e( 'Password*', 'woocommerce' ); ?>" />
				</div>

				<?php do_action( 'woocommerce_login_form' ); ?>

				<div class="row">
					<div class="col lost-password-column">
						<div class="form-check">
							<input class="form-check-input" name="rememberme" type="checkbox" id="rememberme" value="forever" />
							<label><?php esc_attr_e( 'Remember Me', 'woocommerce' ); ?></label>
						</div>
						<div class="lost-password">
							<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Forgot password?', 'woocommerce' ); ?></a>
						</div>
					</div>
					<div class="col submit-column">
						<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
						<button type="submit" class="btn btn-form-submit" name="login" value="<?php esc_attr_e( 'Sign In', 'woocommerce' ); ?>"><?php esc_html_e( 'Sign In', 'woocommerce' ); ?></button>
					</div>
				</div>

				<?php do_action( 'woocommerce_login_form_end' ); ?>

			</form>

		</div>
	</div>
	<div class="col-12 col-sm-6">
		<!-- New Customer form -->
		<div class="form-container">

			<h2><?php _e( 'Create Account', 'domenicafiore' ); ?></h2>

			<form method="post" class="df-form df-register">

				<?php do_action( 'woocommerce_register_form_start' ); ?>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
					<div class="form-group">
						<input type="text" class="form-control" name="username" id="reg_username" placeholder="<?php esc_html_e( 'Username*', 'woocommerce' ); ?>" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
					</div>
				<?php endif; ?>

				<div class="form-group">
					<input type="email" class="form-control" name="email" id="reg_email" placeholder="<?php esc_html_e( 'Email*', 'woocommerce' ); ?>" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				</div>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
					<div class="form-group">
						<input type="password" class="form-control" name="password" id="reg_password" placeholder="<?php esc_html_e( 'Password*', 'woocommerce' ); ?>" />
					</div>
				<?php endif; ?>

				<?php do_action( 'woocommerce_register_form' ); ?>

				<?php wp_nonce_field( 'woocommerce-register', 'nonce_wc-register' ); ?>
				<button type="submit" class="btn btn-form-submit" name="register" value="<?php esc_attr_e( 'Create', 'woocommerce' ); ?>"><?php esc_html_e( 'Create', 'woocommerce' ); ?></button>

				<?php do_action( 'woocommerce_register_form_end' ); ?>
			</form>

		</div>
	</div>
</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
