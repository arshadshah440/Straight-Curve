<?php
$module = $args;

if (isset($module['testimonial'][0]['quote'])) :
?><div class="f-testimonials" id="<?php echo $module['module_id']; ?>">
	<div class="o-wrapper">
		<?php if ($module['intro']) : ?>
			<div class="f-testimonials__intro">
				<?php echo $module['intro']; ?>
			</div>
		<?php endif; ?>
		<div class="c-testimonials">
			<?php foreach ($module['testimonial'] as $item) : ?>
				<div class="c-testimonial lazyload" data-src="<?php echo $item['image']['url']; ?>">
					<div class="c-testimonial__media lazyload" data-src="<?php echo $item['image']['url']; ?>">
						<a class="js-testimonial-video" data-fancybox href="<?php echo $item['video_link']; ?>" role="button"><i class="fas fa-play"></i></a>
					</div>
					<div class="c-testimonial__content">
						<div class="c-testimonial__content-top">
							<div class="c-testimonial__quote">"<?php echo $item['quote']; ?>"</div>
							<div class="c-testimonial__quote-by">
								<span><?php echo $item['by_name']; ?></span>
								<img src="<?php echo ASSETS; ?>/img/2x1.trans.gif" data-src="<?php echo $item['company_logo']['url']; ?>" alt="<?php echo $item['by_company']; ?>" class="logo lazyload" />
							</div>
						</div>
						<div class="c-testimonial__company-logo">
							<img src="<?php echo ASSETS; ?>/img/2x1.trans.gif" data-src="<?php echo $item['company_logo']['url']; ?>" alt="<?php echo $item['by_company']; ?>" class="logo lazyload" />
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?php endif; ?>