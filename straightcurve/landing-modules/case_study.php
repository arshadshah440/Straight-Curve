<?php
$module = $args;

if (isset($module['case_studies'][0]['image']['url'])) : ?>
	<div class="c-landing__casestudy c-casestudy" id="<?php echo $module['module_id']; ?>">
		<div class="o-wrapper o-wrapper--med">
			<?php if ($module['title']) : ?>
				<h2 class="h2-large"><?php echo $module['title']; ?></h2>
			<?php endif; ?>
			<div class="c-casestudy__slider js-casestudy-slider">
				<?php foreach ($module['case_studies'] as $item) : ?>
					<div class="c-casestudy__slide">
						<div class="c-casestudy__inner">
							<?php if (isset($item['image']['url'])) : ?>
								<div class="c-casestudy__image">
									<img src="<?php echo $item['image']['url']; ?>" alt="<?php echo $item['image']['title']; ?>">
								</div>
							<?php endif; ?>
							<div class="c-casestudy__content">
								<h3><?php echo $item['title']; ?></h3>
								<div><?php echo $item['copy']; ?></div>
								<?php if (isset($item['link']['url'])) : ?>
									<a href="<?php echo $item['link']['url']; ?>" target="<?php echo $item['link']['target']; ?>" class="o-btn o-btn--noarrow o-btn--orange"><?php echo $item['link']['title']; ?></a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
<?php endif; ?>