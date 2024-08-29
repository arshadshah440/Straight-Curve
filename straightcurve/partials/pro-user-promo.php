<?php
if (current_site() === 'uk' || current_site() === 'au' || current_site() === 'nl' || (current_site() === 'us' && !is_live())) :
// if (current_site() === 'uk') :

$professional_page = get_field('professional_page');

$class = '';
$title = 'Apply for a PRO Account';
$copy = 'Gain access for trade pricing on all orders';
$icon = get_svgicon('trade-rates', '0 0 125 130');
$button = array('link' => '#register-for-pro', 'label' => 'Register for a PRO Account');

if (is_front_page()) {
	$class = 'c-prouserpromo--homepage';
	// $title = 'Professional landscapers & specifiers:';
	// $copy = 'Get trade pricing on your online orders';
	$title = 'Are you a landscape professional?';
	$copy = 'Register for a PRO Account to get trade pricing on your online orders';
	$button = array('link' => '/uk/for-landscape-professionals/', 'label' => 'Learn how to register');
}

if (is_shop()) {
	$class = 'c-prouserpromo--shoppage';
	$title = 'Are you a landscape professional?';
	// $copy = 'Access trade rates with a PRO account';
	$copy = 'Register for a PRO Account to access trade rates';
	$button = array('link' => '/uk/for-landscape-professionals/', 'label' => 'Learn how to register');
}

if ($professional_page) {
	$class = 'c-prouserpromo--propage';
	$title = 'Apply for a PRO Account';
	$copy = 'To access trade pricing on all orders';
	$icon = get_svgicon('10-perc-pro', '0 0 125 131');
	if (current_site() === 'au') {
		$icon = get_svgicon('8-perc-pro', '0 0 125 130');
	}

	if (current_site() === 'uk') {
		$icon = '';
	}
}


?><div class="c-prouserpromo <?php echo $class; ?>">
	<div class="c-prouserpromo__container <?php echo ($icon ? 'has-icon' : ''); ?>">
		<?php echo $icon; ?>
		<div class="c-prouserpromo__content">
			<h3><?php echo $title; ?></h3>
			<p><?php echo $copy; ?></p>
		</div>
		<a href="<?php echo $button['link']; ?>" class="o-btn o-btn--orange"><?php echo $button['label']; ?></a>
	</div>
</div>
<?php endif; ?>