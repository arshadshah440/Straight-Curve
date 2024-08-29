<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 *
 * @package Straight_Curve
 */

?>
<div class="practreason pad_top_bottom_60" id="footer_gallery_ar">
    <div class="container_fluid_mi_ar">
        <h2><?php echo get_field('footer_gallery_section_heading', 'option'); ?></h2>
        <div class="subheading">
            <p><?php echo get_field('footer_gallery_section_subheading', 'option'); ?></p>
        </div>
        <?php
        $gallery = get_field('footer_gallery', 'option');
        if (!empty($gallery)) {
        ?>
            <div id="footer_gallery_wrapper_ar">
                <div class="owl-carousel" id="footer_gallery_ar_mi">
                    <?php
                    foreach ($gallery as $img) { ?>
                        <div class="footer_gallery_img_ar">
                            <img src="<?php echo $img; ?>" alt="Footer">
                        </div>
                    <?php }
                    ?>
                </div>
                <div class="slider_controls belowhero_slider_controls_ar">
                    <div class="prevbtn">
                        <i class="fa-solid fa-chevron-left"></i>
                    </div>
                    <div class="nextbtn">
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                </div>
            </div>
        <?php }
        ?>
    </div>
</div>