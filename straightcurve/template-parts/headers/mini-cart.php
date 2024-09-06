<?php

global $current_site;
$currid = $current_site->site_id;
$current_site_name = get_bloginfo('name');

?>
<!-- str cart section -->
<div class="str-cart-section-am" cur-site="<?php echo $current_site->site_id; ?>" cur-site-name="<?php echo $current_site_name; ?>" cur-site-id="<?php echo $current_site_id; ?>">
    <div class="str-cart-section-inner-am">
        <!-- cross icon  -->
        <div class="str-cross-heading-am">
            <button class="str-cart-cross-icon-am" type="button">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/Vector (32).svg" alt="Close Icon">
            </button>
            <!-- title  -->
            <h2 class="str-cart-title-am">Your Order</h2>
        </div>
        <div class="str-cart-order-btn-am">
            <div class="str-cart-content-am">
                <div class="str-cart-content-inner-am">
                    <?php if (WC()->cart->is_empty()) : ?>
                        <p>Your cart is currently empty.</p>
                    <?php else : ?>

                        <form class="woocommerce-cart-form" action="<?php echo esc_url(home_url('/quote/')); ?>" method="post">
                            <?php
                            $cart_items = WC()->cart->get_cart();
                            foreach ($cart_items as $cart_item_key => $cart_item) {
                                $product        = $cart_item['data'];
                                $product_id     = $product->get_id();
                                $product_name   = $product->get_name();
                                $product_image  = $product->get_image(); // Product featured image
                                $product_quantity = $cart_item['quantity'];

                                // Quantity selector
                                $quantity_input = woocommerce_quantity_input(array(
                                    'input_name'  => "cart[{$cart_item_key}][qty]",
                                    'input_value' => $product_quantity,
                                    'max_value'   => $product->get_max_purchase_quantity(),
                                    'min_value'   => '1',
                                ), $product, false);

                                // Remove from cart button
                                $remove_url = esc_url(wc_get_cart_remove_url($cart_item_key));
                                $removebtnur = get_template_directory_uri() . '/assets/img/Vector (33).svg';
                                $remove_button = sprintf(
                                    '<a href="%s" class="str-qoute-order-delete-icon-am remove remove_from_cart_ar" aria-label="%s" data-product_id="%s" data-product_sku="%s"><img src="' . $removebtnur . '" alt="delete"></a>',
                                    $remove_url,
                                    __('Remove this item', 'woocommerce'),
                                    esc_attr($product_id),
                                    esc_attr($product->get_sku())
                                );
                            ?>

                                <!-- Custom cart item structure -->
                                <div class="str-cart-order-content-am">
                                    <div class="str-cart-order-content-inner-am">
                                        <div class="str-cart-img-content-am">
                                            <div class="str-cart-order-img-am">
                                                <?php echo $product_image; // Display product image 
                                                ?>
                                            </div>
                                            <div class="str-cart-order-name-am">
                                                <p><?php echo esc_html($product_name); // Display product name 
                                                    ?></p>
                                                <!-- Quantity with plus-minus -->
                                                <div class="str-qoute-quantity-am addtocart_loop_ar">
                                                    <?php echo $quantity_input; // WooCommerce quantity input 
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="str-cart-order-delete-am">
                                            <?php echo $remove_button; // Remove button 

                                            ?>
                                        </div>
                                    </div>

                                </div>

                            <?php
                            }
                            ?>

                            <!-- Update Cart Button -->
                            <button type="submit" class="button" name="update_cart" value="<?php esc_attr_e('Update Cart', 'woocommerce'); ?>"><?php esc_html_e('Update Cart', 'woocommerce'); ?></button>

                            <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
                        </form>

                    <?php endif; ?>
                </div>
            </div>
            <!-- Add to quote Button  -->
            <div class="str-cart-quote-btn-am">
                <button class="str-cart-quote-btnbtn-am" type="button" id="update_cart_ar">Add to Quote</button>
            </div>
        </div>
    </div>
</div>