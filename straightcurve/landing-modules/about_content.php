<?php
$module = $args;

?><div class="c-landing__about" id="<?php echo $module['module_id']; ?>">
	<div class="o-wrapper o-wrapper--med">
		<?php if ($module['title']) : ?>
			<h2 class="h2-large"><?php echo $module['title']; ?></h2>
			<div class="c-landing__about-content">
				<?php if ($module['left_content']['copy']) : ?>
					<div class="c-landing__about-content-left">
						<?php if (isset($module['left_content']['icon']['url'])) : ?>
							<img class="lazyload" src="<?php echo ASSETS; ?>/img/1x1.trans.gif" data-src="<?php echo $module['left_content']['icon']['url']; ?>" alt="<?php echo $module['left_content']['icon']['title']; ?>">
						<?php endif; ?>
						<?php if ($module['left_content']['title']) : ?>
							<h4><?php echo $module['left_content']['title']; ?></h4>
						<?php endif; ?>
						<?php if ($module['left_content']['copy']) : ?>
							<div><?php echo $module['left_content']['copy']; ?></div>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php if (isset($module['image']['url'])) : ?>
					<div class="c-landing__about-content-middle">
						<img class="lazyload" src="<?php echo ASSETS; ?>/img/1x1.trans.gif" data-src="<?php echo $module['image']['url']; ?>" alt="<?php echo $module['image']['title']; ?>">
					</div>
				<?php endif; ?>

				<?php if ($module['right_content']['copy']) : ?>
					<div class="c-landing__about-content-right">
						<?php if (isset($module['right_content']['icon']['url'])) : ?>
							<img class="lazyload" src="<?php echo ASSETS; ?>/img/1x1.trans.gif" data-src="<?php echo $module['right_content']['icon']['url']; ?>" alt="<?php echo $module['right_content']['icon']['title']; ?>">
						<?php endif; ?>
						<?php if ($module['right_content']['title']) : ?>
							<h4><?php echo $module['right_content']['title']; ?></h4>
						<?php endif; ?>
						<?php if ($module['right_content']['copy']) : ?>
							<div><?php echo $module['right_content']['copy']; ?></div>
						<?php endif; ?>
					</div>
				<?php endif; ?>

			</div>
		<?php endif; ?>
	</div>
</div>