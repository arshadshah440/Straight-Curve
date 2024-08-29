<?php
$module = $args;

?><div class="f-banner-alt" id="<?php echo $module['module_id']; ?>">
	<div class="o-wrapper">
		<div class="f-banner-alt__container">
			<span class="f-banner-alt__label"><?php echo $module['label']; ?></span>
			<?php if ($module['index'] === 0) : ?>
				<h1><?php echo $module['title']; ?></h1>
			<?php else : ?>
				<h2><?php echo $module['title']; ?></h2>
			<?php endif; ?>
			<div class="f-banner-alt__content"><p><?php echo $module['copy']; ?></p></div>

			<?php if (isset($module['buttons'][0]['link']['url'])) : ?>
				<div class="f-banner-alt__buttons">
					<?php foreach ($module['buttons'] as $item) :
						$class = 'o-btn--orange';
						if ($item['color'] === 'Green') {
							$class = 'o-btn--green';
						}
						if (isset($item['link']['url'])) : ?>
							<a class="o-btn <?php echo $class; ?>" href="<?php echo $item['link']['url']; ?>" target="<?php echo $item['link']['target']; ?>"><?php echo $item['link']['title']; ?><span><?php echo $item['copy']; ?></span></a>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<div class="f-banner-alt__img lazyload" data-src="<?php echo $module['image']['url']; ?>"></div>
</div>