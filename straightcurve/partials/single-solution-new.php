<div class="c-single-solution-alt">
 <?php if ( have_posts() ) while ( have_posts() ) : the_post() ; ?>
 	<?php
		$post_id = get_the_ID();
	 	$gc = get_field('general_content', 'options');
	 	$sc = get_field('solutions_content', 'options');
	 	$fields = get_fields();
		$banner = get_field('banner_image');
		$specs = get_field('product_specifications');
		$video_instructions = get_field('video_instructions');
		$thumb = get_the_post_thumbnail_url();
		$ideal_for_list = get_field('ideal_for_list');
		$uses_as_list = get_field('uses_as_list');
		$available_steel = get_field('available_steel');
		$panel_lists = get_field('panel_lists');

		$categories = get_the_terms($post_id, 'solutions_categories');
		$types = get_the_terms($post_id, 'solution_type');

		$breadcrumb = array();
		$sheet_pages = SHEET_PAGES;
		$suggested_range = array();
		$range = null;

		$cat_slug = null;
		if (isset($categories[0]->slug)) {
			$cat_slug = $categories[0]->slug;
		}

		if (isset($sheet_pages[6]['title'])) {
			$breadcrumb[] = array('label' => $sheet_pages[6]['title'], 'link' => $sheet_pages[6]['url']);
			if (current_site() === 'uk') {
				$sheet_pages[15] = array( 'url' => '/uk/solutions/planter-boxes/', 'title' => 'Planter Boxes' );
				$sheet_pages[16] = array( 'url' => '/uk/solutions/planter-boxes/', 'title' => '4-Panel Planter Box' );
				$sheet_pages[11] = array( 'url' => '/uk/solutions/garden-edging/', 'title' => 'Garden Edging' );
				$sheet_pages[7] = array( 'url' => '/uk/solutions/raised-garden-beds/', 'title' => 'Raised Garden Beds' );
			}
			if (!is_live() && current_site() === 'au') {
				$sheet_pages[15] = array( 'url' => '/au/garden-solutions/planter-boxes/', 'title' => 'Planter Boxes' );
				$sheet_pages[16] = array( 'url' => '/au/garden-solutions/planter-boxes/', 'title' => '4-Panel Planter Box' );
				$sheet_pages[11] = array( 'url' => '/au/garden-solutions/garden-edging/', 'title' => 'Garden Edging' );
				$sheet_pages[7] = array( 'url' => '/au/garden-solutions/raised-garden-beds/', 'title' => 'Raised Garden Beds' );
			}
			if (current_site() === 'nl') {
				$sheet_pages[15] = array( 'url' => '/nl/garden-solutions/planter-boxes/', 'title' => 'Planter Boxes' );
				$sheet_pages[16] = array( 'url' => '/nl/garden-solutions/planter-boxes/', 'title' => '4-Panel Planter Box' );
				$sheet_pages[11] = array( 'url' => '/nl/garden-solutions/garden-edging/', 'title' => 'Garden Edging' );
				$sheet_pages[7] = array( 'url' => '/nl/garden-solutions/raised-garden-beds/', 'title' => 'Raised Garden Beds' );
			}
			if (!is_live() && current_site() === 'us') {
				$sheet_pages[15] = array( 'url' => '/us/garden-solutions/planter-boxes/', 'title' => 'Planter Boxes' );
				$sheet_pages[16] = array( 'url' => '/us/garden-solutions/planter-boxes/', 'title' => '4-Panel Planter Box' );
				$sheet_pages[11] = array( 'url' => '/us/garden-solutions/garden-edging/', 'title' => 'Garden Edging' );
				$sheet_pages[7] = array( 'url' => '/us/garden-solutions/raised-garden-beds/', 'title' => 'Raised Garden Beds' );
			}


			if ($cat_slug === 'rigidline-straight-edge-range') {
				// $breadcrumb[] = array('label' => $sheet_pages[11]['title'], 'link' => $sheet_pages[11]['url']);
				$breadcrumb[] = array('label' => $sheet_pages[14]['title'], 'link' => $sheet_pages[14]['url']);
				$suggested_range[] = array('label' => $sheet_pages[12]['title'], 'link' => $sheet_pages[12]['url'], 'id' => $sheet_pages[12]['id']);
				$suggested_range[] = array('label' => $sheet_pages[13]['title'], 'link' => $sheet_pages[13]['url'], 'id' => $sheet_pages[13]['id']);
				// $range = 'Rigidline';
				// if (current_site() === 'uk') {
				// 	$range = 'Rigid';
				// }
				$range = 'Garden Edging';
			} elseif ($cat_slug === 'flexline-curved-edge-range') {
				// $breadcrumb[] = array('label' => $sheet_pages[11]['title'], 'link' => $sheet_pages[11]['url']);
				$breadcrumb[] = array('label' => $sheet_pages[12]['title'], 'link' => $sheet_pages[12]['url']);
				$suggested_range[] = array('label' => $sheet_pages[13]['title'], 'link' => $sheet_pages[13]['url'], 'id' => $sheet_pages[13]['id']);
				$suggested_range[] = array('label' => $sheet_pages[14]['title'], 'link' => $sheet_pages[14]['url'], 'id' => $sheet_pages[14]['id']);
				// $range = 'Flexline';
				// if (current_site() === 'uk') {
				// 	$range = 'Flex';
				// }
				$range = 'Garden Edging';
			} elseif ($cat_slug === 'hardline-straight-edge-range') {
				// $breadcrumb[] = array('label' => $sheet_pages[11]['title'], 'link' => $sheet_pages[11]['url']);
				$breadcrumb[] = array('label' => $sheet_pages[13]['title'], 'link' => $sheet_pages[13]['url']);
				$suggested_range[] = array('label' => $sheet_pages[12]['title'], 'link' => $sheet_pages[12]['url'], 'id' => $sheet_pages[12]['id']);
				$suggested_range[] = array('label' => $sheet_pages[14]['title'], 'link' => $sheet_pages[14]['url'], 'id' => $sheet_pages[14]['id']);
				$range = 'Garden Edging';

			} elseif ($cat_slug === 'rigidline-straight-line-range') {
				$breadcrumb[] = array('label' => $sheet_pages[7]['title'], 'link' => $sheet_pages[7]['url']);
				$breadcrumb[] = array('label' => $sheet_pages[10]['title'], 'link' => $sheet_pages[10]['url']);
				$suggested_range[] = array('label' => $sheet_pages[8]['title'], 'link' => $sheet_pages[8]['url'], 'id' => $sheet_pages[8]['id']);
				$suggested_range[] = array('label' => $sheet_pages[9]['title'], 'link' => $sheet_pages[9]['url'], 'id' => $sheet_pages[9]['id']);
				// $range = 'Rigidline';
				// if (current_site() === 'uk') {
				// 	$range = 'Rigid';
				// }
				$range = 'Raised Garden Beds';
			} elseif ($cat_slug === 'flexline-curved-line-range') {
				// $breadcrumb[] = array('label' => $sheet_pages[7]['title'], 'link' => $sheet_pages[7]['url']);
				$breadcrumb[] = array('label' => $sheet_pages[9]['title'], 'link' => $sheet_pages[9]['url']);
				$suggested_range[] = array('label' => $sheet_pages[8]['title'], 'link' => $sheet_pages[8]['url'], 'id' => $sheet_pages[8]['id']);
				$suggested_range[] = array('label' => $sheet_pages[10]['title'], 'link' => $sheet_pages[10]['url'], 'id' => $sheet_pages[10]['id']);
				// $range = 'Flexline';
				// if (current_site() === 'uk') {
				// 	$range = 'Flex';
				// }
				$range = 'Raised Garden Beds';
			} elseif ($cat_slug === 'fixed-height-range') {
				// $breadcrumb[] = array('label' => $sheet_pages[7]['title'], 'link' => $sheet_pages[7]['url']);
				$breadcrumb[] = array('label' => $sheet_pages[8]['title'], 'link' => $sheet_pages[8]['url']);
				$suggested_range[] = array('label' => $sheet_pages[9]['title'], 'link' => $sheet_pages[9]['url'], 'id' => $sheet_pages[9]['id']);
				$suggested_range[] = array('label' => $sheet_pages[10]['title'], 'link' => $sheet_pages[10]['url'], 'id' => $sheet_pages[10]['id']);
				$range = 'Fixed Height Planter (Retaining Walls %26 >1200)';
				// if (current_site() === 'uk') {
				// 	$range = '4-Panel Planter Box (Retaining Walls %26 >1200)';
				// }
				$range = 'Raised Garden Beds';
			} elseif ($cat_slug === 'fixed-height-planter-boxes-range') {
				// $breadcrumb[] = array('label' => $sheet_pages[15]['title'], 'link' => $sheet_pages[15]['url']);
				$breadcrumb[] = array('label' => $sheet_pages[16]['title'], 'link' => $sheet_pages[16]['url']);
				// $range = 'Fixed Height Planter (max Width 1200)';
				// if (current_site() === 'uk') {
				// 	$range = '4-Panel Planter Box (max Width 1200)';
				// }
			}
		}

		$title = get_field('product_title');
		$title = str_replace(' high', '', $title);
		$title .= ' ' .  ($gc['solution_title_high'] ? $gc['solution_title_high'] : 'high');


		$product_link = null;
		if (isset($fields['buy_link']) && $fields['buy_link']) {
			$product_link = $fields['buy_link'];
		} elseif (current_site() === 'uk' && isset($fields['product_code']) && $fields['product_code']) {
			$product_code = $fields['product_code'];
			if (current_site() === 'uk') {
				// $product_code = str_replace('WS', '', $product_code);
				$product_code = str_replace('GS', 'WS', $product_code);
				if ($product_code === 'FHL400WS') {
					$product_code = 'FHL400';
				}
			}

			$product_id = wc_get_product_id_by_sku($product_code);
			$product = get_product($product_id);

			if (isset($product->status) && $product->status === 'publish' && $product->catalog_visibility === 'visible') {
				$product_link = get_the_permalink($product_id);
			}
		}

		$badges_string = '';
		// if ($product_link && isset($sc['badge_image_green']['url'])) {
		// 	$badges_string = '<div class="c-single-solution-alt__badges is-image"><img class="c-single-solution-alt__badges-image" alt="' . $sc['badge_image_green']['title'] . '" src="' . $sc['badge_image_green']['url'] . '"></div>';
		// } else if (!$product_link && isset($sc['badge_image_white']['url'])) {
		// 	$badges_string = '<div class="c-single-solution-alt__badges is-image"><img class="c-single-solution-alt__badges-image" alt="' . $sc['badge_image_white']['title'] . '" src="' . $sc['badge_image_white']['url'] . '"></div>';
		// }
		if (isset($sc['badge_image_green']['url'])) {
			$badges_string = '<div class="c-single-solution-alt__badges is-image"><img class="c-single-solution-alt__badges-image" alt="' . $sc['badge_image_green']['title'] . '" src="' . $sc['badge_image_green']['url'] . '"></div>';
		}


		$available_heights = array();
		if ($cat_slug) {
			$other_products = get_posts(array(
				'post_type' => 'solutions',
				'numberposts' => -1,
				'tax_query' => array(array(
					'taxonomy' => 'solutions_categories',
					'field' => 'slug',
					'terms' => array($cat_slug),
					'operator' => 'IN',
				))
			));

			foreach ($other_products as $key => $value) {
				$height = get_field('product_title', $value->ID);
				if ($height) {
					$height_num = preg_replace('/[^0-9.]+/', '', $height);
					$available_heights[$height_num] = array( 'height' => $height, 'item' => $value );
				}
			}
			ksort($available_heights);
		}

	?>
	<div class="c-single-solution-alt__breadcrumb">
		<div class="o-wrapper">
			<ul>
				<?php foreach ($breadcrumb as $item) : ?>
					<li><a href="<?php echo $item['link']; ?>"><?php echo $item['label']; ?></a></li>
				<?php endforeach; ?>
				<li><span><?php echo $title; ?></span></li>
			</ul>
		</div>
	</div>

	<div class="c-single-solution-alt__stage">
		<div class="o-wrapper">
			<div class="o-layout o-module o-module--vcenter">
				<div class="o-layout__item o-module__item u-1/2@tablet">
					<div class="c-single-solution-alt__stage-image">
						<img src="<?php echo $banner; ?>" alt="<?php the_title(); ?>">
					</div>
				</div>

				<div class="o-layout__item o-module__item u-1/2@tablet">
					<div class="c-single-solution-alt__stage-content-wrap">
						<div class="c-single-solution-alt__stage-content">
							<h1 class="heading-title"><?php echo get_the_title(); ?></h1>
							<?php the_content() ?>

							<?php if ($available_steel) : ?>
								<div class="c-single-solution-alt__available-steels">
									<h3><?php echo $gc['solution_available_steels'] ? $gc['solution_available_steels'] : 'Available steels'; ?></h3>
									<ul>
										<?php if (current_site() === 'uk') : ?>
											<li><span class="steel-colour" style="--color: #ab6109">#ab6109</span><span class="steel-name"><?php echo ra_lang('Weathering'); ?></span></li>
											<li><span class="steel-colour" style="--color: #a7a7a7">#a7a7a7</span><span class="steel-name"><?php echo ra_lang('Galvanised'); ?> <span>(Not Available)</span><br><a href="mailto:info@straightcurve.uk?subject=Straightcurve%20%E2%80%93%20Interested%20in%20Galvanised%20Steel">Express your interest</a></span></li>
										<?php else : ?>
											<?php foreach ($available_steel as $item) : ?>
												<li><span class="steel-colour" style="--color: <?php echo $item['steel_colour']; ?>"><?php echo $item['steel_colour']; ?></span><span class="steel-name"><?php echo $item['steel_name']; ?></span></li>
											<?php endforeach; ?>
										<?php endif; ?>
									</ul>
								</div>
							<?php endif; ?>

							<?php if ($available_heights && count($available_heights) > 0) : ?>
								<div class="c-single-solution-alt__available-heights">
									<?php
										$title = 'Available heights';
										if (current_site() === 'nl') {
											$title = 'Beschikbare hoogtes';
										}
									?>
									<h3><?php echo $title; ?></h3>
									<ul>
										<?php foreach ($available_heights as $height =>  $item) : ?>
											<?php if ($item['item']->ID === $post_id) : ?>
												<li><span class="is-active"><?php echo $item['height']; ?></span></li>
											<?php else : ?>
												<li><a href="<?php echo get_the_permalink($item['item']->ID); ?>"><?php echo $item['height']; ?></a></li>
											<?php endif; ?>
										<?php endforeach; ?>
									</ul>
								</div>
							<?php endif; ?>

							<?php if (isset($fields['buy_links'][0]['link']['url'])) : ?>
								<div class="c-single-solution-alt__buy-links">
									<ul>
										<?php foreach ($fields['buy_links'] as $item) : ?>
											<li><a class="o-btn o-btn--orange" href="<?php echo $item['link']['url']; ?>" target="<?php echo $item['link']['target']; ?>"><?php echo $item['link']['title']; ?></a></li>
										<?php endforeach; ?>
									</ul>
								</div>
							<?php endif; ?>

							<?php if (isset($fields['stockist_link']['url'])) : ?>
								<div class="c-single-solution-alt__stockist-link">
									<a href="<?php echo $fields['stockist_link']['url']; ?>" target="<?php echo $fields['stockist_link']['target']; ?>"><span><?php echo $fields['stockist_link']['title']; ?></span></a>
								</div>
							<?php endif; ?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="c-single-solution-alt__wrap">
		<div class="o-wrapper">
			<div class="c-single-solution-alt__top">
				<div class="c-single-solution-alt__top-intro"><?php echo $fields['product_details_intro']; ?></div>
				<?php if ($thumb) : ?>
					<div class="c-single-solution-alt__thumb">
						<img class="lazyload" src="<?php echo ASSETS; ?>/img/2x1.trans.gif" data-src="<?php echo $thumb; ?>" alt="<?php echo get_the_title(); ?>">
					</div>
				<?php endif; ?>
			</div>
			<div class="c-single-solution-alt__inner">

				<div class="c-single-solution-alt__product-details">
					<div class="o-layout o-module">
						<?php if ($badges_string) : ?>
							<div class="o-layout__item u-1/3@tablet c-single-solution-alt__inner-badge-wrap">
								<div class="c-single-solution-alt__inner-badge">
									<?php echo $badges_string; ?>
								</div>
							</div>
						<?php endif; ?>
						<?php if ($ideal_for_list) : ?>
							<div class="o-layout__item u-1/3@tablet ideal-for">
								<h3><?php echo $gc['solution_ideal_for'] ? $gc['solution_ideal_for'] : 'Ideal for'; ?></h3>
								<ul>
									<?php foreach ($ideal_for_list as $item) : ?>
										<li><i class="far fa-check-circle" aria-hidden="true"></i><?php echo $item['ideal_item']; ?></li>
									<?php endforeach; ?>
								</ul>
							</div>
						<?php endif; ?>
						<?php if ($uses_as_list) : ?>
							<div class="o-layout__item u-1/3@tablet use-as">
								<h3><?php echo $gc['solution_use_as'] ? $gc['solution_use_as'] : 'Use as'; ?></h3>
								<ul>
									<?php foreach ($uses_as_list as $item) : ?>
										<li><i class="far fa-check-circle" aria-hidden="true"></i><?php echo $item['use_as_item']; ?></li>
									<?php endforeach; ?>
								</ul>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<?php if ($panel_lists && count($panel_lists) > 0) : ?>
					<div class="c-single-solution-alt__additional-info">
						<h3><?php echo $gc['solution_lengths_title'] ? $gc['solution_lengths_title'] : 'Available panel lengths'; ?></h3>
						<p><?php echo $gc['solution_lengths_copy'] ? $gc['solution_lengths_copy'] : get_field('short_description'); ?></p>
						<ul>
							<?php foreach ($panel_lists as $item) : ?>
							<li><?php echo $item['panel_item']; ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>

				<?php if (isset($fields['accessories_ids'])) {
					// $fields['accessories_ids'] = json_encode($fields['accessories_ids']);
					// $accs_ids = json_decode($fields['accessories_ids']);
					$fields['accessories_ids'] = json_encode($fields['accessories_ids']);
					$fields['accessories_ids'] = preg_replace("/[^0-9,]/", '', $fields['accessories_ids']);
					$accs_ids = explode(',', $fields['accessories_ids']);
					if ($accs_ids && count($accs_ids) > 0) {
						$accessories = get_posts(array(
							'posts_per_page' => -1,
							'post_type' => 'accessory',
							// 'post_status' => ['publish', 'draft'],
							'meta_query'	=> array(array(
								'key'	 	=> 'sheets_id',
								'value'	  	=> $accs_ids,
								'compare' 	=> 'IN',
							)),
						));
					}
				} else {
					$accessories = $fields['accessories'];
				} ?>
				<?php if ($accessories) : ?>
					<div class="c-single-solution-alt__addition-accessories">
						<h2><?php echo $gc['solution_additional_accessories'] ? $gc['solution_additional_accessories'] : 'Additional accessories'; ?></h2>
						<p><?php echo $gc['solution_additional_accessories_copy'] ? $gc['solution_additional_accessories_copy'] : 'All fixings and accessories not to scale. All accessories are available in weathering and galvanised steel finish.'; ?></p>
						<div class="c-single-solution-alt__accessories">
							<?php foreach ($accessories as $item) :	$id = $item->ID;
								$required = get_field('required', $id);
								$use_alternative = get_field('use_alternative', $id);
							?>
								<div class="c-single-solution-alt__accessories-each">
									<div class="c-single-solution-alt__accessories-wrap">
										<div class="c-single-solution-alt__accessories-img">
											<div class="accessories-img">
												<img width="282" height="300" src="<?php echo get_the_post_thumbnail_url($id); ?>" alt="<?php the_title(); ?>" />
											</div>
										</div>
										<div class="c-single-solution-alt__accessories-info">
											<div class="accessories-required">
												<?php if ($required && $use_alternative) : ?>
													<?php echo $gc['solution_required_2'] ? $gc['solution_required_2'] : 'Required (or use alternative)'; ?>
												<?php elseif ($required) :  ?>
													<?php echo $gc['solution_required'] ? $gc['solution_required'] : 'Required'; ?>
												<?php else : ?>
													<?php echo $gc['solution_optional'] ? $gc['solution_optional'] : 'Optional'; ?>
												<?php endif; ?>
											</div>
											<div class="accessories-title"><?php echo get_field('alternate_name', $id); ?></div>
											<?php $features= get_field('features', $id); ?>
											<ul class="accessories-features">
												<?php foreach ($features as $feature) : ?>
													<li><?php echo $feature['feature']; ?></li>
												<?php endforeach; ?>
											</ul>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>



	<?php if (isset($fields['resources']['links'][0]) || isset($fields['resources']['cards'][0])) : ?>
		<div class="c-single-solution-alt__resources">
			<div class="o-wrapper">
				<?php if (isset($fields['resources']['intro']) && $fields['resources']['intro']) : ?>
					<div class="c-single-solution-alt__resources-intro">
						<?php echo $fields['resources']['intro']; ?>
					</div>
				<?php endif; ?>

				<div class="o-layout o-module">
					<?php if (isset($fields['resources']['links'][0])) : ?>
						<?php foreach ($fields['resources']['links'] as $item) : ?>
							<div class="o-layout__item o-module__item u-1/3@tablet">
								<div class="c-single-solution-alt__resources-link">
									<div class="c-single-solution-alt__resources-link-top">
										<?php if (isset($item['icon']['url'])) : ?>
											<img loading="lazy" src="<?php echo $item['icon']['url']; ?>" alt="<?php echo $item['icon']['title']; ?>">
										<?php endif; ?>
										<?php if ($item['title']) : ?>
											<h3><?php echo $item['title']; ?></h3>
										<?php endif; ?>
										<?php if ($item['copy']) : ?>
											<p><?php echo $item['copy']; ?></p>
										<?php endif; ?>
									</div>
									<?php if (isset($item['link']['url'])) : ?>
										<div class="c-single-solution-alt__resources-link-bottom">
											<a href="<?php echo $item['link']['url']; ?>" target="<?php echo $item['link']['target']; ?>"><?php echo $item['link']['title']; ?> <i class="far fa-long-arrow-right"></i></a>
										</div>
									<?php endif; ?>
								</div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>

					<?php if (isset($fields['resources']['cards'][0])) : ?>
						<?php foreach ($fields['resources']['cards'] as $item) : ?>
							<div class="o-layout__item o-module__item u-1/2@tablet">
								<div class="c-single-solution-alt__resources-card">
									<div class="c-single-solution-alt__resources-card-bg lazyload" data-src="<?php echo $item['image']['url']; ?>"></div>
									<div class="c-single-solution-alt__resources-card-content">
										<?php if ($item['title']) : ?>
											<h3><?php echo $item['title']; ?></h3>
										<?php endif; ?>
										<?php if (isset($item['link']['url'])) : ?>
											<?php if (strpos($item['link']['url'], "://youtu") !== false) : ?>
												<a data-fancybox="" href="<?php echo $item['link']['url']; ?>" class="o-btn o-btn--play o-btn--orange"><?php echo $item['link']['title']; ?></a>
											<?php else : ?>
												<a href="<?php echo $item['link']['url']; ?>" class="o-btn o-btn--orange"><?php echo $item['link']['title']; ?></a>
											<?php endif; ?>
										<?php endif; ?>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>



	<?php if (isset($fields['tabbed_content']['tabbed_content'][0]['tab'])) : ?>
		<div class="c-single-solution-alt__why"><?php
			$fields['tabbed_content']['module_id'] = 'why-content';
			get_template_part('landing-modules/tabbed_content', null, $fields['tabbed_content']);
		?></div>
	<?php endif; ?>


	<?php if (isset($fields['content_image']['content']) && $fields['content_image']['content']) : ?>
		<div class="c-single-solution-alt__content-image">
			<?php if (isset($fields['content_image']['image']['url'])) : ?>
				<div class="c-single-solution-alt__content-image-image lazyload" data-src="<?php echo $fields['content_image']['image']['url']; ?>"></div>
			<?php endif; ?>
			<div class="o-wrapper">
				<div class="o-layout">
					<div class="o-layout__item u-1/2@tablet">
						<div class="c-single-solution-alt__content-image-content">
							<?php echo $fields['content_image']['content']; ?>
							<?php if (isset($fields['content_image']['links'][0]['link']['url'])) : ?>
								<div class="c-single-solution-alt__content-image-links">
									<?php foreach ($fields['content_image']['links'] as $item) : ?>
										<?php if (isset($item['link']['url'])) : ?>
											<a href="<?php echo $item['link']['url']; ?>" target="<?php echo $item['link']['target']; ?>" class="o-btn"><?php echo $item['link']['title']; ?></a>
										<?php endif; ?>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>



	<?php if (isset($fields['gallery']['gallery'][0]['url'])) : ?>
		<div class="c-landing__gallery c-single-solution-alt__gallery">
			<?php if ($fields['gallery']['intro']) : ?>
				<div class="o-wrapper o-wrapper--med">
					<div class="c-single-solution-alt__gallery-intro">
						<?php echo $fields['gallery']['intro']; ?>
					</div>
				</div>
			<?php endif; ?>
			<div class="c-landing__gallery-wrap js-image-gallery">
				<?php foreach ($fields['gallery']['gallery'] as $item) : ?>
					<div class="c-landing__gallery-item">
						<a class="c-landing__gallery-item-inner" data-fancybox="images" href="<?php echo $item['url']; ?>">
							<img data-lazy="<?php echo $item['url']; ?>" alt="<?php echo $item['image']['title']; ?>">
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>


	<?php if (isset($suggested_range[0]['link'])) : ?>
		<div class="c-single-solution-alt__more">
			<div class="o-wrapper">
				<?php
					$title = 'Browse more of our ' . $range . ' range';
					if (current_site() === 'nl') {
						if ($range === 'Garden Edging') {
							$title = 'Bekijk Meer van onze kantopsluitingen';
						} else if ($range === 'Raised Garden Beds') {
							$title = 'Bekijk Meer van onze verhoogde borders';
						}
					}
				?>
				<h2><?php echo $title; ?></h2>
				<div class="o-layout o-module o-module--center">
					<?php foreach ($suggested_range as $item) :
						$thumb = get_the_post_thumbnail_url($item['id'], 'full');
						?>
						<div class="o-layout__item o-module__item u-1/3@tablet">
							<div class="c-single-solution-alt__more-card">
								<img loading="lazy" src="<?php echo $thumb; ?>" alt="<?php echo $item['label']; ?>">
								<h3><?php echo $item['label']; ?></h3>
								<a href="<?php echo $item['link']; ?>" class="o-btn o-btn--orange">Explore</a>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>



  <?php endwhile; ?>
</div>