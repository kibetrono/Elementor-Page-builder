<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link        https://author.example.com/
 * @since      1.0.0
 *
 * @package    Rono
 * @subpackage Rono/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rono
 * @subpackage Rono/admin
 * @author     Kibet David <kibetdavidro@gmail.com>
 */
class Rono_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rono_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rono_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rono-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'bootstrap-css', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rono_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rono_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/rono-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'bootstrap-js', plugin_dir_url( __FILE__ ) . 'js/bootstrap.js', array( 'jquery' ), $this->version, false );

	}



	/**
	 * add our custom menu
	 *
	 * @since    1.0.0
	 */
	public function my_admin_menu(){
		// add_menu_page( $page_title:string, $menu_title:string, $capability:string, $menu_slug:string, $function:callable, $icon_url:string, $position:integer|null )
		add_menu_page('New Plugin menu','Rono Settings', 'manage_options', 'plugin-name/mainsettings', array($this,'myplugin_admin_page'), 'dashicons-tickets', 250);
		// add_submenu_page( $parent_slug:string, $page_title:string, $menu_title:string, $capability:string, $menu_slug:string, $function:callable, $position:integer|null )
		add_submenu_page( 'plugin-name/mainsettings', 'Sub Level Menu Plugin ', 'Sub Menu', 'manage_options', 'plugin-name/subLevelSettings',array($this,'myplugin_sub_level_page'));

		}

	public function myplugin_admin_page(){
		// return views 
		require_once 'partials/rono-admin-display.php'; // from admin->partials->rono-admin-display.php
	}

	public function myplugin_sub_level_page(){
		// return view
		require_once 'partials/rono-subpage-display.php'; // from admin->partials->rono-subpage-display.php
	}

	/**
	 * Register custom fields for plugin settings
	 *
	 * @since    1.0.0
	 */

	public function register_rono_settings(){
		// register all settings
		// register_setting( $option_group:string, $option_name:string, $args:array )
		register_setting( 'myownsettings', 'theemail' );
		register_setting( 'myownsettings', 'thedays' );
		register_setting( 'myownsettings', 'themuiltiselect' );		
	}

	/**
	 * YouTube API channels
	 *
	 * @since    1.0.0
	 */
	public function youtube_Api_channels(){
		register_setting('you_channels','theKey');
		register_setting('you_channels','theID');
	}
	

	/**
	 * YouTube CPT
	 *
	 * @since    1.0.0
	 */
	public function custom_youtube_Api_PT(){
/*
		* Creating a function to create our CPT
	*/
    $labels = array(
        'name'                => _x( 'YouTube Videos', 'Post Type General Name'),
        'singular_name'       => _x( 'YouTube Video', 'Post Type Singular Name'),
        'menu_name'           => __( 'YouTube Video'),
        'parent_item_colon'   => __( 'Parent Video'),
        'all_items'           => __( 'All Videos'),
        'view_item'           => __( 'View Videos'),
        'add_new_item'        => __( 'Add New YouTube Video'),
        'add_new'             => __( 'Add New'),
        'edit_item'           => __( 'Edit'),
        'update_item'         => __( 'Update'),
        'search_items'        => __( 'Search'),
        'not_found'           => __( 'Not Found'),
        'not_found_in_trash'  => __( 'Not found in Trash'),
    );
     
// Set other options for Custom Post Type
     
    $args = array(
        'label'               => __( 'wp10yvids'),
        'description'         => __( 'YouTube Videos from our Channel'),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array( 'genres' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => false,
        'show_in_menu'        => false,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => false,
        'has_archive'         => true,
        'exclude_from_search' => true,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
 
    );
     
    // Registering your Custom Post Type
    register_post_type( 'wp10yvids', $args );
	}


		/**
	 * custom_widget
	 *
	 * @since    1.0.0
	 */
	public function custom_widget(){
		// return view
		require_once 'partials/rono-custom_widget.php';
	}

		/**
	 * a new CPT
	 *
	 * @since    1.0.0
	 */
	public function new_CPT(){
		$labels=array(
			'name' => 'Cars',
			'singular_name' => 'Car'
		);
		$args=array(

			'labels' => $labels,
			'public' => true,
			'has_archive' => true,
			'hierarchical' => false,
			'supports' => array(
				'title',
				'editor',
				'thumbnails'
			),
			'rewrite'=>array('slug','my-cars')
		);

		register_post_type( 'cars', $args);
	}

		/**
	 * a taxonomy for cars
	 *
	 * @since    1.0.0
	 */	

	 public function cars_taxonomy(){
		$labels=array(
			'name' => 'Brands',
			'singular_name' => 'Brand'
		);
		$args=array(
			'labels' =>$labels,
			'public' => true,
			'hierarchical' => true,
		);

		 register_taxonomy( "brands", 'cars',$args);
	 }

}
