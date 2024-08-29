<?php

?><div class="f-posts-module" id="<?php echo $module['module_id']; ?>">
	<div class="o-wrapper">
		<?php if ($args['intro']) : ?>
			<div class="f-posts-module__intro">
				<?php echo $args['intro']; ?>
			</div>
		<?php endif; ?>
		<?php echo do_shortcode('[recent_blog_posts]'); ?>
	</div>
</div>