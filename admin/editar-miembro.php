<?php
include_once 'funciones/sesiones.php';
include "funciones/quitar_tildes.php";
include_once "../connection/db_connection.php";
include_once 'templates/header.php';
include_once 'templates/barra.php';
include_once 'templates/navegacion.php';

$id = $_GET['id'];

if (!filter_var($id, FILTER_VALIDATE_INT)) {
  die("Error");
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Editar Miembros</h1>
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
        <h3 class="card-title">Editar Miembros</h3>
      </div>
      <div class="card-body">

        <?php
        $conn = mysqli_connect($host, $user, $pw, $db);
        $sql = "SELECT * FROM miembros WHERE id = $id";
        $resultado = $conn->query($sql);
        $miembro = $resultado->fetch_assoc();

        $sql1 = "SELECT * FROM comites";
        $array_comites = $conn->query($sql1);

        $sql2 = "SELECT cargo,comite FROM cargos_de_miembros WHERE miembro=$id";
        $resultado2 = $conn->query($sql2);

        $sql3 = "SELECT * FROM cargos";
        $array_cargos = $conn->query($sql3);

        $array_comites_coord = [];
        $array_comites_miembro = [];
        $array_cargos_miembro = [];

        while ($cargos_miembro = $resultado2->fetch_assoc()) {
          
          if ($cargos_miembro['cargo'] == 9) {
            array_push($array_comites_coord, $cargos_miembro['comite']);
          }
          if ($cargos_miembro['cargo'] == 10) {
            array_push($array_comites_miembro, $cargos_miembro['comite']);
          }
          array_push($array_cargos_miembro, $cargos_miembro['cargo']);
        }
        ?>

        <form role="form" enctype="multipart/form-data" name="editar-registro-miembro" id="editar-registro-miembro" method="post" action="modelo-miembro.php">
          <div class="card-body">
            <div class="form-group">
              <label for="primerNombre">Primer Nombre</label>
              <input type="text" class="form-control" id="primerNombre" name="primerNombre" placeholder="Ingresa tu Primer Nombre" value="<?php echo $miembro['primerNombre']; ?>" required>
            </div>
            <div class="form-group">
              <label for="segundoNombre">Segundo Nombre</label>
              <input type="text" class="form-control" id="segundoNombre" name="segundoNombre" placeholder="Ingresa tu Segundo Nombre" value="<?php echo $miembro['segundoNombre']; ?>">
            </div>
            <div class="form-group">
              <label for="primerApellido">Primer Apellido</label>
              <input type="text" class="form-control" id="primerApellido" name="primerApellido" placeholder="Ingresa tu Primer Apellido" value="<?php echo $miembro['primerApellido']; ?>" required>
            </div>
            <div class="form-group">
              <label for="segundoApellido">Segundo Apellido</label>
              <input type="text" class="form-control" id="segundoApellido" name="segundoApellido" placeholder="Ingresa tu Segundo Apellido" value="<?php echo $miembro['segundoApellido']; ?>">
            </div>

            <label>Nombre preferido</label>
            <?php
            if ($miembro['nombrePreferido'] == 1) {
            ?>
              <div class="form-check">
                <input type="radio" class="form-check-input" id="nombrePreferido" value=1 name="nombrePreferido" checked>
                <label for="nombrePreferido1" class="form-check-label">1</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" id="nombrePreferido" value=2 name="nombrePreferido">
                <label for="nombrePreferido2" class="form-check-label">2</label>
              </div>
            <?php
            } else {
            ?>
              <div class="form-check">
                <input type="radio" class="form-check-input" id="nombrePreferido" value=1 name="nombrePreferido">
                <label for="nombrePreferido1" class="form-check-label">1</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" id="nombrePreferido" value=2 name="nombrePreferido" checked>
                <label for="nombrePreferido2" class="form-check-label">2</label>
              </div>
            <?php
            }
            ?>

            <div class="form-group">
              <label for="nombreEnRama">Nombre En Rama</label>
              <input type="text" class="form-control" id="nombreEnRama" name="nombreEnRama" placeholder="Ingresa tu Nombre En Rama" value="<?php echo $miembro['nombreEnRama']; ?>" required>
            </div>
            <div class="form-group">
              <label for="anioIngresoRama">Año de Ingreso Rama</label>
              <input type="number" class="form-control" id="anioIngresoRama" name="anioIngresoRama" min="1985" max="<?php echo date("Y"); ?>" value="<?php echo $miembro['anioIngresoRama']; ?>" required>
            </div>
            <div class="form-group">
              <label for="anioSalidaRama">Año de Salida Rama</label>
              <input type="number" class="form-control" id="anioSalidaRama" name="anioSalidaRama" min="1985" max="<?php echo date("Y"); ?>" value="<?php echo $miembro['anioSalidaRama']; ?>" required>
            </div>
            <div class="form-group">
              <label for="correo">Correo Electrónico</label>
              <input type="email" class="form-control" id="correo" name="correo" placeholder="Ingresa tu Correo Electronico" value="<?php echo $miembro['correo']; ?>" required>
            </div>
            <div class="form-group">
              <label for="celular">Celular</label>
              <input type="number" class="form-control" id="celular" name="celular" value="<?php echo $miembro['celular']; ?>" required>
            </div>
            <div class="form-group">
              <label for="frase">Frase</label>
              <input type="text" class="form-control" id="frase" name="frase" placeholder="Ingresa tu Frase" value="<?php echo $miembro['frase']; ?>" required>
            </div>
            <div class="form-group">
              <label for="imagen-actual">Imagen actual</label>
              <br>
              <img src="<?php echo $miembro['urlFoto']; ?>" width="200">
              <!--<img src="../img/miembros/<?php echo $miembro['urlFoto']; ?>" width="200">-->
            </div>
            <div class="form-group">
              <label for="imagen-miembro">Imagen</label>
              <div class="input-group">
                <input type="file" id="imagen-miembro" name="imagen-miembro">
                <label for="imagen-miembro"></label>
              </div>
            </div>
            <div class="form-group">
              <label for="urlLinkedin">URL Linkedin</label>
              <input type="text" class="form-control" id="urlLinkedin" name="urlLinkedin" placeholder="Ingresa la URL Linkedin" value="<?php echo $miembro['urlLinkedin']; ?>">
            </div>

            <!-- Check boxes -->
            <br>
            <h4>Comites a los que perteneció</h4>
            <?php
              foreach($array_comites as $comite){
                $comite_format=strtolower(quitar_tildes($comite['comite']));
                ?>
                  <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="<?php echo $comite_format;?>" name="<?php echo $comite_format;?>" value="<?php echo $comite_format;?>" <?php if (in_array($comite['id'], $array_comites_miembro)) {echo "checked";} ?>>
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
                        <input type="checkbox" class="form-check-input" id="<?php echo $cargo_format;?>" name="<?php echo $cargo_format;?>" value="<?php echo $cargo_format;?>" <?php if (in_array($cargo['id'], $array_cargos_miembro)) {echo "checked";} ?> >
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
                    <input type="checkbox" class="form-check-input" id="<?php echo 'coord_'.$comite_format;?>" name="<?php echo 'coord_'.$comite_format;?>" value="<?php echo 'coord'.$comite_format;?>" <?php   if($array_comites_coord){if (in_array($comite['id'], $array_comites_coord)) {echo "checked";}}else{echo 'disabled';} ?>>
                    <label for="<?php echo 'coord_'.$comite_format;?>" class="form-check-label"><?php echo $comite['comite'];?></label>
                  </div>
                <?php                
              }              
            ?>

          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <input type="hidden" name="registro" value="actualizar">
            <input type="hidden" name="id_registro" value="<?php echo $id; ?>">
            <button type="submit" class="btn btn-primary">Editar</button>
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

<?php
include_once 'templates/footer.php';
?>