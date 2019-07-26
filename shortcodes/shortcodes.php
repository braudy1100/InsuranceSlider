<?php 

function display_insurance_slider( $atts ) {
	$settings = get_option('plugin_settings', true);
	$decoded = json_decode(stripslashes($settings));

	foreach ($decoded as $partner) {
		$name = $partner->name;
		$url = $partner->url;
		$image_url = $partner->image_url;

		echo '<img class="testimg" src="'.$image_url.'" />';
	}

	wp_enqueue_script( 'short-script', plugins_url( '/js/shortcodes.js', __FILE__ ), array('jquery') );

}

add_shortcode( 'insurance_slider', 'display_insurance_slider' );