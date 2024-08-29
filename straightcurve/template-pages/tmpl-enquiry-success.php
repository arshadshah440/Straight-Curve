<?php
/* Template Name: Enquiry Success */
get_header();

if ( have_posts() ) while ( have_posts() ) : the_post();

?>


<div class="c-contact-page-success">
    <div class="o-wrapper">
		<h1 hidden><?php the_title() ?></h1>
        <div class="successForm pt-3 pb-3">
			<?php the_content() ?>
        </div>
    </div>
</div>


<script type="text/javascript">
jQuery(document).on('nfFormReady', function() {
    const searchParams = new URL(document.location).searchParams;
    const intention = searchParams.get("user_intention");
    const btns = document.querySelectorAll("input[type='button']");

    btns.forEach(btn => {
        if (btn.value === "Get a price list") {

            if (intention === "pricelist") {
                btn.value = "Send";
                document.querySelector("#nf-field-294").value = "feedback";
            } else if (intention === "feedback") {
                document.querySelector("#nf-field-294").value = "pricelist";
            }
        }
    })
});
</script>


<?php endwhile;
get_footer(); ?>