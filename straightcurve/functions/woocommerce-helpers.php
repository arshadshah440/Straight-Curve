<?php

// Add woocommerce support
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
	add_theme_support( 'woocommerce' );
}

// Remove woocommerce stylesheets
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// Remove woocommerce styles and scripts when not needed
add_action('wp_enqueue_scripts', 'site_woocommerce_scripts');
function site_woocommerce_scripts() {

	//remove generator meta tag
	remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );

	//first check that woo exists to prevent fatal errors
	if ( function_exists( 'is_woocommerce' ) ) {
	//dequeue scripts and styles is not woocommerce page
		if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
			// wp_dequeue_style( 'woocommerce_frontend_styles' );
			// wp_dequeue_style( 'woocommerce-general');
			// wp_dequeue_style( 'woocommerce-layout' );
			// wp_dequeue_style( 'woocommerce-smallscreen' );
			// wp_dequeue_style( 'woocommerce_fancybox_styles' );
			// wp_dequeue_style( 'woocommerce_chosen_styles' );
			// wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
			// wp_dequeue_style( 'select2' );
			// wp_dequeue_script( 'wc-add-payment-method' );
			// wp_dequeue_script( 'wc-lost-password' );
			// wp_dequeue_script( 'wc_price_slider' );
			// wp_dequeue_script( 'wc-single-product' );
			// wp_dequeue_script( 'wc-add-to-cart' );
			// wp_dequeue_script( 'wc-cart-fragments' );
			// wp_dequeue_script( 'wc-credit-card-form' );
			// wp_dequeue_script( 'wc-checkout' );
			// wp_dequeue_script( 'wc-add-to-cart-variation' );
			// wp_dequeue_script( 'wc-single-product' );
			// wp_dequeue_script( 'wc-cart' );
			// wp_dequeue_script( 'wc-chosen' );
			// wp_dequeue_script( 'woocommerce' );
			// wp_dequeue_script( 'prettyPhoto' );
			// wp_dequeue_script( 'prettyPhoto-init' );
			// wp_dequeue_script( 'jquery-blockui' );
			// wp_dequeue_script( 'jquery-placeholder' );
			// wp_dequeue_script( 'jquery-payment' );
			// wp_dequeue_script( 'fancybox' );
			// wp_dequeue_script( 'jqueryui' );
		} else {
			// wp_enqueue_script( 'wc-add-to-cart-variation' );
			// wp_enqueue_script('wc-single-product');
		}

		wp_enqueue_script( 'wc-add-to-cart-variation' );
		wp_enqueue_script('woo-ajax-add-to-cart');
	}

	// Check if 'wc-cart-fragments' script is already enqueued or registered
	if ( ! wp_script_is( 'wc-cart-fragments', 'enqueued' ) && wp_script_is( 'wc-cart-fragments', 'registered' ) ) {
		// Enqueue the 'wc-cart-fragments' script
		wp_enqueue_script( 'wc-cart-fragments' );
	}
}

// Ref: http://gregrickaby.com/remove-woocommerce-styles-and-scripts/

// Remove woocommerce widgets from admin dashboard
function site_remove_woocommerce_dashboard_widgets() {
	$remove_defaults_widgets = array(
		'woocommerce_dashboard_recent_reviews' => array(
			'page'    => 'dashboard',
			'context' => 'normal'
		)
	);

	foreach ( $remove_defaults_widgets as $widget_id => $options ) {
		remove_meta_box( $widget_id, $options['page'], $options['context'] );
	}

}
add_action('wp_dashboard_setup', 'site_remove_woocommerce_dashboard_widgets' );
?>