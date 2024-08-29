<?php
/*
 * Template Name: Cart / Checkout
 */
// NL disable checkout
if (is_checkout() && current_site() === 'nl') {
	header('Location: ' . SITE . '/cart');
}

get_header();

if ( !disable_shop() && have_posts() ) while ( have_posts() ) : the_post() ;
$page_class = 'c-checkout';
$extra_class = '';
if (is_cart()) {
	$page_class = 'c-cart';

	if (current_site() === 'nl') {
		$extra_class .= ' pdf-success';
	}
}

?>
<div class="<?php echo $page_class . ' ' . $extra_class; ?>">

	<?php // get_template_part('partials/progress-bar'); ?>
	<div class="o-wrapper">
		<?php if (is_cart()) : ?>
			<h1 class="<?php echo $page_class . '__title'; ?>"><?php the_title() ?></h1>
		<?php endif; ?>
		<div class="<?php echo $page_class; ?>__content">
			<?php the_content() ?>
		</div>
	</div>


	<?php if (1== 2 && current_site() === 'nl' && is_cart()) : ?>
		<div class="c-cart__cart-pdf-success cart-pdf-success">
			<div class="c-cart__cart-pdf-success-inner">
				<h3>Thank you for downloading your shopping list.</h3>
				<p>To find your nearest dealer and send your shopping list, please visit the "<a href="<?php echo SITE; ?>/garden-where-to-buy/">where to buy</a>" page.</p>
				<p>From there you can either print and take your shopping list to your dealer, or email them a copy using the contact details you'll find on the map</p>
			</div>
		</div>
	<?php endif; ?>

</div>
<?php endwhile; ?>

<?php get_footer(); ?>