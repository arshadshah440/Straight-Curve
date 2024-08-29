<?php
	$var = get_query_var('var');
	if (!$var || !$var['ID'] || !get_post_status($var['ID'])) {
		return;
	}
	$id = $var['ID'];
	$fields = get_fields($id);
	$sheet_pages = SHEET_PAGES;
	$titles = array();
	if ($sheet_pages && isset($sheet_pages[4]['id'])) {
		$titles = get_field('bracing_options_titles', $sheet_pages[4]['id']);
	}
 ?><div class="c-bracing-option">
	<h3 class="c-bracing-option__title"><?php echo $fields['system_best_suited']; ?></h3>
	<div class="c-bracing-option__content">
		<div class="o-layout o-module">
			<div class="o-layout__item o-module__item u-1/3@tablet">
				<img src="<?php echo $fields['image']['url']; ?>" alt="<?php echo $fields['system_best_suited']; ?>">
			</div>
			<div class="o-layout__item o-module__item u-1/3@tablet">
				<div class="o-module__content">
					<h5><?php echo ($titles['minimum_required'] ? $titles['minimum_required'] : 'Minimum number required'); ?></h5>
					<p><?php echo $fields['minimum_number']; ?></p>

					<div class="o-layout">
						<div class="o-layout__item u-1/2">
							<h5><?php echo ($titles['install_time'] ? $titles['install_time'] : 'Install Time'); ?></h5>
							<p><?php echo $fields['install_time']; ?></p>
						</div>
						<div class="o-layout__item u-1/2">
							<h5><?php echo ($titles['fixings'] ? $titles['fixings'] : 'Fixings'); ?></h5>
							<p><?php echo $fields['fixings']; ?></p>
						</div>
					</div>

					<h5><?php echo ($titles['useful_tools'] ? $titles['useful_tools'] : 'Useful tools'); ?></h5>
					<ul>
						<?php foreach ($fields['useful_tools'] as $item) : ?>
							<li><?php echo $item['tool']; ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
			<div class="o-layout__item o-module__item u-1/3@tablet">
				<div class="o-module__content">
					<h5><?php echo ($titles['further_advice'] ? $titles['further_advice'] : 'Further Advice'); ?></h5>
					<ul>
						<?php foreach ($fields['further_advice'] as $item) : ?>
							<li><?php echo $item['tip']; ?></li>
						<?php endforeach; ?>
					</ul>

					<h5><?php echo ($titles['something_extra'] ? $titles['something_extra'] : 'Something Extra'); ?></h5>
					<?php echo $fields['something_extra']; ?>
				</div>
			</div>
		</div>
	</div>
 </div>