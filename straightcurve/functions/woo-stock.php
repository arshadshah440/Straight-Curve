<?php

// Inventory fields on Simple Product
add_action('woocommerce_product_options_inventory_product_data', 'ra_custom_inventory_fields');
// Inventory fields on Variations Product
add_action('woocommerce_variation_options_inventory', 'ra_variation_custom_inventory_fields', 10, 3);
// Save Inventory fields on product save
// add_action('woocommerce_process_product_meta', 'ra_save_custom_inventory_fields');
// Save Inventory fields on variation save
// add_action('woocommerce_save_product_variation', 'ra_save_variation_inventory_fields', 10, 2);

// Update stock when users places order
add_action('woocommerce_thankyou', 'ra_update_stock_on_order_placed',  10, 1);

function ra_custom_inventory_fields() {
	// Get the product ID
    $product_id = get_the_ID();
    $product = wc_get_product($product_id );
    $product_type = $product->get_type();
    if($product_type !== "simple"){ return; }

	$warehouses = get_warehouses();

    echo '<div id="warehouses_list">';
    foreach ($warehouses as $warehouse) {
        woocommerce_wp_text_input(array(
            'id'            => 'ra_product_' . $product_id . '_warehouses_code_' . $warehouse['code'],
            'label'         => __('Stock at ' . $warehouse['code']),
            'placeholder'   => __('Input stock'),
            'description'   => __('Enter the stock amount for ' . $warehouse['name'] . ' warehouse.'),
            'desc_tip'      => true,
            'class'         => 'woocommerce',
            'type'          => 'number',
			'custom_attributes' => array('readonly' => 'readonly'),
            'value'         => get_post_meta($product_id, 'ra_stock_at_' . $warehouse['code'], true),
        ));
    }
    echo '</div>';
}


function ra_variation_custom_inventory_fields($loop, $variation_data, $variation) {
    $warehouses = get_warehouses();

    echo '<div id="warehouses_variation_list">';
    foreach ($warehouses as $warehouse) {
        woocommerce_wp_text_input(array(
            'id'            => 'ra_product_' . $variation->ID . '_warehouses_code_' . $warehouse['code'],
            'label'         => __('Stock at ' . $warehouse['code']),
            'placeholder'   => __('Input stock'),
            'description'   => __('Enter the stock amount for ' . $warehouse['name'] . ' warehouse.'),
            'desc_tip'      => true,
            'class'         => 'woocommerce',
            'type'          => 'number',
			'custom_attributes' => array('readonly' => 'readonly'),
            'value'         => get_post_meta($variation->ID, 'ra_stock_at_' . $warehouse['code'], true),
        ));
    }
    echo '</div>';
}


