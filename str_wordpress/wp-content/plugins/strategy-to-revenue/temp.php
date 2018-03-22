<?php
/*
Plugin Name: Strategy To Revenue
Plugin URI:
Description: Plug-in to manage custom STR content
Version: 1.0
Author: Michael Ishmael
Author URI: http://66Bytes.com
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function str_init() {

	str_custom_post_type();
}


function str_custom_post_type() {
	register_taxonomy_for_object_type( 'post_tag', 'page' );

	register_post_type( 'str_success_story',
		[
			'labels'                => [
				'name'          => __( 'STR Success Stories' ),
				'singular_name' => __( 'STR Success Story' ),
			],
			'show_ui'               => true,
			'show_in_menu'          => true,
			'supports'              => [ 'title', 'editor', 'author' ],
			'taxonomies'            => [],
			'capability_type'       => 'post',
			'hierarchical'          => true,
			'rewrite'               => array( 'slug' => 'success-story' ),
			'show_in_rest'          => true,
			'rest_base'             => 'str-stories-api',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		]
	);

	/*	register_post_type('aif_page_copy',
			[
				'labels'      => [
					'name'          => __('AIF Framework Pages'),
					'singular_name' => __('AIF Framework Page'),
				],
				'show_ui' => true,
				'show_in_menu'      => true,
				'public' => true,
				'supports' => ['title', 'page-attributes'], //, 'editor', 'author', 'excerpt'],
				'capability_type'    => 'page',
				'hierarchical' => true,
				'rewrite' => array('slug' => 'framework'),
				'show_in_rest'       => true,
				'rest_base'          => 'aif-pages-api',
				'rest_controller_class' => 'WP_REST_Posts_Controller',
			]
		);*/
}

add_action( 'init', 'str_init' );

function str_meta_box_init() {


	add_meta_box(
		'str_story_challenge_meta',
		"Challenge",
		'str_story_challenge_metabox',
		'str_success_story',
		'before',
		'high' );

	add_meta_box(
		'str_story_result_meta',
		"Results",
		'str_results_metabox',
		'str_success_story',
		'normal',
		'high' );

	add_meta_box(
		'str-story-tile-img-lr',
		'Success Story Tile Image (Low Res)',
		'str_image_metabox',
		'str_success_story',
		'normal',
		'high' );

}

add_action( 'add_meta_boxes', 'str_meta_box_init' );


function str_image_metabox( $post, $box) {

	try{
		$str_template_path = plugin_dir_path(__FILE__). 'includes/str_image_box.php';

		include( $str_template_path );

	} catch (\Exception $e){

		echo '<div id="str_image_widget"><p>There has been an error generating image widget</p><p>'. $e->getMessage() .'</p></div>';

	}
}

function str_results_metabox( $post, $box) {

	try{
		$str_template_path = plugin_dir_path(__FILE__). 'includes/str_results_box.php';

		include( $str_template_path );

	} catch (\Exception $e){

		echo '<div id="str_image_widget"><p>There has been an error generating image widget</p><p>'. $e->getMessage() .'</p></div>';

	}
}


function str_enqueue_scripts(){

	wp_enqueue_style( 'str_admin_css', plugin_dir_url(__FILE__) . '/css/str_admin.css', false, '1.0.0' );
//   wp_enqueue_script( 'tiny_mce_wp', includes_url('/js/tinymce/plugins/wpview/plugin.js'));
//   wp_enqueue_script( 'tiny_mce_code', get_stylesheet_directory_uri() . '/js/libs/tinymce/plugins/code/plugin.min.js');
	wp_enqueue_media();
	wp_enqueue_script( 'str_admin_js', plugin_dir_url(__FILE__). '/js/str_admin.js', false, '1.0.0' );

}


add_action( 'admin_enqueue_scripts', 'str_enqueue_scripts' );


function str_story_challenge_metabox( $post, $box ) {

	try {
		wp_nonce_field( 'str_story_nonce_c', 'str_story_nonce' );
		$meta_challenge_text = get_post_meta($post->ID, 'meta_challenge', true);

		?>
		<p>
			<label class="mtlabel" for="att_meta_bio">Add text for the challenge section of the success story here</label>
			<!-- Create / Call The TinyMCE Editor -->
			<?php wp_editor( $meta_challenge_text, 'meta_challenge', array(
				'wpautop'       => true,
				'media_buttons' => true,
				'textarea_name' => 'meta_challenge',
				'textarea_rows' => 10,
				'teeny'         => true
			) ); ?>
		</p>

		<?php

		//$aif_template_path = plugin_dir_path( __FILE__ ) . 'includes/aif-admin-edit.php';

		//include( $aif_template_path );

	} catch ( \Exception $e ) {

		echo '<div id="aif_translation_widget"><p>There has been an error generating editor</p><p>' . $e->getMessage() . '</p></div>';

	}

}

function move_before_meta() {
	# Get the globals:
	global $post, $wp_meta_boxes;

	# Output the "advanced" meta boxes:
	do_meta_boxes( get_current_screen(), 'before', $post );

	# Remove the initial "advanced" meta boxes:
	unset( $wp_meta_boxes['post']['before'] );
}

add_action( 'edit_form_after_title', 'move_before_meta' );


add_action( 'save_post', 'str_story_challenge_save' );

function str_story_challenge_save( $post_id )
{

	if(get_post_type($post_id) !== 'str_success_story') return;


	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['str_story_nonce'] ) || !wp_verify_nonce( $_POST['str_story_nonce'], 'str_story_nonce_c' ) ) return;

	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post', $post_id ) ) return;

	// now we can actually save the data
	/*	$allowed = array(
			'a' => array( // on allow a tags
				'href' => array() // and those anchors can only have href attribute
			)
		);*/



	// Challenge Content Check
	if(isset($_POST['meta_challenge']) && $_POST['meta_challenge'] != '')
		update_post_meta($post_id, 'meta_challenge', $_POST['meta_challenge']);
	else

		delete_post_meta($post_id, 'meta_challenge');

	if(isset($_POST['meta_success_result']) && $_POST['meta_success_result'] != '')
		update_post_meta($post_id, 'meta_success_result', $_POST['meta_success_result']);
	else
		delete_post_meta($post_id, 'meta_success_result');


	/*	// Probably a good idea to make sure your data is set
		if( isset( $_POST['att_meta_title'] ) )
			update_post_meta( $post_id, 'att_meta_title', wp_kses( $_POST['att_meta_title'], $allowed ) );

		if( isset( $_POST['att_meta_phone'] ) )
			update_post_meta( $post_id, 'att_meta_phone', wp_kses( $_POST['att_meta_phone'], $allowed ) );

		if( isset( $_POST['att_meta_email'] ) )
			update_post_meta( $post_id, 'att_meta_email', wp_kses( $_POST['att_meta_email'], $allowed ) );
		if( isset( $_POST['att_meta_bio'] ) )
			update_post_meta( $post_id, 'att_meta_bio', wp_kses( $_POST['att_meta_bio'], $allowed ) );
		if( isset( $_POST['att_meta_edu'] ) )
			update_post_meta( $post_id, 'att_meta_edu', wp_kses( $_POST['att_meta_edu'], $allowed ) );*/
}


