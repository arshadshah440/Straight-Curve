<?php

// Check if you are working on a local site
if (!function_exists('is_localhost')){
	/**
		 * @return boolean
	 */
	function is_localhost(){
    	$local = false;
		if (
			defined('LOCALHOST')
			|| substr($_SERVER['REMOTE_ADDR'], 0, 4) === '127.'
			|| substr($_SERVER['REMOTE_ADDR'], 0, 10) === '192.168.0.'
			|| $_SERVER['REMOTE_ADDR'] === '::1') {
				$local = true;
		}
		return $local;
	}
}

// Wordpress conditional to check page parent
if (!function_exists('is_child_of')) {
	function is_child_of($parentID) {
		global $post;
		return ($parentID === $post->post_parent);
	}
}

// Clean up junk from the header
remove_action( 'wp_head', 'rsd_link' ); // remove RSD link
remove_action( 'wp_head', 'wlwmanifest_link' ); // remove WLW manifest link
remove_action( 'wp_head', 'wp_generator' ); // remove the wordpress version

// Remove emojis
function disable_emojicons_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

function disable_wp_emojicons() {

	// all actions related to emojis
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

	// filter to remove TinyMCE emojis
	add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' );

//  Make internal links relative
function make_href_root_relative($input) {
	return preg_replace('!http(s)?://' . $_SERVER['SERVER_NAME'] . '/!', '/', $input);
}

if (!is_feed() && !is_admin()){
	add_filter( 'the_permalink', 'make_href_root_relative' );
	add_filter( 'category_link', 'make_href_root_relative' );
	add_filter( 'tag_link', 'make_href_root_relative' );
	add_filter( 'term_link', 'make_href_root_relative' );
}

// Add google analytics
if (!function_exists('insert_google_analytics') && !is_admin() && !is_localhost()) {
	function insert_google_analytics(){
		$account = GOOGLE_ANALYTICS;
	?>
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', '<?php echo $account; ?>', 'auto');
			ga('send', 'pageview');
		</script>
	<?php }
	add_action('wp_footer','insert_google_analytics');
}

// Add error log to error log file to debug
if(!function_exists('_log')){
	function _log( $message ) {
		if( WP_DEBUG === true ){
			if( is_array( $message ) || is_object( $message ) ){
				error_log( print_r( $message, true ) );
			} else {
				error_log( $message );
			}
		}
	}
}
?>