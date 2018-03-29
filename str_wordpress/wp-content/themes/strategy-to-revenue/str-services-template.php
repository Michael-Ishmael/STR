<?php
/*
Template Name: Services Page
Template Post Type: page
*/

get_header(); ?>

	<main role="main">

        <section class="container-fluid bg-blue">
            <div class="str-hero jumbotron">
                <h1 class="display-1">5 Steps to <span class="clr-bright-blue">Incredible</span></h1>

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
                    <p>Before we offer you a solution we take time to understand your problem. Our early stage analysis is delivered with speed and precision in a matter of weeks.</p>
                </div>
                <div class="col-12 col-sml-6 col-md-4 str-card">
                    <div class="icon-container"><img src="<?php echo get_template_directory_uri() ?>/img/icon-identify.svg"></div>
                    <h3 class="display-3"><span class="heading-number">2.</span> Identify
                    </h3>
                    <p>We identify the inhibitors preventing you achieving your revenue goals; then we build a blueprint for change to help you tackle them.</p>
                </div>
                <div class="col-12 col-sml-6 col-md-4 str-card">
                    <div class="icon-container"><img src="<?php echo get_template_directory_uri() ?>/img/icon-improve.svg"></div>
                    <h3 class="display-3"><span class="heading-number">3.</span> Improve
                    </h3>
                    <p>From here we build sales coaching and education programs to arm your teams with the skills and knowledge they need to achieve sustained commercial improvement.</p>
                </div>
                <div class="col-12 col-sml-6 col-md-4 str-card">
                    <div class="icon-container"><img src="<?php echo get_template_directory_uri() ?>/img/icon-sustain.svg"></div>
                    <h3 class="display-3"><span class="heading-number">4.</span> Sustain
                    </h3>
                    <p>Ongoing assessment and training tools give you the power to continue to build your sales team’s competencies, so you continue to hit your targets.</p>
                </div>
                <div class="col-12 col-sml-6 col-md-4 str-card">
                    <div class="icon-container"><img src="<?php echo get_template_directory_uri() ?>/img/icon-succeed.svg"></div>
                    <h3 class="display-3"><span class="heading-number">5.</span> Succeed
                    </h3>
                    <p>Our goal is your success. Our services concentrate on the 20% change that will deliver 80% of the results, to achieve the cultural business transformation that will accelerate sales performance and sustainable competitive advantage.</p>
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
                    Whether you operate in one town or across multiple languages and cultures,
                    we’ve almost certainly worked with a company like yours before.
                    We recognize that you need to deliver short term gains along with
                    longer-term business improvement so we break down our approach into
                    four distinct but complementary programs. Each of our award-winning
                    programs delivers immediate short-term successes but is also a key
                    component for cultural change and sustained commercial improvement.

                </p>
            </div>
        </section>

		<?php

		$service_template_path = get_template_directory() . '/inc/str-service-stripes.php';
		load_template($service_template_path, true);

		?>

        <!--

        <section class="container-fluid discovery" id="discovery">
            <div class="row d-sm-none">
                <div class="col-12 p-0"><img class="w-100" src="img/services-discovery-sml.jpg"></div>
            </div>
            <div class="row str-pic-hero overlay-link" data-overlay="overlay-discovery">
                <div class="col-12 col-md-6 heading">
                    <h2 class="display-2">Discovery</h2>
                    <p>Our rapid impact analysis enables us to identify with speed and precision your mission critical priorities and pinpoint the areas of your business that can benefit from improved alignment...</p><a class="overlay-link" href="#overlay-discovery" role="button">Continue Reading</a>
                </div>
            </div>
        </section>
        <section class="container-fluid mapping" id="mapping">
            <div class="row d-sm-none">
                <div class="col-12 p-0"><img class="w-100" src="img/services-mapping-sml.jpg"></div>
            </div>
            <div class="row str-pic-hero overlay-link" data-overlay="overlay-mapping">
                <div class="col-12 col-md-6 heading">
                    <h2 class="display-2">Mapping</h2>
                    <p>Using the blueprint from the Discovery phase, our multidiscipline team of senior sales and marketing leaders helps you to navigate a course towards sustained competitive advantage...</p><a class="overlay-link" href="#overlay-mapping" role="button">Continue Reading</a>
                </div>
            </div>
        </section>
        <section class="container-fluid pathfinder" id="pathfinder">
            <div class="row d-sm-none">
                <div class="col-12 p-0"><img class="w-100" src="img/services-pathfinder-sml.jpg"></div>
            </div>
            <div class="row str-pic-hero overlay-link" data-overlay="overlay-pathfinder">
                <div class="col-12 col-md-6 heading">
                    <h2 class="display-2">Pathfinder</h2>
                    <p>Pathfinder bridges that gap between your strategy and your sales team’s ability to fulfil it. We translate mission critical objectives into achievable deliverables...</p><a class="overlay-link" href="#overlay-pathfinder" role="button">Continue Reading</a>
                </div>
            </div>
        </section>
        <section class="container-fluid compass" id="compass">
            <div class="row d-sm-none">
                <div class="col-12 p-0"><img class="w-100" src="img/services-compass-sml.jpg"></div>
            </div>
            <div class="row str-pic-hero overlay-link" data-overlay="overlay-compass">
                <div class="col-12 col-md-6 heading">
                    <h2 class="display-2">Compass</h2>
                    <p>When we give your teams the tools to achieve your revenue goals, we do it in a way that works best for your business...</p><a class="overlay-link" href="#overlay-compass" role="button">Continue Reading</a>
                </div>
            </div>
        </section>

        -->
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
                    We’re experienced group of sales and marketing leaders,
                    and education and coaching stalwarts who’ve all held
                    senior positions at global corporations, or rolled up
                    our sleeves to turn table-top start-ups into successful
                    international businesses; and in many cases, we’ve done both!

                </p>
            </div>
        </section>

        <section class="container-fluid">

	        <?php

	        $grid_template_path_mobile = get_template_directory() . '/inc/str-consultant-trio.php';
	        load_template($grid_template_path_mobile, true);

	        ?>


