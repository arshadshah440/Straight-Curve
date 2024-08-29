<?php
	$free_products = get_field('free_products', 'options');
	$redirect_to_shop_for = array();
	if ($free_products && count($free_products) > 0) {
		foreach ($free_products as $item) {
			if (isset($item->ID)) {
				$redirect_to_shop_for[] = $item->ID;
			}
		}
	}
	if (isset($post->ID) && count($redirect_to_shop_for) > 0 && in_array($post->ID, $redirect_to_shop_for)) {
		header('Location: ' . SITE . '/shop');
	}
?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?> dir="ltr">

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- make IE render page content in highest IE mode available -->
    <title><?php wp_title(); ?> </title>

	<link rel="alternate" href="https://straightcurve.com/au/" hreflang="en-au" />
	<link rel="alternate" href="https://straightcurve.com/us/" hreflang="en-us" />
	<link rel="alternate" href="https://straightcurve.com/uk/" hreflang="en-gb" />
	<link rel="alternate" href="https://straightcurve.com/no/" hreflang="no-no" />
	<link rel="alternate" href="https://straightcurve.com/nl/" hreflang="nl-nl" />
	<link rel="alternate" href="https://straightcurve.com/au/" hreflang="x-default" />

	<?php if (!is_live()) : ?>
		<meta name="robots" content="none" />
		<meta name="robots" content="noindex" />
		<meta name="googlebot" content="none" />
		<meta name="googlebot" content="noindex" />
	<?php endif; ?>

	<?php if (is_live()) : ?>
		<!-- OneTrust Cookies Consent Notice start for straightcurve.com -->
		<script src="https://cdn-au.onetrust.com/scripttemplates/otSDKStub.js"  type="text/javascript" charset="UTF-8" data-domain-script="3ad8d1bd-4811-439b-97c6-458e8e1c7070" ></script>
		<script type="text/javascript">
		function OptanonWrapper() { }
		</script>
		<!-- OneTrust Cookies Consent Notice end for straightcurve.com -->
	<?php else : ?>
		<!-- OneTrust Cookies Consent Notice start for straightcurve.com -->
		<script type="text/javascript" src="https://cdn-au.onetrust.com/consent/3ad8d1bd-4811-439b-97c6-458e8e1c7070-test/OtAutoBlock.js" ></script>
		<script src="https://cdn-au.onetrust.com/scripttemplates/otSDKStub.js"  type="text/javascript" charset="UTF-8" data-domain-script="3ad8d1bd-4811-439b-97c6-458e8e1c7070-test" ></script>
		<script type="text/javascript">
		function OptanonWrapper() { }
		</script>
		<!-- OneTrust Cookies Consent Notice end for straightcurve.com -->
	<?php endif; ?>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="<?php echo AUTHOR; ?>">
    <meta name="siteurl" content="<?php echo URL; ?>" id="Siteurl">
    <meta name="themeurl" content="<?php echo STYLESHEET_URL; ?>" id="Themeurl">
    <meta name="ajaxurl" content="<?php echo admin_url('admin-ajax.php'); ?>" id="Ajaxurl">
    <meta name="blogid" content="<?php echo get_current_blog_id(); ?>" id="BlogId">
	<meta name="trustpilot-one-time-domain-verification-id" content="51cb2d02-660d-4449-8a54-35658bcdc24a"/>
	<meta name="google-site-verification" content="iB93HA0ZChO30T-yPI3z6znYx2Q-cOcerY5ItqCiMQ4" />

	<link rel="icon" href="<?php echo ASSETS; ?>/img/cropped-sc-fav-1-32x32.png" sizes="32x32">
	<link rel="icon" href="<?php echo ASSETS; ?>/img/cropped-sc-fav-1-192x192.png" sizes="192x192">
	<link rel="apple-touch-icon" href="<?php echo ASSETS; ?>/img/cropped-sc-fav-1-180x180.png">
	<meta name="msapplication-TileImage" content="<?php echo ASSETS; ?>/img/cropped-sc-fav-1-270x270.png">
    <!-- <link rel="icon" href="<?php echo STYLESHEET_URL; ?>/assets/img/favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo STYLESHEET_URL; ?>/assets/img/touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo STYLESHEET_URL; ?>/assets/img/touch-icon-ipad.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo STYLESHEET_URL; ?>/assets/img/touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo STYLESHEET_URL; ?>/assets/img/touch-icon-ipad-retina.png"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"> -->

    <?php wp_head(); ?>
	<script src="https://kit.fontawesome.com/57e4a87ca2.js" rel="preload" as="font" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="https://use.typekit.net/puy7rpt.css"> --><!-- halyard-display -->
	<link rel="stylesheet" href="https://use.typekit.net/zxc7zrf.css" rel="preload" as="font"><!-- canada-type-gibson && marydale -->
    <?php include('partials/inlinescripts.min.php'); ?>

	<?php if (is_front_page()) : ?>
		<?php if (current_site() === 'au') : ?>
			<script type="application/ld+json">
				{
					"@context": "http://schema.org",
					"@type": "Organization",
					"name": "Straightcurve",
					"description": "Level up your landscaping game and create the ultimate yard with garden edging that\u2019s designed for modern properties. Learn more about Straightcurve today.",
					"image": "https://strcurvestage.wpengine.com/wp-content/uploads/2021/05/straightcurve-logo-orange.svg",
					"logo": "https://strcurvestage.wpengine.com/wp-content/uploads/2021/05/straightcurve-logo-orange.svg",
					"url": "https://straightcurve.com/au/",
					"telephone": "(08) 9468 8904",
					"sameAs": ["https://au.linkedin.com/in/steel-edge-engineering","https://www.facebook.com/StraightcurveGardenEdge/","https://www.youtube.com/channel/UCNsJCA-YezohDY3fTmgJjaQ","https://www.instagram.com/straightcurvegardenedge/?hl=en"],
					"address": {
						"@type": "PostalAddress",
						"streetAddress": "Level 1/5 Barrel Way",
						"addressLocality": "Canning Vale",
						"postalCode": "6155",
						"addressCountry": "Australia"
					}
				}
			</script>
		<?php elseif (current_site() === 'us') : ?>
			<script type="application/ld+json">
				{
					"@context": "http://schema.org",
					"@type": "Organization",
					"name": "Straightcurve",
					"description": "Level up your landscaping game and create the ultimate yard with garden edging that\u2019s designed for modern properties. Learn more about Straightcurve today.",
					"image": "https://strcurvestage.wpengine.com/wp-content/uploads/2021/05/straightcurve-logo-orange.svg",
					"logo": "https://strcurvestage.wpengine.com/wp-content/uploads/2021/05/straightcurve-logo-orange.svg",
					"url": "https://straightcurve.com/us/",
					"telephone": "540-219-1758",
					"sameAs": ["https://www.facebook.com/StraightcurveGardenEdge/","https://www.youtube.com/channel/UCNsJCA-YezohDY3fTmgJjaQ","https://www.instagram.com/straightcurvegardenedge/?hl=en"],
					"address": {
						"@type": "PostalAddress",
						"streetAddress": "PO Box 8143",
						"addressLocality": "Charlottesville",
						"postalCode": "22906",
						"addressCountry": "USA"
					}
				}
			</script>
		<?php endif; ?>
	<?php endif; ?>

	<?php if (current_site() === 'au' && is_checkout() && !empty( is_wc_endpoint_url('order-received'))) : ?>
		<!-- Event snippet for Form Submission conversion page --> <script> gtag('event', 'conversion', {'send_to': 'AW-718834143/MHatCOjvhpUZEN-T4tYC'}); </script>
	<?php endif; ?>

	<style>
		<?php if (isset($free_products['free_spike']->ID)) : ?>
			.mini_cart_item[data-product="<?php echo $free_products['free_spike']->ID; ?>"],
			.cart_item[data-product="<?php echo $free_products['free_spike']->ID; ?>"] {
				display: none !important;
			}
		<?php endif; ?>
		<?php if (isset($free_products['free_peg']->ID)) : ?>
			.mini_cart_item[data-product="<?php echo $free_products['free_peg']->ID; ?>"],
			.cart_item[data-product="<?php echo $free_products['free_peg']->ID; ?>"] {
				display: none !important;
			}
		<?php endif; ?>
		<?php if (isset($free_products['free_peg_galvanised']->ID)) : ?>
			.mini_cart_item[data-product="<?php echo $free_products['free_peg_galvanised']->ID; ?>"],
			.cart_item[data-product="<?php echo $free_products['free_peg_galvanised']->ID; ?>"] {
				display: none !important;
			}
		<?php endif; ?>
	</style>
