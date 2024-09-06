<?php

/**
 * File for accessories Loop
 * 
 * @package Straight-Curve
 */
$image = get_the_post_thumbnail_url($productid);
$title = get_the_title($productid);
$smaldesc = get_field('product_small_description', $productid);
$productinfo = get_field("product_info", $productid);
$finishing = $productinfo['finish'];
$product_permalink = get_the_permalink($productid);
$product = wc_get_product($productid);
?>

<div class="acc_loop_wrapper_ar">
    <div class="thumbnail_wrapper_ar">
        <div class="thumb_ar_loop">
            <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>">
        </div>
        <button><?php echo esc_html($finishing); ?></button>
    </div>
    <div class="acc_loop_content">
        <div class="corneracc_ar">
            <p>Corner Accessory</p>
        </div>
        <a href="<?php echo esc_url($product_permalink); ?>">
            <h5><?php echo esc_html($title); ?></h5>
        </a>
        <p><?php echo esc_html($smaldesc); ?></p>
        <div class="addtocart_loop_ar">
            <div class="stock_error_ar" bis_skin_checked="1" >
                <p id="error_ar"><img src="<?php echo get_template_directory_uri();?>/assets/img/Info.svg" alt=""><span id="stock_erro_ar">Only 182 sets are available.

</span></p>
            </div>
            <?php if ($product && $product->is_purchasable() && $product->is_in_stock()) : ?>
                <form class="cart" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post" enctype='multipart/form-data' data-redirect="false">
                    <?php woocommerce_quantity_input(); ?>
                    <!-- Custom Add to Cart Button Text -->
                    <button type="submit" name="add-to-cart" value="<?php echo esc_attr($productid); ?>" class="button alt">
                        <?php echo esc_html('Add to Quote'); // Custom button text 
                        ?>
                    </button>
                    <!-- Disable Redirection -->
                    <input type="hidden" name="add-to-cart-redirect" value="false">
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>