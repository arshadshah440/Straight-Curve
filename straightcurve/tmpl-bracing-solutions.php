<?php
/*
 * Template Name: Bracing Solutions Page
 */

get_header();

if ( have_posts() ) while ( have_posts() ) : the_post();
	$image = get_the_post_thumbnail_url(get_the_ID(), 'full');
	$bracing_solutions = get_field('bracing_solutions');

	if (!isset($bracing_solutions['labels_field']['range']) || !$bracing_solutions['labels_field']['range']) {
		$bracing_solutions['labels_field']['range'] = 'Choose Product Range';
	}
	if (!isset($bracing_solutions['labels_field']['height']) || !$bracing_solutions['labels_field']['height']) {
		$bracing_solutions['labels_field']['height'] = 'Choose Height';
	}
	if (!isset($bracing_solutions['labels_field']['soil']) || !$bracing_solutions['labels_field']['soil']) {
		$bracing_solutions['labels_field']['soil'] = 'Choose ground or soil type';
	}
	if (!isset($bracing_solutions['labels_field']['submit']) || !$bracing_solutions['labels_field']['submit']) {
		$bracing_solutions['labels_field']['submit'] = 'Submit';
	}

	$bracing_options = get_posts(array(
        'post_type' => 'bracing_options',
        'posts_per_page' => -1,
		'fields' => 'ids'
    ));
	$fields = array(
		'range' => array( 0 => $bracing_solutions['labels_field']['range'] ),
		'height' => array( 0 => $bracing_solutions['labels_field']['height'] ),
		'soil' => array( 0 => $bracing_solutions['labels_field']['soil'] ),
	);
	$curr_range = esc_attr( sanitize_text_field($_GET['range']) );
	$curr_height = esc_attr( sanitize_text_field($_GET['height']) );
	$curr_soil = esc_attr( sanitize_text_field($_GET['soil']) );
	if ($_GET['range'] && strtolower($_GET['range']) === 'fixed height planter (retaining walls & >1200)') {
		$curr_range = 'Fixed Height Planter (Retaining walls & >1200)';
	}

	foreach ($bracing_options as $id) {
		$value = get_fields($id);
		if ($value['range']) {
			$fields['range'][trim($value['range'])] = trim($value['range']);
		}
		if ($value['height']) {
			$fields['height'][trim($value['height'])] = trim($value['height']);
		}
		if ($value['ground_condition']) {
			$fields['soil'][trim($value['ground_condition'])] = trim(ucwords(implode(" ", explode("-", $value['ground_condition']))));
		}
	}


?><div class="c-bracing-solutions">
	<div class="o-wrapper">
		<div class="c-bracing-solutions__content">
			<h1 hidden><?php echo the_title(); ?></h1>
			<?php the_content() ?>
		</div>

		<h2 class="c-bracing-solutions__form-title"><?php echo $bracing_solutions['form_title']; ?></h2>
		<form class="c-bracing-solutions__form" action="javascript:void(0);" id="bracing-solution-form">
			<?php foreach ($fields as $name => $options) :
				if ($name === 'height') {
					uksort($options, function($a, $b) {
						$key_to_num_a = (float)$a;
						$key_to_num_b = (float)$b;
						return ($key_to_num_a > $key_to_num_b);
					});
				} ?>
				<select name="<?php echo $name; ?>" id="<?php echo $name; ?>">
					<?php foreach ($options as $value => $label) :
						$selected = null;
						if ($name === 'range' && $curr_range && strtolower($curr_range) === strtolower($value)) {
							$selected = 'selected';
						}
						if ($name === 'height' && $curr_height && strtolower($curr_height) === strtolower($value)) {
							$selected = 'selected';
						}
						if ($name === 'soil' && $curr_soil && strtolower($curr_soil) === strtolower($label)) {
							$selected = 'selected';
						}
					?>
						<option value="<?php echo ($value !== 0 ? $value : ''); ?>" <?php echo $selected; ?>><?php echo $label; ?></option>
					<?php endforeach; ?>
				</select>
			<?php endforeach; ?>
			<button class="o-btn o-btn--orange"><?php echo $bracing_solutions['labels_field']['submit']; ?></button>
		</form>

		<div class="c-bracing-solutions__results" hidden data-no_result="<?php echo ($bracing_solutions['no_result'] ? $bracing_solutions['no_result'] : 'No Results'); ?>">
			<span class="c-loader">Loading...</span>
		</div>

		<div class="c-bracing-solutions__diagram" id="diagram">
			<img class="lazyload" src="<?php echo ASSETS; ?>/img/2x1.trans.gif" data-src="<?php echo $image; ?>" alt="Diagram">
		</div>
	</div>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>