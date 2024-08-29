<?php
	$sheet_pages = SHEET_PAGES;

	if (current_site() === 'uk') {
		$sheet_pages[15] = array(
			'url' => '/uk/solutions/planter-boxes/',
			'title' => 'DIY Planter Boxes'
		);
		$sheet_pages[16] = array(
			'url' => '/uk/solutions/planter-boxes/',
			'title' => '4-Panel Planter Box'
		);
		$sheet_pages[11] = array(
			'url' => '/uk/solutions/garden-edging/',
			'title' => 'DIY Garden Edging'
		);
		$sheet_pages[7] = array(
			'url' => '/uk/solutions/raised-garden-beds/',
			'title' => 'DIY Raised Garden Beds'
		);
		// if (!is_live()) {
			$sheet_pages[6] = array(
				'url' => '/uk/solutions/',
				'title' => 'DIY Products'
			);
		// }
	}
	if (current_site() === 'au') {
		$sheet_pages[15] = array(
			'url' => '/au/garden-solutions/planter-boxes/',
			'title' => 'DIY Planter Boxes'
		);
		$sheet_pages[16] = array(
			'url' => '/au/garden-solutions/planter-boxes/',
			'title' => '4-Panel Planter Box'
		);
		$sheet_pages[11] = array(
			'url' => '/au/garden-solutions/garden-edging/',
			'title' => 'DIY Garden Edging'
		);
		$sheet_pages[7] = array(
			'url' => '/au/garden-solutions/raised-garden-beds/',
			'title' => 'DIY Raised Garden Beds'
		);
		// if (!is_live()) {
			$sheet_pages[6] = array(
				'url' => '/au/garden-solutions/',
				'title' => 'DIY Products'
			);
		// }
	}
	if (current_site() === 'nl') {
		$sheet_pages[15] = array(
			'url' => '/nl/modulaire-plantenbakken/ ',
			'title' => 'Modulaire plantenbakken'
		);
		$sheet_pages[16] = array(
			'url' => '/nl/modulaire-plantenbakken/ ',
			'title' => 'Modulaire plantenbakken'
		);
		$sheet_pages[11] = array(
			'url' => '/nl/straightcurve-kantopsluiting/',
			'title' => 'Kantopsluiting'
		);
		$sheet_pages[7] = array(
			'url' => '/nl/verhoogde-borders/',
			'title' => 'Verhoogde borders'
		);
		$sheet_pages[6] = array(
			'url' => '/nl/oplossingen-voor-tuinranden/',
			'title' => 'Particulier'
		);

	}
	if (current_site() === 'us' && !is_live()) {
		$sheet_pages[15] = array(
			'url' => '/us/garden-solutions/planter-boxes/',
			'title' => 'DIY Planter Boxes'
		);
		$sheet_pages[16] = array(
			'url' => '/us/garden-solutions/planter-boxes/',
			'title' => '4-Panel Planter Box'
		);
		$sheet_pages[11] = array(
			'url' => '/us/garden-solutions/garden-edging/',
			'title' => 'DIY Garden Edging'
		);
		$sheet_pages[7] = array(
			'url' => '/us/garden-solutions/raised-garden-beds/',
			'title' => 'DIY Raised Garden Beds'
		);
		$sheet_pages[6] = array(
			'url' => '/us/garden-solutions/',
			'title' => 'DIY Products'
		);
	}
	// if (!is_live() && current_site() === 'au') {
	// 	$sheet_pages[15] = array(
	// 		'url' => '/au/garden-solutions/planter-boxes/',
	// 		'title' => 'Planter Boxes'
	// 	);
	// 	$sheet_pages[16] = array(
	// 		'url' => '/au/garden-solutions/planter-boxes/',
	// 		'title' => '4-Panel Planter Box'
	// 	);
	// 	$sheet_pages[11] = array(
	// 		'url' => '/au/garden-solutions/garden-edging/',
	// 		'title' => 'Garden Edging'
	// 	);
	// 	$sheet_pages[7] = array(
	// 		'url' => '/au/garden-solutions/raised-garden-beds/',
	// 		'title' => 'Raised Garden Beds'
	// 	);
	// }

	$images = get_posts(array(
		'post_type' => 'product_gallery',
		'posts_per_page' => -1,
		'orderby' => 'menu_order',
		'order' => 'ASC'
	));
	$videos = get_posts(array(
		'post_type' => 'video_gallery',
		'posts_per_page' => -1,
	));
	$gc = get_field('general_content', 'options');


	$solutions = get_posts(array(
		'post_type' => 'solutions',
		'posts_per_page' => -1,
	));

	$solution_nav = array();
	foreach ($solutions as $solution) {
		$name = get_field('product_title', $solution->ID);
		$height = intval($name);
		$name = str_replace(' high', '', $name);
		$categories = wp_get_post_terms($solution->ID, 'solutions_categories');
		if (isset($categories[0]->slug)) {
			$solution_nav[$categories[0]->slug][$height] = array(
				'title' => $name,
				'url' => get_the_permalink($solution->ID)
			);
		}
	}

	// Sort by height
	$sorted = array();
	foreach ($solution_nav as $key => $value) {
		ksort($value);
		$sorted[$key] = $value;
	}
	$solution_nav = $sorted;
