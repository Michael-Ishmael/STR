<?php
 global $post;

    $temp_post = $post;

    $args = array(
        'post_type' => 'str_team_member',
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
    $consultants = array();

    if ($loop_query->have_posts()) :
        while ($loop_query->have_posts()) : $loop_query->the_post();

	        $id= get_the_ID();
	        $consultants[$id]= array(
	                "name" => get_the_title(),
                    "ID" => $id,
                    "selected" => false
            );

        endwhile;
    endif;

    wp_reset_postdata();

    $post = $temp_post;

	$author  = get_post_meta( $post->ID, 'meta_consultant_author' , true);

    if(array_key_exists($author, $consultants)){
	    $consultants[$author]["selected"] = true;
    }

?>

<div id="str-expertise-check-list" >

    <label for="meta_consultant_author">Select which consultant to attribute the article:</label>

    <select name="meta_consultant_author" id="meta_consultant_author">
	    <?php foreach ( $consultants as $key => $consultant ) { ?>

                <option value="<?php echo $key; ?>" <?php echo $consultant["selected"] ? "selected" : "" ?> >
                    <?php echo $consultant["name"] ?>
                </option>

	    <?php } ?>
    </select>

</div>
