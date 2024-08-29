<?php
$module = $args;
$layout = isset($module['layout']) && $module['layout'] ? stripString($module['layout']) : '';
$background = isset($module['background']) && $module['background'] ? stripString($module['background']) : '';
$top_bottom_spacing = isset($module['top_bottom_spacing']) && $module['top_bottom_spacing'] ? stripString($module['top_bottom_spacing']) : '';
$full_title = isset($module['full_title']) && $module['full_title'];

$classes = '';
$classes .= $layout ? ' ' . $layout : '';
$classes .= $background ? ' section-bg ' . $background : '';
$classes .= $top_bottom_spacing ? ' spacing-' . $top_bottom_spacing : '';

// $classes .= isset($module['alt_style']) && $module['alt_style'] ? ' alt-style' : '';

?><div class="f-content-image <?php echo $classes; ?>" id="<?php echo $module['module_id']; ?>">
	<div class="o-wrapper">
		<?php if ($module['title'] && $full_title) : ?>
			<h2 class="h2-med f-content-image__title full"><?php echo $module['title']; ?></h2>
		<?php endif; ?>
		<div class="f-content-image__wrap">
			<?php if (isset($module['image']['url'])) : ?>
				<div class="f-content-image__image">
					<img loading="lazy" class="lazyload" src="<?php echo $module['image']['url']; ?>" alt="<?php echo $module['image']['title']; ?>">
					<?php if ($module['image_text']) : ?>
						<div class="f-content-image__image-text"><span><?php echo $module['image_text']; ?></span></div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<div class="f-content-image__content">
				<?php if ($module['title'] && !$full_title) : ?>
					<h2 class="f-content-image__title"><?php echo $module['title']; ?></h2>
				<?php endif; ?>
				<?php if ($module['copy']) : ?>
					<div class="f-content-image__copy"><?php echo $module['copy']; ?></div>
				<?php endif; ?>
				<?php if (isset($module['link']['url'])) : ?>
					<div class="f-content-image__link">
						<a href="<?php echo $module['link']['url']; ?>" target="<?php echo $module['link']['target']; ?>" class="o-btn o-btn--noarrow"><?php echo $module['link']['title']; ?></a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>