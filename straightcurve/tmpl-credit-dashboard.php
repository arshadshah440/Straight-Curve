<?php
/*
 * Template Name: Credit dashboard
 */

get_header();

if ( have_posts() ) while ( have_posts() ) : the_post();
$thumb = get_the_post_thumbnail_url(get_the_ID(), 'full');
$title = get_the_title();

$credit_status = credit_status();

?><div class="c-account">
	<div class="c-account__stage" style="background-image: url(<?php echo $thumb ?>)">
		<div class="o-wrapper">
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
							<p>Welcome to your Straightcurve PRO Account. Trade pricing will be automatically applied to your orders at checkout, through a 10% discount. From your account dashboard you can view your <a href="/<?php echo current_site(); ?>/my-account/orders/">recent orders</a>, manage your <a href="/<?php echo current_site(); ?>/my-account/edit-address/">shipping and billing addresses</a>, and&nbsp;<a href="/<?php echo current_site(); ?>/my-account/edit-account/">edit your password and account details</a>.</p>
						<?php else : ?>
							<p>Welcome to your Straightcurve PRO Account. From your account dashboard you can view your <a href="/<?php echo current_site(); ?>/my-account/orders/">recent orders</a>, manage your <a href="/<?php echo current_site(); ?>/my-account/edit-address/">shipping and billing addresses</a>, and&nbsp;<a href="/<?php echo current_site(); ?>/my-account/edit-account/">edit your password and account details</a>.</p>
						<?php endif; ?>
					<?php else : ?>
						<p>From your account dashboard you can view your <a href="/<?php echo current_site(); ?>/my-account/orders/">recent orders</a>, manage your <a href="/<?php echo current_site(); ?>/my-account/edit-address/">shipping and billing addresses</a>, and&nbsp;<a href="/<?php echo current_site(); ?>/my-account/edit-account/">edit your password and account details</a>.</p>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<div class="c-account__content">
				<?php wc_get_template( 'myaccount/navigation.php' ); ?>
				<?php if ($credit_status && $credit_status === 'overdue') : ?>
					<ul class="woocommerce-error" role="alert">
						<li>NOTE: Your pay on account option is on hold due to an outstanding bill - please contact your accounts department to arrange payment so we can re-activate your credit limit.</li>
					</ul>
				<?php endif; ?>
				<div class="ra-credit-content">
					<?php the_content() ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>