<?php
$module = $args;


if (isset($module['title']) && $module['title']) :
	$alt = isset($module['alt_style']) && $module['alt_style'] ? true : false;
?>
<div class="f-content-cards <?php echo $alt ? 'f-content-cards--alt' : ''; ?>" id="<?php echo $module['module_id']; ?>">
	<div class="o-wrapper o-wrapper--med">
		<div class="f-content-cards__inner">
			<h2 class="h2-large"><?php echo $module['title']; ?></h2>
			<div class="f-content-cards__content"><?php echo $module['copy']; ?></div>
		</div>
		<div class="f-content-cards__cards <?php echo $alt ? 'alt-style' : ''; ?>">
			<div class="o-layout o-module o-module--center">
				<?php foreach ($module['cards'] as $item) :
					$wrap_start = '<div class="f-content-card__inner">';
					$wrap_end = '</div>';
					if (isset($item['link']['url'])) {
						$wrap_start = '<a class="f-content-card__inner is-link" href="' . $item['link']['url'] . '" target="' . $item['link']['target'] . '">';
						$wrap_end = '</a>';
					}
					?>
					<div class="f-content-card <?php echo $alt ? 'alt-style' : ''; ?> o-layout__item o-module__item u-1/3@tablet u-1/2@mobileLandscape">
						<?php echo $wrap_start; ?>
							<?php if ($item['tag']) : ?>
								<span class="f-content-card__tag o-btn o-btn--noarrow o-btn--orange o-btn--small"><?php echo $item['tag']; ?></span>
							<?php endif; ?>

							<?php if (isset($item['image']['url'])) : ?>
								<div class="f-content-card__img">
									<img class="lazyload" src="<?php echo ASSETS; ?>/img/1x1.trans.gif" data-src="<?php echo $item['image']['url']; ?>" alt="<?php echo $item['image']['title']; ?>">
								</div>
							<?php endif; ?>

							<div class="f-content-card__content">
								<h3><?php echo $item['title']; ?></h3>

								<?php if ($alt && isset($item['link']['title']) && $item['link']['title']) : ?>
									<span class="o-btn o-btn--small o-btn--white o-btn--outline"><?php echo $item['link']['title']; ?></span>
								<?php endif; ?>
							</div>
						<?php echo $wrap_end; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php if (isset($module['link']['url'])) : ?>
			<a href="<?php echo $module['link']['url']; ?>" target="<?php echo $module['link']['target']; ?>" class="o-btn o-btn--noarrow o-btn--orange"><?php echo $module['link']['title']; ?></a>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>