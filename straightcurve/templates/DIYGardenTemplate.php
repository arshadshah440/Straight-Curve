<?php
/* Template Name: DIY Garden Template
 */
get_header('new');

/**************** Hero Section ***************/
$currentpage = get_the_ID();

?>

<!-- DIY Hero Section  -->
<div class="diy_hero_section" id="diy_hero_section">
    <div class="container_ar_mi diy_hero_top">
        <div class="diy_hero_section_inner content_area_hero">
            <h6><?php echo get_field('diy_hero_subheadings'); ?></h6>
            <h1><?php echo get_field('diy_hero_heading'); ?></h1>
            <div class="diy_hero_section_inner_button get_price_list_popup">
                <a
                    href="<?php echo get_field('diy_hero_button_url'); ?>"><?php echo get_field('diy_hero_button_text'); ?></a>
            </div>
        </div>
        <div class="diy_hero_section_image">
            <div class="diy_hero_section_inner_image">
                <img src="<?php echo get_field('diy_hero_featured_image'); ?>" alt="DIY Garden Hero Section Image">
            </div>
            <div class="watchvideo_wrap">
                <a href="#" id="openPopupLink">
                    <div class="watch_icon">
                        <?php include get_template_directory() . '/assets/img/PlayCircle.svg'; ?>
                        <?php echo get_field('diy_watch_video_button_text'); ?>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="notification_ar" id="notification_ar">
    <div class="notification_ar_inner">
        <div class="d_flex_icon_message_ar">
            <div class="icons_ar_mi">
                <i class="fa-solid fa-circle-check" id="check_icon_ar"></i>
                <i class="fa-solid fa-circle-xmark" id="cross_icon_ar"></i>
            </div>
            <div class="message_ar_mi">
                <p>Product added to quote!!!</p>
            </div>
            <div class="close_icon_ar">
                <i class="fa-solid fa-xmark" id="close_icon_ar"></i>
            </div>
        </div>
    </div>
</div>
<div id="videoPopup" class="home_hero_video_popup">
    <div class="popup-content">
        <div class="popup-content-inner">
            <div class="videowraper_ar">
                <span class="close">&times;</span>

                <iframe id="popupVideo" src="<?php echo get_field('diy_watch_video_url'); ?>"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

            </div>
        </div>
    </div>
</div>
<!-- DIY Find Your Edging Section  -->

