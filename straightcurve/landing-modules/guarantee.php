<?php
$module = $args;

if (isset($module['guarantee'][0]['copy']) && $module['guarantee'][0]['copy']) : ?>
<div class="f-guarantee-module" id="<?php echo $module['module_id']; ?>">
	<div class="o-wrapper">
		<div class="f-guarantee-module__intro">
			<?php echo $module['intro']; ?>
		</div>

		<div class="f-guarantee-module__guarantees">
			<?php foreach ($module['guarantee'] as $item) :
				if ($item['copy'] && strlen($item['copy']) > 5) : ?>
					<div class="f-guarantee-module__guarantee">
						<img class="lazyload" src="<?php echo ASSETS; ?>/img/1x1.trans.gif" data-src="<?php echo $item['image']['url']; ?>" alt="">
						<div class="f-guarantee-module__guarantee-copy"><?php echo $item['copy']; ?></div>
					</div>
				<?php endif;
			endforeach; ?>
		</div>
	</div>
</div>
<?php endif; ?>