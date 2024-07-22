<?php
/* Template Name: Home Template
 */
get_header();

/**************** Hero Section ***************/

?>

<div class="hero_section" id="hero_section">
    <div class="container_fluid_ar_mi">
        <div class="mid-flex-center">
            <div class="content_area_hero">
                <h6><?php echo get_field('home_hero_subheadings'); ?></h6>
                <h1><?php echo get_field('home_hero_heading'); ?></h1>
                <p><?php echo get_field('home_hero_description'); ?></p>
                <?php if (have_rows("home_hero_redirect_buttons")) { ?>
                    <div class="redirect_btns">
                        <?php while (have_rows("home_hero_redirect_buttons")) {
                            the_row();
                            $reheading = get_sub_field('redirect_button_heading');
                            $redesc = get_sub_field('redirect_button_description');
                            $reurl = get_sub_field('redirect_button_url');
                        ?>
                            <a href="<?php echo $reurl; ?>" class="redirect_btn">
                                <div class="redi_btn_ar">
                                    <div class="re_heading">
                                        <h3><?php echo $reheading; ?></h3>
                                        <p><?php echo $redesc; ?></p>
                                    </div>
                                    <div class="redire_icons">
                                        <?php include get_template_directory() . '/assets/img/fi-rr-arrow-left.svg' ?>
                                    </div>
                                </div>
                            </a>
                        <?php
                        } ?>
                    </div>
                <?php } ?>
            </div>
            <div class="heroimage_buttons">
                <div class="image_area_hero">
                    <img src="<?php echo get_field('home_hero_featured_image'); ?>" alt="Featured Image">
                </div>
                <div class="watchvideo_wrap">
                    <a href="<?php echo get_field('watch_video_url'); ?>">
                        <div class="watch_icon">
                            <?php include get_template_directory() . '/assets/img/PlayCircle.svg'; ?>
                            <?php echo get_field('watch_video_button_text'); ?>
                        </div>
                    </a>
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


/************ Why Choose Straightcurve Section ******** */


?>

<div class="whychooseus" id="whychooseus">
    <div class="container_ar_mi">
        <div class="d-flex-left-ar">
            <div class="whyuscontent">
                <h2><?php echo get_field('why_us_section_heading'); ?></h2>
                <h5><?php echo get_field('why_us_section_subheading'); ?></h5>
                <div class="whycusedesc">
                    <?php echo get_field('why_us_section_description'); ?>
                </div>
            </div>
            <div class="trythemcolumn_ar">
                <h4><?php echo get_field('bullet_points_headings'); ?></h4>
                <?php
                if (have_rows('bullet_points')) {
                ?>
                    <div class="trythempoints_ar">
                        <?php
                        while (have_rows('bullet_points')) {
                            the_row();
                            $heading = get_sub_field('point_text');
                        ?>
                            <div class="trythempoints">
                                <?php include get_template_directory() . '/assets/img/fi-rr-add.svg' ?>
                                <h3><?php echo $heading; ?></h3>
                            </div>

                        <?php
                        } ?>
                    </div>
                <?php
                }
                ?>
                <div class="getstartedbtn"><a href="<?php echo get_field('why_us_section_button_link'); ?>"><?php echo get_field('why_us_section_button_text'); ?></a>
                </div>
            </div>
        </div>
    </div>
    <div class="ourrange_slider_ar">
        <h4><?php echo get_field('why_us_section_slider_title'); ?></h4>
        <?php if (have_rows('why_us_section_slider')) : ?>
            <div class="ourrange_slider_container">
                <div class="ourrange_slider owl-carousel">
                    <?php while (have_rows('why_us_section_slider')) :
                        the_row();
                        $img = get_sub_field('slide_image');
                        $heading = get_sub_field('slide_title'); ?>
                        <div class="slide">
                            <img src="<?php echo $img; ?>" alt="">
                            <h5><?php echo $heading; ?></h5>
                        </div>
                    <?php endwhile; ?>
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
        <?php endif; ?>
    </div>
</div>

<?php
/****************  features & benefits Section **********/

?>

