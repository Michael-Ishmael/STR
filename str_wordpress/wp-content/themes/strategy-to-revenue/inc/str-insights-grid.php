<?php


$args = array(
	'post_type'  => 'post',
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
$loop_index = 0;
$loop_count = $loop_query->post_count;

if ( $loop_query->have_posts() ) :
	while ( $loop_query->have_posts() ) : $loop_query->the_post();

		$consultant_author_id = get_post_meta( $post->ID, "meta_consultant_author", true );

		$cons_oval_img_id  = get_post_meta( $consultant_author_id, "meta_team_oval_img", true );
		$consultant_oval_src = wp_get_attachment_image_src( $cons_oval_img_id, 'full' )[0];

		$cons_job_title = get_post_meta( $consultant_author_id, "meta_member_job_title", true );
		$consultant_name = get_the_title($consultant_author_id);

		?>

		<?php if ( $loop_index == 0 ): ?>
            <section class="container-fluid">
            <div class="row text-center">
		<?php endif; ?>

		<?php


		if ( $loop_index < 2 ):

			$item_tile_img_id = get_post_meta( $post->ID, "meta_article_large_insights_page_img", true );
			$item_tile_img_src = wp_get_attachment_image_src( $item_tile_img_id, 'full' )[0];

			?>


            <div class="col-12 col-md-6 str-insight-pic" onclick="window.location='<?php the_permalink() ?>;'">
                <div class="insight-image-tile w-100"><img class="h-align"
                                                           src="<?php echo $item_tile_img_src ?>"><img
                            class="h-align gradient"
                            src="<?php echo get_template_directory_uri() ?>/img/shadow.png">
                    <div class="insight-info text-left">
						<?php if ( isset( $consultant_name ) ): ?>
                            <div class="author"><img class="d-inline-block"
                                                     src="<?php echo $consultant_oval_src ?>">
                                <div class="author-details d-inline-block">
                                    <h4><?php echo $consultant_name ?></h4>
                                    <h6><?php echo $cons_job_title ?></h6>
                                </div>
                            </div>
						<?php endif; ?>
                        <div class="article-title">
                            <h4 class="display-5 clr-white"><?php echo the_title() ?></h4>
                        </div>
                        <a class="btn btn-primary text-uppercase d-none d-md-inline-block" href="<?php the_permalink() ?>">Read Article</a>
                    </div>
                </div>
            </div>


		<?php endif; ?>
		<?php if ( $loop_index == 1 || $loop_index == 0 && $loop_count == 1 ): ?>
            </div>
            </section>
		<?php

		endif;

		if ( $loop_index >= 2 && $loop_count > 2 ):

			?>

            <section class="container-fluid">

				<?php if ( $loop_index >= 2 ):

					$item_tile_img_id = get_post_meta( $post->ID, "meta_article_stripe_insights_page_img", true );
					$item_tile_img_src = wp_get_attachment_image_src( $item_tile_img_id, 'full' )[0];

					?>

                    <!-- WP generated style -->
                    <style>
                        .str-insight-stripe.stripe-article-bg-<?php echo $loop_index ?>:hover {
                            background-image: linear-gradient(to right, rgba(17, 22, 40, 0.8), rgba(28, 36, 66, 0)), url(<?php echo $item_tile_img_src ?>);
                            -webkit-background-size: 100%;
                            background-size: 100%;
                        }

                    </style>

                    <div class="row str-insight-stripe stripe-article-bg-<?php echo $loop_index ?>"
                         onclick="window.location='<?php the_permalink() ?>;'">
                        <div class="col-1 col-sm-2"></div>
                        <div class="col-10 col-sm-8">
                            <div class="insight-info text-left">
                                <div class="img-container"><img class="d-inline-block"
                                                                src="<?php echo $consultant_oval_src ?>"></div>
                                <div class="insight-details">
                                    <h6><?php echo $consultant_name ?></h6>
                                    <h4><?php the_title() ?></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-1 col-sm-2"></div>
                    </div>

				<?php endif; ?>

            </section>

		<?php
		endif;

		$loop_index ++;
	endwhile;

endif;

wp_reset_postdata();


?>
