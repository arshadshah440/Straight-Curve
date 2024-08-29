<?php
$pTop = get_sub_field( 'padding_top' );
$pBottom = get_sub_field( 'padding_bottom' );
$bg = get_sub_field( 'background_colour' );
?>

<div class="solutionProductLinks"
    style="padding-top: <?php echo $pTop; ?>; padding-bottom: <?php echo $pBottom; ?>; background: <?php echo $bg; ?>">
    <div class="o-wrapper">
        <h1 class="text-center catHeading green pb-2"><?php the_sub_field( 'title_for_the_block' ); ?></h1>
        <div class="productLinksWrapper">
            <?php $choose_solutions = get_sub_field( 'choose_solutions' ); ?>
            <?php if ( $choose_solutions ) : ?>
            <?php foreach ( $choose_solutions as $post ) : ?>
            <?php setup_postdata ( $post ); ?>
            <div class="productBlock">
                <div class="productContentWrapper">
                    <?php $featured_img_url = get_the_post_thumbnail_url($post->ID, 'medium_large'); ?>
                    <a class="img" href="<?php the_permalink(); ?>"
                        style="background-image: url(<?php echo $featured_img_url; ?>)">

                    </a>
                    <a href="<?php get_permalink(); ?>" class="title"><?php echo get_field('product_title'); ?></a>
                    <div><a class="btn btn-orange" href="<?php the_permalink(); ?>"><?php echo ra_lang('View Product'); ?></a></div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>
    </div>
</div>