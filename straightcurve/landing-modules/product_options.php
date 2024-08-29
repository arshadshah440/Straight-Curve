<?php
$module = $args;

$require_login = false;
$au_where_to_buy_link = false;
foreach ($module['options'] as $key => $item) {
	if (isset($item['for_users'][0]) && $item['for_users'][0]) {
		foreach ($item['for_users'] as $role) {
			if (!$require_login && $role === 'All') {
			} elseif (!$require_login && $role === 'PRO' && !is_pro_user()) {
				$require_login = true;
			} elseif (!$require_login && $role === 'Dealer' && !is_dealer_user()) {
				$require_login = true;
			}

			if (current_site() === 'au' && $role === 'DIY (where to buy link)') {
				$au_where_to_buy_link = true;
			}
		}
	}
}
if (is_user_logged_in()) {
	$require_login = false;
}

if ($module['options'] && count($module['options']) > 0) :
	$first_image = '';
	?>
	<div class="c-landing__prod-options c-prod-opt" id="<?php echo $module['module_id']; ?>">
		<div class="o-wrapper">
			<div class="c-prod-opt__intro">
				<?php if ($module['title']) : ?>
					<h2 class="h2-large"><?php echo $module['title']; ?></h2>
				<?php endif; ?>
				<?php if ($module['copy']) : ?>
					<div class="c-prod-opt__copy"><?php echo $module['copy']; ?></div>
				<?php endif; ?>
			</div>

			<div class="c-prod-opt__options-wrap">
				<div class="c-prod-opt__options-content">
					<?php if ($require_login) : ?>
						<div class="c-prod-opt__options-login">
							<a href="<?php echo SITE; ?>/my-account?redirect=<?php echo get_the_permalink(); ?>" class="o-btn o-btn--noarrow" target="_blank">Login for prices</a>
							<p>Don't have an account? apply for one <a href="#register-for-pro">here</a></p>
						</div>
					<?php endif; ?>
					<div class="c-prod-opt__options-content-items">
						<?php foreach ($module['options'] as $key => $item) :
							$multiple_products = false;
							$show_add_to_cart = true;
							if ($au_where_to_buy_link) {
								$show_add_to_cart = false;
							}
							if (!$au_where_to_buy_link && isset($item['for_users'][0]) && $item['for_users'][0]) {
								$show_add_to_cart = false;
								foreach ($item['for_users'] as $role) {
									if (!$show_add_to_cart && $role === 'All') {
										$show_add_to_cart = true;
									} elseif (!$show_add_to_cart && $role === 'PRO' && is_pro_user()) {
										$show_add_to_cart = true;
									} elseif (!$show_add_to_cart && $role === 'Dealer' && is_dealer_user()) {
										$show_add_to_cart = true;
									}
								}
							}
							if (isset($item['multiple_products']) && $item['multiple_products']) {
								$multiple_products = true;

								$multi_products = array();
								$types = array();
								$heights = array();
								$finish = array();
								$bracing = array();
								foreach ($item['products'] as $p => $prod) {
									if (isset($prod['product']->ID)) {
										$prod_types = get_the_terms($prod['product']->ID, 'ra_product_type');
										$prod_type = isset($prod_types[0]->term_id) ? $prod_types[0] : null;

										$prod_heights = get_the_terms($prod['product']->ID, 'ra_product_height');
										$prod_height = isset($prod_heights[0]->term_id) ? $prod_heights[0] : null;

										$prod_bracing = get_field('product_info_bracing_option', $prod['product']->ID);
										if ($prod_bracing) {
											$prod_bracing = array(
												'slug' => stripString($prod_bracing),
												'label' => $prod_bracing,
											);
										}

										$prod_item = array(
											'product' => $prod['product'],
											'copy' => $prod['copy'],
											'price' => $prod['price'],
											'price_suffix' => $prod['price_suffix'],
											'meter_per_set' => $prod['meter_per_set'],
											'image' => (isset($prod['image']['url']) ? $prod['image']['url'] : ''),
											'type' => $prod_type,
											'height' => $prod_height,
											'finish' => get_field('product_info_finish', $prod['product']->ID),
											'bracing' => $prod_bracing,
											'link' => $prod['link'],
											'usps' => $prod['usps'],
										);

										if ($prod_item['finish']) {
											$finish[$prod_item['finish']] = $prod_item['finish'];

										}

										if (isset($prod_item['type']->slug)) {
											$types[$prod_item['type']->term_id] = $prod_item['type'];
										}

										if (isset($prod_item['height']->slug)) {
											$heights[$prod_item['height']->term_id] = $prod_item['height'];
										}

										if (isset($prod_item['bracing']['slug'])) {
											$bracing[ $prod_item['bracing']['slug'] ]['label'] = $prod_item['bracing']['label'];
											if (isset($prod_item['type']->slug)) {
												$bracing[ $prod_item['bracing']['slug'] ]['types'][] = $prod_item['type']->slug;
											}
										}

										$multi_products[] = $prod_item;
									}
								}

								if (isset($bracing) && count($bracing) > 0) {
									foreach ($bracing as $key => $value) {
										if ($value) {
											$bracing[$key]['types'] = array_unique($value['types']);
										}
									}
									$bracing_order = array('bracing-sets', 'bracing-posts', 'no-bracing');
									$sorted_bracing = array();
									foreach ($bracing_order as $key => $value) {
										if (isset($bracing[$value])) {
											$sorted_bracing[$value] = $bracing[$value];
										}
									}
									$bracing = $sorted_bracing;
								}
							}

							$first_type = '';
							$first_height = '';
							$first_finish = '';
							$first_bracing = '';
							if ($multiple_products) {
								$image = isset($multi_products[0]['image']) && $multi_products[0]['image'] ? $multi_products[0]['image'] : '';

								$first_type = isset($multi_products[0]['type']->slug) ? $multi_products[0]['type']->slug : '';
								$first_height = isset($multi_products[0]['height']->slug) ? $multi_products[0]['height']->slug : '';
								$first_finish = isset($multi_products[0]['finish']) ? stripString($multi_products[0]['finish']) : '';
								$first_bracing = isset($multi_products[0]['bracing']['slug']) ? $multi_products[0]['bracing']['slug'] : '';

							} else {
								$image = isset($item['image']['url']) ? $item['image']['url'] : '';
							}

							if ($key === 0) {
								$first_image = $image;
							}


							?>
							<div
								class="c-prod-opt__option js-prod-opt <?php echo $multiple_products ? 'has-multi-products' : ''; ?> <?php echo ($key === 0 ? 'is-active' : ''); ?>"
								data-image="<?php echo $image; ?>"
								data-type="<?php echo $first_type; ?>"
								data-height="<?php echo $first_height; ?>"
								data-finish="<?php echo $first_finish; ?>"
								data-bracing="<?php echo $first_bracing; ?>" >
								<div class="c-prod-opt__option-image">
									<img src="<?php echo ASSETS; ?>/img/2x1.trans.gif" data-src="<?php echo $image; ?>" alt="<?php echo $item['title']; ?>">
								</div>
								<h3 class="c-prod-opt__option-title"><?php echo $item['title']; ?></h3>
								<div class="c-prod-opt__option-content">
									<?php if ($item['label']) : ?>
										<span class="c-prod-opt__option-label"><?php echo $item['label']; ?></span>
									<?php endif; ?>

									<?php if ($multiple_products) :
										if ($multi_products && count($multi_products) > 0) : ?>

											<?php if ($types && count($types) > 0) : ?>
												<ul class="c-prod-opt__option-types">
													<?php foreach ($types as $t => $type) : ?>
														<li><a class="js-prodopt-type <?php echo ($type->slug === $first_type ? 'is-active' : ''); ?>" href="javascript:void(0);" data-type="<?php echo $type->slug; ?>"><?php echo $type->name; ?></a></li>
													<?php endforeach; ?>
												</ul>
											<?php endif; ?>
											<?php if ($heights && count($heights) > 0) : ?>
												<ul class="c-prod-opt__option-heights">
													<?php foreach ($heights as $t => $height) : ?>
														<li><a class="js-prodopt-height <?php echo ($height->slug === $first_height ? 'is-active' : ''); ?>" href="javascript:void(0);" data-height="<?php echo $height->slug; ?>"><?php echo str_replace(' High', '', $height->name); ?></a></li>
													<?php endforeach; ?>
												</ul>
											<?php endif; ?>
											<?php if ($finish && count($finish) > 0) : ?>
												<ul class="c-prod-opt__option-finish">
													<?php foreach ($finish as $t => $fin) : ?>
														<li><a class="js-prodopt-finish <?php echo (stripString($fin) === $first_finish ? 'is-active' : ''); ?>" href="javascript:void(0);" data-finish="<?php echo stripString($fin); ?>"><?php echo ra_lang($fin); ?></a></li>
													<?php endforeach; ?>
												</ul>
											<?php endif; ?>
											<?php if ($bracing && count($bracing) > 0) : ?>
												<ul class="c-prod-opt__option-bracing <?php echo $t; ?>">
													<?php foreach ($bracing as $t => $bo) : ?>
														<li><a class="js-prodopt-bracing <?php echo ($t === $first_bracing ? 'is-active' : ''); ?>" href="javascript:void(0);" data-bracing="<?php echo $t; ?>" data-types="<?php echo (isset($bo['types'][0]) ? implode(',', $bo['types']) : ''); ?>"><?php echo ra_lang($bo['label']); ?></a></li>
													<?php endforeach; ?>
												</ul>
											<?php endif; ?>

											<div class="c-prod-opt__option-products">
												<?php foreach ($multi_products as $p => $prod) :
													$type = isset($prod['type']->slug) ? $prod['type']->slug : 'none';
													$height = isset($prod['height']->slug) ? $prod['height']->slug : 'none';
													$finish = isset($prod['finish']) ? stripString($prod['finish']) : '';
													$bracing = isset($prod['bracing']['slug']) ? $prod['bracing']['slug'] : 'no-bracing';
												?>
													<div class="c-prod-opt__option-product js-prodopt-prod"
														 data-image="<?php echo $prod['image']; ?>"
														 data-type="<?php echo $type; ?>"
														 data-height="<?php echo $height; ?>"
														 data-finish="<?php echo $finish; ?>"
														 data-bracing="<?php echo $bracing; ?>"
														 style="<?php echo $p === 0 ? '' : 'display:none;'; ?>">


														<?php if ($show_add_to_cart && $prod['price']) : ?>
															<span class="c-prod-opt__option-price"><?php echo $prod['price']; ?></span>
														<?php endif; ?>
														<?php if ($prod['copy']) : ?>
															<div class="c-prod-opt__option-copy"><?php echo $prod['copy']; ?></div>
														<?php endif; ?>
														<?php if ($prod['product']->ID) {
															$prod_var = array( 'ID' => $prod['product']->ID );
															$prod_var['price_suffix'] = isset($prod['price_suffix']) && $prod['price_suffix'] ? $prod['price_suffix'] : null;
															$prod_var['meter_per_set'] = isset($prod['meter_per_set']) && $prod['meter_per_set'] ? $prod['meter_per_set'] : null;

															if ($show_add_to_cart) {
																get_template_part('woocommerce/product-quickbuy', null, $prod_var);
															} elseif ($au_where_to_buy_link) {
																echo '<a class="o-btn o-btn--noarrow" href="#pricelist">Get Price List + Stockist Info</a>';
															}
														} ?>


														<?php if (isset($prod['link']['url'])) : ?>
															<a href="<?php echo $prod['link']['url']; ?>" target="<?php echo $prod['link']['target']; ?>" class="c-prod-opt__option-link o-btn o-btn--noarrow o-btn--orange"><?php echo $prod['link']['title']; ?></a>
														<?php endif; ?>

														<?php if (isset($prod['usps'][0]['title'])) : ?>
															<div class="c-prod-opt__option-usps c-accordian c-accordian--small">
																<?php foreach ($prod['usps'] as $usp) : ?>
																	<div class="c-accordian__item">
																		<a href="javascript:void(0);" class="c-accordian__item-title"><h3><?php echo $usp['title']; ?></h3></a>
																		<div class="c-accordian__item-copy"><?php echo $usp['copy']; ?></div>
																	</div>
																<?php endforeach; ?>
															</div>
														<?php endif; ?>

													</div>
												<?php endforeach; ?>

												<div class="c-prod-opt__option-product js-prodopt-prod no-product" style="display:none">No product found matching this selection</div>
											</div>

										<?php endif;
									else : ?>
										<?php if ($item['copy']) : ?>
											<div class="c-prod-opt__option-copy"><?php echo $item['copy']; ?></div>
										<?php endif; ?>
										<?php if ($show_add_to_cart && $item['price']) : ?>
											<span class="c-prod-opt__option-price"><?php echo $item['price']; ?></span>
										<?php endif; ?>
										<?php if ($item['product']->ID && $show_add_to_cart) {
											$price_suffix = isset($item['price_suffix']) && $item['price_suffix'] ? $item['price_suffix'] : null;
											get_template_part('woocommerce/product-quickbuy', null, array('ID' => $item['product']->ID, 'price_suffix' => $price_suffix));
										} elseif ($au_where_to_buy_link) {
											echo '<a class="o-btn o-btn--noarrow" href="#pricelist">Get Price List + Stockist Info</a>';
										}
										if (isset($item['link']['url'])) : ?>
											<a href="<?php echo $item['link']['url']; ?>" target="<?php echo $item['link']['target']; ?>" class="c-prod-opt__option-link o-btn o-btn--noarrow o-btn--orange"><?php echo $item['link']['title']; ?></a>
										<?php endif; ?>

										<?php if (isset($item['usps'][0]['title'])) : ?>
											<div class="c-prod-opt__option-usps c-accordian c-accordian--small">
												<?php foreach ($item['usps'] as $usp) : ?>
													<div class="c-accordian__item">
														<a href="javascript:void(0);" class="c-accordian__item-title"><h3><?php echo $usp['title']; ?></h3></a>
														<div class="c-accordian__item-copy"><?php echo $usp['copy']; ?></div>
													</div>
												<?php endforeach; ?>
											</div>
										<?php endif; ?>
									<?php endif; ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="c-prod-opt__options-image">
					<div class="img-wrap">
						<div class="img js-img-1 is-active" style="background-image: url(<?php echo $first_image ?>)"></div>
						<div class="img js-img-2" style="display: none"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php endif; ?>
