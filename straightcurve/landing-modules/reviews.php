<?php
$module = $args;
$layout = isset($module['layout']) && $module['layout'] ? stripString($module['layout']) : '';

$classes = '';
$classes .= $layout ? ' layout-' . $layout : '';

if (isset($module['reviews'][0]['review'])) : ?>
<div class="f-reviews-module <?php echo $classes; ?>" id="<?php echo $module['module_id']; ?>">
	<div class="o-wrapper">
		<div class="f-reviews-module__reviews <?php echo ($layout === 'large' ? 'js-reviews-slider-full' : 'js-reviews-slider'); ?>">
			<?php foreach ($module['reviews'] as $item) : ?>
				<div class="f-reviews-module__review">
					<span class="f-reviews-module__review-icon"><?php echo do_shortcode('[stars rating="5"]'); ?></span>
					<span class="f-reviews-module__review-text">“<?php echo $item['review']; ?>”</span>
					<?php if ($layout === 'large' && $item['name']) : ?>
						<span class="f-reviews-module__review-name"><?php echo $item['name']; ?></span>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?php endif; ?>