</div><!-- .c-content -->
<?php
	$page_settings = get_field('page_settings');
	$hide_footer = isset($page_settings['header_footer_options'][0]) && in_array('Hide Footer', $page_settings['header_footer_options']);

	$gc = get_field('general_content', 'options');
	$mega_menu = get_field('footer_mega_menu', 'options');
?>
<div class="c-minicart">
	<div class="c-minicart__top">
		<a href="javascript:void(0);" class="c-minicart__top-close js-close-minicart"><i class="far fa-long-arrow-right"></i></a>
		<h2><?php echo ra_lang('Your order'); ?></h2>
		<span class="c-minicart__top-space"></span>
	</div>
	<div class="widget_shopping_cart_content"><?php woocommerce_mini_cart(); ?></div>
</div>

<?php
	$footer_bottom_links = get_field('footer_bottom_links', 'options');
	$in_stock_info = get_field('in_stock_info', 'options');
	$quibble_returns = get_field('quibble_returns', 'options');
	$register_for_pro = get_field('register_for_pro', 'options');
	$register_for_dealer = get_field('register_for_dealer', 'options');
	$has_quibble_returns = false;
	$quibble_returns_directlink = false;
	if (isset($quibble_returns['is_active']) && $quibble_returns['is_active'] && $quibble_returns['menu_label'] && isset($quibble_returns['direct_link']['url'])) {
		$has_quibble_returns = true;
		$quibble_returns_directlink = true;
	} elseif (isset($quibble_returns['is_active']) && $quibble_returns['is_active'] && $quibble_returns['menu_label'] && $quibble_returns['overlay_content']) {
		$has_quibble_returns = true;
	}
	if ($has_quibble_returns && current_site() === 'au' && !is_pro_user()) {
		$has_quibble_returns = false;
	}

	$delivery_information = get_field('delivery_information', 'options');
	$has_delivery_information = false;
	$delivery_information_directlink = false;
	if (isset($delivery_information['is_active']) && $delivery_information['is_active'] && $delivery_information['menu_label'] && isset($delivery_information['direct_link']['url'])) {
		$has_delivery_information = true;
		$delivery_information_directlink = true;
	} elseif (isset($delivery_information['is_active']) && $delivery_information['is_active'] && $delivery_information['menu_label'] && $delivery_information['overlay_content']) {
		$has_delivery_information = true;
	}
?>