function ra_save_custom_inventory_fields($post_id) {

    if (defined('DOING_AJAX') && DOING_AJAX)
        return $post_id;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;

    if (!current_user_can('edit_product', $post_id))
        return $post_id;

    // Get product object
    $product = wc_get_product($post_id);
    $product_type = $product->get_type();
    if($product_type !== "simple"){ return; }

    if (empty($product)) return;

    $warehouses = get_warehouses();
    $total_warehouses = count($warehouses);

    if( $product->is_type( 'simple' ) ) {
        $manage_stock = get_post_meta($post_id, '_manage_stock', true) === 'yes';
        if (!$manage_stock) {
            foreach ($warehouses as $warehouse) {
                delete_post_meta($post_id, 'ra_stock_at_' . $warehouse['code']);
            }
            return;
        }

        // Grab stock amount from all terms
        $product_terms_stock = array();

        // Grab input amounts
        $input_amounts = array();

        // Define counter
        $counter = 0;

        foreach ($warehouses as $warehouse) {
            $warehouse_code = $warehouse['code'];
            if (isset($_POST['ra_product_' . $post_id . '_warehouses_code_' . $warehouse_code])) {

                // Initiate counter
                $counter++;

                // Save input amounts to array
                $input_amounts[] = sanitize_text_field($_POST['ra_product_' . $post_id . '_warehouses_code_' . $warehouse_code]);

                // Get post meta
                $postmeta_stock_at_term = get_post_meta($post_id, 'ra_stock_at_' . $warehouse_code, true);

                // Pass terms stock to variable
                if ($postmeta_stock_at_term) {
                    $product_terms_stock[] = $postmeta_stock_at_term;
                }

                $stock_location_term_input = sanitize_text_field($_POST['ra_product_' . $post_id . '_warehouses_code_' . $warehouse_code]);

                // Check if the $_POST value is the same as the postmeta, if not update the postmeta
                if ($stock_location_term_input !== $postmeta_stock_at_term) {
                    // Update the post meta
                    update_post_meta($post_id, 'ra_stock_at_' . $warehouse_code, $stock_location_term_input);
                }

                // Update stock when reach the last term
                if ($counter === $total_warehouses) {
                    update_post_meta($post_id, '_stock', array_sum($input_amounts));
                }
            }
        }

        $product_terms_stock = array_sum($product_terms_stock);
        $stock_qty = array_sum($input_amounts);
        // Check if stock in terms exist
        if (!empty($product_terms_stock)) {
            // update stock status

            $product = wc_get_product($post_id);
            if (empty($product)) return;

            // backorder disabled
            if (!$product->is_on_backorder()) {
                if ($stock_qty > 0) {
                    update_post_meta($post_id, '_stock_status', 'instock');

                    // remove the link in outofstock taxonomy for the current product
                    wp_remove_object_terms($post_id, 'outofstock', 'product_visibility');
                } else {
                    update_post_meta($post_id, '_stock_status', 'outofstock');

                    // add the link in outofstock taxonomy for the current product
                    wp_set_post_terms($post_id, 'outofstock', 'product_visibility', true);
                }

                // backorder enabled
            } else {
                $current_stock_status = get_post_meta($post_id, '_stock_status', true);
                if ($stock_qty > 0 && $current_stock_status != 'instock') {
                    update_post_meta($post_id, '_stock_status', 'instock');
                    // remove the link in outofstock taxonomy for the current product
                    wp_remove_object_terms($post_id, 'outofstock', 'product_visibility');
                } else {
                    update_post_meta($post_id, '_stock_status', 'onbackorder');
                }
            }
        }
    } else {
        $variations = $product->get_available_variations();
        $variations_ids = wp_list_pluck( $variations, 'variation_id' );
        foreach($variations_ids as $variations_id) {
            $var_post_id = $variations_id;
            $manage_stock = get_post_meta($var_post_id, '_manage_stock', true) === 'yes';
            if (!$manage_stock) {
                foreach ($warehouses as $warehouse) {
                    delete_post_meta($var_post_id, 'ra_stock_at_' . $warehouse['code']);
                }
		        return;
            }


            // Grab stock amount from all terms
            $product_terms_stock = array();

            // Grab input amounts
            $input_amounts = array();

            // Define counter
            $counter = 0;

            foreach ($warehouses as $warehouse) {
                $warehouse_code = $warehouse['code'];
                if (isset($_POST['ra_product_' . $var_post_id . '_warehouses_code_' . $warehouse_code])) {

                    // Initiate counter
                    $counter++;

                    // Save input amounts to array
                    $input_amounts[] = sanitize_text_field($_POST['ra_product_' . $var_post_id . '_warehouses_code_' . $warehouse_code]);

                    // Get post meta
                    $postmeta_stock_at_term = get_post_meta($var_post_id, 'ra_stock_at_' . $warehouse_code, true);

                    // Pass terms stock to variable
                    if ($postmeta_stock_at_term) {
                        $product_terms_stock[] = $postmeta_stock_at_term;
                    }

                    $stock_location_term_input = sanitize_text_field($_POST['ra_product_' . $var_post_id . '_warehouses_code_' . $warehouse_code]);

                    // Check if the $_POST value is the same as the postmeta, if not update the postmeta
                    if ($stock_location_term_input !== $postmeta_stock_at_term) {
                        // Update the post meta
                        update_post_meta($var_post_id, 'ra_stock_at_' . $warehouse_code, $stock_location_term_input);
                    }

                    // Update stock when reach the last term
                    if ($counter === $total_warehouses) {
                        update_post_meta($var_post_id, '_stock', array_sum($input_amounts));
                    }

                }
            }

            $product_terms_stock = array_sum($product_terms_stock);
            $stock_qty = array_sum($input_amounts);
            // Check if stock in terms exist
            if (!empty($product_terms_stock)) {
                // update stock status

                $product = wc_get_product($var_post_id);
                if (empty($product)) return;

                // backorder disabled
                if (!$product->is_on_backorder()) {
                    if ($stock_qty > 0) {
                        update_post_meta($var_post_id, '_stock_status', 'instock');

                        // remove the link in outofstock taxonomy for the current product
                        wp_remove_object_terms($var_post_id, 'outofstock', 'product_visibility');
                    } else {
                        update_post_meta($var_post_id, '_stock_status', 'outofstock');

                        // add the link in outofstock taxonomy for the current product
                        wp_set_post_terms($var_post_id, 'outofstock', 'product_visibility', true);
                    }

                // backorder enabled
                } else {
                    $current_stock_status = get_post_meta($var_post_id, '_stock_status', true);
                    if ($stock_qty > 0 && $current_stock_status != 'instock') {
                        update_post_meta($var_post_id, '_stock_status', 'instock');
                        // remove the link in outofstock taxonomy for the current product
                        wp_remove_object_terms($var_post_id, 'outofstock', 'product_visibility');
                    } else {
                        update_post_meta($var_post_id, '_stock_status', 'onbackorder');
                    }
                }
            }
        }
    }
}


