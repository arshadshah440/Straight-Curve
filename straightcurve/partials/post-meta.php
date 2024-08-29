<footer class="c-cms-meta">
	<?php if( is_single() ) { ?>
		Posted on: <?php echo get_the_date(); echo "&nbsp;&nbsp;"; 
	}
	if( get_the_term_list( $post->ID, 'category', '', ', ', '' ) ){ ?>
		Category: <?php echo get_the_term_list( $post->ID, 'category', '', ', ', '' ); 
	}
	if( get_the_term_list( $post->ID, 'post_tag', '', ', ', '' ) ){ ?>
		&nbsp;&nbsp; Tags: <?php echo get_the_term_list( $post->ID, 'post_tag', '', ', ', '' );
	} ?>
</footer>