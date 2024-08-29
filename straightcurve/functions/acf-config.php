<?php

// Hide ACF field group menu item
// add_filter('acf/settings/show_admin', '__return_false');

add_filter('acf/settings/save_json', 'acf_json_save_point');
function acf_json_save_point($path)
{
	$path = get_stylesheet_directory() . '/functions/acf-jsons';
	return $path;
}

add_filter('acf/settings/load_json', 'acf_json_load_point');
function acf_json_load_point($paths)
{
	unset($paths[0]);
	$paths[] = get_stylesheet_directory() . '/functions/acf-jsons';
	return $paths;
}

// Register Options page
if (function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title'  => 'General Site Options',
		'menu_title'  => 'Site Options',
		'menu_slug'   => 'site-options',
		'capability'  => 'edit_posts',
		'redirect'    => false
	));
	
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
}

// if( function_exists('acf_add_local_field_group') ):

// 	acf_add_local_field_group(array (
// 		'key' => 'group_5678c2e455a82',
// 		'title' => 'Social Links',
// 		'fields' => array (
// 			array (
// 				'key' => 'field_5678c2e9fd5f5',
// 				'label' => 'Social Links',
// 				'name' => 'social_links',
// 				'type' => 'repeater',
// 				'instructions' => '',
// 				'required' => 0,
// 				'conditional_logic' => 0,
// 				'wrapper' => array (
// 					'width' => '',
// 					'class' => '',
// 					'id' => '',
// 				),
// 				'collapsed' => '',
// 				'min' => '',
// 				'max' => '',
// 				'layout' => 'table',
// 				'button_label' => 'Add Row',
// 				'sub_fields' => array (
// 					array (
// 						'key' => 'field_5678c304fd5f6',
// 						'label' => 'Name',
// 						'name' => 'name',
// 						'type' => 'text',
// 						'instructions' => '',
// 						'required' => 0,
// 						'conditional_logic' => 0,
// 						'wrapper' => array (
// 						'width' => '',
// 						'class' => '',
// 						'id' => '',
// 					),
// 					'default_value' => '',
// 					'placeholder' => '',
// 					'prepend' => '',
// 					'append' => '',
// 					'maxlength' => '',
// 					'readonly' => 0,
// 					'disabled' => 0,
// 				),
// 				array (
// 					'key' => 'field_5678c328fd5f7',
// 					'label' => 'Link',
// 					'name' => 'link',
// 					'type' => 'text',
// 					'instructions' => '',
// 					'required' => 0,
// 					'conditional_logic' => 0,
// 					'wrapper' => array (
// 						'width' => '',
// 						'class' => '',
// 						'id' => '',
// 					),
// 					'default_value' => '',
// 					'placeholder' => '',
// 					'prepend' => '',
// 					'append' => '',
// 					'maxlength' => '',
// 					'readonly' => 0,
// 					'disabled' => 0,
// 				),
// 				array (
// 					'key' => 'field_5678c453fd5f8',
// 					'label' => 'Hover Title',
// 					'name' => 'hover_title',
// 					'type' => 'text',
// 					'instructions' => '',
// 					'required' => 0,
// 					'conditional_logic' => 0,
// 					'wrapper' => array (
// 						'width' => '',
// 						'class' => '',
// 						'id' => '',
// 					),
// 					'default_value' => '',
// 					'placeholder' => '',
// 					'prepend' => '',
// 					'append' => '',
// 					'maxlength' => '',
// 					'readonly' => 0,
// 					'disabled' => 0,
// 				),
// 			),
// 		),
// 	),
//   'location' => array (
// 		array (
// 			array (
// 				'param' => 'options_page',
// 				'operator' => '==',
// 				'value' => 'site-options',
// 			),
// 		),
// 	),
// 	'menu_order' => 0,
// 	'position' => 'normal',
// 	'style' => 'default',
// 	'label_placement' => 'top',
// 	'instruction_placement' => 'label',
// 	'hide_on_screen' => '',
// 	'active' => 1,
// 	'description' => '',
// ));

// endif;