function ra_save_variation_inventory_fields($variation_id, $loop) {
    // Get product object
    $product = wc_get_product($variation_id);

    if (empty($product)) return;

    $warehouses = get_warehouses();
    $total_warehouses = count($warehouses);

    $manage_stock = get_post_meta($variation_id, '_manage_stock', true) === 'yes';
    if (!$manage_stock) {
        foreach ($warehouses as $warehouse) {
            delete_post_meta($variation_id, 'ra_stock_at_' . $warehouse['code']);
        }
        return;
    }

    // Grab stock amount from all terms
    $product_terms_stock = array();

    // Grab input amounts
    $input_amounts = array();

    // Define counter
    $counter = 0;

    foreach ($warehouses as $warehouse) {
        $warehouse_code = $warehouse['code'];
        if (isset($_POST["ra_product_{$variation_id}_warehouses_code_{$warehouse_code}"])) {

            // Initiate counter
            $counter++;

            // Save input amounts to array
            $input_amounts[] = sanitize_text_field($_POST["ra_product_{$variation_id}_warehouses_code_{$warehouse_code}"]);

            // Get post meta
            $postmeta_stock_at_term = get_post_meta($variation_id, "ra_stock_at_{$warehouse_code}", true);

            // Pass terms stock to variable
            if ($postmeta_stock_at_term) {
                $product_terms_stock[] = $postmeta_stock_at_term;
            }

            $stock_location_term_input = sanitize_text_field($_POST["ra_product_{$variation_id}_warehouses_code_{$warehouse_code}"]);

            // Check if the $_POST value is the same as the postmeta, if not update the postmeta
            if ($stock_location_term_input !== $postmeta_stock_at_term) {
                // Update the post meta
                update_post_meta($variation_id, "ra_stock_at_{$warehouse_code}", $stock_location_term_input);
            }

            // Update stock when reach the last term
            if ($counter === $total_warehouses) {
                update_post_meta($variation_id, '_stock', array_sum($input_amounts));
            }
        }
    }

    $product_terms_stock = array_sum($product_terms_stock);
    $stock_qty = array_sum($input_amounts);
    // Check if stock in terms exist
    if (!empty($product_terms_stock)) {
      // update stock status

        $product = wc_get_product($variation_id);
        if (empty($product)) return;

        // backorder disabled
        if (!$product->is_on_backorder()) {
            if ($stock_qty > 0) {
                update_post_meta($variation_id, '_stock_status', 'instock');

                // remove the link in outofstock taxonomy for the current product
                wp_remove_object_terms($variation_id, 'outofstock', 'product_visibility');
            } else {
                update_post_meta($variation_id, '_stock_status', 'outofstock');

                // add the link in outofstock taxonomy for the current product
                wp_set_post_terms($variation_id, 'outofstock', 'product_visibility', true);
            }

        // backorder enabled
        } else {
            $current_stock_status = get_post_meta($variation_id, '_stock_status', true);
            if ($stock_qty > 0 && $current_stock_status != 'instock') {
                update_post_meta($variation_id, '_stock_status', 'instock');
                // remove the link in outofstock taxonomy for the current product
                wp_remove_object_terms($variation_id, 'outofstock', 'product_visibility');
            } else {
                update_post_meta($variation_id, '_stock_status', 'onbackorder');
            }
        }
    }
}



