<?php

$services_link = get_permalink( get_page_by_path( 'services' ) );

$bg_img_src = get_attachment_src_by_slug('up-next-services');

?>

<div class="d-none d-md-block">
    <section class="up-next container-fluid box-link" style="background-image: url('<?php echo $bg_img_src ?>')">
        <div class="str-pic-hero text-center w-100 d-table center-div">
            <div class="d-table-cell align-middle">
                <h5 class="display-5 text-uppercase clr-white">Coming Up Next</h5>
                <h2 class="display-2 clr-white">Our Services and <span class="clr-bright-blue">Expertise</span></h2><a
                        class="btn btn-secondary btn-lg" href="<?php echo $services_link ?>">Show Services</a>
            </div>
        </div>
    </section>
</div>
