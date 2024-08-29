<?php get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post() ;
	$page_login_lock = get_field('page_login_lock');

	$show_content = true;
	if (isset($page_login_lock['can_access'][0])) {
		$show_content = false;
		foreach ($page_login_lock['can_access'] as $key => $value) {
			if ($value === 'Pro User' && is_pro_user()) {
				$show_content = true;
			} elseif ($value === 'Dealer User' && is_dealer_user()) {
				$show_content = true;
			}
		}
	}
?>

<div class="c-default">
    <main id="Main" class="c-main-content o-main" role="main">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="c-cms-content o-wrapper">
				<?php if ($show_content) : ?>
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
				<?php else : ?>
					<div class="c-default__lockmessage">
						<?php if (isset($page_login_lock['message']) && $page_login_lock['message']) : ?>
							<?php echo $page_login_lock['message']; ?>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
        </article>
    </main>
</div>

<?php endwhile; ?>
<?php get_footer(); ?>