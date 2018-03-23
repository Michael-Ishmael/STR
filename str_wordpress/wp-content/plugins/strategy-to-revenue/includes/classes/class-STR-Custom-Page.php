<?php
/**
 * Created by PhpStorm.
 * User: scorpio
 * Date: 22/03/2018
 * Time: 14:29
 */

abstract class STR_Custom_Admin_Page {

	protected $post_type;
	protected $post_type_name;
	protected $post_type_singular_name;
	protected $slug;
	protected $image_boxes = [];

	public function __construct($post_type, $post_type_name, $post_type_singular_name = null, $slug = null) {
		if($post_type_singular_name === NULL) $post_type_singular_name = $post_type_name;
		if($slug === NULL) $slug = strtolower(str_replace('_', '-', $post_type));

		$this->post_type = $post_type;
		$this->post_type_name = $post_type_name;
		$this->post_type_singular_name = $post_type_singular_name;
		$this->slug = $slug;

	}

	public function init(){
		$this->add_image_sizes();
		$this->register_post_type();
		$this->add_actions();
	}

	protected function add_actions(){
		add_action( 'admin_enqueue_scripts', array($this, 'enqueue_scripts' ));
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'edit_form_after_title', array( $this, 'move_before_meta' ));
		add_action( 'save_post', array($this, 'save_post') );

		add_filter( 'image_size_names_choose', array( $this, 'set_custom_size_options') );
	}

	protected function register_post_type(){

		register_post_type( $this->post_type,
			[
				'labels'                => [
					'name'          => __( $this->post_type_name ),
					'singular_name' => __( $this->post_type_singular_name ),
				],
				'show_ui'               => true,
				'show_in_menu'          => true,
				'supports'              => [ 'title', 'editor', 'author' ],
				'taxonomies'            => [],
				'capability_type'       => 'post',
				'hierarchical'          => true,
				'rewrite'               => array( 'slug' => $this->slug )
			]
		);
	}

	protected function add_image_sizes(){
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'picture-grid-tile-low-res', 720, 470 );
		add_image_size( 'overlay-image-column-low-res', 720, 1024 );

		add_image_size( 'picture-grid-tile-hi-res', 1440, 940 );
		add_image_size( 'overlay-image-column-hi-res', 1440, 1920 );
	}

	abstract  function add_meta_boxes();
	abstract  function save_post( $post_id );


	function move_before_meta() {
		# Get the globals:
		global $post, $wp_meta_boxes;

		# Output the "advanced" meta boxes:
		do_meta_boxes( get_current_screen(), 'before', $post );

		# Remove the initial "advanced" meta boxes:
		unset( $wp_meta_boxes['post']['before'] );
	}




	function set_custom_size_options( $sizes ) {
		return array_merge( $sizes, array(
			'picture-grid-tile-low-res' => __( 'Tile (Low Res)' ),
			'overlay-image-column-low-res' => __( 'Overlay (Low Res)' ),
			'picture-grid-tile-hi-res' => __( 'Tile (Hi Res)' ),
			'overlay-image-column-hi-res' => __( 'Overlay (Hi Res)' ),

		) );
	}

	function enqueue_scripts(){
		wp_enqueue_style( 'str_admin_css', STR_PLUGIN_URL . '/css/str_admin.css', false, '1.0.0' );
		wp_enqueue_media();

		wp_register_script( 'str_admin_js', STR_PLUGIN_URL . '/js/str_admin.js', false, '1.0.0' );
		if($this->image_boxes !== null && count($this->image_boxes) > 0){
			$image_box_manager = array(
				'imageBoxIds' => array_map(function($b){ return $b['image_box_id']; },  $this->image_boxes)
			);

			wp_localize_script('str_admin_js', 'imageBoxManager', $image_box_manager);
		}

		wp_enqueue_script( 'str_admin_js');

	}

}

class STR_Success_Story_Page extends STR_Custom_Admin_Page {

	private $nonce_id = "str_story_nonce";

	public function __construct( $post_type, $post_type_name, $post_type_singular_name = null, $slug = null ) {
		parent::__construct( $post_type, $post_type_name, $post_type_singular_name, $slug );
		$this->image_boxes = $this->get_image_boxes();
	}

	private function get_image_boxes(){
		return array(
			 array(
			 	'image_box_id' => 'str_success_tile_img',
			    'field_name' => 'meta_success_tile_img',
				'label' => 'Page Tile Image',
			    'instruction' => 'Image should be 1440px X 940px to maintain multi-resolution support'
				 ),
			array(
				'image_box_id' => 'str_success_overlay_img',
				'field_name' => 'meta_success_overlay_img',
				'label' => 'Overlay  Image',
				'instruction' => 'Image should be 1440px X 1920px to maintain multi-resolution support'
			)
		);
	}

