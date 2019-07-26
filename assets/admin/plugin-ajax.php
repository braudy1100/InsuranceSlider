<?php 

function save_settings() {
	ob_clean();
	$settings = $_POST['settings'];

	if(get_option('plugin_settings')){
     	update_option('plugin_settings', $settings);
    }
    else {
      	add_option('plugin_settings', $settings);
    }

	wp_die();
}

add_action( 'wp_ajax_save_settings', 'save_settings' );

?>