<?php
add_action( 'wp_ajax_nopriv_ra_get_products', 'ra_get_products' );
add_action( 'wp_ajax_ra_get_products', 'ra_get_products' );
function ra_get_products() {
	$result = array();
	$cat = esc_attr( sanitize_text_field( $_POST['cat'] ) );
	$type = esc_attr( sanitize_text_field( $_POST['type'] ) );
	$height = esc_attr( sanitize_text_field( $_POST['height'] ) );
	$search = esc_attr( sanitize_text_field( $_POST['search'] ) );
	$page = esc_attr( sanitize_text_field( $_POST['page'] ) );
	$favs = esc_attr( sanitize_text_field( $_POST['favs'] ) );
	$favs_arr = array();
	$shop_tips = get_field('shop_tips', 'options');
	$tip_images = array();
	foreach ($shop_tips as $value) {
		if ($value['image']) {
			$tip_images[] = $value['image'];
		}
	}

	$args = array(
		'post_type' => 'product',
		'posts_per_page' => -1,
		"post_status" => "publish"
	);
	$tax_query = array();

	if ($favs) {
		$favs_arr = explode(',', $favs);
	}

	if ($favs_arr && count($favs_arr) > 0) {

		$args['post__in'] = $favs_arr;

	} else {

		if (!$cat || $cat !== 'accessories') {
			$tax_query[] = array(
				'taxonomy' => 'product_cat',
				'field' => 'slug',
				'terms' => array( 'accessories' ),
				'operator' => 'NOT IN'
			);
		}
		if ($cat) {
			$tax_query[] = array(
				'taxonomy' => 'product_cat',
				'field' => 'slug',
				'terms' => $cat,
			);
		}

		if ($type) {
			$tax_query[] = array(
				'taxonomy' => 'ra_product_type',
				'field' => 'slug',
				'terms' => $type,
			);
		}
		if ($height) {
			$tax_query[] = array(
				'taxonomy' => 'ra_product_height',
				'field' => 'slug',
				'terms' => $height,
			);
		}
		if (count($tax_query) > 0) {
			$args['tax_query'] = $tax_query;
		}

		if ($search) {
			$args['s'] = $search;
		}

	}



	$loop = new WP_Query( $args );
	$result['args'] = $args;
	$result['html'] = '';
	if ( $loop->have_posts() ) while ( $loop->have_posts() ) : $loop->the_post();
		$result['html'] .= load_template_part('content-product', false, true);
	endwhile;
	wp_reset_postdata();

	$result = json_encode($result);
    wp_die($result);
}

add_action( 'wp_ajax_nopriv_ra_get_bracing_solution', 'ra_get_bracing_solution' );
add_action( 'wp_ajax_ra_get_bracing_solution', 'ra_get_bracing_solution' );
function ra_get_bracing_solution() {
	$result = array();
	$height = esc_attr( sanitize_text_field( $_POST['height'] ) );
	$range = esc_attr( sanitize_text_field( $_POST['range'] ) );
	$soil = esc_attr( sanitize_text_field( $_POST['soil'] ) );

	$args = array(
		'post_type' => 'bracing_options',
		'posts_per_page' => -1,
		"post_status" => "publish",
		'fields' =>'ids'
	);

	$meta_query = array();
	if ($height) {
		$meta_query[] = array(
			'key' => 'height',
			'value' => $height,
			// 'compare' => 'IN',
		);
	}
	if ($range) {
		$range = str_replace('&gt;', '>', $range);
		$range = str_replace('&amp;', '&', $range);
		$meta_query[] = array(
			'key' => 'range',
			'value' => $range,
			// 'compare' => 'IN',
		);
	}
	if ($soil) {
		$meta_query[] = array(
			'key' => 'ground_condition',
			'value' => $soil,
			// 'compare' => 'IN',
		);
	}

	$args['meta_query'] = $meta_query;

	// $result['args'] = $args;
	$posts = get_posts($args);
	$result['html'] = '';
	foreach ($posts as $id) {
		$var = array('ID' => $id);
		$result['html'] .= load_template_part('partials/bracing-option', $var);
	}

	$result = json_encode($result);
    wp_die($result);
}

