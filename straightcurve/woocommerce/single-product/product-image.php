<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.8.0
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$post_thumbnail_id = $product->get_image_id();
$attachment_ids = $product->get_gallery_attachment_ids();
$images = array();
if ($post_thumbnail_id) {
	$images[] = wp_get_attachment_image_src( $post_thumbnail_id, 'full' )[0];
}
if ($attachment_ids && count($attachment_ids) > 0) {
	foreach ($attachment_ids as $value) {
		$images[] = wp_get_attachment_image_src( $value, 'full' )[0];
	}
}

if (count($images) === 0) {
	$images[] = ASSETS . '/img/woocommerce-placeholder.png';
}

?>
<div class="c-single-product__images">
	<?php foreach ($images as $image) : ?>
		<div class="c-single-product__image" style="background-image: url(<?php echo $image ?>)" data-src="<?php echo $image; ?>"></div>
		<!-- <img src="<?php echo $image; ?>" alt="<?php echo the_title(); ?>"> -->
	<?php endforeach; ?>
</div>