	function add_meta_boxes() {

		// TODO: Implement add_meta_boxes() method.

		add_meta_box(
			'str_page_inclusion_meta',
			"Page Inclusion",
			array($this, 'str_inclusion_metabox'),
			$this->post_type,
			'before',
			'high' );

		add_meta_box(
			'str_story_challenge_meta',
			"Challenge",
			 array($this, 'str_challenge_metabox'),
			$this->post_type,
			'before',
			'low' );

		add_meta_box(
			'str_story_result_meta',
			"Results",
			array($this, 'str_results_metabox'),
			$this->post_type,
			'normal',
			'high');

		foreach ($this->image_boxes as $box){

			add_meta_box(
				$box['image_box_id'],
				$box['label'],
				array($this, 'str_image_metabox'),
				$this->post_type,
				'normal',
				'high',
				array($box)
			);

		}


	}

	function save_post( $post_id) {

		if(get_post_type($post_id) !== 'str_success_story') return;


		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

		// if our nonce isn't there, or we can't verify it, bail
		if( !isset( $_POST[$this->nonce_id ] ) || !wp_verify_nonce( $_POST[$this->nonce_id ], $this->nonce_id ) ) return;

		// if our current user can't edit this post, bail
		if( !current_user_can( 'edit_post', $post_id ) ) return;


		if(isset($_POST['meta_include_in_page']) && $_POST['meta_include_in_page'] != '')
			update_post_meta($post_id, 'meta_include_in_page', $_POST['meta_include_in_page']);
		else
			update_post_meta($post_id, 'meta_include_in_page', false);

		if(isset($_POST['meta_item_index']) && $_POST['meta_item_index'] != '')
			update_post_meta($post_id, 'meta_item_index', $_POST['meta_item_index']);
		else
			update_post_meta($post_id, 'meta_item_index', 0);


		if(isset($_POST['meta_success_challenge']) && $_POST['meta_success_challenge'] != '')
			update_post_meta($post_id, 'meta_success_challenge', $_POST['meta_success_challenge']);
		else
			delete_post_meta($post_id, 'meta_challenge');

		if(isset($_POST['meta_success_result']) && $_POST['meta_success_result'] != '')
			update_post_meta($post_id, 'meta_success_result', $_POST['meta_success_result']);
		else
			delete_post_meta($post_id, 'meta_success_result');

		foreach ($this->image_boxes as $box) {

			$box_name = $box['field_name'];

			if(isset($_POST[$box_name]) && $_POST[$box_name] != '')
				update_post_meta($post_id, $box_name, $_POST[$box_name]);
			else
				delete_post_meta($post_id, $box_name);

		}

	}

	function str_inclusion_metabox($post) {

		try{

			$str_template_path = STR_PLUGIN_PATH . 'includes/templates/str_page_inclusion_box.php';

			include( $str_template_path );

		} catch (\Exception $e){

			echo '<div id="str_inclusion_widget"><p>There has been an error generating this widget</p><p>'. $e->getMessage() .'</p></div>';

		}

	}

	function str_challenge_metabox($post) {

		try{

			$field_name = 'meta_success_challenge';
			$nonce_id = $this->nonce_id;
			$str_template_path = STR_PLUGIN_PATH . 'includes/templates/str_general_editor_box.php';

			include( $str_template_path );

		} catch (\Exception $e){

			echo '<div id="str_challenge_widget"><p>There has been an error generating this widget</p><p>'. $e->getMessage() .'</p></div>';

		}

	}

	function str_image_metabox( $post, $box) {

		try{
			if(count($box['args'])== 0) return;
			$image_box_args = $box['args'][0];
			$str_custom_image_key = $image_box_args['field_name'];
			$str_instruction = $image_box_args['instruction'];
			$str_template_path = STR_PLUGIN_PATH . 'includes/templates/str_image_box.php';

			include( $str_template_path );

		} catch (\Exception $e){

			echo '<div id="str_image_widget"><p>There has been an error generating this widget</p><p>'. $e->getMessage() .'</p></div>';

		}
	}

	function str_results_metabox( $post, $box) {

		try{
			$str_template_path = STR_PLUGIN_PATH . 'includes/templates/str_results_box.php';

			include( $str_template_path );

		} catch (\Exception $e){

			echo '<div id="str_results_widget"><p>There has been an error generating this widget</p><p>'. $e->getMessage() .'</p></div>';

		}
	}

}