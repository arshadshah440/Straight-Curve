<?php
/* Template Name: DIY Garden Template
 */
get_header();

/**************** Hero Section ***************/

?>

<!-- DIY Hero Section  -->
<div class="diy_hero_section" id="diy_hero_section">
    <div class="container_ar_mi diy_hero_top">
        <div class="diy_hero_section_inner content_area_hero">
            <h6><?php echo get_field('diy_hero_subheadings'); ?></h6>
            <h1><?php echo get_field('diy_hero_heading'); ?></h1>
            <div class="diy_hero_section_inner_button">
                <a href="<?php echo get_field('diy_hero_button_url'); ?>"><?php echo get_field('diy_hero_button_text'); ?></a>
            </div>
        </div>
        <div class="diy_hero_section_image">
            <div class="diy_hero_section_inner_image">
                <img src="<?php echo get_field('diy_hero_featured_image'); ?>" alt="DIY Garden Hero Section Image">
            </div>
            <div class="watchvideo_wrap">
                <a href="<?php echo get_field('diy_watch_video_url'); ?>">
                    <div class="watch_icon">
                        <?php include get_template_directory() . '/assets/img/PlayCircle.svg'; ?>
                        <?php echo get_field('diy_watch_video_button_text'); ?>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- DIY Find Your Edging Section  -->



<!-- Why Choose Our DIY Section -->
<div class="diy_why_choose_section pad_top_bottom_80 diy_main_wraaper_ar" id="diy_why_choose_section">
    <div class="container_ar_mi">
        <div class="diy_why_choose_section_flex">
            <div class="diy_why_choose_section_left">
                <div class="diy_why_choose_section_left_heading">
                    <h2 class="text-color-white max_width_75_ar"><?php echo get_field('why_choose_diy_garden_heading'); ?></h2>
                </div>
                <div class="diy_why_choose_section_left_subheading">
                    <h5 class="text-color-white"><?php echo get_field('why_choose_diy_garden_subheading_'); ?></h5>
                </div>
                <div class="diy_why_choose_section_left_description sect_desc_ar_mi_diy text-color-white">
                    <p><?php echo get_field('why_choose_diy_garden_description'); ?></p>
                </div>
                <div class="diy_why_choose_section_left_button">
                    <a class="btn_secondary_on_white_314 width_fit_to_content" href="<?php echo get_field('get_price_list_button_url'); ?>"><?php echo get_field('get_price_list_button_text'); ?></a>
                </div>
            </div>
            <div class="diy_why_choose_section_right">
                <div class="diy_why_choose_section_right_heading">
                    <h4><?php echo get_field('off_the_shelf_heading'); ?></h4>
                </div>
                <?php
                if (have_rows('off_the_shelf_products_bullets')) {
                ?>
                    <div class="diy_trythempoints_ar">
                        <?php
                        while (have_rows('off_the_shelf_products_bullets')) {
                            the_row();
                            $heading = get_sub_field('products_bullets_text');
                        ?>
                            <div class="diy_trythempoints">
                                <?php include get_template_directory() . '/assets/img/fi-rr-add.svg' ?>
                                <p><?php echo $heading; ?></p>
                            </div>

                        <?php
                        } ?>
                    </div>
                <?php
                } ?>
            </div>

        </div>

    </div>

</div>


<!-- DIY weathering steel finish section  -->
<div class="diy_weathering_steel_section pad_top_bottom_90 diy_main_wraaper_ar" id="diy_weathering_steel_section">
    <div class="container_ar_mi">
        <div class="diy_weathering_steel_section_inner">
            <div class="diy_weathering_steel_section_inner_heading mb_15_ar">
                <h2 class="text-color-black text_align_center_ar"><?php echo get_field('weathering_steel_finish_heading'); ?></h2>
            </div>
            <div class="diy_weathering_steel_section_inner_subheading sect_desc_ar_mi_diy max_width_514_ar">
                <p class="text-color-black text_align_center_ar"><?php echo get_field('weathering_steel_finish_subheading'); ?></p>
            </div>
            <div class="diy_weathering_steel_section_flex ">
                <div class="diy_weathering_steel_section_flex_left dir_rtl_ar diy_weathering_steel_wrapper_sides ">
                    <div class="diy_weathering_steel_section_flex_left_cirlce_icon circle_wraper_ar darslatey_icons">
                        <i class="fa-solid fa-circle"></i>
                    </div>
                    <div class="diy_weathering_steel_section_flex_left_heading">
                        <h4><?php echo get_field('how_it_comes_heading'); ?></h4>
                    </div>
                    <div class="diy_weathering_steel_section_flex_left_description">
                        <p><?php echo get_field('how_it_comes_description'); ?></p>
                    </div>
                </div>
                <div class="diy_weathering_steel_section_flex_middle max_width_428_ar">
                    <div class="diy_weathering_steel_section_flex_middle_image">
                        <img src="<?php echo get_field('weathering_steel_finish_image'); ?>" alt="Weathering Steel Finish Section Image">
                    </div>
                    <div class="diy_weathering_steel_section_flex_middle_button mt_35_ar">
                        <a class="btn_secondary_on_white_314 width_100_ar " href="<?php echo get_field('get_price_list_button_url'); ?>"><?php echo get_field('get_price_list_button_text'); ?></a>

                    </div>
                </div>
                <div class="diy_weathering_steel_section_flex_right diy_weathering_steel_wrapper_sides ">
                    <div class="diy_weathering_steel_section_flex_left_cirlce_icon circle_wraper_ar secondarcolor_icons">
                        <i class="fa-solid fa-circle"></i>
                    </div>
                    <div class="diy_weathering_steel_section_flex_right_heading">
                        <h4><?php echo get_field('what_it_turns_heading'); ?></h4>
                    </div>
                    <div class="diy_weathering_steel_section_flex_right_description">
                        <p><?php echo get_field('what_it_turns_description'); ?></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- DIY Feature Comparison Section -->
