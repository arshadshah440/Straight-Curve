<?php
$module = $args;
$background = isset($module['background']) && $module['background'] ? stripString($module['background']) : '';

$classes = '';
$classes .= $background ? ' section-bg ' . $background : '';

?><div class="f-logos <?php echo $classes; ?>" id="<?php echo $module['module_id']; ?>">
	<div class="o-wrapper">
		<?php if ($module['title']) : ?>
			<h2><?php echo $module['title']; ?></h2>
		<?php endif; ?>
		<?php if (isset($module['logos'][0])) : ?>
			<div class="f-logos__logos">
				<?php foreach ($module['logos'] as $item) :
					$wrap_start = '<span class="f-logos__logo-wrap">';
					$wrap_end = '</span>';
					if (isset($item['link']['url'])) {
						$wrap_start = '<a href="' . $item['link']['url'] . '" target="' . $item['link']['target'] . '" class="f-logos__logo-wrap is-link">';
						$wrap_end = '</a>';
					} ?>
					<?php if ($item['logo']['sizes']['medium_large']) : ?>
						<?php echo $wrap_start; ?>
							<img class="lazyload" data-src="<?php echo $item['logo']['sizes']['medium_large']; ?>" src="<?php echo ASSETS; ?>/img/2x1.png" alt="<?php echo $item['logo']['title']; ?>">
						<?php echo $wrap_end; ?>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</div>
