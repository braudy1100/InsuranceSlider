jQuery(document).ready(function(){
  const partnerList = document.querySelector('.partners');
  const addForm = document.querySelector('#add-partner-form');

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

  // create url field
  let urlLabel = document.createElement('label');
  urlLabel.innerHTML = 'URL:';
  let url = document.createElement('input');
  url.setAttribute('type', 'text');
  url.setAttribute('value', doc.data().url);

  // create image upload field
  let imageLabel = document.createElement('label');
  imageLabel.innerHTML = 'Upload new image:';
  let image = document.createElement('input');
  image.setAttribute('type', 'file');
  image.setAttribute('accept', 'image/*')

  // append elements to parent
  partnerContainer.appendChild(currentImage);
  partnerContainer.appendChild(nameLabel);
  partnerContainer.appendChild(name);
  partnerContainer.appendChild(urlLabel);
  partnerContainer.appendChild(url);
  partnerContainer.appendChild(imageLabel);
  partnerContainer.appendChild(image);

  partnerList.appendChild(partnerContainer);
}

// Adding new item
// addForm.addEventListener('submit', (e) => {
//   e.preventDefault();
//   db.collection('partners').add({
//     name: addForm.name.value,
//     url: addForm.url.value,
//     image_url: addForm.imageUrl.value
//   });

//   // clear fields
//   addForm.name.value = '';
//   addForm.url.value = '';
//   addForm.imageUrl.value = '';
// });


// Real time data rendering
db.collection('partners').orderBy('name').onSnapshot(snapshot => {
  let changes = snapshot.docChanges();
  changes.forEach(change => {
    if(change.type == 'added') {
      jQuery('.loader').hide();
      displayPartners(change.doc);
    } else if(change.type == 'removed') {
      let childToRemove = partnerList.querySelector('[data-id=' + change.doc.id +']');
      partnerList.removeChild(childToRemove);
    }
  });
});

});