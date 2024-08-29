<?php
if (isset($args['ID'])) :
	$price_suffix = isset($args['price_suffix']) && $args['price_suffix'] ? $args['price_suffix'] : null;
	$meter_per_set = isset($args['meter_per_set']) && $args['meter_per_set'] ? $args['meter_per_set'] : null;

	$current_site = current_site();
	$button_label = 'Shop Options';
	if ($current_site && $current_site === 'nl') {
		$button_label = 'Maak uw bestelling';
	}

	$args = array(
		'post_type' => 'product',
		'post_status' => 'publish',
		'posts_per_page' => 1,
		'post__in' => array($args['ID'])
	);
	$loop = new WP_Query( $args );
	if ( $loop->have_posts() ) :
		while ( $loop->have_posts() ) : $loop->the_post();
			global $product;
			$product_type = $product->get_type();
			$product_id = esc_attr( $product->get_id() );
			$is_in_stock = user_warehouse_qty($product->get_sku());

			echo '<div class="c-quickbuy">';
			if ($product_type === 'simple') {
				echo '<div class="c-addtocart">';
				set_query_var('price_suffix', $price_suffix);

				if ($meter_per_set) { ?>
					<div class="c-quickbuy__addtocart" data-product-id="<?php echo $product_id; ?>" data-price="<?php echo $product->get_price(); ?>" data-meter="<?php echo $meter_per_set; ?>">
						<div class="c-quickbuy__addtocart-inputwrap">
							<div class="c-quickbuy__addtocart-input">
								<input type="number" class="js-meter-required" placeholder="Enter metres required">
								<span class="c-quickbuy__addtocart-set"><span class="js-sets-required">0</span> sets</span>
							</div>
							<?php if ($is_in_stock) : ?>
								<a href="javascript:void(0);" class="o-btn js-quickbuy-addtocart">Add</a>
							<?php else : ?>
								<span class="c-quickbuy__addtocart-outofstocklabel o-btn o-btn--outline o-btn--noarrow"><?php echo ra_lang('Out of stock'); ?></span>
							<?php endif; ?>

						</div>
						<div class="c-quickbuy__addtocart-totalprice"><?php echo get_woocommerce_currency_symbol(); ?><span class="js-quickbuy-total">0.00</span> <?php echo $price_suffix; ?></div>
					</div>
				<?php } else {
					do_action( 'woocommerce_simple_add_to_cart' );
				}
				echo '</div>';
			} else {
				echo '<a href="javascript:void(0);" class="js-productview o-btn o-btn--noarrow c-product__action-add" data-id="' . $product->get_id() . '">' . $button_label . '</a>';
			}
			echo '</div>';
		endwhile;
	endif;
	wp_reset_postdata();

endif; ?>