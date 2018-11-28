<?php
/*
Template Name: Marketing Page
Template Post Type: page
*/

get_header( "marketing" );

if ( have_posts() ): while ( have_posts() ) :
the_post();

$article_head_img_id  = get_post_meta( $post->ID, "meta_article_header_img", true );
$article_head_img_src = wp_get_attachment_image_src( $article_head_img_id, 'picture-grid-tile-hi-res' )[0];
$consultant_author_id = get_post_meta( $post->ID, "meta_consultant_author", true );

$cons_oval_img_id    = get_post_meta( $consultant_author_id, "meta_team_oval_img", true );
$consultant_oval_src = wp_get_attachment_image_src( $cons_oval_img_id, 'full' )[0];

$cons_job_title  = get_post_meta( $consultant_author_id, "meta_member_job_title", true );
$consultant_name = get_the_title( $consultant_author_id );

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

                <div class="icon-container"><img
                            src="http://localhost:8888/wp-content/themes/strategy-to-revenue/img/icon-sustain.svg">
                </div>


                <h2 class="title display-2"><?php echo the_title() ?></h2>

            </div>


            <div class="article-body">

				<?php the_content(); // Dynamic Content
				?>



            </div>

            <h3>
                Read our award-winning success stories
            </h3>

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


    <section class="container-fluid">
		<?php

		$grid_template_path = get_template_directory() . '/inc/str-mini-ss-grid.php';
		load_template($grid_template_path, true);

		?>

    </section>

	<?php

	$newsletter_template_path = get_template_directory() . '/inc/str-newsletter.php';
	load_template( $newsletter_template_path, true );
	?>



    <?php

	if(get_overlay_is_on_page('success-stories', ['str_success_story'])){
		$bg_visible_style = "aria-hidden=\"false\" style=\"z-index: 100; visibility: inherit; opacity: 1;\"";
	} else {
		$bg_visible_style = "aria-hidden=\"true\"";
	}

	?>

    <div class="overlay-background" id="overlayBg" <?php echo $bg_visible_style ?>>
        <div class="container-fluid position-relative h-100 p-0">

			<?php

			$overlay_template_path = get_template_directory() . '/inc/str-success-story-overlays.php';
			load_template($overlay_template_path, true);

			?>

        </div>
    </div>



<!--	<?php
/*
	$newsletter_template_path = get_template_directory() . '/inc/str-newsletter.php';
	load_template( $newsletter_template_path, true );


	$trailer_template_path = get_template_directory() . '/inc/str-insights-stripes.php';
	load_template( $trailer_template_path, true );


	$trailer_template_path = get_template_directory() . '/inc/str-services-trailer.php';
	load_template( $trailer_template_path, true );
	*/?>

    <div class="overlay-background" id="overlayBg" aria-hidden="true">
        <div class="container-fluid position-relative h-100 p-0">

			<?php
/*
			$overlay_template_path = get_template_directory() . '/inc/str-team-member-overlays.php';
			load_template( $overlay_template_path, true );

			$expertise_overlay_template_path = get_template_directory() . '/inc/str-expertise-overlays.php';
			load_template( $expertise_overlay_template_path, true );

			$success_overlay_template_path = get_template_directory() . '/inc/str-success-story-overlays.php';
			load_template( $success_overlay_template_path, true );

			*/?>

        </div>
    </div>
-->
</main>


<?php get_footer(); ?>
