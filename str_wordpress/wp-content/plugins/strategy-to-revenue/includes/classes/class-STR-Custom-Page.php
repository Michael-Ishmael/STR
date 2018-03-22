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
	protected $image_box_ids;

	public function __construct($post_type, $post_type_name, $post_type_singular_name = null, $slug = null) {
		if($post_type_singular_name === NULL) $post_type_singular_name = $post_type_name;
		if($slug === NULL) $slug = strtolower(str_replace('_', '-', $post_type));

		$this->post_type = $post_type;
		$this->post_type_name = $post_type_name;
		$this->post_type_singular_name = $post_type_singular_name;
		$this->slug = $slug;

	}

	public function init(){
		$this->register_post_type();
		$this->add_actions();
	}

	protected function add_actions(){
		add_action( 'admin_enqueue_scripts', array($this, 'enqueue_scripts' ));
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'edit_form_after_title', array( $this, 'move_before_meta' ));
		add_action( 'save_post', array($this, 'save_post') );
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

	function enqueue_scripts(){
		wp_enqueue_style( 'str_admin_css', STR_PLUGIN_URL . '/css/str_admin.css', false, '1.0.0' );
		wp_enqueue_media();

		wp_register_script( 'str_admin_js', STR_PLUGIN_URL . '/js/str_admin.js', false, '1.0.0' );
		if($this->image_box_ids !== null && count($this->image_box_ids) > 0){
			$image_box_manager = array(
				'imageBoxIds' => $this->image_box_ids
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
		$this->image_box_ids = array('str-story-tile-img-lr', 'str-story-tile-img-hr');
	}

	function add_meta_boxes() {
		// TODO: Implement add_meta_boxes() method.
		add_meta_box(
			'str_story_challenge_meta',
			"Challenge",
			 array($this, 'str_challenge_metabox'),
			$this->post_type,
			'before',
			'high' );

		add_meta_box(
			'str_story_result_meta',
			"Results",
			array($this, 'str_results_metabox'),
			$this->post_type,
			'normal',
			'high');

		foreach ($this->image_box_ids as $box_id){

			$box_name = str_replace('str', 'meta', $box_id);
			$box_name = str_replace('-', '_', $box_name);

			add_meta_box(
				$box_id,
				"Tile Image (low-res)",
				array($this, 'str_image_metabox'),
				$this->post_type,
				'normal',
				'high',
				array($box_name) );

		}


	}

	function save_post( $post_id) {

		if(get_post_type($post_id) !== 'str_success_story') return;


		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

		// if our nonce isn't there, or we can't verify it, bail
		if( !isset( $_POST[$this->nonce_id ] ) || !wp_verify_nonce( $_POST[$this->nonce_id ], $this->nonce_id ) ) return;

		// if our current user can't edit this post, bail
		if( !current_user_can( 'edit_post', $post_id ) ) return;


		if(isset($_POST['meta_challenge']) && $_POST['meta_challenge'] != '')
			update_post_meta($post_id, 'meta_challenge', $_POST['meta_challenge']);
		else

			delete_post_meta($post_id, 'meta_challenge');

		if(isset($_POST['meta_success_result']) && $_POST['meta_success_result'] != '')
			update_post_meta($post_id, 'meta_success_result', $_POST['meta_success_result']);
		else
			delete_post_meta($post_id, 'meta_success_result');

		foreach ($this->image_box_ids as $box_id) {

			$box_name = str_replace( 'str', 'meta', $box_id );
			$box_name = str_replace( '-', '_', $box_name );

			if(isset($_POST[$box_name]) && $_POST[$box_name] != '')
				update_post_meta($post_id, $box_name, $_POST[$box_name]);
			else
				delete_post_meta($post_id, $box_name);

		}




	}

	function str_challenge_metabox($post) {

		try{

			$field_name = 'str_story_challenge';
			$nonce_id = $this->nonce_id;
			$str_template_path = STR_PLUGIN_PATH . 'includes/templates/str_general_editor_box.php';

			include( $str_template_path );

		} catch (\Exception $e){

			echo '<div id="str_image_widget"><p>There has been an error generating image widget</p><p>'. $e->getMessage() .'</p></div>';

		}

	}

	function str_image_metabox( $post, $box) {

		try{
			if(count($box['args'])== 0) return;
			$str_custom_image_key = $box['args'][0];
			$str_template_path = STR_PLUGIN_PATH . 'includes/templates/str_image_box.php';

			include( $str_template_path );

		} catch (\Exception $e){

			echo '<div id="str_image_widget"><p>There has been an error generating image widget</p><p>'. $e->getMessage() .'</p></div>';

		}
	}

	function str_results_metabox( $post, $box) {

		try{
			$str_template_path = STR_PLUGIN_PATH . 'includes/templates/str_results_box.php';

			include( $str_template_path );

		} catch (\Exception $e){

			echo '<div id="str_results_widget"><p>There has been an error generating image widget</p><p>'. $e->getMessage() .'</p></div>';

		}
	}

}