function ra_update_stock_on_order_placed($order_id) {
    $order = new WC_Order($order_id);

    $warehouses = get_warehouses();
    $warehouse = null;
    $state = $order->get_shipping_state();
    $warehouse_code = warehouse_code_by_state($state);

    if ($warehouse_code) {
        foreach ($warehouses as $item) {
            if ($item['code'] === $warehouse_code) {
                $warehouse = $item;
            }
        }
    }

    if (isset($warehouse['code'])) {
        $warehouse_code = $warehouse['code'];

        $stock_reduced = get_post_meta($order_id, 'ra_stock_reduced', true) === 'yes';

        // Only continue if we're reducing stock.
        if (!$stock_reduced) {
            $notes = array();
            foreach ($order->get_items() as $item_id => $item) {
                $product_id = $item->get_product_id();
                $variation_id = $item->get_variation_id();
                $item_quantity = $item->get_quantity();
                $item_id = $product_id;
                if ($variation_id && $variation_id != 0) {
                    $item_id = $variation_id;
                }
                $postmeta_stock_at_term = get_post_meta($item_id, 'ra_stock_at_' . $warehouse_code, true);
                if (!empty($postmeta_stock_at_term) || ($postmeta_stock_at_term > 0)) {

                    update_post_meta($item_id, 'ra_stock_at_' . $warehouse_code, $postmeta_stock_at_term - $item_quantity);

                    $stock_reduce_location = $postmeta_stock_at_term - $item_quantity;
                    $notes[] = "{$item->get_name()} from {$postmeta_stock_at_term} &rarr; {$stock_reduce_location}";

                }
            }

            // Add the note
            if (count($notes) > 0) {
                $order->add_order_note("Stock levels reduced for location {$warehouse_code} for: " . implode(', ', $notes));
            }
        }

        update_post_meta($order_id, 'ra_stock_reduced', 'yes');
        update_post_meta($order_id, 'ra_warehouse_code', $warehouse_code);
    }

}

















// CRON EVENT to pull Stock from Cin7
// add_filter( 'cron_schedules', 'my_add_weekly' );
// function my_add_weekly( $schedules ) {
// 	$schedules['weekly'] = array(
// 		'interval' => 604800,
// 		'display' => __('Once Weekly')
// 	);
// 	return $schedules;
// }

// WHEN REMOVING CRON JOB, PLEASE REMEMBER TO REMOVE THESE CRON JOBS FROM Cron Events as well.
add_action( 'pull_cin7_stock_level_hook', 'pull_cin7_stock_level_func' );
add_action( 'pull_cin7_stock_level_hook_backup', 'pull_cin7_stock_level_func' );
if ( ! wp_next_scheduled( 'pull_cin7_stock_level_hook' ) ) {
    // date_default_timezone_set("Australia/Perth");
    // wp_schedule_event( time(), 'hourly', 'pull_cin7_stock_level_hook' );
    date_default_timezone_set("UTC");
	wp_schedule_event( date('U', strtotime('17:05:00')), 'daily', 'pull_cin7_stock_level_hook' );
}

