<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Straight_Curve
 */

?>

<?php include get_template_directory() . '/template-parts/footer-parts/FooterGallery.php'; ?>
<?php include get_template_directory() . '/template-parts/footer-parts/FooterPriceList.php'; ?>
<?php include get_template_directory() . '/template-parts/footer-parts/FooterNav.php'; ?>

<footer id="colophon" class="site-footer">
    <div class="d_flex_footer_copy_wraper container_ar_mi">
        <div class="copy_ar">
            <p><?php echo get_field('footer_copyrights_text', 'option'); ?></p>
        </div>
        <div class="terms_links_ar">
            <?php
            if (have_rows('footer_copyrights_section_links', 'option')) {
            ?>
                <div class="footer_copyrights_menu_ar">

                    <?php
                    $count = 0;
                    $total = count(get_field('footer_copyrights_section_links', 'option')); // Get the total number of items

                    while (have_rows('footer_copyrights_section_links', 'option')) {
                        the_row();
                        $link = get_sub_field('copyright_links_link');
                        $menu = get_sub_field('copyright_links_title');
                    ?>
                        <div class="footer_copyrights_item_ar">
                            <a href="<?php echo $link; ?>" target="_blank"><?php echo $menu; ?></a>
                        </div>
                        <?php if (++$count == 1 && $total > 1) { ?>
                            <div class="centered_icon">
                                <i class="fa-solid fa-circle"></i>
                            </div>
                        <?php } ?>
                    <?php
                    }
                    ?>

                </div>
            <?php } ?>
        </div>
    </div>
</footer><!-- #colophon -->

</div><!-- #page -->
<?php include get_template_directory() . '/template-parts/footer-parts/oldFooter.php'; ?>

<!-- popup pricelist form  -->

<?php wp_footer(); ?>

</body>

</html>