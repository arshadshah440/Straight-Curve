<?php

if (isset($args['link_tiles'][0]['title'])) : ?>
<div class="f-link-tiles" id="<?php echo $module['module_id']; ?>">
	<div class="o-wrapper">
		<div class="o-layout o-module">
			<?php foreach ($args['link_tiles'] as $key => $item) : ?>
				<div class="o-layout__item o-module__item <?php echo ($key === 0 || $key === 1 ? 'u-1/2@tabletWide' : 'u-1/3@tabletWide'); ?> u-1/2@mobileLandscape">
					<a href="<?php echo $item['link']['url']; ?>" target="<?php echo $item['link']['target']; ?>" class="f-link-tile">
						<?php if (isset($item['icon']['url'])) : ?>
							<img class="f-link-tile__icon" src="<?php echo ASSETS; ?>/img/1x1.trans.gif" data-src="<?php echo $item['icon']['url']; ?>" alt="<?php echo $item['icon']['title']; ?>">
						<?php endif; ?>
						<h3 class="f-link-tile__title"><?php echo $item['title']; ?></h3>
						<p class="f-link-tile__copy"><?php echo $item['copy']; ?></p>
						<?php if (isset($item['link']['url']) && $item['link']['url']) : ?>
							<span class="f-link-tile__link"><?php echo $item['link']['title']; ?></span>
						<?php endif; ?>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?php endif; ?>
