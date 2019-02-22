<?php
/*
Template Name: Accent Page
Template Post Type: page
*/

get_header();

$services_text = get_post_meta( $post->ID, "meta_services_text", true );
$consultants_text = get_post_meta( $post->ID, "meta_consultants_text", true );

?>

	<main role="main">

        <section class="container-fluid bg-blue">
            <div class="str-hero jumbotron">
                <h1 class="display-1">Do Less. <span class="clr-bright-blue">Sell More.</span></h1>

				<?php if (have_posts()): while (have_posts()) : the_post(); ?>

                    <!-- article -->
                    <p id="post-<?php the_ID(); ?>" class="lead" <?php post_class(); ?>>

						<?php the_content(); ?>

                    </p>
                    <!-- /article -->

				<?php endwhile; ?>

				<?php endif; ?>

        </section>

        <section class="container-fluid d-none d-md-block">
            <div class="row text-center str-card-container">
                <div class="col-12 col-sml-6 col-md-4 str-card">
                    <div class="icon-container"><img src="<?php echo get_template_directory_uri() ?>/img/icon-analyse.svg"></div>
                    <h3 class="display-3"><span class="heading-number">1.</span> Analyze
                    </h3>
                    <p>Qualitative analysis of your business delivered with speed and precision</p>
                </div>
                <div class="col-12 col-sml-6 col-md-4 str-card">
                    <div class="icon-container"><img src="<?php echo get_template_directory_uri() ?>/img/icon-identify.svg"></div>
                    <h3 class="display-3"><span class="heading-number">2.</span> Identify
                    </h3>
                    <p>Pinpointing the critical blockers and enablers to kick-start your transformation with targeted solutions</p>
                </div>
                <div class="col-12 col-sml-6 col-md-4 str-card">
                    <div class="icon-container"><img src="<?php echo get_template_directory_uri() ?>/img/icon-improve.svg"></div>
                    <h3 class="display-3"><span class="heading-number">3.</span> Improve
                    </h3>
                    <p>Arming your teams with the skills and knowledge to achieve sustained commercial improvement</p>
                </div>
                <div class="col-12 col-sml-6 col-md-4 str-card">
                    <div class="icon-container"><img src="<?php echo get_template_directory_uri() ?>/img/icon-sustain.svg"></div>
                    <h3 class="display-3"><span class="heading-number">4.</span> Sustain
                    </h3>
                    <p>Building your sales teams’ capabilities, so you continue to hit your targets long after we’ve left the building</p>
                </div>
                <div class="col-12 col-sml-6 col-md-4 str-card">
                    <div class="icon-container"><img src="<?php echo get_template_directory_uri() ?>/img/icon-succeed.svg"></div>
                    <h3 class="display-3"><span class="heading-number">5.</span> Succeed
                    </h3>
                    <p>Our goal is your success. Accelerated sales performance delivered quickly via a succession of big impact,
                        milestones that propel you to the top of your game.</p>
                </div>
            </div>
        </section>
        <section class="d-md-none text-center">
            <div class="carousel slide str-card-container" id="stepCarousel" data-ride="carousel" data-interval="false">
                <ol class="carousel-indicators">
                    <li class="active" data-target="#stepCarousel" data-slide-to="0"></li>
                    <li data-target="#stepCarousel" data-slide-to="1"></li>
                    <li data-target="#stepCarousel" data-slide-to="2"></li>
                    <li data-target="#stepCarousel" data-slide-to="3"></li>
                    <li data-target="#stepCarousel" data-slide-to="4"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item str-card active text-center">
                        <div class="icon-container"><img src="<?php echo get_template_directory_uri() ?>/img/icon-analyse.svg"></div>
                        <h3 class="display-3"><span class="heading-number">1.</span> Analyze
                        </h3>
                        <p>Before we offer you a solution we take time to understand your problem. Our early stage analysis is delivered with speed and precision in a matter of weeks.</p>
                    </div>
                    <div class="carousel-item str-card text-center">
                        <div class="icon-container"><img src="<?php echo get_template_directory_uri() ?>/img/icon-identify.svg"></div>
                        <h3 class="display-3"><span class="heading-number">2.</span> Identify
                        </h3>
                        <p>We identify the inhibitors preventing you achieving your revenue goals; then we build a blueprint for change to help you tackle them.</p>
                    </div>
                    <div class="carousel-item str-card text-center">
                        <div class="icon-container"><img src="<?php echo get_template_directory_uri() ?>/img/icon-improve.svg"></div>
                        <h3 class="display-3"><span class="heading-number">3.</span> Improve
                        </h3>
                        <p>From here we build sales coaching and education programs to arm your teams with the skills and knowledge they need to achieve sustained commercial improvement.</p>
                    </div>
                    <div class="carousel-item str-card text-center">
                        <div class="icon-container"><img src="<?php echo get_template_directory_uri() ?>/img/icon-sustain.svg"></div>
                        <h3 class="display-3"><span class="heading-number">4.</span> Sustain
                        </h3>
                        <p>Ongoing assessment and training tools give you the power to continue to build your sales team’s competencies, so you continue to hit your targets.</p>
                    </div>
                    <div class="carousel-item str-card text-center">
                        <div class="icon-container"><img src="<?php echo get_template_directory_uri() ?>/img/icon-succeed.svg"></div>
                        <h3 class="display-3"><span class="heading-number">5.</span> Succeed
                        </h3>
                        <p>Our goal is your success. Our services concentrate on the 20% change that will deliver 80% of the results, to achieve the cultural business transformation that will accelerate sales performance and sustainable competitive advantage.</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="container-fluid bg-yellow">
            <div class="row str-main">
                <div class="col-12 col-md-6 heading text-center text-md-left">
                    <h1 class="display-1">Services</h1>
                </div>
                <div class="col-12 v-spacer d-md-none"></div>
                <p class="col-12 col-md-6 clr-dark-blue">
                    <?php echo $services_text ?>

                </p>
            </div>
        </section>

		<?php

		$service_template_path = get_template_directory() . '/inc/str-service-stripes.php';
		load_template($service_template_path, true);

		?>

        <section class="container-fluid bg-blue str-main expertise" id="expertise">
            <h1 class="display-1 text-center clr-white d-none d-md-block">Our Expertise</h1>
            <h2 class="display-2 text-center clr-white d-md-none">Our Expertise</h2>


	            <?php

	            $grid_template_path = get_template_directory() . '/inc/str-expertise-grid.php';
	            load_template($grid_template_path, true);

	            ?>

	        <?php

	        $grid_template_path_mobile = get_template_directory() . '/inc/str-expertise-grid-mobile.php';
	        load_template($grid_template_path_mobile, true);

	        ?>

        </section>
        <section class="container-fluid bg-yellow">
            <div class="row str-main">
                <div class="col-12 col-md-6 heading">
                    <h1 class="display-1 text-center text-md-left">Our Consultants</h1>
                </div>
                <div class="col-12 v-spacer d-md-none"></div>
                <p class="col-12 col-md-6 clr-dark-blue cons">
	                <?php echo $consultants_text ?>

                </p>
            </div>
        </section>

        <section class="container-fluid">

	        <?php

	        $grid_template_path_mobile = get_template_directory() . '/inc/str-consultant-trio.php';
	        load_template($grid_template_path_mobile, true);

	        ?>



        </section>

        <?php

        if(get_overlay_is_on_page('services', ['str_expertise_area', 'str_service', 'str_team_member'])){
	        $bg_visible_style = "aria-hidden=\"false\" style=\"z-index: 100; visibility: inherit; opacity: 1;\"";
        } else {
	        $bg_visible_style = "aria-hidden=\"true\"";
        }

        ?>

        <div class="overlay-background" id="overlayBg" <?php echo $bg_visible_style ?>>
            <div class="container-fluid position-relative h-100 p-0">

	            <?php

	            $services_overlay_template_path = get_template_directory() . '/inc/str-service-overlays.php';
	            load_template($services_overlay_template_path, true);

	            $expertise_overlay_template_path = get_template_directory() . '/inc/str-expertise-overlays.php';
	            load_template($expertise_overlay_template_path, true);

	            $team_overlay_template_path = get_template_directory() . '/inc/str-team-member-overlays.php';
	            load_template($team_overlay_template_path, true);

                ?>

            </div>
        </div>

        <?php

        $trailer_template_path = get_template_directory() . '/inc/str-insights-trailer.php';
        load_template($trailer_template_path, true);
        ?>


	</main>

<?php get_footer(); ?>