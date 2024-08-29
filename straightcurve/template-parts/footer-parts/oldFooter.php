
<?php
	$page_settings = get_field('page_settings');
	$hide_footer = isset($page_settings['header_footer_options'][0]) && in_array('Hide Footer', $page_settings['header_footer_options']);

	$gc = get_field('general_content', 'options');
	$mega_menu = get_field('footer_mega_menu', 'options');
?>





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
								<img class="myclass" src="<?php echo $item['image']['url']; ?>" data-custom-src="<?php echo $item['image']['url']; ?>" alt="<?php echo $item['title']; ?>">
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
						<img class="" src="<?php echo $fields['thank_you_side_image']['url']; ?>" data-custom-src="<?php echo $fields['thank_you_side_image']['url']; ?>">
					</div>
				</div>
            </div>
		</div>
	</div>
</div>

<!-- popup pricelist DIY form  -->
<div class="c-form-overlay" hidden id="form-overlay-pricelist_DIY">
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
			<div class="o-layout pricelist-section_diy" hidden>
				<div class="o-layout__item o-main  o-main-form  u-2/3@tablet  u-3/4@tabletWide">
					<h2><?php echo $fields['form_title']; ?></h2>
					<img src="<?php echo ASSETS; ?>/img/2x1.trans.gif" data-custom-src="<?php echo $fields['mobile_image']['url']; ?>" hidden class="mobile-popup-img " alt="">
					<?= do_shortcode("[ninja_form id=12]"); ?>
				</div>
				<div class="o-layout__item o-side   o-side-form u-1/3@tablet u-1/4@tabletWide">
					<?php if (isset($fields['sidebar_section'][0])) : ?>
						<h3><?php echo $fields['sidebar_tilte']; ?></h3>
						<?php foreach ($fields['sidebar_section'] as $item) : ?>
							<?php if (isset($item['image']['url'])) : ?>
								<h4><?php echo $item['title']; ?></h4>
								<img class="myclass" src="<?php echo $item['image']['url']; ?>" data-custom-src="<?php echo $item['image']['url']; ?>" alt="<?php echo $item['title']; ?>">
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>

			<!-- thankyou section shows after form submition  -->
			<div class="thankyou-section_diy" hidden >
				<h2 class="main-title"><?php echo $fields['thank_you_title']; ?></h2>
				<div class="o-layout">
					<div class="o-layout__item o-main  u-8/12@mobileLandscape">
						<?php echo get_post($pricelist_page_id)->post_content; ?>
						<a href="javascript:void(0);" class=" o-btn o-btn--orange js-overlay-close">Return to home</a>
					</div>
					<div class="o-layout__item o-side u-4/12@mobileLandscape">
						<img class="" src="<?php echo $fields['thank_you_side_image']['url']; ?>" data-custom-src="<?php echo $fields['thank_you_side_image']['url']; ?>">
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
