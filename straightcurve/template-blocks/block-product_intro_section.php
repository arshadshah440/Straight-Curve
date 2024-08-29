<?php 
$pTop = get_sub_field( 'padding_top' );
$pBottom = get_sub_field( 'padding_bottom' );
$bg = get_sub_field( 'background_colour' ); 
?>

<div class="productIntro"
    style="padding-top: <?php echo $pTop; ?>; padding-bottom: <?php echo $pBottom; ?>; background: <?php echo $bg; ?>">
    <div class="o-wrapper">
        <div class="infoTitle orange"><?php the_sub_field( 'product_intro_title' ); ?></div>
        <div class="infoContent">
            <?php the_sub_field( 'product_intro_content' ); ?>
        </div>
    </div>
</div>