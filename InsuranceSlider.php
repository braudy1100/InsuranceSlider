<?php

class InsuranceSlider
{	

	public $plugin_basename;

	public function __construct() {
		$this->plugin_basename = plugin_basename( __FILE__ );
	}

	function register() {
		include_once(plugin_dir_path( __FILE__ ) . '/assets/admin/plugin-ajax.php' );

		add_action('admin_head', array( $this, 'hide_cog' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );

		add_action( 'admin_menu', array( $this, 'add_admin_page' ) );

		add_action( 'admin_menu', array( $this, 'add_menu_options' ) );

		add_filter( 'plugin_action_links_'.$this->plugin_basename, array( $this, 'settings_link' ) );

		add_filter('includes/advanced-custom-fields-pro/acf/settings/path', 'ir_acf_settings_path');

		add_filter('includes/advanced-custom-fields-pro/acf/settings/dir', 'ir_acf_settings_dir');

		include_once( plugin_dir_path( __FILE__ ) . 'includes/advanced-custom-fields-pro/acf.php' );

		include_once( plugin_dir_path( __FILE__ ) . 'shortcodes/shortcodes.php' );

		// add_action( 'init', array($this, 'validate_user'), 10, 2 );
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

	// add plugin pages in WP Dashboard
	public function add_admin_page() {
		add_menu_page( 'Insurance Slider', 'Insurance Slider', 'manage_options', 'insurance_slider', array( $this, 'load_admin_page' ), 'dashicons-screenoptions', 65 );
		add_submenu_page( 'insurance_slider', 'Shortcode', 'Shortcode', 'manage_options', 'insurance_slider_shortcode', array( $this, 'load_admin_subpage' ) );
	}

	// add settings submenu
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

	// load admin page and script
	public function load_admin_page() {
		require_once plugin_dir_path( __FILE__ ) . 'templates/admin-page.php';
		wp_enqueue_script( 'admin-script', plugins_url( '/assets/admin/js/admin-script.js', __FILE__ ) );
	}

	// load admin subpage and script
	public function load_admin_subpage() {
		require_once plugin_dir_path( __FILE__ ) . 'templates/shortcode-page.php';
		wp_enqueue_script( 'subpage-script', plugins_url( '/assets/admin/js/submenu-script.js', __FILE__ ) );
	}

	public function hide_cog() {
	   echo '<style type="text/css">
	           h2.hndle.ui-sortable-handle a.acf-hndle-cog { display: none; visibility: hidden }
	         </style>';
	}

	// enqueue all scrips and style
	function enqueue() {
		wp_enqueue_style( 'general-style', plugins_url( '/assets/admin/css/general-style.css', __FILE__ ) );
		wp_enqueue_style( 'slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css' );
		
		wp_enqueue_script( 'sweet-alert-master', 'https://cdn.jsdelivr.net/npm/sweetalert2@8' );
		wp_enqueue_script( 'slick-js', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js' );
		wp_enqueue_script( 'firebase-app-script', 'https://www.gstatic.com/firebasejs/6.3.0/firebase-app.js' );
		wp_enqueue_script( 'firebase-firestore-script', 'https://www.gstatic.com/firebasejs/6.3.0/firebase-firestore.js' );
		wp_enqueue_script( 'firebase-storage-script', 'https://www.gstatic.com/firebasejs/6.3.0/firebase-storage.js' );
		wp_enqueue_script( 'firebase-setup', plugins_url( '/includes/firebase-init.js', __FILE__ ) );
		wp_enqueue_script( 'utility-script', plugins_url( '/assets/js/util.js', __FILE__ ) );
		wp_enqueue_script( 'plugin-ajax-js', plugins_url( '/assets/js/plugin-ajax.js', __FILE__ ) );
		wp_localize_script( 'plugin-ajax-js', 'plugin_ajax', array('ajax_url' => admin_url( 'admin-ajax.php' )));
	}

	// run on plugin activate
	function activate() {
		flush_rewrite_rules();

	}

	// run on plugin deactivate
	function deactivate() {
		flush_rewrite_rules();
	}

	// function validate_user() {
	// 	if( is_admin() && get_option( 'plugin_activated' ) == 'active' ) {
	// 		wp_enqueue_script( 'activate-script', plugins_url( '/assets/js/plugin/activate.js', __FILE__ ) );
	// 	}
	// }
}