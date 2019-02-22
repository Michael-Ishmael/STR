<?php
/*
Template Name: Sales Training Template
Template Post Type: page, str_sales_training
*/

get_header(); ?>

    <main role="main">

        <section class="container-fluid bg-blue">
            <div class="str-hero jumbotron">
                <h2 class="display-1">Core Sales & Sales Leadership <span
                            class="clr-bright-blue">Training Programs</span></h2>

				<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>

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

			$grid_template_path = get_template_directory() . '/inc/str-training-programmes-grid.php';
			load_template( $grid_template_path, true );

			?>

        </section>


		<?php


		if ( get_overlay_is_on_page( 'success-stories', [ 'str_success_story' ] ) ) {
			$bg_visible_style = "aria-hidden=\"false\" style=\"z-index: 100; visibility: inherit; opacity: 1;\"";
		} else {
			$bg_visible_style = "aria-hidden=\"true\"";
		}

		?>

        <div class="overlay-background" id="overlayBg" <?php echo $bg_visible_style ?>>
            <div class="container-fluid position-relative h-100 p-0">

				<?php

				$overlay_template_path = get_template_directory() . '/inc/str-training-programmes-overlays.php';
				load_template( $overlay_template_path, true );

				?>

            </div>
        </div>

        <section class="container-fluid commercial-contact-us bg-blue">
            <div class="py-4 px-5 text-center">
                <div>
                    <p class="lead">
                        For a free consultation on which of our core programs best fits your needs
                    </p>
                    <a class="btn btn-secondary btn-lg commercial-contact-us-btn" href="/#contact-us">Get In Touch</a>
                </div>
            </div>
        </section>

		<?php


		$tailored_link = get_permalink( get_page_by_path( 'tailored-programs' ) );

		?>

        <div class="d-none d-md-block">
            <section class="container-fluid box-link p-0 o-hidden">
                <div class="up-next services">
                    <div class="str-pic-hero bg-bright-blue text-center w-100 d-table center-div">
                        <div class="d-table-cell align-middle">
                            <h5 class="display-5 text-uppercase clr-white">Coming Up Next</h5>
                            <h2 class="display-2 clr-white">Tailored <span class="clr-dark-blue">Programs</span></h2>
                            <a
                                    class="btn btn-secondary btn-lg" href="<?php echo $tailored_link ?>">Show Programs</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>


    </main>

<?php get_footer(); ?>