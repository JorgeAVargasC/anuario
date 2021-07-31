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
          <div class="card-body">
            <div class="form-group">
              <label for="primerNombre">Primer Nombre</label>
              <input type="text" class="form-control" id="primerNombre" name="primerNombre" placeholder="Ingresa tu Primer Nombre" required>
            </div>
            <div class="form-group">
              <label for="segundoNombre">Segundo Nombre</label>
              <input type="text" class="form-control" id="segundoNombre" name="segundoNombre" placeholder="Ingresa tu Segundo Nombre">
            </div>
            <div class="form-group">
              <label for="primerApellido">Primer Apellido</label>
              <input type="text" class="form-control" id="primerApellido" name="primerApellido" placeholder="Ingresa tu Primer Apellido" required>
            </div>
            <div class="form-group">
              <label for="segundoApellido">Segundo Apellido</label>
              <input type="text" class="form-control" id="segundoApellido" name="segundoApellido" placeholder="Ingresa tu Segundo Apellido">
            </div>

            <h4>Nombre preferido</h4>
            <div class="form-check">
                <input type="radio" class="form-check-input" id="nombrePreferido" value=1 name="nombrePreferido" checked>
                <label for="nombrePreferido1" class="form-check-label">1</label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" id="nombrePreferido" value=2 name="nombrePreferido">
                <label for="nombrePreferido2" class="form-check-label">2</label>
            </div>
            <div class="form-group">
                <label for="nombreEnRama">Nombre En Rama</label>
                <input type="text" class="form-control" id="nombreEnRama" name="nombreEnRama" placeholder="Ingresa tu Nombre En Rama" required>
            </div>
            <div class="form-group">
                <label for="anioIngresoRama">Año de Ingreso Rama</label>
                <input type="number" class="form-control" id="anioIngresoRama" name="anioIngresoRama" min="1985" max="<?php echo date("Y");?>" placeholder="2020" required>
            </div>
            <div class="form-group">
                <label for="anioSalidaRama">Año de Salida Rama</label>
                <input type="number" class="form-control" id="anioSalidaRama" name="anioSalidaRama" min="1985" max="<?php echo date("Y")+2;?>" placeholder="<?php echo date("Y")+2;?>" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo Electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo" placeholder="Ingresa tu Correo Electronico">
            </div>
            <div class="form-group">
                <label for="celular">Celular</label>
                <input type="number" class="form-control" id="celular" name="celular" placeholder="3157003333">
            </div>
            <div class="form-group">
                <label for="frase">Frase</label>
                <input type="text" class="form-control" id="frase" name="frase" placeholder="Ingresa tu Frase">
            </div>

            <div class="form-group">
                <label for="imagen-miembro">Imagen <span style="font-weight: lighter;">(maximo 1.5Mb)</span></label>
                <div class="input-group">
                    <!-- <input type="file" id="imagen-miembro" name="imagen-miembro" accept="image/png, image/jpeg, image/jpg" data-target="#modal" data-toggle="modal" required> -->
                    <input type="file" id="imagen-miembro" name="imagen-miembro" accept="image/png, image/jpeg, image/jpg" required>
                    <label for="imagen-miembro"></label>
                </div>
                <div id="cropped-image-container">
                  <img id="cropped-image" src="#" width="200vw" alt="Cropped Image">
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="modalLabel">Personaliza tu imagen</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="image-preview">
                      <div id="image-container">
                        <img id="image" src="#" alt="Picture">
                      </div>
                      <div id="result">
                        <h5>Previsualización:</h5>
                        <br>
                        <div id="image-result">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" id="crop-button" class="btn btn-primary">Crop</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
                <label for="urlLinkedin">URL Linkedin</label>
                <input type="text" class="form-control" id="urlLinkedin" name="urlLinkedin" placeholder="Ingresa la URL Linkedin">
            </div>

            <!-- Check boxes -->
            <br>
            <h4>Comites a los que perteneció</h4>
            <?php
            foreach($array_comites as $comite){
              $comite_format=strtolower(quitar_tildes($comite['comite']));
              ?>
              <div class="form-check">
              <input type="checkbox" class="form-check-input" id="<?php echo $comite_format;?>" name="<?php echo $comite_format;?>" value="<?php echo $comite_format;?>">
              <label for="<?php echo $comite_format;?>" class="form-check-label"><?php echo $comite['comite'];?></label>
              </div>
              <?php
            }
            ?>
            
            <br>
            <h4>Cargos que ocupó</h4>
            <?php
            foreach($array_cargos as $cargo){
              if($cargo['id'] != 10){
                  // Coordinador TET se convierte a coordinadorTET
                  $cargo_format=lcfirst(str_replace(' ','', quitar_tildes($cargo['cargo'])));
              ?>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="<?php echo $cargo_format;?>" name="<?php echo $cargo_format;?>" value="<?php echo $cargo_format;?>">
                    <label for="<?php echo $cargo_format;?>" class="form-check-label"><?php echo $cargo['cargo']?></label>
                </div>
              <?php
              }
            }
            ?>

            <br>
            <h4>Comites que Coordinó</h4>
            <?php

            foreach($array_comites as $comite){
              $comite_format=strtolower(quitar_tildes($comite['comite']));
              ?>
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="<?php echo 'coord_'.$comite_format;?>" name="<?php echo 'coord_'.$comite_format;?>" value="<?php echo 'coord'.$comite_format;?>"disabled>
                <label for="<?php echo 'coord_'.$comite_format;?>" class="form-check-label"><?php echo $comite['comite'];?></label>
              </div>
              <?php                
            }              
            ?>

          </div>
            <!-- /.card-body -->
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
      crop: function (event){
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

    archivo.addEventListener('change', ()=> {
      $('#modal').modal('show');
      setTimeout(() => {
        image.src = URL.createObjectURL(archivo.files[0]);
        cropper.replace(image.src);
        image.style.display = 'block';  
      }, 200);
    })

    cropButton.addEventListener('click', ()=>{
      $('#modal').modal('hide');
      document.getElementById('cropped-image-container').style.display = 'flex';
      let imageData = cropper.getCroppedCanvas().toDataURL(archivo.files[0].type);
      document.getElementById('cropped-image').src = imageData;
      urlToFile(imageData, archivo.files[0].name, archivo.files[0].type)
      .then(file =>{
        // Create a DataTransfer instance and add a newly created file
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        // Assign the DataTransfer files list to the file input
        archivo.files = dataTransfer.files;
      });
    });

    function urlToFile(url, filename, mimeType){
        return (fetch(url)
            .then(function(res){return res.arrayBuffer();})
            .then(function(buf){return new File([buf], filename, {type:mimeType});})
        );
    }

    
  })
</script>


<?php
include_once 'templates/footer.php';
?>
