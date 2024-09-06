<?php

define('GOOGLE_ANALYTICS', '');
include('functions/boilerplate.php');
include('functions/admin-config.php');
include('functions/upload-users.php');
include('functions/theme-helpers.php');
include('functions/clean-gallery.php');
include('functions/acf-config.php');
include('functions/shortcodes.php');
include('functions/ajax-func.php');
include('functions/api-routes.php');
include('functions/woocommerce-helpers.php');
include('functions/woocommerce-customisation.php');
if (current_site() === 'au') {
    include('functions/woo-stock.php');
}
include get_template_directory() . '/admin/quotewithoutpayment.php';


// Author meta tag
define('AUTHOR', 'Straightcurve');

// array of pages with defined in Google Sheet
define('SHEET_PAGES', get_pages_by_sheet_id());

// Enable post thumbnails
add_theme_support('post-thumbnails');

// Enable nav menus
add_theme_support('nav-menus');

// Custom image sizes
add_image_size('preview', 300, 200, false);
add_image_size('preview small', 100, 65, false);

// make custom image size choosable from add media
add_filter('image_size_names_choose', 'site_custom_sizes');
function site_custom_sizes($sizes)
{
    return array_merge(
        $sizes,
        array(
            'preview' => 'Preview',
        )
    );
}

// For development
// show_admin_bar(!is_localhost() && is_user_logged_in());

// Register nav menus
function register_site_menus()
{
    register_nav_menu('primary-menu', 'Primary Menu');
    register_nav_menu('quote-menu', 'Quote Page Menu');
}
add_action('after_setup_theme', 'register_site_menus');

// Register widget areas
function site_widgets_init()
{
    // Register main sidebar
    register_sidebar(
        array(
            'name' => 'Sidebar Widget Area',
            'id' => 'aside-sidebar',
            'description' => 'Widget in this area will be shown in sidebar area on all pages',
            'before_widget' => '<section id="%1$s" class="c-widget c-widget--side %2$s %1$s"><div class="c-widget__content">',
            'after_widget' => '</div></section>',
            'before_title' => '<h3 class="c-widget__heading">',
            'after_title' => '</h3>'
        )
    );

    // Register footer sidebar
    register_sidebar(
        array(
            'name' => 'Footer Widget Area',
            'id' => 'footer-sidebar',
            'description' => 'Widget in this area will be shown in footer area on all pages',
            'before_widget' => '<section id="%1$s" class="c-widget c-widget--footer %2$s %1$s"><div class="c-widget__content">',
            'after_widget' => '</div></section>',
            'before_title' => '<h3 class="c-widget__heading">',
            'after_title' => '</h3>'
        )
    );
}
add_action('widgets_init', 'site_widgets_init');

// Remove contact from styles from all pages
add_filter('wpcf7_load_js', '__return_false');
add_filter('wpcf7_load_css', '__return_false');

// Load scripts using wp's enqueue
function site_scripts()
{
    if (!is_admin()) {
        // Remove jquery that wordpress includes
        wp_deregister_script('jquery');
        $site_js = (is_localhost()) ? '/assets/js/dist/site.js' : '/assets/js/dist/site.min.js';
        $site_css = (is_localhost()) ? '/assets/css/screen.dev.css' : '/assets/css/screen.min.css';

        // Include all js including jQuery and register with name 'jquery' so other jquery dependable scripts load as well
        wp_enqueue_script('jquery', STYLESHEET_URL . $site_js, false, filemtime(get_stylesheet_directory() . $site_js), false);
        wp_enqueue_style('site', STYLESHEET_URL . $site_css, false, filemtime(get_stylesheet_directory() . $site_css));
    }
}
add_action('wp_enqueue_scripts', 'site_scripts');

// Boolean to check if the cf7 scripts are required
function load_cf7_scripts()
{
    return (is_page('contact'));
}

// Check if staging or test enviroment
function is_local_or_staging()
{
    if ($_SERVER['SERVER_ADDR'] == '103.27.32.31' || $_SERVER['SERVER_ADDR'] == '127.0.0.1') {
        return true;
    } else {
        return false;
    }
}

// For Debugging
function ra_console_log($data)
{
    echo '<script>';
    echo 'console.log(' . json_encode($data) . ')';
    echo '</script>';
}

// Load cf7 scripts if required
function site_load_cf7_scripts()
{
    if (load_cf7_scripts()) {
        if (function_exists('wpcf7_enqueue_scripts')) {
            wpcf7_enqueue_scripts();
        }
        // Not loading wpcf7 styles at all, if you need wpcf7 styles uncomment below lines
        // if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
        //   wpcf7_enqueue_styles();
        // }
    }
}
add_action('wp', 'site_load_cf7_scripts');

// Allow search to search through pages and posts. Add any custom post type in array to search by them as well.
function site_search($query)
{
    if (!is_admin() && $query->is_search) {
        $query->set('post_type', array('page', 'post'));
    }
    return $query;
}
add_filter('pre_get_posts', 'site_search');

// REMOVE GUTTENBURG
// disable for posts
add_filter('use_block_editor_for_post', '__return_false', 10);

// disable for post types
add_filter('use_block_editor_for_post_type', '__return_false', 10);

function load_template_part($template_name, $var = null, $is_woo = false)
{
    ob_start();

    if ($var) {
        set_query_var('var', $var);
    }
    if ($is_woo) {
        wc_get_template_part($template_name);
    } else {
        get_template_part($template_name);
    }
    $res = ob_get_contents();
    ob_end_clean();
    return $res;
}

//enqueue admin style
function enqueue_admin_style()
{
    if (is_admin()) {
        wp_enqueue_style('custom-admin-style', get_stylesheet_directory_uri() . '/assets/adminCss/custom-admin-style.css');
    }
}
add_action('init', 'enqueue_admin_style');

//enqueue admin script
function add_custom_script_for_admin()
{
    //wp_register_script( 'some-js', get_template_directory_uri().'/lib/js/custom.js', array('jquery-core'), false, true );
    wp_register_script('custom-admin-js', get_stylesheet_directory_uri() . '/assets/adminJs/custom-admin-js.js');
    wp_enqueue_script('custom-admin-js');
}
add_action('admin_enqueue_scripts', 'add_custom_script_for_admin');


