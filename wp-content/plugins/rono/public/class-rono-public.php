<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link        https://author.example.com/
 * @since      1.0.0
 *
 * @package    Rono
 * @subpackage Rono/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Rono
 * @subpackage Rono/public
 * @author     Kibet David <kibetdavidro@gmail.com>
 */
class Rono_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rono-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/rono-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * First shortcode
	 *
	 * @since    1.0.0
	 */

	public function public_new_shortcode(){
		echo "This is a short code";
    echo '<br>';
		$num_days = get_option( 'thedays' );
		$myemail = get_option( 'theemail' );

		echo 'Email Address is '.$myemail;
		echo '<br>';
		echo 'Number of days is  '.$num_days;

	}

	/**
	 * List of all WPForms
	 *
	 * @since    1.0.0
	 */

	public function all_wpforms(){
		$args = [
			'post_type' => 'wpforms',
			'post_status' => 'publish',
			'posts_per_page' => -1,
		  ];
		  $posts = wpforms()->form->get();
		  $forms = wp_list_pluck( $posts, 'post_title' );
		  
		 return implode( '<br>', $forms );

	}

	

}
