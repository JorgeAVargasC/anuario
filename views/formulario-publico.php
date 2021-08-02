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

  <script src="../admin/js/admin.js"></script></script>

  <?php include("../admin/templates/footer.php"); ?>