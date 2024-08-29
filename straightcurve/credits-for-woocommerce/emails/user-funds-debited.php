<?php
/**
 * User Funds Debited Email.
 *
 * This template can be overridden by copying it to yourtheme/credits-for-woocommerce/emails/user-funds-debited.php.
 */
defined( 'ABSPATH' ) || exit ;
?>

<?php do_action( 'woocommerce_email_header', $email_heading, $email ) ; ?>
<div class="wrap" style="padding-left: 0; padding-right: 0; padding: 42px 32px 42px; font-family: Arial, sans-serif;">
<p>
	<?php
	/* translators: 1: user name 2: blog name 3: debited amount 4: credited date 5: txn activity */
	printf( wp_kses_post( __( 'Hi %1$s, <br>Your credit limit account on %2$s has been debited with <code>%3$s</code> at <code>%4$s</code> for %5$s.', 'credits-for-woocommerce' ) ), esc_html( $user_nicename ), esc_html( $blogname ), wp_kses_post( $credits_txn->get_debited() ), wp_kses_post( _wc_cs_format_datetime( $credits_txn->get_date_created() ) ), wp_kses_post( $credits_txn->get_activity() ) )
	?>
</p>

<p><?php esc_html_e( 'Thanks', 'credits-for-woocommerce' ) ; ?></p>
</div>
<?php do_action( 'woocommerce_email_footer', $email ) ; ?>
