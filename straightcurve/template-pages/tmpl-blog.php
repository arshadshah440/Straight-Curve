<?php
/* Template Name: Blog */
get_header();

if ( have_posts() ) while ( have_posts() ) : the_post();

$brochure = get_field('brochure');
$fields = get_fields();
?><div class="c-blogs-page">
	<h1 hidden><?php the_title(); ?></h1>
	<?php get_template_part('partials/blog-filter'); ?>

	<div class="c-blogs-page__featured-blog">
		<div class="o-wrapper">
			<?php echo do_shortcode('[featured_blog_post]'); ?>
		</div>
	</div>

	<div class="c-blogs-page__popular-blogs">
		<div class="o-wrapper">
			<h2><?php echo $fields['blogs_title']; ?></h2>
			<?php echo do_shortcode('[popular_blog_posts]'); ?>
		</div>
	</div>


	<div class="c-blogs-page__brochure">
		<div class="o-wrapper">
			<div class="c-blogs-page__brochure-wrapper">
				<div class="c-blogs-page__brochure-content">
					<h2><?php echo $brochure['title']; ?></h2>
					<?php echo $brochure['copy']; ?>
					<?php if (isset($brochure['link']['url'])) : ?>
						<div class="downloadButton">
							<a href="<?php echo $brochure['link']['url']; ?>" target="<?php echo $brochure['link']['target']; ?>" class="o-btn"><?php echo $brochure['link']['title']; ?></a>
						</div>
					<?php endif; ?>
				</div>
				<div class="c-blogs-page__brochure-image">
					<img class="lazyload" src="<?php echo ASSETS; ?>/img/2x1.trans.gif" data-src="<?php echo $brochure['image']; ?>" alt="">
				</div>
			</div>
		</div>
	</div>

	<div class="c-blogs-page__recent-blogs">
		<div class="o-wrapper">
			<h2><?php echo $fields['recent_blogs_title']; ?></h2>
			<?php echo do_shortcode('[recent_blog_posts]'); ?>
		</div>
	</div>

</div>


<?php endwhile;
 get_footer(); ?>