add_action( 'wp_ajax_nopriv_ra_fav_item', 'ra_fav_item' );
add_action( 'wp_ajax_ra_fav_item', 'ra_fav_item' );
function ra_fav_item() {
    $id = $_POST['id'];
    $add_remove = $_POST['add_remove'];
	$result = array(
		'err' => '',
		'favs' => array()
	);
	$user_id = get_current_user_id();
	if (!$user_id) {
		$result['err'] = 'Not loggedin';
	} else if ($user_id && $id && get_post_type($id)) {
		$get_favs = get_the_author_meta( 'favourites', $user_id );
		$favs = array();
		if ($get_favs) {
			$favs = explode('|', $get_favs);
		}
		if ($add_remove && $add_remove === 'remove') {
			if (array_search($id, $favs) !== false) {
				unset($favs[ array_search($id, $favs) ]);
			}
		} else {
			$favs[] = $id;
		}
		$favs = array_unique($favs);
		$favs = implode("|", $favs);
		update_user_meta( $user_id, 'favourites', $favs);
		$result['favs'] = $favs;
	}
	$result = json_encode($result);
    wp_die($result);
}

add_action( 'wp_ajax_nopriv_ra_get_fav_item', 'ra_get_fav_item' );
add_action( 'wp_ajax_ra_get_fav_item', 'ra_get_fav_item' );
function ra_get_fav_item() {
    $user_id = get_current_user_id();
	$result = null;
	if ($user_id) {
		$result = get_the_author_meta( 'favourites', $user_id );
	}
	$result = json_encode($result);
    wp_die($result);
}


add_action( 'wp_ajax_nopriv_ra_multivariation_add_to_cart', 'ra_multivariation_add_to_cart' );
add_action( 'wp_ajax_ra_multivariation_add_to_cart', 'ra_multivariation_add_to_cart' );
function ra_multivariation_add_to_cart() {
	$data = esc_attr( sanitize_text_field( $_POST['data'] ) );
	$products = explode(',', $data);
	$result = array();
	if ($products && count($products) > 0) {
		foreach ($products as $product) {
			$product = explode(':', $product);
			$product_id = $product[0];
			$product_qty = ($product[1] ? $product[1] : 1);

			$res = array('id' => $product_id);
			$res['res'] = WC()->cart->add_to_cart( $product_id, $product_qty );
			$result['added'][] = $res;
		}
	}

	$result = json_encode($result);
    wp_die($result);
}



add_action( 'wp_ajax_nopriv_ra_update_minicart_qty', 'ra_update_minicart_qty' );
add_action( 'wp_ajax_ra_update_minicart_qty', 'ra_update_minicart_qty' );
function ra_update_minicart_qty() {
	$data = esc_attr( sanitize_text_field( $_POST['data'] ) );
	$products = explode(',', $data);
	$result = array();
	if ($products && count($products) > 0) {
		foreach ($products as $product) {
			$product = explode(':', $product);
			$product_id = $product[0];
			$product_qty = $product[1];
			if (!$product_qty) {
				$product_qty = 0;
			}
			if ($product_id) {
				$result[$product_id] = WC()->cart->set_quantity( $product_id, $product_qty );
			}
		}
	}

	$result = json_encode($result);
    wp_die($result);
}



add_action( 'wp_ajax_nopriv_ra_product_data', 'ra_product_data' );
add_action( 'wp_ajax_ra_product_data', 'ra_product_data' );
function ra_product_data() {
	$all_products = array();
	$args = array(
		'post_type' => 'product',
		'post_status' => 'publish',
		'posts_per_page' => 1000
	);

	$loop = new WP_Query( $args );
	if ( $loop->have_posts() ) while ( $loop->have_posts() ) :
		$loop->the_post();
		global $product;
		if ( empty( $product ) || ! $product->is_visible() ) {
			return;
		}
		if( $product->is_type( 'simple' ) ){
			$all_products[get_the_ID()] = array(
				'type' => 'simple',
				'name' => get_the_title(),
				'price' => $product->price,
				'reg_price' => $product->regular_price,
				'sale_price' => $product->sale_price,
				'sku' => $product->sku,
			);

		} elseif( $product->is_type( 'variable' ) ){
			$product_variations = $product->get_available_variations();
			$variations = array();
			foreach ($product_variations as $variation) {
				foreach ($variation['attributes'] as $attributes => $val) {
					$name = $val;

				}
				$variations[$variation['variation_id']] = array(
					'price' => $variation['display_price'],
					'display_regular_price' => $variation['display_regular_price'],
					'attributes' => $variation['attributes'],
					'sku' => $variation['sku']
				);
			}
			$all_products[get_the_ID()] = array(
				'type' => 'variable',
				'name' => get_the_title(),
				'slug' => $product->slug,
				'price' => $product->price,
				'variations' => $variations,
				'reg_price' => $product->regular_price,
				'sale_price' => $product->sale_price,
				'sku' => $product->sku,
			);
		}
	endwhile;

	$result = json_encode($all_products);
    wp_die($result);
}