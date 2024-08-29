<?php
/*
 * Template Name: Favourites Page
 */

get_header();

if ( have_posts() ) while ( have_posts() ) : the_post();
$thumb = get_the_post_thumbnail_url(get_the_ID(), 'full');

?><div class="c-account">
	<div class="c-account__stage" style="background-image: url(<?php echo $thumb ?>)">
		<div class="o-wrapper">
			<h1 class="c-account__title"><?php the_title() ?></h1>
		</div>
	</div>
	<div class="c-account__container">
		<div class="o-wrapper">
			<div class="c-account__intro">
				<?php the_content() ?>
			</div>

			<div class="o-layout o-module" id="js-get-fav-products">
				<span class="c-loader">Loading...</span>
			</div>
		</div>
	</div>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>