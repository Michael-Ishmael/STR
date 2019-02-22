<?php
/*
Template Name: Tailored Programmes
Template Post Type: page
*/

get_header();

?>
    <!-- theme generated styles -->
    <style>

        .commercial-services-tailor-banner-bg { background-image: url(<?php echo get_attachment_src_by_slug( "tailor-banner-2" ) ?>); }

    </style>

    <main role="main">

        <section class="container-fluid bg-blue">
            <div class="str-hero jumbotron">
                <h1 class="display-1">Tailored <span class="clr-bright-blue">Programs</span></h1>

				<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>

                    <!-- article -->
                    <p id="post-<?php the_ID(); ?>" class="lead" <?php post_class(); ?>>

						<?php the_content(); ?>

                    </p>
                    <!-- /article -->

				<?php endwhile; ?>

				<?php endif; ?>

            </div>
            <div class="banner-bg commercial-services-tailor-banner-bg">

            </div>
        </section>


        <section class="container-fluid bg-blue " id="expertise">
            <h2 class="display-2 text-center clr-white d-none d-md-block">Program <span class="clr-bright-blue">Options</span></h2>
            <h2 class="display-2 text-center clr-white d-md-none">Program <span class="clr-bright-blue">Options</span></h2>


		    <?php

		    $grid_template_path = get_template_directory() . '/inc/str-tailored-progs-grid.php';
		    load_template( $grid_template_path, true );

		    ?>

		    <?php

		    $grid_template_path_mobile = get_template_directory() . '/inc/str-tailored-progs-grid-mobile.php';
		    load_template( $grid_template_path_mobile, true );

		    ?>

        </section>

        <section class="container-fluid bg-mid-cream  ">

            <div class="tailored-approach text-center">
                <h2 class="display-2">Our Approach</h2>

                <p>
                    Each of our tailored programs includes a combination of one or more of the following elements.
                </p>

            </div>


        </section>

	    <?php

	    $service_template_path = get_template_directory() . '/inc/str-tailored-stripes.php';
	    load_template($service_template_path, true);

	    ?>

        <section class="container-fluid commercial-contact-us bg-blue">
            <div class="py-4 px-5 text-center">
                <div>
                    <p class="lead">
                        To build a tailored program to address your business goals
                    </p>
                    <a class="btn btn-secondary btn-lg commercial-contact-us-btn" href="/#contact-us">Get In Touch</a>
                </div>
            </div>
        </section>

	    <?php


	    $elearning_link = get_permalink( get_page_by_path( 'elearning-training-modules' ) );

	    ?>

        <div class="d-none d-md-block">
            <section class="container-fluid box-link p-0 o-hidden">
                <div class="up-next services">
                    <div class="str-pic-hero bg-bright-blue text-center w-100 d-table center-div">
                        <div class="d-table-cell align-middle">
                            <h5 class="display-5 text-uppercase clr-white">Coming Up Next</h5>
                            <h2 class="display-2 clr-white">eLearning <span class="clr-dark-blue">Training Modules</span></h2>
                            <a
                                    class="btn btn-secondary btn-lg" href="<?php echo $elearning_link?>">Show eLearning</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>


        <?php

		$newsletter_template_path = get_template_directory() . '/inc/str-newsletter.php';
		load_template( $newsletter_template_path, true );

		?>

		<?php

		if ( get_overlay_is_on_page( 'tailored-programs', [ 'str_tailored_progs' ] ) ) {
			$bg_visible_style = "aria-hidden=\"false\" style=\"z-index: 100; visibility: inherit; opacity: 1;\"";
		} else {
			$bg_visible_style = "aria-hidden=\"true\"";
		}

		?>

        <div class="overlay-background" id="overlayBg" <?php echo $bg_visible_style ?>>
            <div class="container-fluid position-relative h-100 p-0">

				<?php

				$expertise_overlay_template_path = get_template_directory() . '/inc/str-tailored-progs-overlays.php';
				load_template( $expertise_overlay_template_path, true );

				$services_overlay_template_path = get_template_directory() . '/inc/str-tailored-appr-overlays.php';
				load_template($services_overlay_template_path, true);

				?>

            </div>
        </div>


    </main>

<?php get_footer(); ?>