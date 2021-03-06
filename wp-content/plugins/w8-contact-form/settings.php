<?php
if ( ! class_exists( 'contact_form_slider_settings' ) ) {
	class contact_form_slider_settings extends contact_form_slider {
		/**
		* Construct the plugin object
		**/
		public function __construct()
		{
		/**
		* include required files
		**/
		require_once(ABSPATH.'wp-admin/includes/upgrade.php');
		require_once(ABSPATH.'wp-includes/pluggable.php');
		/**
		* register actions, hook into WP's admin_init action hook
		**/
		add_action('admin_init', array(&$this, 'admin_init'));
		add_action('admin_menu', array(&$this, 'add_menu'));
		add_action('wp_ajax_ajax_cfs_admin', array(&$this, 'ajax_cfs_admin'));
		add_action('wp_ajax_nopriv_ajax_cfs_admin', array(&$this, 'ajax_cfs_admin'));
		}
		/**
		* include custom scripts and style to the admin page
		**/
		function enqueue_admin_custom_scripts_and_styles() {
			wp_enqueue_style( 'contact_form_slider_style', plugins_url( '/templates/assets/css/contact-form-slider-settings.css', __FILE__ ) );
			wp_enqueue_style( 'jquery_ui_style', plugins_url( '/templates/assets/css/jquery-ui.css', __FILE__ ) );
			wp_enqueue_style( 'image_picker_style', plugins_url( '/templates/assets/css/image-picker.css', __FILE__ ) );
			wp_enqueue_media();
			wp_enqueue_style( 'thickbox' ); // Stylesheet used by Thickbox
			wp_enqueue_script( 'thickbox' );
			wp_enqueue_script( 'media-upload' );
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'cmu', plugins_url( '/templates/assets/js/cmu.js', __FILE__ ), array( 'thickbox', 'media-upload', 'jquery' ) );
			wp_enqueue_script( 'imagepicker', plugins_url( '/templates/assets/js/image-picker.min.js', __FILE__ ), array( 'jquery' ) );
			wp_enqueue_script( 'jquery-ui-core', array( 'jquery' ) );
			wp_enqueue_script( 'jquery-ui-draggable', array( 'jquery' ) );
			wp_enqueue_script( 'jquery-ui-slider', array( 'jquery' ) );
			wp_enqueue_script( 'jquery-ui-tooltip', array( 'jquery' ) );
			wp_enqueue_script( 'jquery-ui-dialog', array( 'jquery' ) );
			wp_enqueue_script( 'jquery-ui-accordion', array( 'jquery' ) );
			wp_register_script( 'cfs_admin', plugins_url( '/templates/assets/js/cfs-admin.js', __FILE__ ), 
				array( 'jquery', 
					   'jquery-ui-core', 
					   'jquery-ui-draggable', 
					   'jquery-ui-slider', 
					   'jquery-ui-tooltip', 
					   'jquery-ui-dialog', 
					   'jquery-ui-accordion', 
					   'cmu'
				), '100001', true );
			wp_localize_script( 'cfs_admin', 'cfs_admin_datas', array("plugin_directory"=>plugins_url( '/templates/assets/', __FILE__),"path"=>admin_url( 'admin-ajax.php'),"adminemail"=>get_bloginfo( 'admin_email' ),"languages"=>array("addimage"=>esc_html__( 'Add Image', W8CONTACT_FORM_TEXT_DOMAIN ),"remove"=>esc_html__( 'REMOVE', W8CONTACT_FORM_TEXT_DOMAIN ),"del"=>esc_html__( 'DELETE', W8CONTACT_FORM_TEXT_DOMAIN ),"entername"=>esc_html__( 'Enter the name', W8CONTACT_FORM_TEXT_DOMAIN ),"entertitle"=>esc_html__( 'Enter the title', W8CONTACT_FORM_TEXT_DOMAIN ),"entersubject"=>esc_html__( 'Enter the subject', W8CONTACT_FORM_TEXT_DOMAIN ),"emailaddress"=>esc_html__( 'Email address', W8CONTACT_FORM_TEXT_DOMAIN ),"description"=>esc_html__( 'Description', W8CONTACT_FORM_TEXT_DOMAIN ),"facebookurl"=>esc_html__( 'Facebook URL', W8CONTACT_FORM_TEXT_DOMAIN ),"googleplusurl"=>esc_html__( 'Google Plus URL', W8CONTACT_FORM_TEXT_DOMAIN ),"twitterurl"=>esc_html__( 'Twitter URL', W8CONTACT_FORM_TEXT_DOMAIN ),"pinteresturl"=>esc_html__( 'Pinterest URL', W8CONTACT_FORM_TEXT_DOMAIN ),"linkedinurl"=>esc_html__( 'LinkedIn URL', W8CONTACT_FORM_TEXT_DOMAIN ),"skypeurl"=>esc_html__( 'Skype Username', W8CONTACT_FORM_TEXT_DOMAIN ),"tumblrurl"=>esc_html__( 'Tumblr URL', W8CONTACT_FORM_TEXT_DOMAIN ),"flickrurl"=>esc_html__( 'Flickr URL', W8CONTACT_FORM_TEXT_DOMAIN ),"foursquareurl"=>esc_html__( 'Foursquare URL', W8CONTACT_FORM_TEXT_DOMAIN ),"youtubeurl"=>esc_html__( 'YouTube URL', W8CONTACT_FORM_TEXT_DOMAIN ),"sendername"=>esc_html__( 'Sender Name', W8CONTACT_FORM_TEXT_DOMAIN ),"senderemailaddress"=>esc_html__( 'Sender Email Address', W8CONTACT_FORM_TEXT_DOMAIN ),"message"=>esc_html__( 'Message', W8CONTACT_FORM_TEXT_DOMAIN ),"autoreply"=>esc_html__( 'Auto Reply', W8CONTACT_FORM_TEXT_DOMAIN ),"autoreplydesc"=>esc_html__( 'Leave the fields blank to disable autoreply or use the global autoreply option.', W8CONTACT_FORM_TEXT_DOMAIN ),"alllogs"=>esc_html__( 'All log entries has been deleted.', W8CONTACT_FORM_TEXT_DOMAIN ),"deletecontact"=>esc_html__( 'Delete Contact', W8CONTACT_FORM_TEXT_DOMAIN ),"clearlogs"=>esc_html__( 'Clear Logs', W8CONTACT_FORM_TEXT_DOMAIN ),"nolog"=>esc_html__( 'No log entries found.', W8CONTACT_FORM_TEXT_DOMAIN ),"name"=>esc_html__( 'Name', W8CONTACT_FORM_TEXT_DOMAIN ),"title"=>esc_html__( 'Title', W8CONTACT_FORM_TEXT_DOMAIN ),"subject"=>esc_html__( 'Subject', W8CONTACT_FORM_TEXT_DOMAIN ),"eaddress"=>esc_html__( 'Email Address', W8CONTACT_FORM_TEXT_DOMAIN ),"shortdesc"=>esc_html__( 'Short Description', W8CONTACT_FORM_TEXT_DOMAIN ),"cancel"=>esc_html__( 'Cancel', W8CONTACT_FORM_TEXT_DOMAIN ),"save"=>esc_html__( 'SAVE', W8CONTACT_FORM_TEXT_DOMAIN ),"saveerror"=>esc_html__( 'Error during the save process', W8CONTACT_FORM_TEXT_DOMAIN ),"successsave"=>esc_html__( 'Saved Successfully', W8CONTACT_FORM_TEXT_DOMAIN ))));
			wp_enqueue_script( 'cfs_admin' );
		}
		/**
		* initialize datas on wp admin
		**/
		public function admin_init()
		{
		$settings_page = '';
			if ( isset( $_REQUEST[ 'page' ] ) ) {
				$settings_page = $_REQUEST[ 'page' ];
			}
			if ( strpos( $settings_page, 'contact_form_slider' ) !== false ) {
				add_action( 'admin_head', array( &$this, 'enqueue_admin_custom_scripts_and_styles' ) );
			}

			// register your custom settings - general settings
			register_setting('contact_form_slider-group', 'setting_sendername');
			register_setting('contact_form_slider-group', 'setting_sendermail');
			register_setting('contact_form_slider-group', 'setting_hide_icon');
			register_setting('contact_form_slider-group', 'setting_lock_screen');
			register_setting('contact_form_slider-group', 'setting_closeable');
			register_setting('contact_form_slider-group', 'setting_transparency');
			register_setting('contact_form_slider-group', 'setting_display_once_for_same_user');
			register_setting('contact_form_slider-group', 'setting_display_globally');
			register_setting('contact_form_slider-group', 'setting_disable_on_mobile');
			register_setting('contact_form_slider-group', 'setting_auto_open');
			register_setting('contact_form_slider-group', 'setting_sendcopy');
			register_setting('contact_form_slider-group', 'setting_disableimage');
			register_setting('contact_form_slider-group', 'setting_captcha');
			register_setting('contact_form_slider-group', 'setting_keep_settings');
			// add your settings section
			add_settings_section('contact_form_slider-section', '', array(&$this, 'settings_section_contact_form_slider'), 'contact_form_slider');
			// add your setting's fields
			add_settings_field('contact_form_slider-setting_sendername', esc_html__( 'Sender Name', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_text'), 'contact_form_slider', 'contact_form_slider-section', array('field' => 'setting_sendername', 'field_value' => '', 'other' => 'size="70"'));
			add_settings_field('contact_form_slider-setting_sendermail', esc_html__( 'Sender Email Address', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_text'), 'contact_form_slider', 'contact_form_slider-section', array('field' => 'setting_sendermail', 'field_value' => '', 'other' => 'size="40"'));
			add_settings_field('contact_form_slider-setting_hide_icon', esc_html__( 'Hide icon', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_radio'), 'contact_form_slider', 'contact_form_slider-section', array('field' => 'setting_hide_icon', 'field_value' => '', 'options' => array(esc_html__( 'On', W8CONTACT_FORM_TEXT_DOMAIN )=>"on",esc_html__( 'Off', W8CONTACT_FORM_TEXT_DOMAIN )=>"off"), 'other' => ''));
			add_settings_field('contact_form_slider-setting_lock_screen', esc_html__( 'Lock screen', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_radio'), 'contact_form_slider', 'contact_form_slider-section', array('field' => 'setting_lock_screen', 'field_value' => '', 'options' => array(esc_html__( 'On', W8CONTACT_FORM_TEXT_DOMAIN )=>"on",esc_html__( 'Off', W8CONTACT_FORM_TEXT_DOMAIN )=>"off"), 'other' => ''));
			add_settings_field('contact_form_slider-setting_closeable', esc_html__( 'Display Close Icon', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_radio'), 'contact_form_slider', 'contact_form_slider-section', array('field' => 'setting_closeable', 'field_value' => '', 'options' => array(esc_html__( 'On', W8CONTACT_FORM_TEXT_DOMAIN )=>"on",esc_html__( 'Off', W8CONTACT_FORM_TEXT_DOMAIN )=>"off"), 'other' => ''));
			add_settings_field('contact_form_slider-setting_transparency', esc_html__( 'Background Transparency (percentage)', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_text'), 'contact_form_slider', 'contact_form_slider-section', array('field' => 'setting_transparency', 'field_value' => '', 'other' => 'slider'));
			add_settings_field('contact_form_slider-setting_display_once_for_same_user', esc_html__( 'Display once per user', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_radio'), 'contact_form_slider', 'contact_form_slider-section', array('field' => 'setting_display_once_for_same_user', 'field_value' => '', 'options' => array(esc_html__( 'On', W8CONTACT_FORM_TEXT_DOMAIN )=>"on",esc_html__( 'Off', W8CONTACT_FORM_TEXT_DOMAIN )=>"off"), 'other' => ''));
			add_settings_field('contact_form_slider-setting_display_globally', esc_html__( 'Display globally', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_radio'), 'contact_form_slider', 'contact_form_slider-section', array('field' => 'setting_display_globally', 'field_value' => '', 'options' => array(esc_html__( 'On', W8CONTACT_FORM_TEXT_DOMAIN )=>"on",esc_html__( 'Off', W8CONTACT_FORM_TEXT_DOMAIN )." <i>".esc_html__( '(use [contact_form_slider] shortcode in the content)', W8CONTACT_FORM_TEXT_DOMAIN )."</i>"=>"off"), 'other' => ''));
			add_settings_field('contact_form_slider-setting_auto_open', esc_html__( 'Auto open at bottom of the page', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_radio'), 'contact_form_slider', 'contact_form_slider-section', array('field' => 'setting_auto_open', 'field_value' => '', 'options' => array(esc_html__( 'On', W8CONTACT_FORM_TEXT_DOMAIN )=>"on",esc_html__( 'Off', W8CONTACT_FORM_TEXT_DOMAIN )=>"off"), 'other' => ''));
			add_settings_field('contact_form_slider-setting_sendcopy', esc_html__( 'Enable sending copy', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_radio'), 'contact_form_slider', 'contact_form_slider-section', array('field' => 'setting_sendcopy', 'field_value' => '', 'options' => array(esc_html__( 'On', W8CONTACT_FORM_TEXT_DOMAIN )=>"on",esc_html__( 'Off', W8CONTACT_FORM_TEXT_DOMAIN )=>"off"), 'other' => ''));
			add_settings_field('contact_form_slider-setting_disableimage', esc_html__( 'Hide Contact Photo', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_radio'), 'contact_form_slider', 'contact_form_slider-section', array('field' => 'setting_disableimage', 'field_value' => '', 'options' => array(esc_html__( 'On', W8CONTACT_FORM_TEXT_DOMAIN )=>"on",esc_html__( 'Off', W8CONTACT_FORM_TEXT_DOMAIN )=>"off"), 'other' => ''));
			add_settings_field('contact_form_slider-setting_captcha', esc_html__( 'Captcha', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_radio'), 'contact_form_slider', 'contact_form_slider-section', array('field' => 'setting_captcha', 'field_value' => '', 'options' => array(esc_html__( 'Image', W8CONTACT_FORM_TEXT_DOMAIN )=>"image",esc_html__( 'Math', W8CONTACT_FORM_TEXT_DOMAIN )=>"math",esc_html__( 'Hidden Field', W8CONTACT_FORM_TEXT_DOMAIN )=>"hidden",esc_html__( 'Disabled', W8CONTACT_FORM_TEXT_DOMAIN )=>"disabled"), 'other' => ''));
			add_settings_field('contact_form_slider-setting_disable_on_mobile', esc_html__( 'Disable on mobile', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_radio'), 'contact_form_slider', 'contact_form_slider-section', array('field' => 'setting_disable_on_mobile', 'field_value' => '', 'options' => array(esc_html__( 'On', W8CONTACT_FORM_TEXT_DOMAIN )=>"on",esc_html__( 'Off', W8CONTACT_FORM_TEXT_DOMAIN )=>"off"), 'other' => ''));
			add_settings_field('contact_form_slider-setting_keep_settings', esc_html__( 'Keep Settings', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_radio'), 'contact_form_slider', 'contact_form_slider-section', array('field' => 'setting_keep_settings', 'field_value' => '', 'options' => array(esc_html__( 'On', W8CONTACT_FORM_TEXT_DOMAIN )=>"on",esc_html__( 'Off', W8CONTACT_FORM_TEXT_DOMAIN )=>"off"), 'other' => ''));
			
			// register your custom settings - styles settings
			register_setting('contact_form_slider_styles-group', 'setting_vertical_distance');
			register_setting('contact_form_slider_styles-group', 'setting_icon_size');
			register_setting('contact_form_slider_styles-group', 'setting_direction');
			register_setting('contact_form_slider_styles-group', 'setting_icon_image');
			register_setting('contact_form_slider_styles-group', 'setting_icon_url');
			register_setting('contact_form_slider_styles-group', 'setting_animation');
			register_setting('contact_form_slider_styles-group', 'setting_reverseheader');
			register_setting('contact_form_slider_styles-group', 'setting_height');
			register_setting('contact_form_slider_styles-group', 'setting_bganim');
			register_setting('contact_form_slider_styles-group', 'setting_bgtarget');
			register_setting('contact_form_slider_styles-group', 'setting_excludeelements');
			register_setting('contact_form_slider_styles-group', 'setting_scheme');
			register_setting('contact_form_slider_styles-group', 'setting_skin');
			register_setting('contact_form_slider_styles-group', 'setting_photostyle');
			register_setting('contact_form_slider_styles-group', 'setting_photoborder');
			register_setting('contact_form_slider_styles-group', 'setting_shake');
			register_setting('contact_form_slider_styles-group', 'setting_fontfamily');
			register_setting('contact_form_slider_styles-group', 'setting_pfontsize');
			register_setting('contact_form_slider_styles-group', 'setting_headerfontsize');
			register_setting('contact_form_slider_styles-group', 'setting_subheaderfontsize');
			register_setting('contact_form_slider_styles-group', 'setting_buttonfontsize');
			register_setting('contact_form_slider_styles-group', 'setting_fieldfontsize');
			register_setting('contact_form_slider_styles-group', 'setting_pfontweight');
			register_setting('contact_form_slider_styles-group', 'setting_headerfontweight');
			register_setting('contact_form_slider_styles-group', 'setting_subheaderfontweight');
			register_setting('contact_form_slider_styles-group', 'setting_buttonfontweight');
			register_setting('contact_form_slider_styles-group', 'setting_fieldfontweight');
			register_setting('contact_form_slider_styles-group', 'setting_background');
			register_setting('contact_form_slider_styles-group', 'setting_button_background');
			register_setting('contact_form_slider_styles-group', 'setting_button_background_hover');
			register_setting('contact_form_slider_styles-group', 'setting_defaultcolor');
			register_setting('contact_form_slider_styles-group', 'setting_buttoncolor');
			// add your settings section
			add_settings_section('contact_form_slider_styles-section', '', array(&$this, 'settings_section_contact_form_slider'), 'contact_form_slider_styles');
			add_settings_field('contact_form_slider-setting_vertical_distance', esc_html__( 'Icon Vertical Distance (5-95 / in percentage)', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_text'), 'contact_form_slider_styles', 'contact_form_slider_styles-section', array('field' => 'setting_vertical_distance', 'field_value' => '', 'other' => 'slider'));
			add_settings_field('contact_form_slider-setting_icon_size', esc_html__( 'Icon size (the default icon only)', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_radio'), 'contact_form_slider_styles', 'contact_form_slider_styles-section', array('field' => 'setting_icon_size', 'field_value' => '', 'options' => array(esc_html__( 'Small', W8CONTACT_FORM_TEXT_DOMAIN )=>"small",esc_html__( 'Medium', W8CONTACT_FORM_TEXT_DOMAIN )=>"medium",esc_html__( 'Large', W8CONTACT_FORM_TEXT_DOMAIN )=>"large"), 'other' => ''));
			add_settings_field('contact_form_slider-setting_direction', esc_html__( 'Direction', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_radio'), 'contact_form_slider_styles', 'contact_form_slider_styles-section', array('field' => 'setting_direction', 'field_value' => '', 'options' => array(esc_html__( 'Left', W8CONTACT_FORM_TEXT_DOMAIN )=>"left",esc_html__( 'Right', W8CONTACT_FORM_TEXT_DOMAIN )=>"right"), 'other' => ''));
			add_settings_field('contact_form_slider-setting_icon_image', esc_html__( 'Default Icon', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_select'), 'contact_form_slider_styles', 'contact_form_slider_styles-section', array('field' => 'setting_icon_image', 'field_value' => '', 'other' => 'iconimg'));
			add_settings_field('contact_form_slider-setting_icon_url', esc_html__( 'Icon url (optional - leave empty for default)', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_upload'), 'contact_form_slider_styles', 'contact_form_slider_styles-section', array('field' => 'setting_icon_url', 'field_value' => '', 'other' => ''));
			add_settings_field('contact_form_slider-setting_animation', esc_html__( 'Animation', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_select'), 'contact_form_slider_styles', 'contact_form_slider_styles-section', array('field' => 'setting_animation', 'field_value' => '', 'other' => 'animation'));
			add_settings_field('contact_form_slider-setting_reverseheader', esc_html__( 'Reverse Header Blocks', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_radio'), 'contact_form_slider_styles', 'contact_form_slider_styles-section', array('field' => 'setting_reverseheader', 'field_value' => '', 'options' => array(esc_html__( 'No', W8CONTACT_FORM_TEXT_DOMAIN )=>"off",esc_html__( 'Yes', W8CONTACT_FORM_TEXT_DOMAIN )=>"on"), 'other' => ''));
			add_settings_field('contact_form_slider-setting_height', esc_html__( 'Height', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_radio'), 'contact_form_slider_styles', 'contact_form_slider_styles-section', array('field' => 'setting_height', 'field_value' => '', 'options' => array(esc_html__( 'Full', W8CONTACT_FORM_TEXT_DOMAIN )=>"full",esc_html__( 'Normal', W8CONTACT_FORM_TEXT_DOMAIN )=>"normal"), 'other' => ''));
			add_settings_field('contact_form_slider-setting_bganim', esc_html__( 'Background Animation', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_select'), 'contact_form_slider_styles', 'contact_form_slider_styles-section', array('field' => 'setting_bganim', 'field_value' => '', 'other' => 'bganim'));
			add_settings_field('contact_form_slider-setting_bgtarget', esc_html__( 'Background Animation Target', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_text'), 'contact_form_slider_styles', 'contact_form_slider_styles-section', array('field' => 'setting_bgtarget', 'field_value' => '', 'other' => 'size="70" placeholder="#page" class="cfstooltip" data-title="Use this option if Background Animation has conflicts with your Theme. Specify the target div and the plugin will use as a background container."'));
			add_settings_field('contact_form_slider-setting_excludeelements', esc_html__( 'Exclude Elements from Animation', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_text'), 'contact_form_slider_styles', 'contact_form_slider_styles-section', array('field' => 'setting_excludeelements', 'field_value' => '', 'other' => 'size="70" placeholder="#page" class="cfstooltip" data-title="Comma separated list of IDs and classes to exclude HTML elements from the Background Animation. Use it if you have a conflict with a Navigation Bar or any other elements."'));
			add_settings_field('contact_form_slider-setting_scheme', esc_html__( 'Style', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_select'), 'contact_form_slider_styles', 'contact_form_slider_styles-section', array('field' => 'setting_scheme', 'field_value' => '', 'other' => 'scheme'));
			add_settings_field('contact_form_slider-setting_skin', esc_html__( 'Skin', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_select'), 'contact_form_slider_styles', 'contact_form_slider_styles-section', array('field' => 'setting_skin', 'field_value' => '', 'other' => 'skin'));
			add_settings_field('contact_form_slider-setting_photostyle', esc_html__( 'Photo Style', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_select'), 'contact_form_slider_styles', 'contact_form_slider_styles-section', array('field' => 'setting_photostyle', 'field_value' => '', 'other' => 'photostyle'));
			add_settings_field('contact_form_slider-setting_photoborder', esc_html__( 'Photo Border Color', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_radio'), 'contact_form_slider_styles', 'contact_form_slider_styles-section', array('field' => 'setting_photoborder', 'field_value' => '', 'options' => array(esc_html__( 'Disabled', W8CONTACT_FORM_TEXT_DOMAIN )=>"off","colorpicker"=>"colorpicker"), 'other' => '1'));
			add_settings_field('contact_form_slider-setting_shake', esc_html__( 'Icon animation', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_select'), 'contact_form_slider_styles', 'contact_form_slider_styles-section', array('field' => 'setting_shake', 'field_value' => '', 'other' => 'shake'));
			add_settings_field('contact_form_slider-setting_fontfamily', esc_html__( 'Font Family', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_select'), 'contact_form_slider_styles', 'contact_form_slider_styles-section', array('field' => 'setting_fontfamily', 'field_value' => '', 'other' => 'googlefonts'));
			add_settings_field('contact_form_slider-setting_headerfontsize', esc_html__( 'Name Font Size', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_text'), 'contact_form_slider_styles', 'contact_form_slider_styles-section', array('field' => 'setting_headerfontsize', 'field_value' => '', 'other' => 'fontslider'));
			add_settings_field('contact_form_slider-setting_subheaderfontsize', esc_html__( 'Title Font Size', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_text'), 'contact_form_slider_styles', 'contact_form_slider_styles-section', array('field' => 'setting_subheaderfontsize', 'field_value' => '', 'other' => 'fontslider'));
			add_settings_field('contact_form_slider-setting_pfontsize', esc_html__( 'Description Font Size', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_text'), 'contact_form_slider_styles', 'contact_form_slider_styles-section', array('field' => 'setting_pfontsize', 'field_value' => '', 'other' => 'fontslider'));
			add_settings_field('contact_form_slider-setting_fieldfontsize', esc_html__( 'Fields Font Size', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_text'), 'contact_form_slider_styles', 'contact_form_slider_styles-section', array('field' => 'setting_fieldfontsize', 'field_value' => '', 'other' => 'fontslider'));
			add_settings_field('contact_form_slider-setting_buttonfontsize', esc_html__( 'Button Font Size', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_text'), 'contact_form_slider_styles', 'contact_form_slider_styles-section', array('field' => 'setting_buttonfontsize', 'field_value' => '', 'other' => 'fontslider'));
			add_settings_field('contact_form_slider-setting_headerfontweight', esc_html__( 'Name Font Weight', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_radio'), 'contact_form_slider_styles', 'contact_form_slider_styles-section', array('field' => 'setting_headerfontweight', 'field_value' => '', 'options' => array(esc_html__( 'Normal', W8CONTACT_FORM_TEXT_DOMAIN )=>"normal",esc_html__( 'Bold', W8CONTACT_FORM_TEXT_DOMAIN )=>"bold"), 'other' => ''));
			add_settings_field('contact_form_slider-setting_subheaderfontweight', esc_html__( 'Title Font Weight', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_radio'), 'contact_form_slider_styles', 'contact_form_slider_styles-section', array('field' => 'setting_subheaderfontweight', 'field_value' => '', 'options' => array(esc_html__( 'Normal', W8CONTACT_FORM_TEXT_DOMAIN )=>"normal",esc_html__( 'Bold', W8CONTACT_FORM_TEXT_DOMAIN )=>"bold"), 'other' => ''));
			add_settings_field('contact_form_slider-setting_pfontweight', esc_html__( 'Description Font Weight', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_radio'), 'contact_form_slider_styles', 'contact_form_slider_styles-section', array('field' => 'setting_pfontweight', 'field_value' => '', 'options' => array(esc_html__( 'Normal', W8CONTACT_FORM_TEXT_DOMAIN )=>"normal",esc_html__( 'Bold', W8CONTACT_FORM_TEXT_DOMAIN )=>"bold"), 'other' => ''));
			add_settings_field('contact_form_slider-setting_fieldfontweight', esc_html__( 'Fields Font Weight', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_radio'), 'contact_form_slider_styles', 'contact_form_slider_styles-section', array('field' => 'setting_fieldfontweight', 'field_value' => '', 'options' => array(esc_html__( 'Normal', W8CONTACT_FORM_TEXT_DOMAIN )=>"normal",esc_html__( 'Bold', W8CONTACT_FORM_TEXT_DOMAIN )=>"bold"), 'other' => ''));
			add_settings_field('contact_form_slider-setting_buttonfontweight', esc_html__( 'Button Font Weight', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_radio'), 'contact_form_slider_styles', 'contact_form_slider_styles-section', array('field' => 'setting_buttonfontweight', 'field_value' => '', 'options' => array(esc_html__( 'Normal', W8CONTACT_FORM_TEXT_DOMAIN )=>"normal",esc_html__( 'Bold', W8CONTACT_FORM_TEXT_DOMAIN )=>"bold"), 'other' => ''));
			add_settings_field('contact_form_slider-setting_background', esc_html__( 'Background', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_radio'), 'contact_form_slider_styles', 'contact_form_slider_styles-section', array('field' => 'setting_background', 'field_value' => '', 'options' => array(esc_html__( 'Theme Default', W8CONTACT_FORM_TEXT_DOMAIN )=>"off","colorpicker"=>"colorpicker"), 'other' => '2'));
			add_settings_field('contact_form_slider-setting_defaultcolor', esc_html__( 'Default Text Color', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_radio'), 'contact_form_slider_styles', 'contact_form_slider_styles-section', array('field' => 'setting_defaultcolor', 'field_value' => '', 'options' => array(esc_html__( 'Theme Default', W8CONTACT_FORM_TEXT_DOMAIN )=>"off","colorpicker"=>"colorpicker"), 'other' => '5'));
			add_settings_field('contact_form_slider-setting_button_background', esc_html__( 'Submit Button Background', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_radio'), 'contact_form_slider_styles', 'contact_form_slider_styles-section', array('field' => 'setting_button_background', 'field_value' => '', 'options' => array(esc_html__( 'Theme Default', W8CONTACT_FORM_TEXT_DOMAIN )=>"off","colorpicker"=>"colorpicker"), 'other' => '3'));
			add_settings_field('contact_form_slider-setting_button_background_hover', esc_html__( 'Submit Button Background Hover', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_radio'), 'contact_form_slider_styles', 'contact_form_slider_styles-section', array('field' => 'setting_button_background_hover', 'field_value' => '', 'options' => array(esc_html__( 'Theme Default', W8CONTACT_FORM_TEXT_DOMAIN )=>"off","colorpicker"=>"colorpicker"), 'other' => '4'));
			add_settings_field('contact_form_slider-setting_buttoncolor', esc_html__( 'Submit Button Text Color', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_radio'), 'contact_form_slider_styles', 'contact_form_slider_styles-section', array('field' => 'setting_buttoncolor', 'field_value' => '', 'options' => array(esc_html__( 'Theme Default', W8CONTACT_FORM_TEXT_DOMAIN )=>"off","colorpicker"=>"colorpicker"), 'other' => '6'));

			// register your custom settings - translation settings
			register_setting('contact_form_slider_translations-group', 'setting_placeholder_name');
			register_setting('contact_form_slider_translations-group', 'setting_placeholder_email');
			register_setting('contact_form_slider_translations-group', 'setting_placeholder_message');
			register_setting('contact_form_slider_translations-group', 'setting_placeholder_captcha');
			register_setting('contact_form_slider_translations-group', 'setting_placeholder_sendcopy');
			register_setting('contact_form_slider_translations-group', 'setting_sendbutton_text');
			register_setting('contact_form_slider_translations-group', 'setting_success_message');
			register_setting('contact_form_slider_translations-group', 'setting_failed_text');
			register_setting('contact_form_slider_translations-group', 'setting_default_translation');
			// add your settings section
			add_settings_section('contact_form_slider_translations-section', '', array(&$this, 'settings_section_contact_form_slider'), 'contact_form_slider_translations');
			add_settings_field('contact_form_slider-setting_placeholder_name', esc_html__( 'Placeholder for name field', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_text'), 'contact_form_slider_translations', 'contact_form_slider_translations-section', array('field' => 'setting_placeholder_name', 'field_value' => '', 'other' => 'size="70"'));
			add_settings_field('contact_form_slider-setting_placeholder_email', esc_html__( 'Placeholder for email field', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_text'), 'contact_form_slider_translations', 'contact_form_slider_translations-section', array('field' => 'setting_placeholder_email', 'field_value' => '', 'other' => 'size="70"'));
			add_settings_field('contact_form_slider-setting_placeholder_message', esc_html__( 'Placeholder for message field', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_text'), 'contact_form_slider_translations', 'contact_form_slider_translations-section', array('field' => 'setting_placeholder_message', 'field_value' => '', 'other' => 'size="70"'));
			add_settings_field('contact_form_slider-setting_placeholder_captcha', esc_html__( 'Placeholder for captcha field', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_text'), 'contact_form_slider_translations', 'contact_form_slider_translations-section', array('field' => 'setting_placeholder_captcha', 'field_value' => '', 'other' => 'size="70"'));
			add_settings_field('contact_form_slider-setting_placeholder_sendcopy', esc_html__( 'Text for Send Copy checkbox', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_text'), 'contact_form_slider_translations', 'contact_form_slider_translations-section', array('field' => 'setting_placeholder_sendcopy', 'field_value' => '', 'other' => 'size="70"'));
			add_settings_field('contact_form_slider-setting_sendbutton_text', esc_html__( 'Send button text', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_text'), 'contact_form_slider_translations', 'contact_form_slider_translations-section', array('field' => 'setting_sendbutton_text', 'field_value' => '', 'other' => 'size="70"'));
			add_settings_field('contact_form_slider-setting_success_message', esc_html__( 'Success message', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_text'), 'contact_form_slider_translations', 'contact_form_slider_translations-section', array('field' => 'setting_success_message', 'field_value' => '', 'other' => 'size="70"'));
			add_settings_field('contact_form_slider-setting_failed_text', esc_html__( 'Failed message', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_text'), 'contact_form_slider_translations', 'contact_form_slider_translations-section', array('field' => 'setting_failed_text', 'field_value' => '', 'other' => 'size="70"'));
			add_settings_field('contact_form_slider-setting_default_translation', esc_html__( 'Use WordPress Translation Engine', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_radio'), 'contact_form_slider_translations', 'contact_form_slider_translations-section', array('field' => 'setting_default_translation', 'field_value' => '', 'options' => array(esc_html__( 'No', W8CONTACT_FORM_TEXT_DOMAIN )=>"off",esc_html__( 'Yes', W8CONTACT_FORM_TEXT_DOMAIN )=>"on"), 'other' => ''));
			// register your custom settings - contacts settings
			register_setting('contact_form_slider_contacts-group', 'setting_contacts');
			add_settings_section('contact_form_slider_contacts-section', '', array(&$this, 'settings_section_contact_form_slider'), 'contact_form_slider_contacts');
			add_settings_field('contact_form_slider-setting_placeholder_name', '', array(&$this, 'settings_field_input_hidden'), 'contact_form_slider_contacts', 'contact_form_slider_contacts-section', array('field' => 'setting_contacts', 'field_value' => '', 'other' => 'nodefault'));
			// register your custom settings - autoreply settings
			register_setting('contact_form_slider_autoreply-group', 'setting_global_autoreply');
			register_setting('contact_form_slider_autoreply-group', 'setting_global_arsendername');
			register_setting('contact_form_slider_autoreply-group', 'setting_global_arsenderemail');
			register_setting('contact_form_slider_autoreply-group', 'setting_global_arsendermessage');
			// add your settings section
			add_settings_section('contact_form_slider_autoreply-section', '', array(&$this, 'settings_section_contact_form_slider'), 'contact_form_slider_autoreply');
			add_settings_field('contact_form_slider-setting_global_autoreply', esc_html__( 'Global Auto-Reply', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_radio'), 'contact_form_slider_autoreply', 'contact_form_slider_autoreply-section', array('field' => 'setting_global_autoreply', 'field_value' => '', 'options' => array(esc_html__( 'On', W8CONTACT_FORM_TEXT_DOMAIN )=>"on",esc_html__( 'Off', W8CONTACT_FORM_TEXT_DOMAIN )=>"off"), 'other' => ''));
			add_settings_field('contact_form_slider-setting_global_arsendername', esc_html__( 'Sender Name', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_text'), 'contact_form_slider_autoreply', 'contact_form_slider_autoreply-section', array('field' => 'setting_global_arsendername', 'field_value' => '', 'other' => 'size="70"'));
			add_settings_field('contact_form_slider-setting_global_arsenderemail', esc_html__( 'Sender Email Address', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_text'), 'contact_form_slider_autoreply', 'contact_form_slider_autoreply-section', array('field' => 'setting_global_arsenderemail', 'field_value' => '', 'other' => 'size="40"'));
			add_settings_field('contact_form_slider-setting_global_arsendermessage', esc_html__( 'Auto-Reply Message', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_textarea'), 'contact_form_slider_autoreply', 'contact_form_slider_autoreply-section', array('field' => 'setting_global_arsendermessage', 'field_value' => '', 'other' => 'rows="10" cols="70"'));

			// register your custom settings - custom CSS settings
			register_setting('contact_form_slider_customcss-group', 'setting_w8cfs_customcss');
			// add your settings section
			add_settings_section('contact_form_slider_customcss-section', '', array(&$this, 'settings_section_contact_form_slider'), 'contact_form_slider_customcss');
			add_settings_field('contact_form_slider-setting_w8cfs_customcss', esc_html__( 'Enter you custom CSS code', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_textarea'), 'contact_form_slider_customcss', 'contact_form_slider_customcss-section', array('field' => 'setting_w8cfs_customcss', 'field_value' => '', 'other' => 'rows="20" cols="100" placeholder=".class {
	color: #000000;
}"'));

			// register your custom settings - logs settings
			register_setting('contact_form_slider_logs-group', 'setting_enable_logs');
			register_setting('contact_form_slider_logs-group', 'setting_keep_logs');
			// add your settings section
			add_settings_section('contact_form_slider_logs-section', '', array(&$this, 'settings_section_contact_form_slider'), 'contact_form_slider_logs');
			add_settings_field('contact_form_slider-setting_enable_logs', esc_html__( 'Logging Status', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_radio'), 'contact_form_slider_logs', 'contact_form_slider_logs-section', array('field' => 'setting_enable_logs', 'field_value' => '', 'options' => array(esc_html__( 'On', W8CONTACT_FORM_TEXT_DOMAIN )=>"on",esc_html__( 'Off', W8CONTACT_FORM_TEXT_DOMAIN )=>"off"), 'other' => '', 'extrahtml' => '<div class="arrow_box"><p>' . esc_html__( 'Enable logging to save interactions with the contact form. Use it for testing purposes.', W8CONTACT_FORM_TEXT_DOMAIN ) . '</p></div>'));
			add_settings_field('contact_form_slider-setting_keep_logs', esc_html__( 'Keep Logs', W8CONTACT_FORM_TEXT_DOMAIN ), array(&$this, 'settings_field_input_radio'), 'contact_form_slider_logs', 'contact_form_slider_logs-section', array('field' => 'setting_keep_logs', 'field_value' => '', 'options' => array(esc_html__( 'On', W8CONTACT_FORM_TEXT_DOMAIN )=>"on",esc_html__( 'Off', W8CONTACT_FORM_TEXT_DOMAIN )=>"off"), 'other' => '', 'extrahtml' => '<div class="arrow_box"><p>' . esc_html__( 'Keep the logs after uninstall the plugin. Use it before updating the plugin to the new version.', W8CONTACT_FORM_TEXT_DOMAIN ) . '</p></div>'));
		}
		/**
		* This function provides special inputs for settings fields
		**/
		public function settings_field_input_special($args)
			{		
			$other = $args['other'];
			$options = $args['options'];
			$key = '';	
			// Get the field name from the $args array or get the value of this setting
			$field = $args['field'];
			if ($args['field_value']) $value = $args['field_value'];
			else $value = get_option($field);
			foreach($options as $key=>$opt) {
			if ($value==$opt OR (!$value AND $opt=="3")) $selected = 'checked="true"';
			else $selected = "";
			echo sprintf('<input type="radio" name="%s" id="%s%s" '.$selected.' value="%s" /><label for="%s%s"> '.$key.'</label><br />', $field, $field, $opt, $opt, $field, $opt);
			}
		}
		/**
		* This function provides radio inputs for settings fields
		**/
        public function settings_field_input_radio($args)
        {
			$key = '';
             $other = $args['other'];
            $options = $args['options'];
 			// Get the field name from the $args array or get the value of this setting
			$field = $args['field'];
			if ($args['field_value']) $value = $args['field_value'];
			else $value = get_option($field);
            // echo a proper input type="radio"
			foreach($options as $key=>$opt) 
			{
				if ($key=='colorpicker')
				{
					if ($value!="off") $selected = 'checked="true"';
					else $selected = "";
					echo sprintf('<input type="radio" class="%s-colorpicker radio-colorpicker' . $other . '" name="%s" id="%s%s" '.$selected.' value="%s" /> <label for="%s%s"> Choose color: <div class="preview' . $other . ' preview" style="background-color:%s"></div><div class="colorpicker' . $other . ' colorpicker"><div><canvas id="picker' . $other . '" class="picker" var="' . $other . '" width="256" height="256"></canvas></div><div class="controls"><div><label>R</label> <input type="text" disabled="true" id="rVal' . $other . '" /></div><div><label>G</label> <input type="text" disabled="true" id="gVal' . $other . '" /></div><div><label>B</label> <input type="text" disabled="true" id="bVal' . $other . '" /></div><div><label>RGB</label> <input type="text" disabled="true" id="rgbVal' . $other . '" /></div><div><label>HEX</label> <input type="text" id="hexVal' . $other . '" class="hexvalue" /></div></div></div></label>', $field, $field, $field, $opt, $value, $field, $opt, $value);
				}
				else
				{
					if ($value==$opt OR (!$value AND $opt=="off")) $selected = 'checked="true"';
					else $selected = "";
					echo sprintf('<input type="radio" name="%s" id="%s%s" '.$selected.' value="%s" /> <label for="%s%s"> '.$key.'</label> ', $field, $field, $opt, $opt, $field, $opt);
				}
			}
			if (isset($args['extrahtml'])) echo($args['extrahtml']);
		}
		/**
		* This function provides hidden inputs for settings fields
		**/
		public function settings_field_input_hidden($args)
		{
			$other = $args['other'];
			// Get the field name from the $args array or get the value of this setting
			$field = $args['field'];
			if ($args['field_value']) $value = $args['field_value'];
			else $value = get_option($field);
			// echo a proper input type="text"
				if ($other=='nodefault') echo sprintf('<input type="hidden" name="%s" id="%s" value=\"\" />', $field, $field);
				else echo sprintf('<input type="hidden" name="%s" id="%s" value=\"%s\" />', $field, $field, $value);
		}
		/**
		* This function provides text inputs for settings fields
		**/
		public function settings_field_input_text($args)
		{
			$other = $args['other'];
			// Get the field name from the $args array or get the value of this setting
			$field = $args['field'];
			if ($args['field_value']) $value = $args['field_value'];
			else $value = get_option($field);
			// echo a proper input type="text"
			if ($args['other']=='slider')
			{
				echo sprintf('<input type="text" readonly="true" class="input-slider %s-slider" name="%s" id="%s" value="%s" /><div data-min="5" data-max="95" data-value="%s" data-input="%s-slider" class="sliderpanel" id="%s"></div>', $field, $field, $field, $value, $value, $field, $field);
			}
			elseif ($args['other']=='fontslider')
			{
				echo sprintf('<input type="text" readonly="true" class="input-slider %s-slider" name="%s" id="%s" value="%s" /><div data-min="5" data-max="95" data-value="%s" data-input="%s-slider" class="fontsliderpanel" id="%s"></div>', $field, $field, $field, $value, $value, $field, $field);
			}
			elseif($args['field']=="setting_sendermail"||$args['field']=="setting_global_arsenderemail")
			{
				if (!empty($other)) echo sprintf('<input type="text" name="%s" id="%s" value="%s" %s />@'.str_replace("www.","",$_SERVER['HTTP_HOST']), $field, $field, $value, $other);
				else echo sprintf('<input type="text" name="%s" id="%s" value="%s" />@'.str_replace("www.","",$_SERVER['HTTP_HOST']), $field, $field, $value);
			}
			else
			{
				if (!empty($other)) echo sprintf('<input type="text" name="%s" id="%s" value="%s" %s />', $field, $field, $value, $other);
				else echo sprintf('<input type="text" name="%s" id="%s" value="%s" />', $field, $field, $value);
			}
			if (isset($args['extrahtml'])) echo($args['extrahtml']);
		}		
		/**
		* This function provides file upload inputs for settings fields
		**/
		public function settings_field_input_upload($args)
		{
			$other = $args['other'];
			// Get the field name from the $args array or get the value of this setting
			$field = $args['field'];
			if ($args['field_value']) $value = $args['field_value'];
			else $value = get_option($field);
			// echo a proper input type="file"
		if (empty($value)) $result = '<div class="imageelement"><div id="uploaded_'.$field.'"><input id="'.$field.'-upload" class="button" type="button" value="'.esc_html__( 'Add Image', W8CONTACT_FORM_TEXT_DOMAIN ).'" /></div></div>';
		else $result = '<div class="imageelement"><div id="uploaded_'.$field.'"><div class="'.$field.'_container"><img src="'.$value.'"><input type="hidden" class="'.$field.'-image" name="'.$field.'" value="'.$value.'"><div><input class="remove_customimage_button button" data-addid="'.$field.'" id="'.$field.'-remove" type="button" value="'.esc_html__( 'REMOVE', W8CONTACT_FORM_TEXT_DOMAIN ).'" /></div></div></div></div>';
		print($result.'<script type="text/javascript">jQuery(function(){jQuery("#'.$field.'-upload" ).pmu({"button":"#'.$field.'-upload","target":"#uploaded_'.$field.'","container":"<div class=\"'.$field.'_container\"><img src=\"[content]\"><input type=\"hidden\" class=\"'.$field.'_image\" name=\"'.$field.'\" value=\"objImageUrl\"><div><input class=\"remove_customimage_button button\" id=\"'.$field.'-remove\" type=\"button\" data-addid=\"'.$field.'\" value=\"'.esc_html__( 'REMOVE', W8CONTACT_FORM_TEXT_DOMAIN ).'\" /></div></div>","mode":"insert","indexcontainer":"","type":"single","callback":function(){}});jQuery(document).on("click","#'.$field.'-remove",function(){jQuery("#uploaded_'.$field.'").html("<div class=\"imageelement\"><div id=\"uploaded_'.$field.'\"><input id=\"'.$field.'-upload\" class=\"button\" type=\"button\" value=\"'.esc_html__( 'Add Image', W8CONTACT_FORM_TEXT_DOMAIN ).'\" /></div></div>");return false;});})</script>');
		}
		/**
		* This function provides textarea inputs for settings fields
		**/
		public function settings_field_input_textarea($args)
		{
			$other = $args['other'];
			// Get the field name from the $args array or get the value of this setting
			$field = $args['field'];
			if ($args['field_value']) $value = $args['field_value'];
			else $value = get_option($field);
			// echo a proper input type="textarea"
			if (!empty($other)) echo sprintf('<textarea name="%s" id="%s" %s />%s</textarea>', $field, $field, $other, $value);
			else echo sprintf('<textarea name="%s" id="%s" />%s</textarea>', $field, $field, $value);
			if ($field=="setting_global_arsendermessage") print('<br>'.esc_html__('Usable Tags:', W8CONTACT_FORM_TEXT_DOMAIN).' {name} {message} {subject} {email}');
		}
		/**
		* This function provides select inputs for settings fields
		**/
		public function settings_field_input_select($args)
		{
			// Get the field name from the $args array or get the value of this setting
			$field = $args['field'];
			if ($args['field_value']) $value = $args['field_value'];
			else $value = get_option($field);
			if ($args['other']=='scheme')
			{
			echo sprintf('<select name="%s" id="%s" class="wcf-form-select">', $field, $field);
					echo('<option value="light" '.selected($value,'light',false).'>'.esc_html__( 'Light', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
					echo('<option value="dark" '.selected($value,'dark',false).'>'.esc_html__( 'Dark', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
				echo('</select>');
			}
			elseif ($args['other']=='bganim')
			{
			echo sprintf('<select name="%s" id="%s" class="wcf-form-select">', $field, $field);
					echo('<option value="disabled" '.selected($value,'disabled',false).'>'.esc_html__( 'Disabled', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
					echo('<option value="cfs_moveright" '.selected($value,'cfs_moveright',false).'>'.esc_html__( 'Move Right', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
					echo('<option value="cfs_moveleft" '.selected($value,'cfs_moveleft',false).'>'.esc_html__( 'Move Left', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
					echo('<option value="cfs_moveright_zoomout" '.selected($value,'cfs_moveright_zoomout',false).'>'.esc_html__( 'Move Right ZoomOut', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
					echo('<option value="cfs_moveleft_zoomout" '.selected($value,'cfs_moveleft_zoomout',false).'>'.esc_html__( 'Move Left ZoomOut', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
					echo('<option value="cfs_movebottomright_zoomout" '.selected($value,'cfs_movebottomright_zoomout',false).'>'.esc_html__( 'Move Bottom-Right ZoomOut', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
					echo('<option value="cfs_movebottomleft_zoomout" '.selected($value,'cfs_movebottomleft_zoomout',false).'>'.esc_html__( 'Move Bottom-Left ZoomOut', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
					echo('<option value="cfs_movetopright_zoomout" '.selected($value,'cfs_movetopright_zoomout',false).'>'.esc_html__( 'Move Top-Right ZoomOut', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
					echo('<option value="cfs_movetopleft_zoomout" '.selected($value,'cfs_movetopleft_zoomout',false).'>'.esc_html__( 'Move Top-Left ZoomOut', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
					echo('<option value="cfs_perspectiveleft" '.selected($value,'cfs_perspectiveleft',false).'>'.esc_html__( 'Perspective Left', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
					echo('<option value="cfs_perspectiveright" '.selected($value,'cfs_perspectiveright',false).'>'.esc_html__( 'Perspective Right', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
				echo('</select>');
			}
			elseif ($args['other']=='skin')
			{
			echo sprintf('<select name="%s" id="%s" class="wcf-form-select">', $field, $field);
					echo('<option value="default" '.selected($value,'default',false).'>'.esc_html__( 'Default', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
					echo('<option value="minimal" '.selected($value,'minimal',false).'>'.esc_html__( 'Minimal', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
					echo('<option value="woods" '.selected($value,'woods',false).'>'.esc_html__( 'Wood', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
					echo('<option value="blue-textil" '.selected($value,'blue-textil',false).'>'.esc_html__( 'Blue Textil', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
					echo('<option value="blue-tiles" '.selected($value,'blue-tiles',false).'>'.esc_html__( 'Blue Tiles', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
					echo('<option value="blurry-blue" '.selected($value,'blurry-blue',false).'>'.esc_html__( 'Blurry Blue', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
					echo('<option value="bubble-soap" '.selected($value,'bubble-soap',false).'>'.esc_html__( 'Bubble Soap', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
					echo('<option value="cracks" '.selected($value,'cracks',false).'>'.esc_html__( 'Cracks', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
					echo('<option value="elegant-darkblue" '.selected($value,'elegant-darkblue',false).'>'.esc_html__( 'Elegant Dark Blue', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
					echo('<option value="flower-lightblue" '.selected($value,'flower-lightblue',false).'>'.esc_html__( 'Flower Light Blue', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
					echo('<option value="green" '.selected($value,'green',false).'>'.esc_html__( 'Green', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
					echo('<option value="stripes-orange" '.selected($value,'stripes-orange',false).'>'.esc_html__( 'Stripes Orange', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
					echo('<option value="curved-wood" '.selected($value,'curved-wood',false).'>'.esc_html__( 'Curved Wood', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
					echo('<option value="decorated" '.selected($value,'decorated',false).'>'.esc_html__( 'Decorated', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
					echo('<option value="elegant-black" '.selected($value,'elegant-black',false).'>'.esc_html__( 'Elegant Black', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
					echo('<option value="lines" '.selected($value,'lines',false).'>'.esc_html__( 'Lines', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
					echo('<option value="pages1" '.selected($value,'pages1',false).'>'.esc_html__( 'Pages 1', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
					echo('<option value="pages2" '.selected($value,'pages2',false).'>'.esc_html__( 'Pages 2', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
					echo('<option value="wooden-floor" '.selected($value,'wooden-floor',false).'>'.esc_html__( 'Wooden Floor', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
				echo('</select>');
			}
			elseif ($args['other']=='animation')
			{
			echo sprintf('<select name="%s" id="%s" class="wcf-form-select">', $field, $field);
					echo('<option value="Quad" '.selected($value,'Quad',false).'>Quad</option>');
					echo('<option value="Cubic" '.selected($value,'Cubic',false).'>Cubic</option>');
					echo('<option value="Quart" '.selected($value,'Quart',false).'>Quart</option>');
					echo('<option value="Quint" '.selected($value,'Quint',false).'>Quint</option>');
					echo('<option value="Expo" '.selected($value,'Expo',false).'>Expo</option>');
					echo('<option value="Sine" '.selected($value,'Sine',false).'>Sine</option>');
					echo('<option value="Circ" '.selected($value,'Circ',false).'>Circ</option>');
					echo('<option value="Back" '.selected($value,'Back',false).'>Back</option>');
				echo('</select>');
			}
			elseif ($args['other']=='iconimg')
			{
			echo sprintf('<select name="%s" id="%s" class="w8image-picker-select" class="wcf-form-select">', $field, $field);
					echo('<option data-img-src="' . plugins_url( '/templates/assets/img/icon-left.png' , __FILE__ ) . '" value="" ' . selected( $value, '', false ) . '>Icon 1</option>');
					echo('<option data-img-src="' . plugins_url( '/templates/assets/img/icon2-left.png' , __FILE__ ) . '" value="2" ' . selected( $value, '2', false ) . '>Icon 2</option>');
					echo('<option data-img-src="' . plugins_url( '/templates/assets/img/icon3-left.png' , __FILE__ ) . '" value="3" ' . selected( $value, '3', false ) . '>Icon 3</option>');
					echo('<option data-img-src="' . plugins_url( '/templates/assets/img/icon4-left.png' , __FILE__ ) . '" value="4" ' . selected( $value, '4', false ) . '>Icon 4</option>');
					echo('<option data-img-src="' . plugins_url( '/templates/assets/img/icon5-left.png' , __FILE__ ) . '" value="5" ' . selected( $value, '5', false ) . '>Icon 5</option>');
					echo('<option data-img-src="' . plugins_url( '/templates/assets/img/icon6-left.png' , __FILE__ ) . '" value="6" ' . selected( $value, '6', false ) . '>Icon 6</option>');
					echo('<option data-img-src="' . plugins_url( '/templates/assets/img/icon7-left.png' , __FILE__ ) . '" value="7" ' . selected( $value, '7', false ) . '>Icon 7</option>');
				echo('</select>');
			}
			elseif ($args['other']=="googlefonts")
			{
			echo sprintf('<select name="%s" id="%s" class="wcf-form-select">', $field, $field);
							echo('<option '.selected( $value, '', false ).' value="">Default</option><option '.selected( $value, 'ABeeZee', false ).' value="ABeeZee">ABeeZee</option><option '.selected( $value, 'Abel', false ).' value="Abel">Abel</option><option '.selected( $value, 'Abril Fatface', false ).' value="Abril Fatface">Abril Fatface</option><option '.selected( $value, 'Aclonica', false ).' value="Aclonica">Aclonica</option><option '.selected( $value, 'Acme', false ).' value="Acme">Acme</option><option '.selected( $value, 'Actor', false ).' value="Actor">Actor</option><option '.selected( $value, 'Adamina', false ).' value="Adamina">Adamina</option><option '.selected( $value, 'Advent Pro', false ).' value="Advent Pro">Advent Pro</option><option '.selected( $value, 'Aguafina Script', false ).' value="Aguafina Script">Aguafina Script</option><option '.selected( $value, 'Akronim', false ).' value="Akronim">Akronim</option><option '.selected( $value, 'Aladin', false ).' value="Aladin">Aladin</option><option '.selected( $value, 'Aldrich', false ).' value="Aldrich">Aldrich</option><option '.selected( $value, 'Alef', false ).' value="Alef">Alef</option><option '.selected( $value, 'Alegreya', false ).' value="Alegreya">Alegreya</option><option '.selected( $value, 'Alegreya SC', false ).' value="Alegreya SC">Alegreya SC</option><option '.selected( $value, 'Alex Brush', false ).' value="Alex Brush">Alex Brush</option><option '.selected( $value, 'Alfa Slab One', false ).' value="Alfa Slab One">Alfa Slab One</option><option '.selected( $value, 'Alice', false ).' value="Alice">Alice</option><option '.selected( $value, 'Alike', false ).' value="Alike">Alike</option><option '.selected( $value, 'Alike Angular', false ).' value="Alike Angular">Alike Angular</option><option '.selected( $value, 'Allan', false ).' value="Allan">Allan</option><option '.selected( $value, 'Allerta', false ).' value="Allerta">Allerta</option><option '.selected( $value, 'Allerta Stencil', false ).' value="Allerta Stencil">Allerta Stencil</option><option '.selected( $value, 'Allura', false ).' value="Allura">Allura</option><option '.selected( $value, 'Almendra', false ).' value="Almendra">Almendra</option><option '.selected( $value, 'Almendra Display', false ).' value="Almendra Display">Almendra Display</option><option '.selected( $value, 'Almendra SC', false ).' value="Almendra SC">Almendra SC</option><option '.selected( $value, 'Amarante', false ).' value="Amarante">Amarante</option><option '.selected( $value, 'Amaranth', false ).' value="Amaranth">Amaranth</option><option '.selected( $value, 'Amatic SC', false ).' value="Amatic SC">Amatic SC</option><option '.selected( $value, 'Amethysta', false ).' value="Amethysta">Amethysta</option><option '.selected( $value, 'Anaheim', false ).' value="Anaheim">Anaheim</option><option '.selected( $value, 'Andada', false ).' value="Andada">Andada</option><option '.selected( $value, 'Andika', false ).' value="Andika">Andika</option><option '.selected( $value, 'Angkor', false ).' value="Angkor">Angkor</option><option '.selected( $value, 'Annie Use Your Telescope', false ).' value="Annie Use Your Telescope">Annie Use Your Telescope</option><option '.selected( $value, 'Anonymous Pro', false ).' value="Anonymous Pro">Anonymous Pro</option><option '.selected( $value, 'Antic', false ).' value="Antic">Antic</option><option '.selected( $value, 'Antic Didone', false ).' value="Antic Didone">Antic Didone</option><option '.selected( $value, 'Antic Slab', false ).' value="Antic Slab">Antic Slab</option><option '.selected( $value, 'Anton', false ).' value="Anton">Anton</option><option '.selected( $value, 'Arapey', false ).' value="Arapey">Arapey</option><option '.selected( $value, 'Arbutus', false ).' value="Arbutus">Arbutus</option><option '.selected( $value, 'Arbutus Slab', false ).' value="Arbutus Slab">Arbutus Slab</option><option '.selected( $value, 'Architects Daughter', false ).' value="Architects Daughter">Architects Daughter</option><option '.selected( $value, 'Archivo Black', false ).' value="Archivo Black">Archivo Black</option><option '.selected( $value, 'Archivo Narrow', false ).' value="Archivo Narrow">Archivo Narrow</option><option '.selected( $value, 'Arimo', false ).' value="Arimo">Arimo</option><option '.selected( $value, 'Arizonia', false ).' value="Arizonia">Arizonia</option><option '.selected( $value, 'Armata', false ).' value="Armata">Armata</option><option '.selected( $value, 'Artifika', false ).' value="Artifika">Artifika</option><option '.selected( $value, 'Arvo', false ).' value="Arvo">Arvo</option><option '.selected( $value, 'Asap', false ).' value="Asap">Asap</option><option '.selected( $value, 'Asset', false ).' value="Asset">Asset</option><option '.selected( $value, 'Astloch', false ).' value="Astloch">Astloch</option><option '.selected( $value, 'Asul', false ).' value="Asul">Asul</option><option '.selected( $value, 'Atomic Age', false ).' value="Atomic Age">Atomic Age</option><option '.selected( $value, 'Aubrey', false ).' value="Aubrey">Aubrey</option><option '.selected( $value, 'Audiowide', false ).' value="Audiowide">Audiowide</option><option '.selected( $value, 'Autour One', false ).' value="Autour One">Autour One</option><option '.selected( $value, 'Average', false ).' value="Average">Average</option><option '.selected( $value, 'Average Sans', false ).' value="Average Sans">Average Sans</option><option '.selected( $value, 'Averia Gruesa Libre', false ).' value="Averia Gruesa Libre">Averia Gruesa Libre</option><option '.selected( $value, 'Averia Libre', false ).' value="Averia Libre">Averia Libre</option><option '.selected( $value, 'Averia Sans Libre', false ).' value="Averia Sans Libre">Averia Sans Libre</option><option '.selected( $value, 'Averia Serif Libre', false ).' value="Averia Serif Libre">Averia Serif Libre</option><option '.selected( $value, 'Bad Script', false ).' value="Bad Script">Bad Script</option><option '.selected( $value, 'Balthazar', false ).' value="Balthazar">Balthazar</option><option '.selected( $value, 'Bangers', false ).' value="Bangers">Bangers</option><option '.selected( $value, 'Basic', false ).' value="Basic">Basic</option><option '.selected( $value, 'Battambang', false ).' value="Battambang">Battambang</option><option '.selected( $value, 'Baumans', false ).' value="Baumans">Baumans</option><option '.selected( $value, 'Bayon', false ).' value="Bayon">Bayon</option><option '.selected( $value, 'Belgrano', false ).' value="Belgrano">Belgrano</option><option '.selected( $value, 'Belleza', false ).' value="Belleza">Belleza</option><option '.selected( $value, 'BenchNine', false ).' value="BenchNine">BenchNine</option><option '.selected( $value, 'Bentham', false ).' value="Bentham">Bentham</option><option '.selected( $value, 'Berkshire Swash', false ).' value="Berkshire Swash">Berkshire Swash</option><option '.selected( $value, 'Bevan', false ).' value="Bevan">Bevan</option><option '.selected( $value, 'Bigelow Rules', false ).' value="Bigelow Rules">Bigelow Rules</option><option '.selected( $value, 'Bigshot One', false ).' value="Bigshot One">Bigshot One</option><option '.selected( $value, 'Bilbo', false ).' value="Bilbo">Bilbo</option><option '.selected( $value, 'Bilbo Swash Caps', false ).' value="Bilbo Swash Caps">Bilbo Swash Caps</option><option '.selected( $value, 'Bitter', false ).' value="Bitter">Bitter</option><option '.selected( $value, 'Black Ops One', false ).' value="Black Ops One">Black Ops One</option><option '.selected( $value, 'Bokor', false ).' value="Bokor">Bokor</option><option '.selected( $value, 'Bonbon', false ).' value="Bonbon">Bonbon</option><option '.selected( $value, 'Boogaloo', false ).' value="Boogaloo">Boogaloo</option><option '.selected( $value, 'Bowlby One', false ).' value="Bowlby One">Bowlby One</option><option '.selected( $value, 'Bowlby One SC', false ).' value="Bowlby One SC">Bowlby One SC</option><option '.selected( $value, 'Brawler', false ).' value="Brawler">Brawler</option><option '.selected( $value, 'Bree Serif', false ).' value="Bree Serif">Bree Serif</option><option '.selected( $value, 'Bubblegum Sans', false ).' value="Bubblegum Sans">Bubblegum Sans</option><option '.selected( $value, 'Bubbler One', false ).' value="Bubbler One">Bubbler One</option><option '.selected( $value, 'Buenard', false ).' value="Buenard">Buenard</option><option '.selected( $value, 'Butcherman', false ).' value="Butcherman">Butcherman</option><option '.selected( $value, 'Butterfly Kids', false ).' value="Butterfly Kids">Butterfly Kids</option><option '.selected( $value, 'Cabin', false ).' value="Cabin">Cabin</option><option '.selected( $value, 'Cabin Condensed', false ).' value="Cabin Condensed">Cabin Condensed</option><option '.selected( $value, 'Cabin Sketch', false ).' value="Cabin Sketch">Cabin Sketch</option><option '.selected( $value, 'Caesar Dressing', false ).' value="Caesar Dressing">Caesar Dressing</option><option '.selected( $value, 'Cagliostro', false ).' value="Cagliostro">Cagliostro</option><option '.selected( $value, 'Calligraffitti', false ).' value="Calligraffitti">Calligraffitti</option><option '.selected( $value, 'ABeeCamboZee', false ).' value="Cambo">Cambo</option><option '.selected( $value, 'Candal', false ).' value="Candal">Candal</option><option '.selected( $value, 'Cantarell', false ).' value="Cantarell">Cantarell</option><option '.selected( $value, 'Cantata One', false ).' value="Cantata One">Cantata One</option><option '.selected( $value, 'Cantora One', false ).' value="Cantora One">Cantora One</option><option '.selected( $value, 'Capriola', false ).' value="Capriola">Capriola</option><option '.selected( $value, 'Cardo', false ).' value="Cardo">Cardo</option><option '.selected( $value, 'Carme', false ).' value="Carme">Carme</option><option '.selected( $value, 'Carrois Gothic', false ).' value="Carrois Gothic">Carrois Gothic</option><option '.selected( $value, 'Carrois Gothic SC', false ).' value="Carrois Gothic SC">Carrois Gothic SC</option><option '.selected( $value, 'Carter One', false ).' value="Carter One">Carter One</option><option '.selected( $value, 'Caudex', false ).' value="Caudex">Caudex</option><option '.selected( $value, 'Cedarville Cursive', false ).' value="Cedarville Cursive">Cedarville Cursive</option><option '.selected( $value, 'Ceviche One', false ).' value="Ceviche One">Ceviche One</option><option '.selected( $value, 'Changa One', false ).' value="Changa One">Changa One</option><option '.selected( $value, 'Chango', false ).' value="Chango">Chango</option><option '.selected( $value, 'Chau Philomene One', false ).' value="Chau Philomene One">Chau Philomene One</option><option '.selected( $value, 'Chela One', false ).' value="Chela One">Chela One</option><option '.selected( $value, 'Chelsea Market', false ).' value="Chelsea Market">Chelsea Market</option><option '.selected( $value, 'Chenla', false ).' value="Chenla">Chenla</option><option '.selected( $value, 'Cherry Cream Soda', false ).' value="Cherry Cream Soda">Cherry Cream Soda</option><option '.selected( $value, 'Cherry Swash', false ).' value="Cherry Swash">Cherry Swash</option><option '.selected( $value, 'Chewy', false ).' value="Chewy">Chewy</option><option '.selected( $value, 'Chicle', false ).' value="Chicle">Chicle</option><option '.selected( $value, 'Chivo', false ).' value="Chivo">Chivo</option><option '.selected( $value, 'Cinzel', false ).' value="Cinzel">Cinzel</option><option '.selected( $value, 'Cinzel Decorative', false ).' value="Cinzel Decorative">Cinzel Decorative</option><option '.selected( $value, 'Clicker Script', false ).' value="Clicker Script">Clicker Script</option><option '.selected( $value, 'Coda', false ).' value="Coda">Coda</option><option '.selected( $value, 'Coda Caption', false ).' value="Coda Caption">Coda Caption</option><option '.selected( $value, 'Codystar', false ).' value="Codystar">Codystar</option><option '.selected( $value, 'Combo', false ).' value="Combo">Combo</option><option '.selected( $value, 'Comfortaa', false ).' value="Comfortaa">Comfortaa</option><option '.selected( $value, 'Coming Soon', false ).' value="Coming Soon">Coming Soon</option><option '.selected( $value, 'Concert One', false ).' value="Concert One">Concert One</option><option '.selected( $value, 'Condiment', false ).' value="Condiment">Condiment</option><option '.selected( $value, 'Content', false ).' value="Content">Content</option><option '.selected( $value, 'Contrail One', false ).' value="Contrail One">Contrail One</option><option '.selected( $value, 'Convergence', false ).' value="Convergence">Convergence</option><option '.selected( $value, 'Cookie', false ).' value="Cookie">Cookie</option><option '.selected( $value, 'Copse', false ).' value="Copse">Copse</option><option '.selected( $value, 'Corben', false ).' value="Corben">Corben</option><option '.selected( $value, 'Courgette', false ).' value="Courgette">Courgette</option><option '.selected( $value, 'Cousine', false ).' value="Cousine">Cousine</option><option '.selected( $value, 'Coustard', false ).' value="Coustard">Coustard</option><option '.selected( $value, 'Covered By Your Grace', false ).' value="Covered By Your Grace">Covered By Your Grace</option><option '.selected( $value, 'Crafty Girls', false ).' value="Crafty Girls">Crafty Girls</option><option '.selected( $value, 'Creepster', false ).' value="Creepster">Creepster</option><option '.selected( $value, 'Crete Round', false ).' value="Crete Round">Crete Round</option><option '.selected( $value, 'Crimson Text', false ).' value="Crimson Text">Crimson Text</option><option '.selected( $value, 'Croissant One', false ).' value="Croissant One">Croissant One</option><option '.selected( $value, 'Crushed', false ).' value="Crushed">Crushed</option><option '.selected( $value, 'Cuprum', false ).' value="Cuprum">Cuprum</option><option '.selected( $value, 'Cutive', false ).' value="Cutive">Cutive</option><option '.selected( $value, 'Cutive Mono', false ).' value="Cutive Mono">Cutive Mono</option><option '.selected( $value, 'Damion', false ).' value="Damion">Damion</option><option '.selected( $value, 'Dancing Script', false ).' value="Dancing Script">Dancing Script</option><option '.selected( $value, 'Dangrek', false ).' value="Dangrek">Dangrek</option><option '.selected( $value, 'Dawning of a New Day', false ).' value="Dawning of a New Day">Dawning of a New Day</option><option '.selected( $value, 'Days One', false ).' value="Days One">Days One</option><option '.selected( $value, 'Delius', false ).' value="Delius">Delius</option><option '.selected( $value, 'Delius Swash Caps', false ).' value="Delius Swash Caps">Delius Swash Caps</option><option '.selected( $value, 'Delius Unicase', false ).' value="Delius Unicase">Delius Unicase</option><option '.selected( $value, 'Della Respira', false ).' value="Della Respira">Della Respira</option><option '.selected( $value, 'Denk One', false ).' value="Denk One">Denk One</option><option '.selected( $value, 'Devonshire', false ).' value="Devonshire">Devonshire</option><option '.selected( $value, 'Didact Gothic', false ).' value="Didact Gothic">Didact Gothic</option><option '.selected( $value, 'Diplomata', false ).' value="Diplomata">Diplomata</option><option '.selected( $value, 'Diplomata SC', false ).' value="Diplomata SC">Diplomata SC</option><option '.selected( $value, 'Domine', false ).' value="Domine">Domine</option><option '.selected( $value, 'Donegal One', false ).' value="Donegal One">Donegal One</option><option '.selected( $value, 'Doppio One', false ).' value="Doppio One">Doppio One</option><option '.selected( $value, 'Dorsa', false ).' value="Dorsa">Dorsa</option><option '.selected( $value, 'Dosis', false ).' value="Dosis">Dosis</option><option '.selected( $value, 'Dr Sugiyama', false ).' value="Dr Sugiyama">Dr Sugiyama</option><option '.selected( $value, 'Droid Sans', false ).' value="Droid Sans">Droid Sans</option><option '.selected( $value, 'Droid Sans Mono', false ).' value="Droid Sans Mono">Droid Sans Mono</option><option '.selected( $value, 'Droid Serif', false ).' value="Droid Serif">Droid Serif</option><option '.selected( $value, 'Duru Sans', false ).' value="Duru Sans">Duru Sans</option><option '.selected( $value, 'Dynalight', false ).' value="Dynalight">Dynalight</option><option '.selected( $value, 'Eagle Lake', false ).' value="Eagle Lake">Eagle Lake</option><option '.selected( $value, 'Eater', false ).' value="Eater">Eater</option><option '.selected( $value, 'EB Garamond', false ).' value="EB Garamond">EB Garamond</option><option '.selected( $value, 'Economica', false ).' value="Economica">Economica</option><option '.selected( $value, 'Electrolize', false ).' value="Electrolize">Electrolize</option><option '.selected( $value, 'Elsie', false ).' value="Elsie">Elsie</option><option '.selected( $value, 'Elsie Swash Caps', false ).' value="Elsie Swash Caps">Elsie Swash Caps</option><option '.selected( $value, 'Emblema One', false ).' value="Emblema One">Emblema One</option><option '.selected( $value, 'Emilys Candy', false ).' value="Emilys Candy">Emilys Candy</option><option '.selected( $value, 'Engagement', false ).' value="Engagement">Engagement</option><option '.selected( $value, 'Englebert', false ).' value="Englebert">Englebert</option><option '.selected( $value, 'Enriqueta', false ).' value="Enriqueta">Enriqueta</option><option '.selected( $value, 'Erica One', false ).' value="Erica One">Erica One</option><option '.selected( $value, 'Esteban', false ).' value="Esteban">Esteban</option><option '.selected( $value, 'Euphoria Script', false ).' value="Euphoria Script">Euphoria Script</option><option '.selected( $value, 'Ewert', false ).' value="Ewert">Ewert</option><option '.selected( $value, 'Exo', false ).' value="Exo">Exo</option><option '.selected( $value, 'Expletus Sans', false ).' value="Expletus Sans">Expletus Sans</option><option '.selected( $value, 'Fanwood Text', false ).' value="Fanwood Text">Fanwood Text</option><option '.selected( $value, 'Fascinate', false ).' value="Fascinate">Fascinate</option><option '.selected( $value, 'Fascinate Inline', false ).' value="Fascinate Inline">Fascinate Inline</option><option '.selected( $value, 'Faster One', false ).' value="Faster One">Faster One</option><option '.selected( $value, 'Fasthand', false ).' value="Fasthand">Fasthand</option><option '.selected( $value, 'Fauna One', false ).' value="Fauna One">Fauna One</option><option '.selected( $value, 'Federant', false ).' value="Federant">Federant</option><option '.selected( $value, 'Federo', false ).' value="Federo">Federo</option><option '.selected( $value, 'Felipa', false ).' value="Felipa">Felipa</option><option '.selected( $value, 'Fenix', false ).' value="Fenix">Fenix</option><option '.selected( $value, 'Finger Paint', false ).' value="Finger Paint">Finger Paint</option><option '.selected( $value, 'Fjalla One', false ).' value="Fjalla One">Fjalla One</option><option '.selected( $value, 'Fjord One', false ).' value="Fjord One">Fjord One</option><option '.selected( $value, 'Flamenco', false ).' value="Flamenco">Flamenco</option><option '.selected( $value, 'Flavors', false ).' value="Flavors">Flavors</option><option '.selected( $value, 'Fondamento', false ).' value="Fondamento">Fondamento</option><option '.selected( $value, 'Fontdiner Swanky', false ).' value="Fontdiner Swanky">Fontdiner Swanky</option><option '.selected( $value, 'Forum', false ).' value="Forum">Forum</option><option '.selected( $value, 'Francois One', false ).' value="Francois One">Francois One</option><option '.selected( $value, 'Freckle Face', false ).' value="Freckle Face">Freckle Face</option><option '.selected( $value, 'Fredericka the Great', false ).' value="Fredericka the Great">Fredericka the Great</option><option '.selected( $value, 'Fredoka One', false ).' value="Fredoka One">Fredoka One</option><option '.selected( $value, 'Freehand', false ).' value="Freehand">Freehand</option><option '.selected( $value, 'Fresca', false ).' value="Fresca">Fresca</option><option '.selected( $value, 'Frijole', false ).' value="Frijole">Frijole</option><option '.selected( $value, 'Fruktur', false ).' value="Fruktur">Fruktur</option><option '.selected( $value, 'Fugaz One', false ).' value="Fugaz One">Fugaz One</option><option '.selected( $value, 'Gabriela', false ).' value="Gabriela">Gabriela</option><option '.selected( $value, 'Gafata', false ).' value="Gafata">Gafata</option><option '.selected( $value, 'Galdeano', false ).' value="Galdeano">Galdeano</option><option '.selected( $value, 'Galindo', false ).' value="Galindo">Galindo</option><option '.selected( $value, 'Gentium Basic', false ).' value="Gentium Basic">Gentium Basic</option><option '.selected( $value, 'Gentium Book Basic', false ).' value="Gentium Book Basic">Gentium Book Basic</option><option '.selected( $value, 'Geo', false ).' value="Geo">Geo</option><option '.selected( $value, 'Geostar', false ).' value="Geostar">Geostar</option><option '.selected( $value, 'Geostar Fill', false ).' value="Geostar Fill">Geostar Fill</option><option '.selected( $value, 'Germania One', false ).' value="Germania One">Germania One</option><option '.selected( $value, 'GFS Didot', false ).' value="GFS Didot">GFS Didot</option><option '.selected( $value, 'GFS Neohellenic', false ).' value="GFS Neohellenic">GFS Neohellenic</option><option '.selected( $value, 'GFS Neohellenic', false ).' value="c">Gilda Display</option><option '.selected( $value, 'Give You Glory', false ).' value="Give You Glory">Give You Glory</option><option '.selected( $value, 'Glass Antiqua', false ).' value="Glass Antiqua">Glass Antiqua</option><option '.selected( $value, 'Glegoo', false ).' value="Glegoo">Glegoo</option><option '.selected( $value, 'Gloria Hallelujah', false ).' value="Gloria Hallelujah">Gloria Hallelujah</option><option '.selected( $value, 'Goblin One', false ).' value="Goblin One">Goblin One</option><option '.selected( $value, 'Gochi Hand', false ).' value="Gochi Hand">Gochi Hand</option><option '.selected( $value, 'Gorditas', false ).' value="Gorditas">Gorditas</option><option '.selected( $value, 'Goudy Bookletter 1911', false ).' value="Goudy Bookletter 1911">Goudy Bookletter 1911</option><option '.selected( $value, 'Graduate', false ).' value="Graduate">Graduate</option><option '.selected( $value, 'Grand Hotel', false ).' value="Grand Hotel">Grand Hotel</option><option '.selected( $value, 'Gravitas One', false ).' value="Gravitas One">Gravitas One</option><option '.selected( $value, 'Great Vibes', false ).' value="Great Vibes">Great Vibes</option><option '.selected( $value, 'Griffy', false ).' value="Griffy">Griffy</option><option '.selected( $value, 'Gruppo', false ).' value="Gruppo">Gruppo</option><option '.selected( $value, 'Gudea', false ).' value="Gudea">Gudea</option><option '.selected( $value, 'Habibi', false ).' value="Habibi">Habibi</option><option '.selected( $value, 'Hammersmith One', false ).' value="Hammersmith One">Hammersmith One</option><option '.selected( $value, 'Hanalei', false ).' value="Hanalei">Hanalei</option><option '.selected( $value, 'Hanalei Fill', false ).' value="Hanalei Fill">Hanalei Fill</option><option '.selected( $value, 'Handlee', false ).' value="Handlee">Handlee</option><option '.selected( $value, 'Hanuman', false ).' value="Hanuman">Hanuman</option><option '.selected( $value, 'Happy Monkey', false ).' value="Happy Monkey">Happy Monkey</option><option '.selected( $value, 'Headland One', false ).' value="Headland One">Headland One</option><option '.selected( $value, 'Henny Penny', false ).' value="Henny Penny">Henny Penny</option><option '.selected( $value, 'Herr Von Muellerhoff', false ).' value="Herr Von Muellerhoff">Herr Von Muellerhoff</option><option '.selected( $value, 'Holtwood One SC', false ).' value="Holtwood One SC">Holtwood One SC</option><option '.selected( $value, 'Homemade Apple', false ).' value="Homemade Apple">Homemade Apple</option><option '.selected( $value, 'Homenaje', false ).' value="Homenaje">Homenaje</option><option '.selected( $value, 'Iceberg', false ).' value="Iceberg">Iceberg</option><option '.selected( $value, 'Iceland', false ).' value="Iceland">Iceland</option><option '.selected( $value, 'IM Fell Double Pica', false ).' value="IM Fell Double Pica">IM Fell Double Pica</option><option '.selected( $value, 'IM Fell Double Pica SC', false ).' value="IM Fell Double Pica SC">IM Fell Double Pica SC</option><option '.selected( $value, 'IM Fell DW Pica', false ).' value="IM Fell DW Pica">IM Fell DW Pica</option><option '.selected( $value, 'IM Fell DW Pica SC', false ).' value="IM Fell DW Pica SC">IM Fell DW Pica SC</option><option '.selected( $value, 'IM Fell English', false ).' value="IM Fell English">IM Fell English</option><option '.selected( $value, 'IM Fell English SC', false ).' value="IM Fell English SC">IM Fell English SC</option><option '.selected( $value, 'IM Fell French Canon', false ).' value="IM Fell French Canon">IM Fell French Canon</option><option '.selected( $value, 'IM Fell French Canon SC', false ).' value="IM Fell French Canon SC">IM Fell French Canon SC</option><option '.selected( $value, 'IM Fell Great Primer', false ).' value="IM Fell Great Primer">IM Fell Great Primer</option><option '.selected( $value, 'IM Fell Great Primer SC', false ).' value="IM Fell Great Primer SC">IM Fell Great Primer SC</option><option '.selected( $value, 'Imprima', false ).' value="Imprima">Imprima</option><option '.selected( $value, 'Inconsolata', false ).' value="Inconsolata">Inconsolata</option><option '.selected( $value, 'Inder', false ).' value="Inder">Inder</option><option '.selected( $value, 'Indie Flower', false ).' value="Indie Flower">Indie Flower</option><option '.selected( $value, 'Inika', false ).' value="Inika">Inika</option><option '.selected( $value, 'Irish Grover', false ).' value="Irish Grover">Irish Grover</option><option '.selected( $value, 'Istok Web', false ).' value="Istok Web">Istok Web</option><option '.selected( $value, 'Italiana', false ).' value="Italiana">Italiana</option><option '.selected( $value, 'Italianno', false ).' value="Italianno">Italianno</option><option '.selected( $value, 'Jacques Francois', false ).' value="Jacques Francois">Jacques Francois</option><option '.selected( $value, 'Jacques Francois Shadow', false ).' value="Jacques Francois Shadow">Jacques Francois Shadow</option><option '.selected( $value, 'Jim Nightshade', false ).' value="Jim Nightshade">Jim Nightshade</option><option '.selected( $value, 'Jockey One', false ).' value="Jockey One">Jockey One</option><option '.selected( $value, 'Jolly Lodger', false ).' value="Jolly Lodger">Jolly Lodger</option><option '.selected( $value, 'Josefin Sans', false ).' value="Josefin Sans">Josefin Sans</option><option '.selected( $value, 'Josefin Slab', false ).' value="Josefin Slab">Josefin Slab</option><option '.selected( $value, 'Joti One', false ).' value="Joti One">Joti One</option><option '.selected( $value, 'Judson', false ).' value="Judson">Judson</option><option '.selected( $value, 'Julee', false ).' value="Julee">Julee</option><option '.selected( $value, 'Julius Sans One', false ).' value="Julius Sans One">Julius Sans One</option><option '.selected( $value, 'Junge', false ).' value="Junge">Junge</option><option '.selected( $value, 'Jura', false ).' value="Jura">Jura</option><option '.selected( $value, 'Just Another Hand', false ).' value="Just Another Hand">Just Another Hand</option><option '.selected( $value, 'Just Me Again Down Here', false ).' value="Just Me Again Down Here">Just Me Again Down Here</option><option '.selected( $value, 'Kameron', false ).' value="Kameron">Kameron</option><option '.selected( $value, 'Karla', false ).' value="Karla">Karla</option><option '.selected( $value, 'Kaushan Script', false ).' value="Kaushan Script">Kaushan Script</option><option '.selected( $value, 'Kavoon', false ).' value="Kavoon">Kavoon</option><option '.selected( $value, 'Keania One', false ).' value="Keania One">Keania One</option><option '.selected( $value, 'Kelly Slab', false ).' value="Kelly Slab">Kelly Slab</option><option '.selected( $value, 'Kenia', false ).' value="Kenia">Kenia</option><option '.selected( $value, 'Khmer', false ).' value="Khmer">Khmer</option><option '.selected( $value, 'Khmer', false ).' value="c">Kite One</option><option '.selected( $value, 'Knewave', false ).' value="Knewave">Knewave</option><option '.selected( $value, 'Kotta One', false ).' value="Kotta One">Kotta One</option><option '.selected( $value, 'Koulen', false ).' value="Koulen">Koulen</option><option '.selected( $value, 'Kranky', false ).' value="Kranky">Kranky</option><option '.selected( $value, 'Kreon', false ).' value="Kreon">Kreon</option><option '.selected( $value, 'Kristi', false ).' value="Kristi">Kristi</option><option '.selected( $value, 'Krona One', false ).' value="Krona One">Krona One</option><option '.selected( $value, 'La Belle Aurore', false ).' value="La Belle Aurore">La Belle Aurore</option><option '.selected( $value, 'Lancelot', false ).' value="Lancelot">Lancelot</option><option '.selected( $value, 'Lato', false ).' value="Lato">Lato</option><option '.selected( $value, 'League Script', false ).' value="League Script">League Script</option><option '.selected( $value, 'Leckerli One', false ).' value="Leckerli One">Leckerli One</option><option '.selected( $value, 'Ledger', false ).' value="Ledger">Ledger</option><option '.selected( $value, 'Lekton', false ).' value="Lekton">Lekton</option><option '.selected( $value, 'Lemon', false ).' value="Lemon">Lemon</option><option '.selected( $value, 'Libre Baskerville', false ).' value="Libre Baskerville">Libre Baskerville</option><option '.selected( $value, 'Life Savers', false ).' value="Life Savers">Life Savers</option><option '.selected( $value, 'Lilita One', false ).' value="Lilita One">Lilita One</option><option '.selected( $value, 'Lily Script One', false ).' value="Lily Script One">Lily Script One</option><option '.selected( $value, 'Limelight', false ).' value="Limelight">Limelight</option><option '.selected( $value, 'Linden Hill', false ).' value="Linden Hill">Linden Hill</option><option '.selected( $value, 'Lobster', false ).' value="Lobster">Lobster</option><option '.selected( $value, 'Lobster Two', false ).' value="Lobster Two">Lobster Two</option><option '.selected( $value, 'Londrina Outline', false ).' value="Londrina Outline">Londrina Outline</option><option '.selected( $value, 'Londrina Shadow', false ).' value="Londrina Shadow">Londrina Shadow</option><option '.selected( $value, 'Londrina Sketch', false ).' value="Londrina Sketch">Londrina Sketch</option><option '.selected( $value, 'Londrina Solid', false ).' value="Londrina Solid">Londrina Solid</option><option '.selected( $value, 'Lora', false ).' value="Lora">Lora</option><option '.selected( $value, 'Love Ya Like A Sister', false ).' value="Love Ya Like A Sister">Love Ya Like A Sister</option><option '.selected( $value, 'Loved by the King', false ).' value="Loved by the King">Loved by the King</option><option '.selected( $value, 'Lovers Quarrel', false ).' value="Lovers Quarrel">Lovers Quarrel</option><option '.selected( $value, 'Luckiest Guy', false ).' value="Luckiest Guy">Luckiest Guy</option><option '.selected( $value, 'Lusitana', false ).' value="Lusitana">Lusitana</option><option '.selected( $value, 'Lustria', false ).' value="Lustria">Lustria</option><option '.selected( $value, 'Macondo', false ).' value="Macondo">Macondo</option><option '.selected( $value, 'Macondo Swash Caps', false ).' value="Macondo Swash Caps">Macondo Swash Caps</option><option '.selected( $value, 'ABeeMagraZee', false ).' value="Magra">Magra</option><option '.selected( $value, 'Maiden Orange', false ).' value="Maiden Orange">Maiden Orange</option><option '.selected( $value, 'Mako', false ).' value="Mako">Mako</option><option '.selected( $value, 'Marcellus', false ).' value="Marcellus">Marcellus</option><option '.selected( $value, 'Marcellus SC', false ).' value="Marcellus SC">Marcellus SC</option><option '.selected( $value, 'Marck Script', false ).' value="Marck Script">Marck Script</option><option '.selected( $value, 'Margarine', false ).' value="Margarine">Margarine</option><option '.selected( $value, 'Marko One', false ).' value="Marko One">Marko One</option><option '.selected( $value, 'Marmelad', false ).' value="Marmelad">Marmelad</option><option '.selected( $value, 'Marvel', false ).' value="Marvel">Marvel</option><option '.selected( $value, 'Mate', false ).' value="Mate">Mate</option><option '.selected( $value, 'Mate SC', false ).' value="Mate SC">Mate SC</option><option '.selected( $value, 'Maven Pro', false ).' value="Maven Pro">Maven Pro</option><option '.selected( $value, 'McLaren', false ).' value="McLaren">McLaren</option><option '.selected( $value, 'Meddon', false ).' value="Meddon">Meddon</option><option '.selected( $value, 'MedievalSharp', false ).' value="MedievalSharp">MedievalSharp</option><option '.selected( $value, 'Medula One', false ).' value="Medula One">Medula One</option><option '.selected( $value, 'Megrim', false ).' value="Megrim">Megrim</option><option '.selected( $value, 'Meie Script', false ).' value="Meie Script">Meie Script</option><option '.selected( $value, 'Merienda', false ).' value="Merienda">Merienda</option><option '.selected( $value, 'Merienda One', false ).' value="Merienda One">Merienda One</option><option '.selected( $value, 'Merriweather', false ).' value="Merriweather">Merriweather</option><option '.selected( $value, 'Merriweather Sans', false ).' value="Merriweather Sans">Merriweather Sans</option><option '.selected( $value, 'Metal', false ).' value="Metal">Metal</option><option '.selected( $value, 'Metal Mania', false ).' value="Metal Mania">Metal Mania</option><option '.selected( $value, 'Metamorphous', false ).' value="Metamorphous">Metamorphous</option><option '.selected( $value, 'Metrophobic', false ).' value="Metrophobic">Metrophobic</option><option '.selected( $value, 'Michroma', false ).' value="Michroma">Michroma</option><option '.selected( $value, 'Milonga', false ).' value="Milonga">Milonga</option><option '.selected( $value, 'Miltonian', false ).' value="Miltonian">Miltonian</option><option '.selected( $value, 'Miltonian Tattoo', false ).' value="Miltonian Tattoo">Miltonian Tattoo</option><option '.selected( $value, 'Miniver', false ).' value="Miniver">Miniver</option><option '.selected( $value, 'Miss Fajardose', false ).' value="Miss Fajardose">Miss Fajardose</option><option '.selected( $value, 'Modern Antiqua', false ).' value="Modern Antiqua">Modern Antiqua</option><option '.selected( $value, 'Molengo', false ).' value="Molengo">Molengo</option><option '.selected( $value, 'Molle', false ).' value="Molle">Molle</option><option '.selected( $value, 'Monda', false ).' value="Monda">Monda</option><option '.selected( $value, 'Monofett', false ).' value="Monofett">Monofett</option><option '.selected( $value, 'Monoton', false ).' value="Monoton">Monoton</option><option '.selected( $value, 'Monsieur La Doulaise', false ).' value="Monsieur La Doulaise">Monsieur La Doulaise</option><option '.selected( $value, 'Montaga', false ).' value="Montaga">Montaga</option><option '.selected( $value, 'Montez', false ).' value="Montez">Montez</option><option '.selected( $value, 'Montserrat', false ).' value="Montserrat">Montserrat</option><option '.selected( $value, 'Montserrat Alternates', false ).' value="Montserrat Alternates">Montserrat Alternates</option><option '.selected( $value, 'Montserrat Subrayada', false ).' value="Montserrat Subrayada">Montserrat Subrayada</option><option '.selected( $value, 'Moul', false ).' value="Moul">Moul</option><option '.selected( $value, 'Moulpali', false ).' value="Moulpali">Moulpali</option><option '.selected( $value, 'Mountains of Christmas', false ).' value="Mountains of Christmas">Mountains of Christmas</option><option '.selected( $value, 'Mouse Memoirs', false ).' value="Mouse Memoirs">Mouse Memoirs</option><option '.selected( $value, 'Mr Bedfort', false ).' value="Mr Bedfort">Mr Bedfort</option><option '.selected( $value, 'Mr Dafoe', false ).' value="Mr Dafoe">Mr Dafoe</option><option '.selected( $value, 'Mr De Haviland', false ).' value="Mr De Haviland">Mr De Haviland</option><option '.selected( $value, 'Mrs Saint Delafield', false ).' value="Mrs Saint Delafield">Mrs Saint Delafield</option><option '.selected( $value, 'Mrs Sheppards', false ).' value="Mrs Sheppards">Mrs Sheppards</option><option '.selected( $value, 'Muli', false ).' value="Muli">Muli</option><option '.selected( $value, 'Mystery Quest', false ).' value="Mystery Quest">Mystery Quest</option><option '.selected( $value, 'Neucha', false ).' value="Neucha">Neucha</option><option '.selected( $value, 'Neuton', false ).' value="Neuton">Neuton</option><option '.selected( $value, 'New Rocker', false ).' value="New Rocker">New Rocker</option><option '.selected( $value, 'News Cycle', false ).' value="News Cycle">News Cycle</option><option '.selected( $value, 'Niconne', false ).' value="Niconne">Niconne</option><option '.selected( $value, 'Nixie One', false ).' value="Nixie One">Nixie One</option><option '.selected( $value, 'Nobile', false ).' value="Nobile">Nobile</option><option '.selected( $value, 'Nokora', false ).' value="Nokora">Nokora</option><option '.selected( $value, 'Norican', false ).' value="Norican">Norican</option><option '.selected( $value, 'Nosifer', false ).' value="Nosifer">Nosifer</option><option '.selected( $value, 'Nothing You Could Do', false ).' value="Nothing You Could Do">Nothing You Could Do</option><option '.selected( $value, 'Noticia Text', false ).' value="Noticia Text">Noticia Text</option><option '.selected( $value, 'Noto Sans', false ).' value="Noto Sans">Noto Sans</option><option '.selected( $value, 'Noto Serif', false ).' value="Noto Serif">Noto Serif</option><option '.selected( $value, 'Nova Cut', false ).' value="Nova Cut">Nova Cut</option><option '.selected( $value, 'Nova Flat', false ).' value="Nova Flat">Nova Flat</option><option '.selected( $value, 'Nova Mono', false ).' value="Nova Mono">Nova Mono</option><option '.selected( $value, 'Nova Oval', false ).' value="Nova Oval">Nova Oval</option><option '.selected( $value, 'Nova Round', false ).' value="Nova Round">Nova Round</option><option '.selected( $value, 'Nova Script', false ).' value="Nova Script">Nova Script</option><option '.selected( $value, 'Nova Slim', false ).' value="Nova Slim">Nova Slim</option><option '.selected( $value, 'Nova Square', false ).' value="Nova Square">Nova Square</option><option '.selected( $value, 'Numans', false ).' value="Numans">Numans</option><option '.selected( $value, 'Nunito', false ).' value="Nunito">Nunito</option><option '.selected( $value, 'Odor Mean Chey', false ).' value="Odor Mean Chey">Odor Mean Chey</option><option '.selected( $value, 'Offside', false ).' value="Offside">Offside</option><option '.selected( $value, 'Old Standard TT', false ).' value="Old Standard TT">Old Standard TT</option><option '.selected( $value, 'Oldenburg', false ).' value="Oldenburg">Oldenburg</option><option '.selected( $value, 'Oleo Script', false ).' value="Oleo Script">Oleo Script</option><option '.selected( $value, 'Oleo Script Swash Caps', false ).' value="Oleo Script Swash Caps">Oleo Script Swash Caps</option><option '.selected( $value, 'Open Sans', false ).' value="Open Sans">Open Sans</option><option '.selected( $value, 'Open Sans Condensed', false ).' value="Open Sans Condensed">Open Sans Condensed</option><option '.selected( $value, 'Oranienbaum', false ).' value="Oranienbaum">Oranienbaum</option><option '.selected( $value, 'Orbitron', false ).' value="Orbitron">Orbitron</option><option '.selected( $value, 'Oregano', false ).' value="Oregano">Oregano</option><option '.selected( $value, 'Orienta', false ).' value="Orienta">Orienta</option><option '.selected( $value, 'Original Surfer', false ).' value="Original Surfer">Original Surfer</option><option '.selected( $value, 'Oswald', false ).' value="Oswald">Oswald</option><option '.selected( $value, 'Over the Rainbow', false ).' value="Over the Rainbow">Over the Rainbow</option><option '.selected( $value, 'Overlock', false ).' value="Overlock">Overlock</option><option '.selected( $value, 'Overlock SC', false ).' value="Overlock SC">Overlock SC</option><option '.selected( $value, 'Ovo', false ).' value="Ovo">Ovo</option><option '.selected( $value, 'Oxygen', false ).' value="Oxygen">Oxygen</option><option '.selected( $value, 'Oxygen Mono', false ).' value="Oxygen Mono">Oxygen Mono</option><option '.selected( $value, 'Pacifico', false ).' value="Pacifico">Pacifico</option><option '.selected( $value, 'Paprika', false ).' value="Paprika">Paprika</option><option '.selected( $value, 'Parisienne', false ).' value="Parisienne">Parisienne</option><option '.selected( $value, 'Passero One', false ).' value="Passero One">Passero One</option><option '.selected( $value, 'Passion One', false ).' value="Passion One">Passion One</option><option '.selected( $value, 'Pathway Gothic One', false ).' value="Pathway Gothic One">Pathway Gothic One</option><option '.selected( $value, 'Patrick Hand', false ).' value="Patrick Hand">Patrick Hand</option><option '.selected( $value, 'Patrick Hand SC', false ).' value="Patrick Hand SC">Patrick Hand SC</option><option '.selected( $value, 'Patua One', false ).' value="Patua One">Patua One</option><option '.selected( $value, 'Paytone One', false ).' value="Paytone One">Paytone One</option><option '.selected( $value, 'Peralta', false ).' value="Peralta">Peralta</option><option '.selected( $value, 'Permanent Marker', false ).' value="Permanent Marker">Permanent Marker</option><option '.selected( $value, 'Petit Formal Script', false ).' value="Petit Formal Script">Petit Formal Script</option><option '.selected( $value, 'Petrona', false ).' value="Petrona">Petrona</option><option '.selected( $value, 'Philosopher', false ).' value="Philosopher">Philosopher</option><option '.selected( $value, 'Piedra', false ).' value="Piedra">Piedra</option><option '.selected( $value, 'Pinyon Script', false ).' value="Pinyon Script">Pinyon Script</option><option '.selected( $value, 'Pirata One', false ).' value="Pirata One">Pirata One</option><option '.selected( $value, 'Plaster', false ).' value="Plaster">Plaster</option><option '.selected( $value, 'Play', false ).' value="Play">Play</option><option '.selected( $value, 'Playball', false ).' value="Playball">Playball</option><option '.selected( $value, 'Playfair Display', false ).' value="Playfair Display">Playfair Display</option><option '.selected( $value, 'Playfair Display SC', false ).' value="Playfair Display SC">Playfair Display SC</option><option '.selected( $value, 'Podkova', false ).' value="Podkova">Podkova</option><option '.selected( $value, 'Poiret One', false ).' value="Poiret One">Poiret One</option><option '.selected( $value, 'Poller One', false ).' value="Poller One">Poller One</option><option '.selected( $value, 'Poly', false ).' value="Poly">Poly</option><option '.selected( $value, 'Pompiere', false ).' value="Pompiere">Pompiere</option><option '.selected( $value, 'Pontano Sans', false ).' value="Pontano Sans">Pontano Sans</option><option '.selected( $value, 'Port Lligat Sans', false ).' value="Port Lligat Sans">Port Lligat Sans</option><option '.selected( $value, 'Port Lligat Slab', false ).' value="Port Lligat Slab">Port Lligat Slab</option><option '.selected( $value, 'Prata', false ).' value="Prata">Prata</option><option '.selected( $value, 'Preahvihear', false ).' value="Preahvihear">Preahvihear</option><option '.selected( $value, 'Press Start 2P', false ).' value="Press Start 2P">Press Start 2P</option><option '.selected( $value, 'Princess Sofia', false ).' value="Princess Sofia">Princess Sofia</option><option '.selected( $value, 'Prociono', false ).' value="Prociono">Prociono</option><option '.selected( $value, 'Prosto One', false ).' value="Prosto One">Prosto One</option><option '.selected( $value, 'PT Mono', false ).' value="PT Mono">PT Mono</option><option '.selected( $value, 'PT Sans', false ).' value="PT Sans">PT Sans</option><option '.selected( $value, 'PT Sans Caption', false ).' value="PT Sans Caption">PT Sans Caption</option><option '.selected( $value, 'PT Sans Narrow', false ).' value="PT Sans Narrow">PT Sans Narrow</option><option '.selected( $value, 'PT Serif', false ).' value="PT Serif">PT Serif</option><option '.selected( $value, 'PT Serif Caption', false ).' value="PT Serif Caption">PT Serif Caption</option><option '.selected( $value, 'Puritan', false ).' value="Puritan">Puritan</option><option '.selected( $value, 'Purple Purse', false ).' value="Purple Purse">Purple Purse</option><option '.selected( $value, 'Quando', false ).' value="Quando">Quando</option><option '.selected( $value, 'Quantico', false ).' value="Quantico">Quantico</option><option '.selected( $value, 'Quattrocento', false ).' value="Quattrocento">Quattrocento</option><option '.selected( $value, 'Quattrocento Sans', false ).' value="Quattrocento Sans">Quattrocento Sans</option><option '.selected( $value, 'Questrial', false ).' value="Questrial">Questrial</option><option '.selected( $value, 'Quicksand', false ).' value="Quicksand">Quicksand</option><option '.selected( $value, 'Quintessential', false ).' value="Quintessential">Quintessential</option><option '.selected( $value, 'Qwigley', false ).' value="Qwigley">Qwigley</option><option '.selected( $value, 'Racing Sans One', false ).' value="Racing Sans One">Racing Sans One</option><option '.selected( $value, 'Radley', false ).' value="Radley">Radley</option><option '.selected( $value, 'Raleway', false ).' value="Raleway">Raleway</option><option '.selected( $value, 'Raleway Dots', false ).' value="Raleway Dots">Raleway Dots</option><option '.selected( $value, 'Rambla', false ).' value="Rambla">Rambla</option><option '.selected( $value, 'Rammetto One', false ).' value="Rammetto One">Rammetto One</option><option '.selected( $value, 'Ranchers', false ).' value="Ranchers">Ranchers</option><option '.selected( $value, 'Rancho', false ).' value="Rancho">Rancho</option><option '.selected( $value, 'Rationale', false ).' value="Rationale">Rationale</option><option '.selected( $value, 'Redressed', false ).' value="Redressed">Redressed</option><option '.selected( $value, 'Reenie Beanie', false ).' value="Reenie Beanie">Reenie Beanie</option><option '.selected( $value, 'Revalia', false ).' value="Revalia">Revalia</option><option '.selected( $value, 'Ribeye', false ).' value="Ribeye">Ribeye</option><option '.selected( $value, 'Ribeye Marrow', false ).' value="Ribeye Marrow">Ribeye Marrow</option><option '.selected( $value, 'Righteous', false ).' value="Righteous">Righteous</option><option '.selected( $value, 'Risque', false ).' value="Risque">Risque</option><option '.selected( $value, 'Roboto', false ).' value="Roboto">Roboto</option><option '.selected( $value, 'Roboto Condensed', false ).' value="Roboto Condensed">Roboto Condensed</option><option '.selected( $value, 'Roboto Slab', false ).' value="Roboto Slab">Roboto Slab</option><option '.selected( $value, 'Rochester', false ).' value="Rochester">Rochester</option><option '.selected( $value, 'Rock Salt', false ).' value="Rock Salt">Rock Salt</option><option '.selected( $value, 'Rokkitt', false ).' value="Rokkitt">Rokkitt</option><option '.selected( $value, 'Romanesco', false ).' value="Romanesco">Romanesco</option><option '.selected( $value, 'Ropa Sans', false ).' value="Ropa Sans">Ropa Sans</option><option '.selected( $value, 'Rosario', false ).' value="Rosario">Rosario</option><option '.selected( $value, 'Rosarivo', false ).' value="Rosarivo">Rosarivo</option><option '.selected( $value, 'Rouge Script', false ).' value="Rouge Script">Rouge Script</option><option '.selected( $value, 'Ruda', false ).' value="Ruda">Ruda</option><option '.selected( $value, 'Rufina', false ).' value="Rufina">Rufina</option><option '.selected( $value, 'Ruge Boogie', false ).' value="Ruge Boogie">Ruge Boogie</option><option '.selected( $value, 'Ruluko', false ).' value="Ruluko">Ruluko</option><option '.selected( $value, 'Rum Raisin', false ).' value="Rum Raisin">Rum Raisin</option><option '.selected( $value, 'Ruslan Display', false ).' value="Ruslan Display">Ruslan Display</option><option '.selected( $value, 'Russo One', false ).' value="Russo One">Russo One</option><option '.selected( $value, 'Ruthie', false ).' value="Ruthie">Ruthie</option><option '.selected( $value, 'Rye', false ).' value="Rye">Rye</option><option '.selected( $value, 'Sacramento', false ).' value="Sacramento">Sacramento</option><option '.selected( $value, 'Sail', false ).' value="Sail">Sail</option><option '.selected( $value, 'Salsa', false ).' value="Salsa">Salsa</option><option '.selected( $value, 'Sanchez', false ).' value="Sanchez">Sanchez</option><option '.selected( $value, 'Sancreek', false ).' value="Sancreek">Sancreek</option><option '.selected( $value, 'Sansita One', false ).' value="Sansita One">Sansita One</option><option '.selected( $value, 'Sarina', false ).' value="Sarina">Sarina</option><option '.selected( $value, 'Satisfy', false ).' value="Satisfy">Satisfy</option><option '.selected( $value, 'Scada', false ).' value="Scada">Scada</option><option '.selected( $value, 'Schoolbell', false ).' value="Schoolbell">Schoolbell</option><option '.selected( $value, 'Seaweed Script', false ).' value="Seaweed Script">Seaweed Script</option><option '.selected( $value, 'Sevillana', false ).' value="Sevillana">Sevillana</option><option '.selected( $value, 'Seymour One', false ).' value="Seymour One">Seymour One</option><option '.selected( $value, 'Shadows Into Light', false ).' value="Shadows Into Light">Shadows Into Light</option><option '.selected( $value, 'Shadows Into Light Two', false ).' value="Shadows Into Light Two">Shadows Into Light Two</option><option '.selected( $value, 'Shanti', false ).' value="Shanti">Shanti</option><option '.selected( $value, 'Share', false ).' value="Share">Share</option><option '.selected( $value, 'Share Tech', false ).' value="Share Tech">Share Tech</option><option '.selected( $value, 'Share Tech Mono', false ).' value="Share Tech Mono">Share Tech Mono</option><option '.selected( $value, 'Shojumaru', false ).' value="Shojumaru">Shojumaru</option><option '.selected( $value, 'Short Stack', false ).' value="Short Stack">Short Stack</option><option '.selected( $value, 'Siemreap', false ).' value="Siemreap">Siemreap</option><option '.selected( $value, 'Sigmar One', false ).' value="Sigmar One">Sigmar One</option><option '.selected( $value, 'Signika', false ).' value="Signika">Signika</option><option '.selected( $value, 'Signika Negative', false ).' value="Signika Negative">Signika Negative</option><option '.selected( $value, 'Simonetta', false ).' value="Simonetta">Simonetta</option><option '.selected( $value, 'Sintony', false ).' value="Sintony">Sintony</option><option '.selected( $value, 'Sirin Stencil', false ).' value="Sirin Stencil">Sirin Stencil</option><option '.selected( $value, 'Six Caps', false ).' value="Six Caps">Six Caps</option><option '.selected( $value, 'Skranji', false ).' value="Skranji">Skranji</option><option '.selected( $value, 'Slackey', false ).' value="Slackey">Slackey</option><option '.selected( $value, 'Smokum', false ).' value="Smokum">Smokum</option><option '.selected( $value, 'Smythe', false ).' value="Smythe">Smythe</option><option '.selected( $value, 'Sniglet', false ).' value="Sniglet">Sniglet</option><option '.selected( $value, 'Snippet', false ).' value="Snippet">Snippet</option><option '.selected( $value, 'Snowburst One', false ).' value="Snowburst One">Snowburst One</option><option '.selected( $value, 'Sofadi One', false ).' value="Sofadi One">Sofadi One</option><option '.selected( $value, 'Sofia', false ).' value="Sofia">Sofia</option><option '.selected( $value, 'Sonsie One', false ).' value="Sonsie One">Sonsie One</option><option '.selected( $value, 'Sorts Mill Goudy', false ).' value="Sorts Mill Goudy">Sorts Mill Goudy</option><option '.selected( $value, 'Source Code Pro', false ).' value="Source Code Pro">Source Code Pro</option><option '.selected( $value, 'Source Sans Pro', false ).' value="Source Sans Pro">Source Sans Pro</option><option '.selected( $value, 'Special Elite', false ).' value="Special Elite">Special Elite</option><option '.selected( $value, 'Spicy Rice', false ).' value="Spicy Rice">Spicy Rice</option><option '.selected( $value, 'Spinnaker', false ).' value="Spinnaker">Spinnaker</option><option '.selected( $value, 'Spirax', false ).' value="Spirax">Spirax</option><option '.selected( $value, 'Squada One', false ).' value="Squada One">Squada One</option><option '.selected( $value, 'Stalemate', false ).' value="Stalemate">Stalemate</option><option '.selected( $value, 'Stalinist One', false ).' value="Stalinist One">Stalinist One</option><option '.selected( $value, 'Stardos Stencil', false ).' value="Stardos Stencil">Stardos Stencil</option><option '.selected( $value, 'Stint Ultra Condensed', false ).' value="Stint Ultra Condensed">Stint Ultra Condensed</option><option '.selected( $value, 'Stint Ultra Expanded', false ).' value="Stint Ultra Expanded">Stint Ultra Expanded</option><option '.selected( $value, 'Stoke', false ).' value="Stoke">Stoke</option><option '.selected( $value, 'Strait', false ).' value="Strait">Strait</option><option '.selected( $value, 'Sue Ellen Francisco', false ).' value="Sue Ellen Francisco">Sue Ellen Francisco</option><option '.selected( $value, 'Sunshiney', false ).' value="Sunshiney">Sunshiney</option><option '.selected( $value, 'Supermercado One', false ).' value="Supermercado One">Supermercado One</option><option '.selected( $value, 'Suwannaphum', false ).' value="Suwannaphum">Suwannaphum</option><option '.selected( $value, 'Swanky and Moo Moo', false ).' value="Swanky and Moo Moo">Swanky and Moo Moo</option><option '.selected( $value, 'Syncopate', false ).' value="Syncopate">Syncopate</option><option '.selected( $value, 'Tangerine', false ).' value="Tangerine">Tangerine</option><option '.selected( $value, 'Taprom', false ).' value="Taprom">Taprom</option><option '.selected( $value, 'Tauri', false ).' value="Tauri">Tauri</option><option '.selected( $value, 'Telex', false ).' value="Telex">Telex</option><option '.selected( $value, 'Tenor Sans', false ).' value="Tenor Sans">Tenor Sans</option><option '.selected( $value, 'Text Me One', false ).' value="Text Me One">Text Me One</option><option '.selected( $value, 'The Girl Next Door', false ).' value="The Girl Next Door">The Girl Next Door</option><option '.selected( $value, 'Tienne', false ).' value="Tienne">Tienne</option><option '.selected( $value, 'Tinos', false ).' value="Tinos">Tinos</option><option '.selected( $value, 'Titan One', false ).' value="Titan One">Titan One</option><option '.selected( $value, 'Titillium Web', false ).' value="Titillium Web">Titillium Web</option><option '.selected( $value, 'Trade Winds', false ).' value="Trade Winds">Trade Winds</option><option '.selected( $value, 'Trocchi', false ).' value="Trocchi">Trocchi</option><option '.selected( $value, 'Trochut', false ).' value="Trochut">Trochut</option><option '.selected( $value, 'Trykker', false ).' value="Trykker">Trykker</option><option '.selected( $value, 'Tulpen One', false ).' value="Tulpen One">Tulpen One</option><option '.selected( $value, 'Ubuntu', false ).' value="Ubuntu">Ubuntu</option><option '.selected( $value, 'Ubuntu Condensed', false ).' value="Ubuntu Condensed">Ubuntu Condensed</option><option '.selected( $value, 'Ubuntu Mono', false ).' value="Ubuntu Mono">Ubuntu Mono</option><option '.selected( $value, 'Ultra', false ).' value="Ultra">Ultra</option><option '.selected( $value, 'Uncial Antiqua', false ).' value="Uncial Antiqua">Uncial Antiqua</option><option '.selected( $value, 'Underdog', false ).' value="Underdog">Underdog</option><option '.selected( $value, 'Unica One', false ).' value="Unica One">Unica One</option><option '.selected( $value, 'UnifrakturCook', false ).' value="UnifrakturCook">UnifrakturCook</option><option '.selected( $value, 'UnifrakturMaguntia', false ).' value="UnifrakturMaguntia">UnifrakturMaguntia</option><option '.selected( $value, 'Unkempt', false ).' value="Unkempt">Unkempt</option><option '.selected( $value, 'Unlock', false ).' value="Unlock">Unlock</option><option '.selected( $value, 'Unna', false ).' value="Unna">Unna</option><option '.selected( $value, 'Vampiro One', false ).' value="Vampiro One">Vampiro One</option><option '.selected( $value, 'Varela', false ).' value="Varela">Varela</option><option '.selected( $value, 'Varela Round', false ).' value="Varela Round">Varela Round</option><option '.selected( $value, 'Vast Shadow', false ).' value="Vast Shadow">Vast Shadow</option><option '.selected( $value, 'Vibur', false ).' value="Vibur">Vibur</option><option '.selected( $value, 'Vidaloka', false ).' value="Vidaloka">Vidaloka</option><option '.selected( $value, 'Viga', false ).' value="Viga">Viga</option><option '.selected( $value, 'Voces', false ).' value="Voces">Voces</option><option '.selected( $value, 'Volkhov', false ).' value="Volkhov">Volkhov</option><option '.selected( $value, 'Vollkorn', false ).' value="Vollkorn">Vollkorn</option><option '.selected( $value, 'Voltaire', false ).' value="Voltaire">Voltaire</option><option '.selected( $value, 'VT323', false ).' value="VT323">VT323</option><option '.selected( $value, 'Waiting for the Sunrise', false ).' value="Waiting for the Sunrise">Waiting for the Sunrise</option><option '.selected( $value, 'Wallpoet', false ).' value="Wallpoet">Wallpoet</option><option '.selected( $value, 'Walter Turncoat', false ).' value="Walter Turncoat">Walter Turncoat</option><option '.selected( $value, 'Warnes', false ).' value="Warnes">Warnes</option><option '.selected( $value, 'Wellfleet', false ).' value="Wellfleet">Wellfleet</option><option '.selected( $value, 'Wendy One', false ).' value="Wendy One">Wendy One</option><option '.selected( $value, 'Wire One', false ).' value="Wire One">Wire One</option><option '.selected( $value, 'Yanone Kaffeesatz', false ).' value="Yanone Kaffeesatz">Yanone Kaffeesatz</option><option '.selected( $value, 'Yellowtail', false ).' value="Yellowtail">Yellowtail</option><option '.selected( $value, 'Yeseva One', false ).' value="Yeseva One">Yeseva One</option><option '.selected( $value, 'Yesteryear', false ).' value="Yesteryear">Yesteryear</option><option '.selected( $value, 'Zeyada', false ).' value="Zeyada">Zeyada</option>
						</select>');
			}
			elseif ($args['other']=='photostyle')
			{
			echo sprintf('<select name="%s" id="%s" class="wcf-form-select">', $field, $field);
					echo('<option value="off" '.selected($value,'off',false).'>'.esc_html__( 'Disabled', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
					echo('<option value="badge" '.selected($value,'badge',false).'>Badge</option>');
					echo('<option value="bubble-left" '.selected($value,'bubble-left',false).'>Bubble Left</option>');
					echo('<option value="bubble-right" '.selected($value,'bubble-right',false).'>Bubble Right</option>');
					echo('<option value="door" '.selected($value,'door',false).'>Door</option>');
					echo('<option value="leaf-left" '.selected($value,'leaf-left',false).'>Leaf Left</option>');
					echo('<option value="leaf-right" '.selected($value,'leaf-right',false).'>Leaf Right</option>');
					echo('<option value="rounded" '.selected($value,'rounded',false).'>Rounded</option>');
					echo('<option value="rounded-left" '.selected($value,'rounded-left',false).'>Rounded Left</option>');
					echo('<option value="rounded-right" '.selected($value,'rounded-right',false).'>Rounded Right</option>');
				echo('</select>');
			}
			elseif ($args['other']=='shake')
			{
			echo sprintf('<select name="%s" id="%s" class="wcf-form-select">', $field, $field);
					echo('<option value="0" '.selected($value,'0',false).'>'.esc_html__( 'Disabled', W8CONTACT_FORM_TEXT_DOMAIN ).'</option>');
					echo('<option value="heartbeat" '.selected($value,'heartbeat',false).'>Heartbeat</option>');
					echo('<option value="5000" '.selected($value,'5000',false).'>Shake 5sec</option>');
					echo('<option value="10000" '.selected($value,'10000',false).'>Shake 10sec</option>');
					echo('<option value="15000" '.selected($value,'15000',false).'>Shake 15sec</option>');
					echo('<option value="20000" '.selected($value,'20000',false).'>Shake 20sec</option>');
					echo('<option value="25000" '.selected($value,'25000',false).'>Shake 25sec</option>');
					echo('<option value="30000" '.selected($value,'30000',false).'>Shake 30sec</option>');
					echo('<option value="35000" '.selected($value,'35000',false).'>Shake 35sec</option>');
					echo('<option value="40000" '.selected($value,'40000',false).'>Shake 40sec</option>');
					echo('<option value="45000" '.selected($value,'45000',false).'>Shake 45sec</option>');
					echo('<option value="50000" '.selected($value,'50000',false).'>Shake 50sec</option>');
					echo('<option value="55000" '.selected($value,'55000',false).'>Shake 55sec</option>');
					echo('<option value="60000" '.selected($value,'60000',false).'>Shake 1min</option>');
					echo('<option value="120000" '.selected($value,'120000',false).'>Shake 2min</option>');
					echo('<option value="180000" '.selected($value,'180000',false).'>Shake 3min</option>');
					echo('<option value="240000" '.selected($value,'240000',false).'>Shake 4min</option>');
					echo('<option value="300000" '.selected($value,'300000',false).'>Shake 5min</option>');
				echo('</select>');
			}
			else
			{
			if (isset($args['min'])) $field_min = $args['min'];
			if (isset($args['max'])) $field_max = $args['max'];
			if (isset($args['default'])) $field_default = $args['default'];
				if (!isset($field_min)) $field_min = 1;
				if (!isset($field_max)) $field_max = 10;
				if (!isset($field_default)) $field_default = 5;
			// echo a proper select element
				echo sprintf('<select name="%s" id="%s">', $field, $field);
				for($i=$field_min;$i<=$field_max;$i++) {
					$selected = '';
					if ($value==$i) $selected = 'selected = "true"';
					if (!$value AND $i==$field_default) $selected = 'selected = "true"';
					echo('<option value="'.$i.'" '.$selected.'>'.$i.'</option>');
				}
				echo('</select>');
			}
			if (isset($args['extrahtml'])) echo($args['extrahtml']);
		}
		/**
		* add a menu
		**/		
		public function add_menu() {
			// Add a page to manage this plugin's settings
			add_menu_page( 'W8 Contact Form', 'W8 Contact Form', 'manage_options', 'contact_form_slider', array(&$this, 'plugin_settings_page'),'dashicons-email','65.014');
			add_submenu_page('contact_form_slider', 'W8 Contact Form', 'Contacts', 'manage_options', 'contact_form_slider', array(&$this, 'plugin_settings_page'));
			add_submenu_page('contact_form_slider', 'W8 Contact Form', 'Auto-Reply', 'manage_options', 'contact_form_slider_autoreply', array(&$this, 'plugin_settings_page_autoreply'));
			add_submenu_page('contact_form_slider', 'W8 Contact Form', 'Custom Fields', 'manage_options', 'contact_form_slider_customfields', array(&$this, 'plugin_settings_page_customfields'));
			add_submenu_page('contact_form_slider', 'W8 Contact Form', 'Logs', 'manage_options', 'contact_form_slider_logs', array(&$this, 'plugin_settings_page_logs'));
			add_submenu_page('contact_form_slider', 'W8 Contact Form', 'General Settings', 'manage_options', 'contact_form_slider_generalsettings', array(&$this, 'plugin_settings_page_generalsettings'));
			add_submenu_page('contact_form_slider', 'W8 Contact Form', 'Styles', 'manage_options', 'contact_form_slider_styles', array(&$this, 'plugin_settings_page_styles'));
			add_submenu_page('contact_form_slider', 'W8 Contact Form', 'Translations', 'manage_options', 'contact_form_slider_translations', array(&$this, 'plugin_settings_page_translations'));
			add_submenu_page('contact_form_slider', 'W8 Contact Form', 'Custom CSS', 'manage_options', 'contact_form_slider_customcss', array(&$this, 'plugin_settings_page_customcss'));
			add_submenu_page('contact_form_slider', 'W8 Contact Form', 'Update', 'manage_options', 'contact_form_slider_update', array(&$this, 'plugin_settings_page_update'));
			add_submenu_page('contact_form_slider', 'W8 Contact Form', 'Help', 'manage_options', 'contact_form_slider_help', array(&$this, 'plugin_settings_page_help'));
		}
		/**
		* Menu Callback
		**/		
		
		public function plugin_settings_page() {
			if( ! current_user_can( 'manage_options' ) ) {
				wp_die(esc_html__('You do not have sufficient permissions to access this page.', W8CONTACT_FORM_TEXT_DOMAIN));
			}
			// Render the settings template
			include(sprintf("%s/templates/settings_contacts.php", dirname(__FILE__)));
		}
		
		public function plugin_settings_page_autoreply() {
			if( ! current_user_can( 'manage_options' ) ) {
				wp_die(esc_html__('You do not have sufficient permissions to access this page.', W8CONTACT_FORM_TEXT_DOMAIN));
			}
			// Render the settings template
			include(sprintf("%s/templates/settings_autoreply.php", dirname(__FILE__)));
		}		
		
		public function plugin_settings_page_customfields() {
			if( ! current_user_can( 'manage_options' ) ) {
				wp_die(esc_html__('You do not have sufficient permissions to access this page.', W8CONTACT_FORM_TEXT_DOMAIN));
			}
			// Render the settings template
			include(sprintf("%s/templates/settings_customfields.php", dirname(__FILE__)));
		}		
		
		public function plugin_settings_page_logs() {
			if( ! current_user_can( 'manage_options' ) ) {
				wp_die(esc_html__('You do not have sufficient permissions to access this page.', W8CONTACT_FORM_TEXT_DOMAIN));
			}
			// Render the settings template
			include(sprintf("%s/templates/settings_logs.php", dirname(__FILE__)));
		}		
		
		public function plugin_settings_page_generalsettings() {
			if( ! current_user_can( 'manage_options' ) ) {
				wp_die(esc_html__('You do not have sufficient permissions to access this page.', W8CONTACT_FORM_TEXT_DOMAIN));
			}
			// Render the settings template
			include(sprintf("%s/templates/settings_general.php", dirname(__FILE__)));
		}		
		
		public function plugin_settings_page_styles() {
			if( ! current_user_can( 'manage_options' ) ) {
				wp_die(esc_html__('You do not have sufficient permissions to access this page.', W8CONTACT_FORM_TEXT_DOMAIN));
			}
			// Render the settings template
			include(sprintf("%s/templates/settings_styles.php", dirname(__FILE__)));
		}		
		
		public function plugin_settings_page_translations() {
			if( ! current_user_can( 'manage_options' ) ) {
				wp_die(esc_html__('You do not have sufficient permissions to access this page.', W8CONTACT_FORM_TEXT_DOMAIN));
			}
			// Render the settings template
			include(sprintf("%s/templates/settings_translations.php", dirname(__FILE__)));
		}		
		
		public function plugin_settings_page_customcss() {
			if( ! current_user_can( 'manage_options' ) ) {
				wp_die(esc_html__('You do not have sufficient permissions to access this page.', W8CONTACT_FORM_TEXT_DOMAIN));
			}
			// Render the settings template
			include(sprintf("%s/templates/settings_customcss.php", dirname(__FILE__)));
		}		
		
		public function plugin_settings_page_update() {
			if( ! current_user_can( 'manage_options' ) ) {
				wp_die(esc_html__('You do not have sufficient permissions to access this page.', W8CONTACT_FORM_TEXT_DOMAIN));
			}
			// Render the settings template
			include(sprintf("%s/templates/settings_update.php", dirname(__FILE__)));
		}		
		
		public function plugin_settings_page_help() {
			if( ! current_user_can( 'manage_options' ) ) {
				wp_die(esc_html__('You do not have sufficient permissions to access this page.', W8CONTACT_FORM_TEXT_DOMAIN));
			}
			// Render the settings template
			include(sprintf("%s/templates/settings_help.php", dirname(__FILE__)));
		}		

		public function settings_section_contact_form_slider() {
		
		}
		
		public function ajax_cfs_admin() {
			if ( isset( $_REQUEST[ 'cfscmd' ] ) ) {
				$cfscmd = strip_tags( $_REQUEST[ 'cfscmd' ] );
			}
			else {
				$cfscmd = '';
			}
			
			if ( $cfscmd == "addcustomfields" ) {
				$allowed_html = array(
				  'a' => array(
					'href' => array(),
					'title' => array(),
					'target' => array(),
				  )
				);
				$custom_fields = json_decode( stripslashes( $_REQUEST[ 'options' ] ) );
				foreach( $custom_fields[ 0 ] as $key=>$cf ) {
					$custom_fields[ 0 ][ $key ]->name = wp_kses( $cf->name, $allowed_html );
					$custom_fields[ 0 ][ $key ]->id = sanitize_text_field( $cf->id );
					$custom_fields[ 0 ][ $key ]->priority = sanitize_text_field( $cf->priority );
					$custom_fields[ 0 ][ $key ]->minlength = sanitize_text_field( $cf->minlength );
				}
				update_option( 'cfs-custom-fields', addslashes( json_encode( $custom_fields ) ) );
				die('success');
			}
		}
	}
}
?>