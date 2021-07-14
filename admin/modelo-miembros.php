<?php

if (isset($_POST['registro'])) {

    if ($_POST['registro'] == 'nuevo') {

        $directorio = "../img/members";

        if (!is_dir($directorio)) {
            # code...
            mkdir($directorio, 0755, true);
        }

        if (move_uploaded_file($_FILES['imagen-miembro']['tmp_name'], $directorio . $_FILES['imagen-miembro']['name'])) {
            # code...
            $imagen_url = $_FILES['imagen-miembro']['name'];
            $imagen_resultado = "Se subió correctamente";
        } else {
            $respuesta = array(
                'respuesta' => error_get_last()
            );
        }

        try {

            include_once "../connection/db_connection.php";
            $conn = mysqli_connect($host, $user, $pw, $db);
            
            $primerNombre = $_POST["primerNombre"];
            $segundoNombre = $_POST["segundoNombre"];
            $nombrePreferido = $_POST["nombrePreferido"];
            $primerApellido = $_POST["primerApellido"];
            $segundoApellido = $_POST["segundoApellido"];
            $nombreEnRama = $_POST["nombreEnRama"];
            $anioIngresoRama = $_POST["anioIngresoRama"];
            $anioSalidaRama = $_POST["anioSalidaRama"];
            $correo = $_POST["correo"];
            $celular = $_POST["celular"];
            $frase = $_POST["frase"];
            $urlLinkedin = $_POST["urlLinkedin"];

            $sql = "INSERT INTO intervalos (minpersonas, maxpersonas) VALUES ($min_personas, $max_personas)";
            $result = $conn->query($sql);

            # code...
            //con imagen
            $stmt = $conn->prepare("INSERT INTO ubicaciones (nombre, direccion, url_imagen, latitud, longitud) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssdd", $nombre, $direccion, $imagen_url, $latitud, $longitud);


            $stmt->execute();
            $registros = $stmt->affected_rows;

            if ($registros > 0) {
                # code...
                $respuesta = array(
                    'respuesta' => 'exito'
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'error'
                );
            }

            $stmt->close();
        } catch (Exception $e) {
            //throw $th;
            $respuesta = array(
                'respuesta' => $e->getMessage()
            );
        }

        die(json_encode($respuesta));
    }



    if ($_POST['ubicacion'] == 'actualizar') { //---------------------------------------------------------------------------------

        $directorio = "../img/ubicaciones/";

        if (!is_dir($directorio)) {
            # code...
            mkdir($directorio, 0755, true);
        }

        if (move_uploaded_file($_FILES['imagen-ubicacion']['tmp_name'], $directorio . $_FILES['imagen-ubicacion']['name'])) {
            # code...
            $imagen_url = $_FILES['imagen-ubicacion']['name'];
            $imagen_resultado = "Se subió correctamente";
        } else {
            $respuesta = array(
                'respuesta' => error_get_last()
            );
        }


        try {

            include_once "../connection/db_connection.php";
            $conn = mysqli_connect($host, $user, $pw, $db);
            $id_ubicacion = $_POST['id_ubicacion'];
            $nombre = $_POST['nombre'];
            $direccion = $_POST['direccion'];
            $latitud = $_POST['latitud'];
            $longitud = $_POST['longitud'];

            $max_personas = $_POST['max_personas'];
            $min_personas = $_POST['min_personas'];

            $sql = "UPDATE intervalos SET minpersonas = $min_personas, maxpersonas = $max_personas WHERE id_ubicacion = $id_ubicacion";
            $result = $conn->query($sql);


            if ($_FILES['imagen-ubicacion']['size'] > 0) {

                $stmt = $conn->prepare("UPDATE ubicaciones SET nombre = ?, direccion = ?, url_imagen = ?, latitud = ?, longitud = ? WHERE id_ubicacion = ?");
                $stmt->bind_param("sssddi", $nombre, $direccion, $imagen_url, $latitud, $longitud, $id_ubicacion);
            } else {

                $stmt = $conn->prepare("UPDATE ubicaciones SET nombre = ?, direccion = ?, latitud = ?, longitud = ? WHERE id_ubicacion = ?");
                $stmt->bind_param("ssddi", $nombre, $direccion, $latitud, $longitud, $id_ubicacion);
            }

            $stmt->execute();
            $registros = $stmt->affected_rows;

            if ($registros > 0) {
                # code...
                $respuesta = array(
                    'respuesta' => 'exito'
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'error'
                );
            }

            $stmt->close();
        } catch (Exception $e) {
            //throw $th;
            $respuesta = array(
                'respuesta' => $e->getMessage()
            );
        }

        die(json_encode($respuesta));
    }
} //---

if (isset($_POST['registro'])) {
    if ($_POST['registro'] == 'eliminar') {

        $id_borrar = $_POST['id'];

        try {

            include_once "../connection/db_connection.php";
            $conn = mysqli_connect($host, $user, $pw, $db);

            $sql = "DELETE FROM intervalos WHERE id_ubicacion = $id_borrar";
            $result = $conn->query($sql);


            $stmt = $conn->prepare('DELETE FROM ubicaciones WHERE id_ubicacion = ?');
            $stmt->bind_param("i", $id_borrar);
            $stmt->execute();

            if ($stmt->affected_rows) {
                # code...
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_eliminado' => $id_borrar
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'error'
                );
            }
        } catch (Exception $e) {

            $respuesta = array(
                'respuesta' => $e->getMessage()
            );
        }

        die(json_encode($respuesta));
    }
    # code...
}
