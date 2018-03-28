<?php

$insights_link = get_permalink( get_page_by_path( 'insights' ) );
$bg_img_src = get_attachment_src_by_slug( 'up-next-insights' );
$bg_img_src_sml = get_attachment_src_by_slug( 'insights-up-next-sml' );

?>

<!-- theme generated styles -->
<style>

    section.up-next {
        background-image: linear-gradient(to top, rgba(28, 36, 66, 0.52), rgba(28, 36, 66, 0)), url(<?php echo $bg_img_src_sml ?>);
    }

    @media (min-width: 576px) {
        section.up-next {
            background-image: linear-gradient(to top, rgba(28, 36, 66, 0.52), rgba(28, 36, 66, 0)), url(<?php echo $bg_img_src ?>);

</style>

<div class="d-none d-md-block">
    <section class="up-next container-fluid box-link p-0">
        <div class="str-pic-hero text-center w-100 d-table center-div">
            <div class="d-table-cell align-middle">
                <h5 class="display-5 text-uppercase clr-white">Coming Up Next</h5>

                <h2 class="display-2 clr-white">Insights from our <span class="clr-bright-blue">Experts</span></h2><a
                        class="btn btn-secondary btn-lg" href=" <?php echo $insights_link ?> ">Show Insights</a>

            </div>
        </div>
    </section>
</div>

