<?php

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://author.example.com/
 * @since      1.0.0
 *
 * @package    Social
 * @subpackage Social/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Social
 * @subpackage Social/admin
 * @author     David Rono <kibetdavidro@gmail.com>
 */
class Social_Admin {

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
		 * defined in Social_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Social_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/social-admin.css', array(), $this->version, 'all' );

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
		 * defined in Social_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Social_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/social-admin.js', array( 'jquery' ), $this->version, false );

	}

	

	/**
	 * Register social share admin menu
	 *
	 * @since    1.0.0
	 */	
	public function swske_social_share_admin_menu(){
		// add_menu_page( $page_title:string, $menu_title:string, $capability:string, $menu_slug:string, $function:callable, $icon_url:string, $position:integer|null )
		add_menu_page( 'social networks','Social Share', 'manage_options','social-networks',array($this,'swske_social_admin_callable'),'dashicons-share-alt2', 250);
		// add_submenu_page( $parent_slug:string, $page_title:string, $menu_title:string, $capability:string, $menu_slug:string, $function:callable, $position:integer|null )
		add_submenu_page( 'social-networks', 'Social Share Sub Page', 'How To Use', 'manage_options', 'social-networks_how_to_use',array($this,'swske_social_share_how_to_use_callable'));

	}
	public function swske_social_admin_callable(){
		require_once 'partials/social-arrange.php';
	}

	public function swske_social_share_how_to_use_callable(){
		require_once 'partials/social-how-to-use.php';
	}

	/**
	 * Register custom fields
	 *
	 * @since    1.0.0
	 */	

	public function swske_register_custom_field_values(){
		// register all settings
		// register_setting( $option_group:string, $option_name:string, $args:array )
		register_setting( 'myownsettings', 'thefacebook' );
		register_setting( 'myownsettings', 'thetwitter' );
		register_setting( 'myownsettings', 'thepinterest' );
		register_setting( 'myownsettings', 'thelinkedin' );
		register_setting( 'myownsettings', 'thewhatsapp' );
		// post type
		register_setting( 'myownsettings', 'swsketheposts' );
		register_setting( 'myownsettings', 'swskethepages' );
		register_setting( 'myownsettings', 'thelandingpages' );
		register_setting( 'myownsettings', 'thetemplates' );
		// button size
		register_setting( 'myownsettings', 'thebuttonsize' );

		// button color
		register_setting( 'myownsettings', 'thecolor' );

		// icon arrangement
		register_setting( 'myownsettings', 'the_arrangement_order' );
		register_setting( 'myownsettings', 'theorderrevision' );

		// button position
		register_setting( 'myownsettings', 'thebelow' );
		register_setting( 'myownsettings', 'thefloating' );
		register_setting( 'myownsettings', 'theafter' );
		register_setting( 'myownsettings', 'thebefore' );
		register_setting( 'myownsettings', 'theinside' );
	
	}

	function swske_custom_post_type(){
        $args=array(
            'label' =>'Books',
            'public'=>true
        );
        register_post_type('book',$args);
        
    }

		/**
	 * Colorpicker
	 *
	 * @since    1.0.0
	 */	

	public function swske_add_color_picker(){
		if( is_admin() ) { 
     
			// Add the color picker css file       
			wp_enqueue_style( 'wp-color-picker' ); 
			 
			// Include our custom jQuery file with WordPress Color Picker dependency
			wp_enqueue_script( 'custom-script-handle', plugins_url( 'custom-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true ); 
		}
	}
	

}
