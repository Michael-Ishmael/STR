<?php


/*$loop_query = new WP_Query( array(
	'post_type' => 'str_success_story'
) );
$loop_query->set( 'meta_key', 'meta_item_index' );
$loop_query->set( 'orderby', array( 'meta_value_num' => 'ASC', 'date' => 'DESC' ) );
$meta_query = array(
	'key'     => 'meta_include_in_page',
	'value'   => 'true',
	'compare' => '==',
);
$loop_query->set( 'meta_query', $meta_query );*/

function IsNullOrEmptyString($str){
	return (!isset($str) || trim($str) === '');
}

$args = array(
	'post_type'  => 'str_training_progs',
	'meta_key'   => 'meta_item_index',
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


$page_slug = get_overlay_slug( "core-training-programmes" );


if ( $loop_query->have_posts() ) :

	while ( $loop_query->have_posts() ) : $loop_query->the_post();

		$item_overlay_img_id   = get_post_meta( $post->ID, "meta_training_overlay_img", true );
		$item_overlay_img_src  = '';
		$item_overlay_img_srcs = wp_get_attachment_image_src( $item_overlay_img_id, 'overlay-image-column-low-res' );

		if ( $item_overlay_img_srcs !== null ) {
			$item_overlay_img_src = $item_overlay_img_srcs[0];
		}

		//$meta_programme_overview = get_post_meta( $post->ID, 'meta_programme_overview', true );
		$meta_training_programme_pdf = get_post_meta( $post->ID, 'meta_training_programme_pdf', true );
		$meta_training_programme_eloqua_pdf_link = get_post_meta( $post->ID, 'meta_training_programme_eloqua_pdf_link', true );

		$download_link = $meta_training_programme_eloqua_pdf_link;
		if(IsNullOrEmptyString($download_link)){
			$download_link = $meta_training_programme_pdf;
        }

		/*		$result_meta = get_post_meta( $post->ID, 'meta_success_result' );
				$results     = $result_meta[0];*/

		if ( $post->post_name == $page_slug ) {
			$visible_style = "style=\"z-index: 1; display: block;\"";
		} else {
			$visible_style = null;
		}

		?>

        <style>

            .aps-logo-container {
                margin: 2.2rem 3rem;

            }

            .aps-logo-container .aps-logo {
                display: inline-block;
                background-image: url("<?php echo get_attachment_src_by_slug('aps_logo_2') ?>");
                background-size: contain;
                background-repeat: no-repeat;
                width: 25%;
                height: 3rem;
            }

            .training-flow-img-container {
                margin: 0 6rem;

            }

            .training-flow-img-container .training-flow-img {
                display: block;
                background-image: url("<?php echo get_attachment_src_by_slug('training_flow') ?>");
                background-size: contain;
                background-repeat: no-repeat;
            / / width: 100 %;
                height: 12rem;
            }

        </style>

        <section class="overlay h-100" id="<?php echo $post->post_name ?>" <?php echo $visible_style ?>>
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
                        <div class="aps-logo-container left">
                            <div class="aps-logo"></div>
                        </div>

                        <div class="d-md-none"><img class="w-100" src="<?php echo $item_overlay_img_src ?>"></div>
                        <div class="overlay-main clearfix">
                            <h6 class="clr-dark-blue text-uppercase clr-dark-blue">Training Program</h6>
                            <h3 class="display-3"><?php echo the_title() ?></h3>
                            <h4 class="display-4">Program Overview</h4>
                            <a class="btn btn-sm btn-primary float-right clearfix" target="_blank"
                               href="<?php echo $download_link ?>">Download PDF</a>
                            <p class="body"><?php echo the_content() ?></p>
                            <!--							<h4 class="display-4">Programme Overview</h4>
							<p class="lead clr-dark-blue"><?php /*echo $meta_programme_overview */ ?> </p>-->
                        </div>
                        <!--						<div class="overlay-footer bg-light-cream lead">
							<h4 class="display-4"> <?php /*echo ( sizeof( $results ) == 1 ) ? "Result" : "Results" */ ?></h4>
						</div>-->


                        <!--				<?php /*foreach ( $results as $key => $result ) { */ ?>
							<div class="overlay-footer bg-light-cream result">
								<img src="<?php /*echo get_template_directory_uri(); */ ?>/img/result-cup.svg">
								<p class="success-result clr-dark-blue"><?php /*echo $result; */ ?></p>
							</div>


						--><?php /*} */ ?>


                        <div class="overlay-footer no-border text-right">


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
