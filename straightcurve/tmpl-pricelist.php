<?php
/*
 * Template Name: Price list
 */

get_header();

$image = get_the_post_thumbnail_url();
$fields = get_fields();
$form_id = $fields['price_list_form_id'];
$thankyou_footer = $fields['thank_you_page_footer'];
$gc = get_field('general_content', 'options');
$sheet_pages = SHEET_PAGES;
?>

<div class="pricelistPage">
    <main id="Main" class="c-main-content o-main" role="main">
        <?php if ( have_posts() ) while ( have_posts() ) : the_post() ; ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="c-page__banner" style="background-image: url(<?php echo $image ?>)">
                <div class="o-wrapper">
                    <h1 class="page-title"><?php echo $fields['form_title']; ?></h1>
                </div>
            </div>

            <div class="c-cms-content o-wrapper">

                <!-- Ninja form section  -->
                <div class="o-layout pricelist-section" >
                    <div class="o-layout__item o-main  o-main-form  u-2/3@tablet">
                    	<?=do_shortcode("[ninja_form id=$form_id]"); ?>
                    </div>

                    <div class="o-layout__item o-side o-side-form u-1/3@tablet">
						<?php if (isset($fields['sidebar_section'][0])) : ?>
							<h3><?php echo $fields['sidebar_tilte']; ?></h3>
							<?php foreach ($fields['sidebar_section'] as $item) : ?>
								<?php if (isset($item['image']['url'])) : ?>
									<h4><?php echo $item['title']; ?></h4>
									<img src="<?php echo $item['image']['url']; ?>" alt="<?php echo $item['title']; ?>">
								<?php endif; ?>
							<?php endforeach; ?>
						<?php endif; ?>
                    </div>
                </div>

                <!-- thankyou section shows after form submition  -->
                <div class="thankyou-section" hidden >
                    <div class="o-layout">
                        <div class="o-layout__item o-main  u-7/12@mobileLandscape">
                            <?php the_content(); ?>
                        </div>
                        <div class="o-layout__item o-side u-5/12@mobileLandscape">
                            <img src="<?php echo $fields['thank_you_side_image']['url']; ?>">
                        </div>
                    </div>

					<div class="o-layout">
                        <div class="o-layout__item text-orange text-md u-7/12@mobileLandscape "><?php echo $thankyou_footer['title']; ?></div>
                        <div class="o-layout__item u-5/12@mobileLandscape explore-more"><img style="max-width: 270px; margin-top: -50px;"
                        src="<?php echo $thankyou_footer['script_image']['url']; ?>"></div>

						<?php foreach ($thankyou_footer as $field => $item) :
							$title = null;
							$href = null;
							if ($field === 'solution') {
								$title = $sheet_pages[6]['title'];
								$href = $sheet_pages[6]['url'];
								$page_link = $sheet_pages[6];
							} elseif ($field === 'where_to_buy') {
								$title = $sheet_pages[18]['title'];
								$href = $sheet_pages[18]['url'];
							} elseif ($field === 'gallery') {
								$title = $gc['nav_gallery'];
								$href = '#';
							}
							if ($href && $title && $item['btn_text'] && $item['image']) : ?>
								<div class="c-cat-tile o-layout__item u-1/2@tablet u-1/3@tabletWide">
									<a href="<?=$href?>" class="c-cat-tile__inner is-link lazyload" data-src="<?php echo $item['image']['url']; ?>">
										<div class="c-cat-tile__content">
											<h3><?=$title ?></h3>
											<span class="o-btn o-btn--orange"><?= $item['btn_text'] ?></span>
										</div>
									</a>
								</div>
							<?php endif;
						endforeach; ?>

                    </div>
                </div>
            </div>
        </article>
        <?php endwhile; ?>
    </main>
</div>

<?php get_footer(); ?>