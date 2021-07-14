<?php
include_once 'funciones/sesiones.php';
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

                ?>

                <form role="form" name="editar-registro" id="editar-registro" method="post" action="modelo-miembros.php">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="primerNombre">Primer Nombre</label>
                            <input type="text" class="form-control" id="primerNombre" name="primerNombre" placeholder="Ingresa tu Primer Nombre" value="<?php echo $miembro['primerNombre']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="segundoNombre">Segundo Nombre</label>
                            <input type="text" class="form-control" id="segundoNombre" name="segundoNombre" placeholder="Ingresa tu Segundo Nombre" value="<?php echo $miembro['segundoNombre']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="primerApellido">Primer Apellido</label>
                            <input type="text" class="form-control" id="primerApellido" name="primerApellido" placeholder="Ingresa tu Primer Apellido" value="<?php echo $miembro['primerApellido']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="segundoApellido">Segundo Apellido</label>
                            <input type="text" class="form-control" id="segundoApellido" name="segundoApellido" placeholder="Ingresa tu Segundo Apellido" value="<?php echo $miembro['segundoApellido']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nombrePreferido">Nombre Preferido</label>
                            <input type="number" min="1" max="2" class="form-control" id="nombrePreferido" name="nombrePreferido" value="<?php echo $miembro['nombrePreferido']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nombreEnRama">Nombre En Rama</label>
                            <input type="text" class="form-control" id="nombreEnRama" name="nombreEnRama" placeholder="Ingresa tu Nombre En Rama" value="<?php echo $miembro['nombreEnRama']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="anioIngresoRama">Año de Ingreso Rama</label>
                            <input type="number" class="form-control" id="anioIngresoRama" name="anioIngresoRama" value="<?php echo $miembro['anioIngresoRama']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="anioSalidaRama">Año de Salida Rama</label>
                            <input type="number" class="form-control" id="anioSalidaRama" name="anioSalidaRama" value="<?php echo $miembro['anioSalidaRama']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="correo">Nombre En Rama</label>
                            <input type="email" class="form-control" id="correo" name="correo" placeholder="Ingresa tu Correo Electronico" value="<?php echo $miembro['correo']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="celular">Año de Salida Rama</label>
                            <input type="number" class="form-control" id="celular" name="celular" value="<?php echo $miembro['celular']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="frase">Nombre En Rama</label>
                            <input type="text" class="form-control" id="frase" name="frase" placeholder="Ingresa tu Frase" value="<?php echo $miembro['frase']; ?>">
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
                            <label for="urlLinkedin">Nombre En Rama</label>
                            <input type="text" class="form-control" id="urlLinkedin" name="urlLinkedin" placeholder="Ingresa la URL Linkedin" value="<?php echo $miembro['urlLinkedin']; ?>">
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <input type="hidden" name="registro" value="actualizar">
                        <input type="hidden" name="id_registro" value="<?php echo $id; ?>">
                        <button type="submit" class="btn btn-primary" id="crear-registro">Editar</button>
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

<?php
include_once 'templates/footer.php';
?>