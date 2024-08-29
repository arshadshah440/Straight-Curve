<?php 
$pTop = get_sub_field( 'padding_top' );
$pBottom = get_sub_field( 'padding_bottom' );
$bg = get_sub_field( 'background_colour' ); 
?>

<div class="fullhorizontalImage"
    style="padding-top: <?php echo $pTop; ?>; padding-bottom: <?php echo $pBottom; ?>; background: <?php echo $bg; ?>">

    <div class="o-wrapper">
        <div class="plainImgWrapper">
            <?php $plain_horizontal_image = get_sub_field( 'plain_horizontal_image' ); ?>
            <?php if ( $plain_horizontal_image ) : ?>
            <img src="<?php echo esc_url( $plain_horizontal_image['url'] ); ?>"
                alt="<?php echo esc_attr( $plain_horizontal_image['alt'] ); ?>" />
            <?php endif; ?>
        </div>
    </div>

</div>