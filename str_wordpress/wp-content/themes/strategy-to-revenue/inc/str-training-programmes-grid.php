<?php

$args = array(
	'post_type'  => 'str_training_progs',
	'meta_key'   => 'meta_item_index',
	'orderby'    => array( 'meta_value_num' => 'ASC', 'date' => 'DESC' ),
	'meta_query' => array(
		'relation' => 'AND',
		array(
			'key'     => 'meta_include_in_page',
			'value'   => 'true',
			'compare' => '==',
		)
	)
);
$aps_grid_text = get_post_meta( $post->ID, "meta_core_training_text", true );
$loop_query = new WP_Query( $args );


if ( $loop_query->have_posts() ) : ?>

    <div class="row text-center wide-picture-grid bg-light-cream">

        <div class="col-12 col-md-6 str-grid-pic">
            <div class="success-image-tile training-grid-text">
                <div class="intro">
                    <div class="aps-logo-container">
                        <div class="aps-logo"></div>
                    </div>

	                <?php echo $aps_grid_text ?>

                </div>
            </div>
        </div>


		<?php

		while ( $loop_query->have_posts() ) : $loop_query->the_post();


			?>


            <div class="col-12 col-md-6 str-grid-pic">
                <div class="success-image-tile overlay-link" data-overlay="<?php echo $post->post_name ?>">
					<?php

					$item_tile_img_id  = get_post_meta( $post->ID, "meta_training_tile_img", true );
					$item_tile_img_src = wp_get_attachment_image_src( $item_tile_img_id, 'picture-grid-tile-low-res' );

					$caption_colour_class = get_post_meta( $post->ID, "meta_caption_color", true );
					if ( $caption_colour_class == null ) {
						$caption_colour_class = "clr-white";
					}

					?>
                    <img class="h-align pic" src="<?php echo $item_tile_img_src[0]; ?>">
                    <img class="h-align gradient" src="<?php echo get_template_directory_uri(); ?>/img/shadow.png">
                    <div class="photo-caption text-left">
                        <h3 class="display-3 <?php echo $caption_colour_class ?>"><?php echo get_the_title(); ?></h3>
                        <h5 class="display-5 <?php echo $caption_colour_class ?>">
                            <a class="overlay-link" href="/<?php echo $post->post_name ?>">see program</a></h5>
                    </div>
                </div>
            </div>

		<?php endwhile; ?>

        <div class="col-12 col-md-6 str-grid-pic">
            <div class="success-image-tile training-grid-text">
                <div class="justify-content-center">

                    <div class="flipee back w-100">

                        <!-- Begin MailChimp Signup Form -->

                        <div id="mc_embed_signup">
                            <form action="https://strategytorevenue.us16.list-manage.com/subscribe/post?u=f7b08109a155ad6a4e8da083d&amp;id=5dc83226a8"
                                  method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form"
                                  class="validate newsletter form-inline" target="_blank" novalidate>
                                <div id="mc_embed_signup_scroll" style="width: 100%;">
                                    <div class="gdpr-content" id="nl-rev-trigger">
                                        <h4>Newsletter</h4>
                                        <p>
                                            The Strategy to Revenue newsletter gives you a free resource direct to your
                                            inbox on some of the best practices and
                                            insights in sales enablement from us and across the industry.
                                        </p>
                                        <p>
                                            We’ll email you about once a month and you can unsubscribe at any time.
                                        </p>
                                        <p>
                                            See our <a href="/privacy-notice">privacy notice</a> for more information on
                                            how we take care of your information.
                                        </p>
                                        <p class="mini">
                                            Sales improvement tips from across the industry
                                        </p>
                                    </div>

                                    <div class="newsletter-inputs">
                                        <div class="mc-field-group input-container">
                                            <label class="sr-only">email</label>
                                            <input type="email" value="" name="EMAIL"
                                                   class="form-control w-100 required email" id="mce-EMAIL"
                                                   placeholder="Enter your email address">
                                        </div>

                                        <div class="btn-container">
                                            <input id="mc-embedded-subscribe" name="subscribe"
                                                   class="btn btn-primary w-100 text-uppercase" type="submit"
                                                   value="Subscribe">
                                        </div>

                                        <div class="btn-container-mini">
                                            <input id="mc-embedded-subscribe" name="subscribe"
                                                   class="btn btn-primary w-100 text-uppercase" type="submit"
                                                   value="Sign Up">
                                        </div>
                                    </div>
                                    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input
                                                type="text" name="b_f7b08109a155ad6a4e8da083d_5dc83226a8" tabindex="-1"
                                                value=""></div>


                                </div>
                                <div id="mce-responses" class="clear">
                                    <div class="response" id="mce-error-response" style="display:none"></div>
                                    <div class="response" id="mce-success-response" style="display:none"></div>
                                </div>
                            </form>
                        </div>
                        <script type="text/javascript">
                            jQuery(document).ready(function ($) {
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
                                                $('#mce-' + resp.result + '-response').show();
                                                $('#mce-' + resp.result + '-response').html(resp.msg);
                                                $('#mc-embedded-subscribe-form').each(function () {
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
                                                }
                                                ;
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
                                                    var parts = resp.msg.split(' - ', 2);
                                                    if (parts[1] == undefined) {
                                                        msg = resp.msg;
                                                    } else {
                                                        i = parseInt(parts[0]);
                                                        if (i.toString() == parts[0]) {
                                                            index = parts[0];
                                                            msg = parts[1];
                                                        } else {
                                                            index = -1;
                                                            msg = resp.msg;
                                                        }
                                                    }
                                                } catch (e) {
                                                    index = -1;
                                                    msg = resp.msg;
                                                }

                                                try {
                                                    // If index is -1 if means we don't have data on specifically which field was invalid.
                                                    // Just lump the error message into the generic response div.
                                                    if (index == -1) {
                                                        $('#mce-' + resp.result + '-response').show();
                                                        $('#mce-' + resp.result + '-response').html(msg);

                                                    } else {
                                                        var fieldName = $("input[name*='" + fnames[index] + "']").attr('name'); // Make sure this exists (they haven't deleted the fnames array lookup)
                                                        var data = {};
                                                        data[fieldName] = msg;
                                                        mc.mce_validator.showErrors(data);
                                                    }
                                                } catch (e) {
                                                    $('#mce-' + resp.result + '-response').show();
                                                    $('#mce-' + resp.result + '-response').html(msg);
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
        </div>

    </div>


<?php

endif;

wp_reset_postdata();


?>
