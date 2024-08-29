<?php
/*
 * Template Name: Solution Category Page
 */

get_header();

if ( have_posts() ) while ( have_posts() ) : the_post();

$fields = get_fields();
$tag = get_field('tag');
$gallery = get_field('gallery');
$gallery_button_label = get_field('gallery_button_label');
$content_title = get_field('content_title');
$ideal_for = get_field('ideal_for');
$image = get_the_post_thumbnail_url();
$page_id = intval(get_field('page_id'));

$cat_slug = null;
if ($page_id === 14) {
	$cat_slug = 'rigidline-straight-edge-range';
} elseif ($page_id === 12) {
	$cat_slug = 'flexline-curved-edge-range';
} elseif ($page_id === 13) {
	$cat_slug = 'hardline-straight-edge-range';
} elseif ($page_id === 10) {
	$cat_slug = 'rigidline-straight-line-range';
} elseif ($page_id === 9) {
	$cat_slug = 'flexline-curved-line-range';
} elseif ($page_id === 8) {
	$cat_slug = 'fixed-height-range';
} elseif ($page_id === 16) {
	$cat_slug = 'fixed-height-planter-boxes-range';
}

$solutions = null;
if (isset($cat_slug)) {
	$get_solutions = get_posts(array(
		'post_type' => 'solutions',
		'numberposts' => 3,
		'tax_query' => array(
			array(
				'taxonomy' => 'solutions_categories',
				'field' => 'slug',
				'terms' => $cat_slug,
			)
		)
	));

	$solutions = array();
	foreach ($get_solutions as $solution) {
		$name = get_field('product_title', $solution->ID);
		$height = intval($name);
		$solutions[$height] = $solution;
	}
	ksort($solutions);

}
?><div class="c-solution-cat">
	<div class="o-wrapper">
		<h1 class="c-solution-cat__title text-center"><?php the_title();
			if ($tag) {
				echo '<span class="c-solution-cat__tag">' . $tag . '</span>';
			}
		?></h1>

		<?php if (isset($solutions)) : ?>
			<div class="c-solution-cat__solutions">
				<div class="o-layout o-module">
					<?php foreach ($solutions as $item) {
						set_query_var('var', array('ID' => $item->ID));
						get_template_part('partials/solution');
					} ?>
				</div>
			</div>
		<?php endif; ?>

		<h3 class="c-solution-cat__content-title"><?php echo $content_title; ?></h3>
		<div class="o-layout">
			<div class="o-layout__item u-3/5@tablet">
				<div class="c-solution-cat__content">
					<?php the_content() ?>
				</div>
			</div>
			<div class="o-layout__item u-2/5@tablet">
				<h2><?php echo $ideal_for['title']; ?></h2>
				<div class="c-solution-cat__ideal-for">
					<?php echo $ideal_for['content']; ?>
					<a href="<?php echo get_the_permalink($gallery); ?>" class="o-btn o-btn--orange"><?php echo ($gallery_button_label ? $gallery_button_label : 'View Gallery'); ?></a>
				</div>
			</div>
		</div>
	</div>

	<?php if ($fields['bottom_content']['intro_copy'] || $fields['bottom_content']['accordian']) : ?>
		<div class="c-solutions__content">
			<div class="o-wrapper">
				<div class="c-solutions__content-bottom">
					<?php if ($fields['bottom_content']['intro_title']) : ?>
						<h2 class="c-solutions__content-bottom-intro-title"><?php echo $fields['bottom_content']['intro_title']; ?></h2>
					<?php endif; ?>
					<?php if ($fields['bottom_content']['intro_copy']) : ?>
						<div class="c-solutions__content-bottom-intro-copy"><?php echo $fields['bottom_content']['intro_copy']; ?></div>
					<?php endif; ?>
					<?php if ($fields['bottom_content']['accordian'] && count($fields['bottom_content']['accordian']) > 0) : ?>
						<div class="c-accordian">
							<?php foreach ($fields['bottom_content']['accordian'] as $item) : ?>
								<div class="c-accordian__item">
									<a href="javascript:void(0);" class="c-accordian__item-title"><h3><?php echo $item['title']; ?></h3></a>
									<div class="c-accordian__item-copy"><?php echo $item['copy']; ?></div>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<div class="o-wrapper">
		<img src="<?php echo ASSETS; ?>/img/2x1.trans.gif" data-src="<?php echo $image; ?>" alt="<?php the_title(); ?>" class="c-solution-cat__image lazyload">
	</div>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>