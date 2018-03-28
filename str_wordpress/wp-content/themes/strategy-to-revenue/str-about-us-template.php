<?php
/*
Template Name: About Us Page
Template Post Type: page
*/

get_header(); ?>

	<main role="main">

			<section class="container-fluid bg-blue">
				<div class="str-hero jumbotron">
					<h1 class="display-1">About <span class="clr-bright-blue">Us</span></h1>

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

				$grid_template_path = get_template_directory() . '/inc/str-team-member-grid.php';
				load_template($grid_template_path, true);

			?>

		</section>

        <div class="overlay-background" id="overlayBg" aria-hidden="true">
            <div class="container-fluid position-relative h-100 p-0">

	            <?php

                    $overlay_expertise_template_path = get_template_directory() . '/inc/str-expertise-overlays.php';
                    load_template($overlay_expertise_template_path, true);

                    $overlay_template_path = get_template_directory() . '/inc/str-team-member-overlays.php';
                    load_template($overlay_template_path, true);

	            ?>

            </div>
        </div>

        <?php

        $trailer_template_path = get_template_directory() . '/inc/str-insights-trailer.php';
        load_template($trailer_template_path, true);
        ?>


	</main>

<?php get_footer(); ?>