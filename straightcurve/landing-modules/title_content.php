<?php if (isset($args['content']) && $args['content']) : ?>
<div class="f-title-content" id="<?php echo $args['module_id']; ?>">
	<div class="o-wrapper">
		<div class="o-layout">
			<div class="o-layout__item u-1/2@tablet">
				<?php if ($args['title_label']) : ?>
					<span class="f-title-content__label"><?php echo $args['title_label']; ?></span>
				<?php endif; ?>
				<h2 class="f-title-content__title"><?php echo $args['title']; ?></h2>
			</div>
			<div class="o-layout__item u-1/2@tablet">
				<?php if ($args['content_label']) : ?>
					<span class="f-title-content__label"><?php echo $args['content_label']; ?></span>
				<?php endif; ?>
				<div class="f-title-content__content"><?php echo $args['content']; ?></div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>