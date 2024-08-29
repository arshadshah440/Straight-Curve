<?php
/*
 * Template Name: Professional / DIY
 */

get_header();


if ( have_posts() ) while ( have_posts() ) : the_post() ;

$fields = get_fields();
$thumb = get_the_post_thumbnail_url();
$page_type = '';
if (isset($fields['page_type']) && $fields['page_type']) {
	$page_type = $fields['page_type'];
}

?><article id="post-<?php the_ID(); ?>" <?php post_class('c-pro-diy'); ?>>


	<div class="c-pro-diy__banner <?php echo (current_site() === 'uk' && $page_type === 'Professionals' ? 'alt-style' : ''); ?>">
		<div class="o-wrapper">
			<div class="c-pro-diy__banner-content animate fadeIn">
				<div class="c-pro-diy__banner-image">
					<?php if (isset($fields['banner']['script_image']['url'])) : ?>
						<img src="<?php echo ASSETS; ?>/img/2x1.trans.gif" data-src="<?php echo $fields['banner']['script_image']['url']; ?>" class="attachment-full size-full lazyload" alt="<?php echo $fields['banner']['script_image']['title']; ?>">
					<?php endif; ?>
				</div>
				<h1 class="c-pro-diy__banner-title"><?php the_title(); ?></h1>
				<?php if (isset($fields['banner']['buttons']) && count($fields['banner']['buttons']) > 0) : ?>
					<div class="c-pro-diy__banner-buttons">
						<?php foreach ($fields['banner']['buttons'] as $key => $item) :
							$class = "o-btn--orange o-btn--outline";
							if ($key === 0) {
								$class = "o-btn--white";
							} elseif ($key === 1) {
								$class = "o-btn--orange";
							}
							?>
							<a href="<?php echo $item['button']['url']; ?>" class="o-btn <?php echo $class; ?>" target="<?php echo $item['button']['target']; ?>"><?php echo $item['button']['title']; ?></a>
							<?php if (!(current_site() === 'uk' && $page_type === 'Professionals')) : ?>
								<br>
							<?php endif; ?>
						<?php endforeach; ?>
						<?php if (isset($fields['page_type']) && $fields['page_type'] === 'Professionals') : ?>
							<a href="#register-for-pro" class="o-btn" target="">Register for a PRO Account</a>
						<?php endif; ?>
						<?php if (isset($fields['page_type']) && $fields['page_type'] === 'Dealer') : ?>
							<a href="#register-for-dealer" class="o-btn" target="">Become an authorised DEALER</a>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php if ($post->post_content) : ?>
					<div class="c-pro-diy__banner-copy">
						<?php the_content() ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php if (isset($fields['featured_image_link']['url'])) : ?>
			<a class="c-pro-diy__banner-rightimage is-link" href="<?php echo $fields['featured_image_link']['url']; ?>" target="<?php echo $fields['featured_image_link']['target']; ?>" style="background-image: url(<?php echo $thumb; ?>)"></a>
		<?php else : ?>
			<div class="c-pro-diy__banner-rightimage" style="background-image: url(<?php echo $thumb; ?>)"></div>
		<?php endif; ?>
	</div>



	<main id="Main" class="c-main-content o-main" role="main">



		<div class="c-pro-diy__your_question">
			<div class="o-wrapper">
				<div class="o-layout">
					<div class="o-layout__item u-1/2@tablet">
						<span class="c-pro-diy__your_question-label"><?php echo $fields['your_question']['question_label']; ?></span>
						<h2 class="c-pro-diy__your_question-title"><?php echo $fields['your_question']['question']; ?></h2>
					</div>
					<div class="o-layout__item u-1/2@tablet">
						<span class="c-pro-diy__your_question-label"><?php echo $fields['your_question']['answer_label']; ?></span>
						<div class="c-pro-diy__your_question-content"><?php echo $fields['your_question']['answer']; ?></div>
					</div>
				</div>
			</div>
		</div>



		<?php if (isset($fields['page_type']) && $fields['page_type'] === 'Professionals') : ?>
			<div class="o-wrapper"><?php get_template_part('partials/pro-user-promo') ?></div>
		<?php endif; ?>
		<?php if (isset($fields['page_type']) && $fields['page_type'] === 'Dealer') : ?>
			<div class="o-wrapper"><?php get_template_part('partials/dealer-user-promo') ?></div>
		<?php endif; ?>



		<?php if (isset($fields['info_tiles']) && count($fields['info_tiles']) > 0) : ?>
			<div class="c-pro-diy__info_tiles">
				<div class="o-wrapper">
					<div class="o-layout o-module">
						<?php foreach ($fields['info_tiles'] as $key => $item) : ?>
							<div class="o-layout__item o-module__item <?php echo ($key === 0 || $key === 1 ? 'u-1/2@tabletWide' : 'u-1/3@tabletWide'); ?> u-1/2@mobileLandscape">
								<a href="<?php echo $item['link']['url']; ?>" target="<?php echo $item['link']['target']; ?>" class="c-pro-diy__info_tile">
									<?php if (isset($item['icon']['url'])) : ?>
										<img class="c-pro-diy__info_tile-icon" src="<?php echo ASSETS; ?>/img/1x1.trans.gif" data-src="<?php echo $item['icon']['url']; ?>" alt="<?php echo $item['icon']['title']; ?>">
									<?php endif; ?>
									<h3 class="c-pro-diy__info_tile-title"><?php echo $item['title']; ?></h3>
									<p class="c-pro-diy__info_tile-copy"><?php echo $item['copy']; ?></p>
									<?php if (isset($item['link']['url']) && $item['link']['url']) : ?>
										<span class="c-pro-diy__info_tile-link"><?php echo $item['link']['title']; ?></span>
									<?php endif; ?>
								</a>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>




		<div class="c-pro-diy__brochure" id="brochure">
			<div class="o-wrapper">
				<div class="c-pro-diy__brochure-wrap">
					<div class="c-pro-diy__brochure-image">
						<img class="lazyload" src="<?php echo ASSETS; ?>/img/2x1.trans.gif" data-src="<?php echo $fields['brochure']['image']['url']; ?>" alt="<?php echo $fields['brochure']['image']['title']; ?>">
					</div>
					<div class="c-pro-diy__brochure-content">
						<h2 class="c-pro-diy__brochure-title"><?php echo $fields['brochure']['title']; ?></h2>
						<div class="c-pro-diy__brochure-copy"><?php echo $fields['brochure']['copy']; ?></div>
						<?php if (isset($fields['brochure']['link']['url'])) : ?>
							<div class="c-pro-diy__brochure-link">
								<a href="<?php echo $fields['brochure']['link']['url']; ?>" target="<?php echo $fields['brochure']['link']['target']; ?>" class="o-btn"><?php echo $fields['brochure']['link']['title']; ?></a>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>




		<?php if ($fields['benefits']['accordion'] && count($fields['benefits']['accordion']) > 0) : ?>
			<div class="c-pro-diy__benefits" id="benefits">
				<div class="o-wrapper o-wrapper--small">
					<div class="c-pro-diy__benefits-intro">
						<h2 class="c-pro-diy__benefits-title"><?php echo $fields['benefits']['intro_title']; ?></h2>
						<div class="c-pro-diy__benefits-copy"><?php echo $fields['benefits']['intro_copy']; ?></div>
					</div>
					<div class="c-accordian">
						<?php foreach ($fields['benefits']['accordion'] as $item) : ?>
							<div class="c-accordian__item">
								<a href="javascript:void(0);" class="c-accordian__item-title"><h3><?php echo $item['title']; ?></h3></a>
								<div class="c-accordian__item-copy"><?php echo $item['content']; ?></div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>





		<?php if ($fields['solutions']['options'] && count($fields['solutions']['options']) > 0) : ?>
			<div class="c-pro-diy__solutions" id="solutions">
				<div class="o-wrapper">
					<div class="c-pro-diy__solutions-intro">
						<h2 class="c-pro-diy__solutions-title"><?php echo $fields['solutions']['intro_title']; ?></h2>
						<div class="c-pro-diy__solutions-copy"><?php echo $fields['solutions']['intro_copy']; ?></div>
					</div>
					<div class="c-solutions__cats">
						<div class="o-layout">
							<?php foreach ($fields['solutions']['options'] as $item) : ?>
								<div class="c-cat-tile o-layout__item u-1/3@tabletWide u-1/2@mobileLandscape">
									<a href="<?php echo $item['link']['url']; ?>" target="<?php echo $item['link']['target']; ?>" class="c-cat-tile__inner is-link lazyload" style="background-image: url(<?php echo $item['image']['url']; ?>);">
										<div class="c-cat-tile__content">
											<h3><?php echo $item['title']; ?></h3>
											<span class="o-btn o-btn--orange"><?php echo $item['link']['title']; ?></span>
										</div>
									</a>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>


		<?php if (isset($fields['image_content']['content']) && $fields['image_content']['content'] && count($fields['image_content']['content']) > 0) : ?>
			<div class="c-home__guarantees">
				<div class="o-wrapper">
					<?php if ($fields['image_content']['title']) : ?>
						<h2 class="c-home__guarantees-title"><?php echo $fields['image_content']['title']; ?></h2>
					<?php endif; ?>
					<?php foreach ($fields['image_content']['content'] as $item) :
						if ($item['copy'] && strlen($item['copy']) > 5) : ?>
						<?php if ($item['link']) : ?>
							<a class="c-home__guarantees-guarantee is-link" href="<?php echo $item['link']; ?>">
						<?php else : ?>
							<span class="c-home__guarantees-guarantee">
						<?php endif; ?>
							<img class="lazyload" src="<?php echo ASSETS; ?>/img/1x1.trans.gif" data-src="<?php echo $item['image']['url']; ?>" alt="">
							<p><?php echo $item['copy']; ?></p>
						<?php if ($item['link']) : ?>
							</a>
						<?php else : ?>
							</span>
						<?php endif; ?>
						<?php endif;
					endforeach; ?>
				</div>
			</div>
		<?php endif; ?>


		<?php if ($fields['testimonials']['testimonials'] && count($fields['testimonials']['testimonials']) > 0) : ?>
			<div class="c-pro-diy__testimonials" id="testimonials">
				<div class="o-wrapper">
					<div class="c-pro-diy__testimonials-intro">
						<h2 class="c-pro-diy__testimonials-title"><?php echo $fields['testimonials']['intro_title']; ?></h2>
						<div class="c-pro-diy__testimonials-copy"><?php echo $fields['testimonials']['intro_copy']; ?></div>
					</div>
					<div class="c-testimonials">
						<?php foreach ($fields['testimonials']['testimonials'] as $item) : ?>
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



	</main>

</article><?php endwhile; ?>

<?php get_footer(); ?>