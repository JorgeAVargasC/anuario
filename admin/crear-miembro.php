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
                            <input type="number" class="form-control" id="anioSalidaRama" name="anioSalidaRama" min="1985" max="<?php echo date("Y");?>" placeholder="<?php echo date("Y");?>" required>
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
                            <label for="imagen-miembro">Imagen</label>
                            <div class="input-group">
                                <input type="file" id="imagen-miembro" name="imagen-miembro" accept="image/png, image/jpeg, image/jpg" required>
                                <label for="imagen-miembro"></label>
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