<?php
/*
 * Template Name: Home Page
 */

get_header();

if ( have_posts() ) while ( have_posts() ) : the_post();
$gc = get_field('general_content', 'options');
$thumb = get_the_post_thumbnail_url(get_the_ID(), 'full');
$fields = get_fields();
$stage = get_field('stage');
$solutions_title = get_field('solutions_title');
$about_info = get_field('about_info');
$cta_bar = get_field('cta_bar');
$guarantee = get_field('guarantee');
$testimonial = get_field('testimonial');
$full_cta = get_field('full_cta');
$blogs_title = get_field('blogs_title');

$has_bottom_content = false;
if ($fields['bottom_content']['intro_copy'] || ($fields['bottom_content']['accordian'] && count($fields['bottom_content']['accordian']) > 0)) {
	$has_bottom_content = true;
}

?>
<div class="c-home">
	<?php if (current_site() === 'uk') : ?>
		<!-- <img class="c-home__new-badge" src="<?php echo ASSETS; ?>/img/new-UK-1.png" alt="New in the UK"> -->
	<?php endif; ?>

	<?php
		$alt_style = false;
		if (current_site() === 'uk' || current_site() === 'au' || current_site() === 'nl' || (current_site() === 'us' && !is_live())) {
			$alt_style = true;
		}
	?><div class="c-home__banner <?php echo ($alt_style ? 'alt-style' : ''); ?>">
		<div class="o-wrapper">
			<div class="c-home__banner-content animate fadeIn">
				<h1 class="c-home__banner-title"><?php echo $stage['title']; ?></h1>
				<div class="c-home__banner-image">
					<?php if (isset($gc['inspiring_creativity']['url'])) : ?>
						<img src="<?php echo ASSETS; ?>/img/2x1.trans.gif" data-src="<?php echo $gc['inspiring_creativity']['url']; ?>" class="attachment-full size-full lazyload" alt="<?php echo $gc['inspiring_creativity']['title']; ?>">
					<?php endif; ?>
				</div>
				<div class="c-home__banner-buttons">
					<?php foreach ($stage['buttons'] as $item) :
						$url = $item['button']['url'];
						$is_overlay = false;
						$class = '';
						if ($item['hide_on_desktop']) {
							$class .= ' hide-on-desk';
						} elseif ($alt_style && $item['button']['title'] === 'For Home Gardeners') {
							$class .= ' o-btn--white';
						} elseif ($alt_style) {
							$class .= ' o-btn--orange';
						} else {
							$class .= ' o-btn--white o-btn--outline';
						}
						if (strpos($url, 'youtube') !== false) {
							$is_overlay = true;
						}
						?>
						<a href="<?php echo $url; ?>" class="o-btn <?php echo $class; ?>" <?php echo ($is_overlay ? 'data-fancybox=""' : ''); ?>><?php echo $item['button']['title']; ?></a>
					<?php endforeach; ?>
					<?php if (current_site() === 'uk') : ?>
						<br><a href="<?php echo SITE; ?>/solutions/" class="o-btn o-btn--green c-home__banner-shopbtn"><i class="fal fa-shopping-cart" aria-hidden="true"></i> Explore our Products!</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="c-home__banner-video">
			<video id="video-element" poster="<?php echo $stage['video_poster']['url']; ?>" loop="" muted="" playsinline>
				<source src="<?php echo $stage['video']['url']; ?>" type="video/mp4">
				Sorry, your browser doesn't support embedded videos.
			</video>
			<div id="controls">
				<a id="playBtn" class="is-pause" title="play video" href="javascript:void(0);"><?php
					svgicon('play', '0 0 448 512');
					svgicon('pause', '0 0 448 512');
				?></a>
			</div>
		</div>
	</div>
	<div id="Main"></div>
	<div class="c-home__solutions">
		<div class="o-wrapper">
			<div class="c-home__solutions-intro <?php echo (current_site() === 'uk' ? 'new-badge' : ''); ?>">
				<?php if ($solutions_title) : ?>
					<h2 class="c-home__solutions-title"><?php echo $solutions_title; ?></h2>
				<?php endif; ?>
				<?php if ($fields['solutions_content']) : ?>
					<div class="c-home__solutions-content"><?php echo $fields['solutions_content']; ?></div>
				<?php endif; ?>
			</div>
			<div class="o-layout o-layout--large">
				<?php get_template_part('partials/solution_main_cats'); ?>
			</div>
		</div>
	</div>


	<?php if (current_site() === 'uk') : ?>
		<div class="o-wrapper"><?php get_template_part('partials/pro-user-promo') ?></div>
	<?php endif; ?>



	<?php if ($has_bottom_content) : ?>
		<div class="c-home__bottom-content">
			<div class="o-wrapper o-wrapper--small">
				<?php if ($fields['bottom_content']['intro_title']) : ?>
					<h2 class="c-home__bottom-content-intro-title"><?php echo $fields['bottom_content']['intro_title']; ?></h2>
				<?php endif; ?>
				<?php if ($fields['bottom_content']['intro_copy']) : ?>
					<div class="c-home__bottom-content-intro-copy"><?php echo $fields['bottom_content']['intro_copy']; ?></div>
				<?php endif; ?>
				<?php if ($fields['bottom_content']['accordian'] && count($fields['bottom_content']['accordian']) > 0) : ?>
					<div class="c-accordian">
						<?php foreach ($fields['bottom_content']['accordian'] as $item) : ?>
							<div class="c-accordian__item">
								<a href="javascript:void(0);" class="c-accordian__item-title"><h3><?php echo $item['title']; ?></h3></a>
								<div class="c-accordian__item-copy"><?php echo $item['copy']; ?></div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>

	<div class="c-home__about">
		<div class="o-wrapper">
			<span class="c-home__about-tagline"><?php echo $about_info['tagline']; ?></span>
			<h2 class="c-home__about-title"><?php echo $about_info['title']; ?></h2>
			<div class="c-home__about-content"><?php echo $about_info['content']; ?></div>
		</div>
	</div>

	<div class="c-home__cta">
		<div class="o-wrapper">
			<div class="c-home__cta-inner">
				<h2><?php echo $cta_bar['title']; ?></h2>
				<?php if (isset($cta_bar['button']['url'])) : ?>
					<a href="<?php echo $cta_bar['button']['url']; ?>" class="o-btn o-btn--orange"><?php echo $cta_bar['button']['title']; ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<?php if ($guarantee['guarantee'] && count($guarantee['guarantee']) > 0) : ?>
		<div class="c-home__guarantees">
			<div class="o-wrapper">
				<h2 class="c-home__guarantees-title"><?php echo $guarantee['title']; ?></h2>
				<?php foreach ($guarantee['guarantee'] as $item) :
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

	<div class="c-home__testimonials">
		<div class="o-wrapper">
			<div class="c-testimonials">
				<?php foreach ($testimonial as $item) : ?>
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

	<div class="c-home__full-cta lazyload" data-src="<?php echo $full_cta['image']['url'] ?>">
		<div class="o-wrapper">
			<h2 class="c-home__full-cta-title"><?php echo $full_cta['title']; ?></h2>
			<p class="c-home__full-cta-copy"><?php echo $full_cta['copy']; ?></p>
			<?php if (isset($full_cta['button']['url'])) : ?>
				<a href="<?php echo $full_cta['button']['url']; ?>" class="o-btn o-btn--orange"><?php echo $full_cta['button']['title']; ?></a>
			<?php endif; ?>
		</div>
	</div>

	<div class="c-home__blogs">
		<div class="o-wrapper">
			<h2 class="c-home__blogs-title"><?php echo $blogs_title; ?></h2>
			<?php echo do_shortcode('[recent_blog_posts]'); ?>
		</div>
	</div>

</div>

<?php endwhile; ?>
<?php get_footer(); ?>