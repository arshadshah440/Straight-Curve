<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 6.1.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

$product_info = get_field('product_info');
$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );
$custom_add_to_cart = false;
if (count($attributes) === 1 && isset($attributes['pa_length']) && count($attributes['pa_length']) > 0 && isset($product_info['is_box_product']) && $product_info['is_box_product']) {
	$custom_add_to_cart = true;
}
if (count($attributes) === 1 && isset($attributes['pa_amount']) && count($attributes['pa_amount']) > 0) {
	$custom_add_to_cart = true;
}
if (count($attributes) === 2 && isset($attributes['pa_amount']) && count($attributes['pa_amount']) > 0 && isset($attributes['pa_length']) && count($attributes['pa_length']) > 0) {
	$custom_add_to_cart = true;
}
if (count($attributes) === 2 && isset($attributes['pa_amount']) && count($attributes['pa_amount']) > 0 && isset($attributes['pa_bag-qty']) && count($attributes['pa_bag-qty']) > 0) {
	$custom_add_to_cart = true;
}

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart js-multivariation-form" data-pagelink="<?php echo (is_product() ? '' : get_the_permalink()); ?>" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ) ) ); ?></p>
	<?php else : ?>
		<table class="variations" cellspacing="0">
			<tbody>
				<?php if ($custom_add_to_cart) : ?>
					<div class="c-addtocart__custom-variations">
						<div class="c-addtocart__custom-variation c-addtocart__custom-variation--label">
							<div class="c-addtocart__custom-variation-title"><?php echo ra_lang('Variant'); ?></div>
							<div class="c-addtocart__custom-variation-price"><?php echo ra_lang('Price'); ?></div>
							<?php if (current_site() !== 'nl') : ?>
								<div class="c-addtocart__custom-variation-stock">In Stock</div>
							<?php endif; ?>
							<div class="quantity c-quantity"><?php echo ra_lang('Quantity'); ?></div>
						</div>
						<?php
						foreach ($available_variations as $key => $item) {
							$available_variations[$key]['menu_order'] = get_post_field('menu_order', $item['variation_id']);
						}

						usort($available_variations, function($a, $b) {
							return $a['menu_order'] - $b['menu_order'];
						});

						foreach ($available_variations as $key =>  $item) :
							$attr_count = count($item['attributes']);
							$class = '';

							if ($attr_count > 1 && (isset($item['attributes']['attribute_pa_length']) || isset($item['attributes']['attribute_pa_bag-qty']))) {
								if (isset($item['attributes']['attribute_pa_length'])) {
									$devider_attr = 'attribute_pa_length';
								} elseif (isset($item['attributes']['attribute_pa_bag-qty'])) {
									$devider_attr = 'attribute_pa_bag-qty';
								}


								$prev_attr = '';
								$next_attr = '';
								$curr_attr = $item['attributes'][$devider_attr];
								if (isset($available_variations[$key - 1]['attributes'][$devider_attr])) {
									$prev_attr = $available_variations[$key - 1]['attributes'][$devider_attr];
								}
								if (isset($available_variations[$key + 1]['attributes'][$devider_attr])) {
									$next_attr = $available_variations[$key + 1]['attributes'][$devider_attr];
								}
								if ($curr_attr !== $next_attr && $curr_attr === $prev_attr) {
									$class .= 'devider';
								}
							}

							$item['max_qty'] = user_warehouse_qty($item['sku'], $item['max_qty']);
							if ($item['max_qty'] == -1) {
								$item['max_qty'] = null;
							}
						?><div class="c-addtocart__custom-variation <?php echo $class; ?>" data-variation="<?php echo $item['variation_id']; ?>">
								<div class="c-addtocart__custom-variation-title"><?php
									if (isset($product_info['finish']) && $product_info['finish']) {
										echo '<span class="steel">' . ra_lang($product_info['finish']) . '</span>';
									}
									$i = 1;
									foreach ($item['attributes'] as $tax => $attr) {
										$meta = get_post_meta($item['variation_id'], $tax, true);
										$term = get_term_by('slug', $meta, str_replace('attribute_', '', $tax));
										$sufix = '';
										$prefix = '';
										if ($tax === 'attribute_pa_length') {
											$sufix = ' length';
										}
										if (isset($item['sku']) && $i === $attr_count) {
											$sufix .= ' / ' . $item['sku'];
										}
										if ($tax === 'attribute_pa_bag-qty') {
											$prefix = 'Bag Qty: ';
										}
										echo '<span class="attr">' . $prefix . $term->name . $sufix . '</span>';
										$i++;
									}
								?></div>
								<div class="c-addtocart__custom-variation-price"><?php echo $item['price_html']; ?></div>
								<?php if (current_site() !== 'nl') : ?>
									<div class="c-addtocart__custom-variation-stock"><?php echo $item['max_qty']; ?></div>
								<?php endif; ?>
								<div class="quantity c-quantity">
									<?php if (!$item['is_in_stock'] || $item['max_qty'] == 0) : ?>
										<?php echo ra_lang('Out of stock'); ?>
									<?php else : ?>
										<label for="variation-<?php echo $item['variation_id']; ?>"><span class="screen-reader-text"><?php echo esc_attr( $product->name ); ?> </span>Quantity:</label>
										<div class="c-quantity__field">
											<a href="javascript:void(0);" class="js-qty c-quantity__action minus" data-action="minus">-</a>
											<input type="number" id="variation-<?php echo $item['variation_id']; ?>" data-variation=<?php echo $item['variation_id']; ?> class="input-text qty text" step="1" min="0" max="<?php echo $item['max_qty']; ?>" name="quantity-<?php echo $item['variation_id']; ?>" value="0" title="Qty" size="4" inputmode="numeric">
											<a href="javascript:void(0);" class="js-qty c-quantity__action plus" data-action="plus">+</a>
										</div>
									<?php endif; ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php else : ?>
					<?php foreach ( $attributes as $attribute_name => $options ) : ?>
						<tr>
							<td class="label">
								<?php
									wc_dropdown_variation_attribute_options(
										array(
											'options'   => $options,
											'attribute' => $attribute_name,
											'product'   => $product,
										)
									);
									echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) ) : '';
								?>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>

		<?php if ($custom_add_to_cart) : ?>
			<?php
				$button_label = 'Add Product';
				if (has_term('accessories', 'product_cat')) {
					$button_label = 'Add Accessory';
				} elseif (!is_product()) {
					$button_label = 'Next';
				}

				$add_to_cart_button_label = get_field('product_info_add_to_cart_button_label');
				if ($add_to_cart_button_label) {
					$button_label = $add_to_cart_button_label;
				}
			?>
			<div class="text-right">
				<button class="o-btn multi_add_to_cart_button <?php echo ($button_label === 'Next' ? 'o-btn--orange' : ''); ?>" data-product_id="<?php echo esc_attr( $product->get_id() ); ?>"><?php echo ra_lang($button_label); ?></button>
			</div>
		<?php else : ?>
			<div class="c-addtocart__price"><?php echo '<span class="js-selected-price price">' . wc_price($product->get_price()) . '</span>'; ?></div>

			<div class="c-addtocart__fields-wrap">
				<div class="single_variation_wrap">
					<?php
						/**
						 * Hook: woocommerce_before_single_variation.
						 */
						do_action( 'woocommerce_before_single_variation' );

						/**
						 * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
						 *
						 * @since 2.4.0
						 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
						 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
						 */
						do_action( 'woocommerce_single_variation' );

						/**
						 * Hook: woocommerce_after_single_variation.
						 */
						do_action( 'woocommerce_after_single_variation' );
					?>
				</div>
			</div>
		<?php endif; ?>

	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
