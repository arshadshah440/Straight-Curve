<?php
$module = $args;

if (isset($module['gallery'][0]['link']['url'])) : ?>
	<div class="c-landing__video-gallery" id="<?php echo $module['module_id']; ?>">
		<div class="o-wrapper o-wrapper--med">
			<?php if ($module['title']) : ?>
				<h2 class="h2-large"><?php echo $module['title']; ?></h2>
			<?php endif; ?>
			<div class="o-layout">
				<?php foreach ($module['gallery'] as $item) : ?>
					<?php if (isset($item['link']['url'])) : ?>
						<div class="o-layout__item u-1/2@tablet">
							<div class="c-landing__video-gallery-item lazyload" data-src="<?php echo $item['image']['url']; ?>">
								<div class="c-landing__video-gallery-itemcontent">
									<h3><?php echo $item['title']; ?></h3>
									<a data-fancybox href="<?php echo $item['link']['url']; ?>" class="o-btn o-btn--play o-btn--orange"><?php echo $item['link']['title']; ?></a>
								</div>
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
<?php endif; ?>
