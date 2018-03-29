<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

    <link href="//www.google-analytics.com" rel="dns-prefetch">
<!--    <link href="--><?php //echo get_template_directory_uri(); ?><!--/img/icons/favicon.ico" rel="shortcut icon">-->
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri(); ?>/img/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/img/favicon-16x16.png">
    <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">

	<?php wp_head(); ?>
    <!-- Start of 66bytes Zendesk Widget script-->
    <script>
        /*<![CDATA[*/window.zEmbed||function(e,t){var n,o,d,i,s,a=[],r=document.createElement("iframe");window.zEmbed=function(){a.push(arguments)},window.zE=window.zE||window.zEmbed,r.src="javascript:false",r.title="",r.role="presentation",(r.frameElement||r).style.cssText="display: none",d=document.getElementsByTagName("script"),d=d[d.length-1],d.parentNode.insertBefore(r,d),i=r.contentWindow,s=i.document;try{o=s}catch(e){n=document.domain,r.src='javascript:var d=document.open();d.domain="'+n+'";void(0);',o=s}o.open()._l=function(){var e=this.createElement("script");n&&(this.domain=n),e.id="js-iframe-async",e.src="https://assets.zendesk.com/embeddable_framework/main.js",this.t=+new Date,this.zendeskHost="66bytes.zendesk.com",this.zEQueue=a,this.body.appendChild(e)},o.write('<body onload="document._l();">'),o.close()}();
        /*]]>*/
    </script>
    <!-- End of 66bytes Zendesk Widget script-->
</head>
<body <?php body_class() ?>>
<div class="nav-container" id="mobile-menu">
    <nav>
        <div class="nav-header text-right">
            <button class="hamburger hamburger--spin clr-white" id="mobile-menu-close-button" type="button"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button>
        </div>
		<?php str_nav('mobile'); ?>
    </nav>
</div>

<!-- WP Generated Styles -->
<style>
    .home-hero-bg{

        background-image: url(<?php echo get_attachment_src_by_slug('hero-kv') ?>);
    }

    @media (max-width: 767.98px){
        .home-hero-bg {
            background-image: url(<?php echo get_attachment_src_by_slug('hero-kv-sml') ?>);
        }
    }


</style>
<header class="home container-fluid bg-blue home-hero-bg">
    <div class="row align-items-center justify-content-center">
        <div class="col-8 col-md-2 col-lg-3 p-0 pl-3">
            <div class="logo-container ml-2 ml-lg-3 pt-3 pt-lg-4 pb-2 pt-lg-4"><a href="/"><img class="logo" src="<?php echo get_template_directory_uri() ?>/img/logo-strategy-to-revenue.svg"></a></div>
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
    <div class="row str-home-hero">
        <div class="col-12 p-0">
            <h1 class="display-hero clr-white">Potential<br><span class="clr-bright-blue">Unleashed</span></h1>
            <p class="lead clr-white">
                Performing to your full potential feels incredible. Strategy to Revenue is dedicated to making the incredible a reality.


            </p>
        </div>
    </div>
</header>

