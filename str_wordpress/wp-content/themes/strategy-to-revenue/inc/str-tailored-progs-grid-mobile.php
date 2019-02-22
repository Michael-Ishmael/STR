<?php

$args = array(
	'post_type' => 'str_tailored_progs',
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

	<div class="expertise-list-container d-md-none">
		<ul id="expertise-list">

			<?php

			while ( $loop_query->have_posts() ) : $loop_query->the_post(); ?>

				<?php

				$item_tile_title = get_post_meta( $post->ID, "meta_formatted_title", true );

				?>

				<li class="collapsed" data-toggle="collapse" data-target="#m-expertise-<?php echo $post->ID ?>" aria-expanded="false"
				    aria-controls="collapseOne">
                        <span class="d-flex justify-content-between align-items-center expander">
                            <?php echo the_title() ?>
	                        <i class="plus"></i></span>
					<div class="collapse expertise-content" id="m-expertise-<?php echo $post->ID ?>" data-parent="#expertise-list">
						<p><?php echo the_content() ?></p>
					</div>
				</li>


			<?php endwhile; ?>
		</ul>
	</div>


<?php

endif;

wp_reset_postdata();


?>
