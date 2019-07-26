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

include_once(plugin_dir_path( __FILE__ ) . '/InsuranceSlider.php' );

// initate class and run
if( class_exists( 'InsuranceSlider' ) ) {
	$insuranceSlider = new InsuranceSlider();

	// activation
	register_activation_hook( __FILE__, array($insuranceSlider, 'activate' ) );

	// deactivation
	register_deactivation_hook( __FILE__, array($insuranceSlider, 'deactivate' ) );

	$insuranceSlider->register();
}