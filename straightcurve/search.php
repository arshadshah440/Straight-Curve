<?php get_header(); ?>

<div class="c-search">
	<main id="Main" class="c-main-content o-main" role="main">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="c-cms-content c-search-content o-wrapper">
				<h1><?php printf( __( 'Search results for: "%s"'), get_search_query() ); ?></h1>
				<?php if ( have_posts() ) : ?>
					<?php get_template_part( 'loop', 'row' ); ?>
				<?php else : ?>
					<p>No search results found.</p>
				<?php endif; ?>
			</div>
		</article>
	</main>
	<!-- <?php get_sidebar(); ?> -->
</div>

<?php get_footer(); ?>