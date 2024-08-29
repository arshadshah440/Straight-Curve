<?php
/**
 * Checkout Payment Section
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.1.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! is_ajax() ) {
	do_action( 'woocommerce_review_order_before_payment' );
}
$minimum = ra_get_minimum_order_amount();
?>
<div id="payment" class="woocommerce-checkout-payment">
	<?php if (WC()->cart->get_subtotal() < $minimum) : ?>
		<div class="c-info-overlay" id="minimum-order-required" style="display: block;">
			<div class="c-info-overlay__container">
				<a href="javascript:void(0);" class="c-info-overlay__close js-close-info"><i class="fal fa-times" aria-hidden="true"></i></a>
				<div class="c-info-overlay__content text-center">
					<p>Webshop payment options are activated once the minimum order value of <?php echo wc_price($minimum); ?> is reached. For orders under <?php echo wc_price($minimum); ?> please contact your local Rep</p>
				</div>
			</div>
		</div>
	<?php else : ?>
		<?php if ( WC()->cart->needs_payment() ) : ?>

			<?php $credit_status = credit_status();
			if ($credit_status && $credit_status === 'overdue') : ?>
				<ul class="woocommerce-error" role="alert">
					<li>NOTE: Your pay on account option is on hold due to an outstanding bill - please contact your accounts department to arrange payment so we can re-activate your credit limit.</li>
				</ul>
			<?php endif; ?>

			<ul class="wc_payment_methods payment_methods methods">
				<?php
				if ( ! empty( $available_gateways ) ) {
					foreach ( $available_gateways as $gateway ) {
						wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
					}
				} else {
					echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) : esc_html__( 'Please fill in your details above to see available payment methods.', 'woocommerce' ) ) . '</li>'; // @codingStandardsIgnoreLine
				}
				?>
			</ul>
		<?php endif; ?>
		<div class="form-row place-order">
			<noscript>
				<?php
				/* translators: $1 and $2 opening and closing emphasis tags respectively */
				printf( esc_html__( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ), '<em>', '</em>' );
				?>
				<br/><button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'woocommerce' ); ?>"><?php esc_html_e( 'Update totals', 'woocommerce' ); ?></button>
			</noscript>

			<?php wc_get_template( 'checkout/terms.php' ); ?>

			<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

			<div class="c-checkout__buttons">
				<?php if (current_site() !== 'uk' || (current_site() === 'uk' && is_pro_user())) : ?>
					<a href="<?php echo SITE; ?>/shop" class="o-btn o-btn--noarrow">Continue shopping</a>
				<?php endif; ?>
				<?php echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="o-btn o-btn--orange alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button>' ); // @codingStandardsIgnoreLine ?>
			</div>

			<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

			<?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
		</div>
	<?php endif; ?>
</div>
<?php
if ( ! is_ajax() ) {
	do_action( 'woocommerce_review_order_after_payment' );
}
