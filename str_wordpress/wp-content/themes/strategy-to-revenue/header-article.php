<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/img/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri(); ?>/img/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/img/favicon-16x16.png">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>
		<script>
        // conditionizr.com
        // configure environment tests
        conditionizr.config({
            assets: '<?php echo get_template_directory_uri(); ?>',
            tests: {}
        });

        </script>

	</head>
	<body <?php body_class(); ?>>


    <div class="nav-container" id="mobile-menu">
        <nav>
            <div class="nav-header text-right">
                <button class="hamburger hamburger--spin clr-white" id="mobile-menu-close-button" type="button"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button>
            </div>
	        <?php str_nav('mobile'); ?>
        </nav>
    </div>

    <?php


    if (have_posts()):
        while (have_posts()) : the_post();

        $article_head_img_id  = get_post_meta( $post->ID, "meta_article_header_img", true );
        $article_head_img_src = wp_get_attachment_image_src( $article_head_img_id, 'full' )[0];

        endwhile;
        endif;

    ?>

    <header class="home bg-blue container-fluid p-0">
        <img class="d-none d-md-block w-100" src="<?php echo $article_head_img_src ?>">
        <div class="article-nav-container">
            <div class="row align-items-center justify-content-center">
                <div class="col-8 col-md-2 col-lg-3 p-0 pl-3">
                    <div class="logo-container ml-2 ml-lg-3 pt-3 pt-lg-4 pb-2 pt-lg-4"><a href="/">
                            <img class="logo" src="<?php echo get_template_directory_uri(); ?>/img/logo-strategy-to-revenue.svg"></a></div>
                </div>
                <div class="d-none d-md-block col-md-10 col-lg-9 p-0 pr-2">
                    <nav class="text-right mr-4 mr-xl-5">
	                    <?php str_nav('header'); ?>
                    </nav>
                </div>
                <div class="col-4 d-md-none text-right">
                    <button class="hamburger hamburger--spin clr-white" id="mobile-menu-button" type="button"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button>
                </div>
            </div>
        </div>
        <div class="mobile-img-container position-relative d-md-none">
            <img src="<?php echo $article_head_img_src ?>">
            <img class="h-align gradient" src="img/shadow.png"></div>
    </header>

