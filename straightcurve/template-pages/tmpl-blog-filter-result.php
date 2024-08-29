<?php
/* Template Name: Blog Filter Result */
get_header();

if ( have_posts() ) while ( have_posts() ) : the_post();
$fields = get_fields();
?><div class="c-blogs-page">
	<?php get_template_part('partials/blog-filter'); ?>

	<div class="c-blogs-page__results">
		<div class="o-wrapper">
			<h2><?php echo $fields['results_title']; ?></h2>
			<div class="c-recent-blogs">
				<?php echo do_shortcode('[blog_post_search_results]'); ?>
			</div>
		</div>
	</div>

</div>


<?php endwhile;
get_footer(); ?>