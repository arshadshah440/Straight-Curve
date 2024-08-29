<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

if (disable_shop()) {
	return;
}

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
$gc = get_field('general_content', 'options');
$product_info = get_field('product_info');
$ideal_for = get_field('ideal_for');
$use_as = get_field('use_as');
$accessories = get_field('accessories');
$includes = get_field('includes');
$acc = array();

foreach ($accessories as $item) {
	if ($item['product'] && $item['required']) {
		$acc['required'][] = $item['product'];
	} elseif ($item['product']){
		$acc['optional'][] = $item['product'];
	}
}

$tabs = array();
if ($product->description) {
	$tabs[] = array( 'tab' => 'Description', 'content' => apply_filters( 'the_content', $product->description ) );
}
if ($ideal_for) {
	$ideal_for_title = $gc['solution_ideal_for'] ? $gc['solution_ideal_for'] : 'Ideal for';
	$tabs[] = array( 'tab' => $ideal_for_title, 'content' => $ideal_for );
}
if ($use_as) {
	$use_as_title = $gc['solution_use_as'] ? $gc['solution_use_as'] : 'Use as';
	$tabs[] = array( 'tab' => $use_as_title, 'content' => $use_as );
}


$add_ons = get_field('add-ons');
$has_add_ons = false;
$add_ons_steps = 0;
$add_ons_steps_curr = 0;
if (!is_product()) {
	$add_ons_steps += 1;
	$add_ons_steps_curr = 1;
}
if (
	(isset($add_ons['accessories'][0]['product']) && count($add_ons['accessories'][0]['product']) > 0) ||
	(isset($add_ons['bracing'][0]['product']) && count($add_ons['bracing'][0]['product']) > 0)
) {
	$has_add_ons = true;

	if (isset($add_ons['accessories'][0]['product']) && count($add_ons['accessories'][0]['product']) > 0) {
		$add_ons_steps += 1;
	}
	if (isset($add_ons['bracing'][0]['product']) && count($add_ons['bracing'][0]['product']) > 0) {
		$add_ons_steps += 1;
	}
}

?>
<div class="c-single-product <?php echo (!is_product() ? 'js-add-on-step is-active js-main-product-step' : ''); ?>" data-step="<?php echo $add_ons_steps_curr; ?>">
	<div class="o-wrapper o-wrapper--large">
		<div class="o-layout">
			<div class="o-layout__item u-1/2@tablet">
				<div class="c-single-product__images-wrap">
					<a href="javascript:void(0);" class="c-single-product__fav js-fav far fa-heart" data-id="<?php echo get_the_ID(); ?>" title="Favourite this product"></a>
					<?php do_action( 'woocommerce_before_single_product_summary' ); ?>
					<?php if (isset($includes['image']['url'])) : ?>
						<!-- <div class="c-single-product__images-includes">
							<div style="background-image: url(<?php echo $includes['image']['url'] ?>)"></div>
						</div> -->
					<?php endif; ?>
				</div>
			</div>
			<div class="o-layout__item u-1/2@tablet">
				<h1 class="c-single-product__title animate"><?php the_title() ?></h1>
				<div class="c-single-product__info">
					<?php if ($product_info && $product_info['details']) : ?>
						<span class="c-single-product__details"><?php echo $product_info['details']; ?></span>
					<?php endif; ?>
					<?php if (isset($includes['text']) && $includes['text']) : ?>
						<span class="c-single-product__details"><?php echo $includes['text']; ?></span>
					<?php endif; ?>
					<?php if ( $product->is_type('simple') ) : ?>
						<span class="c-single-product__details"><?php echo $product->get_sku(); ?></span>
					<?php endif; ?>
				</div>

				<div class="c-single-product__addtocart c-addtocart animate">
					<?php do_action( 'woocommerce_' . $product->get_type() . '_add_to_cart' ); ?>
				</div>

				<div class="c-single-product__tabs">
					<ul class="c-single-product__tabs-nav">
						<?php foreach ($tabs as $key => $tab) : ?>
							<li><a href="javascript:void(0);" class="js-tab <?php echo ($key === 0 ? 'is-active' : ''); ?>" data-target="<?php echo stripString($tab['tab']); ?>"><?php echo $tab['tab']; ?></a></li>
						<?php endforeach; ?>
					</ul>

					<?php foreach ($tabs as $key => $tab) : ?>
						<div class="c-single-product__tab-content" <?php echo ($key === 0 ? '' : 'hidden'); ?> data-tab="<?php echo stripString($tab['tab']); ?>"><?php echo $tab['content']; ?></div>
					<?php endforeach; ?>
				</div>
				<div class="c-single-product__bottom-buttons">
					<?php if ($has_add_ons) : ?>
						<a href="javascript:void(0);" class="o-btn o-btn--orange o-btn--outline js-open-accs">View accessories</a>
					<?php endif; ?>

					<?php $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) ); ?>
					<?php if ($shop_page_url && (current_site() !== 'uk' || (current_site() === 'uk' && is_pro_user()))) : ?>
						<a href="<?php echo $shop_page_url; ?>" class="o-btn o-btn--outline">Continue shopping</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php if ($has_add_ons) :
	woocommerce_product_loop_start();
	$args = array(
		'post_type' => 'product',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'orderby' => 'post__in',
		'post__in' => array()
	);
