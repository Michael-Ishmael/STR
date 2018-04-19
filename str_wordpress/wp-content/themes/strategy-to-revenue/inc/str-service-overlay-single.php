<?php

    if($this_post !== null) {

	    $item_overlay_img_id  = get_post_meta( $this_post->ID, "meta_service_overlay_img", true );
	    $item_overlay_img_src = wp_get_attachment_image_src( $item_overlay_img_id, 'overlay-image-column-low-res' )[0];

	    $item_mobile_img_id  = get_post_meta( $this_post->ID, "meta_service_mobile_img", true );
	    $item_mobile_img_src = wp_get_attachment_image_src( $item_mobile_img_id, 'picture-grid-tile-low-res' )[0];


	    $content = $this_post->post_content;
	    $content = apply_filters('the_content', $content);
	    $content = str_replace(']]>', ']]&gt;', $content);

	    ?>


        <section class="overlay h-100 p-0" id="overlay-<?php echo $this_post->ID ?>">
            <div class="row h-100 m-0">
                <div class="d-none d-md-block col-md-6 p-0 overlay-column h-100 left">
                    <div class="overlay-image-container h-100">
                        <img class="w-100" src="<?php echo $item_overlay_img_src ?>"></div>
                </div>
                <div class="col-12 col-md-6 p-0 overlay-column h-100 right">
                    <div class="close-button-bar d-none d-md-block">
                        <div class="close-button-container"><a class="close-button bg-blue" href="#">
                                <div class="cross"></div></a></div>
                    </div>
                    <div class="overlay-content h-100">
                        <div class="d-md-none"><img class="w-100" src="<?php echo $item_mobile_img_src ?>"></div>
                        <div class="overlay-main clearfix">
                            <h6 class="clr-dark-blue text-uppercase font-weight-bold clr-mid-blue text-center text-md-left">Services</h6>
                            <h2 class="display-2 text-center text-md-left"><?php echo get_the_title($this_post) ?></h2>
                            <div class="clr-mid-blue"><p><?php echo $content ?></p>
                            </div>
                        </div>
	                    <?php if($next_post !== null):  ?>
                        <div class="overlay-footer bg-light-cream">
                            <h6 class="text-uppercase">Next Service</h6>
                            <h4 class="display-4 large"><a class="overlay-link" href="#overlay-<?php echo $next_post->ID ?>"
                                                           data-overlay="overlay-<?php echo $next_post->ID ?>"><?php echo get_the_title($next_post) ?></a></h4>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="close-button-bar bottom d-md-none">
                        <div class="close-button-container"><a class="close-button bg-blue" href="#">
                                <div class="cross"></div></a></div>
                    </div>
                </div>
            </div>
        </section>


        <?php

    }



?>