<div class="featuresandbenefits" id="featuresandbenefits">
    <div class="container_ar_mi">
        <h2><?php echo get_field('features_and_benefits_section_title'); ?></h2>
        <p><?php echo get_field('features_and_benefits_section_subheading'); ?></p>
        <?php
        if (have_rows('features_and_benefits_section_categories')) {
        ?>
            <div class="featurescategories_mi_ar">
                <?php
                while (have_rows('features_and_benefits_section_categories')) {
                    the_row();
                    $heading = get_sub_field('category_title');
                    $desc = get_sub_field('category_description');
                ?>
                    <div class="benfitslist_card_ar">
                        <div class="benefit_header_img">
                            <img src="<?php echo get_sub_field('category_image'); ?>" alt="">
                        </div>
                        <div class="benefits_card_body_ar">
                            <div class="d-flex-ar-mi">
                                <div class="benefit_content">
                                    <h3><?php echo $heading; ?></h3>
                                    <p><?php echo $desc; ?></p>
                                </div>
                                <div class="linkbuttons_ar">
                                    <a href="<?php echo get_sub_field('category_link'); ?>" class="getstartedbtn"><?php include get_template_directory() . '/assets/img/fi-rr-arrow-left.svg' ?></a>
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
                                    <a href="<?php echo get_sub_field('product_category_trade_button_link'); ?>" class="getstartedbtn"><?php echo get_sub_field('product_category_trade_button_text'); ?></a>
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
/***********  Practicaly  Reason Section **********/
?>
<div class="practreason pad_top_bottom_90" id="practreason">
    <div class="container_ar_mi">
        <h2><?php echo get_field('practical_reasons_section_title'); ?></h2>
        <div class="subheading">
            <p><?php echo get_field('practical_reasons_section_subheading'); ?></p>
        </div>
        <?php
        if (have_rows('practical_reasons')) {
        ?>
            <div class="reason_wrapper_ar owl-carousel" id="reason_wrapper_ar">

                <?php
                while (have_rows('practical_reasons')) {
                    the_row();
                    $icon = get_sub_field('practical_reasons_icon');
                    $title = get_sub_field('practical_reasons_title');
                    $description = get_sub_field('practical_reasons_description');
                ?>
                    <div class="practreason_card_ar">
                        <div class="practreason_card_img">
                            <img src="<?php echo $icon; ?>" alt="">
                        </div>
                        <div class="practreason_card_body_ar">
                            <h4><?php echo $title; ?></h4>
                            <div class="practreason_card_desc_ar"><?php echo $description; ?></div>
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


<?php
/******************  Exclusive  Perks ********** */

?>
<div class="landscape_hero_section" id="exclusive_perk_home_ar">
    <div class="container_fluid_ar_mi">
        <div class="mid-flex-center">
            <div class="content_area_landscape_hero">
                <h2><?php echo get_field('exclusive_perks_section_title'); ?></h2>
                <h5><?php echo get_field('exclusive_perks_section_subheading'); ?></h5>
                <?php
                if (have_rows('benefits_of_pro_account')) {
                ?>
                    <div class="landscape_trythempoints_ar">
                        <?php
                        while (have_rows('benefits_of_pro_account')) {
                            the_row();
                            $heading = get_sub_field('benefits_of_pro_account_headings');
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
                $reheading = get_field('exclusive_perks_section_button_text');
                $reurl = get_field('exclusive_perks_section_button_link');
                ?>
                <a href="<?php echo $reurl; ?>" class="redirect_btn">
                    <?php echo $reheading; ?>
                </a>
            </div>
            <div class="heroimage_buttons">
                <div class="image_area_hero">
                    <img src="<?php echo get_field('exclusive_perks_section_image'); ?>" alt="Featured Image">
                </div>
            </div>
        </div>
    </div>
</div>


<?php
/***********  Latest   Blog Section **********/
?>
<div class="practreason pad_top_bottom_90" id="latest_blog_ar">
    <div class="container_ar_mi">
        <h2><?php echo get_field('latest_blogs_section_title'); ?></h2>
        <div class="subheading">
            <p><?php echo get_field('latest_blogs_section_subheading'); ?></p>
        </div>
        <?php
        $posts_per_page = !empty(get_field('numbers_of_blogs_to_show')) ? get_field('numbers_of_blogs_to_show') : 3;

        $query = new WP_Query(array(
            'post_type'      => 'post',
            'posts_per_page' => $posts_per_page,
        ));

        if ($query->have_posts()) :
        ?>
            <div class="latestpost_wraaper_ar">


                <?php
                while ($query->have_posts()) : $query->the_post(); ?>
                    <?php include get_template_directory() . '/template-parts/PostsLoopHome.php'; ?>
                <?php endwhile;
                wp_reset_postdata();
            else : ?>
                <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
            </div>
        <?php endif; ?>
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
<?php
get_footer('straight');
?>