// automatically select parent when sub cats are selected
add_action('save_post', 'assign_parent_terms', 10, 2);
function assign_parent_terms($post_id, $post)
{
    // $arrayPostTypeAllowed = array('product');
    //$arrayTermsAllowed = array('product_cat', 'brand');
    $arrayPostTypeAllowed = array('solutions');
    $arrayTermsAllowed = array('solutions_categories');
    //Check post type
    if (!in_array($post->post_type, $arrayPostTypeAllowed)) {
        return $post_id;
    } else {
        // get all assigned terms
        foreach ($arrayTermsAllowed as $t_name) {
            $terms = wp_get_post_terms($post_id, $t_name);
            foreach ($terms as $term) {
                while ($term->parent != 0 && !has_term($term->parent, $t_name, $post)) {
                    // move upward until we get to 0 level terms
                    wp_set_post_terms($post_id, array($term->parent), $t_name, true);
                    $term = get_term($term->parent, $t_name);
                }
            }
        }
    }
}


//Default ACF image
add_action('acf/render_field_settings/type=image', 'add_default_value_to_image_field', 20);
function add_default_value_to_image_field($field)
{
    $args = array(
        'label' => 'Default Image',
        'instructions' => 'Appears when creating a new post',
        'type' => 'image',
        'name' => 'default_value'
    );
    acf_render_field_setting($field, $args);
}

add_action('admin_enqueue_scripts', 'enqueue_uploader_for_image_default');
function enqueue_uploader_for_image_default()
{
    $screen = get_current_screen();
    if ($screen && $screen->id && ($screen->id == 'acf-field-group')) {
        acf_enqueue_uploader();
    }
}

add_filter('acf/load_value/type=image', 'reset_default_image', 10, 3);
function reset_default_image($value, $post_id, $field)
{
    if (!$value && isset($field['default_value'])) {
        $value = $field['default_value'];
    }
    return $value;
}





function get_user_types()
{
    $user_types = [];
    $query = new WP_Query(
        array(
            'post_status' => 'publish',
            'orderby' => array(
                'menu_order' => 'ASC',
                'publish_date' => 'DESC',
            ),
        )
    );

    if ($query->have_posts()):
        while ($query->have_posts()):
            $query->the_post();
            $user_type = get_field('user_type', get_the_ID());
            if ($user_type) {
                $user_types[$user_type->slug] = $user_type;
            }
        endwhile;
    endif;
    wp_reset_postdata();

    return $user_types;
}


function blog_post_gallery_item($id, $featured = false, $lazyload = true)
{

    $title = get_the_title($id);
    $estimated_time = get_field('estimated_time', $id);
    $date = get_the_date('F j Y', $id);
    $item_class = 'blog-item';
    $image_url = get_the_post_thumbnail_url($id, 'large');
    $cats = get_the_category($id);
    $user_type = get_field('user_type', $id);
    $feature_on_blog = get_field('feature_on_blog', $id);
    $is_popular = get_field('is_popular', $id);
    $link = get_permalink($id);
    $gc = get_field('general_content', 'options');

    if ($featured) {
        $item_class .= ' blog-featured';
    }

    $return_str = "<a href='$link' class='$item_class'>";

    if (!$featured) {
        if ($lazyload) {
            $return_str .= "<div class='blog-item-thumbnail lazyload' data-src='$image_url'>";
        } else {
            $return_str .= "<div class='blog-item-thumbnail' style='background-image: url($image_url)'>";
        }

        $return_str .= "<div class='blog-item-tags'>";
        if ($user_type) {
            $return_str .= "<span class='green' data-tag-filter-user-type='$user_type->slug'>$user_type->name</span>";
        }
        foreach ($cats as $cat) {
            if ($cat->slug !== 'uncategorised' && $cat->slug !== 'uncategorized') {
                $return_str .= "<span class='orange' data-tag-filter-category='$cat->slug'>$cat->name</span>";
            }
        }
        $return_str .= "</div>";

        $return_str .= "</div>";
    }
    $return_str .= "<div class='blog-item-details'>";
    $return_str .= "<div class='blog-item-meta'>";
    // $return_str .= "<div class='blog-item-date'>$date</div>";
    if (!empty($estimated_time)) {
        $return_str .= "<div class='blog-item-estimate'>$estimated_time " . ($gc['blog_estimate_suffix'] ? $gc['blog_estimate_suffix'] : "minutes") . "</div>";
    }
    $return_str .= "</div>";
    $return_str .= "<h3 class='blog-item-title'>$title</h3>";
    if ($featured) {
        $excerpt = wp_filter_nohtml_kses(get_the_excerpt());

        $excerptChars = 220;
        if (strlen($excerpt) > $excerptChars) {
            $excerpt = explode("\n", wordwrap($excerpt, $excerptChars));
            $excerpt = $excerpt[0] . '...';
        }

        $return_str .= "<div class='blog-item-excerpt'>$excerpt</div>";
    }
    $return_str .= "<span class='blog-item-read'>" . ($gc['blog_card_read_more'] ? $gc['blog_card_read_more'] : 'Read more') . "</span>";
    $return_str .= "</div>";
    if ($featured) {
        $return_str .= "<div class='blog-item-thumbnail' style='background-image: url($image_url)'>";

        $return_str .= "<div class='blog-item-tags'>";
        if ($user_type) {
            $return_str .= "<span class='green' data-tag-filter-user-type='$user_type->slug'>$user_type->name</span>";
        }
        foreach ($cats as $cat) {
            if ($cat->slug !== 'uncategorised' && $cat->slug !== 'uncategorized') {
                $return_str .= "<span class='orange' data-tag-filter-category='$cat->slug'>$cat->name</span>";
            }
        }
        $return_str .= "</div>";

        $return_str .= "</div>";
    }

    $return_str .= "</a>";
    return $return_str;
}




