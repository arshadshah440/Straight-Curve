<?php
/**
 * The Template for displaying all single posts
 */
get_header(); ?>

<?php $gc = get_field('general_content', 'options'); ?>

<div class="c-blog-single">
    <div class="o-wrapper">
        <div class="o-layout">
            <div class="o-layout__item o-island u-3/4@tabletWide blogLeft">
                <div class="postThumbnail"><?php the_post_thumbnail(); ?></div>
                <h1><?php the_title(); ?></h1>
                <div class="blogContent">
                    <?php the_content(); ?>
					<div class="c-share-buttons">
						<h2><?php echo $gc['blog_share_title'] ? $gc['blog_share_title'] : 'Enjoy? Share with friends'; ?></h2>
						<div class="c-share-buttons__wrap">
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_the_permalink(); ?>" target="_blank" class="c-share-button facebook"><i class="fab fa-facebook" aria-hidden="true"></i> Facebook</a>
							<a href="https://twitter.com/intent/tweet?url=<?php echo get_the_permalink(); ?>&text=<?php the_title() ?>" target="_blank" class="c-share-button twitter"><i class="fab fa-twitter" aria-hidden="true"></i> Twitter</a>
							<a href="https://plus.google.com/share?url=<?php echo get_the_permalink(); ?>" target="_blank" class="c-share-button google-plus"><i class="fab fa-google-plus-g" aria-hidden="true"></i> Google+</a>
							<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_the_permalink(); ?>" target="_blank" class="c-share-button linkedin"><i class="fab fa-linkedin" aria-hidden="true"></i> LinkedIn</a>
							<a href="https://pinterest.com/pin/create/button/?url=<?php echo get_the_permalink(); ?>&media=&description=<?php the_title() ?>" target="_blank" class="c-share-button pinterest"><i class="fab fa-pinterest" aria-hidden="true"></i> Pinterest</a>
						</div>
					</div>
				</div>
            </div>
            <div class="o-layout__item o-island u-1/4@tabletWide blogRight">
                <div class="sidebarBlocks">
                    <h3 class="title"><?php echo $gc['blog_latest_title'] ? $gc['blog_latest_title'] : 'Latest Posts'; ?></h3>
                    <div class="sidebarLatestPosts">
                        <ul>
                            <?php $args = array( 'post_type' => 'post', 'posts_per_page' => 5 );
                            $the_query = new WP_Query( $args );
                            if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                            <li>
                                <span class="img">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'thumbnail' ); ?>
                                    </a>
                                </span>
                                <span class="txt">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    <small><?php echo get_the_date(); ?></small>
                                </span>
                            </li>
                            <?php endwhile; endif; wp_reset_postdata(); ?>
                        </ul>
                    </div>
                </div>
                <div class="sidebarBlocks catLists">
                    <h3 class="title"><?php echo $gc['blog_categories_title'] ? $gc['blog_categories_title'] : 'Categories'; ?></h3>
                    <ul>
                        <?php wp_list_categories( array(
                            'title_li' => '',
                            'hide_empty' => true,
                            'taxonomy' => 'category',
                            'exclude' => array( 1 ),
                        ) ); ?>
                    </ul>
                </div>

                <?php /*
                <div class="sidebarBlocks catLists tagLists">
                    <h3 class="title"><?php echo $gc['blog_tags_title'] ? $gc['blog_tags_title'] : 'Tags'; ?></h3>
                    <ul>
                        <?php
                            $tags = get_tags(array(
                            'taxonomy' => 'post_tag',
                            'orderby' => 'name',
                            'hide_empty' => false // for development
                            ));
                        ?>
                </ul>
            </div>
            */?>
        </div>
    </div>
</div>
</div>

<?php get_footer(); ?>