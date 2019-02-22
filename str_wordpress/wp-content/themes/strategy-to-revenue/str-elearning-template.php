<?php
/*
Template Name: e-Learning Skills Library
Template Post Type: page
*/

get_header();

$page = get_page_by_path( "str_elearning_skills_library" );
if ( isset( $page ) ) {
	$pdf_link = $page->guid;
} else {
	$pdf_link = "/404";
}


?>

<main role="main">

    <section class="container-fluid bg-blue">
        <div class="str-hero jumbotron">
            <h1 class="display-1">eLearning Skills<span class="clr-bright-blue"> Library</span></h1>

    </section>
    <section class="container-fluid">
        <div class="e-learning-container">

            <div class="row">
                <div class="col-12 col-sm-5">
	                <?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>

                        <!-- article -->
                        <!--                    <p id="post---><?php //the_ID(); ?><!--" class="lead" --><?php //post_class(); ?><!-->

		                <?php the_content(); ?>

                        <!--                    </p>-->
                        <!-- /article -->

	                <?php endwhile; ?>

	                <?php endif; ?>


                </div>
                <div class="col-12 col-sm-7">

                    <div style="margin-top: 9rem">

                        <img class="e-learning-img"
                             src="<?php echo get_attachment_src_by_slug( "e-learning-brochure" ) ?>"/>

                    </div>
                    <div class="text-center mt-5">
                        <a class="btn btn-primary btn-lg" href="<?php echo $pdf_link ?>" target="_blank">
                            Download the Catalog
                        </a>
                    </div>


                </div>

            </div>

        </div>


    </section>

    <section class="container-fluid commercial-contact-us bg-blue">
        <div class="py-4 px-5 text-center">
            <div>
                <p class="lead">
                    To decide which of program options best fits your needs
                </p>
                <a class="btn btn-secondary btn-lg commercial-contact-us-btn" href="/#contact-us">Get In Touch</a>
            </div>
        </div>
    </section>


	<?php

	$newsletter_template_path = get_template_directory() . '/inc/str-newsletter.php';
	load_template( $newsletter_template_path, true );


	?>


</main>

<?php get_footer(); ?>

