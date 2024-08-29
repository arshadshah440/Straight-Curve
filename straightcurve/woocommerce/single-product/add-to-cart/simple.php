<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

$price_suffix = get_query_var('price_suffix');
echo wc_get_stock_html( $product ); // WPCS: XSS ok.

if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<div class="c-addtocart__price"><?php
			echo '<span class="js-selected-price price">' . wc_price($product->get_price()) . '</span>';
			if ($price_suffix) {
				echo '<span class="c-addtocart__price-suffix"><small>' . $price_suffix . '</small></span>';
			}
		?></div>

		<div class="c-addtocart__fields-wrap">
			<?php
			do_action( 'woocommerce_before_add_to_cart_quantity' );

			$max_qty = apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product );
			$max_qty = user_warehouse_qty($product->get_sku(), $max_qty);
			woocommerce_quantity_input(
				array(
					'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
					'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
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

			<!-- <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button alt o-btn">Add<?php echo '<span class="js-selected-price price">' . wc_price($product->get_price()) . '</span>'; ?></button> -->
			<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button alt o-btn"><?php echo ra_lang($button_label); ?></button>
		</div>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>