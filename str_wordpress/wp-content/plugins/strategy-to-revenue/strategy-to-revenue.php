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

require_once 'includes/classes/class-STR-CustomPostType-Page.php';

define( 'STR_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'STR_PLUGIN_URL', plugin_dir_url( __FILE__ ) );



function str_init() {

	global $post;

	$post_meta_setup = new STR_General_Post_Meta();
	$post_meta_setup->init();

	$post_meta_setup = new STR_Home_Page_Meta();
	$post_meta_setup->init();

	$post_meta_setup = new STR_Service_Page_Meta();
	$post_meta_setup->init();

	$success_story_page = new STR_Success_Story_PagePostType('str_success_story', 'STR Success Stories', 'STR Success Story', 'success-stories');
	$success_story_page->init();

	$expertise_page = new STR_Expertise_PagePostType( 'str_expertise_area', 'STR Areas of Expertise', 'STR Areas of Expertise', 'expertise' );
	$expertise_page->init();

	$services_page = new STR_Services_PagePostType( 'str_service', 'STR Services', 'STR Service', 'services' );
	$services_page->init();

	$team_members_page = new STR_Team_Member_PagePostType( 'str_team_member', 'STR Team Members', 'STR Team Member', 'team-members' );
	$team_members_page->init();


}

add_action( 'init', 'str_init' );


function get_attachment_src_by_slug( $slug , $size = 'full') {
	$args = array(
		'post_type' => 'attachment',
		'name' => sanitize_title($slug),
		'post_status' => 'inherit',
	);
	$_header = get_posts( $args );
	$header = $_header ? array_pop($_header) : null;
	return $header ? wp_get_attachment_image_src($header->ID, $size)[0] : '';
}

function mytheme_tinymce_settings( $tinymce_init_settings ) {
	$tinymce_init_settings['forced_root_block'] = false;
	return $tinymce_init_settings;
}
add_filter( 'tiny_mce_before_init', 'mytheme_tinymce_settings' );


add_filter( 'the_posts', function( $posts, \WP_Query $query )
{
	if( $pick = $query->get( '_shuffle_and_pick' ) )
	{
		shuffle( $posts );
		$posts = array_slice( $posts, 0, (int) $pick );
	}
	return $posts;
}, 10, 2 );