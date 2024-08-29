<?php 
$pTop = get_sub_field( 'padding_top' );
$pBottom = get_sub_field( 'padding_bottom' );
$bg = get_sub_field( 'background_colour' ); 
?>
<div class="landScapingSolutions onCategoryPage"
    style="padding-top: <?php echo $pTop; ?>; padding-bottom: <?php echo $pBottom; ?>; background: <?php echo $bg; ?>">
    <div class="o-wrapper">
        <h1 class="text-center catHeading green pb-2"><?php echo single_term_title(); ?></h1>
        <?php if ( get_row_layout() == 'two_column_link_to_sub_categories' ) : ?>
        <div class="solutionHolder">
            <?php if ( have_rows( 'block_content' ) ) : while ( have_rows( 'block_content' ) ) : the_row(); ?>
            <?php $block_background = get_sub_field( 'block_background' ); ?>
            <?php $block_link = get_sub_field( 'block_link' ); ?>

            <div class="landScapeSolutionBlock <?php if ( get_sub_field( 'add_orange_overlay' ) == 1 ) : ?>orangeOverlay<?php endif; ?>"
                style="background: url(<?php echo esc_url( $block_background['url'] ); ?>) no-repeat center/cover">
                <?php if ( get_sub_field( 'add_heavy_duty_tag' ) == 1 ) : ?>
                <div class="heavyDuty">HEAVY DUTY</div>
                <?php endif; ?>
                <div class="block-background-overlay"></div>
                <?php if ( get_sub_field( 'custom_block' ) == 1 ) { ?>
                <?php if ( have_rows( 'custom_block_content' ) ) : while ( have_rows( 'custom_block_content' ) ) : the_row(); ?>
                <div class="blockContent">
                    <?php $get_inspired_image = get_sub_field( 'get_inspired_image' ); ?>
                    <?php if ( $get_inspired_image ) : ?>
                    <div class="inspiredImage"><img src="<?php echo esc_url( $get_inspired_image['url'] ); ?>"
                            alt="<?php echo esc_attr( $get_inspired_image['alt'] ); ?>" /></div>
                    <?php endif; ?>
                    <div class="titleBlock">
                        <h3 class="blockTitle"><?php the_sub_field( 'title_block' ); ?></h3>
                    </div>
                    <?php $button_link = get_sub_field( 'button_link' ); ?>
                    <?php if ( $button_link ) : ?>
                    <div class="blockButton">
                        <a href="<?php echo esc_url( $button_link['url'] ); ?>"
                            target="<?php echo esc_attr( $button_link['target'] ); ?>"
                            class="btn btn-<?php the_sub_field( 'button_colour' ); ?>"><?php the_sub_field( 'button_label' ); ?></a>
                    </div>
                    <?php endif; ?>
                </div>

                <?php endwhile; endif; ?>

                <?php } else { ?>
                <div class="blockContent">
                    <div class="titleBlock">
                        <h3 class="blockTitle"><?php the_sub_field( 'block_title' ); ?></h3>
                        <h4><?php the_sub_field( 'block_secondary_title' ); ?></h4>
                    </div>
                    <div class="blockLists">
                        <ul class="icon-list-items">
                            <?php if ( have_rows( 'block_hidden_list' ) ) : while ( have_rows( 'block_hidden_list' ) ) : the_row(); ?>
                            <li class="icon-list-item">
                                <span>
                                    <i aria-hidden="true" class="far fa-check-circle"></i> </span>
                                <span class="icon-list-text"><?php the_sub_field( 'list_block' ); ?></span>
                            </li>
                            <?php endwhile; endif; ?>
                        </ul>
                    </div>
                    <div class="blockButton">
                        <a href="<?php echo esc_url( $block_link['url'] ); ?>"
                            target="<?php echo esc_attr( $block_link['target'] ); ?>"
                            class="btn btn-<?php the_sub_field( 'block_button_colour' ); ?>"><?php the_sub_field( 'block_button_label' ); ?></a>
                    </div>
                </div>
                <?php } ?>
            </div> <!-- landScapeSolutionBlock -->
            <?php endwhile; endif; ?>
        </div> <!-- solution Holder -->
        <?php endif; ?>
    </div> <!-- o-wrapper -->
</div> <!-- landScapping solutions -->