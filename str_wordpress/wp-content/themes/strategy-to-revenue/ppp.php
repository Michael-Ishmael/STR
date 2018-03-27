<?php
/*
Template Name: Success Stories Page
Template Post Type: page, str_success_story
*/

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

get_header();


// check if we got posts to display:
if ( have_posts() ) :

    while ( have_posts() ) : the_post();
        ?>


        <h1 class="success-story">

	        <?php the_title(); ?>

        </h1>




    <?php
    //$post_loop_count ++;
    endwhile;
else:
    ?>

    <div>Some Text </div>

<?php



endif;

get_footer();
?>


