<?php if (is_dealer_user()) :
$brochure_popup = get_field('brochure_popup', 'options');

$show_overlay = false;
if (is_dealer_user() && isset($brochure_popup['is_active'], $brochure_popup['product']->ID) && $brochure_popup['is_active'] && $brochure_popup['product']->post_status === 'publish') {

	$brochure_product = wc_get_product( $brochure_popup['product']->ID );
	if ($brochure_product && $brochure_product->is_in_stock()) {
		$brochure_product_id = $brochure_product->get_id();
		$brochure_product_stock = user_warehouse_qty($brochure_product->get_sku());
		if (!$brochure_product_stock) {
			$brochure_product_stock = -1;
		}
	}

	$in_cart = false;
	foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
		$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
		$product_sku = $_product->get_sku();
		if ($product_sku === $brochure_product->get_sku()) {
			$in_cart = true;
		}
	}

	if (!$in_cart && isset($brochure_product_stock) && ($brochure_product_stock === -1 || $brochure_product_stock > 0)) {
		$show_overlay = true;
	} else {
		$show_overlay = false;
	}

}
if ($show_overlay) : ?>
<div class="c-product-overlay c-brochure-popup js-brochure-popup" hidden>
	<div class="c-fixing-overlay__content c-product-overlay__content">
		<a href="javascript:void(0);" class="c-product-overlay__close js-overlay-close"><i class="fal fa-times"></i></a>
		<div class="">
			<?php if ($brochure_popup['title']) : ?>
				<h2 class="c-fixing-overlay__title"><?php echo $brochure_popup['title']; ?></h2>
			<?php endif; ?>
			<?php if ($brochure_popup['copy']) : ?>
				<div class="c-fixing-overlay__copy"><?php echo $brochure_popup['copy']; ?></div>
			<?php endif; ?>

			<?php
				woocommerce_product_loop_start();
				$args = array(
					'post_type' => 'product',
					'posts_per_page' => 1,
					'orderby' => 'post__in',
					'post__in' => array($brochure_popup['product']->ID)
				);
				$loop = new WP_Query( $args );
				if ( $loop->have_posts() ) {
					while ( $loop->have_posts() ) : $loop->the_post();
						wc_get_template_part( 'single-product-brief' );
					endwhile;
				}
				wp_reset_postdata();
			?>
			<?php woocommerce_product_loop_end(); ?>
		</div>
	</div>
</div><?php endif; ?>
<?php endif; ?>