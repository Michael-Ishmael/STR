<?php

$args = array(
	'post_type'      => 'str_service',
	'posts_per_page' => '20',
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

if ( $loop_query->have_posts() ) : ?>

	<?php

	while ( $loop_query->have_posts() ) : $loop_query->the_post(); ?>


		<?php

		$item_stripe_img_id  = get_post_meta( $post->ID, "meta_service_stripe_img", true );
		$item_stripe_img_src = wp_get_attachment_image_src( $item_stripe_img_id, 'full' );

		$item_mobile_img_id  = get_post_meta( $post->ID, "meta_service_mobile_img", true );
		$item_mobile_img_src = wp_get_attachment_image_src( $item_mobile_img_id, 'full' );

		$item_intro = get_post_meta( $post->ID, "meta_service_intro_text", true );

		$class_and_id_name = sanitize_title(get_the_title());

		?>

        <!-- theme generated styles -->
        <style>
            @media (min-width: 576px) {
                section.<?php echo $class_and_id_name ?> {
                    background-image: linear-gradient(to right, rgba(17, 22, 40, 0.8), rgba(28, 36, 66, 0)), url(<?php echo $item_stripe_img_src[0] ?>); } }
        </style>

        <section class="container-fluid <?php echo $class_and_id_name ?>" id="<?php echo $class_and_id_name ?>">

            <div class="row d-sm-none">
                <div class="col-12 p-0"><img class="w-100" src="<?php echo $item_mobile_img_src[0] ?>"></div>
            </div>
            <div class="row str-pic-hero overlay-link" data-overlay="overlay-<?php echo $post->ID ?>">
                <div class="col-12 col-md-6 heading">
                    <h2 class="display-2"><?php echo the_title() ?></h2>
                    <p><?php echo $item_intro ?></p>
                    <a class="overlay-link" href="#overlay-<?php echo $post->ID ?>" role="button">Continue Reading</a>
                </div>
            </div>
        </section>


	<?php endwhile; ?>


<?php

endif;

wp_reset_postdata();


?>