</head>
<?php
	$body_class = '';

	$show_nav = array(
		'main_nav' => true,
		'green_bar' => true,
		'green_bar_nav' => true,
		'country_selector' => true,
	);

	$page_settings = get_field('page_settings');
	if (isset($page_settings['header_footer_options'][0])) {
		$show_nav['main_nav'] = !(isset($page_settings['header_footer_options'][0]) && in_array('Hide main navigation', $page_settings['header_footer_options']));
		$show_nav['green_bar'] = !(isset($page_settings['header_footer_options'][0]) && in_array('Hide green bar', $page_settings['header_footer_options']));
		$show_nav['green_bar_nav'] = !(isset($page_settings['header_footer_options'][0]) && in_array('Hide green bar navigation', $page_settings['header_footer_options']));
		$show_nav['country_selector'] = !(isset($page_settings['header_footer_options'][0]) && in_array('Hide country selector', $page_settings['header_footer_options']));
		$show_nav['label_link'] = isset($page_settings['header_footer_options'][0]) && in_array('Add navigation label / link', $page_settings['header_footer_options']) && isset($page_settings['navigation_label_link']['link']['url']);

		if ($show_nav['label_link']) {
			$show_nav['main_nav'] = false;
		}
	}
?><body <?php body_class($body_class); ?>>
	<?php $gc = get_field('general_content', 'options'); ?>

	<?php if (get_current_blog_id() === 1) : ?>
		<div class="c-redirect-screen">
			<div class="c-redirect-screen__content">
				<i class="fas fa-cog fa-spin"></i>
				<h1>Redirecting to your local&nbsp;site</h1>
			</div>
		</div>
	<?php endif; ?>

    <?php
		$alt_top = false;
		if (current_site() === 'uk' || current_site() === 'au' || current_site() === 'nl' || (current_site() === 'us' && !is_live())) {
			$alt_top = true;
		}

		$top_bar = get_field('top_bar', 'options');
		$header_reviews = get_field('header_reviews', 'options');

		$has_top_bar = $show_nav['green_bar'] && isset($top_bar['links'][0]['link']['url']) ? true : false;

		$top_class = '';
		$top_class .= $alt_top ? ' alt-style' : '';
		$top_class .= $has_top_bar ? ' has-top-bar' : '';
	?><div class="c-top <?php echo $top_class; ?>">

		<?php if ($has_top_bar) : ?>
			<div class="c-top__bar">
				<div class="o-wrapper">
					<?php if ($show_nav['green_bar_nav']) : ?>
						<ul class="c-top__bar-links">
							<?php foreach ($top_bar['links'] as $item) :
								if (isset($item['link']['url'])) : ?>
									<li><a href="<?php echo $item['link']['url']; ?>" target="<?php echo $item['link']['target']; ?>"><?php echo $item['link']['title']; ?></a></li>
								<?php endif;
							endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>

		<div class="o-wrapper">
        	<header class="c-header">
                <a href="#Main" class="c-skip">Skip to main content</a>
                <div class="mainHeader d-flex row-wrap space-between align-items-center">
                    <div class="logo">
						<?php if(!is_front_page()):?><a href="<?php echo site_url(); ?>"><?php endif; ?>
							<?php svgicon('logo', '0 0 225 35'); ?>
                        <?php if(!is_front_page()):?></a><?php endif; ?>

						<?php if (isset($header_reviews[0]['review']) && $header_reviews[0]['review']) : ?>
							<div class="logo-review">
								<span class="logo-review-icon"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></span>
								<span class="logo-review-text">“<?php echo $header_reviews[0]['review']; ?>”</span>
							</div>
						<?php endif; ?>
                    </div>
                    <nav class="c-site-nav mainNav d-flex row-wrap align-items-center" role="navigation">

						<?php if (isset($page_settings['right_nav_phone']['phone']) && $page_settings['right_nav_phone']['phone']) : ?>
							<a href="tel:<?php echo $page_settings['right_nav_phone']['phone']; ?>" class="c-header__phone">
								<?php if ($page_settings['right_nav_phone']['label']) : ?>
									<span class="label"><?php echo $page_settings['right_nav_phone']['label']; ?></span>
								<?php endif; ?>
								<span class="phone"><i class="fa fa-solid fa-phone"></i><?php echo $page_settings['right_nav_phone']['phone']; ?></span>
							</a>
						<?php endif; ?>

						<?php if ($show_nav['main_nav']) : ?>
							<div class="c-nav-wrap">
								<?php get_template_part('partials/nav'); ?>
							</div>
							<?php if ( !disable_shop() && (current_site() === 'uk' || (current_site() === 'au' && !is_live()) || current_site() === 'nl') || (current_site() === 'us' && !is_live()) ) : ?>
								<a href="javascript:void(0);" class="c-header__cart js-open-minicart"><i class="fal fa-shopping-cart"></i></a>
							<?php endif; ?>
							<?php if (!$alt_top) : ?>
								<a href="javascript:void(0);" class="c-header__pricelist o-btn js-show-pricelist"><?php echo $gc['header_price_list_button_label'] ? $gc['header_price_list_button_label'] : 'Get a price list'; ?></a>
							<?php endif; ?>
						<?php endif; ?>

						<?php if (isset($show_nav['label_link']) && $show_nav['label_link']) : ?>
							<a href="<?php echo $page_settings['navigation_label_link']['link']['url']; ?>" target="<?php echo $page_settings['navigation_label_link']['link']['target']; ?>" class="c-header__phone">
								<?php if ($page_settings['navigation_label_link']['label']) : ?>
									<span class="label"><?php echo $page_settings['navigation_label_link']['label']; ?></span>
								<?php endif; ?>
								<span class="phone"><?php
									echo (substr( $page_settings['navigation_label_link']['link']['url'], 0, 4 ) === "tel:" ? '<i class="fa fa-solid fa-phone"></i>' : '');
									echo $page_settings['navigation_label_link']['link']['title'];
								?></span>
							</a>
						<?php endif; ?>

						<?php if ($show_nav['country_selector']) : ?>
							<a href="javascript:void(0);" class="c-header__site-switcher js-switch-site <?php echo current_site(); ?>"></a>
							<ul class="c-header__sites is-hidden">
								<?php if(is_multisite()){ ?>
								<?php foreach (get_sites() as $item) :
									$current = '';
									if (get_current_blog_id() == $item->blog_id) {
										$current = 'is-active';
									}
									if ($item->blog_id !== '1') :
									$details = get_blog_details($item->blog_id) ?>
									<li><a href="<?php echo $details->siteurl; ?>" class="<?php echo str_replace('/', '', $details->path); ?> <?php echo $current; ?>"><?php echo $details->blogname; ?></a></li>
								<?php endif; endforeach; }?>
							</ul>
						<?php endif; ?>
                    </nav>
					<?php if (!isset($hide_nav) || !$hide_nav) : ?>
						<a href="javascript:void(0);"  class="c-header__nav-toggle"><span></span></a>
					<?php endif; ?>
                </div>
            </div>
        </header>
    </div>
	<div class="c-top--spacer"></div>


	<?php $cookies = get_field('cookies', 'options'); ?>
	<?php if (1 === 2 && !is_live() && isset($cookies['is_active']) && $cookies['is_active']) : ?>
		<div class="c-cookies" hidden>
			<div class="c-cookies__container">
				<div class="c-cookies__content">
					<?php svgicon('cookie', '0 0 53 53'); ?>
					<h2 class="c-cookies__title"><?php echo $cookies['title']; ?></h2>
					<p><?php echo $cookies['text']; ?></p>
				</div>
				<div class="c-cookies__buttons">
					<?php if (isset($cookies['policy_button']['url'])) : ?>
						<a href="<?php echo $cookies['policy_button']['url']; ?>" target="<?php echo $cookies['policy_button']['target']; ?>" class="o-btn o-btn--noarrow o-btn--white o-btn--outline"><?php echo $cookies['policy_button']['title']; ?></a>
					<?php endif; ?>
					<a href="javascript:void(0);" class="o-btn o-btn--noarrow o-btn--orange js-accept-cookies"><?php echo ($cookies['accept_button_label'] ? $cookies['accept_button_label'] : 'Accept All'); ?></a>
				</div>
			</div>
		</div>
	<?php endif; ?>

<?php
	$content_class = '';
	$show_message = false;
	if (is_woocommerce() || is_cart() || is_checkout()) {
		$disable_shop = get_field('disable_shop', 'options');
		$content_class .= ' woo-comm-page';
		if (disable_shop()) {
			$show_message = true;
			$content_class .= ' woo-closed';
		}
	}
	if (is_shop() && current_site() === 'uk' && !is_pro_user()) {
		$show_message = true;
		$content_class .= ' woo-closed';
	}
?>
<div class="c-content <?php echo $content_class; ?>">
	<?php if (current_site() !== 'nl') : ?>
		<?php get_template_part('partials/shop-header'); ?>
	<?php endif; ?>

	<?php if (!current_user_can('editor') && !current_user_can('administrator')) : ?>
		<?php if ((disable_shop() && (is_woocommerce() || is_cart() || is_checkout())) || $show_message) : ?>
			<div class="woo-closed-msg">
				<div class="woo-closed-msg__content">
					<?php if ($disable_shop['message']) : ?>
						<?php echo $disable_shop['message']; ?>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
	<?php endif; ?>
