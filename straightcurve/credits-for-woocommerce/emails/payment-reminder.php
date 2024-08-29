<?php
/**
 * Payment Reminder Email.
 *
 * This template can be overridden by copying it to yourtheme/credits-for-woocommerce/emails/payment-reminder.php.
 */
defined( 'ABSPATH' ) || exit ;
?>

<?php do_action( 'woocommerce_email_header', $email_heading, $email ) ; ?>
<div class="wrap" style="padding-left: 0; padding-right: 0; padding: 42px 32px 42px; font-family: Arial, sans-serif;">
<p>
	<?php
	/* translators: 1: user name 2: last bill date 3: last bill txn start date 4: last bill txn end date 5: blog name 6: due date */
	printf( wp_kses_post( __( 'Hi %1$s, <br>Your credit limit bill due amount dated <code>%2$s</code> for the transaction period of <code>%3$s</code> to <code>%4$s</code> has not been paid so far on %5$s. Please pay your bill on or before <code>%6$s</code>', 'credits-for-woocommerce' ) ), esc_html( $user_nicename ), wp_kses_post( _wc_cs_format_datetime( $credits->get_last_billed_date(), false ) ), wp_kses_post( _wc_cs_format_datetime( $bill_statement->get_from_date(), false ) ), wp_kses_post( _wc_cs_format_datetime( $bill_statement->get_to_date(), false ) ), esc_html( $blogname ), wp_kses_post( _wc_cs_format_datetime( $credits->get_last_billed_due_date(), false ) ) )
	?>
</p>

<p><?php esc_html_e( 'Thanks', 'credits-for-woocommerce' ) ; ?></p>
</div>
<?php do_action( 'woocommerce_email_footer', $email ) ; ?>