<?php if (!$hide_footer) : ?>
<footer class="c-footer">

    <?php
		$footer_top = get_field('footer_top', 'options');
	?><div class="c-footer__top">
        <div class="o-wrapper text-center">
			<div class="c-footer__top-inner">
				<div class="c-footer__top-copy">
					<h3><?php echo $footer_top['title']; ?></h3>
					<p><?php echo $footer_top['copy']; ?></p>
				</div>
				<?php if (isset($footer_top['link']['url'])) : ?>
					<div class="c-footer__top-link"><a href="<?php echo $footer_top['link']['url']; ?>" target="<?php echo $footer_top['link']['target']; ?>" class="o-btn o-btn--white o-btn--outline"><?php echo $footer_top['link']['title']; ?></a></div>
				<?php endif; ?>
			</div>
        </div>
    </div>

	<?php
	// echo "<pre>";
	// print_r($mega_menu);
	// echo "</pre>";
	?>
	<?php if (isset($mega_menu['menu_section'][0]['links'][0]['link']['url'])) : ?>
		<div class="c-footer__mega-menu">
			<div class="o-wrapper">
				<div class="o-layout">
					<?php foreach ($mega_menu['menu_section'] as $item) :
					if (isset($item['links'][0]['link']['url'])) : ?>
						<div class="o-layout__item u-1/6@laptop u-1/4@tabletWide u-1/3@mobileLandscape u-1/2">
							<?php if ($item['title']) : ?>
								<h4><?php echo $item['title']; ?></h4>
							<?php endif; ?>

							<ul class="c-footer__mega-menu-main">
								<?php foreach ($item['links'] as $link) :
									$main_link_wrap_start = '<a href="' . $link['link']['url'] . '" target="' . $link['link']['target'] . '">';
									$main_link_wrap_end = '</a>';
									if ($link['link']['url'] === '#') {
										$main_link_wrap_start = '<span>';
										$main_link_wrap_end = '</span>';
									}
									?>
									<li>
										<?php echo $main_link_wrap_start . ra_pa_label($link['link']['title']) . $main_link_wrap_end; ?>

										<?php if ($link['has_sub_links'] && isset($link['sub_links'][0]['link']['url'])) : ?>
											<ul class="c-footer__mega-menu-sub">
												<?php foreach ($link['sub_links'] as $sub_link) : ?>
													<li><a href="<?php echo $sub_link['link']['url']; ?>" target="<?php echo $sub_link['link']['target']; ?>"><?php echo ra_pa_label($sub_link['link']['title']); ?></a></li>
												<?php endforeach; ?>
											</ul>
										<?php endif; ?>
									</li>
								<?php endforeach; ?>
							</ul>

						</div>
					<?php endif; endforeach; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

    <div class="copyRight">
        <div class="o-wrapper">
            <div class="copyrightWrapper">
                <span><?php echo $gc['footer_copyright_text'] ? $gc['footer_copyright_text'] : 'Straightcurve © ' . date('Y') . ' All Rights Reserved'; ?></span>
				<?php if (isset($gc['footer_privacy_link']['url'])) : ?>
					<span><a href="<?php echo $gc['footer_privacy_link']['url']; ?>" target="<?php echo $gc['footer_privacy_link']['target']; ?>"><?php echo $gc['footer_privacy_link']['title']; ?></a></span>
				<?php endif; ?>
				<?php if (isset($gc['footer_product_guarantee']['url'])) : ?>
					<span><a href="<?php echo $gc['footer_product_guarantee']['url']; ?>" target="<?php echo $gc['footer_product_guarantee']['target']; ?>"><?php echo $gc['footer_product_guarantee']['title']; ?></a></span>
				<?php endif; ?>
				<?php if (isset($gc['footer_product_care_guide']['url'])) : ?>
					<span><a href="<?php echo $gc['footer_product_care_guide']['url']; ?>" target="<?php echo $gc['footer_product_care_guide']['target']; ?>"><?php echo $gc['footer_product_care_guide']['title']; ?></a></span>
				<?php endif; ?>
				<?php if (isset($gc['warranty_claim']['url'])) : ?>
					<span><a href="<?php echo $gc['warranty_claim']['url']; ?>" target="<?php echo $gc['warranty_claim']['target']; ?>"><?php echo $gc['warranty_claim']['title']; ?></a></span>
				<?php endif; ?>

				<?php foreach ($footer_bottom_links as $item) : if (isset($item['link']['url']) && $item['link']['url']) : ?>
					<span><a
						href="<?php echo $item['link']['url']; ?>"
						class="<?php echo (substr( $item['link']['url'], 0, 1 ) === "#" ? 'js-info-overlay' : ''); ?>"
						target="<?php echo $item['link']['target']; ?>" ><?php echo $item['link']['title']; ?></a></span>
				<?php endif; endforeach; ?>

				<?php if ($has_quibble_returns && $quibble_returns_directlink) : ?>
					<span><a href="<?php echo $quibble_returns['direct_link']['url']; ?>" target="<?php echo $quibble_returns['direct_link']['target']; ?>"><?php echo $quibble_returns['menu_label']; ?></a></span>
				<?php elseif ($has_quibble_returns && current_site() !== 'uk') : ?>
					<span><a href="#no-quibble-return" class="js-info-overlay"><?php echo $quibble_returns['menu_label']; ?></a></span>
				<?php endif; ?>
            </div>
        </div>
    </div>
</footer>
<?php endif; ?>


