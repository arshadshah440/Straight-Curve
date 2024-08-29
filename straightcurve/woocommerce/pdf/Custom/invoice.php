<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php do_action( 'wpo_wcpdf_before_document', $this->type, $this->order ); ?>

<table class="head container">
	<tr>
		<td class="header">
		<?php
		if( $this->has_header_logo() ) {
			$this->header_logo();
		} else {
			echo '<img src="' . ASSETS . '/img/logo.png" alt="Straightcurve" width="300"/>';
		}
		?>
		</td>
		<td class="shop-info">
			<?php do_action( 'wpo_wcpdf_before_shop_name', $this->type, $this->order ); ?>
			<div class="shop-name"><h3><?php $this->shop_name(); ?></h3></div>
			<?php do_action( 'wpo_wcpdf_after_shop_name', $this->type, $this->order ); ?>
			<?php do_action( 'wpo_wcpdf_before_shop_address', $this->type, $this->order ); ?>
			<div class="shop-address"><?php $this->shop_address(); ?></div>
			<?php do_action( 'wpo_wcpdf_after_shop_address', $this->type, $this->order ); ?>
		</td>
	</tr>
</table>

<h1 class="document-type-label">Sales Order</h1>

<?php do_action( 'wpo_wcpdf_after_document_label', $this->type, $this->order ); ?>