<!--            <div class="row str-feature-box-container">
                <div class="col-12 col-md-4 str-feature-box bg-light-cream"><a class="overlay-link" href="#overlay-about-tony-w" data-overlay="overlay-about-tony-w"><img class="str-feature-image" src="img/about-tony-w.jpg"></a>
                    <div class="str-feature-text text-center">
                        <h3 class="display-3">Tony Wand</h3>
                        <h6 class="display-6 text-uppercase">Senior Consultant</h6>
                        <p class="summary">Sales Tools &amp; Process, Channel Engagement, Sales Efficiency, Winning in New Markets &amp; Territories, Performance Management</p>
                        <div class="links"><a class="str-button btn btn-primary btn-lg" href="mailto:tony.wand@strategytorevenue.com">Get in Touch</a><a class="str-button btn btn-lg btn-outline-secondary overlay-link" href="#overlay-about-tony-w" data-overlay="overlay-about-tony-w">About Tony</a></div>
                    </div>
                </div>
                <div class="col-12 col-md-4 str-feature-box bg-light-cream"><a class="overlay-link" href="#overlay-about-martin-d" data-overlay="overlay-about-martin-d"><img class="str-feature-image" src="img/about-martin-d.jpg"></a>
                    <div class="str-feature-text text-center">
                        <h3 class="display-3">Martin Dean</h3>
                        <h6 class="display-6 text-uppercase">Senior Consultant</h6>
                        <p class="summary">Sales Efficiency, New Product Messaging, Competitor Positioning, Recruiting, On-boarding and Re-boarding</p>
                        <div class="links"><a class="str-button btn btn-primary btn-lg" href="mailto:martin.dean@strategytorevenue.com">Get in Touch</a><a class="str-button btn btn-lg btn-outline-secondary overlay-link" href="#overlay-about-martin-d" data-overlay="overlay-about-martin-d">About Martin</a></div>
                    </div>
                </div>
                <div class="col-12 col-md-4 str-feature-box bg-light-cream"><a class="overlay-link" href="#overlay-about-neil-w" data-overlay="overlay-about-neil-w"><img class="str-feature-image" src="img/about-neil-w.jpg"></a>
                    <div class="str-feature-text text-center">
                        <h3 class="display-3">Neil Whitelock</h3>
                        <h6 class="display-6 text-uppercase">Senior Consultant</h6>
                        <p class="summary">Customer Segmentation, Compensation &amp; Incentives, Sales Tools &amp; Process, Sales Efficiency, Reporting &amp; Analysis</p>
                        <div class="links"><a class="str-button btn btn-primary btn-lg" href="mailto:neil.whitelock@straegytorevenue.com">Get in Touch</a><a class="str-button btn btn-lg btn-outline-secondary overlay-link" href="#overlay-about-neil-w" data-overlay="overlay-about-neil-w">About Neil</a></div>
                    </div>
                </div>
            </div>-->

            <div class="row str-cream-blue-box box-link">
                <div class="col-12 text-center p-5">
                    <div class="circles text-center">
                        <div class="circle tony"></div>
                        <div class="circle martin"></div>
                        <div class="circle neil"></div><a class="circle blue bg-blue clr-white" href="/about-us.html">+9</a>
                    </div>
                    <div class="d-inline-block consult-link-text-container"><a class="d-inline-block font-weight-bold f-28" href="/about-us.html">Show all consultants</a></div>
                </div>
            </div>
        </section>

        <div class="overlay-background" id="overlayBg" aria-hidden="true">
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