<?php
$module = $args;
$background = isset($module['background']) && $module['background'] ? stripString($module['background']) : '';

$classes = '';
$classes .= $background ? ' section-bg ' . $background : '';

if (isset($module['gallery'][0]['image']['url'])) : ?>
	<div class="c-landing__gallery <?php echo $classes; ?>" id="<?php echo $module['module_id']; ?>">
		<?php if ($module['title']) : ?>
			<div class="o-wrapper o-wrapper--med">
				<h2 class="h2-med"><?php echo $module['title']; ?></h2>
			</div>
		<?php endif; ?>
		<div class="c-landing__gallery-wrap js-image-gallery">
			<?php foreach ($module['gallery'] as $item) : ?>
				<div class="c-landing__gallery-item">
					<a class="c-landing__gallery-item-inner" data-fancybox="images" href="<?php echo $item['image']['url']; ?>">
						<img data-lazy="<?php echo $item['image']['sizes']['medium_large']; ?>" alt="<?php echo $item['image']['title']; ?>">
						<?php if ($item['tag']) : ?>
							<span class="o-btn o-btn--white o-btn--outline o-btn--noarrow o-btn--small"><?php echo $item['tag']; ?></span>
						<?php endif; ?>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>