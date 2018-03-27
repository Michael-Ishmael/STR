<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
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


    <header class="container-fluid bg-blue" role="banner">
        <div class="row align-items-center justify-content-center">
            <div class="col-8 col-md-2 col-lg-3 p-0 pl-3">
                <div class="logo-container ml-2 ml-lg-3 pt-3 pt-lg-4 pb-3 pt-lg-4"><a href="/">
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
        <div class="row">
            <div class="block-bottom-border col-12"></div>
        </div>
    </header>

