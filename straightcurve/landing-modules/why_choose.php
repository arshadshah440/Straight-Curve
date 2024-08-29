<?php
$module = $args;
if (isset($module['title'])) : ?>
<div class="c-landing__why-choose" id="<?php echo $module['module_id']; ?>">
	<div class="o-wrapper o-wrapper--med">
		<?php if ($module['title'] || $module['copy']) : ?>
			<div class="c-landing__why-choose-inner">
				<h2 class="h2-large"><?php echo $module['title']; ?></h2>
				<div class="c-landing__why-choose-content"><?php echo $module['copy']; ?></div>
			</div>
		<?php endif; ?>
		<?php if (isset($module['image']['url'])) : ?>
			<div class="c-landing__why-choose-image c-imagetext">
				<img class="c-imagetext__image lazyload" src="<?php echo ASSETS; ?>/img/2x1.png" data-src="<?php echo $module['image']['url']; ?>" alt="<?php echo $module['image']['title']; ?>">
				<?php if ($module['image_content']) : ?>
					<?php foreach ($module['image_content'] as $item) :
						$class = '';
						if ($item['position_left'] === 0 || $item['position_left'] < 24) {
							$class .= ' adjust-left';
						}
						if ($item['position_left'] && $item['position_left'] > 70) {
							$class .= ' adjust-right';
						}
						if ($item['title'] || $item['copy']) : ?>
							<a href="javascript:void(0);" class="c-imagetext__link <?php echo $class; ?>" style="top: <?php echo $item['position_top']; ?>%; left: <?php echo $item['position_left']; ?>%;">
								<span class="c-imagetext__icon"><i class="far fa-plus"></i></span>
								<div class="c-imagetext__text">
									<?php if ($item['title']) : ?>
										<h4><?php echo $item['title']; ?></h4>
									<?php endif; ?>
									<?php if ($item['copy']) : ?>
										<?php echo $item['copy']; ?>
									<?php endif; ?>
								</div>
							</a>
						<?php endif; ?>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<?php if (isset($module['link']['url'])) : ?>
			<a href="<?php echo $module['link']['url']; ?>" target="<?php echo $module['link']['target']; ?>" class="o-btn o-btn--noarrow o-btn--orange"><?php echo $module['link']['title']; ?></a>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>