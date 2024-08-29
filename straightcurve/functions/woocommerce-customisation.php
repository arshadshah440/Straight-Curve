<?php


remove_action( 'woocommerce_before_shop_loop','woocommerce_result_count', 20, 0 );
remove_action( 'woocommerce_before_shop_loop','woocommerce_catalog_ordering', 30, 0 );

remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
add_filter( 'woocommerce_product_description_heading', '__return_null' );


// add_filter( 'loop_shop_per_page', 'ra_loop_shop_per_page', 10, 0)
add_filter( 'loop_shop_per_page', 'ra_loop_shop_per_page', 20 );
function ra_loop_shop_per_page( $cols ) {
    return 1000;
}

add_filter( 'woocommerce_billing_fields' , 'override_billing_checkout_fields', 20, 1 );
function override_billing_checkout_fields( $fields ) {
	$fields['billing_first_name']['placeholder'] = 'First name';
	$fields['billing_last_name']['placeholder'] = 'Last name';
	$fields['billing_company']['placeholder'] = 'Company name (optional)';
	$fields['billing_address_1']['placeholder'] = 'Enter your address';
	$fields['billing_address_2']['placeholder'] = 'Apartment / Suite / Unit';
	$fields['billing_city']['placeholder'] = 'Your Suburb';
	$fields['billing_postcode']['placeholder'] = 'Postcode';
	$fields['billing_phone']['placeholder'] = 'Your Phone';
	$fields['billing_email']['placeholder'] = 'Your Email Address';
	return $fields;
}

add_filter( 'woocommerce_shipping_fields' , 'override_shipping_checkout_fields', 20, 1 );
function override_shipping_checkout_fields( $fields ) {
	$fields['shipping_first_name']['placeholder'] = 'First name*';
	$fields['shipping_last_name']['placeholder'] = 'Last name*';
	$fields['shipping_company']['placeholder'] = 'Company name (optional)';
	$fields['shipping_address_1']['placeholder'] = 'Enter your address';
	$fields['shipping_address_2']['placeholder'] = 'Apartment / Suite / Unit';
	$fields['shipping_postcode']['placeholder'] = 'Postcode';
	$fields['shipping_phone']['placeholder'] = 'Your Phone';
	$fields['shipping_phone']['label'] = 'Your Phone';
	$fields['shipping_city']['placeholder'] = 'Your Suburb';
	return $fields;
}

add_filter( 'woocommerce_dropdown_variation_attribute_options_args', 'variation_option_none', 10 );
function variation_option_none( $args ) {
    $var_tax = get_taxonomy( $args['attribute'] );
    $args['show_option_none'] = 'Select ' . apply_filters( 'the_title', $var_tax->labels->singular_name );
    return $args;
}

add_action( 'wp_ajax_nopriv_load_product_quickview', 'load_product_quickview' );
add_action( 'wp_ajax_load_product_quickview', 'load_product_quickview' );
function load_product_quickview() {
    $product_id = $_POST['product'];
	$result = null;
	if ($product_id && get_post_type($product_id)) {
		$result = load_template_part('content-product-overlay', array('product_id' => $product_id), true);
	}
	$result = json_encode($result);
    wp_die($result);
}


add_action( 'wp_ajax_nopriv_ra_get_req_fixings', 'ra_get_req_fixings' );
add_action( 'wp_ajax_ra_get_req_fixings', 'ra_get_req_fixings' );
function ra_get_req_fixings() {
    $result = load_template_part('partials/fixing-overlay');
	$result = json_encode($result);
    wp_die($result);
}

// Adds radio button to Finish variations, this code also has accompanying JS function called variationRadios in product.js file.
add_filter('woocommerce_dropdown_variation_attribute_options_html', 'variation_radio_buttons', 20, 2);
function variation_radio_buttons($html, $args) {
	if ($args['attribute'] && $args['attribute'] === 'pa_finish') {
		$args = wp_parse_args(apply_filters('woocommerce_dropdown_variation_attribute_options_args', $args), array(
			'options'          => false,
			'attribute'        => false,
			'product'          => false,
			'selected'         => false,
			'name'             => '',
			'id'               => '',
			'class'            => '',
			'show_option_none' => __('Choose an option', 'woocommerce'),
		));

		if(false === $args['selected'] && $args['attribute'] && $args['product'] instanceof WC_Product) {
			$selected_key     = 'attribute_'.sanitize_title($args['attribute']);
			$args['selected'] = isset($_REQUEST[$selected_key]) ? wc_clean(wp_unslash($_REQUEST[$selected_key])) : $args['product']->get_variation_default_attribute($args['attribute']);
		}

		$options               = $args['options'];
		$product               = $args['product'];
		$attribute             = $args['attribute'];
		$name                  = $args['name'] ? $args['name'] : 'attribute_'.sanitize_title($attribute);
		$id                    = $args['id'] ? $args['id'] : sanitize_title($attribute);
		$class                 = $args['class'];
		$show_option_none      = (bool)$args['show_option_none'];
		$show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __('Choose an option', 'woocommerce');

		if(empty($options) && !empty($product) && !empty($attribute)) {
			$attributes = $product->get_variation_attributes();
			$options    = $attributes[$attribute];
		}

		$radios = '<div class="variation-radios ' . $name . '">';
		$radios .= '<h4>Finish</h4>';

		if(!empty($options)) {
			if($product && taxonomy_exists($attribute)) {
				$terms = wc_get_product_terms($product->get_id(), $attribute, array(
					'fields' => 'all',
				));
				foreach($terms as $term) {
					if(in_array($term->slug, $options, true)) {
					$id = $name.'-'.$term->slug;
					$radios .= '<label data-product="'.$product->get_id().'"><input type="radio" id="'.esc_attr($id).'" name="'.esc_attr($name).'" value="'.esc_attr($term->slug).'" '.checked(sanitize_title($args['selected']), $term->slug, false).'><span class="label '.esc_attr($term->slug).'">'.esc_html(apply_filters('woocommerce_variation_option_name', $term->name)).'<span class="desc">'. esc_html($term->description) .'</span></span></label>';
					}
				}
			} else {
				foreach($options as $option) {
					$id = $name.'-'.$option;
					$checked    = sanitize_title($args['selected']) === $args['selected'] ? checked($args['selected'], sanitize_title($option), false) : checked($args['selected'], $option, false);
					$radios    .= '<label data-product="'.$product->get_id().'"><input type="radio" id="'.esc_attr($id).'" name="'.esc_attr($name).'" value="'.esc_attr($option).'" id="'.sanitize_title($option).'" '.$checked.'><span class="label '.esc_attr($option).'">'.esc_html(apply_filters('woocommerce_variation_option_name', $option)).'</span></label>';
				}
			}
		}

		$radios .= '</div>';
  		return $html.$radios;
	} else {
  		return $html;
	}
}

