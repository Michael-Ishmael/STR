<?php
global $post;

wp_nonce_field( $nonce_id, $nonce_id );
$meta_field_text = get_post_meta($post->ID, $field_name, true);

?>

<p>
	<label class="mtlabel" for="<?= $field_name ?>">Add text for the challenge section of the success story here</label>
	<!-- Create / Call The TinyMCE Editor -->
	<?php wp_editor( $meta_field_text, $field_name, array(
		'wpautop'       => true,
		'media_buttons' => true,
		'textarea_name' => $field_name,
		'textarea_rows' => 10,
		'teeny'         => true
	) ); ?>
</p>