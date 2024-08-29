<?php if (current_site() === 'uk' || current_site() === 'au' || current_site() === 'nl' || (current_site() === 'us' && !is_live())) :

$page_type = get_field('page_type');

$class = '';
$title = 'Become an Authorised Dealer';
$copy = 'To access wholesale pricing on all orders';
$icon = get_svgicon('authorised-dealer', '0 0 167 129');
$button = array('link' => '#register-for-dealer', 'label' => 'Apply for a Dealer Account');

if (is_front_page()) {
}

if (is_shop()) {
}

if ($page_type && $page_type === 'Dealer') {
	$class = 'c-prouserpromo--propage';
}


?><div class="c-prouserpromo c-prouserpromo--dealer <?php echo $class; ?>">
	<div class="c-prouserpromo__container">
		<?php echo $icon; ?>
		<div class="c-prouserpromo__content">
			<h3><?php echo $title; ?></h3>
			<p><?php echo $copy; ?></p>
		</div>
		<a href="<?php echo $button['link']; ?>" class="o-btn o-btn--orange"><?php echo $button['label']; ?></a>
	</div>
</div>
<?php endif; ?>