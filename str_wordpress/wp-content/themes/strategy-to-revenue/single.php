<?php

get_header("article");

if (have_posts()): while (have_posts()) : the_post();

    $article_head_img_id  = get_post_meta( $post->ID, "meta_article_header_img", true );
    $article_head_img_src = wp_get_attachment_image_src( $article_head_img_id, 'picture-grid-tile-hi-res' )[0];
    $consultant_author_id = get_post_meta( $post->ID, "meta_consultant_author", true );

    $cons_oval_img_id  = get_post_meta( $consultant_author_id, "meta_team_oval_img", true );
    $consultant_oval_src = wp_get_attachment_image_src( $cons_oval_img_id, 'full' )[0];

    $cons_job_title = get_post_meta( $consultant_author_id, "meta_member_job_title", true );
    $consultant_name = get_the_title($consultant_author_id);

    $expertise_areas = get_post_meta( $post->ID, 'meta_area_of_expertise', true );

?>


	<main role="main">

        <div class="top-marker"></div>
        <div class="container-fluid p-0">

		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <div class="tools d-none d-md-block">
<!--                <a class="tool-item"><i class="print"></i><span>print</span></a>
                <a class="tool-item"><i class="share"></i><span>share</span></a>-->
            </div>
            <div class="top-marker"></div>
            <div class="article-header clearfix">
                <div class="author overlay-link" data-overlay="overlay-about-<?php echo $consultant_author_id ?>" >
                    <img src="<?php echo $consultant_oval_src ?>">
                    <div class="author-details">
                        <h4><?php echo $consultant_name ?></h4>
                        <h6><?php echo $cons_job_title ?></h6>
                    </div>
                </div>
                <h2 class="display-2"><?php echo the_title() ?></h2>
                <div class="skills consultant-skill-box">
	                <?php
	                foreach ($expertise_areas as $area_post_id){

		                $area_post = get_post($area_post_id);

		                if($area_post !== null){

			                ?>

                            <a class="skill overlay-link"
                               href="#overlay-expertise-<?php echo $area_post->ID ?>"
                               data-overlay="overlay-expertise-<?php echo $area_post->ID ?>">
				                <?php echo get_the_title($area_post) ?>
                            </a>

			                <?php
		                }

	                }

	                ?>

                </div>
            </div>


            <div class="article-body">

	            <?php the_content(); // Dynamic Content ?>

            </div>

        </article>
		<!-- /article -->

	<?php endwhile; ?>

	<?php else: ?>

		<!-- article -->
		<article>

			<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>

		</article>
		<!-- /article -->

	<?php endif; ?>



        </div>


		<?php

		$trailer_template_path = get_template_directory() . '/inc/str-insights-stripes.php';
		load_template($trailer_template_path, true);


		$trailer_template_path = get_template_directory() . '/inc/str-services-trailer.php';
		load_template($trailer_template_path, true);
		?>

        <div class="overlay-background" id="overlayBg" aria-hidden="true">
            <div class="container-fluid position-relative h-100 p-0">

				<?php

				$overlay_template_path = get_template_directory() . '/inc/str-team-member-overlays.php';
				load_template($overlay_template_path, true);

				$expertise_overlay_template_path = get_template_directory() . '/inc/str-expertise-overlays.php';
				load_template($expertise_overlay_template_path, true);

				$success_overlay_template_path = get_template_directory() . '/inc/str-success-story-overlays.php';
				load_template($success_overlay_template_path, true);

				?>

            </div>
        </div>

    </main>



<?php get_footer(); ?>
