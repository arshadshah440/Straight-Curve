<?php
/**
 * Customer invoice email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-invoice.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Executes the e-mail header.
 *
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<table border="0" cellpadding="20" cellspacing="0" width="100%"><tr><td class="wrap" valign="top">

<?php if (current_site() === 'uk') : ?>
	<h1 style="text-transform: uppercase; font-weight: bold; font-size: 18px; line-height: 21px; margin: 0 0 12px;">Tax invoice</h1>
	<!-- <p style="margin: 0 0 24px;">Straightcurve Pty Ltd<br>VAT No: GB385283075<br>Unit 8/8 George Street, Bunbury<br>WA, 6237, AUSTRALIA</p> -->
	<p style="margin: 0 0 24px;">Straightcurve UK Ltd<br>VAT No. 412 8422 22<br>One, High Street, Egham, <br>England, TW20 9HJ <br>info@straightcurve.uk</p>
<?php elseif (current_site() === 'au') : ?>
	<h1 style="text-transform: uppercase; font-weight: bold; font-size: 18px; line-height: 21px; margin: 0 0 12px;">Tax invoice</h1>
	<p style="margin: 0 0 24px;">Straightcurve Australia Pty Ltd<br>8/8 George St, Bunbury, WA, 6230<br>ABN: 29 650 982 791</p>
<?php endif; ?>

<?php /* translators: %s: Customer first name */ ?>
<h1><?php printf( esc_html__( 'Hi %s,', 'woocommerce' ), esc_html( $order->get_billing_first_name() ) ); ?></h1>

<?php if ( $order->has_status( 'pending' ) ) { ?>
	<p>
	<?php
	printf(
		wp_kses(
			/* translators: %1$s Site title, %2$s Order pay link */
			__( 'An order has been created for you on %1$s. Your invoice is below, with a link to make payment when you’re ready: %2$s', 'woocommerce' ),
			array(
				'a' => array(
					'href' => array(),
				),
			)
		),
		esc_html( get_bloginfo( 'name', 'display' ) ),
		'<a href="' . esc_url( $order->get_checkout_payment_url() ) . '">' . esc_html__( 'Pay for this order', 'woocommerce' ) . '</a>'
	);
	?>
	</p>

<?php } else { ?>
	<p>
	<?php
	/* translators: %s Order date */
	printf( esc_html__( 'Here are the details of your order placed on %s:', 'woocommerce' ), esc_html( wc_format_datetime( $order->get_date_created() ) ) );
	?>
	</p>
	<?php
}

/**
 * Hook for the woocommerce_email_order_details.
 *
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @hooked WC_Structured_Data::generate_order_data() Generates structured data.
 * @hooked WC_Structured_Data::output_structured_data() Outputs structured data.
 * @since 2.5.0
 */
do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * Hook for the woocommerce_email_order_meta.
 *
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

?></td></tr></table>
<?php

/**
 * Hook for woocommerce_email_customer_details.
 *
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * Executes the email footer.
 *
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );
