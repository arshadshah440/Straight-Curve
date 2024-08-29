<?php
$module = $args;
if (isset($module['video_link']['url']) && isset($module['title']) && $module['title']) :
	$image = (isset($module['image']['url']) ? $module['image']['url'] : ''); ?>
	<div class="c-landing__top-video" id="<?php echo $module['module_id']; ?>">
		<div class="o-wrapper">
			<div class="c-landing__top-video-inner lazyload" data-src="<?php echo $image; ?>">
				<div class="c-landing__top-video-content">
					<?php if (isset($module['icon']['url'])) : ?>
						<img class="c-landing__top-video-icon" loading="lazy" src="<?php echo $module['icon']['url']; ?>" alt="<?php echo $module['icon']['title']; ?>">
					<?php endif; ?>
					<h2><?php echo $module['title']; ?></h2>
					<?php if (isset($module['video_link']['url'])) : ?>
						<a data-fancybox href="<?php echo $module['video_link']['url']; ?>" class="o-btn o-btn--play o-btn--orange"><?php echo $module['video_link']['title']; ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>