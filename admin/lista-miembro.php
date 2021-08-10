<?php
    include_once 'funciones/sesiones.php';
    include_once "../connection/db_connection.php";
    include_once 'templates/header.php';
    include_once 'templates/barra.php';
    include_once 'templates/navegacion.php';
?>

        <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Listado de Miembros</h1>
                    </div>
                    
                </div>
            </div>

            <!-- /.container-fluid -->
        </section>

            <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">

                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Maneja los Miembros IEEE en esta sección</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <table id="registros" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Primer Nombre</th>
                                <th>Segundo Nombre</th>
                                <th>Primer Apellido</th>
                                <th>Segundo Apellido</th>
                                <th>Año Ingreso</th>
                                <th>Año Salida</th>
                                <th>Estado</th>
                                <th>Acciones</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                try {
                                    //code...
                                    $conn = mysqli_connect($host, $user, $pw, $db);
                                    $sql = "SELECT id, primerNombre, segundoNombre, primerApellido, segundoApellido, anioIngresoRama, anioSalidaRama, estado FROM miembros";
                                    $resultado = $conn->query($sql);

                                } catch (Exception $e) {
                                    //throw $th;
                                    $error = $e->getMessage();
                                    echo $error;
                                }
                                while( $miembro = $resultado->fetch_assoc() ){ ?>

                                    <tr>
                                        <td> <?php echo $miembro['primerNombre']; ?> </td>
                                        <td> <?php echo $miembro['segundoNombre']; ?> </td>
                                        <td> <?php echo $miembro['primerApellido']; ?> </td>
                                        <td> <?php echo $miembro['segundoApellido']; ?> </td>
                                        <td> <?php echo $miembro['anioIngresoRama']; ?> </td>
                                        <td> <?php echo $miembro['anioSalidaRama']; ?> </td>
                                        
                                        
                                        <td class="text-center">
                                            <?php
                                                if($miembro['estado']){
                                                    echo "<p style='color: #00000000; margin:0; width:0; height:0; font-size: 0;'>1</p>";
                                                    echo "<i class='fas fa-user-check fa-2x text-success'></i>";
                                                }else{
                                                    
                                                    echo "<i class='fas fa-user-clock fa-2x text-warning'></i>";
                                                }
                                            ?>
                                        </td>

                                        <td> 
                                            <a href="editar-miembro.php?id=<?php echo $miembro['id']; ?>" class="btn bg-primary btn-flat margin rounded">
                                                <i class="fa fa-pencil"></i>
                                            </a> 

                                            <a href="#" data-id="<?php echo $miembro['id']; ?>"  data-tipo="miembro" class="btn bg-danger btn-flat margin rounded borrar_registro">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Primer Nombre</th>
                                <th>Segundo Nombre</th>
                                <th>Primer Apellido</th>
                                <th>Segundo Apellido</th>
                                <th>Año Ingreso</th>
                                <th>Año Salida</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                    </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->

<?php
    include_once 'templates/footer.php';
?>
