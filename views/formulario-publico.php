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

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../admin/css/all.min.css">
  <script src="https://kit.fontawesome.com/9d25e26f75.js" crossorigin="anonymous"></script>
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../admin/css/adminlte.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="../admin/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../admin/css/responsive.bootstrap4.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link rel="stylesheet" href="../admin/css/sweetalert2.min.css">
  <!-- Leaflet - mapas -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />

  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>

  <link rel="stylesheet" href="../css/formulario-publico.css">
  <title>Formulario Público</title>

</head>

<body>
  <div class="card">
    <div class="card-header">
      <h4 class="card-title">Formulario Público Anuario</h4>
    </div>
    <div class="card-body">
      <form role="form" enctype="multipart/form-data" name="crear-miembro-publico" id="crear-miembro-publico" method="post" action="../functions/modelo-publico.php">
        <div class="card-body">
          <div class="form-group mb-3 ">
            <input type="text" class="form-control" id="primerNombre" name="primerNombre" placeholder="Ingresa tu Primer Nombre" required>
            <label class="mb-1 required" for="primerNombre">Primer Nombre</label>
          </div>
          <div class="form-group mb-3 ">
            <input type="text" class="form-control" id="segundoNombre" name="segundoNombre" placeholder="Ingresa tu Segundo Nombre">
            <label class="mb-1" for="segundoNombre">Segundo Nombre</label>
          </div>
          <div class="form-group mb-3 ">
            <input type="text" class="form-control" id="primerApellido" name="primerApellido" placeholder="Ingresa tu Primer Apellido" required>
            <label class="mb-1 required" for="primerApellido">Primer Apellido</label>
          </div>
          <div class="form-group mb-3 ">
            <input type="text" class="form-control" id="segundoApellido" name="segundoApellido" placeholder="Ingresa tu Segundo Apellido">
            <label class="mb-1" for="segundoApellido">Segundo Apellido</label>
          </div>

          <p class="mb-1">Nombre preferido</p>
          <div class="form-check">
            <label for="nombrePreferido1" class="form-check-label">1</label>
            <input type="radio" class="form-check-input" id="nombrePreferido1" value=1 name="nombrePreferido" checked>
          </div>
          <div class="form-check mb-3 ">
            <label for="nombrePreferido2" class="form-check-label">2</label>
            <input type="radio" class="form-check-input" id="nombrePreferido2" value=2 name="nombrePreferido">

          </div>
          <div class="form-group mb-3 ">
            <input type="text" class="form-control" id="nombreEnRama" name="nombreEnRama" placeholder="Ingresa tu Nombre En Rama" required>
            <label class="mb-1 required" for="nombreEnRama">Nombre En Rama</label>

          </div>
          <div class="form-group mb-3 ">
            <input type="number" class="form-control" id="anioIngresoRama" name="anioIngresoRama" min="1985" max="<?php echo date("Y"); ?>" placeholder="2020" required>
            <label class="mb-1 required" for="anioIngresoRama">Año de Ingreso Rama</label>

          </div>
          <div class="form-group mb-3 ">
            <input type="number" class="form-control" id="anioSalidaRama" name="anioSalidaRama" min="1985" max="<?php echo date("Y") + 2; ?>" placeholder="<?php echo date("Y") + 2; ?>" required>
            <label class="mb-1 required" for="anioSalidaRama">Año de Salida Rama</label>

          </div>
          <div class="form-group mb-3 ">
            <input type="email" class="form-control" id="correo" name="correo" placeholder="Ingresa tu Correo Electronico" required>
            <label class="mb-1" for="correo">Correo Electrónico</label>
          </div>
          <div class="form-group mb-3 ">
            <input type="number" class="form-control" id="celular" name="celular" placeholder="3157003333">
            <label class="mb-1" for="celular">Celular</label>
          </div>
          <div class="form-group mb-3 ">
            <input type="text" class="form-control" id="frase" name="frase" placeholder="Ingresa tu Frase">
            <label class="mb-1" for="frase">Frase</label>
          </div>

          <div class="form-group mb-3 ">
            <div class="input-group">
              <label for="imagen-miembro"></label>
              <input type="file" id="imagen-miembro required" name="imagen-miembro" accept="image/png, image/jpeg, image/jpg" required>            
              <label class="mb-1" for="imagen-miembro">Imagen <span style="font-weight: lighter;">(maximo 1.5Mb)</span></label>
            </div>
          </div>
          <div class="form-group mb-3 ">
            <input type="text" class="form-control" id="urlLinkedin" name="urlLinkedin" placeholder="Ingresa la URL Linkedin">
            <label for="urlLinkedin">URL Linkedin</label>
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

<!-- jQuery -->
<script src="../admin/js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../admin/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../admin/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../admin/js/demo.js"></script>
<!-- Leaflet - mapas -->
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
<!-- mapa -->
<script src="../admin/js/mapa.js"></script>
<!-- bs-custom-file-input -->
<script src="../admin/js/bs-custom-file-input.min.js"></script>

<script src="../admin/js/sweetalert2.all.min.js"></script>

<script src="../js/miembro-ajax.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script src="../admin/js/jquery.dataTables.min.js"></script>
<script src="../admin/js/dataTables.bootstrap4.min.js"></script>
<script src="../admin/js/dataTables.responsive.min.js"></script>
<script src="../admin/js/responsive.bootstrap4.min.js"></script>
<script src="../admin/js/app.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    bsCustomFileInput.init();
  });
</script>

<!-- <script>
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
  }else{
    Swal.fire({
      title: "Confirmado",
      text: "Gracias por aceptar las  políticas",
      icon: "success"
    })
  }
})

</script> -->

<script>
  document.getElementById("segundoNombre") = function() {
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
</script>

</html>