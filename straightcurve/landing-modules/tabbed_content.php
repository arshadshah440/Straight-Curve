<?php


if (isset($args['tabbed_content'][0]['tab']) && $args['tabbed_content'][0]['tab']) {
	foreach ($args['tabbed_content'] as $key => $item) {
		$args['tabbed_content'][$key]['target'] = $key . '-' . stripString($item['tab']);
	}
}
?><div class="f-tabbed-content" id="<?php echo $args['module_id']; ?>">
	<div class="o-wrapper">
		<div class="f-tabbed-content__inner">
			<?php if (isset($args['intro']) && $args['intro']) : ?>
				<div class="f-tabbed-content__intro"><?php echo $args['intro']; ?></div>
			<?php endif; ?>

			<?php if (isset($args['tabbed_content'][0]['tab']) && $args['tabbed_content'][0]['tab']) : ?>
				<div class="f-tabbed-content__nav-wrap">
					<ul class="f-tabbed-content__nav">
						<?php foreach ($args['tabbed_content'] as $key => $item) : ?>
							<li><a href="javascript:void(0);" data-target="<?php echo $item['target']; ?>" class="js-tabbed-content-link <?php echo ($key === 0 ? 'is-active' : ''); ?>"><?php echo $item['tab']; ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>

				<div class="f-tabbed-content__all">
					<?php foreach ($args['tabbed_content'] as $key => $item) : ?>
						<div class="f-tabbed-content__each js-tabbed-content <?php echo $item['target']; ?>" style="<?php echo ($key === 0 ? '' : 'display:none;'); ?>">
							<?php if (isset($item['image']['url'])) : ?>
								<div class="f-tabbed-content__each-image">
									<img loading="lazy" class="lazyload" src="<?php echo $item['image']['url']; ?>" alt="<?php echo $item['image']['title']; ?>">
								</div>
							<?php endif; ?>
							<div class="f-tabbed-content__each-content">
								<?php if ($item['copy']) : ?>
									<div class="f-tabbed-content__each-copy"><?php echo $item['copy']; ?></div>
								<?php endif; ?>
								<?php if (isset($item['link']['url'])) : ?>
									<div class="f-tabbed-content__each-link">
										<a href="<?php echo $item['link']['url']; ?>" target="<?php echo $item['link']['target']; ?>" class="o-btn o-btn--noarrow o-btn--orange"><?php echo $item['link']['title']; ?></a>
									</div>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>


		<?php if (isset($args['cta']['title']) && $args['cta']['title']) : ?>
			<div class="f-tabbed-content__cta c-prouserpromo">
				<div class="c-prouserpromo__container <?php echo (isset($args['cta']['icon']['url']) ? 'has-icon' : ''); ?>">
					<?php if (isset($args['cta']['icon']['url'])) : ?>
						<img loading="lazy" src="<?php echo $args['cta']['icon']['url']; ?>" alt="<?php echo $args['cta']['icon']['title']; ?>">
					<?php endif; ?>
					<div class="c-prouserpromo__content">
						<h3><?php echo $args['cta']['title']; ?></h3>
						<p><?php echo $args['cta']['copy']; ?></p>
					</div>
					<?php if (isset($args['cta']['link']['url'])) : ?>
						<a href="<?php echo $args['cta']['link']['url']; ?>" target="<?php echo $args['cta']['link']['target']; ?>" class="o-btn o-btn--orange"><?php echo $args['cta']['link']['title']; ?></a>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>

	</div>
</div>