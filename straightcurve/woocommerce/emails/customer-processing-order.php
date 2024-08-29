<?php
/**
 * Customer processing order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-processing-order.php.
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

/*
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email );


$is_pickup = false;
if ($order->has_shipping_method('local_pickup')) {
	$is_pickup = true;
}

// Default Copy
$title = 'Tax invoice';
$text1 = 'Straightcurve UK Ltd<br>VAT No. 412 8422 22<br>One, High Street, Egham, <br>England, TW20 9HJ <br>info@straightcurve.uk';
$text2 = 'Your order has been received and is now being processed. It will be delivered within 5 working days of being despatched. We will send you a separate email once processing has been completed, to notify you that it’s on its way.';

// AU Copy
if (current_site() === 'au') {
	$title = 'Sales order';
	$text1 = 'Straightcurve Australia Pty Ltd<br>8/8 George St, Bunbury, WA, 6230<br>ABN: 29 650 982 791';
}
if (current_site() === 'au' && $is_pickup) {
	$text2 = 'Your order has been received and is now being processed. We will send you an email once processing has been completed, to notify you that it’s ready for pickup.';
}

// UK Copy
if (current_site() === 'uk') {
	$text2 = 'Your order has been received and is now being processed. It will be delivered within 5 working days of being despatched. We will send you a separate email once processing has been completed, to notify you that it’s on its way.';
}

?>

<table border="0" cellpadding="20" cellspacing="0" width="100%"><tr><td class="wrap" valign="top">
<?php /* translators: %s: Customer first name */ ?>
<?php if ($title) : ?>
	<h1 style="text-transform: uppercase; font-weight: bold; font-size: 18px; line-height: 21px; margin: 0 0 12px;"><?php echo $title; ?></h1>
<?php endif; ?>
<?php if ($text1) : ?>
	<p style="margin: 0 0 24px;"><?php echo $text1; ?></p>
<?php endif; ?>

<h1><?php printf( esc_html__( 'Thank you for your order %s.', 'woocommerce' ), esc_html( $order->get_billing_first_name() ) ); ?></h1>
<?php if ($text2) : ?>
	<p><?php echo $text2; ?></p>
<?php endif; ?>


<?php if (current_site() === 'au' && $is_pickup) : ?>
	<?php
		$state = $order->get_shipping_state();
		if (!$state) {
			$state = $order->get_billing_state();
		}
		$warehouse_code = warehouse_code_by_state($state);
		$warehouses = get_warehouses();
		$warehouse = $warehouses[$warehouse_code];



	if ($warehouse && $warehouse['address']) : ?>
		<h3 style="text-transform: initial; color: #1B4932; font-family: Arial, sans-serif; font-style: normal; font-weight: normal; font-size: 18px; line-height: 21px; letter-spacing: -0.02em; margin: 24px 0 4px;">Pickup location</h3>
		<p>
			<strong><?php echo $warehouse['name']; ?></strong><br>
			<?php echo $warehouse['address']; ?><br>
			<?php echo $warehouse['pickup_hours']; ?><br>
		</p>
	<?php endif; ?>
<?php endif; ?>

<?php

/*
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @hooked WC_Structured_Data::generate_order_data() Generates structured data.
 * @hooked WC_Structured_Data::output_structured_data() Outputs structured data.
 * @since 2.5.0
 */
do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

?></td></tr></table>
<?php

/*
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );
