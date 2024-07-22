<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package Straight_Curve
 */

$instagram = '<svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
 <path d="M8.28968 6.15062C6.81546 6.15062 5.62694 7.35062 5.62694 8.81348C5.62694 10.2763 6.82689 11.4763 8.28968 11.4763C9.75247 11.4763 10.9524 10.2763 10.9524 8.81348C10.9524 7.35062 9.75247 6.15062 8.28968 6.15062ZM16.2893 8.81348C16.2893 7.70491 16.2893 6.61919 16.2322 5.51062C16.175 4.23062 15.8779 3.08776 14.9408 2.16205C14.0037 1.22491 12.8723 0.927762 11.5924 0.870619C10.4839 0.813477 9.3982 0.813477 8.28968 0.813477C7.18116 0.813477 6.09549 0.813477 4.98697 0.870619C3.70703 0.927762 2.56422 1.22491 1.63855 2.16205C0.701449 3.09919 0.40432 4.23062 0.347179 5.51062C0.290039 6.61919 0.290039 7.70491 0.290039 8.81348C0.290039 9.92205 0.290039 11.0078 0.347179 12.1163C0.40432 13.3963 0.701449 14.5392 1.63855 15.4649C2.57565 16.402 3.70703 16.6992 4.98697 16.7563C6.09549 16.8135 7.18116 16.8135 8.28968 16.8135C9.3982 16.8135 10.4839 16.8135 11.5924 16.7563C12.8723 16.6992 14.0151 16.402 14.9408 15.4649C15.8779 14.5278 16.175 13.3963 16.2322 12.1163C16.3008 11.0192 16.2893 9.92205 16.2893 8.81348ZM8.28968 12.9163C6.0155 12.9163 4.18701 11.0878 4.18701 8.81348C4.18701 6.53919 6.0155 4.71062 8.28968 4.71062C10.5639 4.71062 12.3924 6.53919 12.3924 8.81348C12.3924 11.0878 10.5639 12.9163 8.28968 12.9163ZM12.5638 5.49919C12.0381 5.49919 11.6038 5.07633 11.6038 4.53919C11.6038 4.00205 12.0267 3.57919 12.5638 3.57919C13.1009 3.57919 13.5237 4.00205 13.5237 4.53919C13.5266 4.66438 13.5038 4.78882 13.4566 4.90481C13.4094 5.0208 13.3389 5.12586 13.2495 5.21348C13.1618 5.30293 13.0568 5.37344 12.9408 5.42062C12.8248 5.4678 12.7004 5.49065 12.5752 5.48776L12.5638 5.49919Z" fill="auto"/>
 </svg>
 ';
$socialicons = array('facebook' => '<i class="fa-brands fa-facebook-f"></i>', 'twitter' => '<i class="fa-brands fa-x-twitter"></i>', 'instagram' => $instagram, 'youtube' => '<i class="fa-brands fa-youtube"></i>');
?>
<div class="footer_nav_ar pad_top_bottom_90" id="footer_nav_ar">
    <div class="container_ar_mi">
        <div class="d_flex_auto_ar_mi">
            <div class="footerlogo_wrapper_ar">
                <div class="footer_logo_ar">
                    <img src="<?php echo get_field('footer_logo', 'option'); ?>" alt="">
                </div>
                <?php
                if (have_rows('footer_social_links', 'option')) {
                ?>
                    <div class="social_item_wrapper">

                        <?php
                        while (have_rows('footer_social_links', 'option')) {
                            the_row();
                            $link = get_sub_field('footer_social_platform_url');
                            $icon_name = get_sub_field('footer_social_platform_name');
                            $iconmock = $socialicons[$icon_name];
                        ?>
                            <div class="social_item_ar">
                                <a href="<?php echo $link; ?>" target="_blank"><?php echo $iconmock; ?></a>
                            </div>
                        <?php
                        } ?>

                    </div>
                <?php } ?>
            </div>
            <div class="footer_products_column_wrapper_ar">
                <div class="footerheadings">
                    <h6><?php echo get_field('footer_products_column_heading', 'option'); ?></h6>
                    <div class="icons_footer_ar">
                        <?php include get_template_directory() . '/assets/img/chevronbottom.svg' ?>
                    </div>
                </div>
                <?php
                if (have_rows('footer_products_column_menu', 'option')) {
                ?>
                    <div class="footer_product_menu_ar">

                        <?php
                        while (have_rows('footer_products_column_menu', 'option')) {
                            the_row();
                            $link = get_sub_field('menu_item_link');
                            $menu = get_sub_field('menu_item_title');
                        ?>
                            <div class="footer_product_item_ar">
                                <a href="<?php echo $link; ?>" target="_blank"><?php echo $menu; ?></a>
                                <?php
                                if (have_rows('menu_sub_items', 'option')) {
                                ?>
                                    <div class="footer_product_submenu_ar">
                                        <ul>
                                            <?php
                                            while (have_rows('menu_sub_items', 'option')) {
                                                the_row();
                                                $link = get_sub_field('sub_menu_item_link');
                                                $menu = get_sub_field('sub_menu_item_title');
                                            ?>
                                                <li class="footer_product_subitem_ar">
                                                    <a href="<?php echo $link; ?>" target="_blank"><?php echo $menu; ?></a>
                                                </li>
                                            <?php
                                            } ?>
                                        </ul>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php
                        } ?>

                    </div>
                <?php } ?>
            </div>
            <div class="footer_products_column_wrapper_ar" id="footer_customer_column_wrapper_ar">
                <div class="footerheadings">
                    <h6><?php echo get_field('footer_customers_column_heading', 'option'); ?> </h6>
                    <div class="icons_footer_ar">
                        <?php include get_template_directory() . '/assets/img/chevronbottom.svg' ?>
                    </div>
                </div>
                <?php
                if (have_rows('footer_customers_column_menu', 'option')) {
                ?>
                    <div class="footer_product_menu_ar">

                        <?php
                        while (have_rows('footer_customers_column_menu', 'option')) {
                            the_row();
                            $link = get_sub_field('menu_item_link');
                            $menu = get_sub_field('menu_item_title');
                        ?>
                            <div class="footer_product_item_ar">
                                <a href="<?php echo $link; ?>" target="_blank"><?php echo $menu; ?></a>
                            </div>
                        <?php
                        } ?>

                    </div>
                <?php } ?>
            </div>
            <div class="footer_products_column_wrapper_ar" id="footer_resources_column_wrapper_ar">
                <div class="footerheadings">
                    <h6><?php echo get_field('footer_resources_column_heading', 'option'); ?> </h6>
                    <div class="icons_footer_ar">
                        <?php include get_template_directory() . '/assets/img/chevronbottom.svg' ?>
                    </div>
                </div>
                <?php
                if (have_rows('footer_resources_column_menu', 'option')) {
                ?>
                    <div class="footer_product_menu_ar">

                        <?php
                        while (have_rows('footer_resources_column_menu', 'option')) {
                            the_row();
                            $link = get_sub_field('menu_item_link');
                            $menu = get_sub_field('menu_item_title');
                        ?>
                            <div class="footer_product_item_ar">
                                <a href="<?php echo $link; ?>" target="_blank"><?php echo $menu; ?></a>
                            </div>
                        <?php
                        } ?>

                    </div>
                <?php } ?>
            </div>
            <div class="footer_products_column_wrapper_ar" id="footer_customer_column_wrapper_ar">
                <div class="footerheadings">
                    <h6><?php echo get_field('footer_why_straightcurve_column_heading', 'option'); ?> </h6>
                    <div class="icons_footer_ar">
                        <?php include get_template_directory() . '/assets/img/chevronbottom.svg' ?>
                    </div>
                </div>
                <?php
                if (have_rows('footer_why_straightcurve_column_menu', 'option')) {
                ?>
                    <div class="footer_product_menu_ar">

                        <?php
                        while (have_rows('footer_why_straightcurve_column_menu', 'option')) {
                            the_row();
                            $link = get_sub_field('menu_item_link');
                            $menu = get_sub_field('menu_item_title');
                        ?>
                            <div class="footer_product_item_ar">
                                <a href="<?php echo $link; ?>" target="_blank"><?php echo $menu; ?></a>
                            </div>
                        <?php
                        } ?>

                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>