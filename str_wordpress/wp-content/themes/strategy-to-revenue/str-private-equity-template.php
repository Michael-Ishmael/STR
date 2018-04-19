<?php
/*
Template Name: Private Equity Page
Template Post Type: page
*/

get_header(); ?>

	<main role="main">

			<section class="container-fluid bg-blue">
				<div class="str-hero jumbotron">
					<h1 class="display-1">Private <span class="clr-bright-blue">Equity</span></h1>

					<?php if (have_posts()): while (have_posts()) : the_post(); ?>

						<!-- article -->
						<p id="post-<?php the_ID(); ?>" class="lead" <?php post_class(); ?>>

							<?php the_content(); ?>

						</p>
						<!-- /article -->

						<?php endwhile; ?>

					<?php endif; ?>

			</section>
        <section class="container-fluid">
            <div class="row str-equity-step-container justify-content-center">
                <div class="col-12 col-md-10">
                    <div class="str-equity-step">
                        <div class="icon-container"><img src="<?php echo get_template_directory_uri() ?>/img/icon-analyse.svg"></div>
                        <div class="text-container">
                            <h3 class="display-3"><span class="heading-number">1.</span> Analyze
                            </h3>
                            <p>For Private Equity investors our early phase <a href='<?php echo get_site_url()?>/services#discovery'>Discovery</a> service provides an in-depth analysis of both the target company and the market, delivered with speed and precision. We report on the viability of an investment, and opportunities for improvement and value creation within the business. Our market analysis includes a level of competitor insight unmatched within the industry, helping us to build ideal client profiles, highlighting areas of risk, and accurately assessing the market opportunity.</p>
                        </div>
                    </div>
                    <div class="str-equity-step">
                        <div class="icon-container"><img src="<?php echo get_template_directory_uri() ?>/img/icon-identify.svg"></div>
                        <div class="text-container">
                            <h3 class="display-3"><span class="heading-number">2.</span> Identify
                            </h3>
                            <p>We identify the potential inhibitors to revenue growth and value creation within the target company and build a blueprint for change to help you tackle them. We focus on the 20% of change that delivers 80% of required business improvements, helping you realize the value of your investment in the shortest time possible.<br class='under-link'><a class='under-link' href='<?php echo get_site_url()?>/services#expertise'>Read more about our areas of focus.</a></p>
                        </div>
                    </div>
                    <div class="str-equity-step">
                        <div class="icon-container"><img src="<?php echo get_template_directory_uri() ?>/img/icon-improve.svg"></div>
                        <div class="text-container">
                            <h3 class="display-3"><span class="heading-number">3.</span> Improve
                            </h3>
                            <p>Having identified areas for improvement, we roll up our sleeves and develop programs and an execution model to give you the RoI your strategy demands. Our value creation plans are focused on short term gains and longer-term business transformations. We combine this with targeted active insights, delivering granular analysis of customers, competitors or prospects right down to key decision makers’ preferences and behaviors. In this way, we commit to arming the teams within your newly acquired asset with the skills, knowledge and insight they need to accelerate sales performance and deliver sustained commercial improvement, making it easier for you to achieve your investment goals.<br class='under-link'><a class='under-link' href='<?php echo get_site_url()?>/success-stories'>Read our success stories.</a></p>
                        </div>
                    </div>
                    <div class="str-equity-step">
                        <div class="icon-container"><img src="<?php echo get_template_directory_uri() ?>/img/icon-exit.svg"></div>
                        <div class="text-container">
                            <h3 class="display-3"><span class="heading-number">4.</span> Exit
                            </h3>
                            <p>When you achieve your investment goals we are on-hand to help you plan and manage an exit strategy.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php

        $trailer_template_path = get_template_directory() . '/inc/str-insights-trailer.php';
        load_template($trailer_template_path, true);
        ?>


	</main>

<?php get_footer(); ?>