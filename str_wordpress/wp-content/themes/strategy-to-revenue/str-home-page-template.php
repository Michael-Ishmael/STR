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
        <div class="row">
            <div class="col-12 col-md-7 p-0">
                <div class="mission">
                    <h2 class="display-2">Our Mission</h2>
                    <p class="lead">We help organisations unleash the potential of their sales teams, improving their
                        commercial performance, transforming their businesses, and accelerating the time it takes to
                        turn their strategy to revenue. We typically deliver:</p>
                    <ul class="deliveries">
                        <li><img src="<?php echo get_template_directory_uri() ?>/img/icon-time.svg">
                            <div class="delivery">
                                <p class="item clr-dark-blue">20% reduction in time</p>
                                <p>to effectiveness for new recruits</p>
                            </div>
                        </li>
                        <li class="last"><img src="<?php echo get_template_directory_uri() ?>/img/icon-succeed.svg">
                            <div class="delivery">
                                <p class="item clr-dark-blue">10% minimum growth</p>
                                <p>in recurring revenue</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-5 p-0 o-hidden ">
                <img class="w-100" src="<?php echo get_attachment_src_by_slug( "home-mission" ) ?>">
            </div>
        </div>
    </section>

    <!--    <section class="container-fluid questionnaire bg-blue">
			<div class="row justify-content-center">
				<div class="col-12 text-center">
					<p class="sub text-uppercase">How can we help you</p>
					<h2 class="display-2 clr-white">Which best describes you?</h2>
				</div>
			</div>
			<div class="row horiz-buttons text-center justify-content-center">
				<div class="col-12 col-md-4">
					<div class="questionnaire-button-container"><a class="questionnaire-button bg-blue clr-white">Company with a sales team less than 100</a></div>
				</div>
				<div class="col-12 col-md-4">
					<div class="questionnaire-button-container"><a class="questionnaire-button bg-blue clr-white"> Company with a sales team of 100+</a></div>
				</div>
				<div class="col-12 col-md-4">
					<div class="questionnaire-button-container"><a class="questionnaire-button bg-blue clr-white"> A private equity company</a></div>
				</div>
			</div>
		</section>-->

    <section class="container-fluid">

		<?php

		$home_grid_template_path = get_template_directory() . '/inc/str-home-page-grid.php';
		load_template( $home_grid_template_path, true );

		?>


    </section>
    <section class="container-fluid clients bg-mid-cream">
        <div class="row clients justify-content-center">
            <div class="col-12 col-sm-4 col-lg-2 client-logo-container text-center">
                <div class="client"><img class="w-sm-50"
                                         src="<?php echo get_template_directory_uri() ?>/img/logo-thomson-reuters.png">
                </div>
            </div>
            <div class="col-12 col-sm-4 col-lg-2 client-logo-container text-center">
                <div class="client"><img class="w-sm-50"
                                         src="<?php echo get_template_directory_uri() ?>/img/logo-dhl.png"></div>
            </div>
            <div class="col-12 col-sm-4 col-lg-2 client-logo-container text-center">
                <div class="client"><img class="w-sm-50"
                                         src="<?php echo get_template_directory_uri() ?>/img/logo-hewlett-packard-enterprise.png">
                </div>
            </div>
            <div class="col-12 col-sm-4 col-lg-2 client-logo-container text-center">
                <div class="client"><img class="w-sm-50"
                                         src="<?php echo get_template_directory_uri() ?>/img/logo-motorola.png"></div>
            </div>
            <div class="col-12 col-sm-4 col-lg-2 client-logo-container text-center">
                <div class="client"><img class="w-sm-50"
                                         src="<?php echo get_template_directory_uri() ?>/img/logo-vodafone.png"></div>
            </div>
        </div>
    </section>
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
                <p class="phone">+31 312 493 8639</p>
            </div>
            <div class="d-none col-md-1"></div>
            <div class="col-12 col-sm-7 col-md-3">
                <h4 class="display-4">United Kingdom</h4>
                <p class="address">
                    Regal Court Business Centre
                    <br>
                    42-44 High Street
                    <br>
                    Slough, SL1 1EL
                </p>
                <p class="phone">+31 (0) 1753 245543</p>
            </div>
            <div class="d-none col-md-1"></div>
            <div class="col-12 col-sm-7 col-md-3">
                <h4 class="display-4">New Business</h4>
                <p class="email">hello@strategytorevenue.com</p>
                <h4 class="display-4">Support</h4>
                <p class="email">support@strategytorevenue.com</p>
            </div>
        </div>
    </section>
    <section class="container-fluid newsletter bg-mid-cream" id="newsletter">
        <div class="newsletter-content text-center">
            <h6 class="sub text-uppercase">Stay up to date</h6>
            <h3 class="display-3">Newsletter</h3>
            <p>
                Stay up to date with the latest insights and tips on sales strategy and business transformation.

            </p>
            <form class="newsletter form-inline">
                <div class="input-container">
                    <label class="sr-only">email</label>
                    <input class="form-control w-100" type="text" placeholder="Enter your email address">
                </div>
                <div class="btn-container">
                    <button class="btn btn-primary w-100 text-uppercase" type="submit" value="Sign up">Sign Up</button>
                </div>
            </form>
        </div>
    </section>
    <div class="overlay-background" id="overlayBg" aria-hidden="true">

        <div class="container-fluid position-relative h-100 p-0">

			<?php

			$services_overlay_template_path = get_template_directory() . '/inc/str-service-overlays.php';
			load_template( $services_overlay_template_path, true );

			$success_overlay_template_path = get_template_directory() . '/inc/str-success-story-overlays.php';
			load_template( $expertise_overlay_template_path, true );

			/*		    $team_overlay_template_path = get_template_directory() . '/inc/str-team-member-overlays.php';
						load_template($team_overlay_template_path, true);*/

			?>

        </div>

    </div>

<?php get_footer(); ?>