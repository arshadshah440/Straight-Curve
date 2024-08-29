<?php
$module = $args;

?><div class="f-content" id="<?php echo $module['module_id']; ?>">
	<div class="o-wrapper o-wrapper--xsmall">
		<?php if ($module['title']) : ?>
			<h2 class="h2-med"><?php echo $module['title']; ?></h2>
		<?php endif; ?>
		<div class="f-content__content">
			<?php echo $module['content']; ?>
		</div>
	</div>
</div>