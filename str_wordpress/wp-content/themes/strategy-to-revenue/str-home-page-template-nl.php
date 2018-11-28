<?php
/*
Template Name: STR Newsletter Example
Template Post Type: page
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
                    <p class="lead">

                        <?php echo $mission_text ?>

                    </p>
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
            <div class="col-12 col-md-5 p-0 o-hidden mission-pic-container">
                <img class="mission-pic" src="<?php echo get_attachment_src_by_slug( "home-mission", 'overlay-image-column-low-res' ) ?>">
            </div>
        </div>
    </section>

    <section class="container-fluid questionnaire bg-blue">
			<div class="row justify-content-center">
				<div class="col-12 text-center">
<!--					<p class="sub text-uppercase">How can we help you</p>-->
					<h2 class="display-2 clr-white">Making the Incredible a Reality</h2>
				</div>
			</div>
			<!--<div class="row horiz-buttons text-center justify-content-center">
				<div class="col-12 col-md-4">
					<div class="questionnaire-button-container"><a class="questionnaire-button bg-blue clr-white">Company with a sales team less than 100</a></div>
				</div>
				<div class="col-12 col-md-4">
					<div class="questionnaire-button-container"><a class="questionnaire-button bg-blue clr-white"> Company with a sales team of 100+</a></div>
				</div>
				<div class="col-12 col-md-4">
					<div class="questionnaire-button-container"><a class="questionnaire-button bg-blue clr-white"> A private equity company</a></div>
				</div>
			</div>-->
		</section>

    <section class="container-fluid">

		<?php

		$home_grid_template_path = get_template_directory() . '/inc/str-home-page-grid.php';
		load_template( $home_grid_template_path, true );

		?>


    </section>
    <section class="container-fluid clients bg-mid-cream">
        <div class="row clients justify-content-center">

            <?php foreach ($client_logo_ids as $logo_id):

                $logo_src = wp_get_attachment_image_src($logo_id, "full")[0];

                ?>


            <div class="col-12 col-sm-4 col-lg-2 client-logo-container text-center">
                <div class="client"><img class="w-sm-50"
                                         src="<?php echo $logo_src ?>">
                </div>
            </div>

            <?php endforeach; ?>

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
                <a href="tel:+13124938639" class="phone">+1 312 493 8639</a>
            </div>
            <div class="d-none col-md-1"></div>
            <div class="col-12 col-sm-7 col-md-3">
                <h4 class="display-4">United Kingdom</h4>
                <p class="address">
                    1 Change Alley
                    <br>
                    London
                    <br>
                    EC3V 3ND
                </p>
                <a href="tel:+441753245543" class="phone">+44 (0) 1753 245543</a>
            </div>
            <div class="d-none col-md-1"></div>
            <div class="col-12 col-sm-7 col-md-3">
                <h4 class="display-4">New Business</h4>
                <p class="email"><a href="mailto:hello@strategytorevenue.com">hello@strategytorevenue.com</a></p>
                <h4 class="display-4">Support</h4>
                <p class="email"><a href="mailto:support@strategytorevenue.com">support@strategytorevenue.com</a></p>
            </div>
        </div>
    </section>
    <section class="container-fluid newsletter bg-mid-cream" id="newsletter">
        <div class="row">
            <div class="col-12 newsletter-content justify-content-center">

                <div class="flipee front text-center">
                    <h6 class="sub text-uppercase">Stay up to date</h6>
                    <h3 class="display-3">Newsletter</h3>
                    <p >
                        Stay up to date with the latest insights and tips on sales strategy and business transformation.

                    </p>

                    <div class="su-btn-container text-center ">
                        <button id="newsletter-trigger"
                                class="btn btn-primary text-uppercase">
                            Sign Up
                        </button>
                    </div>


                </div>
                <div class="flipee back w-100 d-none">

                    <!-- Begin MailChimp Signup Form -->

                    <div id="mc_embed_signup">
                        <form action="https://strategytorevenue.us16.list-manage.com/subscribe/post?u=f7b08109a155ad6a4e8da083d&amp;id=5dc83226a8"
                              method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate newsletter form-inline" target="_blank" novalidate>
                            <div id="mc_embed_signup_scroll" style="width: 100%;">
                                <div class="gdpr-content" id="nl-rev-trigger">
                                    <h3>Newsletter</h3>
                                    <p>
                                        The Strategy to Revenue newsletter provides you with free resources and new insights to improve
                                        your sales strategy.
                                    </p>
                                    <p>
                                        You will get notice of our latest events and offers before anyone else.  We'll only send the newsletter out
                                        once a month and you can unsubscribe to it at any time.
                                    </p>
                                    <p>
                                        See our <a href="/privacy-notice">privacy notice</a> for more information on how we take care of your information.
                                    </p>
                                </div>

                                <div class="w-100">
                                    <div class="mc-field-group input-container">
                                        <label class="sr-only">email</label>
                                        <input type="email" value="" name="EMAIL" class="form-control w-100 required email" id="mce-EMAIL" placeholder="Enter your email address">
                                    </div>

                                    <div class="btn-container">
                                        <input id="mc-embedded-subscribe" name="subscribe" class="btn btn-primary w-100 text-uppercase" type="submit"
                                               value="Subscribe to this list">
                                    </div>
                                </div>
                                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_f7b08109a155ad6a4e8da083d_5dc83226a8" tabindex="-1" value=""></div>


                            </div>
                            <div id="mce-responses" class="clear">
                                <div class="response" id="mce-error-response" style="display:none"></div>
                                <div class="response" id="mce-success-response" style="display:none"></div>
                            </div>
                        </form>
                    </div>
                    <script type="text/javascript">
                        jQuery(document).ready(function($) {
                            $('#mc-embedded-subscribe-form').submit(function (e) {
                                e.preventDefault();
                                $.ajax({
                                    url: 'https://strategytorevenue.us16.list-manage.com/subscribe/post-json?u=f7b08109a155ad6a4e8da083d&amp;id=5dc83226a8&c=?',
                                    type: 'GET',
                                    data: $('#mc-embedded-subscribe-form').serialize(),
                                    dataType: 'jsonp',
                                    contentType: "application/json; charset=utf-8",
                                    success: function (resp) {

                                        $('#mce-success-response').hide();
                                        $('#mce-error-response').hide();

                                        if (resp['result'] === "success") {
                                            $('#mce-'+resp.result+'-response').show();
                                            $('#mce-'+resp.result+'-response').html(resp.msg);
                                            $('#mc-embedded-subscribe-form').each(function(){
                                                this.reset();
                                            });

                                        } else {
                                            if (resp.msg === "captcha") {
                                                var url = $("form#mc-embedded-subscribe-form").attr("action");
                                                var parameters = $.param(resp.params);
                                                url = url.split("?")[0];
                                                url += "?";
                                                url += parameters;
                                                window.open(url);
                                            };
                                            // Example errors - Note: You only get one back at a time even if you submit several that are bad.
                                            // Error structure - number indicates the index of the merge field that was invalid, then details
                                            // Object {result: "error", msg: "6 - Please enter the date"}
                                            // Object {result: "error", msg: "4 - Please enter a value"}
                                            // Object {result: "error", msg: "9 - Please enter a complete address"}

                                            // Try to parse the error into a field index and a message.
                                            // On failure, just put the dump thing into in the msg variable.
                                            var index = -1;
                                            var msg;
                                            try {
                                                var parts = resp.msg.split(' - ',2);
                                                if (parts[1]==undefined){
                                                    msg = resp.msg;
                                                } else {
                                                    i = parseInt(parts[0]);
                                                    if (i.toString() == parts[0]){
                                                        index = parts[0];
                                                        msg = parts[1];
                                                    } else {
                                                        index = -1;
                                                        msg = resp.msg;
                                                    }
                                                }
                                            } catch(e){
                                                index = -1;
                                                msg = resp.msg;
                                            }

                                            try {
                                                // If index is -1 if means we don't have data on specifically which field was invalid.
                                                // Just lump the error message into the generic response div.
                                                if (index == -1){
                                                    $('#mce-'+resp.result+'-response').show();
                                                    $('#mce-'+resp.result+'-response').html(msg);

                                                } else {
                                                    var fieldName = $("input[name*='"+fnames[index]+"']").attr('name'); // Make sure this exists (they haven't deleted the fnames array lookup)
                                                    var data = {};
                                                    data[fieldName] = msg;
                                                    mc.mce_validator.showErrors(data);
                                                }
                                            } catch(e){
                                                $('#mce-'+resp.result+'-response').show();
                                                $('#mce-'+resp.result+'-response').html(msg);
                                            }
                                        }
                                    }
                                });
                            });
                        });
                    </script>

                    <!--End mc_embed_signup-->


                </div>

            </div>

        </div>

    </section>
    <div class="overlay-background" id="overlayBg" aria-hidden="true">

        <div class="container-fluid position-relative h-100 p-0">

			<?php

			$services_overlay_template_path = get_template_directory() . '/inc/str-service-overlays.php';
			load_template( $services_overlay_template_path, true );

			$success_overlay_template_path = get_template_directory() . '/inc/str-success-story-overlays.php';
			load_template( $success_overlay_template_path, true );

			/*		    $team_overlay_template_path = get_template_directory() . '/inc/str-team-member-overlays.php';
						load_template($team_overlay_template_path, true);*/

			?>

        </div>

    </div>
    </main>

<?php
get_footer();
?>