<div class="pad_top_bottom_80 diy_main_wraaper_ar" id="findyouredging_ar">
    <div class="container_ar_mi">
        <div class="findedging_ar">
            <h2 class="text_align_center_ar"><?php echo get_field('find_your_edging_heading'); ?></h2>
            <div class="edgedesc sect_desc_ar_mi_diy max_width_455_ar">
                <p class="text_align_center_ar"><?php echo get_field('find_your_edging_subheading'); ?></p>
            </div>
        </div>
        <?php
        $current_blog_id = get_current_blog_id();
        $tabsContent = array();
        $textbelowinput = array();

        $counter = 0;
        $tabheading = get_field('tab_heading');
        $tab_products = get_field('first_product_to_show');
        $text_below = get_field('text_in_the_below_the_category_input');
        $tabskey = str_replace(" ", "", $tabheading);
        $tabskey = strtolower($tabskey);
        $textbelowinput[$tabskey] = $text_below;
        $tabsContent[$tabskey] = $tab_products[0];

        $counter++;
        ?>
        <div class="tabs_find_edege_ar" id="tabs_find_edege_ar" curr="<?php echo $current_blog_id; ?>">

            <?php
            function render_video_section($productvideo, $currentid)
            {
                if (!empty($productvideo)) { ?>
                    <div class="videowrapper">
                        <video src="<?php echo $productvideo; ?>"></video>
                        <div class="playbutton_ar_mi">
                            <?php include get_template_directory() . '/assets/img/PlayCircle.svg'; ?>
                        </div>
                    </div>
                    <div class="divider">
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/divider.svg'; ?>" alt=""
                            class="desk_divider">
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/dividermob.svg'; ?>" alt=""
                            class="mob_divider">
                    </div>
                    <div class="donwload_wrapper">
                        <h6>Download:</h6>
                        <a href="<?php echo get_field("product_catalogue_file", $currentid); ?>"
                            download><?php echo get_field("product_catalogue_download_button_text", $currentid); ?></a>
                    </div>
                <?php }
            }

            function render_accordion_section($currentpage, $key)
            {
                $shortdesc = get_field('tab_description');
                $productvideo = get_field('product_video', $currentpage);
                $currentid = get_the_ID();
                $tabheading = get_field('tab_heading');
                $tabskey = str_replace(" ", "", $tabheading);
                $tabskey = strtolower($tabskey);
                if ($tabskey == $key) {
                ?>
                    <div class="pr_small_desc_ar">
                        <p><?php echo $shortdesc; ?></p>
                    </div>
                    <div class="video_file_ar"><?php render_video_section($productvideo, $currentpage); ?></div>
                    <?php
                    if (have_rows("product_accordian", $currentpage)) { ?>
                        <div class="accordian_wrapper_ar" id="<?php echo $currentpage; ?>">
                            <?php while (have_rows("product_accordian", $currentpage)) {
                                the_row();
                                $question = get_sub_field("accordian_heading", $currentpage);
                                $answer = get_sub_field("accordian_description", $currentpage); ?>
                                <div class="accordian_ar_mi">
                                    <div class="accordian_ar_mi_head">
                                        <h6><?php echo $question; ?></h6>
                                        <div class="accord_icons_ar">
                                            <img src="<?php echo get_template_directory_uri() . '/assets/img/GMinusCircle.svg' ?>"
                                                alt="" id="minus_ar" class="hide_ar_accord">
                                            <img src="<?php echo get_template_directory_uri() . '/assets/img/GPlusCircle.svg' ?>" alt=""
                                                id="plus_ar">
                                        </div>
                                    </div>
                                    <div class="accordian_ar_mi_desc hide_ar_accord">
                                        <?php echo $answer; ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                <?php }
                }
            }

            function render_radio_buttons($arr, $name, $key, $current_value, $currentpage, $type, $inputclass)
            {
                foreach ($arr as $keys => $value) {
                    $checked = ($value == $current_value) ? 'checked' : '';
                    echo '<input type="radio" current-page="' . $currentpage . '" current-type="' . $type . '" class="' . $inputclass . '" id="' . $key . '_' . $value . '" name="' . $name . '" value="' . $value . '" ' . $checked . '>';
                    echo '<label for="' . $key . '_' . $value . '">' . $keys . '</label>';
                }
            }

            function render_product($key, $product, $stylearr, $sizearr, $categoryarr, $counters, $currentpage)
            {
                $currentid = $product;
                $tabheading = get_field('tab_heading');
                $title = get_the_title($currentid);
                $featuredimage = get_the_post_thumbnail_url($currentid);
                $shortdesc = get_field('product_small_description', $currentid);
                $product_type = wp_get_post_terms($currentid, 'ra_product_type');
                $product_type = !empty($product_type) && !is_wp_error($product_type) ? $product_type[0]->slug : '';
                $product_height = wp_get_post_terms($currentid, 'ra_product_height');
                $product_height = !empty($product_height) && !is_wp_error($product_height) ? $product_height[0]->slug : '';
                $productvideo = get_field("product_video", $currentid);
                $productinfo = get_field("product_info", $currentid);
                $finishing = $productinfo['finish'];
                $size = $productinfo['details'];
                $addons = get_field('add-ons', $currentid);
                ?>
                <div class="tabs_content_wrapper <?php echo $counters == 0 ? 'active_tab_content' : ''; ?>"
                    id="<?php echo $key; ?>">
                    <div class="d_flex_gap_24">
                        <div class="product_content_ar">
                            <h3><?php echo $tabheading; ?></h3>

                            <?php render_accordion_section($currentid, $key); ?>
                        </div>
                        <div class="form_side_ar_mi">
                            <div class="form_diy_wrapper">
                                <div class="p_image_wrapper"><img src="<?php echo $featuredimage; ?>" alt=""></div>
                                <div class="inner_wrapper_ar">
                                    <div class="pdesc_ar_wrapper">
                                        <h3 class="p_title_ar"><?php echo $title; ?></h3>
                                        <p class="edge_size_ar">Edge size : <?php echo $size; ?></p>
                                        <form action="">
                                            <div class="size_inputwraper_ar">
                                                <h6>Style</h6>
                                                <div class="input_wrapper_ar_mi">
                                                    <?php render_radio_buttons($stylearr, $key . '_edge_style', $key, $product_type, $currentpage, $product_type, 'style_input_ar'); ?>
                                                </div>
                                            </div>
                                            <div class="size_inputwraper_ar">
                                                <h6>Height</h6>
                                                <div class="input_wrapper_ar_mi">
                                                    <?php render_radio_buttons($sizearr, $key . '_edge_size', $key, $product_height, $currentpage, $product_type, 'size_input_ar'); ?>
                                                </div>
                                            </div>
                                            <div class="size_inputwraper_ar category_pr_ar">
                                                <h6>Finish</h6>
                                                <div class="input_wrapper_ar_mi">
                                                    <?php render_radio_buttons($categoryarr, $key . '_edge_category', $key, strtolower($finishing), $currentpage, $product_type, 'category_input_ar'); ?>
                                                </div>
                                            </div>
                                            <div class="size_inputwraper_ar setcalculator_ar">
                                                <h6>Meters</h6>
                                                <div class="input_wrapper_ar_mi">
                                                    <div class="inputcalc_ar">
                                                        <input type="number" step="any" name="setcalc_input_ar" id="setcalc_input_ar" class="setcalc_input_ar" placeholder="Enter meters required">
                                                    </div>
                                                    <div class="numberof_sets_ar">
                                                        <h6><span id="numberofsets_ar">0</span> Sets</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text_inform_ar">
                                                <p id="text_inform_ar"><?php echo get_field('product_small_description', $currentid); ?>
                                                </p>
                                            </div>
                                            <div class="form_button_ar">
                                                <a class="btn_secondary_on_white_314" id="setcalc_button_ar"
                                                    href="<?php echo get_field("diy-find_your_edging_button_link"); ?>" prod_id="<?php echo $currentid; ?>"><?php echo get_field("diy-find_your_edging_button_text"); ?></a>
                                            </div>
                                            <div class="moreaccesspries" id="moreaccesspries_ar">
                                                <p><a href="#accessroies_tabs_wrapper">See more optional</a> accessories below</p>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php if (isset($addons['accessories']) && is_array($addons['accessories'])) { ?>
                            <div class="accessroies_tabs_wrapper" id="accessroies_tabs_wrapper">
                                <h3><?php echo get_field("accessories_section_heading"); ?></h3>
                                <div class="product_acc_in_wrapper_ar">
                                    <?php foreach ($addons['accessories'] as $addon) {
                                        if (isset($addon['product']) && is_array($addon['product'])) {
                                            pr_accessories($addon['product']);
                                        }
                                    } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                </div>
            <?php
            }

            $counters = 0;
            $stylearr = ['Flex' => 'flex', 'Rigid' => 'rigid', 'Zero Flex' => 'zero-flex'];
            $sizearr = ['75mm' => '75mm-high', '100mm' => '100mm-high', '150mm' => '150mm-high'];
            $categoryarr = ['weathering' => 'weathering', 'galvanised' => 'galvanised'];
            $counters = 0;
            foreach ($tabsContent as $key => $products) {
                render_product($key, $products, $stylearr, $sizearr, $categoryarr, $counters, $currentpage);
                $counters++;
                break;
            }
            ?>

        </div>
        <?php

        ?>
    </div>
</div>

<!-- Why Choose Our DIY Section -->
<div class="diy_why_choose_section pad_top_bottom_80 diy_main_wraaper_ar" id="diy_why_choose_section">
    <div class="container_ar_mi">
        <div class="diy_why_choose_section_flex">
            <div class="diy_why_choose_section_left">
                <div class="diy_why_choose_section_left_heading">
                    <h2 class="text-color-white max_width_75_ar">
                        <?php echo get_field('why_choose_diy_garden_heading'); ?>
                    </h2>
                </div>
                <div class="diy_why_choose_section_left_subheading">
                    <h5 class="text-color-white"><?php echo get_field('why_choose_diy_garden_subheading_'); ?></h5>
                </div>
                <div class="diy_why_choose_section_left_description sect_desc_ar_mi_diy text-color-white">
                    <p><?php echo get_field('why_choose_diy_garden_description'); ?></p>
                </div>
                <div class="diy_why_choose_section_left_button show_desktop_ar">
                    <a class="btn_secondary_on_white_314 width_fit_to_content get_price_list_popup"
                        href="<?php echo get_field('get_price_list_button_url'); ?>"><?php echo get_field('get_price_list_button_text'); ?></a>
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
            <div class="diy_why_choose_section_left_button showon_mobile_ar">
                <a class="btn_secondary_on_white_314 width_fit_to_content"
                    href="<?php echo get_field('get_price_list_button_url'); ?>"><?php echo get_field('get_price_list_button_text'); ?></a>
            </div>
        </div>

    </div>

</div>


<!-- DIY weathering steel finish section  -->
<div class="diy_weathering_steel_section pad_top_bottom_90 diy_main_wraaper_ar" id="diy_weathering_steel_section">
    <div class="container_ar_mi">
        <div class="diy_weathering_steel_section_inner">
            <div class="diy_weathering_steel_section_inner_heading mb_15_ar">
                <h2 class="text-color-black text_align_center_ar">
                    <?php echo get_field('weathering_steel_finish_heading'); ?>
                </h2>
            </div>
            <div class="diy_weathering_steel_section_inner_subheading sect_desc_ar_mi_diy max_width_514_ar">
                <p class="text-color-black text_align_center_ar">
                    <?php echo get_field('weathering_steel_finish_subheading'); ?>
                </p>
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
                        <img src="<?php echo get_field('weathering_steel_finish_image'); ?>"
                            alt="Weathering Steel Finish Section Image">
                    </div>
                    <div class="diy_weathering_steel_section_flex_middle_button mt_35_ar show_desktop_ar">
                        <a class="btn_secondary_on_white_314 width_100_ar get_price_list_popup"
                            href="<?php echo get_field('get_price_list_button_url'); ?>"><?php echo get_field('get_price_list_button_text'); ?></a>
                    </div>
                </div>
                <div class="diy_weathering_steel_section_flex_right diy_weathering_steel_wrapper_sides ">
                    <div
                        class="diy_weathering_steel_section_flex_left_cirlce_icon circle_wraper_ar secondarcolor_icons">
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
            <div class="diy_weathering_steel_section_flex_middle_button mt_35_ar showon_mobile_ar">
                <a class="btn_secondary_on_white_314 width_100_ar "
                    href="<?php echo get_field('get_price_list_button_url'); ?>"><?php echo get_field('get_price_list_button_text'); ?></a>
            </div>

        </div>
    </div>
</div>

<!-- DIY Feature Comparison Section -->
<div class="diy_feature_comparison_section diy_main_wraaper_ar" id="diy_feature_comparison_section">
    <div class="container_ar_mi">
        <div class="diy_feature_comparison_section_inner">
            <div class="diy_feature_comparison_section_inner_heading mb_15_ar">
                <h2 class="text-color-black text_align_center_ar"><?php echo get_field('feature_comparison_heading'); ?>
                </h2>
            </div>
            <div class="diy_feature_comparison_section_inner_subheading sect_desc_ar_mi_diy max_width_514_ar">
                <p class="text-color-black text_align_center_ar">
                    <?php echo get_field('feature_comparison_subheading'); ?>
                </p>
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
                            $tablerowheadings = array();

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
                                    $arrayinf = [];
                                    foreach ($fields as $field) {
                                        $value = get_sub_field($field);
                                        $arrayin = [$field => $value,];
                                        array_push($arrayinf, $arrayin);
                                    ?>

                                        <?php if ($value): ?>
                                            <div class="compare_options_ar">
                                                <span
                                                    class="icon-tick"><?php include get_template_directory() . '/assets/img/mdi_tick.svg' ?></span>
                                            </div>
                                        <?php else: ?>
                                            <div class="compare_options_ar border_bottom_ar_1">
                                                <span
                                                    class="icon-cross"><?php include get_template_directory() . '/assets/img/gridicons_cross.svg' ?></span>
                                            </div>
                                        <?php endif; ?>

                                    <?php
                                    }
                                    $mainrow = ['rowtitle' => $heading, 'rowdata' => $arrayinf];
                                    array_push($tablerowheadings, $mainrow);
                                    ?>

                                </div>
                            <?php
                            }
                            ?>

                        </div>
                    </div>

                <?php
                } ?>

            </div>
            <div class="data_wrapper_tabe_mob">
                <?php

                $size = count($tablerowheadings[0]['rowdata']);
                for ($i = 0; $i < $size; $i++) {
                    $firstRowdata = $tablerowheadings[$i]['rowdata'][$i]; // Gets the first element of 'rowdata'
                    $firstKey = array_key_first($firstRowdata);
                ?>
                    <div class="rows_table_mobile">
                        <div class="row_head_mobile">
                            <h6><?php echo str_replace('_', ' ', $firstKey); ?></h6>
                        </div>
                        <div class="row_body_mobile">


                            <?php
                            foreach ($tablerowheadings as $headingsa) {
                            ?>
                                <div class="eachdata">
                                    <div class="rowtitle"><?php echo $headingsa['rowtitle']; ?></div>
                                    <div class="rowdata"><?php if ($headingsa['rowdata'][$i][$firstKey]) {
                                                            ?>
                                            <span
                                                class="icon-tick"><?php include get_template_directory() . '/assets/img/mdi_tick.svg' ?></span>
                                        <?php } else {
                                        ?>
                                            <span
                                                class="icon-cross"><?php include get_template_directory() . '/assets/img/gridicons_cross.svg' ?></span>

                                        <?php
                                                            }
                                        ?>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>
        </div>
    </div>
</div>
</div>

<!-- DIY Garden Edging Wild -->
<div class="diy_garden_edging_wild_section diy_main_wraaper_ar pad_top_bottom_80" id="diy_garden_edging_wild_section">
    <div class="container_ar_mi">
        <div class="diy_garden_edging_wild_section_inner">
            <div class="diy_garden_edging_wild_section_inner_heading mb_15_ar">
                <h2 class="text-color-black text_align_center_ar"><?php echo get_field('garden_edging_wild_heading'); ?>
                </h2>
            </div>
            <div class="diy_garden_edging_wild_section_inner_subheading sect_desc_ar_mi_diy max_width_514_ar">
                <p class="text-color-black text_align_center_ar">
                    <?php echo get_field('garden_edging_wild_subheading'); ?>
                </p>
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
                                        <a class="btn_secondary_on_white_314 width_fit_to_content"
                                            href="<?php echo get_sub_field('container_button_url'); ?>"><?php echo get_sub_field('container_button_text'); ?></a>
                                    </div>
                                </div>
                                <div class="diy_garden_edging_wild_section_flex_right">
                                    <div class="diy_garden_edging_wild_section_flex_right_image">
                                        <img src="<?php echo get_sub_field('container_image'); ?>"
                                            alt="Garden Edging Wild Section Image">
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
        <div class="mid-flex-center" id="diygarden_stock_wrapper_ar">
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
                <a href="<?php echo $reurl; ?>" class="redirect_btn get_price_list_popup">
                    <?php echo $reheading; ?>
                </a>

            </div>
            <div class="heroimage_buttons" id="diygarden_stock_ar">
                <div class="image_area_hero">
                    <img src="<?php echo get_field('find_your_local_stockists_image'); ?>" alt="Featured Image">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DIY Straightcurve Promises  -->
<div class="diy_straightcurve_promises_section diy_main_wraaper_ar pad_top_bottom_80"
    id="diy_straightcurve_promises_section">
    <div class="container_ar_mi">
        <div class="diy_straightcurve_promises_section_inner">
            <div class="diy_straightcurve_promises_section_inner_heading">
                <h2 class="text_align_center_ar"><?php echo get_field('straightcurve_promises_heading'); ?></h2>
            </div>
            <div class="diy_straightcurve_promises_section_inner_subheading max_width_514_ar">
                <p class="text-color-black text_align_center_ar">
                    <?php echo get_field('straightcurve_promises_subheading'); ?>
                </p>
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
<div class="practreason pad_top_bottom_128" id="homeaccordiana_ar">
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
                                <img src="<?php echo get_template_directory_uri() . '/assets/img/MinusCircle.svg' ?>" alt=""
                                    id="minus_ar" class="hide_ar_accord">
                                <img src="<?php echo get_template_directory_uri() . '/assets/img/PlusCircle.svg' ?>" alt=""
                                    id="plus_ar">
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