<?php
$module = $args;

if (isset($module['title']) && $module['title']) :


$background = isset($module['background']) && $module['background'] ? stripString($module['background']) : '';

$classes = '';
$classes .= $background ? ' section-bg ' . $background : '';

$layout_item_class = 'u-1/3@tablet u-1/2@mobileLandscape';
if (isset($module['columns']) && $module['columns'] === '4') {
	$layout_item_class = 'u-1/4@tabletWide u-1/3@tablet u-1/2';
}
?>
	<div class="c-landing__top-content <?php echo $classes; ?>" id="<?php echo $module['module_id']; ?>">
		<div class="o-wrapper o-wrapper--med">
			<div class="c-landing__top-content-inner">
				<h2 class="h2-med"><?php echo $module['title']; ?></h2>
				<div class="c-landing__top-content-content"><?php echo $module['copy']; ?></div>
			</div>
			<div class="c-landing__cards">
				<div class="o-layout o-module">
					<?php foreach ($module['cards'] as $item) : ?>
						<div class="c-landing__card c-landing__card--alt <?php echo $layout_item_class; ?> o-layout__item o-module__item">
							<div class="c-landing__card-inner">
								<?php if (isset($item['image']['url'])) : ?>
									<img class="lazyload" src="<?php echo ASSETS; ?>/img/1x1.trans.gif" data-src="<?php echo $item['image']['url']; ?>" alt="<?php echo $item['image']['title']; ?>">
								<?php endif; ?>
								<?php if ($item['title']) : ?>
									<h3><?php echo $item['title']; ?></h3>
								<?php endif; ?>
								<?php if ($item['copy']) : ?>
									<div><?php echo $item['copy']; ?></div>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<?php if ($module['bottom_content']) : ?>
				<div class="c-landing__top-content-bottom">
					<?php echo $module['bottom_content']; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>