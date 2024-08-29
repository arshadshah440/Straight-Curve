<?php
$module = $args;
if (isset($module['title']) && $module['title']) :

$alt_layout = isset($module['layout']) && $module['layout'] === 'Image on right';
$background = isset($module['background']) && $module['background'] ? stripString($module['background']) : '';


$classes = '';
$classes .= $alt_layout ? ' alt-layout' : '';
$classes .= !$alt_layout && !isset($module['image']['url']) ? ' no-bg-img' : '';
$classes .= $background ? ' section-bg ' . $background : '';

?><div class="f-banner <?php echo $classes; ?>" id="<?php echo $module['module_id']; ?>">
	<div class="o-wrapper">
		<div class="f-banner__inner">
			<?php if (isset($module['icon']['url'])) : ?>
				<span class="f-banner__icon"><img loading="lazy" src="<?php echo $module['icon']['url']; ?>" alt="<?php echo $module['icon']['title']; ?>"></span>
			<?php endif; ?>

			<?php if ($module['label']) : ?>
				<span class="f-banner__label"><?php echo $module['label']; ?></span>
			<?php endif; ?>

			<?php if ($module['title']) : ?>
				<h1 class="f-banner__title"><?php echo $module['title']; ?></h1>
			<?php endif; ?>

			<?php if ($module['copy']) : ?>
				<div class="f-banner__copy"><?php echo $module['copy']; ?></div>
			<?php endif; ?>

			<?php if (isset($module['buttons'][0]['link']['url'])) : ?>
				<div class="f-banner__buttons">
					<?php foreach ($module['buttons'] as $item) :
						$btn_class = "o-btn--orange";
						if ($item['style'] === 'Green') {
							$btn_class = "o-btn--green";
						} elseif ($item['style'] === 'White') {
							$btn_class = "o-btn--white";
						} elseif ($item['style'] === 'White Outlined') {
							$btn_class = "o-btn--white o-btn--outline";
						}
						?>
						<a href="<?php echo $item['link']['url']; ?>" target="<?php echo $item['link']['target']; ?>" class="o-btn <?php echo $btn_class; ?>"><?php echo $item['link']['title']; ?></a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<?php
	if (isset($module['image']['url'])) :
		$img_wrap_start = '<div class="f-banner__image-wrap">';
		$img_wrap_end = '</div>';
		if ($alt_layout && $module['image_link']) {
			$img_wrap_start = '<a href="' . $module['image_link'] . '" class="f-banner__image-wrap is-link">';
			$img_wrap_end = '</a>';

		}
		echo $img_wrap_start;
		?><img class="f-banner__image" loading="lazy" src="<?php echo $module['image']['url'] ?>" alt="<?php echo $module['image']['title'] ?>"><?php
		echo $img_wrap_end;
	endif; ?>


</div>

<?php if (isset($module['icon_list'][0]['icon'])) : ?>
	<div class="f-banner__icon-list">
		<div class="f-banner__icon-list-wrap">
			<div class="o-layout o-layout--flush">
				<?php foreach ($module['icon_list'] as $item) : ?>
					<div class="o-layout__item f-banner__icon-list-item u-1/5@tablet u-1/3">
						<div class="f-banner__icon-list-item-inner">
							<?php if (isset($item['icon']['sizes']['preview'])) : ?>
								<img src="<?php echo $item['icon']['sizes']['preview']; ?>" alt="<?php echo $item['icon']['title']; ?>">
							<?php endif; ?>
							<?php if ($item['text']) : ?>
								<span><?php echo $item['text']; ?></span>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
<?php endif; ?>


<?php endif; ?>