<table class="order-data-addresses">
	<tr>
		<td class="address billing-address">
			<!-- <h3><?php _e( 'Billing Address:', 'woocommerce-pdf-invoices-packing-slips' ); ?></h3> -->
			<?php do_action( 'wpo_wcpdf_before_billing_address', $this->type, $this->order ); ?>
			<?php $this->billing_address(); ?>
			<?php do_action( 'wpo_wcpdf_after_billing_address', $this->type, $this->order ); ?>
			<?php if ( isset($this->settings['display_email']) ) { ?>
			<div class="billing-email"><?php $this->billing_email(); ?></div>
			<?php } ?>
			<?php if ( isset($this->settings['display_phone']) ) { ?>
			<div class="billing-phone"><?php $this->billing_phone(); ?></div>
			<?php } ?>
		</td>
		<td class="address shipping-address">
			<?php if ( !empty($this->settings['display_shipping_address']) && ( $this->ships_to_different_address() || $this->settings['display_shipping_address'] == 'always' ) ) { ?>
			<h3><?php _e( 'Ship To:', 'woocommerce-pdf-invoices-packing-slips' ); ?></h3>
			<?php do_action( 'wpo_wcpdf_before_shipping_address', $this->type, $this->order ); ?>
			<?php $this->shipping_address(); ?>
			<?php do_action( 'wpo_wcpdf_after_shipping_address', $this->type, $this->order ); ?>
			<?php } ?>
		</td>
		<td class="order-data">
			<table>
				<?php do_action( 'wpo_wcpdf_before_order_data', $this->type, $this->order ); ?>
				<?php if ( isset($this->settings['display_number']) ) { ?>
				<tr class="invoice-number">
					<th><?php echo $this->get_number_title(); ?></th>
					<td><?php $this->invoice_number(); ?></td>
				</tr>
				<?php } ?>
				<?php if ( isset($this->settings['display_date']) ) { ?>
				<tr class="invoice-date">
					<th><?php echo $this->get_date_title(); ?></th>
					<td><?php $this->invoice_date(); ?></td>
				</tr>
				<?php } ?>
				<tr class="order-number">
					<th><?php _e( 'Sales Order:', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
					<td><?php $this->order_number(); ?></td>
				</tr>
				<tr class="reference-number">
					<th>Purchase Order Number:</th>
					<td><?php
						$ra_reference = $this->order->get_meta('ra_reference_field');
						if ($ra_reference) {
							echo $ra_reference;
						}
					?></td>
				</tr>
				<tr class="order-date">
					<th><?php _e( 'Order Date:', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
					<td><?php $this->order_date(); ?></td>
				</tr>
				<?php // Hide from PDF for now
				if (1 === 2) : ?>
					<tr class="payment-method">
						<th><?php _e( 'Payment Method:', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
						<td><?php
							if ($this->order->payment_method === '_wc_cs_credits') {
								echo 'On Account - to be paid';
							} elseif ($this->order->is_paid() && $this->order->payment_method === 'stripe') {
								echo 'Credit Card (Stripe) PAID';
							} else {
								$this->payment_method();
							}
						?></td>
					</tr>
					<?php if ($this->order->payment_method === '_wc_cs_credits') : ?>
						<tr class="payment-method">
							<td colspan="2">
								PAYMENT DUE - 30 DAYS FROM INVOICE DATE
							</td>
						</tr>
					<?php endif; ?>
				<?php endif; ?>
				<?php do_action( 'wpo_wcpdf_after_order_data', $this->type, $this->order ); ?>
			</table>
		</td>
	</tr>
</table>

<?php do_action( 'wpo_wcpdf_before_order_details', $this->type, $this->order ); ?>

<table class="order-details">
	<thead>
		<tr>
			<th class="product"><?php _e('Product', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
			<th class="quantity"><?php _e('Quantity', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
			<!-- <th class="price"><?php _e('Price', 'woocommerce-pdf-invoices-packing-slips' ); ?></th> -->
		</tr>
	</thead>
	<tbody>
		<?php $items = $this->get_order_items(); if( sizeof( $items ) > 0 ) : foreach( $items as $item_id => $item ) : ?>
		<tr class="<?php echo apply_filters( 'wpo_wcpdf_item_row_class', 'item-'.$item_id, $this->type, $this->order, $item_id ); ?>">
			<td class="product">
				<?php $description_label = __( 'Description', 'woocommerce-pdf-invoices-packing-slips' ); // registering alternate label translation ?>
				<span class="item-name"><?php echo $item['name']; ?></span>
				<?php do_action( 'wpo_wcpdf_before_item_meta', $this->type, $item, $this->order  ); ?>
				<span class="item-meta"><?php echo $item['meta']; ?></span>
				<dl class="meta">
					<?php $description_label = __( 'SKU', 'woocommerce-pdf-invoices-packing-slips' ); // registering alternate label translation ?>
					<?php if( !empty( $item['sku'] ) ) : ?><dt class="sku"><?php _e( 'SKU:', 'woocommerce-pdf-invoices-packing-slips' ); ?></dt><dd class="sku"><?php echo $item['sku']; ?></dd><?php endif; ?>
					<?php if( !empty( $item['weight'] ) ) : ?><dt class="weight"><?php _e( 'Weight:', 'woocommerce-pdf-invoices-packing-slips' ); ?></dt><dd class="weight"><?php echo $item['weight']; ?><?php echo get_option('woocommerce_weight_unit'); ?></dd><?php endif; ?>
				</dl>
				<?php do_action( 'wpo_wcpdf_after_item_meta', $this->type, $item, $this->order  ); ?>
			</td>
			<td class="quantity"><?php echo $item['quantity']; ?></td>
			<!-- <td class="price"><?php echo $item['order_price']; ?></td> -->
		</tr>
		<?php endforeach; endif; ?>
	</tbody>
	<!-- <tfoot>
		<tr class="no-borders">
			<td class="no-borders">
			</td>
			<td class="no-borders" colspan="2">
				<table class="totals">
					<tfoot>
						<?php foreach( $this->get_woocommerce_totals() as $key => $total ) : ?>
						<tr class="<?php echo $key; ?>">
							<th class="description"><?php
								if ($this->order->is_paid() && $this->order->payment_method === 'stripe' && $key === 'order_total') {
									echo 'Total Paid';
								} elseif ($this->order->payment_method === '_wc_cs_credits' && $key === 'order_total') {
									echo 'Total Outstanding';
								} else {
									echo $total['label'];
								}
							?></th>
							<td class="price"><span class="totals-price"><?php echo $total['value']; ?></span></td>
						</tr>
						<?php endforeach; ?>
					</tfoot>
				</table>
			</td>
		</tr>
	</tfoot> -->
</table>

<div class="bottom-spacer"></div>

<?php do_action( 'wpo_wcpdf_after_order_details', $this->type, $this->order ); ?>
<?php if ($this->order->payment_method === '_wc_cs_credits') : ?>
	<!-- <p>
		<strong>Please make payments to:</strong> <br>
		Straightcurve Australia Pty Ltd <br>
		BSB: 302-162 <br>
		Account: 184014-2
	</p>
	<p>If you have questions regarding your invoice or you cannot meet the due payment date, please get in contact with us via email to <span class="highlight">admin.au@straightcurve.com.au</span>. Overdue credit balances will automatically pause credit to your account. When making EFT payments please include our <span class="highlight">INVOICE NUMBER</span> in your remittance advice and emails to <span class="highlight">admin.au@straightcurve.com.au</span></p> -->
<?php endif; ?>
<?php if ( $this->get_footer() ): ?>
<div id="footer">
	<!-- hook available: wpo_wcpdf_before_footer -->
	<?php $this->footer(); ?>
	<!-- hook available: wpo_wcpdf_after_footer -->
</div><!-- #letter-footer -->
<?php endif; ?>
<?php do_action( 'wpo_wcpdf_after_document', $this->type, $this->order ); ?>