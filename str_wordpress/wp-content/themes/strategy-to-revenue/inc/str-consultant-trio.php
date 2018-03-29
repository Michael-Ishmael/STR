<?php

$args = array(
	'post_type' => 'str_team_member',
	'posts_per_page' => -1,
	'no_found_rows'         => 'true',
	'_shuffle_and_pick'     => 3
);

$loop_query = new \WP_Query( $args );

if ( $loop_query->have_posts() ) : ?>


<div class="row str-feature-box-container">

    		<?php

		while ( $loop_query->have_posts() ) : $loop_query->the_post();

			$item_tile_img_id = get_post_meta( $post->ID, "meta_team_tile_img", true );
			$item_tile_img_src = wp_get_attachment_image_src( $item_tile_img_id, 'full' )[0];

			$item_tile_img_blur_id = get_post_meta( $post->ID, "meta_team_tile_blur_img", true );
			$item_tile_img_blur_src = wp_get_attachment_image_src( $item_tile_img_blur_id, 'full' )[0];

			$email = get_post_meta( $post->ID, "meta_member_email", true );
			$linked_in = get_post_meta( $post->ID, "meta_member_linkedIn", true );
			$twitter = get_post_meta( $post->ID, "meta_member_job_twitter", true );
			$first_name = get_post_meta( $post->ID, "meta_member_first_name", true );
			$job_title = get_post_meta( $post->ID, "meta_member_job_title", true );

			$expertise_areas  = get_post_meta( $post->ID, 'meta_area_of_expertise', true );

		?>

    <div class="col-12 col-md-4 str-feature-box bg-light-cream">
        <a class="overlay-link" href="#overlay-about-<?php echo $post->ID ?>" data-overlay="overlay-about-<?php echo $post->ID ?>">
            <img class="str-feature-image" src="<?php echo $item_tile_img_src ?>"></a>
        <div class="str-feature-text text-center">
            <h3 class="display-3"><?php echo the_title() ?></h3>
            <h6 class="display-6 text-uppercase"><?php echo $job_title ?></h6>
            <p class="summary">

	            <?php

                $area_count = count($expertise_areas);
                $area_index = 0;
	            foreach ($expertise_areas as $area_post_id){

		            $area_post = get_post($area_post_id);

		            if($area_post !== null){

			            ?>

                        <a class="overlay-link"
                           href="#overlay-expertise-<?php echo $area_post->ID ?>"
                           data-overlay="overlay-expertise-<?php echo $area_post->ID ?>">
				            <?php echo get_the_title($area_post) ?>
                        </a>

			            <?php
                        if($area_index < $area_count - 1) echo ", ";
		            }
		            $area_index++;
	            }
	            ?>

            </p>
            <div class="links"><a class="str-button btn btn-primary btn-lg" href="mailto:tony.wand@strategytorevenue.com">Get in Touch</a>
                <a class="str-button btn btn-lg btn-outline-secondary overlay-link" href="#overlay-about-<?php echo $post->ID ?>" data-overlay="overlay-about-<?php echo $post->ID ?>">
                About <?php echo $first_name ?>
                </a>
            </div>
        </div>
    </div>


		<?php endwhile; ?>

</div>

<?php

endif;

wp_reset_postdata();


?>
