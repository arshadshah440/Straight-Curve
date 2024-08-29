<div class="o-wrapper">
	<div class="c-prouserpromo c-prouserpromo--flex-cta"  id="<?php echo $module['module_id']; ?>">
		<div class="c-prouserpromo__container <?php echo (isset($args['icon']['url']) ? 'has-icon' : ''); ?>">
			<?php if (isset($args['icon']['url'])) : ?>
				<img loading="lazy" src="<?php echo $args['icon']['url']; ?>" alt="<?php echo $args['icon']['title']; ?>">
			<?php endif; ?>
			<div class="c-prouserpromo__content">
				<h3><?php echo $args['title']; ?></h3>
				<p><?php echo $args['copy']; ?></p>
			</div>
			<?php if (isset($args['link']['url'])) : ?>
				<a href="<?php echo $args['link']['url']; ?>" target="<?php echo $args['link']['target']; ?>" class="o-btn o-btn--orange"><?php echo $args['link']['title']; ?></a>
			<?php endif; ?>
		</div>
	</div>
</div>