<?php if ($has_quibble_returns && !$quibble_returns_directlink) : ?>
	<div class="c-info-overlay" hidden id="no-quibble-return">
		<div class="c-info-overlay__container">
			<a href="javascript:void(0);" class="c-info-overlay__close js-close-info"><i class="fal fa-times"></i></a>
			<div class="c-info-overlay__content">
				<?php if (isset($quibble_returns['overlay_image']['url'])) : ?>
					<img src="<?php echo $quibble_returns['overlay_image']['url']; ?>" alt="<?php echo $quibble_returns['overlay_image']['title']; ?>">
				<?php endif; ?>
				<?php echo $quibble_returns['overlay_content']; ?>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php if ($has_delivery_information && !$delivery_information_directlink) : ?>
	<div class="c-info-overlay" hidden id="delivery-information">
		<div class="c-info-overlay__container">
			<a href="javascript:void(0);" class="c-info-overlay__close js-close-info"><i class="fal fa-times"></i></a>
			<div class="c-info-overlay__content">
				<?php if (isset($delivery_information['overlay_image']['url'])) : ?>
					<img src="<?php echo $delivery_information['overlay_image']['url']; ?>" alt="<?php echo $delivery_information['overlay_image']['title']; ?>">
				<?php endif; ?>
				<?php echo $delivery_information['overlay_content']; ?>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php if (isset($in_stock_info['is_active']) && $in_stock_info['is_active'] && $in_stock_info['overlay_content']) : ?>
	<div class="c-info-overlay" hidden id="in-stock-info">
		<div class="c-info-overlay__container">
			<a href="javascript:void(0);" class="c-info-overlay__close js-close-info"><i class="fal fa-times"></i></a>
			<div class="c-info-overlay__content">
				<?php if (isset($in_stock_info['overlay_image']['url'])) : ?>
					<img src="<?php echo $in_stock_info['overlay_image']['url']; ?>" alt="<?php echo $in_stock_info['overlay_image']['title']; ?>">
				<?php endif; ?>
				<?php echo $in_stock_info['overlay_content']; ?>
			</div>
		</div>
	</div>
<?php endif; ?>


<?php if (is_cart() || is_checkout()) : ?>
	<?php get_template_part('partials/fixing-overlay') ?>
	<?php get_template_part('partials/brochure-popup') ?>
<?php else : ?>
	<div class="c-product-overlay" hidden>
		<div class="c-product-overlay__content">
			<a href="javascript:void(0);" class="c-product-overlay__close js-overlay-close"><i class="fal fa-times"></i></a>
			<div class="js-product-overlaycontent"></div>
		</div>
	</div>
<?php endif; ?>