function pull_cin7_stock_level_func() {
    if (current_site() === 'au' && is_live()) {
		$responses = pull_cin7_stock_from_api();
		save_data_to_file($responses);
		if ($responses['data']) {
			prep_and_save_cin7_stock($responses['data']);
			wp_clear_scheduled_hook('pull_cin7_stock_level_hook_backup');
		} else {
			if ( ! wp_next_scheduled( 'pull_cin7_stock_level_hook_backup' ) ) {
				wp_schedule_single_event( time() + 300, 'pull_cin7_stock_level_hook_backup' );
			}
		}
	}
}




function pull_cin7_stock_from_api() {
	$run_call = true;
	$page = 1;
	$pages_data = array();
	$cin7_responses = array();

	while ($run_call) {
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api.cin7.com/api/v1/Stock?fields=branchName,branchId,available,code&page=' . $page . '&rows=250',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'Authorization: Basic U3RyYWlnaHRjdXJ2ZUdhckFVOjBkM2Y4ODFiYTc3ODQwYmRiMTcyZWY2YTA3N2Q5Y2Vh'
			),
		));

		$response = curl_exec($curl);
		curl_close($curl);

		$cin7_responses['page=' . $page] = $response;
		$response = json_decode($response);
		$pages_data[] = $response;
		if (!$response || count($response) < 250) {
			$run_call = false;
		}
		$page++;
		sleep(1);
	}

	$data = array_merge(...$pages_data);
	$result = array(
		'data' => $data,
		'cin7_responses' => $cin7_responses
	);
	return $result;
}

function save_data_to_file($response) {
	$data = $response['data'];
	$warehouses = get_warehouses();
	$warehouses = array_values($warehouses);

	$file_name = get_stylesheet_directory() . '/assets/files/cin7/cin7-cron-data-';
	$file_name .= date('Y-m-d-H-i-s');

	$fp = fopen($file_name . '-cin7_responses.txt', 'w');
	fwrite($fp, serialize($response['cin7_responses']));
	fclose($fp);

	$fp = fopen($file_name . '.json', 'w');
	fwrite($fp, json_encode($data));
	fclose($fp);

	$csv = array();
	$csv[] = array('SKU', 'MEL', 'SYD', 'PER', 'JET');
	if ($data && count($data) > 0) {
		$prep_data = array();
		$branches = array();
		foreach ($data as $key => $value) {
			$warehouse_key = array_search($value->branchId, array_column($warehouses, 'Cin7Id'));
			if ($warehouse_key !== false && isset($warehouses[$warehouse_key]['code'])) {
				$branchCode = $warehouses[$warehouse_key]['code'];

				$prep_data[$value->code][$branchCode] = $value->available;
				$prep_data[$value->code]['SKU'] = $value->code;
				$branches[$branchCode] = $value->branchName;
			}
		}

		foreach ($prep_data as $key => $value) {
			$csv[] = array(
				$value['SKU'],
				($value['MEL'] ? $value['MEL'] : ''),
				($value['SYD'] ? $value['SYD'] : ''),
				($value['PER'] ? $value['PER'] : ''),
				($value['JET'] ? $value['JET'] : ''),
			);
		}
	}

	$fp = fopen($file_name . '.csv', 'w');
	foreach ($csv as $row) {
		fputcsv($fp, $row);
	}
	fclose($fp);
}

