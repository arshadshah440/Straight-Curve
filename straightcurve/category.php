<?php get_header(); ?>

<div class="o-wrapper">
    <div class="o-layout">
        <main id="Main" class="c-main-content o-main o-layout__item " role="main">
            <article <?php post_class(); ?>>
                <h1 class="pt-2">Category: <?php single_cat_title(); ?></h1>
                <div class="c-cms-content">
                    <div class="c-cat-posts">
                        <?php while ( have_posts() ) : the_post(); ?>
							<?php echo blog_post_gallery_item(get_the_ID()) ?>
                        <?php endwhile; ?>
                    </div>
                </div>
            </article>
        </main>
    </div>
</div>

<?php get_footer(); ?>