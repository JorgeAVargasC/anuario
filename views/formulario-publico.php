<?php
include_once("../functions/quitar_tildes.php");
include_once("../connection/db_connection.php");
$conn = mysqli_connect($host, $user, $pw, $db);

$sql = "SELECT * FROM comites";
$array_comites = $conn->query($sql);

$sql = "SELECT * FROM cargos";
$array_cargos = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Formulario Público</title>
</head>

<body>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Formulario Público Anuario</h3>
    </div>
    <div class="card-body">
      <form role="form" enctype="multipart/form-data" name="" id="" method="post" action="../functions/modelo-publico.php">
        <div class="card-body">
          <div class="form-group mb-3">
            <label class="mb-1" for="primerNombre">Primer Nombre</label>
            <input type="text" class="form-control" id="primerNombre" name="primerNombre" placeholder="Ingresa tu Primer Nombre" required>
          </div>
          <div class="form-group mb-3">
            <label class="mb-1" for="segundoNombre">Segundo Nombre</label>
            <input type="text" class="form-control" id="segundoNombre" name="segundoNombre" placeholder="Ingresa tu Segundo Nombre">
          </div>
          <div class="form-group mb-3">
            <label class="mb-1" for="primerApellido">Primer Apellido</label>
            <input type="text" class="form-control" id="primerApellido" name="primerApellido" placeholder="Ingresa tu Primer Apellido" required>
          </div>
          <div class="form-group mb-3">
            <label class="mb-1" for="segundoApellido">Segundo Apellido</label>
            <input type="text" class="form-control" id="segundoApellido" name="segundoApellido" placeholder="Ingresa tu Segundo Apellido">
          </div>

          <p class="mb-1">Nombre preferido</p>
          <div class="form-check">
            <input type="radio" class="form-check-input" id="nombrePreferido" value=1 name="nombrePreferido" checked>
            <label for="nombrePreferido1" class="form-check-label">1</label>
          </div>
          <div class="form-check mb-3">
            <input type="radio" class="form-check-input" id="nombrePreferido" value=2 name="nombrePreferido">
            <label for="nombrePreferido2" class="form-check-label">2</label>
          </div>
          <div class="form-group mb-3">
            <label class="mb-1" for="nombreEnRama">Nombre En Rama</label>
            <input type="text" class="form-control" id="nombreEnRama" name="nombreEnRama" placeholder="Ingresa tu Nombre En Rama" required>
          </div>
          <div class="form-group mb-3">
            <label class="mb-1" for="anioIngresoRama">Año de Ingreso Rama</label>
            <input type="number" class="form-control" id="anioIngresoRama" name="anioIngresoRama" min="1985" max="<?php echo date("Y"); ?>" placeholder="2020" required>
          </div>
          <div class="form-group mb-3">
            <label class="mb-1" for="anioSalidaRama">Año de Salida Rama</label>
            <input type="number" class="form-control" id="anioSalidaRama" name="anioSalidaRama" min="1985" max="<?php echo date("Y") + 2; ?>" placeholder="<?php echo date("Y") + 2; ?>" required>
          </div>
          <div class="form-group mb-3">
            <label class="mb-1" for="correo">Correo Electrónico</label>
            <input type="email" class="form-control" id="correo" name="correo" placeholder="Ingresa tu Correo Electronico">
          </div>
          <div class="form-group mb-3">
            <label class="mb-1" for="celular">Celular</label>
            <input type="number" class="form-control" id="celular" name="celular" placeholder="3157003333">
          </div>
          <div class="form-group mb-3">
            <label class="mb-1" for="frase">Frase</label>
            <input type="text" class="form-control" id="frase" name="frase" placeholder="Ingresa tu Frase">
          </div>

          <div class="form-group mb-3">
            <label class="mb-1" for="imagen-miembro">Imagen <span style="font-weight: lighter;">(maximo 1.5Mb)</span></label>
            <div class="input-group">
              <input type="file" id="imagen-miembro" name="imagen-miembro" accept="image/png, image/jpeg, image/jpg" required>
              <label for="imagen-miembro"></label>
            </div>
          </div>
          <div class="form-group mb-3">
            <label for="urlLinkedin">URL Linkedin</label>
            <input type="text" class="form-control" id="urlLinkedin" name="urlLinkedin" placeholder="Ingresa la URL Linkedin">
          </div>

          <!-- Check boxes -->          
          <h5>Comites a los que perteneció</h5>
          <?php
          foreach ($array_comites as $comite) {
            $comite_format = strtolower(quitar_tildes($comite['comite']));
          ?>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="<?php echo $comite_format; ?>" name="<?php echo $comite_format; ?>" value="<?php echo $comite_format; ?>">
              <label for="<?php echo $comite_format; ?>" class="form-check-label"><?php echo $comite['comite']; ?></label>
            </div>
          <?php
          }
          ?>
          
          <h5 class="mt-3">Cargos que ocupó</h5>
          <?php
          foreach ($array_cargos as $cargo) {
            if ($cargo['id'] != 10) {
              // Coordinador TET se convierte a coordinadorTET
              $cargo_format = lcfirst(str_replace(' ', '', quitar_tildes($cargo['cargo'])));
          ?>
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="<?php echo $cargo_format; ?>" name="<?php echo $cargo_format; ?>" value="<?php echo $cargo_format; ?>">
                <label for="<?php echo $cargo_format; ?>" class="form-check-label"><?php echo $cargo['cargo'] ?></label>
              </div>
          <?php
            }
          }
          ?>
          
          <h5 class="mt-3">Comites que Coordinó</h5>
          <?php

          foreach ($array_comites as $comite) {
            $comite_format = strtolower(quitar_tildes($comite['comite']));
          ?>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="<?php echo 'coord_' . $comite_format; ?>" name="<?php echo 'coord_' . $comite_format; ?>" value="<?php echo 'coord' . $comite_format; ?>" disabled>
              <label for="<?php echo 'coord_' . $comite_format; ?>" class="form-check-label"><?php echo $comite['comite']; ?></label>
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


</body>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
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
</script>
</html>