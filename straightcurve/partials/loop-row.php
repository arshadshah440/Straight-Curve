<?php if ( have_posts() ) : //Start of loop ?>
	<div class="c-rows o-layout">
		<?php while ( have_posts() ) : 
			the_post(); ?><div class="o-layout__item u-lap-wide-one-third u-lap-one-half c-row c-row--child">
				<a href="<?php the_permalink(); ?>" class="c-row__container" title="<?php the_title() ?>">
					<?php the_post_thumbnail('row-thumb', array('class' => 'c-row__img')); ?>
					<div class="c-row__content">
						<h2 class="c-row__heading"><?php the_title(); ?></h2>
						<div class="c-row__description"><?php echo excerpt($post->ID, 40); ?></div>
					</div>
				</a>
			</div><?php 
		endwhile; // End the loop. ?>
	</div>
<?php endif; ?>