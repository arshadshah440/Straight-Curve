<?php
defined( 'ABSPATH' ) || exit;
if (disable_shop()) {
	return;
}

global $product;
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
$product_info = get_field('product_info');
$image_url = get_the_post_thumbnail_url(null, 'full');
?>
<div class="c-single-product-brief clearfix <?php echo ($image_url ? 'has-image' : ''); ?>">
	<?php if ($image_url) : ?>
		<div class="c-single-product-brief__thumb" style="background-image: url(<?php echo $image_url ?>)"></div>
	<?php endif; ?>
	<h4 class="c-single-product-brief__title animate"><?php the_title() ?></h4>
	<?php if ($product->description) : ?>
		<div class="c-single-product-brief__desc"><?php echo apply_filters( 'the_content', $product->description ) ?></div>
	<?php endif; ?>

	<div class="c-single-product-brief__info">
		<?php if ($product_info && $product_info['details']) : ?>
			<span class="c-single-product-brief__details"><?php echo $product_info['details']; ?></span>
		<?php endif; ?>
	</div>
	<div class="c-single-product-brief__addtocart c-addtocart c-addtocart--small animate clearfix">
		<?php do_action( 'woocommerce_' . $product->get_type() . '_add_to_cart' ); ?>
	</div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
