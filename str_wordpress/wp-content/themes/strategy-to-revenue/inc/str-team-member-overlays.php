<?php

$args = array(
	'post_type'  => 'str_team_member',
	'meta_key'   => 'meta_item_index',
	'posts_per_page' => -1,
	'orderby'    => array( 'meta_value_num' => 'ASC', 'date' => 'DESC' ),
	'meta_query' => array(
		'relation' => 'AND',
		array(
			'key'     => 'meta_include_in_page',
			'value'   => 'true',
			'compare' => '==',
		)
	)
);

$loop_query = new WP_Query( $args );

if ( $loop_query->have_posts() ) :

	while ( $loop_query->have_posts() ) : $loop_query->the_post();

		$item_overlay_img_id   = get_post_meta( $post->ID, "meta_team_overlay_img", true );
		$item_overlay_img_src  = '';
		$item_overlay_img_srcs = wp_get_attachment_image_src( $item_overlay_img_id, 'full' );

		if ( $item_overlay_img_srcs !== null ) {
			$item_overlay_img_src = $item_overlay_img_srcs[0];
		}

		$challenge_meta = get_post_meta( $post->ID, 'meta_area_of_expertise', true );

		$result_meta     = get_post_meta( $post->ID, 'meta_area_of_expertise' );
		$expertise_areas = $result_meta[0];

		$email      = get_post_meta( $post->ID, "meta_member_email", true );
		$linked_in  = get_post_meta( $post->ID, "meta_member_linkedIn", true );
		$twitter    = get_post_meta( $post->ID, "meta_member_job_twitter", true );
		$first_name = get_post_meta( $post->ID, "meta_member_first_name", true );
		$job_title  = get_post_meta( $post->ID, "meta_member_job_title", true );


		?>


        <section class="overlay h-100" id="overlay-about-<?php echo $post->ID ?>">
            <div class="row h-100 m-0">
                <div class="d-none d-md-block col-md-6 p-0 overlay-column h-100">
                    <div class="overlay-image-container h-100">
                        <img class="w-100" src="<?php echo $item_overlay_img_src ?>">
                    </div>
                </div>
                <div class="col-12 col-md-6 p-0 overlay-column h-100">
                    <div class="close-button-bar d-none d-md-block">
                        <div class="close-button-container"><a class="close-button bg-blue" href="#">
                                <div class="cross"></div>
                            </a></div>
                    </div>
                    <div class="overlay-content h-100">
                        <div class="d-md-none"><img src="<?php echo $item_overlay_img_src ?>"></div>
                        <div class="overlay-main clearfix">
                            <h6 class="clr-dark-blue text-uppercase font-weight-bold clr-mid-blue"><?php echo $job_title ?></h6>
                            <h2 class="display-2"><?php echo the_title() ?></h2>
                            <div class="clr-mid-blue">
								<?php echo the_content() ?>
                            </div>
                            <div class="contact-links">


	                            <?php if($twitter != null): ?>
                                    <a href="<?php echo $twitter ?>" target="_blank"><i
                                                class="twitter"></i></a>
	                            <?php endif; ?>
	                            <?php if($linked_in != null): ?>
                                    <a
                                            href="<?php echo $linked_in ?>"
                                            target="_blank"><i class="linked-in"></i></a>
	                            <?php endif; ?>
	                            <?php if($email != null): ?>
                                    <a
                                            href="mailto:<?php echo $email ?>"><i class="email"></i><span
                                                class="clr-dark-blue">Email</span></a>
	                            <?php endif; ?>







                            </div>
                        </div>
                        <div class="overlay-footer bg-light-cream">
                            <h4 class="display-4">Speak to <?php echo $first_name ?> about:</h4>
                            <div class="consultant-skill-box">

                                <?php
                                    foreach ($expertise_areas as $area_post_id){

                                        $area_post = get_post($area_post_id);

                                        if($area_post !== null){

                                            ?>

                                            <a class="skill overlay-link"
                                               href="#overlay-expertise-<?php echo $area_post->ID ?>"
                                               data-overlay="overlay-expertise-<?php echo $area_post->ID ?>">
                                                <?php echo get_the_title($area_post) ?>
                                            </a>

                                            <?php
                                        }

                                    }

                                ?>

                            </div>
                        </div>
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
	endwhile;

endif;

wp_reset_postdata();


?>