function variation_check($active, $variation) {
  if(!$variation->is_in_stock() && !$variation->backorders_allowed()) {
    return false;
  }
  return $active;
}
add_filter('woocommerce_variation_is_active', 'variation_check', 10, 2);



// Exclude products from a particular category on the shop page
add_action( 'woocommerce_product_query', 'custom_pre_get_posts_query' );
function custom_pre_get_posts_query( $q ) {
	if (is_shop()) {
		$tax_query = (array) $q->get( 'tax_query' );
		$tax_query[] = array(
			'taxonomy' => 'product_cat',
			'field' => 'slug',
			'terms' => array( 'accessory' ),
			'operator' => 'NOT IN'
		);
		$q->set( 'tax_query', $tax_query );
	}
}


// Exclude products from cart count
add_filter( 'woocommerce_cart_contents_count', 'ra_exclude_hidden_minicart_counter' );
function ra_exclude_hidden_minicart_counter( $quantity ) {
	$free_products = get_field('free_products', 'options');
	$no_qty_for = array();
	if (isset($free_products['free_spike']->ID)) {
		$no_qty_for[] = $free_products['free_spike']->ID;
	}
	if (isset($free_products['free_peg']->ID)) {
		$no_qty_for[] = $free_products['free_peg']->ID;
	}

  	$minus = 0;
	foreach( WC()->cart->get_cart() as $cart_item ) {
		$product = $cart_item['data'];
		if (in_array($cart_item['product_id'], $no_qty_for)) {
			$minus += $cart_item['quantity'];
		}
	}
  	$quantity -= $minus;
  	return $quantity;
}


// Update cart count after add to cart AJAX call
add_filter( 'woocommerce_add_to_cart_fragments', 'header_cart_count', 10, 1 );
function header_cart_count( $fragments ) {
	$cart_count = WC()->cart->get_cart_contents_count();
	$cart_total = WC()->cart->get_cart_total();
    $bag = '<span class="header-cart-count"><i class="fal fa-shopping-cart"></i> <span>(' . $cart_count . ') ' . $cart_total . '</span></span>';
    $fragments['span.header-cart-count'] = $bag;
    return $fragments;
}


