<?php
$module = $args;

if (isset($module['icons_texts'][0]['icon'])) : ?><div class="f-icons-texts">
	<div class="o-wrapper">
		<div class="f-icons-texts__inner images-<?php echo count($module['icons_texts']); ?>">
			<?php if (isset($module['middle_image']['url'])) : ?>
				<div class="f-icons-texts__middle-image" data-src="<?php echo $module['middle_image']['sizes']['medium_large']; ?>"></div>
			<?php endif; ?>

			<?php foreach ($module['icons_texts'] as $key => $item) : ?>
				<div class="f-icons-texts__icon-text icon-<?php echo $key; ?>">
					<span class="f-icons-texts__icon" data-src="<?php echo $item['icon']['sizes']['preview']; ?>"></span>
					<span class="f-icons-texts__text"><?php echo $item['text']; ?></span>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div><?php endif; ?>