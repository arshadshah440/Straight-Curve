<?php
/**
 * Order details table shown in emails.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-order-details.php.
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

defined( 'ABSPATH' ) || exit;

$text_align = is_rtl() ? 'right' : 'left';

do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text, $email );

$ra_reference_field = get_post_meta( $order->id, 'ra_reference_field', true );
$ra_add_brochures = get_post_meta( $order->id, 'ra_add_brochures', true );
?>

<h2 class="order_details_title">
	<?php
	if ( $sent_to_admin ) {
		$before = '<a class="link" href="' . esc_url( $order->get_edit_order_url() ) . '">';
		$after  = '</a>';
	} else {
		$before = '';
		$after  = '';
	}
	/* translators: %s: Order ID. */
	echo wp_kses_post( $before . sprintf( __( 'Your Order #%s', 'woocommerce' ) . $after . ' &nbsp; <small>(<time datetime="%s">%s</time>)</small>', $order->get_order_number(), $order->get_date_created()->format( 'c' ), wc_format_datetime( $order->get_date_created() ) ) );
	?>
</h2>
<?php if ($ra_reference_field) : ?>
	<p style="font-size: 16px;"><?php echo ($sent_to_admin ? 'User Purchase Order Number: ' : 'Purchase Order Number: ') . $ra_reference_field; ?></p>
<?php endif; ?>

<div>
	<?php
	// Hide below table on complete order on AU site
	if (current_site() === 'au' && $email->id === 'customer_completed_order') : ?>
	<?php else : ?>
	<table class="td" cellspacing="0" cellpadding="6" style="width: 100%; font-family: Arial, sans-serif;" border="1">
		<thead>
			<tr>
				<th class="td bb th-1 first" <?php echo (current_site() === 'au' ? 'colspan="3"' : ''); ?> scope="col" style="text-align: left;">Items</th>
				<th class="td bb th-1" scope="col" style="text-align: right;">Quantity</th>
				<?php if (current_site() !== 'au') : ?>
					<th class="td bb th-1 last" scope="col" style="text-align: right;">Unit Price</th>
					<th class="td bb th-1 last" scope="col" style="text-align: right;">Total</th>
				<?php endif; ?>
			</tr>
		</thead>
		<tbody>
			<?php
			echo wc_get_email_order_items( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				$order,
				array(
					'show_sku'      => $sent_to_admin,
					'show_image'    => false,
					'image_size'    => array( 32, 32 ),
					'plain_text'    => $plain_text,
					'sent_to_admin' => $sent_to_admin,
				)
			);
			?>
		</tbody>
		<tfoot>
			<?php
			$item_totals = $order->get_order_item_totals();
			$show_in_au = array('shipping', 'payment_method');

			if ( $item_totals ) {
				$i = 0;
				foreach ( $item_totals as $key => $total ) {
					$i++;
					$label = wp_kses_post( $total['label'] );
					$value = wp_kses_post( $total['value'] );
					if ($key === 'order_total' && $order->payment_method === '_wc_cs_credits') {
						$label = 'Total Outstanding';
					} else if ($key === 'order_total' && $order->is_paid() && $order->payment_method === 'stripe') {
						// $label = 'Total Paid';
					}

					if ($key === 'payment_method' && $order->payment_method === '_wc_cs_credits') {
						// $value = 'On Account - to be paid';
						$value = 'On Account';
					// } else if ($key === 'payment_method' && $order->is_paid() && $order->payment_method === 'stripe') {
					// 	$value = 'Credit Card (Stripe) PAID';
					}
					$show = true;
					if (current_site() === 'au' && !in_array($key, $show_in_au) ) {
						$show = false;
					}
					if (strpos($key, 'fee_') !== false) {
						$show = true;
					}

					if ($show) : ?>
					<tr>
						<th class="td th-2 <?php echo ( 1 === $i ) ? 'pt' : ''; ?>" scope="row" colspan="2" style="text-align:right;"><?php echo $label; ?></th>
						<td class="td <?php echo ( 1 === $i ) ? 'pt' : ''; ?>" colspan="2" style="text-align:right; min-width: 120px"><?php echo $value; ?></td>
					</tr>
					<?php endif;
				}
			}
			?>
		</tfoot>
	</table>
	<?php endif; ?>
	<?php if ($ra_add_brochures) : ?>
		<p style="font-size: 12px;">&nbsp;</p>
		<p style="font-size: 16px;">Add 5 brochures to my order?: <strong>Yes</strong></p>
	<?php endif; ?>
	<?php if ( $order->get_customer_note() ) { ?>
		<div id="customer_note"><strong><?php esc_html_e( 'Customer Note: ', 'woocommerce' ); ?></strong><?php echo wp_kses_post( nl2br( wptexturize( $order->get_customer_note() ) ) ); ?></div>
		<?php
	} ?>
	<?php if (1===2 && $order->payment_method === '_wc_cs_credits') : // Hidden for now ?>
		<div id="advisory_notes">
			<p>
				<strong>Please make payments to:</strong> <br>
				Straightcurve Australia Pty Ltd <br>
				BSB: 302-162 <br>
				Account: 184014-2
			</p>
			If you have questions regarding your invoice or you cannot meet the due payment date, please get in contact with us via email to <a href="mailto:admin.au@straightcurve.com.au">admin.au@straightcurve.com.au</a>. Overdue credit balances will automatically pause credit to your account. When making EFT payments please include our <span class="highlight">INVOICE NUMBER</span> in your remittance advice and emails to <a href="mailto:admin.au@straightcurve.com.au">admin.au@straightcurve.com.au</a>
		</div>
	<?php endif; ?>
</div>

<?php do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text, $email ); ?>