// Create Sub menu on Woocommerce for export orders
add_action('admin_menu', 'register_fixings_required_submenu_page', 10);
function register_fixings_required_submenu_page() {
	add_submenu_page( 'woocommerce', 'Fixings / Stock', 'Fixings / Stock', 'manage_options', 'fixings-submenu-page', 'fixings_submenu_page_callback' );
}
function fixings_submenu_page_callback() {

	// $data = pull_cin7_stock_from_api();
	// prep_and_save_cin7_stock($data);


  	echo '<h3>Products Stock Info</h3>';
	$all_products = array();
	$args = array(
        'post_type' => 'product',
        'posts_per_page' => -1
    );
    $loop = new WP_Query( $args );
    if ( $loop->have_posts() ): while ( $loop->have_posts() ): $loop->the_post();
        global $product;

		$product_id = get_the_ID();
		$edit = get_edit_post_link($product_id);
		$view = get_the_permalink($product_id);
		$product_data = array(
			'ID' => $product_id,
			'name' => get_the_title(),
			'sku' => $product->get_sku(),
			'edit' => $edit,
			'view' => $view,
		);

		if( $product->is_type( 'simple' ) ){

			$product_data['type'] = 'simple';
			$product_data['stock'] = $product->get_stock_quantity();
			$product_data['MEL'] = get_post_meta($product_id, 'ra_stock_at_MEL', true);
			$product_data['JET'] = get_post_meta($product_id, 'ra_stock_at_JET', true);
			$product_data['SYD'] = get_post_meta($product_id, 'ra_stock_at_SYD', true);
			$product_data['PER'] = get_post_meta($product_id, 'ra_stock_at_PER', true);

		} elseif( $product->is_type( 'variable' ) ){
			$product_variations = $product->get_available_variations();
			foreach ($product_variations as $key => $item) {
				$product_variations[$key]['menu_order'] = get_post_field('menu_order', $item['variation_id']);
			}

			usort($product_variations, function($a, $b) {
				return $a['menu_order'] - $b['menu_order'];
			});
			$variations = array();
			foreach ($product_variations as $variation) {
				$variations[$variation['variation_id']] = array(
					'var_ID' => $variation['variation_id'],
					'sku' => $variation['sku'],
					'attributes' => implode(', ', array_values($variation['attributes'])),
					'stock' => $variation['max_qty'],
					'MEL' => get_post_meta($variation['variation_id'], 'ra_stock_at_MEL', true),
					'JET' => get_post_meta($variation['variation_id'], 'ra_stock_at_JET', true),
					'SYD' => get_post_meta($variation['variation_id'], 'ra_stock_at_SYD', true),
					'PER' => get_post_meta($variation['variation_id'], 'ra_stock_at_PER', true),
				);
			}
			$product_data['type'] = 'variable';
			$product_data['variations'] = $variations;
		}
		$all_products[] = $product_data;
    endwhile; endif;
	wp_reset_postdata();



	echo '<table class="">';
	echo '<thead>';
	echo '<tr align="left">';
		echo '<th style="padding: 6px 8px;">ID</th>';
		echo '<th style="padding: 6px 8px;">Name</th>';
		echo '<th style="padding: 6px 8px;">SKU</th>';
		echo '<th style="padding: 6px 8px;">VAR ID</th>';
		echo '<th style="padding: 6px 8px;">VAR SKU</th>';
		echo '<th style="padding: 6px 8px;">VAR Attribute</th>';
		echo '<th style="padding: 6px 8px;">Stock</th>';
		echo '<th style="padding: 6px 8px;">MEL</th>';
		echo '<th style="padding: 6px 8px;">JET</th>';
		echo '<th style="padding: 6px 8px;">SYD</th>';
		echo '<th style="padding: 6px 8px;">PER</th>';
	echo '</tr>';
	echo '</thead>';
	foreach ($all_products as $key => $value) {
		if ($key % 2 == 0) {
			$class = "alternate";
		}

		if ($value['type'] === 'simple') {
			echo '<tr class="' .$class. '">';
				echo '<td style="padding: 6px 8px;">' . $value['ID'] . '<br><a href="' . $value['edit'] . '">edit</a> <a href="' . $value['view'] . '">view</a></td>';
				echo '<td style="padding: 6px 8px;">' . $value['name'] . '</td>';
				echo '<td style="padding: 6px 8px;">' . $value['sku'] . '</td>';

				echo '<td style="padding: 6px 8px;"></td>'; // Var id
				echo '<td style="padding: 6px 8px;"></td>'; // var sku
				echo '<td style="padding: 6px 8px;"></td>'; // var attribute

				echo '<td style="padding: 6px 8px;">' . $value['stock'] . '</td>';
				echo '<td style="padding: 6px 8px;">' . $value['MEL'] . '</td>';
				echo '<td style="padding: 6px 8px;">' . $value['JET'] . '</td>';
				echo '<td style="padding: 6px 8px;">' . $value['SYD'] . '</td>';
				echo '<td style="padding: 6px 8px;">' . $value['PER'] . '</td>';
			echo '</tr>';
		} else {
			$count = 0;
			foreach ($value['variations'] as $key => $var) {
				echo '<tr class="' .$class. '">';
				if ($count === 0) {
					$rowsspan = '';
					if (count($value['variations']) > 0) {
						$rowsspan = 'rowspan="' . count($value['variations']) . '"';
					}

					echo '<td style="padding: 6px 8px;" ' . $rowsspan . '>' . $value['ID'] . '<br><a href="' . $value['edit'] . '">edit</a> <a href="' . $value['view'] . '">view</a></td>';
					echo '<td style="padding: 6px 8px;" ' . $rowsspan . '>' . $value['name'] . '</td>';
					echo '<td style="padding: 6px 8px;" ' . $rowsspan . '>' . $value['sku'] . '</td>';
				}
				echo '<td style="padding: 6px 8px;">' . $var['var_ID'] . '</td>';
				echo '<td style="padding: 6px 8px;">' . $var['sku'] . '</td>';
				echo '<td style="padding: 6px 8px;">' . $var['attributes'] . '</td>';

				echo '<td style="padding: 6px 8px;">' . $var['stock'] . '</td>';
				echo '<td style="padding: 6px 8px;">' . $var['MEL'] . '</td>';
				echo '<td style="padding: 6px 8px;">' . $var['JET'] . '</td>';
				echo '<td style="padding: 6px 8px;">' . $var['SYD'] . '</td>';
				echo '<td style="padding: 6px 8px;">' . $var['PER'] . '</td>';

				echo '</tr>';
				$count++;
			}
		}
	}
	echo '</table>';



	echo '<br>';
	echo '<br>';
	echo '<br>';
	echo '<h3>Fixings required</h3>';
	$file_name = 'fixings-required.csv';
	if (current_site() === 'uk') {
		$file_name = 'fixings-required-uk.csv';
	}
	$file = file(ASSETS . '/files/' . $file_name);

	$csv = array_map('str_getcsv', $file);
	echo '<table class="">';
	foreach ($csv as $key => $value) {
		if ($key === 0) {
			echo '<thead>';
			echo '<tr align="left">';
			foreach ($value as $item) {
				echo '<th style="padding: 6px 8px;">' . $item . '<th>';
			}
			echo '</tr>';
			echo '</thead>';
		} else {
			$class="";
			if ($key % 2 == 0) {
				$class = "alternate";
			}
			echo '<tr class="' .$class. '">';
			foreach ($value as $item) {
				echo '<td style="padding: 6px 8px;">' . $item . '<td>';
			}
			echo '</tr>';
		}
	}
	echo '</table>';
}


