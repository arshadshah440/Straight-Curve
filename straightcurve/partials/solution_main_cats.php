<?php $solution_main_cats = get_field('solution_main_cats', 'options');
foreach ($solution_main_cats as $cat_info) :
	$image = '';
	if (isset($cat_info['image']['url'])) {
		$image = $cat_info['image']['url'];
	}
	$link = '#';
	if (isset($cat_info['page_link']['url'])) {
		$link = $cat_info['page_link']['url'];
	}

	$layout_class = 'o-layout__item u-1/2@tablet';
	if (current_site() === 'uk' || current_site() === 'au' || current_site() === 'nl' || current_site() === 'us') {
		$layout_class = 'is-tall o-layout__item u-1/3@tabletWide u-1/2@mobileLandscape';
	}
?><div class="c-cat-tile <?php echo $layout_class; ?>">
	<?php if ($cat_info['coming_soon'] || $link === '#') : ?>
		<div class="c-cat-tile__inner coming-soon lazyload" data-src="<?php echo $image; ?>">
	<?php else : ?>
		<a href="<?php echo ($cat_info['coming_soon'] ? '' : $link); ?>" class="c-cat-tile__inner is-link lazyload" data-src="<?php echo $image; ?>">
	<?php endif; ?>
		<?php if (isset($cat_info['heavy_duty']) && $cat_info['heavy_duty']) : ?>
			<span class="c-cat-tile__heavy-duty">Heavy Duty</span>
		<?php endif; ?>

		<div class="c-cat-tile__content">
			<h3><?php echo $cat_info['title']; ?></h3>
			<?php if (isset($cat_info['tagline']) && $cat_info['tagline']) : ?>
				<h4><?php echo $cat_info['tagline']; ?></h4>
			<?php endif; ?>
			<?php if (isset($cat_info['list'][0])) : ?>
				<ul>
					<?php foreach ($cat_info['list'] as $item) : ?>
						<li><?php echo $item['item']; ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

			<?php if ($cat_info['coming_soon'] || $link === '#') : ?>
				<span class="o-btn o-btn--white o-btn--outline o-btn--noarrow"><?php echo $cat_info['page_link']['title']; ?></span>
			<?php else : ?>
				<span class="o-btn o-btn--orange"><?php echo $cat_info['page_link']['title']; ?></span>
			<?php endif; ?>
		</div>
	<?php if ($cat_info['coming_soon'] || $link === '#') : ?>
		</div>
	<?php else : ?>
		</a>
	<?php endif; ?>
</div>
<?php endforeach; ?>