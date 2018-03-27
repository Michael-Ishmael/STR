<?php

    if($this_post !== null) {

	    $content = $this_post->post_content;
	    $content = apply_filters('the_content', $content);
	    $content = str_replace(']]>', ']]&gt;', $content);

	    ?>


        <section class="overlay h-100" id="overlay-expertise-<?php echo $this_post->ID ?>">
            <div class="row h-100 m-0">

                <div class="d-none d-md-block col-md-6 p-0 overlay-column h-100 left">
                    <div class="overlay-image-container h-100">
                    </div>
                </div>

                <div class="col-12 col-md-6 p-0 overlay-column h-100 right">
                    <div class="close-button-bar d-none d-md-block">
                        <div class="close-button-container"><a class="close-button bg-blue" href="#">
                                <div class="cross"></div>
                            </a></div>
                    </div>

                    <div class="overlay-content h-100">
                        <div class="overlay-main clearfix">
                            <h6 class="clr-dark-blue text-uppercase font-weight-bold clr-mid-blue">
                                Our Expertise</h6>
                            <h2 class="display-2"> <?php echo get_the_title($this_post) ?> </h2>
                            <p class="clr-mid-blue">
							    <?php echo $content ?>
                            </p>
                        </div>
					    <?php if($next_post !== null):  ?>
                            <div class="overlay-footer bg-light-cream">
                                <h6 class="text-uppercase">Next Field of Expertise</h6>
                                <h4 class="display-4"><a class="overlay-link" href="#overlay-expertise-<?php echo $next_post->ID ?>"
                                                         data-overlay="overlay-expertise-<?php echo $next_post->ID ?>"><?php echo get_the_title($next_post) ?>   </a></h4>
                            </div>
					    <?php  endif;  ?>
					    <?php if($previous_post !== null):  ?>
                            <div class="overlay-footer bg-light-cream">
                                <h6 class="text-uppercase">Previous Field of Expertise</h6>
                                <h4 class="display-4"><a class="overlay-link" href="#overlay-expertise-<?php echo $previous_post->ID ?>"
                                                         data-overlay="overlay-expertise-<?php echo $previous_post->ID ?>"><?php echo get_the_title($previous_post) ?>  </a></h4>
                            </div>
					    <?php  endif;  ?>
                    </div>
                    <div class="close-button-bar bottom d-md-none">
                        <div class="close-button-container"><a class="close-button bg-blue" href="#">
                                <div class="cross"></div>
                            </a></div>
                    </div>

                </div>
            </div>
        </section>

        <?php

    }



?>
