<?php

$screws_skus = array(
	'TSCZ12G-B20' 		=> array( 'type' => 'zinc', 'cart_qty' => 0, 'amount_in_cart' => 0, 'amount' => 20 ),
	'TSCZ12G-B20-BLK' 	=> array( 'type' => 'zinc', 'cart_qty' => 0, 'amount_in_cart' => 0, 'amount' => 2000 ),
	'TSCZ12G-B50' 		=> array( 'type' => 'zinc', 'cart_qty' => 0, 'amount_in_cart' => 0, 'amount' => 50 ),
	'TSCZ12G-B50-BLK'	=> array( 'type' => 'zinc', 'cart_qty' => 0, 'amount_in_cart' => 0, 'amount' => 5000 ),
	'TSCZ12G-B250'		=> array( 'type' => 'zinc', 'cart_qty' => 0, 'amount_in_cart' => 0, 'amount' => 250 ),
	'TSCZ12G-B250-BLK'	=> array( 'type' => 'zinc', 'cart_qty' => 0, 'amount_in_cart' => 0, 'amount' => 4500 ),

	'TSDM12G-B20' 		=> array( 'type' => 'dacromet', 'cart_qty' => 0, 'amount_in_cart' => 0, 'amount' => 20 ),
	'TSDM12G-B20-BLK' 	=> array( 'type' => 'dacromet', 'cart_qty' => 0, 'amount_in_cart' => 0, 'amount' => 2000 ),
	'TSDM12G-B50' 		=> array( 'type' => 'dacromet', 'cart_qty' => 0, 'amount_in_cart' => 0, 'amount' => 50 ),
	'TSDM12G-B50-BLK'	=> array( 'type' => 'dacromet', 'cart_qty' => 0, 'amount_in_cart' => 0, 'amount' => 5000 ),
	'TSDM12G-B250'		=> array( 'type' => 'dacromet', 'cart_qty' => 0, 'amount_in_cart' => 0, 'amount' => 250 ),
	'TSDM12G-B250-BLK'	=> array( 'type' => 'dacromet', 'cart_qty' => 0, 'amount_in_cart' => 0, 'amount' => 4500 ),
);

$cart_skus = array();
foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
	$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
	$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
	$product_sku = $_product->get_sku();
	if ($product_sku) {
		$product_sku = strtoupper( trim( $product_sku ) );
		$cart_skus[$product_sku] = $cart_item['quantity'];

		if (isset($screws_skus[$product_sku])) {
			$screws_skus[$product_sku]['cart_qty'] = $screws_skus[$product_sku]['cart_qty'] + $cart_item['quantity'];
		}
	}
}

$fixing = array(
	'required' => 0,
	'zinc' => 0,
	'dacromet' => 0
);
if (count($cart_skus) > 0) {
	$required = get_sku_info();

	foreach ($cart_skus as $sku => $qty) {
		if ($required[$sku]) {
			$fixing['required'] = $fixing['required'] + ($required[$sku]['ReqScrew'] * $qty);
			if ($required[$sku]['ScrewType'] === 'zinc') {
				$fixing['zinc'] = $fixing['zinc'] + ($required[$sku]['ReqScrew'] * $qty);
			}
			if ($required[$sku]['ScrewType'] === 'dacromet') {
				$fixing['dacromet'] = $fixing['dacromet'] + ($required[$sku]['ReqScrew'] * $qty);
			}
		}
	}
}

$screw_amount_in_cart = array(
	'zinc' => 0,
	'dacromet' => 0
);
foreach ($screws_skus as $sku => $item) {
	if (isset($item['cart_qty']) && $item['cart_qty'] > 0 && isset($screw_amount_in_cart[$item['type']])) {
		$screw_amount_in_cart[$item['type']] = $screw_amount_in_cart[$item['type']] + ($item['cart_qty'] * $item['amount']);
	}
}

// Check how many Zinc screws in cart.
if ($fixing['zinc'] && $fixing['zinc'] > 0) {
	if ($screw_amount_in_cart['zinc'] && $screw_amount_in_cart['zinc'] > $fixing['zinc']) {
		$fixing['required'] = $fixing['required'] - $fixing['zinc'];
		$fixing['zinc'] = 0;
	} elseif ($screw_amount_in_cart['zinc'] && $screw_amount_in_cart['zinc'] > 0) {
		$fixing['required'] = $fixing['required'] - $screw_amount_in_cart['zinc'];
		$fixing['zinc'] = $fixing['zinc'] - $screw_amount_in_cart['zinc'];
	}
}

// Check how many Dacromet screws in cart.
if ($fixing['dacromet'] && $fixing['dacromet'] > 0) {
	if ($screw_amount_in_cart['dacromet'] && $screw_amount_in_cart['dacromet'] > $fixing['dacromet']) {
		$fixing['required'] = $fixing['required'] - $fixing['dacromet'];
		$fixing['dacromet'] = 0;
	} elseif ($screw_amount_in_cart['dacromet'] && $screw_amount_in_cart['dacromet'] > 0) {
		$fixing['required'] = $fixing['required'] - $screw_amount_in_cart['dacromet'];
		$fixing['dacromet'] = $fixing['dacromet'] - $screw_amount_in_cart['dacromet'];
	}
}

$show_overlay = false;
if ($fixing['required'] && $fixing['required'] > 0) {
	$show_overlay = true;
	$fixing_products = get_field('fixing_products', 'options');
}

// NL disable checkout
if (current_site() === 'nl') {
	$show_overlay = false;
}
if ($show_overlay) :
?>
<div class="c-product-overlay c-fixing-overlay js-fixing-overlay" hidden>
	<div class="c-product-overlay__content">
		<a href="javascript:void(0);" class="c-product-overlay__close c-fixing-overlay__close js-overlay-close"><i class="fal fa-times"></i></a>
		<div class="">
			<h2 class="c-fixing-overlay__title">Don't forget your screws!</h2>
			<p class="c-fixing-overlay__copy">Based on the products in your cart, you'll require <?php
				if ($fixing['dacromet'] && $fixing['dacromet'] > 0) {
					echo '<strong>' . $fixing['dacromet'] . ' Dacromet screws</strong>';
					if ($fixing['zinc'] && $fixing['zinc'] > 0) {
						echo ' and ';
					}
				}
				if ($fixing['zinc'] && $fixing['zinc'] > 0) {
					echo '<strong>' . $fixing['zinc'] . ' Zinc screws</strong>';
				}
			 ?> for your project. Select the correct bag quantity to suit your requirements.</p>
			<?php
				woocommerce_product_loop_start();
				$args = array(
					'post_type' => 'product',
					'posts_per_page' => 1,
					'orderby' => 'post__in',
					'post__in' => array()
				);
			?>
			<?php foreach ($fixing_products as $type => $item) : ?>
				<?php if ($fixing[$type]) : ?>
				<h3 class="c-fixing-overlay__sub-title"><?php echo $fixing[$type]; ?> <?php echo $type; ?> screw recommended.</h3>
				<?php
					$args['post__in'] = array($item);
					$loop = new WP_Query( $args );
					if ( $loop->have_posts() ) {
						while ( $loop->have_posts() ) : $loop->the_post();
							wc_get_template_part( 'single-product-brief' );
						endwhile;
					}
					wp_reset_postdata();
				?>
				<?php endif; ?>
			<?php endforeach; ?>
			<?php woocommerce_product_loop_end(); ?>
		</div>
		<div class="c-fixing-overlay__done"><a href="javascript:void(0);" class="o-btn o-btn--orange js-overlay-close c-fixing-overlay__close">Next</a></div>
	</div>
</div><?php endif; ?>