<?php

// SITE URL for links
function home_shortcode() {
	return SITE;
}
add_shortcode( 'home', 'home_shortcode' );

// Wordpress URL for links
function image_shortcode() {
	return WP;
}
add_shortcode('image', 'image_shortcode');

// Wordpress URL for Uploads
function my_uploads_folder () {
	$upload_dir = wp_upload_dir();
	return $upload_dir['baseurl'];
}
add_shortcode('uploads', 'my_uploads_folder');

function button_shortcode($atts) {
	$atts = shortcode_atts( array(
		'link' => '#',
		'title' => 'Visit this link',
		'label' => 'Click here',
		'class' => '',
	), $atts );
	extract($atts);
	$output = '';
	$output .= '<a class="o-btn '. $class .'" href="' . $link . '" title="' . $title . '">' . $label . '</a>';
	return $output;
}
add_shortcode('button', 'button_shortcode');

function social_links_shortcode() {
	$output = '';
	$output .= '<div class="c-social">';

	if ( have_rows('social_links', 'options') ) :
		while ( have_rows('social_links', 'options') ) : the_row();
			$name = preg_replace( '/\s+/', '-', strtolower( get_sub_field('name') ) );
			$output .= '<a href="' . get_sub_field('link') . '" class="c-social__icon" target="_blank" title="' . get_sub_field('hover_title') . '">' . get_svgicon( $name, '0 0 24 24') . '</a>';
		endwhile;
	endif;
	$output .= '</div>';
	return $output;
}
add_shortcode('social-links', 'social_links_shortcode');


function stars_shortcode($atts) {
	$atts = shortcode_atts( array(
		'rating' => '5'
	), $atts );
	extract($atts);

	$output = '<span class="stars rating-' . $rating . '">';
	for ($i=1; $i <= $rating; $i++) {
		$output .= '<i class="fas fa-star"></i>';
	}

	$output .= '</span>';
	return $output;
}
add_shortcode('stars', 'stars_shortcode');

?>