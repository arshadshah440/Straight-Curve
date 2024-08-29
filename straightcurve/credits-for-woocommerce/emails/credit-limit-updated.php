<?php
/**
 * Credit Limit Updated Email.
 *
 * This template can be overridden by copying it to yourtheme/credits-for-woocommerce/emails/credit-limit-updated.php.
 */
defined( 'ABSPATH' ) || exit ;
?>

<?php do_action( 'woocommerce_email_header', $email_heading, $email ) ; ?>
<div class="wrap" style="padding-left: 0; padding-right: 0; padding: 42px 32px 42px; font-family: Arial, sans-serif;">
<p>
	<?php
	/* translators: 1: user name 2: blog name 3: approved credits 4: credited date */
	printf( wp_kses_post( __( 'Hi %1$s, <br>Your Credit Limit on %2$s has been updated. Your new credit limit is <code>%3$s</code> at <code>%4$s</code>.', 'credits-for-woocommerce' ) ), esc_html( $user_nicename ), esc_html( $blogname ), wp_kses_post( $credits->get_approved_credits() ), wp_kses_post( _wc_cs_format_datetime( $credits->get_date_created() ) ) )
	?>
</p>

<p><?php esc_html_e( 'Thanks', 'credits-for-woocommerce' ) ; ?></p>
</div>
<?php do_action( 'woocommerce_email_footer', $email ) ; ?>