?>
<div class="c-single-product__add-ons">
	<?php if (isset($add_ons['accessories'][0]['product']) && count($add_ons['accessories'][0]['product']) > 0) : ?>
		<?php $add_ons_steps_curr++; ?>
		<div class="c-single-product__accs js-add-on-step" data-step="<?php echo $add_ons_steps_curr; ?>">
			<h2 class="c-single-product__add-ons-title"><?php echo ra_lang('Select the accessories for your chosen product'); ?></h2>
			<?php foreach ($add_ons['accessories'] as $item) : ?>
				<?php if ($item['product'] && count($item['product']) > 0) : ?>
					<?php
						$args['post__in'] = $item['product'];
						$loop = new WP_Query( $args );
						if ( $loop->have_posts() ) :

							$subtitle = trim($item['title']);
							if (!$subtitle && $item['required']) {
								$subtitle = 'Required ' . (count($item['product']) > 1 ? '- Choose 1 of the following:' : '');
							} elseif (!$subtitle) {
								$subtitle = 'Optional ' . (count($item['product']) > 1 ? '- Choose 1 of the following:' : '');
							}
						?>
							<h3 class="c-single-product__add-ons-subtitle"><?php echo $subtitle; ?></h3>
						<?php
							while ( $loop->have_posts() ) : $loop->the_post();
								wc_get_template_part( 'single-product-brief' );
							endwhile;
						endif;
						wp_reset_postdata();
					?>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<?php if (isset($add_ons['bracing'][0]['product']) && count($add_ons['bracing'][0]['product']) > 0) : ?>
		<?php $add_ons_steps_curr++; ?>
		<div class="c-single-product__bracing js-add-on-step" data-step="<?php echo $add_ons_steps_curr; ?>">
			<h2 class="c-single-product__add-ons-title"><?php echo ra_lang('Select bracing support to connect your chosen product'); ?></h2>
			<?php foreach ($add_ons['bracing'] as $item) : ?>
				<?php if ($item['product'] && count($item['product']) > 0) : ?>
					<?php
						$args['post__in'] = $item['product'];
						$loop = new WP_Query( $args );
						if ( $loop->have_posts() ) :
							$subtitle = trim($item['title']);
							if (!$subtitle && $item['required']) {
								$subtitle = 'Required ' . (count($item['product']) > 1 ? '- Choose 1 of the following:' : '');
							} elseif (!$subtitle) {
								$subtitle = 'Optional ' . (count($item['product']) > 1 ? '- Choose 1 of the following:' : '');
							}
						?>
							<h3 class="c-single-product__add-ons-subtitle"><?php echo $subtitle; ?></h3>
						<?php
							while ( $loop->have_posts() ) : $loop->the_post();
								wc_get_template_part( 'single-product-brief' );
							endwhile;
						endif;
						wp_reset_postdata();
					?>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<?php if ($add_ons_steps > 0) : ?>
		<div class="c-single-product__add-ons-nav">
			<a href="javascript:void(0);" class="o-btn o-btn--orange o-btn--arrowleft js-add-ons-nav prev disabled"><?php echo ra_lang('Prev'); ?></a>
			<span><?php echo ra_lang('Step'); ?> <span class="js-curr-step" data-max-step="<?php echo $add_ons_steps; ?>">1</span> <?php echo ra_lang('of'); ?> <span><?php echo $add_ons_steps; ?></span></span>
			<a href="javascript:void(0);" class="o-btn o-btn--orange js-add-ons-nav next <?php echo (is_product() ? '' : 'disabled'); ?>" data-text-done="<?php echo ra_lang('Done'); ?>" data-text-next="<?php echo ra_lang('Next'); ?>"><?php
				echo ($add_ons_steps > 1 ? ra_lang('Next') : ra_lang('Done'));
			?></a>
		</div>
	<?php endif; ?>
</div>
<?php woocommerce_product_loop_end();
endif; ?>

<?php do_action( 'woocommerce_after_single_product' ); ?>
