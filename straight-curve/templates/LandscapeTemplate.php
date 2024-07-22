<?php
/* Template Name: Landscape Template
 */
get_header();

/****************Landscape Hero Section ***************/

?>

<div class="landscape_hero_section" id="landscape_hero_section">
    <div class="container_fluid_ar_mi">
        <div class="mid-flex-center">
            <div class="content_area_landscape_hero">
                <h1><?php echo get_field('landscape_hero_section_heading'); ?></h1>
                <h5><?php echo get_field('landscape_hero_section_subheading'); ?></h5>
                <?php
                if (have_rows('landscape_hero_section_benefits')) {
                ?>
                    <div class="landscape_trythempoints_ar">
                        <?php
                        while (have_rows('landscape_hero_section_benefits')) {
                            the_row();
                            $heading = get_sub_field('benefits_of_pro_account_text');
                        ?>
                            <div class="landscape_trythempoints">
                                <?php include get_template_directory() . '/assets/img/fi-rr-add.svg' ?>
                                <p><?php echo $heading; ?></p>
                            </div>

                        <?php
                        } ?>
                    </div>
                <?php
                }
                $reheading = get_field('landscape_hero_section_button_text');
                $reurl = get_field('landscape_hero_section_button_link');
                ?>
                <a href="<?php echo $reurl; ?>" class="redirect_btn">
                    <div class="redi_btn_ar">
                        <div class="re_heading">
                            <h3><?php echo $reheading; ?></h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="heroimage_buttons">
                <div class="image_area_hero">
                    <img src="<?php echo get_field('landscape_featured_image'); ?>" alt="Featured Image">
                </div>
            </div>
        </div>
    </div>
</div>

<?php
/**************** review Section **********/

if (have_rows('home_review')) {
?>
    <div class="review_section" id="review_section">
        <div class="auto_slider_play_ar owl-carousel">
            <?php while (have_rows('home_review')) {
                the_row();
                $rating = intval(get_sub_field('review_ratings'));
                $review = get_sub_field('review_text');
            ?>
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
            <?php } ?>
        </div>
    </div>
<?php
}
?>
<!-- Why Choose Straightcurve section  -->

<div class="landscape_whychoose_section" id="landscape_whychoose_section">
    <div class="landscape_whychoose_section_inner container_ar_mi">
        <div class="lanscape_whychoose_heading_text">
            <h2><?php echo get_field('why_choose_section_heading'); ?></h2>
            <p><?php echo get_field('why_choose_section_subheading'); ?></p>
        </div>
        <div class="landscape_whychoose_tabs">
            <div class="landscape_whychoose_tab_list">
                <div class="landscape_whychoose_tab_list_item active" data-tab="tab1">
                    <a href="javascript:void(0)"><?php echo get_field('landscaper_tab_button_text'); ?></a>
                </div>
                <div class="landscape_whychoose_tab_list_item" data-tab="tab2">
                    <a href="javascript:void(0)"><?php echo get_field('designer_and_architects_tab_button_text'); ?></a>
                </div>
            </div>
            <div class="landscape_whychoose_tab_dropdown">
                <select id="landscape_whychoose_tab_dropdown">
                    <option value="tab1"><?php echo get_field('landscaper_tab_button_text'); ?></option>
                    <option value="tab2"><?php echo get_field('designer_and_architects_tab_button_text'); ?></option>
                </select>
            </div>
            <div class="landscape_whychoose_tab_content">
                <div class="landscape_whychoose_tab_content_item active" id="tab1">
                    <div class="landscape_whychoose_tab_content_item_inner">
                        <div class="landscape_whychoose_tab_content_item_inner_left">
                            <div class="landscape_whychoose_tab_content_item_inner_left_heading">
                                <h3><?php echo get_field('landscaper_tab_heading'); ?></h3>
                            </div>
                            <?php
                            if (have_rows('landscaper_tab_text')) {
                                while (have_rows('landscaper_tab_text')) {
                                    the_row();
                                    $text = get_sub_field('landscaper_tab_bullets_text');
                            ?>
                                    <div class="landscape_whychoose_tab_content_item_inner_left_text">
                                        <?php include get_template_directory() . '/assets/img/fi-rr-add.svg' ?>
                                        <p><?php echo $text; ?></p>
                                    </div>
                            <?php }
                            } ?>
                            <div class="landscape_whychoose_tab_content_item_inner_left_button">
                                <a href="<?php echo get_field('landscaper_tab_register_button_link'); ?>"><?php echo get_field('landscaper_tab_register_button_text'); ?></a>
                            </div>
                        </div>
                        <div class="landscape_whychoose_tab_content_item_inner_right">
                            <img src="<?php echo get_field('landscaper_tab_image'); ?>" alt="Landscaper Tab Image">
                        </div>
                    </div>
                </div>
                <div class="landscape_whychoose_tab_content_item" id="tab2">
                    <div class="landscape_whychoose_tab_content_item_inner">
                        <div class="landscape_whychoose_tab_content_item_inner_left">
                            <div class="landscape_whychoose_tab_content_item_inner_left_heading">
                                <h3><?php echo get_field('designer_and_architects_tab_heading'); ?></h3>
                            </div>
                            <?php
                            if (have_rows('designer_and_architects_tab_text')) {
                                while (have_rows('designer_and_architects_tab_text')) {
                                    the_row();
                                    $text = get_sub_field('designer_and_architects_tab_bullets_text');
                            ?>
                                    <div class="landscape_whychoose_tab_content_item_inner_left_text">
                                        <?php include get_template_directory() . '/assets/img/fi-rr-add.svg' ?>
                                        <p><?php echo $text; ?></p>
                                    </div>
                            <?php }
                            } ?>
                            <div class="landscape_whychoose_tab_content_item_inner_left_button">
                                <a href="<?php echo get_field('designer_and_architects_tab_register_button_link'); ?>"><?php echo get_field('designer_and_architects_tab_register_button_text'); ?></a>
                            </div>
                        </div>
                        <div class="landscape_whychoose_tab_content_item_inner_right">
                            <img src="<?php echo get_field('designer_and_architects_tab_image'); ?>" alt="Designer and Architects Tab Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
