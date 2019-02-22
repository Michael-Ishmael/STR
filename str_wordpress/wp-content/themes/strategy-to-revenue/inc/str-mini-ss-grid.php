<?php

$args = array(
	'post_type' => 'str_success_story',
	'posts_per_page' => '9',
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

	<div class="row text-center small-picture-grid bg-light-cream">


		<?php

		while ( $loop_query->have_posts() ) : $loop_query->the_post();



			?>


			<div class="col-12 col-sm-4 str-grid-pic">
				<div class="success-image-tile overlay-link" data-overlay="<?php echo $post->post_name ?>">
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
						<h4 class="display-4 <?php echo $caption_colour_class ?>"><?php echo get_the_title(); ?></h4>
						<h5 class="display-5 <?php echo $caption_colour_class ?>">
							<a class="overlay-link" href="/<?php echo $post->post_name ?>">read success story</a></h5>
					</div>
				</div>
			</div>

		<?php endwhile; ?>

	</div>


<?php

endif;

wp_reset_postdata();


?>
