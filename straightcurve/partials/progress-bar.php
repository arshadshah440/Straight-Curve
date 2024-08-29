<?php
$progress = array(
	array('link' => '/shop', 'label' => 'Product Selection'),
	array('link' => '/shop/accessory', 'label' => 'Accessory Selection'),
	array('link' => '/cart', 'label' => 'Shopping Review'),
	array('link' => '/checkout', 'label' => 'Purchase / Order / Print')
);
$active_step = 1;
if (is_product_category('accessory')) {
	$active_step = 2;
} elseif (is_cart()) {
	$active_step = 3;
} elseif (is_checkout()) {
	$active_step = 4;
}

?><div class="c-progress-bar">
	<div class="o-wrapper">
		<h3>Progress Bar</h3>
		<ul>
			<?php foreach ($progress as $key => $item) :
				$step = $key + 1;
				$class = 'in-active';
				if ($step === $active_step) {
					$class = 'is-active';
				} elseif ($step < $active_step) {
					$class = 'is-done';
				}
			?>
				<li class="<?php echo $class; ?>"><a href="<?php echo $item['link']; ?>"><span><?php echo $step; ?></span> <?php echo $item['label']; ?> <i class="far fa-chevron-down"></i></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>