// Automatically add/remove free driver bit product when it has eligible. Also add free Pegs and Spike based on requirements.
add_action( 'woocommerce_before_calculate_totals', 'remove_cart_items_conditionally', 10, 1 );
function remove_cart_items_conditionally( $cart ) {
	$free_products = get_field('free_products', 'options');
	if (isset($free_products['driver_bit']->ID) && !is_dealer_user()) {
		$free_driverbit = wc_get_product( $free_products['driver_bit']->ID );
		if ($free_driverbit) { $free_driverbit_id = $free_driverbit->get_id(); }
		// $eligible_free_driverbit_skus = array('TSCZ12G-B20', 'TSCZ12G-B50', 'TSCZ12G-B250', 'TSDM12G-B20', 'TSDM12G-B250');
		$eligible_free_driverbit_skus = array('TSCZ12G-B20', 'TSCZ12G-B20-BLK', 'TSCZ12G-B50', 'TSCZ12G-B50-BLK', 'TSCZ12G-B250', 'TSCZ12G-B250-BLK', 'TSDM12G-B20', 'TSDM12G-B20-BLK', 'TSDM12G-B50', 'TSDM12G-B50-BLK', 'TSDM12G-B250', 'TSDM12G-B250-BLK');

		if (isset($free_products['skus_for_free_driver_bit']) && $free_products['skus_for_free_driver_bit']) {
			$free_products['skus_for_free_driver_bit'] = explode(',', $free_products['skus_for_free_driver_bit']);
			if ($free_products['skus_for_free_driver_bit'] && count($free_products['skus_for_free_driver_bit']) > 0) {
				foreach ($free_products['skus_for_free_driver_bit'] as $sku) {
					$sku = trim($sku);
					if (!in_array($sku, $eligible_free_driverbit_skus)) {
						$eligible_free_driverbit_skus[] = $sku;
					}
				}
			}
		}
	}

	if (isset($free_products['free_spike']->ID)) {
		$free_spike = wc_get_product( $free_products['free_spike']->ID );
		if ($free_spike && $free_spike->is_in_stock()) {
			$free_spike_id = $free_spike->get_id();
			$free_spike_stock = user_warehouse_qty($free_spike->get_sku());
			if (!$free_spike_stock) {
				$free_spike_stock = -1;
			}
		}
	}
	if (isset($free_products['free_peg']->ID)) {
		$free_peg_ws = wc_get_product( $free_products['free_peg']->ID );
		if ($free_peg_ws && $free_peg_ws->is_in_stock()) {
			$free_peg_ws_id = $free_peg_ws->get_id();
			$free_peg_ws_stock = user_warehouse_qty($free_peg_ws->get_sku());
			if (!$free_peg_ws_stock) {
				$free_peg_ws_stock = -1;
			}
		}
	}
	if (isset($free_products['free_peg_galvanised']->ID)) {
		$free_peg_gs = wc_get_product( $free_products['free_peg_galvanised']->ID );
		if ($free_peg_gs && $free_peg_gs->is_in_stock()) {
			$free_peg_gs_id = $free_peg_gs->get_id();
			$free_peg_gs_stock = user_warehouse_qty($free_peg_gs->get_sku());
			if (!$free_peg_gs_stock) {
				$free_peg_gs_stock = -1;
			}
		}
	}

	$eligible_free_driverbit = false;
	$driverbit_found = false;
	$driverbit_cart_key = null;

	$req_FreeSpike = 0;
	$FreeSpike_incart = 0;
	$FreeSpike_cart_key = null;

	$req_FreePegs_ws = 0;
	$FreePegs_ws_incart = 0;
	$FreePegs_ws_cart_key = null;

	$req_FreePegs_gs = 0;
	$FreePegs_gs_incart = 0;
	$FreePegs_gs_cart_key = null;


	if ( count( $cart->get_cart() ) > 0 ) {

		$sku_info = get_sku_info();

		foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$_product_sku = $_product->get_sku();
			$_qty = $cart_item['quantity'];

			// Check if eligible for driver bit and if it already exists in cart or not.
			if ($free_driverbit_id) {
				if ( $_product->get_id() === $free_driverbit_id ) {
					$driverbit_found = true;
					$driverbit_cart_key = $cart_item_key;
				}
				if (in_array($_product_sku, $eligible_free_driverbit_skus)) {
					$eligible_free_driverbit = true;
				}
			}

			// Check how many FreeSpike required and how many exists in cart.
			if ($free_spike_id) {
				if ( $_product->get_id() == $free_spike_id ) {
					$FreeSpike_incart = $_qty;
					$FreeSpike_cart_key = $cart_item_key;
				}
				if (isset($sku_info[$_product_sku]['FreeSpike']) && $sku_info[$_product_sku]['FreeSpike'] > 0) {
					$req_FreeSpike = $req_FreeSpike + ($sku_info[$_product_sku]['FreeSpike'] * $_qty);
				}
			}

			// Check how many FreePegs required and how many exists in cart.
			if ($free_peg_ws_id) {
				if ( $_product->get_id() == $free_peg_ws_id ) {
					$FreePegs_ws_incart = $_qty;
					$FreePegs_ws_cart_key = $cart_item_key;
				}
				if (isset($sku_info[$_product_sku]['FreePegs']) && $sku_info[$_product_sku]['FreePegs'] > 0 && (!$sku_info[$_product_sku]['Material'] || $sku_info[$_product_sku]['Material'] === 'WEATHERING STEEL')) {
					$req_FreePegs_ws = $req_FreePegs_ws + ($sku_info[$_product_sku]['FreePegs'] * $_qty);
				}
			}

			// Check how many FreePegs required and how many exists in cart.
			if (isset($free_peg_gs_id) && $free_peg_gs_id) {
				if ( $_product->get_id() == $free_peg_gs_id ) {
					$FreePegs_gs_incart = $_qty;
					$FreePegs_gs_cart_key = $cart_item_key;
				}
				if (isset($sku_info[$_product_sku]['FreePegs']) && $sku_info[$_product_sku]['FreePegs'] > 0 && $sku_info[$_product_sku]['Material'] && $sku_info[$_product_sku]['Material'] === 'GALVANISED STEEL') {
					$req_FreePegs_gs = $req_FreePegs_gs + ($sku_info[$_product_sku]['FreePegs'] * $_qty);
				}
			}
		}


		// Free Driverbit add or remove from cart based on eligible for free drive bit
		if ( !$eligible_free_driverbit && $driverbit_found ) {
			$cart->remove_cart_item( $driverbit_cart_key );
		} elseif ($eligible_free_driverbit && !$driverbit_found && $free_driverbit_id && $free_driverbit->is_in_stock() ) {
			WC()->cart->add_to_cart( $free_driverbit_id );
		}


		// Add or remove FreeSpike based on how many required and how many needds. Make sure this doen't fall into continues loop of addding and removing products
		if ($free_spike_id && $req_FreeSpike && $req_FreeSpike !== $FreeSpike_incart) {
			if ($FreeSpike_cart_key && ($free_spike_stock === -1 || $free_spike_stock >= $req_FreeSpike)) {
				WC()->cart->set_quantity($FreeSpike_cart_key, $req_FreeSpike);
			} elseif ($free_spike_stock === -1 || $free_spike_stock >= $req_FreeSpike) {
				WC()->cart->add_to_cart( $free_spike_id, $req_FreeSpike );
			}
		} elseif ($FreeSpike_cart_key && $req_FreeSpike === 0) {
			$cart->remove_cart_item( $FreeSpike_cart_key );
		}


		// Add or remove FreeSpike WEATHERING based on how many required and how many needds. Make sure this doen't fall into continues loop of addding and removing products
		if ($free_peg_ws_id && $req_FreePegs_ws && $req_FreePegs_ws !== $FreePegs_ws_incart) {
			if ($FreePegs_ws_cart_key && ($free_peg_ws_stock === -1 || $free_peg_ws_stock >= $req_FreePegs_ws)) {
				WC()->cart->set_quantity($FreePegs_ws_cart_key, $req_FreePegs_ws);
			} elseif ($free_peg_ws_stock === -1 || $free_peg_ws_stock >= $req_FreePegs_ws) {
				WC()->cart->add_to_cart( $free_peg_ws_id, $req_FreePegs_ws );
			}
		} elseif ($FreePegs_ws_cart_key && $req_FreePegs_ws === 0) {
			$cart->remove_cart_item( $FreePegs_ws_cart_key );
		}


		// Add or remove FreeSpike GALVANISED based on how many required and how many needds. Make sure this doen't fall into continues loop of addding and removing products
		if (isset($free_peg_gs_id) && $free_peg_gs_id && $req_FreePegs_gs && $req_FreePegs_gs !== $FreePegs_gs_incart) {
			if ($FreePegs_gs_cart_key && ($free_peg_gs_stock === -1 || $free_peg_gs_stock >= $req_FreePegs_gs)) {
				WC()->cart->set_quantity($FreePegs_gs_cart_key, $req_FreePegs_gs);
			} elseif ($free_peg_gs_stock === -1 || $free_peg_gs_stock >= $req_FreePegs_gs) {
				WC()->cart->add_to_cart( $free_peg_gs_id, $req_FreePegs_gs );
			}
		} elseif ($FreePegs_gs_cart_key && $req_FreePegs_gs === 0) {
			$cart->remove_cart_item( $FreePegs_gs_cart_key );
		}

	}
}


