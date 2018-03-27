<?php

$args = array(
	'post_type' => 'str_service',
	'posts_per_page' => '20',
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

    <div class="str-hex-tile-container d-none d-md-block" id="hexLayout1">

		<?php

		while ( $loop_query->have_posts() ) : $loop_query->the_post(); ?>


					<?php

			$item_stripe_img_id = get_post_meta( $post->ID, "str_service_stripe_img", true );
			$item_stripe_img_src = wp_get_attachment_image_src( $item_tile_img_id, 'full' );

			$item_intro = get_post_meta( $post->ID, "meta_service_intro_text", true );

					?>

            <section class="container-fluid discovery" id="discovery">
                <div class="row d-sm-none">
                    <div class="col-12 p-0"><img class="w-100" src="<?php echo $item_stripe_img_src ?>"></div>
                </div>
                <div class="row str-pic-hero overlay-link" data-overlay="overlay-discovery">
                    <div class="col-12 col-md-6 heading">
                        <h2 class="display-2">Discovery</h2>
                        <p>Our rapid impact analysis enables us to identify with speed and precision your mission critical priorities and pinpoint the areas of your business that can benefit from improved alignment...</p>
                        <a class="overlay-link" href="#overlay-discovery" role="button">Continue Reading</a>
                    </div>
                </div>
            </section>



		<?php endwhile; ?>

    </div>


<?php

endif;

wp_reset_postdata();


?>
