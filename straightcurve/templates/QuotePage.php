<?php
/* Template Name: Quote Page Template
 */

get_header('quote');

/**************** Hero Section ***************/
$cartitems = WC()->cart->get_cart();

?>
<div class="str-checkout-main-am container_ar_mi">
    <div class="str-checkout-inner-am">
        <div class="str-personal-dtl-section-am">
            <h2 class="str-personal-dtl-title-am">Personal Details</h2>
            <div class="str-form-section-am">
                <div class="str-form-group-am">
                    <label for="str-country-am">Are you a home gardener or professional?<span
                            class="str-check-form-steric-am">*</span></label>
                    <select id="str-country-am" placeholder="Select" required>
                        <option value="" disabled selected hidden>Select</option>
                        <option value="Home Gardener">Home Gardener</option>
                        <option value="Professional Gardener">Professional Gardener</option>
                    </select>
                </div>
                <div class="str-form-group-main-am">
                    <div class="str-form-group-am">
                        <label for="str-first-name-am">First Name<span
                                class="str-check-form-steric-am">*</span></label>
                        <input type="text" id="str-first-name-am" placeholder="Enter First Name" required>
                    </div>
                    <div class="str-form-group-am">
                        <label for="str-email-am">Email Address<span
                                class="str-check-form-steric-am">*</span></label>
                        <input type="email" id="str-email-am" placeholder="Enter email address" required>

                    </div>

                </div>
                <div class="str-form-group-main-am">
                    <div class="str-form-group-am">
                        <label for="str-post-code-am">Postcode<span
                                class="str-check-form-steric-am">*</span></label>
                        <input type="text" id="str-postal-code-am" placeholder="Enter Postcode" required>
                    </div>
                    <div class="str-form-group-am">
                        <label for="str-suburb-am">Suburb<span class="str-check-form-steric-am">*</span></label>
                        <input type="text" id="str-suburb-am" placeholder="Enter Suburb" required>

                    </div>

                </div>
                <div class="str-total-qoute-am">
                    <p>People like you that already requested a quote this year: <span><?php echo get_field('number_of_people_requested_the_quote', 'options'); ?></span></p>

                </div>
            </div>
        </div>
        <div class="str-quote-section-am">
            <h3 class="str-quote-title-am">Your Quote</h3>
            <div class="str-quote-content-am">
                <div class="str-quote-order-am">
                    <div class="str-quote-order-inner-am">
                        <?php if (WC()->cart->is_empty()) : ?>
                            <p>Your cart is currently empty.</p>
                        <?php else : ?>

                            <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
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
                                        '<a href="%s" class="str-qoute-order-delete-icon-am remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><img src="' . $removebtnur . '" alt="delete"></a>',
                                        $remove_url,
                                        __('Remove this item', 'woocommerce'),
                                        esc_attr($product_id),
                                        esc_attr($product->get_sku())
                                    );
                                ?>

                                    <!-- Custom cart item structure -->
                                    <div class="str-quote-order-content-am">
                                        <div class="str-quote-order-content-inner-am">
                                            <div class="str-quote-order-img-am">
                                                <?php echo $product_image; // Display product image 
                                                ?>
                                            </div>
                                            <div class="str-qoute-order-name-am">
                                                <p><?php echo esc_html($product_name); // Display product name 
                                                    ?></p>
                                                <!-- Quantity with plus-minus -->
                                                <div class="str-qoute-quantity-am addtocart_loop_ar">
                                                    <?php echo $quantity_input; // WooCommerce quantity input 
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php echo $remove_button; // Remove button 
                                        ?>
                                    </div>

                                <?php
                                }
                                ?>

                                <!-- Update Cart Button -->
                                <button type="submit" class="button" name="update_cart" value="<?php esc_attr_e('Update Cart', 'woocommerce'); ?>"><?php esc_html_e('Update Cart', 'woocommerce'); ?></button>

                                <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
                            </form>

                        <?php endif; ?>
                        <div class="str-qoute-order-privacy-am">
                            <p>Your data will process your order and enhance your experience; details are in the <a
                                    href="">Privacy Policy</a></p>
                        </div>
                        <div class="str-qoute-order-notice-am">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/Vector (30).svg" alt="exclamation mark">
                            <span>Take this quote to your dealer for a price guarantee</span>
                        </div>

                    </div>

                </div>
                <div class="str-qoute-order-btns-am">
                    <a href="https://strcurvestage.wpengine.com/au/diy-garden-edging/"> <button class="str-qoute-order-addmore-btn-am" type="button">Add More</button> </a>
                    <button class="str-qoute-order-submit-btn-am" type="submit" id="submit_quote_ar">Submit</button>
                </div>
            </div>

        </div>
        <?php
        $sectiondata = get_field('what_you_will_receive_section', 'options');
        $sectitle = $sectiondata['section_title'];
        $receiving_items = $sectiondata['receiving_items'];
        ?>
        <div class="str-what-recive-am">
            <h2 class="str-what-recive-title-am"><?php echo $sectitle; ?></h2>
            <?php
            if (!empty($receiving_items) && is_array($receiving_items) && count($receiving_items) > 0) {
            ?>
                <div class="str-what-recive-content-am">
                    <?php
                    foreach ($receiving_items as $receiving_item) {
                        $img = $receiving_item['item_image'];
                        $title = $receiving_item['item_name'];
                    ?>

                        <div class="str-what-recive-content-inner-am">
                            <div class="str-what-recive-img-am">
                                <img src="<?php echo $img; ?>" alt="Detail quote">

                            </div>
                            <p><?php echo $title; ?></p>
                        </div>
                    <?php
                    } ?>
                </div>
            <?php
            } ?>

        </div>

    </div>


