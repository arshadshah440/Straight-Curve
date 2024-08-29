<?php
$module = $args;

?><div class="c-landing__accordion" id="<?php echo $module['module_id']; ?>">
	<div class="o-wrapper o-wrapper--med">
		<?php if ($module['title']) : ?>
			<h2 class="h2-large"><?php echo $module['title']; ?></h2>
		<?php endif; ?>
		<?php if ($module['content']) : ?>
			<div class="c-landing__accordion-content"><?php echo $module['content']; ?></div>
		<?php endif; ?>
		<div class="c-accordian">
			<?php foreach ($module['accordion'] as $item) : ?>
				<div class="c-accordian__item">
					<a href="javascript:void(0);" class="c-accordian__item-title"><h3><?php echo $item['title']; ?></h3></a>
					<div class="c-accordian__item-copy"><?php echo $item['content']; ?></div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>

