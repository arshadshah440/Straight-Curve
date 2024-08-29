<?php get_header(); ?>

<div class="c-post">
    <main id="Main" class="c-main-content o-main" role="main">
        <?php if ( have_posts() ) while ( have_posts() ) : the_post() ; ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="c-cms-content o-wrapper">
                <h1><?php the_title(); ?></h1>
                <?php the_content(); ?>
                <?php get_template_part( 'partials/post-meta' ); ?>
            </div>
            <?php wp_link_pages(); ?>
        </article>
        <?php endwhile; ?>
    </main>
    <!-- <?php get_sidebar(); ?> -->
</div>

<?php get_footer(); ?>