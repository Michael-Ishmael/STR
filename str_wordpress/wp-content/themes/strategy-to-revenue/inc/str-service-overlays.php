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

	<?php

    $loop_index = 0;
    $post_count = $loop_query->post_count;
    $first_post = null;
    $this_post = null;
    $next_post = null;
	$service_overlay_single_template_path = get_template_directory() . '/inc/str-service-overlay-single.php';

	while ( $loop_query->have_posts() ) : $loop_query->the_post();


	    if($loop_index == 0){
	        $first_post = $post;
		    $this_post = null;
		    $next_post = $post;
        } else {

		    $this_post     = $next_post;
		    $next_post     = $post;

		    if($this_post !== null){
			    include($service_overlay_single_template_path);
            }

	    }

		$loop_index++;
	endwhile;

	$this_post     = $next_post;
	$next_post     = $first_post;
	if($this_post !== null){
		include($service_overlay_single_template_path);
	}

endif;

wp_reset_postdata();


?>