// To remove the text "(includes AMOUNT VAT estimated for the United Kingdom (UK))" and make it simple like "(includes £29.86 VAT)"
add_filter( 'woocommerce_cart_totals_order_total_html', 'ra_cart_totals_order_total_html', 20, 1 );
function ra_cart_totals_order_total_html( $value ){
    $value = '<strong>' . WC()->cart->get_total() . '</strong> ';
    // If prices are tax inclusive, show taxes here.
    $incl_tax_display_cart = version_compare( WC_VERSION, '3.3', '<' ) ? WC()->cart->tax_display_cart == 'incl'  : WC()->cart->display_prices_including_tax();
    if ( wc_tax_enabled() && $incl_tax_display_cart ) {
        $tax_string_array = array();
        $cart_tax_totals  = WC()->cart->get_tax_totals();

        if ( get_option( 'woocommerce_tax_total_display' ) == 'itemized' ) {
            foreach ( $cart_tax_totals as $code => $tax ) {
                $tax_string_array[] = sprintf( '%s %s', $tax->formatted_amount, $tax->label );
            }
        } elseif ( ! empty( $cart_tax_totals ) ) {
            $tax_string_array[] = sprintf( '%s %s', wc_price( WC()->cart->get_taxes_total( true, true ) ), WC()->countries->tax_or_vat() );
        }

        if ( ! empty( $tax_string_array ) ) {
            $taxable_address = WC()->customer->get_taxable_address();
            $estimated_text  = '';
            $value .= '<small class="includes_tax">' . sprintf( __( '(includes %s)', 'woocommerce' ), implode( ', ', $tax_string_array ) . $estimated_text ) . '</small>';
        }
    }
    return $value;
}


function get_sku_info() {
	$file_name = 'fixings-required.csv';
	if (current_site() === 'uk') {
		$file_name = 'fixings-required-uk.csv';
	}
	$file = file(ASSETS . '/files/' . $file_name);

	$csv = array_map('str_getcsv', $file);
	array_shift($csv);
	$info = array();

	/*
		CSV columns
		0. SKU,
		1. Bulk Quantity,
		2. Material,
		3. ReqScrew,
		4. ScrewType,
		5. FreePegs,
		6. FreeSpike
		7. Bulk SKU
		8. Manage Stock
	*/
	foreach ($csv as $value) {
		$sku = trim( $value[0] );
		$material = strtoupper( trim( $value[2] ) );
		$req = intval(trim($value[3]));
		$type = trim($value[4]);
		$freePegs = intval(trim($value[5]));
		$freeSpike = intval(trim($value[6]));
		$blkQty = intval(trim($value[1]));
		$blkSku = trim( $value[7] );
		$manageStock = trim( $value[8] ) === 'TRUE';

		$result = array();
		if ($req && $req > 0) {
			$result['ReqScrew'] = $req;
			$result['ScrewType'] = $type;
		}
		if ($freePegs && $freePegs > 0) {
			$result['FreePegs'] = $freePegs;
		}
		if ($freeSpike && $freeSpike > 0) {
			$result['FreeSpike'] = $freeSpike;
		}
		if ($blkQty && $blkQty > 0) {
			$result['blkQty'] = $blkQty;
		}
		if ($blkSku) {
			$result['blkSku'] = $blkSku;
		}
		if ($manageStock) {
			$result['manageStock'] = $manageStock;
		}

		// if (count($result) > 0) {
			if ($material) {
				$result['Material'] = $material;
			}
			$info[$sku] = $result;
		// }
	}

	return $info;
}

function get_stock_info() {
	$file = file(ASSETS . '/files/stock.csv');
	$rows   = array_map('str_getcsv', $file);
    $header = array_shift($rows); // get headers
	array_shift($header); // remove first label as it shoud be SKU
    $csv    = array();
    foreach($rows as $row) {
		$sku = $row[0];
		array_shift($row); // remove SKU from array
		$csv[$sku] = array_combine($header, $row);
    }
	return $csv;
}


// Add region code to order number
add_filter( 'woocommerce_order_number', 'change_woocommerce_order_number' );
function change_woocommerce_order_number( $order_id ) {
    $prefix = '';
    $suffix = '';
	$current_site = current_site();
	if ($current_site) {
    	$prefix = strtoupper($current_site) .  '-';
	}
    $new_order_id = $prefix . $order_id . $suffix;
    return $new_order_id;
}


// #########   START CUSTOM FIELD: ra_reference_field, Brochure, forklift_available   #########
// Add custom field to the checkout page
add_action('woocommerce_after_order_notes', 'ra_reference_field');
function ra_reference_field($checkout) {
	// if (is_dealer_user()) {
		echo '<div id="ra_reference_field"><h3>' . __('Your Reference') . '</h3>';
		woocommerce_form_field('ra_reference_field', array(
			'type' => 'text',
			'class' => array(
				'reference-field-class form-row-wide'
			),
			'label' => __('Enter your purchase order number here'),
			'placeholder' => __(''),
		), $checkout->get_value('ra_reference_field'));
		echo '</div>';
	// }

	// if (is_pro_user() && current_site() === 'au') {
	// 	echo '<div id="ra_add_brochures">';
	// 	woocommerce_form_field('ra_add_brochures', array(
	// 		'type' => 'checkbox',
	// 		'class' => array(
	// 			'reference-field-class form-row-wide'
	// 		),
	// 		'label' => __('<span>Add 5 brochures to my order</span>'),
	// 		'placeholder' => __(''),
	// 	), $checkout->get_value('ra_add_brochures'));
	// 	echo '</div>';
	// }

}

