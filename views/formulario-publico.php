<?php
include_once("../functions/quitar_tildes.php");
include_once("../connection/db_connection.php");
include_once("../admin/templates/header.php");
$conn = mysqli_connect($host, $user, $pw, $db);

$sql = "SELECT * FROM comites";
$array_comites = $conn->query($sql);

$sql = "SELECT * FROM cargos";
$array_cargos = $conn->query($sql);



?>



<body>
  <div class="card">
    <div class="card-header">
      <h4 class="card-title">Formulario Público Anuario</h4>
    </div>
    <div class="card-body">
      <form role="form" enctype="multipart/form-data" name="crear-miembro-publico" id="crear-miembro-publico" method="post" action="../functions/modelo-publico.php">

        <?php include("../templates/datos-miembro.php"); ?>

        <hr class="mt-3">
        <h5 class="mt-3 text-primary">*La siguiente infomacion es opcional y no se mostrara en el anuario</h5>
        <div class="form-group">
          <input class="form-control" type="text" name="ocupacionActual" id="ocupacionActual">
          <label class="mb-1" for="">Ocupación Actual</label>
        </div>

        <div class="form-group">
          <textarea class="form-control" type="text" name="contactos" id="contactos"></textarea>
          <label class="mb-1" for="">Exintegrantes de la rama que conozcas</label>
        </div>

        <div class="card-footer">
          <input type="hidden" name="registro" value="nuevo">
          <button type="submit" class="btn btn-primary">Añadir</button>
        </div>

      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <script>
  Swal.fire({
    title: 'Política De Datos',
    text: "De acuerdo con la Ley Estatutaria 1581 de 2012 de Protección de Datos y con el Decreto 1377 de 2013, el usuario acepta que los datos consignados en el presente formulario sean incorporados en una base de datos responsabilidad de La Asociación Rama Estudiantil IEEE de la Universidad del Cauca. ",
    icon: 'question',
    showCancelButton: true,
    cancelButtonColor: '#d33',
    cancelButtonText: 'No acepto',
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'Acepto',

  }).then((result) => {
    if (!(result.isConfirmed)) {
      window.location.href = "../index.php";
    } else {
      Swal.fire({
        title: "Confirmado",
        text: "Gracias por aceptar las  políticas",
        icon: "success"
      })
    }
  })
</script>

<script>
  document.getElementById("segundoNombre").onkeyup = function() {
    var a = document.getElementById("segundoNombre").value;
    if (!a) {
      document.getElementById("nombrePreferido2").disabled = true
    } else {
      document.getElementById("nombrePreferido2").disabled = false
    }
  }

  document.getElementById("coordinador").onclick = function() {
    if (document.getElementById("coord_academico").disabled) {
      document.getElementById("coord_academico").disabled = false
      document.getElementById("coord_ludicas").disabled = false
      document.getElementById("coord_logistica").disabled = false
      document.getElementById("coord_patrocinio").disabled = false
      document.getElementById("coord_publicidad").disabled = false
    } else {
      document.getElementById("coord_academico").disabled = true
      document.getElementById("coord_ludicas").disabled = true
      document.getElementById("coord_logistica").disabled = true
      document.getElementById("coord_patrocinio").disabled = true
      document.getElementById("coord_publicidad").disabled = true
    }
  }

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
      ready: function() {
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
      crop: function(event) {
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
        .then(function(res) {
          return res.arrayBuffer();
        })
        .then(function(buf) {
          return new File([buf], filename, {
            type: mimeType
          });
        })
      );
    }
</script>

<?php include("../admin/templates/footer.php");?>



