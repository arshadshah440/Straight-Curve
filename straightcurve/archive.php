<?php get_header(); ?>

<div class="o-wrapper">
	<div class="o-layout">
		<main id="Main" class="c-main-content o-main o-layout__item" role="main">
			<article <?php post_class(); ?>>
				<h1><?php the_archive_title(); ?></h1>
				<div class="c-cms-content">
					<?php get_template_part( 'loop', 'row' ); ?>
				</div>
			</article>
		</main>
	<!-- <?php get_sidebar(); ?> -->
	</div>
</div>

<?php get_footer(); ?>