// Validate custom field
add_action('woocommerce_checkout_process', 'ra_reference_field_validation');
function ra_reference_field_validation() {
	if ($_POST['ra_reference_field'] && strlen($_POST['ra_reference_field']) > 100) {
		wc_add_notice(__('Reference number too long! Max character length is 100') , 'error');
	}
}

// Update the value given in custom field
add_action('woocommerce_checkout_update_order_meta', 'ra_reference_field_update_order_meta');
function ra_reference_field_update_order_meta($order_id) {
	if (!empty($_POST['ra_reference_field'])) {
		update_post_meta($order_id, 'ra_reference_field', sanitize_text_field($_POST['ra_reference_field']));
	}

	if (current_site() === 'au' && !empty($_POST['ra_add_brochures']) && $_POST['ra_add_brochures']) {
		update_post_meta($order_id, 'ra_add_brochures', sanitize_text_field($_POST['ra_add_brochures']));
	}

	if (current_site() === 'au' && required_forklift_available() && $_POST['forklift_available']) {
		update_post_meta($order_id, 'forklift_available', sanitize_text_field($_POST['forklift_available']));
	}
}

// Display field value on the order edit page
add_action( 'woocommerce_admin_order_data_after_billing_address', 'ra_reference_field_display_admin_order_meta', 10, 1 );
function ra_reference_field_display_admin_order_meta($order){
	$ra_reference_field = get_post_meta( $order->id, 'ra_reference_field', true );
	if ($ra_reference_field) {
		echo '<p class="form-field form-field-wide"><strong>'.__('Reference').':</strong> <br/>' . $ra_reference_field . '</p>';
	}

	$forklift_available = get_post_meta( $order->id, 'forklift_available', true );
	if ($forklift_available) {
		echo '<p class="form-field form-field-wide"><strong>'.__('Will there be a Forklift at the delivery address?').':</strong> <br/>' . $forklift_available . '</p>';
	}

	$ra_add_brochures = get_post_meta( $order->id, 'ra_add_brochures', true );
	if ($ra_add_brochures) {
		echo '<p class="form-field form-field-wide"><strong>'.__('Add 5 brochures to my order?').':</strong> Yes</p>';
	}
}
// #########   END CUSTOM FIELD: ra_reference_field, Brochure, forklift_available   #########



// Set a minimum order amount required for checkout
add_action( 'woocommerce_checkout_process', 'ra_minimum_order_amount' );
add_action( 'woocommerce_before_cart' , 'ra_minimum_order_amount' );
function ra_minimum_order_amount() {
    // Set this variable to specify a minimum order value
    $minimum = ra_get_minimum_order_amount();

    if ( WC()->cart->get_subtotal() < $minimum ) {
        if( is_cart() ) {
            wc_print_notice(
                sprintf( 'Webshop payment options are activated once the minimum order value of %s is reached ' ,
                    wc_price( $minimum )
                ), 'error'
            );
        } else {
            wc_add_notice(
                sprintf( 'Webshop payment options are activated once the minimum order value of %s is reached' ,
                    wc_price( $minimum )
                ), 'error'
            );
        }
    }

	// validate if relevant warehouse has enough in stock
	if (current_site() === 'au') {
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product   	= apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$_product_sku 	= $_product->get_sku();
			$max_qty 		= user_warehouse_qty($_product_sku);
			$_qty = $cart_item['quantity'];
			if ($max_qty !== -1 && $_qty > $max_qty) {
				$_product_title = $_product->get_name();
				wc_add_notice(
					sprintf( 'Sorry, we do not have enough "%s" in stock to fulfil your order (%s available). We apologise for any inconvenience caused.',
						$_product_title,
						$max_qty
					), 'error'
				);
			}
		}
	}

	if (required_forklift_available() && !get_forklift_available()) {
		wc_add_notice( 'Please answer: Will there be a Forklift at the delivery address?', 'error' );
	}
}

function ra_get_minimum_order_amount() {
	$value = 0;
	if (( is_dealer_user() || is_pro_user() ) && current_site() === 'au') {
		$value = 500;
	}
	return $value;
}


add_filter( 'woocommerce_email_format_string' , 'add_custom_email_placeholder_string', 10, 2 );
function add_custom_email_placeholder_string( $string, $email ) {
    $order = $email->object;
    $placeholder = '{warehouse_code}';
	$state = '';
	if (isset($order->shipping_state)) {
		$state = $order->shipping_state;
	} elseif (isset($order->billing_state)) {
		$state = $order->billing_state;
	}
	$value = warehouse_code_by_state($state);
	return str_replace( $placeholder, $value, $string );
}




add_filter( 'woocommerce_email_recipient_new_order', 'add_warehouse_email_recipient', 9999, 3 );
function add_warehouse_email_recipient( $recipient, $order ) {

	if (is_live()) {
		$warehouse_recipients = array(
			// 'SYD' => '',
			'PER' => 'straightcurve@bcr.com.au',
			'JET' => 'acacia.orders@efmlogistics.com.au',
			'MEL' => 'customer.service@prompt.com.au',
		);
	} else {
		$warehouse_recipients = array(
			'SYD' => 'jaydev+1@rockagency.com.au',
			'PER' => 'jaydev+2@rockagency.com.au',
			'JET' => 'jaydev+3@rockagency.com.au',
			'MEL' => 'jaydev+4@rockagency.com.au',
		);
	}

	$state = '';
	if (isset($order->shipping_state)) {
		$state = $order->shipping_state;
	} elseif (isset($order->billing_state)) {
		$state = $order->billing_state;
	}

	$warehouse_code = warehouse_code_by_state($state);

	if ($warehouse_code && $warehouse_recipients[$warehouse_code]) {
		$recipient .= ', ' . $warehouse_recipients[$warehouse_code];
	}
	return $recipient;
}




function warehouse_code_by_state($state) {
	$value = '';
	$codes = array(
		'ACT' => 'SYD',
		'NSW' => 'SYD',
		'NT'  => 'PER',
		// 'QLD' => 'JET',
		'QLD' => 'SYD',
		'SA'  => 'MEL',
		'TAS' => 'MEL',
		'VIC' => 'MEL',
		'WA'  => 'PER',
	);
	if (current_site() === 'au' && $state && isset($codes[$state]) && $codes[$state]) {
		$value = $codes[$state];
	}
	return $value;
}

