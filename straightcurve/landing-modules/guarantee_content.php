<?php
$module = $args;

$bg_img = isset($module['background_image']['url']) ? $module['background_image']['url'] : '';


if (isset($module['content']) && $module['content']) : ?><div class="f-guarantee-content <?php echo ($bg_img ? 'has-bg' : ''); ?>">
	<div class="o-wrapper">
		<div class="f-guarantee-content__content">
			<?php if (isset($module['badge']['url'])) : ?>
				<img class="f-guarantee-content__badge" src="<?php echo ASSETS; ?>/img/1x1.png" data-src="<?php echo $module['badge']['url']; ?>" alt="<?php echo $module['badge']['title']; ?>">
			<?php endif; ?>
			<?php echo $module['content']; ?>
		</div>
	</div>

	<?php if ($bg_img) : ?>
		<div class="f-guarantee-content__bg" data-src="<?php echo $bg_img; ?>"></div>
	<?php endif; ?>


</div><?php endif; ?>