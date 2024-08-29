<?php
/**
 * Customer completed order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-completed-order.php.
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

$text1 = 'Just letting you know that we have finished processing your order. It has been despatched and will be delivered within 5 working days.';
if (current_site() === 'uk') {
	$text1 = 'Just letting you know that we have finished processing your order. It has been despatched and will be delivered within 5 working days.';
}
if (current_site() === 'au' && $is_pickup) {
	$text1 = 'Just letting you know that we have finished processing your order. It is ready for pickup.';
}

?>

<table border="0" cellpadding="20" cellspacing="0" width="100%"><tr><td class="wrap" valign="top">

<?php /* translators: %s: Customer first name */ ?>
<h1><?php printf( esc_html__( 'Hi %s,', 'woocommerce' ), esc_html( $order->get_billing_first_name() ) ); ?></h1>

<?php if ($text1) : ?>
	<p><?php echo $text1; ?></p>
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

?>
<?php if (current_site() === 'uk') : ?>
<!-- <script type="application/json+trustpilot"> {
"recipientEmail": "{customer_email}", "recipientName": "{customer_first_name}", "referenceId": "{order_number}",
"products": [{
	"productUrl": "{item_url}", "name": "{item_name}", "sku": "{item_code}"
}]
}
</script> -->
<?php endif; ?>