<?php
$module = $args;

?><div class="c-landing__reviews" id="<?php echo $module['module_id']; ?>">
	<div class="o-wrapper o-wrapper--med">
		<?php if ($module['title']) : ?>
			<h2 class="h2-large"><?php echo $module['title']; ?></h2>
		<?php endif; ?>
		<div class="c-landing__reviews-wrap">
		</div>
		<?php if (isset($module['link']['url'])) : ?>
			<a href="<?php echo $module['link']['url']; ?>" target="<?php echo $module['link']['target']; ?>" class="o-btn o-btn--noarrow o-btn--orange"><?php echo $module['link']['title']; ?></a>
		<?php endif; ?>
	</div>
</div>