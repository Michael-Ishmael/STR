<?php
global $post;

	$result_meta  = get_post_meta( $post->ID, 'meta_success_result' );
	$results = $result_meta[0];
?>


<div id="str-result-list">
	<?php foreach ( $results as $key => $result ) { ?>
		<p>
			<label for="meta_success_result_<?php echo $key; ?>">
				<strong><?php _e('Result') ?>:</strong> <input id="meta_success_result_<?php echo $key; ?>" name="meta_success_result[]"
				                               value="<?php echo $result; ?>"/>
			</label>
<!--			<a href="#" id="remClr">Remove</a>-->
		</p>
	<?php } ?>
</div>
<h4><a href="#" id="addRes">
		<?php _e('Add A Success Story Result Item') ?>
	</a></h4>