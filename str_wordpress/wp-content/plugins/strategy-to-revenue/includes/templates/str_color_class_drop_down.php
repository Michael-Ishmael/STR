<?php

//str_color_class_drop_down
//meta_success_caption_color

global $post;

	$result_meta  = get_post_meta( $post->ID, $field_name, true );
	if($result_meta == null) $result_meta = 'clr-white';
	$results = $result_meta[0];

	$color_options = array(
		'clr-white' => 'White',
		'clr-dark-blue' => 'Dark Blue',
		'clr-bright-blue' => 'Bright Blue',
		'clr-corn-yellow' => 'Yellow'
	)
?>

<select name="<?php echo $field_name ?>" id="<?php echo $field_name ?>">

	<?php
	foreach ($color_options as $key => $value){

		?>

		<option value="<?php echo $key ?>" <?php $result_meta == $key ? "selected=selected" : ""?>>
			<?php echo  $value ?>
		</option>

		<?php

	} //end foreach $color_options

	?>
</select>

<label for="<?php $field_name ?>">The colour of story header on top of the image below.  Pick a colour that stands out.</label>


