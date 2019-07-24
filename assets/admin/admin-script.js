jQuery(document).ready(function() {

    // Modal controls
    jQuery('.form-close').click(function(){ jQuery('.add-partner-modal').hide(); });
    jQuery('.form-open').click(function(){ jQuery('.add-partner-modal').show(); });

    const partnerList = document.querySelector('.partners');
    const addForm = document.querySelector('#add-partner-form');
    const updateBtn = document.querySelector('.update-btn');

    // fetch and render partner list
    function displayPartners(doc) {
        // create partner div
        let partnerContainer = document.createElement('div');
        partnerContainer.setAttribute('data-id', doc.id);
        partnerContainer.setAttribute('class', 'partner');

        let currentImage = document.createElement('img');
        currentImage.setAttribute('src', doc.data().image_url);
        currentImage.setAttribute('alt', doc.data().name);

        // create name field
        let nameLabel = document.createElement('label');
        nameLabel.innerHTML = 'Name:';
        let name = document.createElement('input');
        name.setAttribute('type', 'text');
        name.setAttribute('value', doc.data().name);
        name.setAttribute('class', 'partner-name');

        // create url field
        let urlLabel = document.createElement('label');
        urlLabel.innerHTML = 'URL:';
        let url = document.createElement('input');
        url.setAttribute('type', 'text');
        url.setAttribute('value', doc.data().url);
        url.setAttribute('class', 'partner-url');

        // create image upload field
        let imageLabel = document.createElement('label');
        imageLabel.innerHTML = 'Upload new image:';
        let image = document.createElement('input');
        image.setAttribute('type', 'file');
        image.setAttribute('accept', 'image/*');
        image.setAttribute('class', 'partner-image');

        // create delete button
        let deleteButton = document.createElement('a');
        deleteButton.textContent = "X";
        deleteButton.setAttribute('class', 'delete-btn');
        deleteButton.setAttribute('href', '#');

        // append elements to parent
        partnerContainer.appendChild(currentImage);
        partnerContainer.appendChild(nameLabel);
        partnerContainer.appendChild(name);
        partnerContainer.appendChild(urlLabel);
        partnerContainer.appendChild(url);
        partnerContainer.appendChild(imageLabel);
        partnerContainer.appendChild(image);
        partnerContainer.appendChild(deleteButton);

        partnerList.appendChild(partnerContainer);


        // remove item
        deleteButton.addEventListener('click', (e) => {
            e.stopPropagation();
            let id = e.target.parentElement.getAttribute('data-id');
            
            Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
                db.collection('partners').doc(id).delete();
              }
            });
        });

        detectUpdates();
    }

    // Adding new item
    addForm.addEventListener('submit', (e) => {
      e.preventDefault();

      var name = addForm.name.value;
      var url = addForm.url.value;
      var imageURL = addForm.imageUrl.value;

      var imageObject = document.getElementById("imageUrl");
      var imageFile = imageObject.files[0];
      var imageFileName = convertToSlug(name) + "-" + Date.now();
      
      addPartner(name, url, imageFile, imageFileName);
    });


    // Real time data rendering
    db.collection('partners').orderBy('name').onSnapshot(snapshot => {
        let changes = snapshot.docChanges();
        changes.forEach(change => {
            if (change.type == 'added') {
                jQuery('.loader').hide();
                displayPartners(change.doc);
                snapshot.docChanges();
            } else if (change.type == 'removed') {
                let childToRemove = partnerList.querySelector('[data-id=' + change.doc.id + ']');
                partnerList.removeChild(childToRemove);
            }
        });
    });

    
    // update changes
      updateBtn.addEventListener('click', (e) => {
        let timerInterval
        Swal.fire({
          title: 'Please wait ..',
          html: 'Updating data ..',
          timer: 3000,
          onBeforeOpen: () => {
            Swal.showLoading();
          },
          onClose: () => {
            clearInterval(timerInterval)
          }
        }).then((result) => {
          updateCollection.forEach(id => {
              let parent = jQuery('[data-id=' + id + ']');
              let name = parent.find('.partner-name').val();
              let url = parent.find('.partner-url').val();
              let imageObject = parent.find('.partner-image');

              let imageFile = parent.find('.partner-image').prop('files')[0];
              let imageFileName = convertToSlug(name) + "-" + Date.now();
              // console.log(imageFile);
              updatePartner(id, name, url, imageFile, imageFileName);
          });

          if (result.dismiss === Swal.DismissReason.timer) {
            console.log('items updated');
          }
        })
      });
});