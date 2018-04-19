<div class="row wide-picture-grid ">
    <div class="col-12 col-sm-6 p-0 home-column">
        <img class="w-100 d-none d-sm-block"
             src="<?php echo get_template_directory_uri() ?>/img/ratio-place-holder-1.gif">
        <div class="column-pic-container w-100">
			<?php

			$args = array(
				'post_type'      => 'str_success_story',
				'posts_per_page' => '2',
				'meta_key'       => 'meta_item_index',
				'orderby'        => array( 'meta_value_num' => 'ASC', 'date' => 'DESC' ),
				'meta_query'     => array(
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

			while ( $loop_query->have_posts() ) :
			$loop_query->the_post();

			$item_tile_img_id  = get_post_meta( $post->ID, "meta_success_tile_img", true );
			$item_tile_img_src = wp_get_attachment_image_src( $item_tile_img_id, 'picture-grid-tile-low-res' );

			$caption_colour_class = get_post_meta( $post->ID, "meta_caption_color", true );
			if ( $caption_colour_class == null ) {
				$caption_colour_class = "clr-white";
			}

			?>


            <div class="str-grid-pic">
                <div class="success-image-tile overlay-link" data-overlay="overlay-success-<?php echo $post->ID ?>"
                ">
                <img class="h-align pic w-100 d-none d-sm-block" src="<?php echo $item_tile_img_src[0]; ?>">
                <img class="h-align pic w-100 d-sm-none" src="<?php echo $item_tile_img_src[0]; ?>">
                <img class="h-align gradient w-100" src="<?php echo get_template_directory_uri() ?>/img/shadow.png">
                <div class="photo-caption text-left">
                    <h3 class="display-3 <?php echo $caption_colour_class ?>"><?php echo the_title() ?></h3>
                    <h5 class="display-5 <?php echo $caption_colour_class ?>"><a
                                href="#overlay-success-<?php echo $post->ID ?>">read success story</a></h5>
                </div>
            </div>
        </div>

		<?php endwhile;

		endif;

		?>

        </div>
    </div>
    <div class="col-12 col-sm-6 str-insight-pic">

		<?php

		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => '1',
			'meta_key'       => 'meta_item_index',
			'orderby'        => array( 'meta_value_num' => 'ASC', 'date' => 'DESC' ),
			'meta_query'     => array(
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

				$consultant_author_id = get_post_meta( $post->ID, "meta_consultant_author", true );

				$cons_oval_img_id    = get_post_meta( $consultant_author_id, "meta_team_oval_img", true );
				$consultant_oval_src = wp_get_attachment_image_src( $cons_oval_img_id, 'full' )[0];

				$cons_job_title  = get_post_meta( $consultant_author_id, "meta_member_job_title", true );
				$consultant_name = get_the_title( $consultant_author_id );

				$item_tile_img_id  = get_post_meta( $post->ID, "meta_article_large_insights_page_img", true );
				$item_tile_img_src = wp_get_attachment_image_src( $item_tile_img_id, 'overlay-image-column-low-res' )[0];

				?>

                <div class="insight-image-tile w-100 o-hidden" onclick="window.location='<?php the_permalink() ?>';">
                    <img class="w-100" src="<?php echo $item_tile_img_src ?>"><img
                            class="h-align gradient" src="<?php echo get_template_directory_uri() ?>/img/shadow.png">
                    <div class="insight-info text-left p-5">
                        <div class="author"><img class="d-inline-block" src="<?php echo $consultant_oval_src ?>">
                            <div class="author-details d-inline-block">
                                <h4><?php echo $consultant_name ?></h4>
                                <h6><?php echo $cons_job_title ?></h6>
                            </div>
                        </div>
                        <div class="article-title single">
                            <h4 class="display-5 clr-white"><?php echo the_title() ?></h4>
                        </div>
                        <a class="btn btn-primary text-uppercase d-none d-md-inline-block"
                           href="<?php the_permalink() ?>">Read Article</a>
                    </div>
                </div>

			<?php

			endwhile;
		endif;

		wp_reset_postdata();

		?>

    </div>


</div>