?>
<ul id="menu" class="c-nav d-flex row-wrap align-items-center">
	<?php if (!disable_shop() && (current_site() === 'uk' || current_site() === 'au')) : ?>
		<?php if (current_site() === 'uk') : ?>
		<?php elseif (is_live()) : ?>
			<li class="menu-item level-0 menu-item-6"><a href="<?php echo SITE; ?>/shop">Shop</a></li>
		<?php endif; ?>
	<?php elseif (current_site() === 'us') : ?>
		<li class="menu-item level-0 menu-item-6"><a href="https://straightcurveus.com/" target="_blank">Shop</a></li>
	<?php endif; ?>

	<?php if (current_site() === 'nl') : ?>
		<li class="menu-item menu-item-has-children level-0 solutions">
			<span class="label">Producten</span>
			<span class="c-nav__subnav-toggle"></span>

			<ul class="sub-menu main-sub-menu">
				<div class="o-wrapper">
					<div class="inner-wrap">
						<li class="menu-item menu-item-has-children level-1">
							<ul class="sub-menu">
								<li class="menu-item level-2">
									<a href="<?php echo SITE; ?>/straightcurve-kantopsluiting/">Kantopsluitingen</a>
									<ul class="sub-menu">
										<li class="menu-item level-3"><a href="<?php echo SITE; ?>/flexline-kantopsluiting/">Flexline</a></li>
										<li class="menu-item level-3"><a href="<?php echo SITE; ?>/rigidline-kantopsluiting/">Rigidline</a></li>
										<li class="menu-item level-3"><a href="<?php echo SITE; ?>/hardline-kantopsluiting/">Hardline</a></li>
									</ul>
								</li>
							</ul>
						</li>
						<li class="menu-item menu-item-has-children level-1">
							<ul class="sub-menu">
								<li class="menu-item level-2">
									<a href="<?php echo SITE; ?>/verhoogde-borders/">Verhoogde borders</a>
									<ul class="sub-menu">
										<li class="menu-item level-3"><a href="<?php echo SITE; ?>/flexline-verhoogde-border/">Flexline</a></li>
										<li class="menu-item level-3"><a href="<?php echo SITE; ?>/rigidline-verhoogde-border/">Rigidline</a></li>
										<li class="menu-item level-3"><a href="<?php echo SITE; ?>/fixed-height-line/">FHL</a></li>
									</ul>
								</li>
							</ul>
						</li>
						<li class="menu-item menu-item-has-children level-1">
							<ul class="sub-menu">
								<li class="menu-item level-2">
									<a href="<?php echo SITE; ?>/modulaire-plantenbakken/">Modulaire plantenbakken</a>
								</li>
							</ul>
						</li>
					</div>
				</div>
			</ul>
		</li>
	<?php endif; ?>


	<li class="menu-item menu-item-has-children level-0 solutions">
		<a href="<?php echo $sheet_pages[6]['url']; ?>"><?php echo $sheet_pages[6]['title']; ?></a>
		<span class="c-nav__subnav-toggle"></span>

		<?php if (current_site() === 'uk' || current_site() === 'au' || current_site() === 'nl' || (current_site() === 'us' && !is_live())) : ?>
			<ul class="sub-menu main-sub-menu">
				<div class="o-wrapper">
					<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children level-1 menu-item-832">
						<ul class="sub-menu">
							<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children level-2 menu-item-833">
								<ul class="sub-menu">
									<li class="menu-item level-3"><a href="<?php echo $sheet_pages[11]['url']; ?>"><?php echo $sheet_pages[11]['title']; ?></a></li>
									<li class="menu-item level-3"><a href="<?php echo $sheet_pages[7]['url']; ?>"><?php echo $sheet_pages[7]['title']; ?></a></li>
									<li class="menu-item level-3"><a href="<?php echo $sheet_pages[15]['url']; ?>"><?php echo $sheet_pages[15]['title']; ?></a></li>
								</ul>
							</li>
						</ul>
					</li>
				</div>
			</ul>
		<?php else : ?>


		<ul class="sub-menu main-sub-menu">
			<div class="o-wrapper">
				<div class="inner-wrap">
					<li class="menu-item menu-item-has-children level-1">
						<a href="<?php echo $sheet_pages[11]['url']; ?>"><?php echo $sheet_pages[11]['title']; ?><span><?php echo $gc['nav_solution_height']; ?></span></a>
						<ul class="sub-menu">
							<?php if (current_site() === 'uk' || current_site() === 'au' || current_site() === 'nl' || (current_site() === 'us' && !is_live())) : ?>

							<?php else : ?>
								<li class="menu-item level-2"><a href="<?php echo $sheet_pages[14]['url']; ?>"><?php echo $sheet_pages[14]['title']; ?></a>
									<?php if (isset($solution_nav['rigidline-straight-edge-range'])) : ?>
										<ul class="sub-menu">
											<?php foreach ($solution_nav['rigidline-straight-edge-range'] as $item) : ?>
												<li class="menu-item level-3"><a href="<?php echo $item['url']; ?>"><?php echo $item['title']; ?></a></li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
								</li>
								<li class="menu-item level-2"><a href="<?php echo $sheet_pages[12]['url']; ?>"><?php echo $sheet_pages[12]['title']; ?></a>
									<?php if (isset($solution_nav['flexline-curved-edge-range'])) : ?>
										<ul class="sub-menu">
											<?php foreach ($solution_nav['flexline-curved-edge-range'] as $item) : ?>
												<li class="menu-item level-3"><a href="<?php echo $item['url']; ?>"><?php echo $item['title']; ?></a></li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
								</li>
								<li class="menu-item level-2"><a href="<?php echo $sheet_pages[13]['url']; ?>"><?php echo $sheet_pages[13]['title']; ?></a>
									<?php if (isset($solution_nav['hardline-straight-edge-range'])) : ?>
										<ul class="sub-menu">
											<?php foreach ($solution_nav['hardline-straight-edge-range'] as $item) : ?>
												<li class="menu-item level-3"><a href="<?php echo $item['url']; ?>"><?php echo $item['title']; ?></a></li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
								</li>
							<?php endif; ?>
						</ul>
					</li>
					<li class="menu-item menu-item-has-children level-1">
						<a href="<?php echo $sheet_pages[7]['url']; ?>"><?php echo $sheet_pages[7]['title']; ?><span><?php echo $gc['nav_solution_height']; ?></span></a>
						<ul class="sub-menu">
							<?php if (current_site() === 'uk' || current_site() === 'au' || current_site() === 'nl' || (current_site() === 'us' && !is_live())) : ?>

							<?php else : ?>
								<li class="menu-item level-2"><a href="<?php echo $sheet_pages[10]['url']; ?>"><?php echo $sheet_pages[10]['title']; ?></a>
									<?php if (isset($solution_nav['rigidline-straight-line-range'])) : ?>
										<ul class="sub-menu">
											<?php foreach ($solution_nav['rigidline-straight-line-range'] as $item) : ?>
												<li class="menu-item level-3"><a href="<?php echo $item['url']; ?>"><?php echo $item['title']; ?></a></li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
								</li>
								<li class="menu-item level-2"><a href="<?php echo $sheet_pages[9]['url']; ?>"><?php echo $sheet_pages[9]['title']; ?></a>
									<?php if (isset($solution_nav['flexline-curved-line-range'])) : ?>
										<ul class="sub-menu">
											<?php foreach ($solution_nav['flexline-curved-line-range'] as $item) : ?>
												<li class="menu-item level-3"><a href="<?php echo $item['url']; ?>"><?php echo $item['title']; ?></a></li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
								</li>
								<li class="menu-item level-2"><a href="<?php echo $sheet_pages[8]['url']; ?>"><?php echo $sheet_pages[8]['title']; ?></a>
									<?php if (isset($solution_nav['fixed-height-range'])) : ?>
										<ul class="sub-menu">
											<?php foreach ($solution_nav['fixed-height-range'] as $item) : ?>
												<li class="menu-item level-3"><a href="<?php echo $item['url']; ?>"><?php echo $item['title']; ?></a></li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
								</li>
							<?php endif; ?>
						</ul>
					</li>
					<li class="menu-item menu-item-has-children level-1">
						<a href="<?php echo $sheet_pages[15]['url']; ?>"><?php echo $sheet_pages[15]['title']; ?><span><?php echo $gc['nav_solution_height']; ?></span></a>
						<ul class="sub-menu">
							<?php if (current_site() === 'uk' || current_site() === 'au' || current_site() === 'nl' || (current_site() === 'us' && !is_live())) : ?>

							<?php else : ?>
								<li class="menu-item level-2"><a href="<?php echo $sheet_pages[16]['url']; ?>"><?php echo $sheet_pages[16]['title']; ?></a>
									<?php if (isset($solution_nav['fixed-height-planter-boxes-range'])) : ?>
										<ul class="sub-menu">
											<?php foreach ($solution_nav['fixed-height-planter-boxes-range'] as $item) : ?>
												<li class="menu-item level-3"><a href="<?php echo $item['url']; ?>"><?php echo $item['title']; ?></a></li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
								</li>
							<?php endif; ?>
						</ul>
					</li>
				</div>
				<?php if (current_site() === 'uk') : ?>
					<?php if (is_live()) : ?>
						<!-- <li class="brac-notice"><span class="brac-text"><?php echo $gc['nav_solution_bracing']; ?></span><a class="o-btn o-btn--orange o-btn--noarrow" href="<?php echo $sheet_pages[4]['url']; ?>?range=Rigid&amp;height=240mm&amp;soil=Soft"><?php echo $sheet_pages[4]['title']; ?></a></li> -->
					<?php endif; ?>
				<?php else : ?>
					<li class="brac-notice"><span class="brac-text"><?php echo $gc['nav_solution_bracing']; ?></span><a class="o-btn o-btn--orange o-btn--noarrow" href="<?php echo $sheet_pages[4]['url']; ?>?range=Rigidline&amp;height=240mm&amp;soil=Soft"><?php echo $sheet_pages[4]['title']; ?></a></li>
				<?php endif; ?>
			</div>
		</ul>

		<?php endif; ?>

	</li>


	<?php if (current_site() === 'uk' || current_site() === 'au' || current_site() === 'nl' || (current_site() === 'us' && !is_live())) : ?>
		<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children level-0 menu-item-9">
			<?php if (current_site() === 'nl') : ?>
				<span class="label">Hovenier</span>
			<?php else : ?>
				<span class="label">Trade</span>
			<?php endif; ?>
			<span class="c-nav__subnav-toggle"></span>
			<ul class="sub-menu main-sub-menu">
				<div class="o-wrapper">
					<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children level-1 menu-item-832">
						<ul class="sub-menu">
							<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children level-2 menu-item-833">
								<ul class="sub-menu">
									<?php if (current_site() !== 'nl') : ?>
										<li class="menu-item level-3"><a href="<?php echo SITE; ?>/my-account">My Account</a></li>
										<?php if (is_pro_user()) : ?>
											<li class="menu-item level-3"><a href="<?php echo SITE; ?>/shop">Pro shop</a></li>
										<?php endif; ?>
									<?php endif; ?>
									<?php if (current_site() === 'uk') : ?>
										<li class="menu-item level-3"><a href="<?php echo SITE; ?>/design-resources/">Design Resources</a></li>
									<?php endif; ?>
									<?php if (current_site() === 'nl') : ?>
										<li class="menu-item level-3"><a href="<?php echo SITE; ?>/voor-architecten-en-hoveniers/">Meer informatie</a></li>
									<?php else : ?>
										<li class="menu-item level-3"><a href="<?php echo SITE; ?>/for-landscape-professionals">More Info</a></li>
									<?php endif; ?>
									<li><hr></li>
									<?php if (current_site() === 'nl') : ?>
										<li class="menu-item level-3"><a href="<?php echo SITE; ?>/straightcurve-kantopsluiting/">Kantopsluitingen</a></li>
										<li class="menu-item level-3"><a href="<?php echo SITE; ?>/verhoogde-borders/">Verhoogde borders</a></li>
										<li class="menu-item level-3"><a href="<?php echo SITE; ?>/modulaire-plantenbakken/">Modulaire plantenbakken</a></li>
									<?php else : ?>
										<li class="menu-item level-3"><a href="<?php echo SITE; ?>/for-landscape-professionals/garden-edging">Garden Edging</a></li>
										<li class="menu-item level-3"><a href="<?php echo SITE; ?>/for-landscape-professionals/raised-garden-beds">Raised Garden Beds</a></li>
										<li class="menu-item level-3"><a href="<?php echo SITE; ?>/for-landscape-professionals/planter-boxes">Planter Boxes</a></li>
									<?php endif; ?>
								</ul>
							</li>
						</ul>
					</li>
				</div>
			</ul>
		</li>
	<?php endif; ?>


	<?php
	//  if (current_site() === 'au' || (current_site() === 'au' && !!is_live())) :
	if (current_site() === 'au' || current_site() === 'nl') : ?>
		<li class="menu-item level-0 menu-item-6"><a href="<?php echo $sheet_pages[18]['url']; ?>"><?php echo (current_site() === 'au' ? 'Where To Buy' : $sheet_pages[18]['title']); ?></a></li>
	<?php endif; ?>
	<li class="menu-item level-0 menu-item-234"><a href="<?php echo $sheet_pages[2]['url']; ?>"><?php echo $sheet_pages[2]['title']; ?></a></li>
	<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children level-0 menu-item-9">
		<span class="label"><?php echo $gc['nav_gallery']; ?></span>
		<span class="c-nav__subnav-toggle"></span>
		<ul class="sub-menu main-sub-menu">
			<div class="o-wrapper">
				<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children level-1 menu-item-832">
					<span class="label"><?php echo $gc['nav_inspiration']; ?></span>
					<ul class="sub-menu">
						<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children level-2 menu-item-833">
							<span class="label"><?php echo $gc['nav_images']; ?></span>
							<ul class="sub-menu">
								<?php foreach ($images as $item) : ?>
									<li class="menu-item level-3"><a href="<?php echo get_the_permalink($item->ID); ?>"><?php echo $item->post_title; ?></a></li>
								<?php endforeach; ?>
							</ul>
						</li>
						<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children level-2 menu-item-834">
							<span class="label"><?php echo $gc['nav_videos']; ?></span>
							<ul class="sub-menu">
								<?php foreach ($videos as $item) : ?>
									<li class="menu-item level-3"><a href="<?php echo get_the_permalink($item->ID); ?>"><?php echo $item->post_title; ?></a></li>
								<?php endforeach; ?>
							</ul>
						</li>
					</ul>
				</li>
			</div>
		</ul>
	</li>

	<li class="menu-item level-0 menu-item-807"><a href="<?php echo $sheet_pages[5]['url']; ?>"><?php echo $sheet_pages[5]['title']; ?></a></li>
	<?php if (disable_shop() && current_site() === 'au') : ?>
		<li class="menu-item level-0 menu-item-6"><a href="<?php echo SITE; ?>/my-account">Login</a></li>
	<?php endif; ?>
</ul>