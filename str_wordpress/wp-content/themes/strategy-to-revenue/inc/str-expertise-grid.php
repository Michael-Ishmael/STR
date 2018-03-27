<?php

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

if ( $loop_query->have_posts() ) : ?>

    <div class="str-hex-tile-container d-none d-md-block" id="hexLayout1">

		<?php

		while ( $loop_query->have_posts() ) : $loop_query->the_post(); ?>

					<?php

					$item_tile_title = get_post_meta( $post->ID, "meta_formatted_title", true );

					?>

                    <div class="str-hex-tile overlay-link" id="expertise-<?php echo $post->ID ?>" data-overlay="overlay-expertise-<?php echo $post->ID ?>">
                        <div class="hex-inner text-center align-middle clr-white">
                            <a href="#overlay-expertise-<?php echo $post->ID ?>">
                                <?php echo $item_tile_title ?></a>
                            <span class="em-line"></span>
                        </div>
                    </div>

		<?php endwhile; ?>

    </div>


<?php

endif;

wp_reset_postdata();


?>
