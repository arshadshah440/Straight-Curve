<?php

// Define some global variables site site url, css, js and other assets
define( 'URL', home_url() );
define( 'SITE', home_url() );
define( 'WP', site_url() );
define( 'STYLESHEET_URL', esc_url( get_stylesheet_directory_uri() ) );
define( 'CSS', STYLESHEET_URL.'/assets/css');
define( 'JS', STYLESHEET_URL.'/assets/js');
define( 'LIB', STYLESHEET_URL.'/assets/lib');
define( 'ASSETS', STYLESHEET_URL.'/assets');

// Website created by credit link
function credit_link() { ?>
	<a href="http://rockagency.com.au/" title="Visit this external site">Rock&nbsp;Agency</a>
<?php }

// Wordpress admin link
function login_link() { ?>
	<a title="Administer this website" href="<?php echo WP; ?>/wp-admin/" rel="nofollow">Login</a>
<?php }

function pagedNav() {
    global $wp_query;
    $total_pages = $wp_query->max_num_pages;
    if ($total_pages > 1){
        $current_page = max(1, get_query_var('paged'));
		echo '<div class="c-page-nav">';
		// For more options https://developer.wordpress.org/reference/functions/paginate_links/
		echo paginate_links(array(
			'base' => get_pagenum_link(1) . '%_%',
            'format' => '/page/%#%',
            'current' => $current_page,
            'total' => $total_pages,
			'mid_size' => 2,
			// 'show_all' => true,
			// 'prev_next' => false,
        ));
		echo '</div>';
    }
}

function site_excerpt_length( $length ) {
	return 100;
}

add_filter( 'excerpt_length', 'site_excerpt_length' );

function excerpt($id='', $limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = '<p>' . implode(" ", $excerpt).' ...&nbsp;</p>';
	} else {
		$excerpt = implode(" ",$excerpt);
	}
	$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	return $excerpt;
}

// Load svgicon from sprite
function svgicon($id='', $viewbox='0 0 32 32', $extraclasses='', $fallback='') {
	//Note that iOS Safari 6.0 doesn't like self-closing <use/>, so add separate closing tag to keep it valid XML.
	// xmlns necessary to give layout in IE8 (although we have dropped support for IE8 for H&A)
	$version = filemtime(get_stylesheet_directory() . '/assets/img/inline.svg'); ?>
	<svg viewBox="<?php echo $viewbox; ?>" xmlns="http://www.w3.org/2000/svg" version="1.1" class="c-svgicon c-svgicon--<?php echo $id; ?> <?php echo $extraclasses; ?>"><use xlink:href="<?php echo ASSETS; ?>/img/inline.svg?v=<?php echo $version; ?>#<?php echo $id; ?>"></use></svg>
	<?php if (!empty($fallback)) { ?>
		<span class="c-svgicon-fallback"><?php echo $fallback; ?></span>
	<?php }
}

function get_svgicon($id='', $viewbox='0 0 32 32', $extraclasses='', $fallback='') {
	ob_start();
	svgicon($id, $viewbox, $extraclasses, $fallback);
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}

// svg icon shortcode
function svgicon_shortcode ($atts) {
	extract( shortcode_atts( array(
		'id'            => '',
		'extraclasses'  => '',
		'fallback'      => '',
		'viewbox'     => '0 0 32 32'
	), $atts ) );
	$output = get_svgicon($id, $viewbox, $extraclasses, $fallback);
	return $output;
}
add_shortcode('svgicon', 'svgicon_shortcode');

// Add nav class depending on condition check for nav items when required
function special_nav_class($classes, $item){
	$args = array(
        'post_type' => 'page',
		'posts_per_page' => 1,
        'meta_key' => 'page_id',
		'meta_value' => 6 // solutions page google sheet id
	);
    $pages = get_posts( $args );
	if (isset($pages[0]->post_title) && $pages[0]->post_title === $item->title) {
		$classes[] = "solutions";
	}

	return $classes;
}
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

add_filter('wp_nav_menu_objects' , 'my_menu_class');
function my_menu_class($menu) {
    $level = 0;
    $stack = array('0');
    foreach($menu as $key => $item) {
        while($item->menu_item_parent != array_pop($stack)) {
            $level--;
        }
        $level++;
        $stack[] = $item->menu_item_parent;
        $stack[] = $item->ID;
        $menu[$key]->classes[] = 'level-'. ($level - 1);
    }
    return $menu;
}

// Lazyload images
function add_image_placeholders( $content ) {

	// Don't lazyload for feeds, previews, mobile
	if( is_feed() || is_preview() || is_admin() )
		return $content;

	// Don't lazy-load if the content has already been run through previously
	if ( false !== strpos( $content, 'data-src' ) )
		return $content;

	if (is_page_template('template-pages/tmpl-enquiry-success.php')) {
		return $content;
	}

	// In case you want to change the placeholder image
		$placeholder_image = ASSETS . '/img/2x1.trans.gif';

	// This is a pretty simple regex, but it works
		$content = preg_replace( '#<img([^>]+?)src=[\'"]?([^\'"\s>]+)[\'"]?([^>]*)>#', sprintf( '<img${1}src="%s" class="lazyload" data-src="${2}"${3}><noscript><img${1}src="${2}"${3}></noscript>', $placeholder_image ), $content );

	return $content;
}
add_filter( 'the_content', 'add_image_placeholders', 99 ); // run this later, so other content filters have run, including image_add_wh on WP.com
add_filter( 'post_thumbnail_html', 'add_image_placeholders', 11 );
add_filter( 'get_avatar', 'add_image_placeholders', 11 );

// Clear cache when saving ACF Fields
function site_clear_cache() {
	if ( isset($GLOBALS['zencache']) ) :
		$GLOBALS['zencache']->clear_cache();
	endif;
}
add_action('acf/save_post', 'site_clear_cache', 20);

// OEmbed markup
function responsive_wrap_oembed_dataparses( $html, $url, $data ) {

	$ar = $data['width'] / $data['height'];

	// Set the aspect ratio modifier
	$ar_mod = ( abs($ar-(4/3)) < abs($ar-(16/9)) ? 'o-fluid-object--4by3' : 'o-fluid-object--16by9');

	// Strip width and height from html
	$html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
	// Calculate aspect ratio


	return '<div class="o-fluid-object ' . $ar_mod . '" data-aspectratio="' . number_format($ar, 5, '.', '') . '">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'responsive_wrap_oembed_dataparses', 10, 3);

function stripString($string) {
	return preg_replace('![^a-z0-9]+!i', '-', strtolower( $string ));
}

?>