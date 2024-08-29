<?php
/**
 * Single variation cart button
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

global $product;
?>
<div class="woocommerce-variation-add-to-cart variations_button">
	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

	<?php
	do_action( 'woocommerce_before_add_to_cart_quantity' );

	$max_qty = apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product );
	$max_qty = user_warehouse_qty($product->get_sku(), $max_qty);
	woocommerce_quantity_input(
		array(
			'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
			'max_value'   => $max_qty,
			'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
		)
	);

	do_action( 'woocommerce_after_add_to_cart_quantity' );
	?>

	<?php
		$button_label = ra_lang('Add Product');
		if (has_term('accessories', 'product_cat')) {
			$button_label = 'Add Accessory';
		}

		$add_to_cart_button_label = get_field('product_info_add_to_cart_button_label');
		if ($add_to_cart_button_label) {
			$button_label = $add_to_cart_button_label;
		}
	?>

	<!-- <button type="submit" class="single_add_to_cart_button alt o-btn">Add<?php echo '<span class="js-selected-price price">' . wc_price($product->get_price()) . '</span>'; ?></button> -->
	<button type="submit" data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button alt o-btn"><?php echo ra_lang($button_label); ?></button>
	<a href="<?php echo SITE; ?>/shop" class="c-single-product__continue">Keep Shopping</a>
	<!-- <a href="<?php echo the_permalink(); ?>" class="o-btn o-btn--outline o-btn--noarrow c-single-product__moreinfo">More Info</a> -->

	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
</div>
