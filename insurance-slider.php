<?php 
/**
* @package InsuranceSlider
*/
/*
Plugin Name: Insurance Slider
Plugin URI: https://github.com/braudy1100/Insurance-Slider
Description: This plugin will display insurance partners in a slider.
Version: 1.0.0
Author: Braudy Pedrosa
Author URI: https://github.com/braudy1100
License: GPLv2 or later
*/

if (! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * 
 */
class InsuranceSlider
{	

	public $plugin_basename;

	public function __construct() {
		$this->plugin_basename = plugin_basename( __FILE__ );
	}

	function register() {
		add_action('admin_head', array( $this, 'hide_cog' )) ;

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );

		add_action( 'admin_menu', array( $this, 'add_admin_page' ) );

		add_action( 'admin_menu', array( $this, 'add_menu_options' ) );

		add_filter( 'plugin_action_links_'.$this->plugin_basename, array( $this, 'settings_link' ) );

		add_filter('includes/advanced-custom-fields-pro/acf/settings/path', 'ir_acf_settings_path');

		add_filter('includes/advanced-custom-fields-pro/acf/settings/dir', 'ir_acf_settings_dir');

		include_once( plugin_dir_path( __FILE__ ) . 'includes/advanced-custom-fields-pro/acf.php' );
	}

	public function ir_acf_settings_path( $path ) {
		$path = plugin_dir_path( __FILE__ ) . 'acf/';
	    return $path;
	}

	public function ir_acf_settings_dir( $path ) {
	    $dir = plugin_dir_url( __FILE__ ) . 'acf/';
	    return $dir;
  }

	public function settings_link( $links ) {
		// add custom settings link
		$settings_link = '<a href="admin.php?page=insurance_slider">Settings</a>';
		array_push( $links, $settings_link );
		return $links;
	}

	public function add_admin_page() {
		add_menu_page( 'Insurance Slider', 'Insurance Slider', 'manage_options', 'insurance_slider', array( $this, 'load_admin_page' ), 'dashicons-screenoptions', 65 );
	}

	public function load_admin_page() {
		require_once plugin_dir_path( __FILE__ ) . 'templates/admin-page.php';
	}

	public function add_menu_options() {
		if( function_exists('acf_add_options_page') ) {
	
			acf_add_options_sub_page(array(
				'page_title' 	=> 'Settings',
				'menu_title'	=> 'Settings',
				'menu_slug' 	=> 'settings',
				'parent_slug'	=> 'insurance_slider',
			));	
		}
	}

	public function hide_cog() {
	   echo '<style type="text/css">
	           h2.hndle.ui-sortable-handle a.acf-hndle-cog { display: none; visibility: hidden }
	         </style>';
	}

	function enqueue() {
		wp_enqueue_script( 'firebase-app-script', 'https://www.gstatic.com/firebasejs/6.3.0/firebase-app.js' );
		wp_enqueue_script( 'firebase-firestore-script', 'https://www.gstatic.com/firebasejs/6.3.0/firebase-firestore.js' );
		wp_enqueue_script( 'firebase--storage-script', 'https://www.gstatic.com/firebasejs/6.3.0/firebase-storage.js' );
		wp_enqueue_script( 'firebase-setup', plugins_url( '/includes/firebase-init.js', __FILE__ ) );
		wp_enqueue_style( 'admin-style', plugins_url( '/assets/admin/admin-style.css', __FILE__ ) );
		wp_enqueue_script( 'admin-script', plugins_url( '/assets/admin/admin-script.js', __FILE__ ) );
	}

	function activate() {
		flush_rewrite_rules();
	}

	function deactivate() {
		flush_rewrite_rules();
	}
}

if( class_exists( 'InsuranceSlider' ) ) {
	$insuranceSlider = new InsuranceSlider();
	$insuranceSlider->register();
}

// activation
register_activation_hook( __FILE__, array($insuranceSlider, 'activate' ) );

// deactivation
register_deactivation_hook( __FILE__, array($insuranceSlider, 'deactivate' ) );

// uninstall
