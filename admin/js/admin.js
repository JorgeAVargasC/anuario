document.addEventListener('DOMContentLoaded', () => {
  // Para habilitar checkbox del coordinador
  document.getElementById("coordinador").onclick = function () {
    if (document.getElementById("coord_academico").disabled) {
      document.getElementById("coord_academico").disabled = false;
      document.getElementById("coord_ludicas").disabled = false;
      document.getElementById("coord_logistica").disabled = false;
      document.getElementById("coord_patrocinio").disabled = false;
      document.getElementById("coord_publicidad").disabled = false;
    } else {
      document.getElementById("coord_academico").disabled = true;
      document.getElementById("coord_ludicas").disabled = true;
      document.getElementById("coord_logistica").disabled = true;
      document.getElementById("coord_patrocinio").disabled = true;
      document.getElementById("coord_publicidad").disabled = true;
    }
  }

  // Para deshabilitar radius si no hay segundo nombre
  document.getElementById("segundoNombre").onkeyup = function () {
    var a = document.getElementById("segundoNombre").value;
    if (!a) {
      document.getElementById("nombrePreferido2").disabled = true
    } else {
      document.getElementById("nombrePreferido2").disabled = false
    }
  }

  // Recorte de imagen
  let image = document.getElementById('image');
  let cropButton = document.getElementById('crop-button');
  let result = document.getElementById('image-result');
  let archivo = document.getElementById("imagen-miembro");
  let croppable = false;
  let cropper = new Cropper(image, {
    aspectRatio: 1,
    viewMode: 3,
    dragMode: 'move',
    autoCropArea: 0.6,
    toggleDragModeOnDblclick: false,
    ready: function () {
      var clone = this.cloneNode();
      clone.className = '';
      clone.style.cssText = (
        'display: block;' +
        // 'width: 100%;' +
        'height: 40vh;' +
        'min-width: 0;' +
        'min-height: 0;' +
        'max-width: none;' +
        'max-height: none;'
      );
      result.appendChild(clone.cloneNode());
      croppable = true;
    },
    crop: function (event) {
      if (!croppable) {
        return;
      }
      let data = event.detail;
      let cropper = this.cropper;
      let imageData = cropper.getImageData();
      let previewAspectRatio = data.width / data.height;
      let previewImage = result.getElementsByTagName('img').item(0);
      let previewWidth = result.offsetWidth;
      let previewHeight = previewWidth / previewAspectRatio;
      let imageScaledRatio = data.width / previewWidth;
      result.style.height = previewHeight + 'px';
      previewImage.style.width = imageData.naturalWidth / imageScaledRatio + 'px';
      previewImage.style.height = imageData.naturalHeight / imageScaledRatio + 'px';
      previewImage.style.marginLeft = -data.x / imageScaledRatio + 'px';
      previewImage.style.marginTop = -data.y / imageScaledRatio + 'px';
    },
  });

  archivo.addEventListener('change', () => {
    $('#modal').modal('show');
    setTimeout(() => {
      image.src = URL.createObjectURL(archivo.files[0]);
      cropper.replace(image.src);
      image.style.display = 'block';
    }, 200);
  })

  cropButton.addEventListener('click', () => {
    $('#modal').modal('hide');
    document.getElementById('cropped-image-container').style.display = 'flex';
    let imageData = cropper.getCroppedCanvas().toDataURL(archivo.files[0].type);
    document.getElementById('cropped-image').src = imageData;
    urlToFile(imageData, archivo.files[0].name, archivo.files[0].type)
      .then(file => {
        // Create a DataTransfer instance and add a newly created file
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        // Assign the DataTransfer files list to the file input
        archivo.files = dataTransfer.files;
      });
  });

  function urlToFile(url, filename, mimeType) {
    return (fetch(url)
      .then(function (res) {
        return res.arrayBuffer();
      })
      .then(function (buf) {
        return new File([buf], filename, {
          type: mimeType
        });
      })
    );
  }
})