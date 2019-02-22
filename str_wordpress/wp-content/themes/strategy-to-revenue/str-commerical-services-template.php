<?php
/*
Template Name: Commercial Services Page
Template Post Type: page
*/

get_header();

$services_text    = get_post_meta( $post->ID, "meta_services_text", true );
$consultants_text = get_post_meta( $post->ID, "meta_consultants_text", true );

$link_keys = array("core-training-programs", "tailored-programs", "elearning-training-modules" );

$link_map = array();

foreach ( $link_keys as $link_key ) {
	$page = get_page_by_path($link_key);
	if(isset($page)){
	    $link_map[$link_key] = get_permalink($page);
    } else {
		$link_map[$link_key] = "404";
    }
}

//get_page_by_path( "core-training-program" )

?>

    <main role="main">

        <section class="container-fluid bg-blue">
            <div class="str-hero jumbotron">
                <h2 class="display-1">Sales & Sales Leadership<br><span class="clr-bright-blue">Training</span></h2>

				<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>

                    <!-- article -->
<!--                    <p id="post---><?php //the_ID(); ?><!--" class="lead" --><?php //post_class(); ?><!-->

						<?php the_content(); ?>

<!--                    </p>-->
                    <!-- /article -->

				<?php endwhile; ?>

				<?php endif; ?>

        </section>

        <!-- theme generated styles -->
        <style>

                .commercial-services-coaching-bg { background-image: url(<?php echo get_attachment_src_by_slug( "coaching-thumb" ) ?>); }
                .commercial-services-bespoke-bg { background-image: url(<?php echo get_attachment_src_by_slug( "bespoke-thumb" ) ?>); }
                .commercial-services-elearning-bg { background-image: url(<?php echo get_attachment_src_by_slug( "elearning-thumb" ) ?>); }

        </style>

        <section class="container-fluid services bg-mid-cream">
            <div class="row str-main">
                <div class="col-12 heading text-center">
                    <h2 class="display-2 clr-dark-blue">Services</h2>
                </div>
                <div class="col-12 v-spacer"></div>
                <div class="col-12 clr-dark-blue">
                    <div class="text-center">
                        <p>Explore which sales skills development options works best for you
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="container-fluid bg-blue">


                    <div class="row training-boxes">

                        <div class="col-12 col-md-4">
                            <a class="training-box-link commercial-services-coaching-bg" href="<?php echo
                            $link_map["core-training-programs"] ?>">
                                <div class="btn btn-primary btn-sm view-btn">View</div>

                            </a>
                            <a class="label" href="<?php echo $link_map["core-training-programs"] ?>">Core Training Programs</a>
                        </div>

                        <div class="col-12 col-md-4 ">
                            <a class="training-box-link commercial-services-bespoke-bg" href="<?php echo
                            $link_map["tailored-programs"]?>">
                                <div class="btn btn-primary btn-sm view-btn">View</div>

                            </a>
                            <a class="label" href="<?php echo $link_map["tailored-programs"] ?>">Tailored Training Programs</a>
                        </div>

                        <div class="col-12 col-md-4 ">
                            <a class="training-box-link commercial-services-elearning-bg" href="<?php echo
                            $link_map["elearning-training-modules"]?>">
                                <div class="btn btn-primary btn-sm view-btn">View</div>

                            </a>
                            <a class="label" href="<?php echo $link_map["elearning-training-modules"] ?>">eLearning Training Modules</a>
                        </div>


                    </div>

        </section>

		<?php


		$commercial_contact_template_path = get_template_directory() . '/inc/str-commercial-contact-us.php';
		load_template( $commercial_contact_template_path, true );

		?>


        <div class="d-none d-md-block">
            <section class="container-fluid box-link p-0 o-hidden">
                <div class="up-next services">
                    <div class="str-pic-hero bg-bright-blue text-center w-100 d-table center-div">
                        <div class="d-table-cell align-middle">
                            <h5 class="display-5 text-uppercase clr-white">Coming Up Next</h5>
                            <h2 class="display-2 clr-white">Core <span class="clr-dark-blue">Programs</span></h2>
                            <a
                                    class="btn btn-secondary btn-lg" href="<?php echo $link_map["core-training-programs"] ?>">Show Programs</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>



        <?php

		$newsletter_template_path = get_template_directory() . '/inc/str-newsletter.php';
		load_template( $newsletter_template_path, true );

		?>
    </main>

<?php get_footer(); ?>