/****************  what people are saying Section **********/

?>

<div class="testimonials_ar" id="testimonials_ar">
    <div class="container_fluid_mi_ar">
        <h2><?php echo get_field('testimonials_section_title'); ?></h2>
        <div class="subheading"><?php echo get_field('testimonial_section_description'); ?></div>
        <?php if (have_rows('testimonials_slider')) : ?>
            <div class="testimon_slider" id="testimon_slider">
                <div class="testimon_mi_ar owl-carousel">
                    <?php while (have_rows('testimonials_slider')) : the_row();
                        $review = get_sub_field('testimonials_slide_review');

                        $username = get_sub_field('testimonial_user_name');
                        $company = get_sub_field('testimonial_company_name');
                        $clogo = get_sub_field('testimonial_company_logo');
                        $fimage = get_sub_field('testimonial_video');
                    ?>
                        <div class="testimon_card_ar">
                            <div class="testimon_card_body_ar">
                                <div class="d-flex--column-ar-mi slide">
                                    <div class="testimon_content">
                                        <div class="quotes_review_ar">
                                            <?php include get_template_directory() . '/assets/img/quote.svg'; ?>
                                            <div class="review_text_ar"><?php echo $review; ?></div>
                                        </div>
                                        <div class="user_info_ar">
                                            <div class="userdetails_ar">
                                                <h4><?php echo $username; ?></h4>
                                                <p><?php echo $company; ?></p>
                                            </div>
                                            <div class="company_logo">
                                                <img src="<?php echo $clogo; ?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="testimon_content_img">
                                        <?php

                                        if (isVideoFile($fimage)) {
                                        ?>
                                            <video src="<?php echo $fimage; ?>">
                                            </video>
                                            <div class="play_button_for_straight">
                                                <?php include get_template_directory() . '/assets/img/play_button_for_straight.svg'; ?>
                                            </div>
                                        <?php

                                        } else {
                                        ?>
                                            <img src="<?php echo $fimage; ?>" alt="">

                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="slider_controls test_slider_controls_ar">
                    <div class="for_dotsrap"></div>
                    <div class="price_list_btn_ar">
                        <a href="<?php echo get_field('testimonial_section_button_link'); ?>" class="price_list_btn"><?php echo get_field('testimonial_section_button_text'); ?></a>
                    </div>
                    <div class="controls_wraper">
                        <div class="prevbtn">
                            <i class="fa-solid fa-chevron-left"></i>
                        </div>
                        <div class="nextbtn">
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                    </div>

                </div>
            </div>
        <?php endif; ?>
    </div>
</div>


<?php
/****************  Range OF Products Section **********/

?>

<div class="rangeofproducts_ar" id="rangeofproducts_ar">
    <div class="container_ar_mi">
        <h2><?php echo get_field('range_of_products_section_title'); ?></h2>
        <p><?php echo get_field('range_of_products_section_description'); ?></p>
        <?php
        if (have_rows('products_categories_list')) {
        ?>
            <div class="prange_mi_ar">
                <?php
                while (have_rows('products_categories_list')) {
                    the_row();
                    $heading = get_sub_field('product_category_title');
                ?>
                    <div class="prange_card_ar">
                        <div class="prange_header_img">
                            <img src="<?php echo get_sub_field('product_category_image'); ?>" alt="">
                        </div>
                        <div class="prange_card_body_ar">
                            <div class="d-flex--column-ar-mi">
                                <div class="prange_content">
                                    <h3><?php echo $heading; ?></h3>
                                    <?php
                                    if (have_rows('product_category_bullet_points')) {
                                    ?>
                                        <div class="trythempoints_ar">
                                            <?php
                                            while (have_rows('product_category_bullet_points')) {
                                                the_row();
                                                $heading = get_sub_field('product_category_bullet_points_text');
                                            ?>
                                                <div class="trythempoints">
                                                    <?php include get_template_directory() . '/assets/img/fi-rr-add.svg' ?>
                                                    <h4><?php echo $heading; ?></h4>
                                                </div>

                                            <?php
                                            } ?>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="linkbuttons_ar">
                                    <a href="<?php echo get_sub_field('product_category_diy_button_link'); ?>" class="getstartedbtn"><?php echo get_sub_field('product_category_diy_button_text'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                } ?>
            </div>
        <?php
        } ?>
    </div>
</div>


<!-- Straightcurve promises section  -->

<div class="landscape_promise_section" id="landscape_promise_section">
    <div class="landscape_promise_section_inner container_ar_mi">
        <div class="landscape_promise_section_inner_heading_text">
            <h2><?php echo get_field('landscape_promises_section_heading'); ?></h2>
            <p><?php echo get_field('landscape_promises_section_subheading'); ?></p>
        </div>
        <div class="landscape_promise_section_inner_content">
            <?php
            if (have_rows('landscape_promises_section_content')) {
                while (have_rows('landscape_promises_section_content')) {
                    the_row();
                    $icon = get_sub_field('icon');
                    $heading = get_sub_field('heading');
                    $text = get_sub_field('subheading');
                    $link_text = get_sub_field('link_text');
                    $link_url = get_sub_field('link_url');
            ?>
                    <div class="landscape_promise_section_inner_content_item">
                        <div class="landscape_promise_section_inner_content_item_icon">
                            <img src="<?php echo $icon; ?>" alt="Designer and Architects Tab Image">
                        </div>
                        <div class="landscape_promise_section_inner_content_item_text">
                            <h3><?php echo $heading; ?></h3>
                            <p><?php echo $text; ?></p>
                        </div>
                        <div class="landscape_promise_section_inner_content_item_button">
                            <a href="<?php echo $link_url; ?>" class="text_area"><?php echo $link_text; ?></a>
                            <a href="<?php echo $link_url; ?>" class="icon_area">
                                <?php include get_template_directory() . '/assets/img/fi-rr-arrow-left.svg' ?>
                            </a>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
    </div>
</div>

<!-- landscape guide to intalling section -->


<div class="landscape_guide_to_installing_section" id="landscape_guide_to_installing_section">
    <div class="landscape_guide_to_installing_section_inner container_ar_mi">
        <div class="landscape_guide_to_installing_section_inner_flex">
            <div class="landscape_guide_to_installing_section_inner_flex_left">
                <div class="landscape_guide_to_installing_heading">
                    <h2><?php echo get_field('guide_to_installing_section_heading'); ?></h2>
                </div>
                <div class="landscape_guide_to_installing_section_inner_flex_left_text">
                    <p><?php echo get_field('guide_to_installing_section_text'); ?></p>
                </div>
                <div class="landscape_guide_to_installing_section_inner_flex_left_button">
                    <a href="<?php echo get_field('guide_to_installing_section_button_link'); ?>"><?php echo get_field('guide_to_installing_section_button_text'); ?></a>
                </div>
            </div>
            <div class="landscape_guide_to_installing_section_inner_flex_right">
                <img src="<?php echo get_field('guide_to_installing_section_image'); ?>" alt="Landscape Guide to Installing Section Image">
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


<!-- landscape some heading section -->

<div class="landscape_some_heading_section" id="landscape_some_heading_section">
    <div class="landscape_some_heading_section_inner">
        <div class="landscape_some_heading_section_inner_flex">
            <div class="landscape_some_heading_section_inner_flex_left">
                <div class="landscape_some_heading_section_inner_flex_left_heading">
                    <h2><?php echo get_field('some_heading_section_heading'); ?></h2>
                </div>
                <?php
                if (have_rows('some_heading_section_bullets_content')) {
                    while (have_rows('some_heading_section_bullets_content')) {
                        the_row();
                        $text = get_sub_field('bullets_heading');
                ?>
                        <div class="landscape_some_heading_section_inner_flex_left_text">
                            <?php include get_template_directory() . '/assets/img/fi-rr-add.svg' ?>
                            <p><?php echo $text; ?></p>
                        </div>
                <?php }
                } ?>
                <div class="landscape_some_heading_section_inner_flex_left_button">
                    <a href="<?php echo get_field('some_heading_section_button_link'); ?>"><?php echo get_field('some_heading_section_button_text'); ?></a>
                </div>
            </div>
            <div class="landscape_some_heading_section_inner_flex_right">
                <img src="<?php echo get_field('some_heading_section_image'); ?>" alt="Landscape Some Heading Section Image">
            </div>

        </div>
    </div>
</div>


<!-- get footer -->
<?php get_footer('straight'); ?>