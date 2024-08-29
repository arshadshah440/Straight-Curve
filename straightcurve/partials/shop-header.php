<?php
	$sheet_pages = SHEET_PAGES;
	$breadcrumb = array();
	// $breadcrumb[] = array('link' => '/shop', 'label' => 'Shop');
	// if (is_product_category()) {
	// 	$title = single_cat_title('', false);
	// 	$breadcrumb[] = array('link' => '', 'label' => $title);
	// }
	// if (is_product()) {
	// 	$product_cat = get_the_terms(get_the_ID(), 'product_cat' );
	// 	$ra_product_type = get_the_terms(get_the_ID(), 'ra_product_type' );
	// 	if ($product_cat && count($product_cat) > 0) {
	// 		$link = '';
	// 		if ($product_cat[0]->slug === 'accessory') {
	// 			$link = '/shop/Accessory';
	// 		}
	// 		$breadcrumb[] = array('link' => $link, 'label' => $product_cat[0]->name);
	// 	}
	// 	if ($ra_product_type && count($ra_product_type) > 0) {
	// 		$breadcrumb[] = array('link' => '', 'label' => $ra_product_type[0]->name);
	// 	}
	// 	$breadcrumb[] = array('link' => '', 'label' => get_the_title());
	// }
	// if (is_cart()) {
	// 	$breadcrumb[] = array('link' => '', 'label' => 'Cart');
	// }
	// if (is_checkout()) {
	// 	$breadcrumb[] = array('link' => '', 'label' => 'Checkout');
	// }

	$cart_count = WC()->cart->get_cart_contents_count();
	$cart_total = WC()->cart->get_cart_total();

	$quibble_returns = get_field('quibble_returns', 'options');
	$has_quibble_returns = false;
	$quibble_returns_directlink = false;
	if (isset($quibble_returns['is_active']) && $quibble_returns['is_active'] && $quibble_returns['menu_label'] && isset($quibble_returns['direct_link']['url'])) {
		$has_quibble_returns = true;
		$quibble_returns_directlink = true;
	} elseif (isset($quibble_returns['is_active']) && $quibble_returns['is_active'] && $quibble_returns['menu_label'] && $quibble_returns['overlay_content']) {
		$has_quibble_returns = true;
	}
	// if ($has_quibble_returns && current_site() === 'au' && !is_pro_user()) {
	// 	$has_quibble_returns = false;
	// }

	$delivery_information = get_field('delivery_information', 'options');
	$has_delivery_information = false;
	$delivery_information_directlink = false;
	if (isset($delivery_information['is_active']) && $delivery_information['is_active'] && $delivery_information['menu_label'] && isset($delivery_information['direct_link']['url'])) {
		$has_delivery_information = true;
		$delivery_information_directlink = true;
	} elseif (isset($delivery_information['is_active']) && $delivery_information['is_active'] && $delivery_information['menu_label'] && $delivery_information['overlay_content']) {
		$has_delivery_information = true;
	}

if ( !disable_shop() && is_woocommerce() || is_cart() || is_checkout() ) :
?><div class="c-top__shop">
	<div class="o-wrapper">
		<ul class="c-top__shop-breadcrumb">
			<?php foreach ($breadcrumb as $item) :
				if ($item['link']) :
				?><li><a href="<?php echo SITE . $item['link']; ?>"><?php echo $item['label']; ?></a></li><?php
				else :
				?><li><span><?php echo $item['label']; ?></span></li><?php
				endif;
			endforeach; ?>
			<?php if ($has_quibble_returns && $quibble_returns_directlink) : ?>
				<li><a href="<?php echo $quibble_returns['direct_link']['url']; ?>" target="<?php echo $quibble_returns['direct_link']['target']; ?>"><?php echo $quibble_returns['menu_label']; ?></a></li>
			<?php elseif ($has_quibble_returns) : ?>
				<li><a href="#no-quibble-return" class="js-info-overlay"><?php echo $quibble_returns['menu_label']; ?></a></li>
			<?php endif; ?>

			<?php if ($has_delivery_information && $delivery_information_directlink) : ?>
				<li><a href="<?php echo $delivery_information['direct_link']['url']; ?>" target="<?php echo $delivery_information['direct_link']['target']; ?>"><?php echo $delivery_information['menu_label']; ?></a></li>
			<?php elseif ($has_delivery_information) : ?>
				<li><a href="#delivery-information" class="js-info-overlay"><?php echo $delivery_information['menu_label']; ?></a></li>
			<?php endif; ?>
			<?php if (isset($sheet_pages[4]['url']) && current_site() === 'uk') : ?>
				<li><a href="<?php echo $sheet_pages[4]['url']; ?>?range=Rigid&amp;height=240mm&amp;soil=Soft">Bracing</a></li>
			<?php endif; ?>
		</ul>
		<div class="c-top__shop-right">
			<a href="<?php echo SITE; ?>/my-account" class="myaccount">My account</a>
			<div class="c-top__shop-icons">
				<a href="<?php echo SITE; ?>/my-favourites" class="c-top__shop-favs js-fav-pagelink"><i class="fas fa-heart"></i></a>
				<!-- <a href="<?php echo SITE; ?>/search"><i class="far fa-search"></i></a> -->
				<a href="javascript:void(0);" class="cart js-open-minicart"><span class="header-cart-count"><i class="fal fa-shopping-cart"></i> <span>(<?php echo $cart_count; ?>) <?php echo $cart_total; ?></span></span></a>
			</div>
		</div>
	</div>
</div><?php endif; ?>