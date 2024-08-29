<?php
$module = $args;

?><div class="f-why-content" id="<?php echo $module['module_id']; ?>">
	<div class="o-wrapper">
		<div class="f-why-content__container">
			<?php echo $module['content']; ?>
		</div>
	</div>

	<?php if (isset($module['images'][0]['url'])) : ?>
		<div class="f-why-content__images">
			<div class="js-why-gallery">
				<?php foreach ($module['images'] as $item) : ?>
					<div class="f-why-content__image">
						<img lazyload="lazy" src="<?php echo $item['url']; ?>" alt="<?php echo $item['title']; ?>">
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>
</div>