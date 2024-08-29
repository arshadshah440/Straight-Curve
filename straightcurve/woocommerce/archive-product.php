<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;



get_header( 'shop' );

if (disable_shop() || (is_shop() && current_site() === 'uk' && !is_pro_user())) :
	echo '<div class="c-shop__placeholder"></div>';
else :

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

$shop_id = get_option( 'woocommerce_shop_page_id' );
$image = get_the_post_thumbnail_url($shop_id);

$product_cat = get_terms( 'product_cat' );
$ra_product_type = get_terms( 'ra_product_type' );
$ra_product_height = get_terms( 'ra_product_height' );

$current_cat = '';
if (is_product_category()) {
	$current_cat = single_cat_title('', false);
}

$show_images_at = array(3, 7, 13, 17, 23, 27, 33, 37, 43, 47, 53, 57, 63, 67, 73, 77, 83, 87, 93, 97);
$shop_tips = get_field('shop_tips', 'options');
$tip_images = array();
foreach ($shop_tips as $value) {
	if ($value['image']) {
		$tip_images[] = array(
			'image' => $value['image'],
			'url' => $value['url'],
			'external_link' => $value['external_link']
		);
	}
}

?><div class="c-shop">

<div class="c-shop__banner">
	<div class="o-wrapper">
		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
			<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
		<?php endif; ?>

		<?php
		/**
		 * Hook: woocommerce_archive_description.
		 *
		 * @hooked woocommerce_taxonomy_archive_description - 10
		 * @hooked woocommerce_product_archive_description - 10
		 */
		do_action( 'woocommerce_archive_description' );
		?>
	</div>
</div>

<?php // get_template_part('partials/progress-bar'); ?>

<div class="o-wrapper">
<?php if (is_shop()) : ?>

<?php // get_template_part('partials/pro-user-promo') ?>
<div class="c-top__sticky">
<div class="c-shop__top clearfix">
	<h3 class="c-shop__top-title">Filter by</h3>
	<div class="c-shop__top-buttons">
		<a href="javascript:void(0);" class="o-btn o-btn--noarrow all js-product-filter is-active" data-filter="cat" data-val="All">All</a>
		<?php foreach ($product_cat as $item) :
			$cat_class = $item->slug;
			if ($item->name === $current_cat) {
				$cat_class .= ' is-active';
			} ?>
			<?php if ($item->slug !== 'misc') : ?>
			<a href="javascript:void(0);" class="o-btn o-btn--noarrow <?php echo $cat_class; ?> js-product-filter" data-filter="cat" data-val="<?php echo $item->slug; ?>"><?php echo $item->name; ?></a>
			<?php endif; ?>
		<?php
		endforeach; ?>
	</div>
	<div class="c-shop__search">
		<input type="text" placeholder="Search products" id="js-product-search" class="c-shop__search-input">
		<i class="far fa-search"></i>
	</div>
</div>
<?php
	$column_class = 'u-1/3@tablet';
	$layout_class = '';
	if (current_site() === 'au') {
		$column_class = 'u-1/4@tablet';
		$layout_class = 'c-shop__filter--four-column';
	}
?>
<div class="c-shop__filter <?php echo $layout_class; ?>">
	<div class="c-shop__filter-wrap is-open">
		<div class="o-layout o-layout--large o-module">
			<div class="o-layout__item o-module__item <?php echo $column_class; ?>">
				<div class="o-module__content">
					<a href="javascript:void(0);" class="c-shop__filter-clear js-filter-clear"><i class="fal fa-minus-circle"></i> Clear all</a>
					<ul class="c-shop__filter-selection">
						<li><strong>Height:</strong> <span class="js-filter-val height">All</span></li>
						<li><strong>Product:</strong> <span class="js-filter-val type">All</span></li>
						<li><strong>Solution:</strong> <span class="js-filter-val cat"><?php echo $current_cat ? $current_cat : 'All'; ?></span></li>
					</ul>
				</div>
			</div>
			<div class="o-layout__item o-module__item <?php echo $column_class; ?>">
				<div class="o-module__content">
					<ul class="c-shop__filter-group">
						<li class="lablel">Filter by Height</li>
						<li><a href="javascript:void(0);" class="js-product-filter is-active" data-filter="height" data-val="All">All</a></li>
						<?php foreach ($ra_product_height as $item) : ?>
							<li><a href="javascript:void(0);" class="js-product-filter" data-filter="height" data-val="<?php echo $item->slug; ?>"><?php echo $item->name; ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
			<div class="o-layout__item o-module__item <?php echo $column_class; ?>">
				<div class="o-module__content">
					<ul class="c-shop__filter-group">
						<li class="lablel">Filter by Product</li>
						<li><a href="javascript:void(0);" class="js-product-filter is-active" data-filter="type" data-val="All">All</a></li>
						<?php foreach ($ra_product_type as $item) : ?>
							<li><a href="javascript:void(0);" class="js-product-filter" data-filter="type" data-val="<?php echo $item->slug; ?>"><?php echo $item->name; ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
			<?php if (current_site() === 'au') : ?>
				<div class="o-layout__item o-module__item <?php echo $column_class; ?>">
					<div class="o-module__content">
						<ul class="c-shop__filter-group">
							<li class="lablel">Filter by Finish</li>
							<li><a href="javascript:void(0);" class="js-product-filter is-active" data-filter="finish" data-val="All">All</a></li>
							<li><a href="javascript:void(0);" class="js-product-filter" data-filter="finish" data-val="weathering"><?php echo ra_lang('Weathering'); ?></a></li>
							<li><a href="javascript:void(0);" class="js-product-filter" data-filter="finish" data-val="galvanised"><?php echo ra_lang('Galvanised'); ?></a></li>
						</ul>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="c-shop__filter-toggle">
		<a href="javascript:void(0);" class="js-toggle-filter" data-open-title="Open Advanced Filtering" data-close-title="Close Advanced Filtering">Close Advanced Filtering</a>
	</div>
