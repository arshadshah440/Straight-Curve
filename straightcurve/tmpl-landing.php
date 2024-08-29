<?php
/*
 * Template Name: Landing Page
 */

get_header();


if ( have_posts() ) while ( have_posts() ) : the_post() ;

$fields = get_fields();
$thumb = get_the_post_thumbnail_url();

// $has_products = false;
// $products = array();
// if (isset($fields['content_modules'][0]['acf_fc_layout'])) {
// 	foreach ($fields['content_modules'] as $key => $value) {
// 		if (isset($value['options'][0]['title'])) {
// 			foreach ($value['options'] as $option) {
// 				if (isset($option['product']->ID)) {
// 					$has_products = true;
// 					$products[$option['product']->ID] = $option['product'];
// 				}
// 			}
// 		}
// 	}
// }

?><article id="post-<?php the_ID(); ?>" <?php post_class('c-landing'); ?>>
<main id="Main" class="c-main-content o-main" role="main">
	<?php
		if (isset($fields['content_modules'][0]['acf_fc_layout'])) {
			foreach ($fields['content_modules'] as $key => $module) {
				$module['module_id'] = 'section-' . ($key + 1);
				$module['index'] = $key;
				get_template_part('landing-modules/' . $module['acf_fc_layout'], null, $module);
			}
		}
	?>
</main>
</article><?php endwhile; ?>

<?php get_footer(); ?>