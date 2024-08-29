<?php
/*
 * Template Name: Where to buy
 */

get_header();
if ( have_posts() ) while ( have_posts() ) : the_post() ;

$fields = get_fields();

?><div class="c-where-to-buy">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="o-wrapper" hidden>
            <h1><?php the_title(); ?></h1>
		</div>
		<div class="c-cms-content">
            <?php the_content(); ?>
        </div>
		<?php if (isset($fields['pricelist_banner']['title']) && $fields['pricelist_banner']['title']) : ?>
			<div class="c-where-to-buy__pricelist">
				<div class="o-wrapper">
					<h2><?php echo $fields['pricelist_banner']['title']; ?></h2>
					<a href="#pricelist" class="o-btn o-btn--orange"><?php echo $fields['pricelist_banner']['button_label']; ?></a>
				</div>
			</div>
		<?php endif; ?>
    </article>
</div>

<?php endwhile;
get_footer(); ?>