<!-- popup pricelist form  -->
<div class="c-form-overlay" hidden id="form-overlay-pricelist">
	<div class="c-form-overlay__content">
		<a href="javascript:void(0);" class="c-form-overlay__close js-overlay-close"><i class="fal fa-times"></i></a>
		<div class="c-cms-content o-wrapper">
			<?php
				$pricelist_page_id= get_page_id_by_template('tmpl-pricelist.php');
				$popup_pricelist_form_id= get_field('popup_price_list_form_id', $pricelist_page_id);
				$fields = get_fields($pricelist_page_id);
				$popup_pricelist_form_id = $fields['popup_price_list_form_id'];
			?>

            <!-- Ninja form section  -->
			<div class="o-layout pricelist-section" hidden>
				<div class="o-layout__item o-main  o-main-form  u-2/3@tablet  u-3/4@tabletWide">
					<h2><?php echo $fields['form_title']; ?></h2>
					<img src="<?php echo ASSETS; ?>/img/2x1.trans.gif" data-custom-src="<?php echo $fields['mobile_image']['url']; ?>" hidden class="mobile-popup-img " alt="">
					<?= do_shortcode("[ninja_form id=$popup_pricelist_form_id]"); ?>
				</div>
				<div class="o-layout__item o-side   o-side-form u-1/3@tablet u-1/4@tabletWide">
					<?php if (isset($fields['sidebar_section'][0])) : ?>
						<h3><?php echo $fields['sidebar_tilte']; ?></h3>
						<?php foreach ($fields['sidebar_section'] as $item) : ?>
							<?php if (isset($item['image']['url'])) : ?>
								<h4><?php echo $item['title']; ?></h4>
								<img class="" src="<?php echo ASSETS; ?>/img/2x1.trans.gif" data-custom-src="<?php echo $item['image']['url']; ?>" alt="<?php echo $item['title']; ?>">
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>

			<!-- thankyou section shows after form submition  -->
			<div class="thankyou-section" hidden >
				<h2 class="main-title"><?php echo $fields['thank_you_title']; ?></h2>
				<div class="o-layout">
					<div class="o-layout__item o-main  u-8/12@mobileLandscape">
						<?php echo get_post($pricelist_page_id)->post_content; ?>
						<a href="javascript:void(0);" class=" o-btn o-btn--orange js-overlay-close">Return to home</a>
					</div>
					<div class="o-layout__item o-side u-4/12@mobileLandscape">
						<img class="" src="<?php echo ASSETS; ?>/img/2x1.trans.gif" data-custom-src="<?php echo $fields['thank_you_side_image']['url']; ?>">
					</div>
				</div>
            </div>
		</div>
	</div>
</div>



<?php if (isset($register_for_pro['is_active']) && $register_for_pro['is_active']) : ?>
<div class="c-form-overlay" hidden id="form-overlay-prouserpromo">
	<div class="c-form-overlay__content">
		<a href="javascript:void(0);" class="c-form-overlay__close js-overlay-close"><i class="fal fa-times"></i></a>
		<div class="c-cms-content o-wrapper">
			<div class="o-layout">
				<div class="o-layout__item o-main  o-main-form  u-2/3@tablet">
					<h2><?php echo $register_for_pro['title']; ?></h2>
					<?php
						$form = do_shortcode($register_for_pro['form']);
						echo str_replace('%Straightcurve PRO%', 'Straightcurve PRO', $form);
					?>
				</div>
				<div class="o-layout__item o-side   o-side-form u-1/3@tablet">
					<div class="c-form-overlay__prouser-side">
						<?php echo $register_for_pro['side_copy']; ?>
						<?php if (isset($register_for_pro['side_image']['url'])) : ?>
							<img src="<?php echo ASSETS; ?>/img/2x1.trans.gif" data-custom-src="<?php echo $register_for_pro['side_image']['url']; ?>" alt="<?php echo $register_for_pro['side_image']['title']; ?>">
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>



<?php if (isset($register_for_dealer['is_active']) && $register_for_dealer['is_active']) : ?>
<div class="c-form-overlay" hidden id="form-overlay-dealeruserpromo">
	<div class="c-form-overlay__content">
		<a href="javascript:void(0);" class="c-form-overlay__close js-overlay-close"><i class="fal fa-times"></i></a>
		<div class="c-cms-content o-wrapper">
			<div class="o-layout">
				<div class="o-layout__item o-main  o-main-form  u-2/3@tablet">
					<h2><?php echo $register_for_dealer['title']; ?></h2>
					<?php
						$form = do_shortcode($register_for_dealer['form']);
						echo str_replace('%Straightcurve PRO%', 'Straightcurve Dealer', $form);
					?>
				</div>
				<div class="o-layout__item o-side   o-side-form u-1/3@tablet">
					<div class="c-form-overlay__prouser-side">
						<?php echo $register_for_dealer['side_copy']; ?>
						<?php if (isset($register_for_dealer['side_image']['url'])) : ?>
							<img src="<?php echo ASSETS; ?>/img/2x1.trans.gif" data-custom-src="<?php echo $register_for_dealer['side_image']['url']; ?>" alt="<?php echo $register_for_dealer['side_image']['title']; ?>">
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>



<?php wp_footer(); ?>
</body>

</html>