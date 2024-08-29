<?php
/**
 * Admin Funds Addition Success Email.
 *
 * This template can be overridden by copying it to yourtheme/credits-for-woocommerce/emails/funds-addition-success.php.
 */
defined( 'ABSPATH' ) || exit ;
?>

<?php do_action( 'woocommerce_email_header', $email_heading, $email ) ; ?>
<div class="wrap" style="padding-left: 0; padding-right: 0; padding: 42px 32px 42px; font-family: Arial, sans-serif;">
<p>
	<?php
	/* translators: 1: credited amount 2: credited date 3: blog name */
	printf( wp_kses_post( __( 'Hi, <br><code>%1$s</code> has been successfully added to admin account at <code>%2$s</code> on %3$s', 'credits-for-woocommerce' ) ), wp_kses_post( $funds_txn->get_credited() ), wp_kses_post( _wc_cs_format_datetime( $funds_txn->get_date_created() ) ), esc_html( $blogname ) )
	?>
</p>

<p><?php esc_html_e( 'Thanks', 'credits-for-woocommerce' ) ; ?></p>
</div>
<?php do_action( 'woocommerce_email_footer', $email ) ; ?>