function get_warehouses() {
	$warehouses = array();
	if (current_site() === 'au') {
		$warehouses = array(
			'JET' => array(
				'code' => 'JET',
				'name' => 'EFM Warehousing',
				'address' => '30 Bellrick St, Acacia Ridge QLD 4110',
				'pickup_hours' => 'Collection hours - 7am to 3pm Mon/Fri',
				'Cin7Id' => 5
			),
			'PER' => array(
				'code' => 'PER',
				'name' => 'WLA',
				'address' => '33 McDowell St, Welshpool WA',
				'pickup_hours' => 'Collection hours - 8am to 3.30pm Mon-Fri',
				'Cin7Id' => 7
			),
			'MEL' => array(
				'code' => 'MEL',
				'name' => 'Prompt Distribution',
				'address' => '91-105 Freight Dr, Somerton VIC 3062',
				'pickup_hours' => 'Collection hours 8am to 4pm Mon/Fri',
				'Cin7Id' => 227
			),
			'SYD' => array(
				'code' => 'SYD',
				'name' => 'SKU Logistics',
				'address' => 'Units 1, 2, 3, 6 Foray St, Yennora NSW 2161',
				'pickup_hours' => 'Collection hours 6.30am to 4.30pm Mon/Fri',
				'Cin7Id' => 6
			)
		);
	}

	return $warehouses;
}

function user_warehouse_qty($sku, $stock = null) {
	if ($sku && WC()->customer->shipping['state']) {
		// $stock_info = get_stock_info();
		$warehouse_code = warehouse_code_by_state(WC()->customer->shipping['state']);
		$product_id = wc_get_product_id_by_sku($sku);
		$manage_stock = get_post_meta($product_id, '_manage_stock', true) === 'yes';
		if ($manage_stock && $product_id && $warehouse_code) {
			$stock = get_post_meta($product_id, 'ra_stock_at_' . $warehouse_code, true);
		}
		// if ($warehouse_code && isset($stock_info[$sku][$warehouse_code]) && is_numeric($stock_info[$sku][$warehouse_code])) {
		// 	$stock = $stock_info[$sku][$warehouse_code];
		// }
	}

	if (!is_numeric($stock)) {
		$product_id = wc_get_product_id_by_sku( $sku );
		if ( $product_id != null ) {
			$product = wc_get_product($product_id);
			if ($product->is_in_stock()) {
				$stock = apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product );
			} else {
				$stock = 0;
			}
		}
	}

	return $stock;
}


// Add default order note to order note field in checkout
add_filter( 'woocommerce_checkout_fields', 'ra_prefilled_order_comments' );
function ra_prefilled_order_comments( $fields ) {
	$user_id = get_current_user_id();
	if ($user_id) {
		$default_text = get_user_meta($user_id, 'ra_prefilled_order_comments', true);
		if ($default_text) {
    		$fields['order']['order_comments']['default'] = $default_text;
		}
	}
	if (current_site() === 'au' && (is_pro_user() || is_dealer_user())) {
		$fields['billing']['billing_email']['custom_attributes'] = array('readonly'=>'readonly');
		$fields['billing']['billing_company']['custom_attributes'] = array('readonly'=>'readonly');
		$fields['shipping']['shipping_email']['custom_attributes'] = array('readonly'=>'readonly');
		$fields['shipping']['shipping_company']['custom_attributes'] = array('readonly'=>'readonly');
	}
    return $fields;
}

// Add default order note on edit user section
add_action( 'show_user_profile', 'ra_extra_user_meta_fields' );
add_action( 'edit_user_profile', 'ra_extra_user_meta_fields' );
function ra_extra_user_meta_fields( $user ) { ?>
    <table class="form-table">
    	<tr>
        	<th><label for="ra_prefilled_order_comments"><?php _e("Default Order Note"); ?></label></th>
        	<td>
				<textarea name="ra_prefilled_order_comments" id="ra_prefilled_order_comments" rows="5" cols="30"><?php echo esc_attr( get_the_author_meta( 'ra_prefilled_order_comments', $user->ID ) ); ?></textarea>
        	</td>
    	</tr>
    </table>
<?php }

// Save default order note field value on edit user section
add_action( 'personal_options_update', 'ra_save_extra_user_meta_fields' );
add_action( 'edit_user_profile_update', 'ra_save_extra_user_meta_fields' );
function ra_save_extra_user_meta_fields( $user_id ) {

    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;

	$order_note = '';
	if ($_POST['ra_prefilled_order_comments']) {
		$order_note = sanitize_textarea_field($_POST['ra_prefilled_order_comments']);
	}
    update_user_meta( $user_id, 'ra_prefilled_order_comments', $order_note );
}


// Save default order note field value on edit address section from my-account
add_action( 'woocommerce_customer_save_address', 'ra_save_woo_user_meta_fields', 10, 2 );
function ra_save_woo_user_meta_fields( $user_id, $load_address ){
	$order_note = '';
	if ($_POST['ra_prefilled_order_comments']) {
		$order_note = sanitize_textarea_field($_POST['ra_prefilled_order_comments']);
	}
    update_user_meta( $user_id, 'ra_prefilled_order_comments', $order_note );
}


function credit_status() {
	$status = null;
	if (function_exists( '_wc_cs' )) {
		$wc_credits = _wc_cs()->dashboard->get_credits();
		if ($wc_credits) {
			$status = $wc_credits->get_status();
		}
	}
	return $status;
}








// TAIL-LIFT Truck feature on checkout
add_action( 'wp_ajax_nopriv_ra_update_forklift_available', 'ra_update_forklift_available' );
add_action( 'wp_ajax_ra_update_forklift_available', 'ra_update_forklift_available' );
function ra_update_forklift_available() {
	$value = esc_attr( sanitize_text_field( $_POST['value'] ) );
	$result = array('value' => $value);

	$result['set'] = set_forklift_available($value);

	$result = json_encode($result);
    wp_die($result);
}

function set_forklift_available($value = null) {
	$value = esc_attr( sanitize_text_field( $value ) );
	$set = false;
	if ($value && ($value === 'Yes' || $value === 'No') && required_forklift_available()) {
		$set = true;
	}

	if ($set) {
    	WC()->session->set('forklift_available', $value );
	} elseif ( WC()->session->__isset('forklift_available') ) {
    	WC()->session->__unset('forklift_available');
	}
	return $set;
}

function get_forklift_available() {
	$value = null;
	if ( WC()->session->__isset('forklift_available') ) {
		$value = WC()->session->forklift_available;
	}
	return $value;
}

