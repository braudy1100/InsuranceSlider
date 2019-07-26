jQuery(document).ready(function(){
	// fieldset reference
	const partnersField = document.querySelector('.partners-fieldset');

	// add carriers from Database to Checkbox
	function addCarrierCheckbox(doc) {
		// create checkbox and label container
		let div = document.createElement('div');
		div.setAttribute('class', 'checkbox-group');

		// create input checkbox reference
		let checkbox = document.createElement('input');
        checkbox.setAttribute('type', 'checkbox');
        checkbox.setAttribute('id', doc.id);
        checkbox.setAttribute('data-url', doc.data().url);
        checkbox.setAttribute('data-imageurl', doc.data().image_url);
        checkbox.setAttribute('value', doc.data().name);
        checkbox.setAttribute('class', 'partner-name');
        checkbox.setAttribute('name', 'partner_group');
        
        let label = document.createElement('label');
        label.setAttribute('for', doc.id);
        label.innerHTML = doc.data().name;

        div.appendChild(checkbox);
        div.appendChild(label);

        partnersField.appendChild(div);
	}

	// fetch carriers Database
	fetchDataFromDB().then( function(documents){
		documents.forEach( doc => {
			addCarrierCheckbox(doc);
		});

		// get settings if exist and set 
		settings.forEach(checkbox => {
			var id = checkbox.id;
			jQuery('#'+id).prop('checked', true);
			console.log(id);
		});
	});

	// save settings on click
	jQuery("button").click(function(){
	    var selected = [];
	    jQuery.each(jQuery("input[name='partner_group']:checked"), function(){            
	        var item = {
	        	name: jQuery(this).val(),
	        	id: jQuery(this).attr('id'),
	        	url: jQuery(this).attr('data-url'),
	        	image_url: jQuery(this).attr('data-imageurl')
	        }
	        selected.push(item);
	    });
	    save_settings_ajax(selected);			    
	});

});