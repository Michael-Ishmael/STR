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

require_once 'includes/classes/class-STR-Custom-Page.php';

define( 'STR_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'STR_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

function str_init() {

    $success_story_page = new STR_Success_Story_Page('str_success_story', 'STR Success Stories', 'STR Success Story', 'success-story');
    $success_story_page->init();

}

add_action( 'init', 'str_init' );