function required_forklift_available() {
	$required = false;
	$subtotal = WC()->cart->get_subtotal();
	if (is_pro_user() && current_site() === 'au' && $subtotal && $subtotal > 1300 && WC()->session->__isset('chosen_shipping_methods')) {
		$chosen_shipping = WC()->session->get('chosen_shipping_methods');
		if ($chosen_shipping && count($chosen_shipping) > 0 && $chosen_shipping[0] !== 'local_pickup:4') {
			$required = true;
		}
	}
	return $required;
}

function clear_forklift_session() {
	if ( WC()->session->__isset('forklift_available') ) {
		WC()->session->__unset('forklift_available');
	}
}

// The order amount must be set to the lowest amount required for any user in the backend otherwise the $is_available will be false the the free shipping won't apply to any user.
add_filter( 'woocommerce_shipping_free_shipping_is_available', 'check_if_free_shipping_available' );
function check_if_free_shipping_available( $is_available ) {
	$allow = true;
	$cart_total = WC()->cart->get_subtotal();
	if (current_site() === 'au' && is_pro_user() && $cart_total < 2000) {
		$allow = false;
	}
	if (current_site() === 'au' && is_dealer_user() && $cart_total < 1500) {
		$allow = false;
	}
	return $is_available && $allow;
}


add_action( 'woocommerce_cart_calculate_fees','taillift_truck_additional_charges' );
function taillift_truck_additional_charges( $cart_object ) {
	if (is_admin() && !defined('DOING_AJAX')) {
		return;
	}
	if (required_forklift_available() && get_forklift_available() && get_forklift_available() === 'No') {
		// WC()->cart->add_fee('Tail-lift truck fee', 150.00, true );
		WC()->cart->add_fee('Tail-lift truck / hand unloading fee', 150.00, true );
	}

	$freight_levy_fee = get_field('freight_levy_fee', 'options');
	if (isset($freight_levy_fee['fee_title']) && $freight_levy_fee['fee_title']) {

		$is_local_pickup = false;
		if (WC()->session->__isset('chosen_shipping_methods')) {
			$chosen_shipping = WC()->session->get('chosen_shipping_methods');
			$chosen_shipping = isset($chosen_shipping[0]) ? explode(':', $chosen_shipping[0]) : '';
			if (isset($chosen_shipping[0]) && $chosen_shipping[0] === 'local_pickup') {
				$is_local_pickup = true;
			}
		}

		if (!$is_local_pickup && isset($freight_levy_fee['dealer_user_fee']) && $freight_levy_fee['dealer_user_fee'] && $freight_levy_fee['dealer_user_fee'] > 0 && is_dealer_user()) {
			WC()->cart->add_fee($freight_levy_fee['fee_title'], $freight_levy_fee['dealer_user_fee'], true );
		} elseif (!$is_local_pickup && isset($freight_levy_fee['pro_user_fee']) && $freight_levy_fee['pro_user_fee'] && $freight_levy_fee['pro_user_fee'] > 0 && is_pro_user()) {
			WC()->cart->add_fee($freight_levy_fee['fee_title'], $freight_levy_fee['pro_user_fee'], true );
		}
	}
}




add_filter( 'wpo_wcpdf_filename', 'wpo_wcpdf_custom_filename', 10, 4 );
function wpo_wcpdf_custom_filename( $filename, $template_type, $order_ids, $context ) {
	$invoice_string = _n( 'invoice', 'invoices', count($order_ids), 'woocommerce-pdf-invoices-packing-slips' );
	$new_prefix = _n( 'Sales-Order', 'Sales-Order', count($order_ids), 'woocommerce-pdf-invoices-packing-slips' );
	$new_filename = str_replace($invoice_string, $new_prefix, $filename);

	return $new_filename;
}


add_action( 'wc_cs_do_not_charge_late_fee', function( $credits ) {
    $credits->set_status( 'active' ) ;
} ) ;
add_action( 'wc_cs_charge_late_fee', function( $late_fee, $credits ) {
    $credits->set_status( 'active' ) ;
}, 10, 2 ) ;


add_action( 'woocommerce_thankyou', 'ra_update_order_note_field' );
function ra_update_order_note_field( $order_id ) {
	if (current_site() === 'au') {

		$order = wc_get_order( $order_id );
		$note = $order->get_customer_note();

		if ($order->has_shipping_method('local_pickup') && strpos($note, 'Collect from warehouse') === false) {
			$note .= ($note ? "\n\n " : "") . "Collect from warehouse";
		}

		$forklift_available = get_post_meta( $order_id, 'forklift_available', true );
		if ($forklift_available && $forklift_available === 'No' && strpos($note, 'Tail-lift truck required') === false) {
			$note .= ($note ? "\n\n " : "") . "Tail-lift truck required";
		}

		if ($note) {
			$order_data = array(
				'order_id' => $order_id,
				'customer_note' => $note
			);
			wc_update_order( $order_data );
		}

	}
}


// Disable free shipping methods for UK PRO users
add_filter( 'woocommerce_package_rates', 'define_default_shipping_method', 10, 2 );
function define_default_shipping_method( $rates, $package ) {
	if (current_site() === 'uk') {
		$free_shipping_id = 'free_shipping:23';
		if (is_live()) {
			$free_shipping_id = 'free_shipping:12';
		}

		if (is_pro_user()) {
			if ( isset( $rates[$free_shipping_id] ) ) {
				unset( $rates[$free_shipping_id] );
			}
		}
	}

	return $rates;
}





/**
 * @snippet       Add Cc: or Bcc: Recipient @ WooCommerce Completed Order Email
 * @reference     https://www.businessbloomer.com/woocommerce-add-to-cc-bcc-order-email-recipients/
 */
add_filter( 'woocommerce_email_headers', 'bbloomer_order_completed_email_add_cc_bcc', 9999, 3 );

function bbloomer_order_completed_email_add_cc_bcc( $headers, $email_id, $order ) {
    if ( current_site() === 'uk' && 'customer_completed_order' == $email_id ) {
        // $headers .= "Cc: Name <your@email.com>\r\n"; // delete if not needed
        $headers .= "Bcc: Trustpilot <straightcurve.com/uk+ba33a27785@invite.trustpilot.com>\r\n"; // delete if not needed
    }
    return $headers;
}