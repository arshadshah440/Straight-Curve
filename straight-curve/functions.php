<?php

/**
 * Straight Curve functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Straight_Curve
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function straight_curve_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Straight Curve, use a find and replace
		* to change 'straight-curve' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('straight-curve', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'straight-curve'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'straight_curve_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'straight_curve_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function straight_curve_content_width()
{
	$GLOBALS['content_width'] = apply_filters('straight_curve_content_width', 640);
}
add_action('after_setup_theme', 'straight_curve_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function straight_curve_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'straight-curve'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'straight-curve'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'straight_curve_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function straight_curve_scripts()
{
	wp_enqueue_style('straight-curve-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('straight-curve-style', 'rtl', 'replace');

	wp_enqueue_script('straight-curve-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'straight_curve_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}
/** disable gutenberg */

add_filter('use_block_editor_for_post', '__return_false', 10);
add_filter('use_block_editor_for_post_type', '__return_false', 10);


/*** svg enable */
function cc_mime_types($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


/** enqueue styles and script */

function my_theme_enqueue_styles()
{
	$enqueufiles = array(
		array('handle' => 'GlobalCss', 'src' => '/assets/css/Global.css', 'type' => 'style', 'dep' => array(), 'loc' => 'internal'),
		array('handle' => 'FontCss', 'src' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css', 'type' => 'style', 'dep' => array(), 'loc' => 'external'),
		array('handle' => 'HomeCss', 'src' => '/assets/css/Home.css', 'type' => 'style', 'dep' => array(), 'loc' => 'internal'),
		array('handle' => 'Queriescss', 'src' => '/assets/css/Queries.css', 'type' => 'style', 'dep' => array(), 'loc' => 'internal'),
		array('handle' => 'diycss', 'src' => '/assets/css/DIYgarden.css', 'type' => 'style', 'dep' => array(), 'loc' => 'internal'),
		array('handle' => 'headerCss', 'src' => '/assets/css/header.css', 'type' => 'style', 'dep' => array(), 'loc' => 'internal'),
		array('handle' => 'footercss', 'src' => '/assets/css/footer.css', 'type' => 'style', 'dep' => array(), 'loc' => 'internal'),
		array('handle' => 'appjs', 'src' => '/js/app.js', 'type' => 'script', 'dep' => array('jquery'), 'loc' => 'internal'),
		array('handle' => 'mainjs', 'src' => '/assets/js/main.js', 'type' => 'script', 'dep' => array('jquery'), 'loc' => 'internal'),
		array('handle' => 'landcss', 'src' => '/assets/css/landscape.css', 'type' => 'style', 'dep' => array(), 'loc' => 'internal'),
		array('handle' => 'owljs', 'src' => 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', 'type' => 'script', 'dep' => array('jquery'), 'loc' => 'external'),
		array('handle' => 'owlcss', 'src' => 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', 'type' => 'style', 'dep' => array(), 'loc' => 'external'),
	);

	foreach ($enqueufiles as $enfiles) {
		if ($enfiles['loc'] == 'internal') {
			$src = get_template_directory_uri() . $enfiles['src'];
			$ver = filemtime(get_template_directory() . $enfiles['src']);
		} else {
			$src = $enfiles['src'];
			$ver = '1.0.0';
		}
		$dep = $enfiles['dep'];
		error_log('Enqueuing ' . $enfiles['handle'] . ' from ' . $src);

		if ($enfiles['type'] == 'style') {
			wp_enqueue_style($enfiles['handle'], $src, $dep, $ver, 'all');
		} else {
			wp_enqueue_script($enfiles['handle'], $src, $dep, $ver, true);
		}
	}
}

add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');


add_action('acf/init', 'my_acf_op_init');

function my_acf_op_init()
{
	if (function_exists('acf_add_options_page')) {
		acf_add_options_page(array(
			'page_title'    => 'Theme General Settings',
			'menu_title'    => 'Theme Settings',
			'menu_slug'     => 'theme-general-settings',
			'capability'    => 'edit_posts',
			'redirect'      => false
		));

		acf_add_options_sub_page(array(
			'page_title'    => 'Theme Header Settings',
			'menu_title'    => 'Header',
			'parent_slug'   => 'theme-general-settings',
		));

		acf_add_options_sub_page(array(
			'page_title'    => 'Theme Footer Settings',
			'menu_title'    => 'Footer',
			'parent_slug'   => 'theme-general-settings',
		));
	}
}

// register custom menu
function register_custom_menu() {
    register_nav_menu('header_menu', __('Header Menu', 'straight-curve'));
}
add_action('init', 'register_custom_menu');


function get_svg_content($svg_file_path) {
    $svg_content = '';
    
    // Ensure the file exists before trying to read it
    if (file_exists($svg_file_path)) {
        $svg_content = file_get_contents($svg_file_path);
    }
    
    return $svg_content;
}

/**** check file extemiosn */
function getFileExtension($url) {
    // Parse the URL to get the path component
    $path = parse_url($url, PHP_URL_PATH);
    // Use pathinfo to get the file extension
    $extension = pathinfo($path, PATHINFO_EXTENSION);

    return $extension;
}

function isVideoFile($url) {
    // List of common video file extensions
    $videoExtensions = ['mp4', 'avi', 'mov', 'mkv', 'flv', 'wmv', 'webm', 'm4v'];

    // Get the file extension from the URL
    $extension = getFileExtension($url);

    // Check if the extension is in the list of video extensions
    return in_array(strtolower($extension), $videoExtensions);
}


