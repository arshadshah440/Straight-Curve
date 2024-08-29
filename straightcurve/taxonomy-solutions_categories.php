<?php get_header(); ?>

<?php
$taxonomy_prefix = 'solutions_categories';
$term_id = get_queried_object_id();
$term_id_prefixed = $taxonomy_prefix .'_'. $term_id;
global $post;
?>

<div class="solutionCategories">

    <?php
	// Page Builder
	if ( have_rows( 'solution_category_blocks', $term_id_prefixed ) ): while ( have_rows( 'solution_category_blocks', $term_id_prefixed ) ) : the_row();
			get_template_part( "template-blocks/block", get_row_layout() );
	endwhile; endif;
?>

</div>


<?php get_footer(); ?>