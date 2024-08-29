<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$product_id = $product->get_id();
$link = get_the_permalink($product_id);
$image = get_the_post_thumbnail_url($product_id);
if (!$image) { $image = ASSETS . '/img/woocommerce-placeholder.png'; }
$product_info = get_field('product_info');
$terms = get_the_terms( $product_id, 'product_tag' );
$term = null;
if ($terms && count($terms) > 0) {
	$term = $terms[0];
}

$product_cat = get_the_terms( $product_id, 'product_cat' );
$ra_product_type = get_the_terms( $product_id, 'ra_product_type' );
$ra_product_height = get_the_terms( $product_id, 'ra_product_height' );


$classes = 'c-product o-layout__item o-module__item u-1/4@tabletWide u-1/3@tablet u-1/2@mobileLandscape';
if (current_site() === 'uk' && !is_live()) {
	// $classes = 'c-product o-layout__item o-module__item u-1/3@tabletWide u-1/3@tablet u-1/2@mobileLandscape';
}

$is_accs_prod = false;
foreach ($product_cat as $cat) {
	$classes .= ' cat-' . $cat->slug;
	if ($cat->slug === 'accessories' && !$is_accs_prod) {
		$is_accs_prod = true;
	}
}
foreach ($ra_product_type as $cat) {
	$classes .= ' type-' . $cat->slug;
}
foreach ($ra_product_height as $cat) {
	$classes .= ' height-' . $cat->slug;
}

if (isset($product_info['finish']) && $product_info['finish']) {
	$classes .= ' finish-' . stripString($product_info['finish']);
}

$is_in_stock = false;
$stocks = array();
if ($product->is_type('variable')) {
	$variations = $product->get_available_variations();
	foreach ($variations as $key => $item) {
		if ($item['is_in_stock']) {
			$item['max_qty'] = user_warehouse_qty($item['sku'], $item['max_qty']);
			$stock = user_warehouse_qty($item['sku']);
			$stocks[$item['sku']] = $stock;
			if ($stock && ($stock === -1 || $stock > 0)) {
				$is_in_stock = true;
			}
		}
	}
} else {
	$stock = user_warehouse_qty($product->get_sku());
	$stocks[$product->get_sku()] = $stock;
	if ($stock && ($stock === -1 || $stock > 0)) {
		$is_in_stock = true;
	}
}


?><li <?php wc_product_class( $classes, $product ); ?> <?php echo ($is_accs_prod && is_shop() ? 'hidden' : ''); ?>>
	<div class="c-product__inner">
		<div class="c-product__thumb-wrap">
			<?php if ($is_in_stock) : ?>
				<span class="c-product__instock">In stock</span>
			<?php endif; ?>
			<a href="javascript:void(0);" class="c-product__fav js-fav far fa-heart" data-id="<?php echo get_the_ID(); ?>" title="Favourite this product"></a>
			<?php if (isset($term->name)) : ?>
				<span class="c-product__tag"><?php echo $term->name; ?></span>
			<?php endif; ?>
			<div class="c-product__thumb" data-src="<?php echo $image; ?>"></div>
		</div>
		<div class="c-product__content">
			<h3 class="c-product__title"><?php echo $product->get_name(); ?></h3>
			<?php if ($product_info && $product_info['details']) : ?>
				<p class="c-product__details"><?php echo $product_info['details']; ?></p>
			<?php endif; ?>
			<?php if ($product_info && $product_info['finish']) : ?>
				<!-- <p class="c-product__finish"><?php echo ra_lang($product_info['finish']); ?></p> -->
			<?php endif; ?>
		</div>

		<div class="c-product__action">
			<?php // do_action( 'woocommerce_after_shop_loop_item' ); ?>
			<a href="javascript:void(0);" class="js-productview o-btn o-btn--noarrow c-product__action-add" data-id="<?php echo $product_id; ?>"><span>Add</span> <span><?php
				// echo $product->get_price_html();
				echo wc_price($product->get_price());
			?></span></a>
			<a href="javascript:void(0);" class="js-productview o-btn o-btn--noarrow o-btn--orange c-product__action-added" data-id="<?php echo $product_id; ?>">Added</a>
			<div class="c-product__link">
				<a href="<?php echo $link; ?>" target="_blank">More information <i class="fal fa-long-arrow-right"></i></a>
			</div>
		</div>
	</div>
</li>