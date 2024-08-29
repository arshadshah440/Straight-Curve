<?php
/**
 * The Template for displaying all single video Gallery posts
 */
get_header(); ?>


<div class="videoGallerySingle">
    <div class="o-wrapper">
        <div class="videoContent">

            <div class="titleContent">
                <div class="icon"><img src="<?php echo ASSETS; ?>/img/idea-icon.svg" alt="Idea"></div>
                <div class="titleBox">
                    <h1><?php the_title(); ?></h1>
                    <span><?php the_field( 'gallery_subheading' ); ?></span>
                </div>
            </div>

            <div class="productGalleryImages">
				<?php
				$gc = get_field('general_content', 'options');
				$images = get_field('gallery_images');
				if ($images): ?>
					<div class="product-gallery masonry">
						<?php foreach ($images as $image):
							$primaryProductData = '';
    						$secondaryProductData = '';

    						$data = array();

    						if (get_field('has_product_suggestions', $image['id']) == true) {
        						$primaryProductData = get_field('primary_product', $image['id'])->post_title . " | " . get_permalink(get_field('primary_product', $image['id'])->ID);

								$data['primary'] = array(
									'title' => get_field('primary_product', $image['id'])->post_title,
									'link' => get_permalink(get_field('primary_product', $image['id'])->ID),
								);

								if (get_field('secondary_products', $image['id'])) {
									$secondary_products = get_field('secondary_products', $image['id']);

									$arr = array();
									foreach ($secondary_products as $product) {
										$secondaryProductData .= $product->post_title . " | " . get_permalink($product->ID) . ', ';
										$secondary = array(
											'title' => $product->post_title,
											'link' => get_permalink($product->ID),
										);
										array_push($arr, $secondary);
									}
									$data['secondary'] = $arr;
								}
						    }
						?>
							<figure class="item">
								<a class="gallery-image" data-fancybox="images" href="<?php echo esc_url($image['url']); ?>" data-height="900" data-id="<?php echo esc_attr($image['id']); ?>" data-primary-product="<?php echo $primaryProductData; ?>" data-secondary-products="<?php echo $secondaryProductData; ?>">
									<div data-src="<?php echo esc_url($image['sizes']['medium_large']); ?>"></div>
									<!-- <img src="<?php // echo esc_url($image['sizes']['medium_large']); ?>" alt="<?php // echo esc_attr($image['alt']); ?>" /> -->
								</a>
								<figcaption>
									<?php if ($data['primary'] || $data['secondary']) : ?>
										<div class="caption-inner">
											<?php if ($data['primary']) : ?>
												<div class="primary">
													<p class="lead"><?php echo ($gc['gallery_label_1'] ? $gc['gallery_label_1'] : 'Recommended product'); ?></p>
													<h2 id="title"><a href="<?php echo esc_url($data['primary']['link']) ?>"><?php echo $data['primary']['title'] ?></a></h2>
												</div>
											<?php endif; ?>
											<?php if ($data['secondary']): ?>
												<div class="secondary">
													<p class="lead"><?php echo ($gc['gallery_label_2'] ? $gc['gallery_label_2'] : 'Similar products'); ?></p>
													<ul class="similar fa-ul">
														<?php foreach ($data['secondary'] as $item): ?>
															<li><a href="<?php echo esc_url($item['link']) ?>"><i class="far fa-tag"></i> <?php echo $item['title'] ?></a></li>
														<?php endforeach;?>
													</ul>
												</div>
											<?php endif;?>
											<button class="toggle-button"><i class="fas fa-chevron-up"></i></button>
										</div>
									<?php endif; ?>
								</figcaption>
							</figure>
						<?php endforeach;?>
					</div>
				<?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>