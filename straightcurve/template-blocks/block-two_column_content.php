<?php
$pTop = get_sub_field( 'padding_top' );
$pBottom = get_sub_field( 'padding_bottom' );
$bg = get_sub_field( 'background_colour' );
?>

<div class="twoColContent"
    style="padding-top: <?php echo $pTop; ?>; padding-bottom: <?php echo $pBottom; ?>; background: <?php echo $bg; ?>">
    <div class="o-wrapper">
        <div class="twoColWrapper">
            <div class="leftCol">
                <?php if ( have_rows( 'left_column' ) ) : ?>
                <?php while ( have_rows( 'left_column' ) ) : the_row(); ?>
                <div class="titleBox orange"><?php the_sub_field( 'block_title' ); ?></div>
                <div class="leftContentBlock"><?php the_sub_field( 'left_column_content' ); ?></div>
                <?php endwhile; ?>
                <?php endif; ?>

            </div>
            <div class="rightCol">
                <?php if ( have_rows( 'right_column' ) ) : while ( have_rows( 'right_column' ) ) : the_row(); ?>
                <div class="rightBlockTitle">
                    <h2><?php the_sub_field( 'block_title_right' ); ?></h2>
                </div>
                <div class="rightContentBlock">
                    <?php the_sub_field( 'block_content_right' ); ?>
                </div>
                <?php $link_to_gallery = get_sub_field( 'link_to_gallery' ); ?>
                <?php if ( $link_to_gallery ) : ?>
                <?php foreach ( $link_to_gallery as $post ) : ?>
                <?php setup_postdata ( $post ); ?>
                <div class=""><a class="btn btn-orange" href="<?php the_permalink(); ?>">View Gallery</a></div>
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
                <?php endif; ?>
                <?php endwhile; endif; ?>
            </div>
        </div>




    </div>
</div>