add_shortcode('blog_post_search_results', 'blog_post_search_results');
function blog_post_search_results()
{
    $filter_category = isset($_GET["category"]) && $_GET["category"] !== "0" ? $_GET["category"] : null;
    $filter_user_type = isset($_GET["user-type"]) && $_GET["user-type"] !== "0" ? $_GET["user-type"] : null;

    $return_str = '';
    $posts_args = array(
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => array(
            'publish_date' => 'DESC',
        ),
    );

    if ($filter_category) {
        $posts_args['category_name'] = $filter_category;
    }
    if ($filter_user_type) {
        $user_type = null;
        $user_types = get_user_types();
        if (gettype($user_types) === 'array' && count($user_types) > 0) {
            foreach ($user_types as $key => $value) {
                if ($value->slug === $filter_user_type) {
                    $user_type = $value;
                }
            }
        }

        if (isset($user_type->term_id)) {
            $posts_args['meta_query'] = array(
                array(
                    'key' => 'user_type',
                    'value' => $user_type->term_id,
                    'compare' => '='
                )
            );
        }
    }


    $query = new WP_Query($posts_args);

    if ($query->have_posts()):
        while ($query->have_posts()):
            $query->the_post();
            $id = get_the_ID();
            $return_str .= blog_post_gallery_item($id, false);
        endwhile;
    else:
        $return_str .= 'No posts found matching this filter';
    endif;
    wp_reset_postdata();

    return $return_str;
}



$GLOBALS["featured_blog_id"] = false;
$GLOBALS["popular_blog_ids"] = [];

add_shortcode('featured_blog_post', 'featured_blog_post');
function featured_blog_post()
{
    $return_str = '';
    $query = new WP_Query(
        array(
            'posts_per_page' => 1,
            'post_status' => 'publish',
            'orderby' => 'publish_date',
            'order' => 'DESC',
            'meta_query' => array(
                array(
                    'key' => 'feature_on_blog',
                    'value' => true,
                    'compare' => '=',
                ),
            ),
        )
    );

    if ($query->have_posts()):

        while ($query->have_posts()):
            $query->the_post();
            $GLOBALS["featured_blog_id"] = get_the_ID();
            $return_str .= blog_post_gallery_item(get_the_ID(), true);
        endwhile;

    endif;
    wp_reset_postdata();

    return $return_str;
}


add_shortcode('popular_blog_posts', 'popular_blog_posts');
function popular_blog_posts()
{
    $GLOBALS["popular_blog_ids"] = [];
    $return_str = '';
    $query = new WP_Query(
        array(
            'posts_per_page' => 6,
            'post_status' => 'publish',
            'orderby' => 'publish_date',
            'order' => 'DESC',
            //         'post__not_in' => array($GLOBALS["featured_blog_id"]),
            'meta_query' => array(
                array(
                    'key' => 'is_popular',
                    'value' => true,
                    'compare' => '=',
                ),
            ),
        )
    );

    if ($query->have_posts()):
        $return_str .= '<div class="c-popular-blogs">';
        while ($query->have_posts()):
            $query->the_post();
            $GLOBALS["popular_blog_ids"][] = get_the_ID();
            $return_str .= blog_post_gallery_item(get_the_ID(), false, false);
        endwhile;
        $return_str .= '</div>';
    endif;
    wp_reset_postdata();

    return $return_str;
}

add_shortcode('recent_blog_posts', 'recent_blog_posts');
function recent_blog_posts()
{
    $return_str = '<div class="c-recent-blogs">';
    $query = new WP_Query(
        array(
            'posts_per_page' => 4,
            'orderby' => 'publish_date',
            'order' => 'DESC',
            'post__not_in' => array_merge(array($GLOBALS["featured_blog_id"]), $GLOBALS["popular_blog_ids"]),
            'post_status' => 'publish',
        )
    );

    if ($query->have_posts()):

        while ($query->have_posts()):
            $query->the_post();
            $return_str .= blog_post_gallery_item(get_the_ID());
        endwhile;

    endif;
    wp_reset_postdata();
    $return_str .= "</div>";
    return $return_str;
}



/**
 *  Video Gallery Shortcode
 */

function video_gallery()
{

    $output = "";

    $grouped = get_field('group_videos');

    if (!$grouped): // If videos are not set to be in groups
        $videoList = get_field('videos');
        if ($videoList):

            $output .= '<div class="video-gallery">';
            foreach ($videoList as $video):
                $title = get_the_title($video->ID);
                $thumbnail = get_field('video_thumbnail', $video->ID);
                $description = get_field('brief_description', $video->ID);
                $videohost = get_field('video_location', $video->ID);
                $videourl = get_field('youtube_url', $video->ID);
                if ($videohost === 'self') {
                    $videourl = get_field('video_file', $video->ID);
                    $videourl = $videourl['url'];
                }

                $output .= '<div class="video-card">';
                $output .= '<a data-fancybox href="' . $videourl . '">';
                $output .= '<div class="thumb-wrapper"><img class="vid-thumb" src="' . $thumbnail['url'] . '" alt="' . $thumbnail['alt'] . '" /></div>';
                // $output .= '</a>';
                // $output .= '<a data-fancybox href="' . $videourl . '">';
                $output .= '<h3>' . $title . '</h3>';
                $output .= '</a>';
                $output .= '<p class="vid-desc">' . $description . '</p>';
                $output .= '</div>';
            endforeach;
            $output .= '</div>';

        endif;

    else:
        $videoGroups = get_field('video_group');

        foreach ($videoGroups as $group):
            $output .= '<h3 class="group">' . $group['group_label'] . '</h3>';
            $output .= '<div class="video-gallery">';
            foreach ($group['videos'] as $video):
                $title = get_the_title($video->ID);
                $thumbnail = get_field('video_thumbnail', $video->ID);
                $description = get_field('brief_description', $video->ID);
                $videohost = get_field('video_location', $video->ID);
                $videourl = get_field('youtube_url', $video->ID);
                if ($videohost === 'self') {
                    $videourl = get_field('video_file', $video->ID);
                    $videourl = $videourl['url'];
                }

                $output .= '<div class="video-card">';
                $output .= '<a data-fancybox href="' . $videourl . '">';
                $output .= '<div class="thumb-wrapper"><img class="vid-thumb" src="' . $thumbnail['url'] . '" alt="' . $thumbnail['alt'] . '" /></div>';
                // $output .= '</a>';
                // $output .= '<a data-fancybox href="' . $videourl . '">';
                $output .= '<h3>' . $title . '</h3>';
                $output .= '</a>';
                $output .= '<p class="vid-desc">' . $description . '</p>';
                $output .= '</div>';
            endforeach;
            $output .= '</div>';
        endforeach;

    endif;

    return $output;
}
add_shortcode('video_gallery', 'video_gallery');


