<?php
/*
Template Name: Insights Page
Template Post Type: page
*/

get_header(); ?>

	<main role="main">

			<section class="container-fluid bg-blue">
				<div class="str-hero jumbotron">
					<h1 class="display-1">Expert <span class="clr-bright-blue">Insights</span></h1>



					<?php if (have_posts()): while (have_posts()) : the_post(); ?>

						<!-- article -->
						<p id="post-<?php the_ID(); ?>" class="lead" <?php post_class(); ?>>

							<?php the_content(); ?>

						</p>
						<!-- /article -->

						<?php endwhile; ?>

					<?php endif; ?>

                </div>
			</section>

		<?php

		$newsletter_template_path = get_template_directory() . '/inc/str-newsletter.php';
		load_template( $newsletter_template_path, true );
		?>


        <?php

				$grid_template_path = get_template_directory() . '/inc/str-insights-grid.php';
				load_template($grid_template_path, true);

			?>



        <?php

        $trailer_template_path = get_template_directory() . '/inc/str-services-trailer.php';
        load_template($trailer_template_path, true);
        ?>


	</main>

<?php get_footer(); ?>