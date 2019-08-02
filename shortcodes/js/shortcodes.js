jQuery(document).ready(function(){

	var formattedSettings = sliderSettings.replace(/'/g, '"');

	var settings = JSON.parse(formattedSettings);

	jQuery('.insurance-slider-container').slick({
	  autoplay: settings['autoplay'] ? true : false,
	  autoplaySpeed: settings['autoplay_speed'],
	  arrows: settings['show_arrows'] ? true : false,
	  centerMode: settings['center_mode'] ? true : false,
	  centerPadding: settings['center_mode_padding'],
	  dots: settings['show_dots_navigation'] ? true : false,
	  infinite: settings['enable_infinite_sliding'] ? true : false,
	  lazyLoad: settings['enable_lazy_load'] ? true : false,
	  pauseOnHover: settings['enable_pause_on_hover'] ? true : false,
	  slidesToShow: settings['slides_to_show'],
	  slidesToScroll: settings['slides_to_show']
	});

});