//Return the id of the page based on the template used (first page id if multi page using the same template)
function get_page_id_by_template($template = "page")
{
    $args = [
        'post_type' => 'page',
        'fields' => 'ids',
        'nopaging' => true,
        'meta_key' => '_wp_page_template',
        'meta_value' => $template
    ];

    $pages = get_posts($args);
    foreach ($pages as $page)
        return $page;
}



function current_site()
{
    // $current = get_blog_details()->path;
    if (is_multisite()) {
        $current = get_blog_details()->path;
    } else {
        $current = get_option('siteurl');
    }
    return str_replace('/', '', $current);
}

function get_pages_by_sheet_id()
{
    $args = array(
        'post_type' => 'page',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'page_id',
                'compare' => 'EXISTS'
            )
        )
    );
    $get_pages = get_posts($args);
    $sheet_pages = array();
    foreach ($get_pages as $page) {
        $page_id = get_field('page_id', $page->ID);
        if (!empty($page_id)) {
            $sheet_pages[$page_id] = array(
                'id' => $page->ID,
                'parent' => $page->post_parent,
                'title' => $page->post_title,
                'url' => get_the_permalink($page->ID)
            );
        }
    }
    return $sheet_pages;
}

function is_live()
{
    $is_live = false;
    $host = $_SERVER['HTTP_HOST'];
    if ($host == "www.straightcurve.com" || $host == "straightcurve.com") {
        $is_live = true;
    }
    return $is_live;
}

function disable_shop()
{
    $disable_shop = get_field('disable_shop', 'options');
    $result = false;
    if ($disable_shop['disable']) {
        $result = true;
    }
    if (current_site() === 'au' && !is_dealer_user() && !is_pro_user()) {
        $result = true;
    }
    if (current_user_can('editor') || current_user_can('administrator')) {
        $result = false;
    }
    return $result;
}

function is_pro_user()
{
    $result = false;
    if (is_user_logged_in()) {
        $user = wp_get_current_user();
        if (isset($user->roles) && count($user->roles) > 0 && in_array('customer_professionals', $user->roles)) {
            $result = true;
        }
    }
    return $result;
}

function is_dealer_user()
{
    $result = false;
    if (is_user_logged_in()) {
        $user = wp_get_current_user();
        if (isset($user->roles) && count($user->roles) > 0 && in_array('customer_dealer', $user->roles)) {
            $result = true;
        }
    }
    return $result;
}





// Allow admin to edit users in multisite setup
function mc_admin_users_caps($caps, $cap, $user_id, $args)
{
    foreach ($caps as $key => $capability) {
        if ($capability != 'do_not_allow')
            continue;
        switch ($cap) {
            case 'edit_user':
            case 'edit_users':
                $caps[$key] = 'edit_users';
                break;
            case 'delete_user':
            case 'delete_users':
                $caps[$key] = 'delete_users';
                break;
            case 'create_users':
                $caps[$key] = $cap;
                break;
        }
    }

    return $caps;
}
add_filter('map_meta_cap', 'mc_admin_users_caps', 1, 4);
remove_all_filters('enable_edit_any_user_configuration');
add_filter('enable_edit_any_user_configuration', '__return_true');

// Checks that both the editing user and the user being edited are members of the blog and prevents the super admin being edited.
function mc_edit_permission_check()
{
    global $current_user, $profileuser;
    $screen = get_current_screen();
    get_currentuserinfo();
    if (!is_super_admin($current_user->ID) && in_array($screen->base, array('user-edit', 'user-edit-network'))) { // editing a user profile
        if (is_super_admin($profileuser->ID)) { // trying to edit a superadmin while less than a superadmin
            wp_die(__('You do not have permission to edit this user.'));
        } elseif (!(is_user_member_of_blog($profileuser->ID, get_current_blog_id()) && is_user_member_of_blog($current_user->ID, get_current_blog_id()))) { // editing user and edited user aren't members of the same blog
            wp_die(__('You do not have permission to edit this user.'));
        }
    }
}
add_filter('admin_head', 'mc_edit_permission_check', 1, 4);



