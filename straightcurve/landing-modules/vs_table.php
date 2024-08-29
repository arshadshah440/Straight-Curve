<?php
$module = $args;

?><div class="c-landing__table" id="<?php echo $module['module_id']; ?>">
	<div class="o-wrapper o-wrapper--med">
		<?php if ($module['title']) : ?>
			<h2 class="h2-large"><?php echo $module['title']; ?></h2>
		<?php endif; ?>
		<div class="c-landing__table-wrap">
			<table>
				<?php if (isset($module['table']['header']) && $module['table']['header'] && count($module['table']['header']) > 0) : ?>
					<tr>
						<?php foreach ($module['table']['header'] as $key => $item) : ?>
							<th><?php echo $item['c']; ?></th>
						<?php endforeach; ?>
					</tr>
				<?php endif; ?>
				<?php if (isset($module['table']['body']) && $module['table']['body'] && count($module['table']['body']) > 0) : ?>
					<?php foreach ($module['table']['body'] as $key => $items) : ?>
						<tr>
							<?php foreach ($items as $item) : ?>
								<td><?php
									if ($item['c'] === 'Y') {
										echo '<i class="far fa-regular fa-check"></i>';
									} elseif ($item['c'] === 'N') {
										echo '<i class="far fa-regular fa-times"></i>';
									} else {
										echo $item['c'];
									}
								?></td>
							<?php endforeach; ?>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</table>
		</div>
	</div>
</div>
