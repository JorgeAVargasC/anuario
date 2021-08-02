<?php
include_once 'funciones/sesiones.php';
include_once '../connection/db_connection.php';
include_once 'templates/header.php';
include_once 'templates/barra.php';
include_once 'templates/navegacion.php';
include_once 'funciones/quitar_tildes.php'

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Crear nuevo miembro</h1>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Crear Miembro</h3>
      </div>
      <div class="card-body">

        <?php
        $conn = mysqli_connect($host, $user, $pw, $db);

        $sql1 = "SELECT * FROM comites";
        $array_comites = $conn->query($sql1);

        $sql3 = "SELECT * FROM cargos";
        $array_cargos = $conn->query($sql3);

        ?>

        <form role="form" enctype="multipart/form-data" name="crear-registro-miembro" id="crear-registro-miembro" method="post" action="modelo-miembro.php">
          <?php include("../templates/datos-miembro.php") ?>

          <div class="card-footer">
            <input type="hidden" name="registro" value="nuevo">
            <button type="submit" class="btn btn-primary">Añadir</button>
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js" integrity="sha512-ooSWpxJsiXe6t4+PPjCgYmVfr1NS5QXJACcR/FPpsdm6kqG1FmQ2SVyg2RXeVuCRBLr0lWHnWJP6Zs1Efvxzww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.js" integrity="sha512-ZK6m9vADamSl5fxBPtXw6ho6A4TuX89HUbcfvxa2v2NYNT/7l8yFGJ3JlXyMN4hlNbz0il4k6DvqbIW5CCwqkw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    // Para habilitar checkbox del coordinador
    document.getElementById("coordinador").onclick = function() {
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
    document.getElementById("segundoNombre").onkeyup = function() {
      var a = document.getElementById("segundoNombre").value;
      if (!a) {
        document.getElementById("nombrePreferido2").disabled = true
      } else {
        document.getElementById("nombrePreferido2").disabled = false
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


  })
</script>


<?php
include_once 'templates/footer.php';
?>