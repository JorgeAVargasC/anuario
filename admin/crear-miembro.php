<?php
include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';
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
                    <h1>Crear nueva ubicación</h1>
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
                <form role="form" enctype="multipart/form-data" name="guardar-registro" id="guardar-registro-miembro" method="post" action="modelo-miembro.php">
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
                                <input type="number" class="form-control" id="anioIngresoRama" name="anioIngresoRama" placeholder="2020" required>
                            </div>
                            <div class="form-group">
                                <label for="anioSalidaRama">Año de Salida Rama</label>
                                <input type="number" class="form-control" id="anioSalidaRama" name="anioSalidaRama" placeholder="2022" required>
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
                                    <input type="file" id="imagen-miembro" name="imagen-miembro" required>
                                    <label for="imagen-miembro"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="urlLinkedin">URL Linkedin</label>
                                <input type="text" class="form-control" id="urlLinkedin" name="urlLinkedin" placeholder="Ingresa la URL Linkedin">
                            </div>

                            <h4>Comites a los que perteneció</h4>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="academico" name="academico" value="academico">
                                <label for="academico" class="form-check-label">Academico</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="ludicas" name="ludicas" value="ludicas">
                                <label for="ludicas" class="form-check-label">Ludicas</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="logistica" name="logistica" value="logistica">
                                <label for="logistica" class="form-check-label">Logistica</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="patrocinio" name="patrocinio" value="patrocinio">
                                <label for="patrocinio" class="form-check-label">Patrocinio</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="publicidad" name="publicidad" value="publicidad">
                                <label for="publicidad" class="form-check-label">Publicidad</label>
                            </div>

                            <br>
                            <h4>Cargos que ocupó</h4>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="coordinadorTET" name="coordinadorTET" value="coordinadorTET">
                                <label for="coordinadorTET" class="form-check-label">Coordinador TET</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="webMaster" name="webMaster" value="webMaster">
                                <label for="webMaster" class="form-check-label">Web Master</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="coordinadoraWIE" name="coordinadoraWIE" value="coordinadoraWIE">
                                <label for="coordinadoraWIE" class="form-check-label">Coordinadora WIE</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="presidente" name="presidente" value="presidente">
                                <label for="presidente" class="form-check-label">Presidente de la rama</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="viscepresidente" name="viscepresidente" value="viscepresidente">
                                <label for="viscepresidente" class="form-check-label">Viscepresidente de la rama</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="fiscal" name="fiscal" value="fiscal">
                                <label for="fiscal" class="form-check-label">Fiscal de la rama</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="tesorero" name="tesorero" value="tesorero">
                                <label for="tesorero" class="form-check-label">Tesorero de la rama</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="secretario" name="secretario" value="secretario">
                                <label for="secretario" class="form-check-label">Secretario de la rama</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="coordinador" name="coordinador" value="coordinador">
                                <label for="coordinador" class="form-check-label">Coordinador de un comite de la rama</label>
                            </div>

                            <br>
                            <h4>Comites que Coordinó</h4>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="coord_academico" name="coord_academico" value="academico">
                                <label for="coord_academico" class="form-check-label">Academico</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="coord_ludicas" name="coord_ludicas" value="ludicas">
                                <label for="coord_ludicas" class="form-check-label">Ludicas</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="coord_logistica" name="coord_logistica" value="logistica">
                                <label for="coord_logistica" class="form-check-label">Logistica</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="coord_patrocinio" name="coord_patrocinio" value="patrocinio">
                                <label for="coord_patrocinio" class="form-check-label">Patrocinio</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="coord_publicidad" name="coord_publicidad" value="publicidad">
                                <label for="coord_publicidad" class="form-check-label">Publicidad</label>
                            </div>

                        </div>
                        <!-- /.card-body -->

                    <div class="card-footer">
                        <input type="hidden" name="miembro" value="nuevo">
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

<?php
include_once 'templates/footer.php';
?>