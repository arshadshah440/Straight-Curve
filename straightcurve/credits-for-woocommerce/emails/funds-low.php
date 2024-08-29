<?php
/**
 * Admin Funds Low Email.
 *
 * This template can be overridden by copying it to yourtheme/credits-for-woocommerce/emails/funds-low.php.
 */
defined( 'ABSPATH' ) || exit ;
?>

<?php do_action( 'woocommerce_email_header', $email_heading, $email ) ; ?>
<div class="wrap" style="padding-left: 0; padding-right: 0; padding: 42px 32px 42px; font-family: Arial, sans-serif;">
<p>
	<?php
	/* translators: 1: balance amount 2: created date */
	printf( wp_kses_post( __( 'Hi, <br>Currently only <code>%1$s</code> is available in admin account as on <code>%2$s</code>', 'credits-for-woocommerce' ) ), wp_kses_post( $funds_txn->get_balance() ), wp_kses_post( _wc_cs_format_datetime( $funds_txn->get_date_created() ) ) )
	?>
</p>

<p><?php esc_html_e( 'Thanks', 'credits-for-woocommerce' ) ; ?></p>
</div>
<?php do_action( 'woocommerce_email_footer', $email ) ; ?>
