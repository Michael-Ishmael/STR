

<div id="str-result-list">
	<?php foreach ( $field_set as $meta_field ) {

		$meta_field["field_value"]  = get_post_meta( $post->ID, $meta_field["field_name"], true );

	    ?>
		<p>
			<label for="<?php echo $meta_field["field_name"]; ?>">
				<strong><?php echo $meta_field["label"]; ?></strong> <input id="<?php echo $meta_field["field_name"]; ?>" name="<?php echo $meta_field["field_name"]; ?>"
				                               value="<?php echo $meta_field["field_value"]; ?>"/>
			</label>
		</p>
	<?php } ?>
</div>
