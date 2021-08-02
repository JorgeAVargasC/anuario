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
            <input type="hidden" name="estado" value="1">
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

<script src="../admin/js/admin.js"></script>


<?php
include_once 'templates/footer.php';
?>