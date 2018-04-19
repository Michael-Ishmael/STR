<?php
global $post;

// Get WordPress' media upload URL
$upload_link = esc_url( get_upload_iframe_src( 'image', $post->ID ) );

// See if there's a media id already saved as post meta
$img_ids = get_post_meta( $post->ID, $str_custom_image_key, true );
if(isset($multi_index)){
	$your_img_id = $img_ids[$multi_index];
} else {
    $your_img_id = $img_ids;
}

// Get the image src
$your_img_src = wp_get_attachment_image_src( $your_img_id, 'full' );

// For convenience, see if the array is valid
$you_have_img = is_array( $your_img_src );

$field_name = isset($multi_index) ? $str_custom_image_key . "[]" : $str_custom_image_key;
?>


<!-- Your image container, which can be manipulated with js -->
<div class="custom-img-container">
	<?php if ( $you_have_img ) : ?>
        <img src="<?php echo $your_img_src[0] ?>" alt="" style="max-width:50%;"/>
	<?php endif; ?>
</div>

<!-- Your add & remove image links -->
<p class="hide-if-no-js">
<h4><a class="upload-custom-img <?php if ( $you_have_img ) {
		echo 'hidden';
	} ?>"
       href="<?php echo $upload_link ?>">
		<?php

        if(isset($multi_index) ){
	        _e( 'Choose Image '. ($multi_index + 1) );
        } else {
	        _e( 'Choose Image' );
        }


        ?>
    </a></h4>
<p>
	<?php  _e($str_instruction) ?>
</p>
<h4>
    <a class="delete-custom-img <?php if ( ! $you_have_img ) {
		echo 'hidden';
	} ?>"
       href="#">
		<?php

		if(isset($multi_index) ){
			_e( 'Remove Image '. ($multi_index + 1) );
		} else {
			_e( 'Remove this image' );
		}

        ?>
    </a>
</h4>
</p>

<!-- A hidden input to set and post the chosen image id -->
<input class="custom-img-id" name="<?php echo esc_attr($field_name); ?>" type="hidden" value="<?php echo esc_attr( $your_img_id ); ?>"/>