function prep_and_save_cin7_stock($data) {
	if ($data && count($data) > 0) {
		$warehouses = get_warehouses();
		$warehouses = array_values($warehouses);
		$get_sku_info = get_sku_info();

		// Prepare Cin7 stock levels for all warehouses and inject to sku info data
		foreach ($data as $key => $value) {
			if ($value->available && $value->available > 0) {
				$branchCode = '';
				$warehouse_key = array_search($value->branchId, array_column($warehouses, 'Cin7Id'));
				if ($warehouse_key !== false && isset($warehouses[$warehouse_key]['code'])) {
					$branchCode = $warehouses[$warehouse_key]['code'];
				}

				if (isset($get_sku_info[$value->code])) {
					$get_sku_info[$value->code]['stock'][$branchCode] = $value->available;
				}
			}
		}


		// Prepare stock level for single and bulk products
		foreach ($get_sku_info as $sku => $value) {
			if ($value['manageStock']) {
				if ($value['blkSku'] && $get_sku_info[$value['blkSku']]) {
					$blkQty = $get_sku_info[$value['blkSku']]['blkQty'];
					$new_stock_single = array();
					$new_stock_pallet = array();
					foreach ($value['stock'] as $code => $amount) {
						if ($amount < $blkQty) {
							$new_stock_single[$code] = $amount;
						} else {
							$new_stock_pallet[$code] = floor($amount / $blkQty) - 1;
							if ($new_stock_pallet[$code] < 0) {
								$new_stock_pallet[$code] = 0;
							}
							$new_stock_single[$code] = $amount - ($new_stock_pallet[$code] * $blkQty);
						}
					}

					if (count($new_stock_single) > 0) {
						$value['new_stock'] = $new_stock_single;
						$get_sku_info[$sku] = $value;
					}

					if (count($new_stock_pallet) > 0) {
						$get_sku_info[$value['blkSku']]['new_stock'] = $new_stock_pallet;
					}
				} elseif (!$value['blkQty'] || $value['blkQty'] === 1) {
					$exclude_products = array('SPIKE', 'SPIKE-FREE', 'SPIKE-BOX');
					if ($sku === 'SPIKE') {
						// SPIKE products - from SPIKE stock minus 500 for SPIKE-BOX products if manage stock is on on SPIKE-BOX productsn and stock for spike is bigger than 1000
						$stock = $value['stock'];
						if (isset($get_sku_info['SPIKE-BOX']['manageStock']) && $get_sku_info['SPIKE-BOX']['manageStock']) {
							$box_stock = array();
							foreach ($stock as $key => $value) {
								if ($value > 1000) {
									$stock[$key] = $value - 500; // remove 500 from spike stock to add to spike-box
									$box_stock[$key] = 10; // 1 box = 50 spikes and 500 = 10
								}
							}
							$get_sku_info['SPIKE-BOX']['stock'] = $box_stock;
							$get_sku_info['SPIKE-BOX']['new_stock'] = $box_stock;
						}

						// update SPIKE & SPIKE-FREE stock to new stock level
						$get_sku_info['SPIKE']['stock'] = $stock;
						$get_sku_info['SPIKE']['new_stock'] = $stock;

						$get_sku_info['SPIKE-FREE']['stock'] = $stock;
						$get_sku_info['SPIKE-FREE']['new_stock'] = $stock;

					} else if (!in_array($sku, $exclude_products)) { // Regular products
						$value['new_stock'] = $value['stock'];
						$get_sku_info[$sku] = $value;
					}
				}
			}
		}


		// Save stock levels to WooComm Products
		foreach ($get_sku_info as $sku => $value) {
			$product_id = wc_get_product_id_by_sku($sku);
			if ($product_id && ($value['manageStock'] || $sku === 'SPIKE-FREE')) {
				$total_stock = 0;
				foreach ($warehouses as $warehouse) {
					$warehouse_code = $warehouse['code'];
					$stock = 0;
					if (isset($value['new_stock'][$warehouse_code])) {
						$stock = $value['new_stock'][$warehouse_code];
					}
					update_post_meta($product_id, 'ra_stock_at_' . $warehouse_code, $stock);
					$total_stock += $stock;
				}

				update_post_meta($product_id, '_manage_stock', 'yes');
				update_post_meta($product_id, '_stock', $total_stock);

				if ($total_stock && $total_stock > 0) {
					update_post_meta($product_id, '_stock_status', 'instock');
				} else {
					update_post_meta($product_id, '_stock_status', 'outofstock');
				}
			}
		}
	}
}