<?php
$var = get_query_var('var');
if (!isset($var['term']->name)) {
	return;
} else {
	$term = $var['term'];
}

$cat_info = get_field('category_info', $term);
if (isset($cat_info['image']['url'])) {
	$image = $cat_info['image']['url'];
}

$link = '/solutions/';
if (isset($var['main_cat']->slug)) {
	$link .= $var['main_cat']->slug . '/';
}
$link .= $term->slug;
?><div class="c-cat-tile o-layout__item u-1/2@tablet">
	<?php if ($cat_info['coming_soon']) : ?>
		<div class="c-cat-tile__inner coming-soon lazyload" data-src="<?php echo $image; ?>">
	<?php else : ?>
		<a href="<?php echo ($cat_info['coming_soon'] ? '' : $link); ?>" class="c-cat-tile__inner is-link lazyload" data-src="<?php echo $image; ?>">
	<?php endif; ?>
		<?php if ($cat_info['heavy_duty']) : ?>
			<span class="c-cat-tile__heavy-duty">Heavy Duty</span>
		<?php endif; ?>

		<div class="c-cat-tile__content">
			<h3><?php echo $term->name; ?></h3>
			<?php if ($cat_info['tagline']) : ?>
				<h4><?php echo $cat_info['tagline']; ?></h4>
			<?php endif; ?>
			<?php if (isset($cat_info['list'][0])) : ?>
				<ul>
					<?php foreach ($cat_info['list'] as $item) : ?>
						<li><?php echo $item['item']; ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

			<?php if ($cat_info['coming_soon']) : ?>
				<span class="o-btn o-btn--white o-btn--outline o-btn--noarrow">Coming soon</span>
			<?php else : ?>
				<span class="o-btn o-btn--orange">View Products</span>
			<?php endif; ?>
		</div>
	<?php if ($cat_info['coming_soon']) : ?>
		</div>
	<?php else : ?>
		</a>
	<?php endif; ?>
</div>