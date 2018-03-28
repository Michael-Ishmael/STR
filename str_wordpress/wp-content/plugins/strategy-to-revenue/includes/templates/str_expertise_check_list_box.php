<?php
 global $post;

    $temp_post = $post;

    $args = array(
        'post_type' => 'str_expertise_area',
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
    $areas_of_expertise = array();

    if ($loop_query->have_posts()) :
        while ($loop_query->have_posts()) : $loop_query->the_post();

	        $id= get_the_ID();
	        $areas_of_expertise[$id]= array(
	                "title" => get_the_title(),
                    "ID" => $id,
                    "checked" => false
            );

        endwhile;
    endif;

    wp_reset_postdata();

    $post = $temp_post;

	$expertise_meta  = get_post_meta( $post->ID, 'meta_area_of_expertise' );
    $meta_areas_of_expertise = $expertise_meta[0];

    foreach ($meta_areas_of_expertise as $meta_area){
        if(array_key_exists($meta_area, $areas_of_expertise)){
	        $areas_of_expertise[$meta_area]["checked"] = true;
        }
    }



?>


<div id="str-expertise-check-list" style="line-height: 30px;">

    <h4>Select Areas of Expertise in which this consultant specialises:</h4>

	<?php foreach ( $areas_of_expertise as $key => $area ) { ?>

			<label for="meta_area_of_expertise_<?php echo $key; ?>" style="display: inline-block; margin-right: 20px">
				<strong><?php echo $area["title"] ?> </strong>
                <input type="checkbox" id="meta_area_of_expertise_<?php echo $key; ?>" name="meta_area_of_expertise[]"
				                               value="<?php echo $key; ?>" <?php echo $area["checked"] ? "checked" : "" ?> />
			</label>

	<?php } ?>
</div>
