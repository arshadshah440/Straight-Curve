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
                 <img src="<?php echo get_template_directory_uri(); ?>/assets/img/Vector (42).svg" alt="Close Icon">
             </button>
             <!-- title  -->
             <h2 class="str-cart-title-am">Your Order</h2>
         </div>
         <div class="str-cart-order-btn-am">
             <div class="str-cart-content-am">
                 <div class="str-cart-content-inner-am">
                     <?php if (WC()->cart->is_empty()) : ?>
                         <p>Your <?php echo  is_user_logged_in() ? "Cart" : "Quote" ?> is currently empty.</p>
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
                                    $total_price = $cart_item['line_total'];
                                    $total_price = number_format($total_price, 2);
                                    $meters = floatval($product_quantity * 7.2);
                                    $meters = number_format($meters, 2);
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
                                     <div class="str-cart-order-content-inner-am cart_closer_wrapper_ar">
                                         <div class="str-cart-img-content-am">
                                             <div class="str-cart-order-img-am">
                                                 <?php echo $product_image; // Display product image 
                                                    ?>
                                             </div>
                                             <div class="str-cart-order-name-am">
                                                 <p datameters="<?php echo $cart_item['meters']; ?>"><?php echo esc_html($product_name); // Display product name 
                                                                                                        ?> <?php echo $cart_item['meters'] ? '(' . $meters . ')' : ''; ?></p>
                                                 <!-- Quantity with plus-minus -->
                                                 <div class="str-qoute-quantity-am addtocart_loop_ar mini_cart_quantity_ar" data-cart-key="<?php echo $cart_item_key ?>">
                                                     <?php echo $quantity_input; // WooCommerce quantity input 
                                                        ?>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="str-cart-order-delete-am">
                                             <div class="remvoer_side_ar">
                                                 <?php echo $remove_button; // Remove button 
                                                    ?>
                                                 <?php
                                                    if (is_user_logged_in()) {
                                                    ?>
                                                     <h6>$<?php echo $total_price; ?></h6>
                                                 <?php
                                                    }
                                                    ?>
                                             </div>
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
                 <div class="str-cart-addquote-btn-am <?php echo (WC()->cart->is_empty()) ? 'show_it_ar' : 'hide_it_ar'; ?>">
                     <a href="<?php echo is_user_logged_in() ? home_url('/diy-with-payment/#tabs_find_edege_ar') : home_url('/diy-garden-edging/#tabs_find_edege_ar') ?>" class="str-cart-addquote-btnbtn-am"><?php echo is_user_logged_in() ? "Add To Cart" : "Add To Quote" ?></a>
                 </div>
             </div>
             <!-- Add to quote Button  -->
             <div class="for_loggined_user_ar">
                 <?php if (is_user_logged_in()) {
                    ?>
                     <div class="d_cart_flex_ar" id="mini_total_quantity_ar">
                         <h5>Total QTY:</h5>
                         <h6><?php echo WC()->cart->get_cart_contents_count(); ?></h6>
                     </div>
                     <div class="d_cart_flex_ar" id="mini_total_price_ar">
                         <h5>Total Price:</h5>
                         <h6> <span>Incl.VAT </span><?php echo '$' . number_format(WC()->cart->get_cart_contents_total(), 2); ?></h6>
                     </div>
                 <?php
                    } ?>
                 <div class="str-cart-quote-btn-am <?php echo (WC()->cart->is_empty()) ? 'disabledbtn_ar' : ''; ?> ">
                     <button class="str-cart-quote-btnbtn-am" type="button" id="update_cart_ar"><?php echo is_user_logged_in() ? "Checkout" : "Finalise Quote" ?></button>
                 </div>

             </div>

         </div>
     </div>
 </div>