</div>
<!-- review temp section -->
<?php
if (have_rows('home_review')) {
?>
    <div class="review_sections_ar_temp" id="review_section_temp">

        <?php while (have_rows('home_review')) {
            the_row();
            $rating = intval(get_sub_field('review_ratings'));
            $review = get_sub_field('review_text');
        ?>
            <div>
                <div class="review_ar_temp">
                    <div class="review_star_temp">
                        <?php for ($i = 1; $i <= 5; $i++) { ?>
                            <div class="star_temp <?php if ($i <= $rating) { ?>active<?php } ?>">
                                <?php include get_template_directory() . '/assets/img/star.svg' ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="review_temp_para">

                    </div>
                </div>
            </div>
        <?php
        } ?>
    </div>
<?php
}
/**************** review Section **********/




if (have_rows('home_review')) {
?>
    <div class="review_sections_ar" id="review_section">


        <section class="slick-carousel">

            <?php while (have_rows('home_review')) {
                the_row();
                $rating = intval(get_sub_field('review_ratings'));
                $review = get_sub_field('review_text');
            ?>
                <div>
                    <div class="review_ar">
                        <div class="review_star">
                            <?php for ($i = 1; $i <= 5; $i++) { ?>
                                <div class="star <?php if ($i <= $rating) { ?>active<?php } ?>">
                                    <?php include get_template_directory() . '/assets/img/star.svg' ?>

                                </div>
                            <?php } ?>
                            <p>"<?php echo $review; ?>"</p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </section>
    </div>
<?php
}
?>
<!-- /********** pdf section */ -->

<section class="pdf_wrapper_ar" id="pdf_wrapper_ar">

    <div class="pdf_content_ar">

        <div class="pdf_content_inner_ar">

            <div class="pdf_content_inner_img_ar">

                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/pdflogo.svg" alt="pdf">

            </div>

            <div class="pdf_content_inner_para_ar">

                <div class="userinfo_pdf_ar">
                    <h3>Price Quote</h3>
                    <div class="customer_info_ar">
                        <h4>Customer: <span id="customer_name_ar"></span></h4>
                        <h4>Issue Date: <span id="date_name_ar"><?php echo date('d/m/Y'); ?></span></h4>
                    </div>
                    <div class="pdf_cart_ar">
                        <div class="custom-cart-table">
                            <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">&nbsp;</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-quantity">Qty</th>
                                        <th class="product-price">Unit Price</th>
                                        <th class="product-subtotal">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php do_action('woocommerce_before_cart_contents'); ?>

                                    <?php
                                    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                                        $_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                                        $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                                        if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                                            $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                                    ?>
                                            <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">

                                                <td class="product-thumbnail">
                                                    <?php
                                                    $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

                                                    if (! $product_permalink) {
                                                        echo $thumbnail; // PHPCS: XSS ok.
                                                    } else {
                                                        printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
                                                    }
                                                    ?>
                                                </td>

                                                <td class="product-name" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
                                                    <?php
                                                    if (! $product_permalink) {
                                                        echo wp_kses_post($_product->get_name() . '&nbsp;');
                                                    } else {
                                                        echo wp_kses_post(sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()));
                                                    }
                                                    ?>
                                                </td>

                                                <td class="product-quantity" data-title="<?php esc_attr_e('Qty', 'woocommerce'); ?>">
                                                    <?php
                                                    echo apply_filters('woocommerce_cart_item_quantity', $cart_item['quantity'], $cart_item_key, $cart_item); // PHPCS: XSS ok.
                                                    ?>
                                                </td>

                                                <td class="product-price" data-title="<?php esc_attr_e('Unit Price', 'woocommerce'); ?>">
                                                    <?php
                                                    echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                                                    ?>
                                                </td>

                                                <td class="product-subtotal" data-title="<?php esc_attr_e('Total', 'woocommerce'); ?>">
                                                    <?php
                                                    echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                                                    ?>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>

                                    <?php do_action('woocommerce_cart_contents'); ?>
                                </tbody>
                                <tfoot>
                                    <tr class="cart-quote-total">
                                        <td colspan="4" class="text-right"><strong><?php _e('Quote Total:', 'woocommerce'); ?></strong></td>
                                        <td class="total-amount"><?php echo WC()->cart->get_cart_total(); ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="disclaimer_ar">
                        <p>Prices listed are suggested retail prices and may differ at individual dealerships. To place an order, visit your closest dealer. Find their location here or in the email we've sent. This offer is valid for 30 days</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer('straight'); ?>