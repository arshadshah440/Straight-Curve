<?php


/********* 
 * Posts Loop Home
 */

$thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'full');
$title = get_the_title();
$link = get_the_permalink();
$estimated = get_field('estimated_time');


?>
<a href="<?php echo $link; ?>">
    <div class="post_loop_ar">
        <div class="loopcard_header">
            <img src="<?php echo $thumbnail; ?>" alt="Featured Image">
        </div>
        <div class="loopcard_body">
            <p><?php echo $estimated; ?> minutes</p>
            <h3><?php echo $title; ?></h3>
            <div class="cta_read_icon_ar">
                <h6 class="read_ar">Read Article </h6>
                <div class="arrow_ar">
                    <?php include get_template_directory() . '/assets/img/fi-rr-arrow-left.svg' ?>
                </div>
            </div>
        </div>
    </div>
</a>