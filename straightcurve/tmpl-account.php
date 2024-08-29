<?php
/*
 * Template Name: Account Page
 */

get_header();

if ( have_posts() ) while ( have_posts() ) : the_post();
$thumb = get_the_post_thumbnail_url(get_the_ID(), 'full');

?><div class="c-account">
	<div class="c-account__stage" style="background-image: url(<?php echo $thumb ?>)">
		<div class="o-wrapper">
			<?php
				$title = 'My Account';
				if ( is_pro_user() ) {
					$title = 'My PRO Account';
				}
			?>
			<h1 class="c-account__title"><?php echo $title ?></h1>
		</div>
	</div>
	<?php if (function_exists('is_user_logged_in') && is_user_logged_in()) : ?>
		<div class="c-account__name">
			<div class="o-wrapper">
				<p><?php printf(
					wp_kses( __( 'Hello %1$s (not %1$s? <a href="%2$s">Log out</a>)', 'woocommerce' ), $allowed_html ),
					esc_html( $current_user->display_name ),
					esc_url( wc_logout_url() )
				); ?></p>
			</div>
		</div>
	<?php endif; ?>
	<div class="c-account__container">
		<div class="o-wrapper">
			<?php if (function_exists('is_user_logged_in') && is_user_logged_in()) : ?>
				<div class="c-account__intro">
					<?php if (is_pro_user()) : ?>
						<?php if (current_site() === 'uk') : ?>
							<p>Welcome to your Straightcurve PRO Account. Trade pricing in the webshop is shown including VAT. All accessories and retail products (box sets) will have a 10% discount applied at checkout. From your account dashboard you can view your <a href="/<?php echo current_site(); ?>/my-account/orders/">recent orders</a>, manage your <a href="/<?php echo current_site(); ?>/my-account/edit-address/">shipping and billing addresses</a>, and&nbsp;<a href="/<?php echo current_site(); ?>/my-account/edit-account/">edit your password and account details</a>.</p>
						<?php else : ?>
							<p>Welcome to your Straightcurve PRO Account. From your account dashboard you can view your <a href="/<?php echo current_site(); ?>/my-account/orders/">recent orders</a>, manage your <a href="/<?php echo current_site(); ?>/my-account/edit-address/">shipping and billing addresses</a>, and&nbsp;<a href="/<?php echo current_site(); ?>/my-account/edit-account/">edit your password and account details</a>.</p>
						<?php endif; ?>
					<?php else : ?>
						<p>From your account dashboard you can view your <a href="/<?php echo current_site(); ?>/my-account/orders/">recent orders</a>, manage your <a href="/<?php echo current_site(); ?>/my-account/edit-address/">shipping and billing addresses</a>, and&nbsp;<a href="/<?php echo current_site(); ?>/my-account/edit-account/">edit your password and account details</a>.</p>
					<?php endif; ?>
					<?php the_content() ?>
				</div>
			<?php endif; ?>
			<div class="c-account__content">
				<?php if (!is_user_logged_in() && $_GET['err'] && $_GET['err'] === 'fav') : ?>
					<div class="woocommerce-notices-wrapper">
						<ul class="woocommerce-error" role="alert">
							<li><strong>Error:</strong> Login to favourite products.</li>
						</ul>
					</div>
				<?php endif; ?>
				<?php echo do_shortcode('[woocommerce_my_account]'); ?>
			</div>
		</div>
	</div>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>