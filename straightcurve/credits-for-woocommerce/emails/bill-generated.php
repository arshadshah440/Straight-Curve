<?php
/**
 * Bill Generated Email.
 *
 * This template can be overridden by copying it to yourtheme/credits-for-woocommerce/emails/bill-generated.php.
 */
defined( 'ABSPATH' ) || exit ;
?>
<?php do_action( 'woocommerce_email_header', $email_heading, $email ) ; ?>
<div class="wrap" style="padding-left: 0; padding-right: 0; padding: 42px 32px 42px; font-family: Arial, sans-serif;">
<p>
	<?php
	/* translators: 1: user name 2: blog name 3: last bill txn start date 4: last bill txn end date 5: last bill amount 6: due date 7: available credits 8: login url */
	printf( wp_kses_post( __( 'Hi %1$s, <br>We are pleased to share the monthly statement for your Credit Limit on %2$s for the period of <code>%3$s</code> to <code>%4$s</code>. <br><br>Please find the summary below: <br>Total Amount Due: <code>%5$s</code><br>Due Date: <code>%6$s</code><br>Available Credits: <code>%7$s</code><br><br>Please %8$s to your dashboard to view the transactions', 'credits-for-woocommerce' ) ), esc_html( $user_nicename ), esc_html( $blogname ), wp_kses_post( _wc_cs_format_datetime( $bill_statement->get_from_date(), false ) ), wp_kses_post( _wc_cs_format_datetime( $bill_statement->get_to_date(), false ) ), wp_kses_post( $credits->get_last_billed_amount() ), wp_kses_post( _wc_cs_format_datetime( $credits->get_last_billed_due_date(), false ) ), wp_kses_post( $credits->get_available_credits() ), '<a href="' . esc_url( wc_get_page_permalink( 'myaccount' ) ) . '">' . esc_url( wc_get_page_permalink( 'myaccount' ) ) . '</a>' )
	?>
</p>

<p><?php esc_html_e( 'Thanks', 'credits-for-woocommerce' ) ; ?></p>
</div>
<?php do_action( 'woocommerce_email_footer', $email ) ; ?>
