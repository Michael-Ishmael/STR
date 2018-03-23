<?php
global $post;

// See if there's a media id already saved as post meta
$include_in_page_value = get_post_meta( $post->ID, 'meta_include_in_page', true );
$include_in_page = ($include_in_page_value == null || $include_in_page_value == 'false' ? false : true);
$item_index = get_post_meta( $post->ID, 'meta_item_index', true );
$item_index = $item_index == null ? 0 : $item_index;


?>


<!-- Your image container, which can be manipulated with js -->
<div class="page-inclusion-container">

        <label for="include_in_page">Include on Page</label>
		<input type="checkbox" id="include_in_page" name="meta_include_in_page" value="true" <?php echo ($include_in_page ? "checked='true'" : "" ); ?>">

        <br><br>
		<label for="item_index">Item order on Page</label>
		<input type="number" min="0" max="50" id="item_index" name="meta_item_index" value="<?php echo esc_attr( $item_index ); ?>">

</div>
