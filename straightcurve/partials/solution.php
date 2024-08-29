<?php
	$var = get_query_var('var');
	$id = $var['ID'];
	if (!$id) { return; }

	$gc = get_field('general_content', 'options');
	$title = get_field('product_title', $id);
	$title = str_replace(' high', '', $title);
	$title .= ' ' .  ($gc['solution_title_high'] ? $gc['solution_title_high'] : 'high');
	$thumb = get_the_post_thumbnail_url($id, 'medium_large');

	$button_label = $gc['solution_button'] ? $gc['solution_button'] : 'View Product';
?><div class="c-solution o-layout__item o-module__item u-1/3@tablet u-1/2">
	<a href="<?php echo get_the_permalink($id); ?>" class="o-layout__content c-solution__wrapper">
		<img class="c-solution__thumb lazyload" src="<?php echo ASSETS; ?>/img/2x1.trans.gif" data-src="<?php echo $thumb; ?>" alt="<?php echo $title; ?>">
		<div class="c-solution__content">
			<h3><?php echo $title; ?></h3>
			<span class="o-btn o-btn--orange"><?php echo ra_lang($button_label); ?></span>
		</div>
	</a>
</div>