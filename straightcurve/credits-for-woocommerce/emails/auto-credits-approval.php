<?php
/**
 * Auto Credits Approval Email.
 *
 * This template can be overridden by copying it to yourtheme/credits-for-woocommerce/emails/auto-credits-approval.php.
 */
defined( 'ABSPATH' ) || exit ;
?>

<?php do_action( 'woocommerce_email_header', $email_heading, $email ) ; ?>
<div class="wrap" style="padding-left: 0; padding-right: 0; padding: 42px 32px 42px; font-family: Arial, sans-serif;">
<p>
	<?php
	/* translators: 1: user name 2: blog name 3: approved credits 4: credited date 5: login url */
	printf( wp_kses_post( __( 'Hi %1$s, <br>You are eligible for Credit Line on %2$s and you have been credited with <code>%3$s</code> at <code>%4$s</code>. Please login to the %5$s to get more details about on your credit limit.', 'credits-for-woocommerce' ) ), esc_html( $user_nicename ), esc_html( $blogname ), wp_kses_post( $credits->get_approved_credits() ), wp_kses_post( _wc_cs_format_datetime( $credits->get_date_created() ) ), '<a href="' . esc_url( wc_get_page_permalink( 'myaccount' ) ) . '">' . esc_url( wc_get_page_permalink( 'myaccount' ) ) . '</a>' )
	?>
</p>

<p><?php esc_html_e( 'Thanks', 'credits-for-woocommerce' ) ; ?></p>
</div>
<?php do_action( 'woocommerce_email_footer', $email ) ; ?>
