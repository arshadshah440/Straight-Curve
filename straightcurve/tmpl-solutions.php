<?php
/*
 * Template Name: Solutions Page
 */

get_header();

if ( have_posts() ) while ( have_posts() ) : the_post();

$fields = get_fields();
$additional_tiles = $fields['additional_tiles'];
$gc = get_field('general_content', 'options');

?><div class="c-solutions">
	<div class="o-wrapper">
		<h1 class="c-solutions__title"><?php the_title(); ?></h1>

		<div class="c-solutions__cats">
			<div class="o-layout o-layout--large">
				<?php
					if (!$post->post_parent) {
						get_template_part('partials/solution_main_cats');
					}
				?>
				<?php if (isset($additional_tiles[0])) : ?>
					<?php foreach ($additional_tiles as $tile) : ?>
						<div class="c-cat-tile o-layout__item u-1/2@tablet">
							<?php if (isset($tile['button']['url']) && $tile['button']['url'] != '#') : ?>
								<a href="<?php echo $tile['button']['url']; ?>" class="c-cat-tile__inner is-link lazyload" data-src="<?php echo $tile['background_image']['url'] ?>">
							<?php else : ?>
								<div class="c-cat-tile__inner lazyload" data-src="<?php echo $tile['background_image']['url']; ?>">
							<?php endif; ?>
								<?php if ($tile['tag']) : ?>
									<span class="c-cat-tile__heavy-duty"><?php echo $tile['tag']; ?></span>
								<?php endif; ?>
								<div class="c-cat-tile__content">
									<?php if ($tile['image'] && isset($gc['inspiring_creativity']['url'])) : ?>
										<img src="<?php echo ASSETS; ?>/img/2x1.trans.gif" data-src="<?php echo $gc['inspiring_creativity']['url']; ?>" class="lazyload" alt="<?php echo $gc['inspiring_creativity']['title']; ?>">
									<?php endif; ?>
									<h3><?php echo $tile['title']; ?></h3>
									<?php if ($tile['tagline']) : ?>
										<h4><?php echo $tile['tagline']; ?></h4>
									<?php endif; ?>
									<?php if ($tile['list']) : $tile['list'] = explode('|', $tile['list']); ?>
										<ul>
											<?php foreach ($tile['list'] as $item) : ?>
												<li><?php echo trim($item); ?></li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
									<?php if (isset($tile['button']['url']) && $tile['button']['url'] != '#') : ?>
										<span class="o-btn"><?php echo $tile['button']['title']; ?></span>
									<?php endif; ?>
								</div>
							<?php if (isset($tile['button']['url']) && $tile['button']['url'] != '#') : ?>
								</a>
							<?php else : ?>
								</div>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>

	</div>

	<div class="c-solutions__content">
		<div class="o-wrapper o-wrapper--small">
			<div class="c-solutions__content-top">
				<?php the_content() ?>
			</div>
			<div class="c-solutions__content-bottom">
				<?php if ($fields['bottom_content']['intro_title']) : ?>
					<h2 class="c-solutions__content-bottom-intro-title"><?php echo $fields['bottom_content']['intro_title']; ?></h2>
				<?php endif; ?>
				<?php if ($fields['bottom_content']['intro_copy']) : ?>
					<div class="c-solutions__content-bottom-intro-copy"><?php echo $fields['bottom_content']['intro_copy']; ?></div>
				<?php endif; ?>
				<?php if ($fields['bottom_content']['accordian'] && count($fields['bottom_content']['accordian']) > 0) : ?>
					<div class="c-accordian">
						<?php foreach ($fields['bottom_content']['accordian'] as $item) : ?>
							<div class="c-accordian__item">
								<a href="javascript:void(0);" class="c-accordian__item-title"><h3><?php echo $item['title']; ?></h3></a>
								<div class="c-accordian__item-copy"><?php echo $item['copy']; ?></div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>


</div>
<?php endwhile; ?>
<?php get_footer(); ?>