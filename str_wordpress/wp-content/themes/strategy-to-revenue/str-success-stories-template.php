<?php
/*
Template Name: Success Stories Page
Template Post Type: page, str_success_story
*/

get_header(); ?>

	<main role="main">

			<section class="container-fluid bg-blue">
				<div class="str-hero jumbotron">
					<h1 class="display-1">Success <span class="clr-bright-blue">Stories</span></h1>

					<?php if (have_posts()): while (have_posts()) : the_post(); ?>

						<!-- article -->
						<p id="post-<?php the_ID(); ?>" class="lead" <?php post_class(); ?>>

							<?php the_content(); ?>

						</p>
						<!-- /article -->

						<?php endwhile; ?>

					<?php endif; ?>

			</section>
		<section class="container-fluid bg-blue">
			<?php

				$grid_template_path = get_template_directory() . '/inc/str-success-story-grid.php';
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

        <?php

        $trailer_template_path = get_template_directory() . '/inc/str-services-trailer.php';
        load_template($trailer_template_path, true);
        ?>


	</main>

<?php get_footer(); ?>