//Remove Gutenberg Block Library CSS from loading on the frontend
function smartwp_remove_wp_block_library_css()
{
    if (!is_user_logged_in()) {
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wp-block-library-theme');
        wp_dequeue_style('wc-blocks-style'); // Remove WooCommerce block CSS
        wp_dequeue_style('dashicons');
    }
}
add_action('wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100);



function ra_lang($word)
{
    $current_site = current_site();

    $words = array();

    if ($current_site && $current_site === 'nl') {
        $words['Galvanised'] = 'Gegalvaniseerd';
        $words['Weathering'] = 'Corten';
        $words['No Bracing'] = 'Geen verankering set';
        $words['Add Accessory'] = 'Voeg toe';
        $words['View Product'] = 'Bekijk Product';
        $words['Variant'] = 'Optie';
        $words['Price'] = 'Prijs';
        $words['Quantity'] = 'Hoeveelheid';
        $words['Next'] = 'Volgende';
        $words['Prev'] = 'Vorige';
        $words['Done'] = 'Klaar';
        $words['Step'] = 'Stap';
        $words['of'] = 'van';
        $words['Add Product'] = 'Voeg Toe';
        $words['Your order'] = 'Uw bestelling';
        $words['Out of stock'] = 'Geen voorraad';
        $words['Select the accessories for your chosen product'] = 'Selecteer accessoires voor uw gekozen product';
        $words['Select bracing support to connect your chosen product'] = 'Selecteer verankeringssysteem voor uw gekozen product';
        $words['Total'] = 'Totaal';
        $words['Subtotal'] = 'Subtotaal';
        $words['Shipping'] = 'Verzendkosten';
    }

    return isset($words[$word]) && $words[$word] ? $words[$word] : $word;
}

function ra_pa_label($title)
{
    $icons = array(
        'apple-pay' => '/img/payment-options/apple-pay.svg',
        'google-pay' => '/img/payment-options/google-pay.svg',
        'mastercard' => '/img/payment-options/mastercard.svg',
        'visa' => '/img/payment-options/visa.svg'
    );

    $value = $title;
    if ($title) {
        $title = stripString($title);
        if ($title && isset($icons[$title]) && $icons[$title]) {
            $value = '<img src="' . ASSETS . '/img/2x1.png" data-src="' . ASSETS . $icons[$title] . '">';
        }
    }
    return $value;
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
    global $current_site;

    $enqueufiles = array(
        array('handle' => 'GlobalCss', 'src' => '/assets/css/Global.css', 'type' => 'style', 'dep' => array(), 'loc' => 'internal'),
        array('handle' => 'FontCss', 'src' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css', 'type' => 'style', 'dep' => array(), 'loc' => 'external'),
        array('handle' => 'HomeCss', 'src' => '/assets/css/Home.css', 'type' => 'style', 'dep' => array(), 'loc' => 'internal'),
        array('handle' => 'Queriescss', 'src' => '/assets/css/Queries.css', 'type' => 'style', 'dep' => array(), 'loc' => 'internal'),
        array('handle' => 'diycss', 'src' => '/assets/css/DIYgarden.css', 'type' => 'style', 'dep' => array(), 'loc' => 'internal'),
        array('handle' => 'headerCss', 'src' => '/assets/css/header.css', 'type' => 'style', 'dep' => array(), 'loc' => 'internal'),
        array('handle' => 'quotecss', 'src' => '/assets/css/quote.css', 'type' => 'style', 'dep' => array(), 'loc' => 'internal'),
        array('handle' => 'footercss', 'src' => '/assets/css/footer.css', 'type' => 'style', 'dep' => array(), 'loc' => 'internal'),
        array('handle' => 'appjs', 'src' => '/js/app.js', 'type' => 'script', 'dep' => array('jquery'), 'loc' => 'internal'),
        array('handle' => 'mainjs', 'src' => '/assets/js/main.js', 'type' => 'script', 'dep' => array('jquery'), 'loc' => 'internal'),
        array('handle' => 'landcss', 'src' => '/assets/css/landscape.css', 'type' => 'style', 'dep' => array(), 'loc' => 'internal'),
        array('handle' => 'owljs', 'src' => 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', 'type' => 'script', 'dep' => array('jquery'), 'loc' => 'external'),
        array('handle' => 'owlcss', 'src' => 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', 'type' => 'style', 'dep' => array(), 'loc' => 'external'),
        array('handle' => 'swipejs', 'src' => 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', 'type' => 'script', 'dep' => array(), 'loc' => 'external'),
        array('handle' => 'swipecss', 'src' => 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css', 'type' => 'style', 'dep' => array(), 'loc' => 'external'),
        array('handle' => 'html2pdf', 'src' => 'https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.0/html2pdf.bundle.min.js', 'type' => 'script', 'dep' => array('jquery'), 'loc' => 'external'),
        array('handle' => 'jspdf', 'src' => 'https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js', 'type' => 'script', 'dep' => array('jquery'), 'loc' => 'external'),
    );

    foreach ($enqueufiles as $enfiles) {
        if ($enfiles['loc'] == 'internal') {
            $src = get_template_directory_uri() . $enfiles['src'];
            $ver = filemtime(get_template_directory() . $enfiles['src']);
            // $src = 'https://strcurvestage.wpengine.com/wp-content/themes/straightcurve' . $enfiles['src'];
            // $ver = filemtime('https://strcurvestage.wpengine.com/wp-content/themes/straightcurve' . $enfiles['src']);
        } else {
            $src = $enfiles['src'];
            $ver = '1.0.0';
        }
        $dep = $enfiles['dep'];
        error_log('Enqueuing ' . $enfiles['handle'] . ' from ' . $src);
        error_log('Template Directory URI: ' . get_template_directory_uri());

        if ($enfiles['type'] == 'style') {
            wp_enqueue_style($enfiles['handle'], $src, $dep, $ver, 'all');
        } else {
            wp_enqueue_script($enfiles['handle'], $src, $dep, $ver, true);
        }
    }

    // if ($current_site->site_id === 1) { // Website 1
    //     wp_enqueue_script('mainjs', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0', true);
    // }
    // if ($current_site->site_id === 1) { // Website 2
    //     wp_localize_script('website1-ajax', 'website1_data', array(
    //         'site_id' => $current_site->site_id,
    //         'nonce' => wp_create_nonce('website1_add_to_cart_nonce')
    //     ));
    // }
}

add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');


function my_acf_op_init()
{
    if (function_exists('acf_add_options_page')) {
        error_log('ACF function exists');

        acf_add_options_sub_page(
            array(
                'page_title' => 'Theme Header Settings',
                'menu_title' => 'Header',
                'parent_slug' => 'site-options',
            )
        );

        acf_add_options_sub_page(
            array(
                'page_title' => 'Theme Footer Settings',
                'menu_title' => 'Footer',
                'parent_slug' => 'site-options',
            )
        );
    } else {
        error_log('ACF function does not exist');
    }
}

// register custom menu
function register_custom_menu()
{
    register_nav_menu('header_menu', __('Header Menu', 'straight-curve'));
}
add_action('init', 'register_custom_menu');


function get_svg_content($svg_file_path)
{
    $svg_content = '';

    // Ensure the file exists before trying to read it
    if (file_exists($svg_file_path)) {
        $svg_content = file_get_contents($svg_file_path);
    }

    return $svg_content;
}

/**** check file extemiosn */
function getFileExtension($url)
{
    // Parse the URL to get the path component
    $path = parse_url($url, PHP_URL_PATH);
    // Use pathinfo to get the file extension
    $extension = pathinfo($path, PATHINFO_EXTENSION);

    return $extension;
}

function isVideoFile($url)
{
    // List of common video file extensions
    $videoExtensions = ['mp4', 'avi', 'mov', 'mkv', 'flv', 'wmv', 'webm', 'm4v'];

    // Get the file extension from the URL
    $extension = getFileExtension($url);

    // Check if the extension is in the list of video extensions
    return in_array(strtolower($extension), $videoExtensions);
}


function pr_accessories(array $accessories)
{
    foreach ($accessories as $accessory) {
        $productid = $accessory;
        include get_template_directory() . '/template-parts/AccessoriesLoop.php';
    }
}

function returnaccdata(array $accessories)
{
    $accessorie = array();
    foreach ($accessories as $accessory) {
        $productid = $accessory;
        $image = get_the_post_thumbnail_url($productid);
        $title = get_the_title($productid);
        $smaldesc = get_field('product_small_description', $productid);
        $productinfo = get_field("product_info", $productid);
        $finishing = $productinfo['finish'];
        $arrin = ['title' => $title, 'image' => $image, 'smaldesc' => $smaldesc, 'finishing' => $finishing];
        array_push($accessorie, $arrin);
    }
    return $accessorie;
}

function storeallproducts($currentpage)
{
    $tabsContent = array();
    while (have_rows('find_your_edging_tabs', $currentpage)) {
        the_row();
        $tabheading = get_sub_field('tab_heading');
        $tab_products = get_sub_field('tab_products');
        $text_below = get_sub_field('text_in_the_below_the_category_input');
        $tabskey = str_replace(" ", "", $tabheading);
        $tabskey = strtolower($tabskey);
        // $textbelowinput[$tabskey] = $text_below;
        $tabsContent[$tabskey] = $tab_products;
    }
    return $tabsContent;
}
function filtertheproducts($products, $stylevalue, $sizevalue, $categoryvalue, $current_type)
{
    $filteredproducts = array();
    foreach ($products as $value) {
        $currentid = $value;
        $product_type = wp_get_post_terms($currentid, 'ra_product_type');
        $product_type = !empty($product_type) && !is_wp_error($product_type) ? $product_type[0]->slug : '';
        $product_height = wp_get_post_terms($currentid, 'ra_product_height');
        $product_height = !empty($product_height) && !is_wp_error($product_height) ? explode('-', $product_height[0]->slug)[0] : '';
        $productinfo = get_field("product_info", $currentid);
        $finishing = $productinfo['finish'];
        if (strtolower($product_type) == strtolower($current_type) && strtolower($product_height) == strtolower($sizevalue) && strtolower($finishing) == strtolower($categoryvalue)) {
            array_push($filteredproducts, $currentid);
        }
    }
    return $filteredproducts;
}
function get_product_details($productid)
{
    $currentid = $productid;
    $title = get_the_title($currentid);
    $featuredimage = get_the_post_thumbnail_url($currentid);
    $productvideo = get_field("product_video", $currentid);
    $productinfo = get_field("product_info", $currentid);
    $addons = get_field('add-ons', $currentid);
    $filelink = get_field("product_catalogue_file", $currentid);
    $filetext = get_field("product_catalogue_download_button_text", $currentid);
    $accessories = array();
    if (isset($addons['accessories']) && is_array($addons['accessories'])) { ?>
        <?php foreach ($addons['accessories'] as $addon) {
            if (isset($addon['product']) && is_array($addon['product'])) {
                $returnaccdata = returnaccdata($addon['product']);
                array_push($accessories, $returnaccdata);
            }
        } ?>
    <?php }
    $arraydata = ['ptitle' => $title, 'pimage' => $featuredimage, 'pfile' => $filelink, 'pfiletext' => $filetext, 'pvideo' => $productvideo, 'pinfo' => $productinfo, 'accessories' => $accessories];
    return $arraydata;
}
function showproducts()
{
    if (isset($_POST['currentpageid']) && !empty($_POST['currentpageid'])) {

        $currentpage = $_POST['currentpageid'];
        $stylevalue = isset($_POST['stylevalue']) && !empty($_POST['stylevalue']) ? $_POST['stylevalue'] : '';
        $sizevalue = isset($_POST['sizevalue']) && !empty($_POST['sizevalue']) ? $_POST['sizevalue'] : '';
        $categoryvalue = isset($_POST['categoryvalue']) && !empty($_POST['categoryvalue']) ? $_POST['categoryvalue'] : '';
        $current_type = isset($_POST['current_type']) && !empty($_POST['current_type']) ? $_POST['current_type'] : '';
        $currentactivetabs = isset($_POST['currentactivetabs']) && !empty($_POST['currentactivetabs']) ? $_POST['currentactivetabs'] : '';
        $allavailableproduct = storeallproducts($currentpage);
        $products = $allavailableproduct[$currentactivetabs];
        $filtered = filtertheproducts($products, $stylevalue, $sizevalue, $categoryvalue, $current_type);
        $alldetails = [];
        foreach ($filtered as $value) {
            $get_product_details = get_product_details($value);
            array_push($alldetails, $get_product_details);
        }
        $firstdata = $alldetails[0];
        echo json_encode($firstdata);
        exit();
    }
}
add_action('wp_ajax_showproducts', 'showproducts');
add_action('wp_ajax_nopriv_showproducts', 'showproducts');

//************* */

add_action('wp_ajax_showproductsar', 'showproductsar');
add_action('wp_ajax_nopriv_showproductsar', 'showproductsar');

function showproductsar()
{
    $stylevalue = isset($_POST['stylevalue']) ? sanitize_text_field($_POST['stylevalue']) : '';
    $sizevalue = isset($_POST['sizevalue']) ? sanitize_text_field($_POST['sizevalue']) : '';
    $categoryvalue = isset($_POST['categoryvalue']) ? sanitize_text_field($_POST['categoryvalue']) : '';
    $currentpageid = isset($_POST['currentpageid']) ? sanitize_text_field($_POST['currentpageid']) : '';
    $current_type = isset($_POST['current_type']) ? sanitize_text_field($_POST['current_type']) : '';
    $currentactivetabs = isset($_POST['currentactivetabs']) ? sanitize_text_field($_POST['currentactivetabs']) : '';
    $flexproducts = get_field('flex_garden_products', $currentpageid);
    $rigidproducts = get_field('rigid_garden_products', $currentpageid);
    $zeroflexproducts = get_field('zero_flex_garden_products', $currentpageid);
    // switch_to_blog(2);

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'meta_query' => array(
            'relation' => 'AND',
        ),
        'tax_query' => array(),
    );

    if (!empty($stylevalue)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'ra_product_type',
            'field' => 'slug', // or 'term_id' depending on what $stylevalue contains
            'terms' => $stylevalue,
            'operator' => 'IN' // or 'LIKE' if you want to use partial matching
        );
    }
    if (!empty($sizevalue)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'ra_product_height',
            'field' => 'slug', // or 'term_id' depending on what $stylevalue contains
            'terms' => $sizevalue,
            'operator' => 'IN' // or 'LIKE' if you want to use partial matching
        );
    }

    $query = new WP_Query($args);

    $filtered_products = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $product_ids = get_the_ID();
            $link = get_permalink();
            $productinfo = get_field("product_info", $product_ids);
            $finishing = $productinfo['finish'];

            if ($categoryvalue == strtolower($finishing)) {
                if ($stylevalue == 'zero-flex' && in_array($product_ids, $zeroflexproducts)) {
                    $filtered_products[] = $product_ids;
                } else if ($stylevalue == 'rigid' && in_array($product_ids, $rigidproducts)) {
                    $filtered_products[] = $product_ids;
                }
                if ($stylevalue == 'flex' && in_array($product_ids, $flexproducts)) {
                    $filtered_products[] = $product_ids;
                }
            }
        }
        wp_reset_postdata();
    }
    if (count($filtered_products) == 0) {
        $accord_result = [
            'title' => "Product not found",
            'product_id' => 0
        ];

        echo json_encode($accord_result);
    } else {


        $accord = render_accordion_sectionss($filtered_products[0]);
        $accord_v = render_video_sectionss($filtered_products[0]);
        $thumbnail = get_the_post_thumbnail_url($filtered_products[0]);
        $title = get_the_title($filtered_products[0]);
        $productinfo = get_field("product_info", $filtered_products[0]);
        $size = $productinfo['details'];
        $addons = get_field('add-ons', $filtered_products[0]);
        $accery_html = '';
        if ($addons['accessories']) {
            $accver =  $addons['accessories'];
            foreach ($accver as $v) {
                $accer = pr_accessoriesss($v['product']);
                $accery_html .= $accer;
            }
        }
        $html = '<p>' . get_field('product_small_description', $filtered_products[0]) . '</p>';
        // 
        $pro_url = get_permalink($filtered_products[0]);

        // restore_current_blog();
        $accord_result = [
            'accordion' => $accord,
            'video' => $accord_v,
            'thumbnail' => $thumbnail,
            'title' => $title,
            'size' => $size,
            'accer' => $accery_html,
            'html' => $html,
            'pro_url' => $pro_url,
            'product_id' => $filtered_products[0],
            'rigid' => $rigidproducts,
            'flex' => $flexproducts,
            'zeroflex' => $zeroflexproducts,
            'filteredarray' => $filtered_products
        ];

        echo json_encode($accord_result);
    }
    wp_die(); // Required to terminate immediately and return a proper response
}

function render_accordion_sectionss($currentpage)
{
    $productvideo = get_field('product_video', $currentpage);
    $currentid = get_the_ID();

    $output = '';

    if (have_rows("product_accordian", $currentpage)) {
        $output .= '';

        while (have_rows("product_accordian", $currentpage)) {
            the_row();
            $question = get_sub_field("accordian_heading");
            $answer = get_sub_field("accordian_description");

            $output .= '<div class="accordian_ar_mi">';
            $output .= '<div class="accordian_ar_mi_head">';
            $output .= '<h6>' . $question . '</h6>';
            $output .= '<div class="accord_icons_ar">';
            $output .= '<img src="' . esc_url(get_template_directory_uri() . '/assets/img/GMinusCircle.svg') . '" alt="Minus Icon" id="minus_ar" class="hide_ar_accord">';
            $output .= '<img src="' . esc_url(get_template_directory_uri() . '/assets/img/GPlusCircle.svg') . '" alt="Plus Icon" id="plus_ar">';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '<div class="accordian_ar_mi_desc hide_ar_accord">';
            $output .= $answer;
            $output .= '</div>';
            $output .= '</div>';
        }
    }

    return $output;
}
/**
 * Renders the video section for a product page.
 *
 * @param int $currentid The post ID of the current product.
 * @return string The HTML for the video section.
 */
function render_video_sectionss($currentid)
{
    $videofile = get_field('product_video', $currentid);
    if ($videofile) {
        $output = '
            <div class="videowrapper">
                <video src="' . esc_url($videofile) . '"></video>
                <div class="playbutton_ar_mi">
                    ' . file_get_contents(get_template_directory() . '/assets/img/PlayCircle.svg') . '
                </div>
            </div>
            <div class="divider">
                <img src="' . esc_url(get_template_directory_uri() . '/assets/img/divider.svg') . '" alt="" class="desk_divider">
                <img src="' . esc_url(get_template_directory_uri() . '/assets/img/dividermob.svg') . '" alt="" class="mob_divider">
            </div>
            <div class="donwload_wrapper">
                <h6>Download:</h6>
                <a href="' . esc_url(get_field("product_catalogue_file", $currentid)) . '" download>' . esc_html(get_field("product_catalogue_download_button_text", $currentid)) . '</a>
            </div>
        ';
    }
    return $output;
}


function pr_accessoriesss(array $accessories)
{
    $output = ''; // Initialize an empty string to store HTML


    foreach ($accessories as $accessory) {
        $productid = $accessory;
        // $image = get_the_post_thumbnail_url($productid);
        // $title = get_the_title($productid);
        // $smaldesc = get_field('product_small_description', $productid);
        // $productinfo = get_field("product_info", $productid);
        // $finishing = $productinfo['finish'];

        ob_start();

        include get_template_directory() . '/template-parts/AccessoriesLoop.php';

        $output .= ob_get_clean();

        // Concatenate HTML to the $output variable
        // $output .= '<div class="acc_loop_wrapper_ar">';
        // $output .= '    <div class="thumbnail_wrapper_ar">';
        // $output .= '        <div class="thumb_ar_loop">';
        // $output .= '            <img src="' . esc_url($image) . '" alt="Image">';
        // $output .= '        </div>';
        // $output .= '        <button>' . esc_html($finishing) . '</button>';
        // $output .= '    </div>';
        // $output .= '    <div class="acc_loop_content">';
        // $output .= '        <a href="' . esc_url(get_the_permalink($productid)) . '">';
        // $output .= '            <h5>' . esc_html($title) . '</h5>';
        // $output .= '        </a>';
        // $output .= '        <p>' . esc_html($smaldesc) . '</p>';
        // // Add the Add to Cart button
        // $output .= '        <div class="add_to_cart_button">';
        // $output .=              do_shortcode('[add_to_cart id="' . $productid . '"]');
        // $output .= '        </div>';
        // $output .= '    </div>';
        // $output .= '</div>';
    }

    return $output; // Output the accumulated HTML
}

function addtocart()
{


    // Check if WooCommerce is active
    if (!class_exists('WooCommerce')) {
        wp_send_json_error(array('message' => 'WooCommerce is not active.'));
    }

    // Retrieve data from the AJAX request
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    // Validate product ID
    if (!$product_id) {
        wp_send_json_error(array('message' => 'Invalid product ID.'));
    }

    // Output result
    // Switch to the blog where the product is located (e.g., blog ID 2)
    $product = wc_get_product($product_id);
    $after = WC()->cart->get_cart_contents_count();

    // Ensure the product was found on the other blog
    if (!$product) {
        wp_send_json_error(array('message' => 'Product not found on the specified blog.', 'product_id' => $product_id));
    }

    // Now add the product to the cart in the current WooCommerce context
    $results = WC()->cart->add_to_cart($product_id, $quantity);

    if ($results) {
        $updatedmincart = getupdatedminicart();
        wp_send_json_success(array(
            'message' => 'Product added to cart!',
            'minicart' => $updatedmincart,
            'product' => $product,
            'product_id' => $product_id,
            'product_url' => get_the_permalink($product_id),
        ));
    } else {
        // Get WooCommerce notices and format them into a readable string
        $notices = wc_get_notices('error');

        // Initialize error message and stock error flag
        $error_message = 'Failed to add product to cart.';
        $is_stock_error = false;

        if (!empty($notices)) {
            foreach ($notices as $notice) {
                // Check if the notice is stock-related
                if (strpos($notice['notice'], 'out of stock') !== false || strpos($notice['notice'], 'not enough stock') !== false) {
                    $is_stock_error = true; // Found a stock-related error

                    // Get the available stock quantity
                    $stock_quantity = wc_get_product($product_id)->get_stock_quantity();

                    // Customize the error message to include stock information
                    $error_message = sprintf(__('Only %d sets are available.'), $stock_quantity);
                    break; // Exit loop once stock-related error is found
                }
            }

            // If no stock-related error, combine all error notices into a single message
            if (!$is_stock_error) {
                $error_message = implode(' ', wp_list_pluck($notices, 'notice'));
            }
        }

        wc_clear_notices(); // Clear notices to prevent them from displaying multiple times

        // Send JSON response with stock error flag
        wp_send_json_error(array(
            'message' => $error_message,
            'is_stock_error' => $is_stock_error,
        ));
    }


    die();
    // restore_current_blog(); // Switch back to the original blog
}
add_action('wp_ajax_addtocart', 'addtocart');
add_action('wp_ajax_nopriv_addtocart', 'addtocart');

function getupdatedminicart()
{
    ob_start();
    include get_template_directory() . '/template-parts/headers/mini-cart.php';
    return ob_get_clean();
};

// redirect to a differnet page
add_action('template_redirect', 'redirect_to_custom_page_after_cart_update');
function redirect_to_custom_page_after_cart_update()
{
    // Check if the cart is being updated
    if (is_cart() && !empty($_POST['update_cart'])) {
        // Set the URL to the WordPress page you want to redirect to
        $redirect_url = home_url('/quote');
        if ($redirect_url) {
            wp_safe_redirect($redirect_url);
            exit;
        }
    }
};

function remove_from_cart()
{

    if (!class_exists('WooCommerce')) {
        wp_send_json_error(array('message' => 'WooCommerce is not active.'));
    }

    // Sanitize and validate the product ID.
    $product_id = isset($_POST['product_id']) ? intval(sanitize_text_field($_POST['product_id'])) : 0;

    if (!$product_id) {
        wp_send_json_error(array('message' => 'Invalid product ID.'));
    }

    // Check if the product is in the cart and remove it
    $cart = WC()->cart->get_cart();
    $found = false;

    foreach ($cart as $cart_item_key => $cart_item) {
        if ($cart_item['product_id'] == $product_id) {
            WC()->cart->remove_cart_item($cart_item_key);
            $found = true;
            break;
        }
    }

    if (!$found) {
        wp_send_json_error(array('message' => 'Product not found in the cart.'));
    } else {
        wp_send_json_success(array(
            'message' => 'Product removed from cart!',
        ));
    }

    die();
}
add_action('wp_ajax_remove_from_cart', 'remove_from_cart');
add_action('wp_ajax_nopriv_remove_from_cart', 'remove_from_cart');
