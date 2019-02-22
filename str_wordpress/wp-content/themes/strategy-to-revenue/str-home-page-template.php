<?php
/*
Template Name: STR Home Page
Template Post Type: page, str_success_story
*/

get_header( "home" );

$mission_text = get_post_meta( $post->ID, "meta_mission_text", true );
$client_logo_ids = get_post_meta( $post->ID, "meta_client_logos", true );

?>

    <main>
        <section class="container-fluid bg-light-cream">
                <div class="text-center">
                    <div class="mission">
                        <h2 class="display-2">Our Mission</h2>
                        <p class="lead">

							<?php echo $mission_text ?>

                        </p>
                    </div>
                </div>
                <p class="lead clr-dark-blue text-center font-weight-bold" style="margin-top: 2rem">
                    Let’s get to work. You’re looking for:
                </p>
                <div class="row mission-nav-panel d-none d-md-flex">
                    <div class="col-12 col-md-6 text-right">
                        <a class="btn  btn-primary" href="/services">
                            Enterprise Professional Services
                        </a>
                    </div>
                    <div class="col-12 col-md-6 text-left">
                        <a class="btn  btn-primary" href="/commercial-services">
                            Sales & Sales Leadership Training
                        </a>
                    </div>

                </div>

            <div class="row mission-nav-panel-sm d-md-none">
                <div class="col-12 col-sm-6  text-center">
                    <a class="btn btn-primary" href="/services">
                        Enterprise Professional Services
                    </a>
                </div>
                <br>
                <div class="col-12 col-sm-6 text-center">
                    <a class="btn btn-primary" href="/commercial-services">
                        Sales & Sales Leadership Training
                    </a>
                </div>

            </div>

        </section>

        <section class="container-fluid questionnaire bg-blue">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <!--					<p class="sub text-uppercase">How can we help you</p>-->
                    <h2 class="display-2 clr-white">Making the Incredible a Reality</h2>
                </div>
            </div>
            <!--<div class="row horiz-buttons text-center justify-content-center">
				<div class="col-12 col-md-4">
					<div class="questionnaire-button-container"><a class="questionnaire-button bg-blue clr-white">Company with a sales team less than 100</a></div>
				</div>
				<div class="col-12 col-md-4">
					<div class="questionnaire-button-container"><a class="questionnaire-button bg-blue clr-white"> Company with a sales team of 100+</a></div>
				</div>
				<div class="col-12 col-md-4">
					<div class="questionnaire-button-container"><a class="questionnaire-button bg-blue clr-white"> A private equity company</a></div>
				</div>
			</div>-->
        </section>

        <section class="container-fluid">

			<?php

			$home_grid_template_path = get_template_directory() . '/inc/str-home-page-grid.php';
			load_template( $home_grid_template_path, true );

			?>


        </section>
        <section class="container-fluid clients bg-mid-cream">
            <div class="row clients justify-content-center">

				<?php foreach ($client_logo_ids as $logo_id):

					$logo_src = wp_get_attachment_image_src($logo_id, "full")[0];

					?>


                    <div class="col-12 col-sm-4 col-lg-2 client-logo-container text-center">
                        <div class="client"><img class="w-sm-50"
                                                 src="<?php echo $logo_src ?>">
                        </div>
                    </div>

				<?php endforeach; ?>

            </div>
        </section>

	    <?php

	    $newsletter_template_path = get_template_directory() . '/inc/str-newsletter.php';
	    load_template( $newsletter_template_path, true );

	    ?>


        <section class="container-fluid contact bg-mid-cream" id="contact-us">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <h1 class="display-1 mx-0">Our Offices</h1>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="contact-map"><img class="w-100 d-none d-md-block"
                                                  src="<?php echo get_attachment_src_by_slug( "pins-map" ) ?>">
                        <img class="w-100 d-md-none" src="<?php echo get_attachment_src_by_slug( "pins-map-sml" ) ?>"></div>
                </div>
            </div>
            <div class="row justify-content-center offices">
                <div class="col-12 col-sm-7 col-md-3">
                    <h4 class="display-4">United States</h4>
                    <p class="address">
                        The Atlanta Technology Village
                        <br>
                        3423 Piedmont Road Northeast
                        <br>
                        Atlanta, GA 30305
                    </p>
                    <a href="tel:+13124938639" class="phone">+1 312 493 8639</a>
                </div>
                <div class="d-none col-md-1"></div>
                <div class="col-12 col-sm-7 col-md-3">
                    <h4 class="display-4">United Kingdom</h4>
                    <p class="address">
                        1 Change Alley
                        <br>
                        London
                        <br>
                        EC3V 3ND
                    </p>
                    <a href="tel:+441753245543" class="phone">+44 (0) 1753 245543</a>
                </div>
                <div class="d-none col-md-1"></div>
                <div class="col-12 col-sm-7 col-md-3">
                    <h4 class="display-4">New Business</h4>
                    <p class="email"><a href="mailto:hello@strategytorevenue.com">hello@strategytorevenue.com</a></p>
                    <h4 class="display-4">Support</h4>
                    <p class="email"><a href="mailto:support@strategytorevenue.com">support@strategytorevenue.com</a></p>
                </div>
            </div>
        </section>


        <div class="overlay-background" id="overlayBg" aria-hidden="true">

            <div class="container-fluid position-relative h-100 p-0">

				<?php

				$services_overlay_template_path = get_template_directory() . '/inc/str-service-overlays.php';
				load_template( $services_overlay_template_path, true );

				$success_overlay_template_path = get_template_directory() . '/inc/str-success-story-overlays.php';
				load_template( $success_overlay_template_path, true );

				/*		    $team_overlay_template_path = get_template_directory() . '/inc/str-team-member-overlays.php';
							load_template($team_overlay_template_path, true);*/

				?>

            </div>

        </div>
    </main>

<?php
get_footer();
?>