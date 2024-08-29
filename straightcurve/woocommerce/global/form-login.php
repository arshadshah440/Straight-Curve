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
 * @package     WooCommerce\Templates
 * @version     7.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( is_user_logged_in() ) {
	return;
}

?>
<form class="woocommerce-form woocommerce-form-login login" method="post" <?php echo ( $hidden ) ? 'style="display:none;"' : ''; ?>>
	<div class="woocommerce-form-login-inner">
		<?php do_action( 'woocommerce_login_form_start' ); ?>

		<?php echo ( $message ) ? wpautop( wptexturize( $message ) ) : ''; // @codingStandardsIgnoreLine ?>

		<div class="o-layout">
			<div class="o-layout__item u-1/2@tablet">
				<label for="username" hidden><?php esc_html_e( 'Username or email', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="text" class="input-text" name="username" id="username" autocomplete="username" placeholder="Username or email"/>
			</div>
			<div class="o-layout__item u-1/2@tablet">
				<label for="password" hidden><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input class="input-text" type="password" name="password" id="password" autocomplete="current-password" placeholder="Password"/>
			</div>
		</div>

		<?php do_action( 'woocommerce_login_form' ); ?>

		<div class="o-layout o-module">
			<div class="o-layout__item o-module__item u-1/2@tablet order-2">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
				</label>
			</div>
			<div class="o-layout__item o-module__item u-1/2@tablet">
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ); ?>" />
				<button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>"><?php esc_html_e( 'Login', 'woocommerce' ); ?></button>
			</div>
		</div>

		<p class="lost_password">
			<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
		</p>

		<?php do_action( 'woocommerce_login_form_end' ); ?>
	</div>
</form>
