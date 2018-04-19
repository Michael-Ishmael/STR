<?php


$loop_query = new WP_Query( array(
	'post_type' => 'str_success_story'
) );
$loop_query->set( 'meta_key', 'meta_item_index' );
$loop_query->set( 'orderby', array( 'meta_value_num' => 'ASC', 'date' => 'DESC' ) );
$meta_query = array(
	'key'     => 'meta_include_in_page',
	'value'   => 'true',
	'compare' => '==',
);
$loop_query->set( 'meta_query', $meta_query );

if ( $loop_query->have_posts() ) :

	while ( $loop_query->have_posts() ) : $loop_query->the_post();

		$item_overlay_img_id   = get_post_meta( $post->ID, "meta_success_overlay_img", true );
		$item_overlay_img_src  = '';
		$item_overlay_img_srcs = wp_get_attachment_image_src( $item_overlay_img_id, 'overlay-image-column-low-res' );

		if ( $item_overlay_img_srcs !== null ) {
			$item_overlay_img_src = $item_overlay_img_srcs[0];
		}

		$challenge_meta = get_post_meta( $post->ID, 'meta_success_challenge', true );

		$result_meta = get_post_meta( $post->ID, 'meta_success_result' );
		$results     = $result_meta[0];


		?>

        <section class="overlay h-100" id="overlay-success-<?php echo $post->ID ?>">
            <div class="row h-100 m-0">

                <div class="d-none d-md-block col-md-6 p-0 overlay-column h-100 left">
                    <div class="overlay-image-container h-100">
                        <img class="w-100" src="<?php echo $item_overlay_img_src ?>">
                    </div>
                </div>


                <div class="col-12 col-md-6 p-0 overlay-column h-100 right">
                    <div class="close-button-bar d-none d-md-block">
                        <div class="close-button-container"><a class="close-button bg-blue" href="#">
                                <div class="cross"></div>
                            </a></div>
                    </div>

                    <div class="overlay-content h-100">
                        <div class="d-md-none"><img class="w-100" src="<?php echo $item_overlay_img_src ?>"></div>
                        <div class="overlay-main clearfix">
                            <h6 class="clr-dark-blue text-uppercase clr-dark-blue">Success Story</h6>
                            <h3 class="display-3"><?php echo the_title() ?></h3>
                            <h4 class="display-4">Challenge</h4>
                            <p class="lead clr-dark-blue"><?php echo $challenge_meta ?> </p>
                        </div>
                        <div class="overlay-footer bg-light-cream lead">
                            <h4 class="display-4"> <?php echo ( sizeof( $results ) == 1 ) ? "Result" : "Results" ?></h4>
                        </div>


						<?php foreach ( $results as $key => $result ) { ?>
                            <div class="overlay-footer bg-light-cream result">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/result-cup.svg">
                                <p class="success-result clr-dark-blue"><?php echo $result; ?></p>
                            </div>


						<?php } ?>

                        <div class="overlay-main after">
                            <h4 class="display-4">Approach</h4>
                            <p class="body"><?php echo the_content() ?></p>
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
