<?php
/* Template Name: Contact */
get_header();

if ( have_posts() ) while ( have_posts() ) : the_post();

$intro_block = get_field('intro_block');
$form = get_field('form');
$a_minute = get_field('a_minute');
$contact_info = get_field('contact_info');

$sheet_pages = SHEET_PAGES;
?><div class="c-contact-page">
    <div class="o-wrapper">
		<h1 hidden><?php the_title(); ?></h1>
        <div class="c-contact-page__intro-blocks">
			<div class="o-layout o-layout--large o-module">
				<?php foreach ($intro_block as $block) : ?>
					<div class="o-layout__item o-module__item u-1/2@tablet">
						<div class="c-contact-page__intro-block">
							<div class="boxContent <?php echo ($block['image'] ? 'imgHolder' : ''); ?>">
								<div class="txt">
									<h2 class="orange"><?php echo $block['title']; ?></h2>
									<?php echo $block['content']; ?>
								</div>
								<?php if ($block['image']) : ?>
									<div class="img">
										<img src="<?php echo $block['image']; ?>">
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
        </div> <!-- intro Block -->

        <div class="form-and-generalInfo pt-2 pb-5">
            <div class="formSection">
                <div class="formContent">
					<?php if ($a_minute && $a_minute['url']) : ?>
						<img src="<?php echo $a_minute['url']; ?>" alt="Only takes A minute" class="formContentMinute">
					<?php endif; ?>
                    <?php echo do_shortcode($form); ?>
                </div>
            </div>
            <div class="generalInfoSection">
                <div class="generalInfoContent">
                    <ul>
						<?php foreach ($contact_info as $item) : ?>
							<li>
								<?php if ($item['title']) : ?>
									<span class="title"><?php echo $item['title']; ?></span>
								<?php endif; ?>
								<?php if ($item['name']) : ?>
									<span class="name"><?php echo $item['name']; ?></span>
								<?php endif; ?>
								<?php if ($item['address']) : ?>
									<span class="address"><?php echo $item['address']; ?></span>
								<?php endif; ?>
								<?php if ($item['phones'] && count($item['phones']) > 0) : ?>
									<?php foreach ($item['phones'] as $i) : ?>
										<span class="number"><a href="tel:<?php echo $i['phone']; ?>"><?php echo ($i['prefix'] ? $i['prefix'] . ' ' : '') . $i['phone']; ?></a></span>
									<?php endforeach; ?>
								<?php endif; ?>
								<?php if ($item['email']) : ?>
									<span class="email"><a href="mailto:<?php echo $item['email']; ?>"><?php echo $item['email']; ?></a></span>
								<?php endif; ?>
							</li>
						<?php endforeach; ?>
						<?php if (current_site() === 'au' && isset($sheet_pages[18]['url'])) : ?>
							<li><a href="<?php echo $sheet_pages[18]['url']; ?>" class="o-btn o-btn--outline"><?php echo $sheet_pages[18]['title']; ?></a></li>
						<?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<?php endwhile;
get_footer(); ?>