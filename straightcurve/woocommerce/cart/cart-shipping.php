<?php
/**
 * Shipping Methods Display
 *
 * In 2.1 we show methods per package. This allows for multiple methods per order if so desired.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-shipping.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.3.0
 */

defined( 'ABSPATH' ) || exit;

$formatted_destination    = isset( $formatted_destination ) ? $formatted_destination : WC()->countries->get_formatted_address( $package['destination'], ', ' );
$has_calculated_shipping  = ! empty( $has_calculated_shipping );
$show_shipping_calculator = ! empty( $show_shipping_calculator );
$calculator_text          = '';


$has_free_shipping = false;
foreach ( $available_methods as $method ) {
	if ($method->method_id === 'free_shipping') {
		$has_free_shipping = true;
	}
}


$current_fa = get_forklift_available();
if (current_site() === 'au') {
	$set_val = $current_fa;
	if ($chosen_method && $chosen_method === 'local_pickup:4') {
		$set_val = null;
	}
	set_forklift_available($set_val);
}


$warehouses = get_warehouses();

if (current_site() === 'au' && WC()->customer->shipping['state']) {
	$warehouse_code = warehouse_code_by_state(WC()->customer->shipping['state']);
}

?>
<tr class="woocommerce-shipping-totals shipping">
	<th>
		<?php echo wp_kses_post( $package_name ); ?>
		<?php if (!is_live() && current_site() === 'uk' && !$has_free_shipping) : ?>
			<!-- <span>Location depending<span> -->
		<?php elseif (current_site() === 'uk' && !$has_free_shipping) : ?>
			<!-- <span>Location depending <br>Orders attract FREE shipping <br>from £800, £1,300 or £2,000<span> -->
		<?php endif; ?>
	</th>
	<td <?php echo (is_checkout() ? 'colspan="2"' : ''); ?> data-title="<?php echo esc_attr( $package_name ); ?>">
		<?php if ( $available_methods ) : ?>
			<ul id="shipping_method" class="woocommerce-shipping-methods">
				<?php foreach ( $available_methods as $method ) :
					$show = true;
					// if (!is_live() && current_site() === 'uk') {
					// 	if (is_pro_user() && $has_free_shipping) {
					// 		$has_free_shipping = false;
					// 	}
					// 	if (is_pro_user() && $method->method_id === 'free_shipping')  {
					// 		$show = false;
					// 	}

					// }

					if ($has_free_shipping && $method->method_id === 'flat_rate')  {
						$show = false;
					}

					// if (current_site() === 'au' && is_dealer_user() && $method->method_id === 'local_pickup')  {
					// 	$show = false;
					// }
					if ($show) :

					$warehouse_address = '';
					if ($method->method_id === 'local_pickup' && $warehouse_code && isset($warehouses[$warehouse_code]['address'])) {
						$warehouse_address = '<span class="pickup-warehouse">';
						$warehouse_address .= '<span class="pickup-warehouse-name">From: ' . $warehouses[$warehouse_code]['name'] . '</span>';
						$warehouse_address .= '<span class="pickup-warehouse-address">' . $warehouses[$warehouse_code]['address'] . '</span>';
						$warehouse_address .= '<span class="pickup-warehouse-hours">' . $warehouses[$warehouse_code]['pickup_hours'] . '</span>';
						$warehouse_address .= '</span>';
					}
					?>
					<li><?php
						if ( 1 < count( $available_methods ) ) {
							printf( '<input type="radio" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" %4$s />', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ), checked( $method->id, $chosen_method, false ) ); // WPCS: XSS ok.
						} else {
							printf( '<input type="hidden" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" />', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ) ); // WPCS: XSS ok.
						}
						printf( '<label for="shipping_method_%1$s_%2$s">%3$s%4$s</label>', $index, esc_attr( sanitize_title( $method->id ) ), wc_cart_totals_shipping_method_label( $method ), $warehouse_address ); // WPCS: XSS ok.
						do_action( 'woocommerce_after_shipping_rate', $method, $index );
					?></li>
				<?php endif; endforeach; ?>
			</ul>
			<?php if ( is_cart() ) : ?>
				<p class="woocommerce-shipping-destination">
					<?php
					if ( $formatted_destination ) {
						// Translators: $s shipping destination.
						printf( esc_html__( 'Shipping to %s.', 'woocommerce' ) . ' ', '<strong>' . esc_html( $formatted_destination ) . '</strong>' );
						$calculator_text = esc_html__( 'Change address', 'woocommerce' );
					} else {
						echo wp_kses_post( apply_filters( 'woocommerce_shipping_estimate_html', __( 'Shipping options will be updated during checkout.', 'woocommerce' ) ) );
					}
					?>
				</p>
			<?php endif; ?>
			<?php
		elseif ( ! $has_calculated_shipping || ! $formatted_destination ) :
			if ( is_cart() && 'no' === get_option( 'woocommerce_enable_shipping_calc' ) ) {
				echo wp_kses_post( apply_filters( 'woocommerce_shipping_not_enabled_on_cart_html', __( 'Shipping costs are calculated during checkout.', 'woocommerce' ) ) );
			} else {
				echo wp_kses_post( apply_filters( 'woocommerce_shipping_may_be_available_html', __( 'Enter your address to view shipping options.', 'woocommerce' ) ) );
			}
		elseif ( ! is_cart() ) :
			if (current_site() === 'uk') {
				echo wp_kses_post( apply_filters( 'woocommerce_no_shipping_available_html', __( 'Unfortunately, you are unable to order outside of the UK Mainland and some remote areas. Please contact us at <a href="mailto:info@straightcurve.uk">info@straightcurve.uk</a> to arrange a special order.', 'woocommerce' ) ) );
			} else {
				echo wp_kses_post( apply_filters( 'woocommerce_no_shipping_available_html', __( 'There are no shipping options available. Please ensure that your address has been entered correctly, or contact us if you need any help.', 'woocommerce' ) ) );
			}
		else :
			// Translators: $s shipping destination.
			echo wp_kses_post( apply_filters( 'woocommerce_cart_no_shipping_available_html', sprintf( esc_html__( 'No shipping options were found for %s.', 'woocommerce' ) . ' ', '<strong>' . esc_html( $formatted_destination ) . '</strong>' ) ) );
			$calculator_text = esc_html__( 'Enter a different address', 'woocommerce' );
		endif;
		?>

		<?php if ( $show_package_details ) : ?>
			<?php echo '<p class="woocommerce-shipping-contents"><small>' . esc_html( $package_details ) . '</small></p>'; ?>
		<?php endif; ?>

	</td>
</tr>

<?php if (required_forklift_available()) : ?>
<tr class="forklift-available-tr">
	<th <?php echo (is_checkout() ? 'colspan="2"' : ''); ?>>Will there be a Forklift at the delivery address?</th>
	<td>
		<ul id="forklift_available" class="forklift-available">
			<li>
				<input type="radio" name="forklift_available" id="forklift_available_yes" value="Yes" <?php echo ($current_fa === 'Yes' ? 'checked' : ''); ?> class="forklift_available_yes">
				<label for="forklift_available_yes">Yes</label>
			</li>
			<li>
				<input type="radio" name="forklift_available" id="forklift_available_no" value="No" <?php echo ($current_fa === 'No' ? 'checked' : ''); ?> class="forklift_available_no">
				<label for="forklift_available_no">No</label>
			</li>
		</ul>
	</td>
</tr>
<?php endif; ?>
