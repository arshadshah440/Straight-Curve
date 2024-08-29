<?php
/**
 * The Template for displaying all single video Gallery posts
 */
get_header(); ?>


<div class="videoGallerySingle">
    <div class="o-wrapper">
        <div class="videoContent">

            <div class="titleContent">
                <div class="icon"><img src="<?php echo ASSETS; ?>/img/idea-icon.svg" alt="Idea"></div>
                <div class="titleBox">
                    <h1><?php the_title(); ?></h1>
                    <span><?php the_field( 'page_subtitle' ); ?></span>
                </div>
            </div>
            <div class="videoGalleryWrapper">
                <?php echo do_shortcode('[video_gallery]'); ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>