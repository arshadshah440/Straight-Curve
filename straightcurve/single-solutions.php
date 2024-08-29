<?php
/**
 * The Template for displaying all single Solutions posts
 */
get_header();

if (current_site() === 'au' || current_site() === 'uk' || current_site() === 'nl' || (current_site() === 'us' && !is_live())) {
	get_template_part('partials/single-solution-new');
} else {
	get_template_part('partials/single-solution');
}

get_footer(); ?>