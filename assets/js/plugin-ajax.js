function save_settings_ajax(settings) {
	settings = JSON.stringify(settings);
	jQuery.ajax({
		url: plugin_ajax.ajax_url,
		type: 'POST',
		data: {
			'action': 'save_settings',
			'settings': settings
		},
		success: function(response) {
			// apply settings to frontend
			Swal.fire({
			  type: 'success',
			  title: 'Settings Updated!',
			  showConfirmButton: false,
			  timer: 2000
			});
		},
	});
}