</div>
</div>

<?php endif; ?>

	<!-- <h2 class="c-shop__heading">Select your products to get started</h2> -->
	<?php // wc_get_template_part( 'content-product-overlay' ); ?>

	<?php
	if ( woocommerce_product_loop() ) {

		/**
		 * Hook: woocommerce_before_shop_loop.
		 *
		 * @hooked woocommerce_output_all_notices - 10
		 * @hooked woocommerce_result_count - 20
		 * @hooked woocommerce_catalog_ordering - 30
		 */
		do_action( 'woocommerce_before_shop_loop' );

		woocommerce_product_loop_start();

	?>
	<div class="o-layout o-module" id="js-products-container" data-page="<?php echo $page_is; ?>">
		<?php
		if ( wc_get_loop_prop( 'total' ) ) {
			$show_images_at = array(3, 7, 13, 17, 23, 27, 33, 37, 43, 47, 53, 57, 63, 67, 73, 77, 83, 87, 93, 97);
			$i = 1;
			$img = 0;
			while ( have_posts() ) {
				the_post();

				$hide_product = false;
				$product_cat = get_the_terms( $product_id, 'product_cat' );
				$product_info = get_field('product_info', $product_id);
				$is_accs_prod = false;
				foreach ($product_cat as $cat) {
					if ($cat->slug === 'accessories' && !$is_accs_prod) {
						$is_accs_prod = true;
					}
				}

				if (isset($product_info['hide_from_shop_page']) && $product_info['hide_from_shop_page']) {
					$hide_product = true;
				}

				if (!$hide_product) {

					/**
					 * Hook: woocommerce_shop_loop.
					 */
					do_action( 'woocommerce_shop_loop' );

					wc_get_template_part( 'content', 'product' );

					if (!$is_accs_prod && is_shop()) {
						if (in_array($i, $show_images_at) && $tip_images[$img]) {
							// if (current_site() === 'uk' && !is_live()) {
							// 	echo '<div class="o-layout__item o-module__item u-1/3@tabletWide u-1/3@tablet u-1/2@mobileLandscape js-shop-tip c-shop__tip-wrap is-shorttile">';
							// } else {
								echo '<div class="o-layout__item o-module__item u-1/4@tabletWide u-1/3@tablet u-1/2@mobileLandscape js-shop-tip c-shop__tip-wrap">';
							// }
							if ($tip_images[$img]['url']) { echo '<a class="c-shop__tip-link" href="' . $tip_images[$img]['url'] . '" target="' . ($tip_images[$img]['external_link'] ? '_blank' : '') . '">'; }
							echo '<div class="c-shop__tip" style="background-image: url(' . $tip_images[$img]['image'] . ')"></div>';
							if ($tip_images[$img]['url']) { echo '</a>'; }
							echo '</div>';
							$img++;
						}
						$i++;
					}
				}
			}
		}
		?>

	</div>
	<?php

		woocommerce_product_loop_end();

		/**
		 * Hook: woocommerce_after_shop_loop.
		 *
		 * @hooked woocommerce_pagination - 10
		 */
		do_action( 'woocommerce_after_shop_loop' );
	} else {
		/**
		 * Hook: woocommerce_no_products_found.
		 *
		 * @hooked wc_no_products_found - 10
		 */
		do_action( 'woocommerce_no_products_found' );
	}

	/**
	 * Hook: woocommerce_after_main_content.
	 *
	 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
	 */
	do_action( 'woocommerce_after_main_content' );

	/**
	 * Hook: woocommerce_sidebar.
	 *
	 * @hooked woocommerce_get_sidebar - 10
	 */
	do_action( 'woocommerce_sidebar' ); ?>
<?php endif; ?>
<?php get_footer( 'shop' ); ?>
</div>
</div>

<?php if (1 === 2) :
	$all_products = array();
    if ( have_posts() ) : while ( have_posts() ) : the_post();
		if( $product->is_type( 'simple' ) ){
			$all_products[get_the_ID()] = array(
				'type' => 'simple',
				'name' => get_the_title(),
				'price' => $product->price,
				'reg_price' => $product->regular_price,
				'sale_price' => $product->sale_price,
				'sku' => $product->sku,
			);

		} elseif( $product->is_type( 'variable' ) ){
			$product_variations = $product->get_available_variations();
			$variations = array();
			foreach ($product_variations as $variation) {
				foreach ($variation['attributes'] as $attributes => $val) {
					$name = $val;

				}
				$variations[$variation['variation_id']] = array(
					'price' => $variation['display_price'],
					'display_regular_price' => $variation['display_regular_price'],
					'attributes' => $variation['attributes'],
					'sku' => $variation['sku']
				);
			}
			$all_products[get_the_ID()] = array(
				'type' => 'variable',
				'name' => get_the_title(),
				'slug' => $product->slug,
				'price' => $product->price,
				'variations' => $variations,
				'reg_price' => $product->regular_price,
				'sale_price' => $product->sale_price,
				'sku' => $product->sku,
			);
		}
    endwhile; endif; ?>
	<script>var allProducts = <?php echo json_encode($all_products); ?>;</script>
<?php endif; ?>