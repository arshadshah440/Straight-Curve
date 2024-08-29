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

<div class="practreason pad_top_bottom_80_90" id="footer_pricelist_ar">
    <div class="container_ar_mi">
        <h2><?php echo get_field('footer_price_list_section_heading', 'option'); ?></h2>
        <div class="pointer_ar_mi">
            <img src="<?php echo get_template_directory_uri() . '/assets/img/pointers.svg'; ?>" alt="">
        </div>
        <?php
        if (have_rows('inluded_items_in_price_list', 'option')) {
        ?>
            <div class="included_item_price_ar">
                <?php
                while (have_rows('inluded_items_in_price_list', 'option')) {
                    the_row();
                    $heading = get_sub_field('included_item_title');
                ?>
                    <div class="included_item_ar">
                        <div class="included_item_header_img">
                            <img src="<?php echo get_sub_field('inlcuded_item_image'); ?>" alt="">
                        </div>
                        <div class="included_item_card_body_ar">
                            
                        <?php include get_template_directory() . '/assets/img/fi-rr-add.svg' ?>
                            <h3><?php echo $heading; ?></h3>

                        </div>
                    </div>
                <?php
                } ?>
            </div>
        <?php
        } ?>
        <div class="cta_btn_ar">
            <a href="<?php echo get_field('footer_price_list_section_button_link', 'option'); ?>" class="getstartedbtn get_price_list_popup"><?php echo get_field('footer_price_list_section_button_text', 'option'); ?></a>
        </div>
    </div>
</div>