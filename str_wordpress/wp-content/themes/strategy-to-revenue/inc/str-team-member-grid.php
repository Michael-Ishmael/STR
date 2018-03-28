<?php

$args = array(
	'post_type' => 'str_team_member',
	'meta_key' => 'meta_item_index',
	'orderby' => array( 'meta_value_num' => 'ASC', 'date' => 'DESC' ),
    'meta_query' => array (
            'relation' => 'AND',
            array(
                'key'     => 'meta_include_in_page',
                'value'   => 'true',
                'compare' => '==',
            )
    )
);

$loop_query = new WP_Query( $args );



if ( $loop_query->have_posts() ) : ?>

    <div class="row text-center wide-picture-grid">


		<?php

		while ( $loop_query->have_posts() ) : $loop_query->the_post(); ?>

            <div class="col-12 col-md-6 col-xl-4 str-grid-pic">
                <div class="about-us-image-tile">

	                <?php

	                $item_tile_img_id = get_post_meta( $post->ID, "meta_team_tile_img", true );
	                $item_tile_img_src = wp_get_attachment_image_src( $item_tile_img_id, 'full' )[0];

	                $item_tile_img_blur_id = get_post_meta( $post->ID, "meta_team_tile_blur_img", true );
	                $item_tile_img_blur_src = wp_get_attachment_image_src( $item_tile_img_blur_id, 'full' )[0];

	                $email = get_post_meta( $post->ID, "meta_member_email", true );
	                $linked_in = get_post_meta( $post->ID, "meta_member_linkedIn", true );
	                $twitter = get_post_meta( $post->ID, "meta_member_job_twitter", true );
	                $first_name = get_post_meta( $post->ID, "meta_member_first_name", true );
	                $job_title = get_post_meta( $post->ID, "meta_member_job_title", true );

	                ?>

                    <img class="h-align" src="<?php echo $item_tile_img_src ?>">
                    <img class="h-align gradient" src="<?php echo get_template_directory_uri() ?>/img/shadow.png">
                    <img class="h-align overlay overlay-link" src="<?php echo $item_tile_img_blur_src ?>" data-overlay="overlay-about-<?php echo $post->ID ?>">
                    <div class="name-caption-container text-center">
                        <div class="buttons upper">
                            <?php if($twitter != null): ?>
                            <a class="button" href="<?php echo $twitter ?>" target="_blank">
                                <img src="<?php echo get_template_directory_uri() ?>/img/twitter-white.svg"></a>
                            <?php endif; ?>
	                        <?php if($linked_in != null): ?>
                            <a class="button" href="<?php echo $linked_in ?>" target="_blank">
                                <img src="<?php echo get_template_directory_uri() ?>/img/linked-in-white.svg"></a>
	                        <?php endif; ?>
	                        <?php if($email != null): ?>
                            <a class="button" href="mailto:<?php echo $email ?>">
                                <img src="<?php echo get_template_directory_uri() ?>/img/email-white.svg"> email</a>
                            <?php endif; ?>
                        </div>
                        <div class="v-spacer"></div>
                        <h3 class="display-3 clr-white"><?php echo the_title() ?></h3>
                        <div class="buttons lower">
                            <div class="btn btn-outline-light overlay-link" data-overlay="overlay-about-<?php echo $post->ID ?>">About <?php echo $first_name ?></div>
                            <h6 class="title text-uppercase"><?php echo $job_title ?></h6>
                        </div>
                    </div>
                </div>
            </div>

		<?php endwhile; ?>

        <div class="col-12 col-md-6 col-lg-12 str-grid-pic bg-bright-blue text-tile">
            <div class="w-100 h-100 clr-white about-us-image-tile">
                <h3 class="display-3">Unleash Your Potential</h3>
                <p>
                    We’re always on the lookout for like-minded
                    individuals who want to make the incredible a reality.
                    If you’ve got a track record of driving sales growth
                    and delivering sustained commercial improvement,
                    winning in new markets or restructuring businesses
                    to make them outstanding, get in touch.

                </p><a class="btn btn-lg btn-secondary" href="mailto:hello@strategytorevenue.com">join us</a>
            </div>
        </div>

    </div>


<?php

endif;

wp_reset_postdata();


?>
