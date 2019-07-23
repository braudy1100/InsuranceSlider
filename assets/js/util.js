function addPartner(name, url, fileObject, fileName) {
    var storageRef = storage.ref('/images/'+ fileName);

    var uploadTask = storageRef.put(fileObject);

    uploadTask.on('state_changed', function(snapshot){ 
          switch (snapshot.state) { 
            case firebase.storage.TaskState.PAUSED: 
              console.log('Upload is paused'); 
              break; 
            case firebase.storage.TaskState.RUNNING: 
              console.log('Upload is running'); 
              break; 
          } 
    }, 
    function(error) {
        console.log(error); 
    },
    function() { 
      // get the uploaded image url back 
      uploadTask.snapshot.ref.getDownloadURL().then( 
        function(downloadURL) { 

          // then add partner
          db.collection('partners').add({
		      name: name,
		      url: url,
		      image_url: downloadURL
	   	  });

	   	  Swal.fire({
			  type: 'success',
			  title: 'Item added',
			  showConfirmButton: false,
			  timer: 2000
			});
        }); 
    });
}


function updatePartner(id, name, url, fileObject, fileName) {
    var storageRef = storage.ref('/images/'+ fileName);

    if(fileObject != undefined) {
	    var uploadTask = storageRef.put(fileObject);
	    uploadTask.on('state_changed', function(snapshot){ 
	          switch (snapshot.state) { 
	            case firebase.storage.TaskState.PAUSED: 
	              console.log('Upload is paused'); 
	              break; 
	            case firebase.storage.TaskState.RUNNING: 
	              console.log('Upload is running'); 
	              break; 
	          } 
	    }, 
	    function(error) {
	        console.log(error); 
	    },
	    function() { 
	      // get the uploaded image url back 
	      uploadTask.snapshot.ref.getDownloadURL().then( 
	        function(downloadURL) { 

	          // then update partner
	          if(fileObject != undefined) {
		          db.collection('partners').doc(id).update({
				      name: name,
				      url: url,
				      image_url: downloadURL
			   	  });
			   	  console.log(jQuery('[data-id=' + id + ']').find('img').attr('src', downloadURL));
		      }

		   	  Swal.fire({
				  type: 'success',
				  title: 'Item updated',
				  showConfirmButton: false,
				  timer: 1000
				});
	        }); 
	    });
	} else {
		db.collection('partners').doc(id).update({
	      name: name,
	      url: url 
		});
	}
}


function convertToSlug(Text) {
  return Text
      .toLowerCase()
      .replace(/ /g,'-')
      .replace(/[^\w-]+/g,'')
      ;
}