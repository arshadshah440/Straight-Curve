<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_mini_cart' ); ?>
<?php
	global $woocommerce;
	$cart_count = $woocommerce->cart->cart_contents_count;

	$free_products = get_field('free_products', 'options');
	$no_qty_for = array();
	if (isset($free_products['free_spike']->ID)) {
		$no_qty_for[] = $free_products['free_spike']->ID;
	}
	if (isset($free_products['free_peg']->ID)) {
		$no_qty_for[] = $free_products['free_peg']->ID;
	}
?>
<span class="c-minicart__top-count"><span><?php echo $cart_count; ?></span></span>

<?php if ( ! WC()->cart->is_empty() ) : ?>
	<form class="c-minicart__content" id="minicart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">

	<ul class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr( $args['list_class'] ); ?>">
		<?php
		do_action( 'woocommerce_before_mini_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
				$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
				$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
				<li class="js-minicart-item woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>" data-product="<?php echo $product_id; ?>" <?php echo ($cart_item['variation_id'] ? 'data-variation="' . $cart_item['variation_id'] . '"' : ''); ?> data-qty="<?php echo (!in_array($product_id, $no_qty_for) ? $cart_item['quantity'] : ''); ?>">
					<?php
						$image_url = '';
						if ($_product->get_image_id()) {
							$image_url = wp_get_attachment_image_url($_product->get_image_id(), 'preview');
						}
						if (empty( $product_permalink )) {
							echo '<span class="mini_cart_item_thumb" style="background-image: url(' . $image_url. ')"></span>';
						} else {
							echo '<a class="mini_cart_item_thumb is-link" href="' . esc_url( $product_permalink ) . '" style="background-image: url(' . $image_url. ')"></a>';
						}
					?>
					<div class="mini_cart_item_content">
						<div class="mini_cart_item_title">
							<?php
							echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								'woocommerce_cart_item_remove_link',
								sprintf(
									'<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><i class="fal fa-minus-circle" aria-hidden="true"></i></a>',
									esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
									esc_attr__( 'Remove this item', 'woocommerce' ),
									esc_attr( $product_id ),
									esc_attr( $cart_item_key ),
									esc_attr( $_product->get_sku() )
								),
								$cart_item_key
							);
							?>
							<?php if ( empty( $product_permalink ) ) :
								echo $product_name;
							else : ?>
								<a href="<?php echo esc_url( $product_permalink ); ?>"><?php echo $product_name; ?></a>
							<?php endif; ?>
						</div>
						<div class="mini_cart_item_qty_price">
							<div class="mini_cart_item_qty">
								<?php
									if ( in_array($product_id, $no_qty_for) ) {
										$product_quantity = sprintf( '<div class="mini_cart_item_qty_ind">%s</div>', $cart_item['quantity']	 );
									} elseif ( $_product->is_sold_individually() ) {
										$product_quantity = sprintf( '<div class="mini_cart_item_qty_ind">1 <input type="hidden" name="cart[%s][qty]" value="1" /></div>', $cart_item_key );
									} else {
										$max_qty = $_product->get_max_purchase_quantity();
										$max_qty = user_warehouse_qty($_product->get_sku(), $max_qty);
										$product_quantity = woocommerce_quantity_input(
											array(
												// 'input_name'   => "cart[{$cart_item_key}][qty]",
												'input_name'   => $cart_item_key,
												'input_value'  => $cart_item['quantity'],
												'max_value'    => $max_qty,
												'min_value'    => '0',
												'product_name' => $_product->get_name(),
											),
											$_product,
											false
										);
									}

									echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
								?>
							</div>
							<div class="mini_cart_item_price">
								<?php // echo $product_price; ?>
								<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
							</div>
						</div>

					</div>

				</li>
				<?php
			}
		}

		do_action( 'woocommerce_mini_cart_contents' );
		?>
	</ul>
	<div class="hidden" hidden><button>Update</button></div>

	</form>
	<div class="c-minicart__bottom">
		<p class="woocommerce-mini-cart__total total">
			<?php
			/**
			 * Hook: woocommerce_widget_shopping_cart_total.
			 *
			 * @hooked woocommerce_widget_shopping_cart_subtotal - 10
			 */
			do_action( 'woocommerce_widget_shopping_cart_total' );
			?>
		</p>
		<!-- <div class="c-minicart__buttons c-minicart__buttons--1">
			<a href="<?php echo SITE; ?>/shop" class="o-btn half-left">Back</a><a href="<?php echo SITE; ?>/cart" class="o-btn half-right">Review</a>
		</div>
		<div class="c-minicart__buttons c-minicart__buttons--2">
			<a href="<?php echo SITE; ?>/shop/accessory" class="o-btn full">Next</a>
			<p>Skip Accessories, go to <a href="<?php echo SITE; ?>/checkout">checkout</a>
		</div>
		<div class="c-minicart__buttons c-minicart__buttons--alt">
			<a href="<?php echo SITE; ?>/cart" class="o-btn half-left">Cart</a><a href="<?php echo SITE; ?>/checkout" class="o-btn half-right">Checkout</a>
		</div> -->
		<div class="c-minicart__buttons c-minicart__buttons--checkout">

			<?php // NL disable checkout
			if (current_site() === 'nl') : ?>
				<a href="<?php echo esc_url( wp_nonce_url( add_query_arg( array( 'cart-pdf' => '1' ), wc_get_cart_url() ), 'cart-pdf' ) ); ?>" class="cart-pdf-button button mini-cart" target="_blank">
					<?php echo esc_html( get_option( 'wc_cart_pdf_button_label', __( 'Download Cart as PDF', 'wc-cart-pdf' ) ) ); ?>
				</a>
			<?php else : ?>
				<a href="<?php echo SITE; ?>/checkout" class="o-btn full">Checkout</a>
				<p><a href="<?php echo SITE; ?>/cart">Review cart</a>
			<?php endif; ?>

		</div>

		<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

		<p class="woocommerce-mini-cart__buttons buttons"><?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?></p>

		<?php do_action( 'woocommerce_widget_shopping_cart_after_buttons' ); ?>
	</div>

<?php else : ?>

	<p class="woocommerce-mini-cart__empty-message"><?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></p>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
