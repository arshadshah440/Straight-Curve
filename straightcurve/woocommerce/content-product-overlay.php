<?php
	$var = get_query_var('var');
	if (!$var || !$var['product_id']) {
		return;
	}
	$args = array(
		'post_type' => 'product',
		'posts_per_page' => 1,
		'post__in' => array($var['product_id'])
	);
	$loop = new WP_Query( $args );
	if ( $loop->have_posts() ) {
		while ( $loop->have_posts() ) : $loop->the_post();
			wc_get_template_part( 'content-single-product' );
		endwhile;
	} else {
		echo __( 'No products found' );
	}
	wp_reset_postdata();
?>