<?php 

/**
 * file for accessories Loop
 * 
 * @package Straight-Curve
 */
$image=get_the_post_thumbnail_url($productid);
$title=get_the_title($productid);
$smaldesc=get_field('product_small_description', $productid);
$productinfo = get_field("product_info", $productid);
$finishing = $productinfo['finish'];
?>
 <div class="acc_loop_wrapper_ar">
    <div class="thumbnail_wrapper_ar">
        <div class="thumb_ar_loop">
            <img src="<?php echo $image; ?>" alt="Image">
        </div>
        <button><?php echo $finishing;?></button>
    </div>
    <div class="acc_loop_content">
       <a href="<?php echo get_the_permalink($productid); ?>"> <h5><?php echo $title; ?></h5></a>
         <p><?php echo $smaldesc; ?></p>
    </div>
 </div>