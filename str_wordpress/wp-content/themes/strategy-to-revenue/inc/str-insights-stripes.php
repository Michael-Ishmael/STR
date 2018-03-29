<?php

global $post;

$outer_page_post_id = isset( $post ) ? $post->ID : - 1;

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

if ( $loop_query->have_posts() ) :

    ?>
    <section class="more-insights container-fluid">
    <h3 class="display-3">Discover More Insights From Our Experts</h3>
<?php

	while ( $loop_query->have_posts() ) : $loop_query->the_post();

        if($post->ID == $outer_page_post_id) continue;

		$consultant_author_id = get_post_meta( $post->ID, "meta_consultant_author", true );

		$cons_oval_img_id    = get_post_meta( $consultant_author_id, "meta_team_oval_img", true );
		$consultant_oval_src = wp_get_attachment_image_src( $cons_oval_img_id, 'full' )[0];

		$cons_job_title  = get_post_meta( $consultant_author_id, "meta_member_job_title", true );
		$consultant_name = get_the_title( $consultant_author_id );

		$item_tile_img_id  = get_post_meta( $post->ID, "meta_article_stripe_insights_page_img", true );
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

	<?php

	endwhile;

	?>
    </section>
<?php

endif;

wp_reset_postdata();


?>
