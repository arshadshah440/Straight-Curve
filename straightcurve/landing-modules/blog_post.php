<?php

if (isset($args['post']) && $args['post'] && get_post_status($args['post']) === 'publish') :
$post_id = $args['post'];

$title = get_the_title($post_id);
$link = get_the_permalink($post_id);
$image_url = get_the_post_thumbnail_url($post_id, 'large');
$estimated_time = get_field('estimated_time', $post_id);
$user_type = get_field('user_type', $post_id);
$gc = get_field('general_content', 'options');
$cats = get_the_category($post_id);

$excerpt = wp_filter_nohtml_kses(get_the_excerpt($post_id));
$excerptChars = 220;
if (strlen($excerpt) > $excerptChars) {
	$excerpt = explode("\n", wordwrap($excerpt, $excerptChars));
	$excerpt = $excerpt[0] . '...';
}

?>
<div class="f-featured-blog" id="<?php echo $args['module_id']; ?>">
	<div class="o-wrapper">
		<a href="<?php echo $link; ?>" class="blog-item blog-featured">
			<div class="blog-item-details">
				<div class="blog-item-meta">
					<?php if (!empty($estimated_time)) : ?>
        				<div class='blog-item-estimate'><?php echo $estimated_time; ?> <?php echo ($gc['blog_estimate_suffix'] ? $gc['blog_estimate_suffix'] : "minutes"); ?></div>
					<?php endif; ?>
				</div>
				<h3 class="blog-item-title"><?php echo $title; ?></h3>

        		<div class='blog-item-excerpt'><?php echo $excerpt; ?></div>
				<span class='blog-item-read'><?php echo ($gc['blog_card_read_more'] ? $gc['blog_card_read_more'] : 'Read more'); ?></span>
			</div>

			<div class='blog-item-thumbnail' style='background-image: url(<?php echo $image_url; ?>)'>

				<div class='blog-item-tags'>
					<?php if (isset($user_type->name)) : ?>
            			<span class='green' data-tag-filter-user-type="<?php echo $user_type->slug; ?>"><?php echo $user_type->name; ?></span>
					<?php endif; ?>

					<?php if (isset($cats[0]->slug)) : ?>
						<?php foreach ($cats as $cat) {
							if ($cat->slug !== 'uncategorised' && $cat->slug !== 'uncategorized') {
								echo "<span class='orange' data-tag-filter-category='$cat->slug'>$cat->name</span>";
							}
						} ?>
					<?php endif; ?>
        		</div>
        	</div>
		</a>
	</div>
</div>
<?php endif; ?>