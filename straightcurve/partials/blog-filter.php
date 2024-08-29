<?php

$blogs_filter = get_field('blogs_filter');
$filter_category = isset($_GET["category"]) && $_GET["category"] !== "0" ? $_GET["category"] : null;
$filter_user_type = isset($_GET["user-type"]) && $_GET["user-type"] !== "0" ? $_GET["user-type"] : null;

$return_str = '';
$cur_category = 'all';
$categories = get_categories(array(
	'orderby' => 'name',
	'order' => 'ASC'
));

$user_types = get_user_types();

$show_reset = false;
?><div class="c-blog-filter">
    <div class="o-wrapper">
        <h2><?php echo $blogs_filter['title']; ?></h2>

		<form id="blog-search" method="GET" action="../blog-filter">
			<div class='select-wrapper'>
				<select name='category'>
					<option value='0'><?php echo $blogs_filter['category_placeholder']; ?></option>
					<?php
						foreach ($categories as $category) {
							if ($category->name !== "Uncategorized") {
								if ($filter_category === $category->slug) {
									$show_reset = true;
									echo "<option value='$category->slug' selected>" . $category->name . '</option>';
								} else {
									echo "<option value='$category->slug'>" . $category->name . '</option>';
								}
							}
						}
					?>
				</select>
			</div>
			<div class='select-wrapper'>
				<select name='user-type'>
					<option value='0'><?php echo $blogs_filter['user_type_placeholder']; ?></option>
					<?php
						foreach ($user_types as $user_type) {
							if ($filter_user_type === $user_type->slug) {
								$show_reset = true;
								echo "<option value='$user_type->slug' selected>" . $user_type->name . '</option>';
							} else {
								echo "<option value='$user_type->slug'>" . $user_type->name . '</option>';
							}
						}
					?>
				</select>
			</div>
			<span class="submit-button">
				<button class='o-btn'><?php echo $blogs_filter['filter_button_label']; ?></button>
			</span>
		</form>
		<?php if ($show_reset) : ?>
			<div class="c-blog-filter__clear">
				<a href="<?php the_permalink(); ?>"><i class="fal fa-minus-circle" aria-hidden="true"></i> Clear filter</a>
			</div>
		<?php endif; ?>
    </div>
</div>