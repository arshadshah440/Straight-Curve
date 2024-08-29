<?php
/**
 * Payment Success Email.
 *
 * This template can be overridden by copying it to yourtheme/credits-for-woocommerce/emails/payment-success.php.
 */
defined( 'ABSPATH' ) || exit ;
?>

<?php do_action( 'woocommerce_email_header', $email_heading, $email ) ; ?>
<div class="wrap" style="padding-left: 0; padding-right: 0; padding: 42px 32px 42px; font-family: Arial, sans-serif;">
<p>
	<?php
	/* translators: 1: user name 2: credited amount 3: blog name 4: credited date 5: balance amount */
	printf( wp_kses_post( __( 'Hi %1$s, <br>Your credit limit bill payment of <code>%2$s</code> on %3$s is successful. Your credit balance at <code>%4$s</code> is <code>%5$s</code>.', 'credits-for-woocommerce' ) ), esc_html( $user_nicename ), wp_kses_post( $credits_txn->get_credited() ), esc_html( $blogname ), wp_kses_post( _wc_cs_format_datetime( $credits_txn->get_date_created() ) ), wp_kses_post( $credits_txn->get_balance() ) )
	?>
</p>

<p><?php esc_html_e( 'Thanks', 'credits-for-woocommerce' ) ; ?></p>
</div>
<?php do_action( 'woocommerce_email_footer', $email ) ; ?>
