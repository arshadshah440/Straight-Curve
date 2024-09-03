<?php

/** Template Name: Thank You Template
 * @package WordPress
 * @subpackage Theme_Name
 * @since Theme_Version
 */

get_header('quote');
?>
<div class="page_wrapper_ar">


    <section class="thankyousection_ar" id="thankyousection_ar">
        <div class="container_mi_ar">
            <div class="thankyoupage_content_ar">
                <div class="thumb_art_ar max_width_ar_465">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/Vector (34).svg" alt="">
                </div>
                <div class="page_title_desc max_width_ar_465">
                    <h2><?php echo get_field('thank_you_page_title'); ?></h2>
                    <p><?php echo get_field('thank_you_page_descriptiopn'); ?></p>
                </div>
                <div class="page_form_ar">
                    <h6>In the meantime, could you let us know how your experience was this far?</h6>
                    <?php echo do_shortcode(get_field('thank_you_page_form_shortcode')); ?>
                </div>
            </div>
        </div>
    </section>
</div>
<?php get_footer('straight'); ?>