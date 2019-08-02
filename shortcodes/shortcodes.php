<?php 

function display_insurance_slider( $atts ) {
	$settings = get_option('plugin_settings', true);
	$decoded = json_decode(stripslashes($settings));
	$output = '<div class="insurance-slider-container">';


	$sliderSettings = [
		"autoplay" => get_field('autoplay', 'option'),
		"autoplay_speed" => get_field('autoplay_speed', 'option'),
		"center_mode" => get_field('center_mode', 'option'),
		"center_mode_padding" => get_field('center_mode_padding', 'option'),
		"enable_infinite_sliding" => get_field('enable_infinite_sliding', 'option'),
		"enable_lazy_load" => get_field('enable_lazy_load', 'option'),
		"enable_pause_on_hover" => get_field('enable_pause_on_hover', 'option'),
		"show_dots_navigation" => get_field('show_dots_navigation', 'option'),
		"show_arrows" => get_field('show_arrows', 'option'),
		"slides_to_show" => get_field('slides_to_show', 'option'),
		"previous_arrow_image" => get_field('previous_arrow_image', 'option'),
		"next_arrow_image" => get_field('next_arrow_image', 'option'),
	];

	foreach ($decoded as $partner) {
		$name = $partner->name;
		$url = $partner->url;
		$image_url = $partner->image_url;

		$output .= '<div class="slider-item"><img class="insurance-image" src="'.$image_url.'" /></div>';
	}
	$output .= '</div>';

	echo $output;

	wp_enqueue_script( 'slick-js', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery') );
	wp_enqueue_style( 'slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css' );
	wp_enqueue_script( 'short-script', plugins_url( '/js/shortcodes.js', __FILE__ ), array('jquery') );
	wp_add_inline_script( 'slick-js', 'var sliderSettings = "'.str_replace("\"","'",json_encode($sliderSettings)).'";' );


}

add_shortcode( 'insurance_slider', 'display_insurance_slider' );