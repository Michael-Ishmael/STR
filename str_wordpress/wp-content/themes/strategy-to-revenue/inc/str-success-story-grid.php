<?php

$args = array(
	'post_type' => 'str_success_story',
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

    <div class="row text-center wide-picture-grid bg-light-cream">


		<?php

		while ( $loop_query->have_posts() ) : $loop_query->the_post(); ?>


            <div class="col-12 col-md-6 str-grid-pic">
                <div class="success-image-tile overlay-link" data-overlay="overlay-success-<?php echo $post->ID ?>">
					<?php

					$item_tile_img_id = get_post_meta( $post->ID, "meta_success_tile_img", true );
					$item_tile_img_src = wp_get_attachment_image_src( $item_tile_img_id, 'picture-grid-tile-low-res' );

					$caption_colour_class = get_post_meta( $post->ID, "meta_caption_color", true );
					if ( $caption_colour_class == null ) {
						$caption_colour_class = "clr-white";
					}

					?>
                    <img class="h-align pic" src="<?php echo $item_tile_img_src[0]; ?>">
                    <img class="h-align gradient" src="<?php echo get_template_directory_uri(); ?>/img/shadow.png">
                    <div class="photo-caption text-left">
                        <h3 class="display-3 <?php echo $caption_colour_class ?>"><?php echo get_the_title(); ?></h3>
                        <h5 class="display-5 <?php echo $caption_colour_class ?>">
                            <a class="overlay-link" href="#overlay-success-<?php echo $post->ID ?>">read success story</a></h5>
                    </div>
                </div>
            </div>

		<?php endwhile; ?>

    </div>


<?php

endif;

wp_reset_postdata();


?>
