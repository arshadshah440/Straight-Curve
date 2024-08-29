<div class="c-single-solution">
 <?php if ( have_posts() ) while ( have_posts() ) : the_post() ; ?>
 	<?php
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

		$categories = get_the_terms(get_the_ID(), 'solutions_categories');
		$types = get_the_terms(get_the_ID(), 'solution_type');

		$breadcrumb = array();
		$sheet_pages = SHEET_PAGES;
		$suggested_range = array();
		$range = null;
		if (isset($sheet_pages[6]['title'])) {
			$breadcrumb[] = array('label' => $sheet_pages[6]['title'], 'link' => $sheet_pages[6]['url']);

			$cat_slug = null;
			if (isset($categories[0]->slug)) {
				$cat_slug = $categories[0]->slug;
			}

			if ($cat_slug === 'rigidline-straight-edge-range') {
				if (current_site() !== 'au') {
					$breadcrumb[] = array('label' => $sheet_pages[11]['title'], 'link' => $sheet_pages[11]['url']);
				}
				$breadcrumb[] = array('label' => $sheet_pages[14]['title'], 'link' => $sheet_pages[14]['url']);
				$suggested_range[] = array('label' => $sheet_pages[12]['title'], 'link' => $sheet_pages[12]['url']);
				$suggested_range[] = array('label' => $sheet_pages[13]['title'], 'link' => $sheet_pages[13]['url']);
				$range = 'Rigidline';
				if (current_site() === 'uk') {
					$range = 'Rigid';
				}
			} elseif ($cat_slug === 'flexline-curved-edge-range') {
				if (current_site() !== 'au') {
					$breadcrumb[] = array('label' => $sheet_pages[11]['title'], 'link' => $sheet_pages[11]['url']);
				}
				$breadcrumb[] = array('label' => $sheet_pages[12]['title'], 'link' => $sheet_pages[12]['url']);
				$suggested_range[] = array('label' => $sheet_pages[13]['title'], 'link' => $sheet_pages[13]['url']);
				$suggested_range[] = array('label' => $sheet_pages[14]['title'], 'link' => $sheet_pages[14]['url']);
				$range = 'Flexline';
				if (current_site() === 'uk') {
					$range = 'Flex';
				}
			} elseif ($cat_slug === 'hardline-straight-edge-range') {
				if (current_site() !== 'au') {
					$breadcrumb[] = array('label' => $sheet_pages[11]['title'], 'link' => $sheet_pages[11]['url']);
				}
				$breadcrumb[] = array('label' => $sheet_pages[13]['title'], 'link' => $sheet_pages[13]['url']);
				$suggested_range[] = array('label' => $sheet_pages[12]['title'], 'link' => $sheet_pages[12]['url']);
				$suggested_range[] = array('label' => $sheet_pages[14]['title'], 'link' => $sheet_pages[14]['url']);
			} elseif ($cat_slug === 'rigidline-straight-line-range') {
				if (current_site() !== 'au') {
					$breadcrumb[] = array('label' => $sheet_pages[7]['title'], 'link' => $sheet_pages[7]['url']);
				}
				$breadcrumb[] = array('label' => $sheet_pages[10]['title'], 'link' => $sheet_pages[10]['url']);
				$suggested_range[] = array('label' => $sheet_pages[8]['title'], 'link' => $sheet_pages[8]['url']);
				$suggested_range[] = array('label' => $sheet_pages[9]['title'], 'link' => $sheet_pages[9]['url']);
				$range = 'Rigidline';
				if (current_site() === 'uk') {
					$range = 'Rigid';
				}
			} elseif ($cat_slug === 'flexline-curved-line-range') {
				if (current_site() !== 'au') {
					$breadcrumb[] = array('label' => $sheet_pages[7]['title'], 'link' => $sheet_pages[7]['url']);
				}
				$breadcrumb[] = array('label' => $sheet_pages[9]['title'], 'link' => $sheet_pages[9]['url']);
				$suggested_range[] = array('label' => $sheet_pages[8]['title'], 'link' => $sheet_pages[8]['url']);
				$suggested_range[] = array('label' => $sheet_pages[10]['title'], 'link' => $sheet_pages[10]['url']);
				$range = 'Flexline';
				if (current_site() === 'uk') {
					$range = 'Flex';
				}
			} elseif ($cat_slug === 'fixed-height-range') {
				if (current_site() !== 'au') {
					$breadcrumb[] = array('label' => $sheet_pages[7]['title'], 'link' => $sheet_pages[7]['url']);
				}
				$breadcrumb[] = array('label' => $sheet_pages[8]['title'], 'link' => $sheet_pages[8]['url']);
				$suggested_range[] = array('label' => $sheet_pages[9]['title'], 'link' => $sheet_pages[9]['url']);
				$suggested_range[] = array('label' => $sheet_pages[10]['title'], 'link' => $sheet_pages[10]['url']);
				$range = 'Fixed Height Planter (Retaining Walls %26 >1200)';
				if (current_site() === 'uk') {
					$range = '4-Panel Planter Box (Retaining Walls %26 >1200)';
				}
			} elseif ($cat_slug === 'fixed-height-planter-boxes-range') {
				if (current_site() !== 'au') {
					$breadcrumb[] = array('label' => $sheet_pages[15]['title'], 'link' => $sheet_pages[15]['url']);
				}
				$breadcrumb[] = array('label' => $sheet_pages[16]['title'], 'link' => $sheet_pages[16]['url']);
				$range = 'Fixed Height Planter (max Width 1200)';
				if (current_site() === 'uk') {
					$range = '4-Panel Planter Box (max Width 1200)';
				}
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

		// $all_badges = array(
		// 	'uk-warehouse' => get_svgicon('uk-warehouse', '0 0 70 72'),
		// 	'au-owned' => get_svgicon('au-owned', '0 0 88 89'),

		// 	'guarantee-ws' => get_svgicon('guarantee-ws', '0 0 87 89'),
		// 	'guarantee-ws-nl' => get_svgicon('guarantee-ws-nl', '0 0 87 89'),
		// 	'guarantee-ws-no' => get_svgicon('guarantee-ws-no', '0 0 87 89'),

		// 	'guarantee-gs' => get_svgicon('guarantee-gs', '0 0 87 89'),
		// 	'guarantee-gs-nl' => get_svgicon('guarantee-gs-nl', '0 0 87 89'),
		// 	'guarantee-gs-no' => get_svgicon('guarantee-gs-no', '0 0 87 89'),
		// );

		// $badges = array();
		// if (current_site() === 'au' || current_site() === 'us') {
		// 	$badges[] = $all_badges['guarantee-ws'];
		// 	$badges[] = $all_badges['guarantee-gs'];
		// 	$badges[] = $all_badges['au-owned'];
		// } elseif (current_site() === 'nl') {
		// 	$badges[] = $all_badges['guarantee-ws-nl'];
		// 	$badges[] = $all_badges['guarantee-gs-nl'];
		// 	$badges[] = $all_badges['au-owned'];
		// } elseif (current_site() === 'no') {
		// 	$badges[] = $all_badges['guarantee-ws-no'];
		// 	$badges[] = $all_badges['guarantee-gs-no'];
		// 	$badges[] = $all_badges['au-owned'];
		// } elseif (current_site() === 'uk') {
		// 	$badges[] = $all_badges['uk-warehouse'];
		// 	$badges[] = $all_badges['au-owned'];
		// 	$badges[] = $all_badges['guarantee-ws'];
		// }

		$badges_string = '';
		// if ($badges && count($badges) > 0) {
		// 	$badges_string .= '<div class="c-single-solution__badges">';
		// 	foreach ($badges as $value) {
		// 		$badges_string .= $value;
		// 	}
		// 	$badges_string .= '</div>';
		// }

		if ($product_link && isset($sc['badge_image_green']['url'])) {
			$badges_string = '<div class="c-single-solution__badges is-image"><img class="c-single-solution__badges-image" alt="' . $sc['badge_image_green']['title'] . '" src="' . $sc['badge_image_green']['url'] . '"></div>';
		} else if (!$product_link && isset($sc['badge_image_white']['url'])) {
			$badges_string = '<div class="c-single-solution__badges is-image"><img class="c-single-solution__badges-image" alt="' . $sc['badge_image_white']['title'] . '" src="' . $sc['badge_image_white']['url'] . '"></div>';
		}

	?>
	<div class="c-single-solution__stage">
		<div class="c-single-solution__stage-img" style="background-image: url(<?php echo $banner; ?>)"></div>
		<div class="o-wrapper c-single-solution__stage-bottom">
			<div class="c-single-solution__stage-bottom-contents">
				<h1 class="heading-title"><?php echo get_the_title(); ?></h1>
				<ul class="breadcrumb">
					<?php foreach ($breadcrumb as $item) : ?>
						<li><a href="<?php echo $item['link']; ?>"><?php echo $item['label']; ?></a></li>
					<?php endforeach; ?>
					<li><span><?php echo $title; ?></span></li>
				</ul>
			</div>
			<?php if ($product_link) : ?>
				<div class="c-single-solution__stage-bottom-buybutton">
					<a href="<?php echo $product_link; ?>" class="o-btn o-btn--orange" target="_blank">Buy now</a>
				</div>
			<?php elseif ($badges_string) : ?>
				<?php echo $badges_string; ?>
			<?php endif; ?>
		</div>
	</div>
	<div class="o-wrapper c-single-solution__wrap">
		<div class="c-single-solution__top">
			<div class="c-single-solution__tabs">
				<?php if ($specs) : ?>
					<a class="c-single-solution__tabs-link link1" href="<?php echo $specs; ?>" target="_blank" data-gtm-label="Click to view spec sheet" data-gtm-action="Spec sheet view"><?php echo $gc['solution_specification_button'] ? $gc['solution_specification_button'] : 'Specifications &amp; Accessories'; ?></a>
				<?php endif; ?>
				<?php if ($video_instructions) : ?>
					<a data-fancybox="" class="c-single-solution__tabs-link link2" href="<?php echo $video_instructions; ?>" target="_blank" data-gtm-label="Watch installation video" data-gtm-action="Installation video watch"><?php echo $gc['solution_watch_installation'] ? $gc['solution_watch_installation'] : 'Watch video installation'; ?></a>
				<?php endif; ?>
			</div>
			<?php if ($thumb) : ?>
			<div class="c-single-solution__thumb">
				<img class="lazyload" src="<?php echo ASSETS; ?>/img/2x1.trans.gif" data-src="<?php echo $thumb; ?>" alt="<?php echo get_the_title(); ?>">
			</div>
			<?php endif; ?>
		</div>
		<div class="c-single-solution__inner <?php echo ($product_link && $badges_string ? 'has-badges' : ''); ?>">
			<?php if ($product_link && $badges_string) : ?>
				<div class="c-single-solution__inner-badge">
					<?php echo $badges_string; ?>
				</div>
			<?php endif; ?>

			<div class="c-single-solution__product-details">
				<div class="o-layout">
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
					<?php if ($available_steel) : ?>
						<div class="o-layout__item u-1/3@tablet available-steels">
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
				</div>
			</div>
			<?php if ($panel_lists && count($panel_lists) > 0) : ?>
				<div class="c-single-solution__additional-info">
					<h3><?php echo $gc['solution_lengths_title'] ? $gc['solution_lengths_title'] : 'Available panel lengths'; ?></h3>
					<p><?php echo $gc['solution_lengths_copy'] ? $gc['solution_lengths_copy'] : get_field('short_description'); ?></p>
					<ul>
						<?php foreach ($panel_lists as $item) : ?>
						<li><?php echo $item['panel_item']; ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>
			<?php if ($fields['gallery_link'] || $fields['product_instructions'] || $fields['bracing_solution'] || $fields['bracing_installation_video']) : ?>
				<div class="c-single-solution__ctas">
					<?php if ($fields['gallery_link']) : ?>
						<a href="<?php echo $fields['gallery_link']; ?>" class="o-btn o-btn--orange"><?php echo $gc['solution_view_gallery'] ? $gc['solution_view_gallery'] : 'View gallery'; ?></a>
					<?php endif; ?>
					<?php if ($fields['product_instructions']) : ?>
						<a href="<?php echo $fields['product_instructions']; ?>" class="o-btn" target="_blank"><?php echo $gc['solution_download_instructions'] ? $gc['solution_download_instructions'] : 'Download Instructions'; ?></a>
					<?php endif; ?>
					<?php if ($fields['product_title']) : ?>
						<a href="<?php echo $sheet_pages[4]['url']; ?>?range=<?php echo $range; ?>&amp;height=<?php echo $fields['product_title']; ?>" class="o-btn"><?php echo $gc['solution_view_bracing_solutions'] ? $gc['solution_view_bracing_solutions'] : 'View bracing solutions'; ?></a>
					<?php endif; ?>
					<?php if ($sc['bracing_installation_video']) : ?>
						<a data-fancybox="" href="<?php echo $sc['bracing_installation_video']; ?>" class="o-btn"><?php echo $gc['solution_view_bracing_installation_video'] ? $gc['solution_view_bracing_installation_video'] : 'View bracing installation video'; ?></a>
					<?php endif; ?>
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
				<div class="c-single-solution__addition-accessories">
					<h2><?php echo $gc['solution_additional_accessories'] ? $gc['solution_additional_accessories'] : 'Additional accessories'; ?></h2>
					<p><?php echo $gc['solution_additional_accessories_copy'] ? $gc['solution_additional_accessories_copy'] : 'All fixings and accessories not to scale. All accessories are available in weathering and galvanised steel finish.'; ?></p>
					<div class="c-single-solution__accessories">
						<?php foreach ($accessories as $item) :	$id = $item->ID;
							$required = get_field('required', $id);
							$use_alternative = get_field('use_alternative', $id);
						?>
							<div class="c-single-solution__accessories-each">
								<div class="c-single-solution__accessories-wrap">
									<div class="c-single-solution__accessories-img">
										<div class="accessories-img">
											<img width="282" height="300" src="<?php echo get_the_post_thumbnail_url($id); ?>" alt="<?php the_title(); ?>" />
										</div>
									</div>
									<div class="c-single-solution__accessories-info">
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

		<?php if (isset($sc['bottom_button_link']['url'])) : ?>
			<div class="c-single-solution__cta-section">
				<span><?php echo $gc['solution_bottom_title'] ? $gc['solution_bottom_title'] : 'See what\'s possible.'; ?></span>
				<a href="<?php echo $sc['bottom_button_link']['url']; ?>" target="<?php echo $sc['bottom_button_link']['target']; ?>" class="o-btn o-btn--orange"><?php echo $gc['solution_bottom_button'] ? $gc['solution_bottom_button'] : 'Visit your local stockist'; ?></a>
			</div>
		<?php endif; ?>

		<?php if ($suggested_range && count($suggested_range) > 0 && $gc['solution_suggest_title']) : ?>
			<div class="c-single-solution__bottom-content">
				<?php echo $gc['solution_suggest_title']; ?>
				<?php foreach ($suggested_range as $key => $item) :
					echo ($key > 0 ? ', ' : ''); ?><a href="<?php echo $item['link']; ?>"><?php echo $item['label']; ?></a><?php
				endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
  <?php endwhile; ?>
</div>