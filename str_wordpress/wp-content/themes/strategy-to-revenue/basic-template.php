<?php
/*
Template Name: STR Basic Page
Template Post Type: page
*/

get_header(); ?>


<main role="main" class="str-basic">
    <!-- section -->
    <section class="container-fluid">

		<?php
		while ( have_posts() ) : the_post(); ?>

            <h2 class="display-2"><?php the_title() ?></h2>

            <!-- article -->
            <article>

				<?php
				the_content();
				?>

            </article>
            <!-- /article -->

		<?php
		endwhile; // End of the loop.
		?>

    </section>
    <!-- /section -->
</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