<div class="diy_feature_comparison_section diy_main_wraaper_ar" id="diy_feature_comparison_section">
    <div class="container_ar_mi">
        <div class="diy_feature_comparison_section_inner">
            <div class="diy_feature_comparison_section_inner_heading mb_15_ar">
                <h2 class="text-color-black text_align_center_ar"><?php echo get_field('feature_comparison_heading'); ?></h2>
            </div>
            <div class="diy_feature_comparison_section_inner_subheading sect_desc_ar_mi_diy max_width_514_ar">
                <p class="text-color-black text_align_center_ar"><?php echo get_field('feature_comparison_subheading'); ?></p>
            </div>
            <div class="diy_feature_comparison_section_inner_table">
                <?php
                if (have_rows('table_rows_content') && have_rows('table_column_heading')) {
                ?>
                    <div class="compare_table_ar">
                        <div class="compoare_table_header_ar comparetable_row_ar">

                            <div class="compare_left_title_ar">

                            </div>
                            <div class="features_title_headr_ar">


                                <?php while (have_rows('table_column_heading')) {
                                    the_row();
                                ?>
                                    <div class="compare_options_ar"><?php the_sub_field('heading_text'); ?></div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="compare_table_body">
                            <?php
                            while (have_rows('table_rows_content')) {
                                the_row();
                                $heading = get_sub_field('table_row_heading');
                            ?>
                                <div class="comparetale_row_body_ar comparetable_row_ar">

                                    <div class="compare_left_title_ar">
                                        <h5><?php echo $heading; ?></h5>

                                    </div>
                                    <?php
                                    // List of the true/false fields
                                    $fields = [
                                        'straightcurve_weathering_steel',
                                        'mild_steel',
                                        'aluminium',
                                        'plastic',
                                        'timber'
                                    ];

                                    // Iterate over each true/false field
                                    foreach ($fields as $field) {
                                        $value = get_sub_field($field);
                                    ?>

                                        <?php if ($value) : ?>
                                            <div class="compare_options_ar">
                                                <span class="icon-tick"><?php include get_template_directory() . '/assets/img/mdi_tick.svg' ?></span>
                                            </div>
                                        <?php else : ?>
                                            <div class="compare_options_ar border_bottom_ar_1">
                                                <span class="icon-cross"><?php include get_template_directory() . '/assets/img/gridicons_cross.svg' ?></span>
                                            </div>
                                        <?php endif; ?>

                                    <?php
                                    }
                                    ?>

                                </div>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>

<!-- DIY Garden Edging Wild -->
<div class="diy_garden_edging_wild_section diy_main_wraaper_ar pad_top_bottom_80" id="diy_garden_edging_wild_section">
    <div class="container_ar_mi">
        <div class="diy_garden_edging_wild_section_inner">
            <div class="diy_garden_edging_wild_section_inner_heading mb_15_ar">
                <h2 class="text-color-black text_align_center_ar"><?php echo get_field('garden_edging_wild_heading'); ?></h2>
            </div>
            <div class="diy_garden_edging_wild_section_inner_subheading sect_desc_ar_mi_diy max_width_514_ar">
                <p class="text-color-black text_align_center_ar"><?php echo get_field('garden_edging_wild_subheading'); ?></p>
            </div>
            <div class="diy_garden_edging_wild_section_slider">
                <?php
                if (have_rows('garden_edging_wild_slider_container_box')) {
                ?>
                    <div class="owl-carousel" id="wildedgingslider">


                        <?php
                        while (have_rows('garden_edging_wild_slider_container_box')) {
                            the_row();
                        ?>
                            <div class="diy_garden_edging_wild_section_flex">
                                <div class="diy_garden_edging_wild_section_flex_left">
                                    <div class="diy_garden_edging_wild_section_flex_left_heading">
                                        <h4><?php echo get_sub_field('container_heading'); ?></h4>
                                        <div class="diy_garden_edging_wild_section_flex_left_description">
                                            <p><?php echo get_sub_field('container_heading'); ?></p>
                                        </div>
                                    </div>
                                    <div class="diy_garden_edging_wild_section_flex_left_button">
                                        <a class="btn_secondary_on_white_314 width_fit_to_content" href="<?php echo get_sub_field('container_button_url'); ?>"><?php echo get_sub_field('container_button_text'); ?></a>
                                    </div>
                                </div>
                                <div class="diy_garden_edging_wild_section_flex_right">
                                    <div class="diy_garden_edging_wild_section_flex_right_image">
                                        <img src="<?php echo get_sub_field('container_image'); ?>" alt="Garden Edging Wild Section Image">
                                    </div>
                                </div>
                            </div>
                        <?php }
                        ?>
                    </div>
                    <div class="slider_controls belowhero_slider_controls_ar">
                        <div class="prevbtn hideme_ar">
                            <i class="fa-solid fa-chevron-left"></i>
                        </div>
                        <div class="nextbtn">
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                    </div>

                    <div class="tabs_controls_ar">
                        <div class="filled_tabs_ar"></div>
                    </div>
                <?php
                } ?>
            </div>
        </div>
    </div>
</div>

<!-- DIY Find Your Local Stokists -->

<div class="landscape_hero_section" id="exclusive_perk_home_ar">
    <div class="container_fluid_ar_mi">
        <div class="mid-flex-center">
            <div class="content_area_landscape_hero">
                <h2><?php echo get_field('find_your_local_stockists_heading'); ?></h2>
                <h5><?php echo get_field('find_your_local_stockists_subheading'); ?></h5>
                <div class="diy_find_your_local_stokists_section_flex_left_description">
                    <p><?php echo get_field('find_your_local_stockists_description'); ?></p>
                </div>
                <?php
                $reheading = get_field('find_your_local_stockists_button_text');
                $reurl = get_field('find_your_local_stockists_button_url');
                ?>
                <a href="<?php echo $reurl; ?>" class="redirect_btn">
                    <?php echo $reheading; ?>
                </a>

            </div>
            <div class="heroimage_buttons">
                <div class="image_area_hero">
                    <img src="<?php echo get_field('find_your_local_stockists_image'); ?>" alt="Featured Image">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DIY Straightcurve Promises  -->
<div class="diy_straightcurve_promises_section diy_main_wraaper_ar pad_top_bottom_80" id="diy_straightcurve_promises_section">
    <div class="container_ar_mi">
        <div class="diy_straightcurve_promises_section_inner">
            <div class="diy_straightcurve_promises_section_inner_heading">
                <h2 class="text_align_center_ar"><?php echo get_field('straightcurve_promises_heading'); ?></h2>
            </div>
            <div class="diy_straightcurve_promises_section_inner_subheading max_width_514_ar">
                <p class="text-color-black text_align_center_ar"><?php echo get_field('straightcurve_promises_subheading'); ?></p>
            </div>
            <div class="diy_straightcurve_promises_section_flex">
                <?php
                if (have_rows('straightcurve_promises_box')) {
                    while (have_rows('straightcurve_promises_box')) {
                        the_row();
                ?>
                        <div class="diy_straightcurve_promises_section_flex_card">
                            <div class="diy_straightcurve_promises_section_flex_card_image">
                                <img src="<?php echo get_sub_field('box_image'); ?>" alt="Straightcurve Promises Section Image">
                            </div>
                            <div class="diy_straightcurve_promises_section_flex_card_heading">
                                <h3><?php echo get_sub_field('box_heading'); ?></h3>
                            </div>
                            <div class="diy_straightcurve_promises_section_flex_card_description">
                                <p><?php echo get_sub_field('box_description'); ?></p>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>

        </div>
    </div>
</div>

<?php
/***********  Home Accoridan Section **********/
?>
<div class="practreason pad_top_bottom_90" id="homeaccordiana_ar">
    <div class="container_ar_mi">
        <h2><?php echo get_field('homepage_accordian_section_title'); ?></h2>
        <div class="subheading">
            <p><?php echo get_field('homepage_accordian_section_description'); ?></p>
        </div>
        <?php
        if (have_rows('homepage_accordian')) {
        ?>
            <div class="accordian_wrapper_ar">

                <?php
                while (have_rows('homepage_accordian')) {
                    the_row();
                    $question = get_sub_field('homepage_accordian_heading');
                    $answer = get_sub_field('homepage_accordian_description');
                ?>
                    <div class="accordian_ar_mi">
                        <div class="accordian_ar_mi_head">
                            <h5><?php echo $question; ?></h5>
                            <div class="accord_icons_ar">
                                <img src="<?php echo get_template_directory_uri() . '/assets/img/MinusCircle.svg' ?>" alt="" id="minus_ar" class="hide_ar_accord">
                                <img src="<?php echo  get_template_directory_uri() . '/assets/img/PlusCircle.svg' ?>" alt="" id="plus_ar">
                            </div>
                        </div>
                        <div class="accordian_ar_mi_desc hide_ar_accord">
                            <?php echo $answer; ?>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        <?php
        }

        ?>
    </div>
</div>








<!-- get footer -->
<?php get_footer('straight'); ?>