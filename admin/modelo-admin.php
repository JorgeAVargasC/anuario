<?php
if (isset($_POST['login-admin'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    try {
        include_once "../connection/db_connection.php";
        $conn = mysqli_connect($host, $user, $pw, $db);
        mysqli_set_charset($conn, "utf8");
        $query = "SELECT * FROM admins WHERE usuario='$usuario'";
        $result = $conn->query($query);
        $userData = $result->fetch_assoc();
        if (md5($password) == $userData['password']) {
            session_start();
            $_SESSION['usuario'] = $userData['usuario'];
            $_SESSION['nombre'] = $userData['nombre'];
            $respuesta = array(
                'respuesta' => 'exitoso',
                'usuario' => $userData['nombre']
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $conn->close();
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()

        );
    }
    die(json_encode($respuesta));
}

if ($_POST['registro'] == 'nuevo') {

    include_once "../connection/db_connection.php";
    $conn = mysqli_connect($host, $user, $pw, $db);
    $usuario = $_POST['usuario'];
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];

    $opciones = array(
        'cost' => 12
    );

    $password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones);

    #echo $password_hashed;

    try {
        //code...

        $stmt = $conn->prepare("INSERT INTO admins (usuario, nombre, password) VALUES (?, ?, ?) ");
        $stmt->bind_param("sss", $usuario, $nombre, $password_hashed);
        $stmt->execute();

        $id_registro = $stmt->insert_id;
        if ($stmt->affected_rows) {
            # code...
            $respuesta = array(
                'respuesta' => 'exito',
                'id_admin' => $id_registro
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        //throw $th;
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
}
if ($_POST['registro'] == 'actualizar') {

    include_once "../connection/db_connection.php";
    $conn = mysqli_connect($host, $user, $pw, $db);
    $usuario = $_POST['usuario'];
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];
    $id_registro = $_POST['id_registro'];

    #echo $password_hashed;

    try {
        //code...
        if (!empty($password)) {

            $opciones = array(
                'cost' => 12
            );
            $password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones);
            $stmt = $conn->prepare("UPDATE admins SET usuario = ?, nombre = ?, password = ? WHERE id_admin =?");
            $stmt->bind_param("sssi", $usuario, $nombre, $password_hashed, $id_registro);
        } else {

            $stmt = $conn->prepare("UPDATE admins SET usuario = ?, nombre = ? WHERE id_admin =?");
            $stmt->bind_param("ssi", $usuario, $nombre,  $id_registro);
        }


        $stmt->execute();
        if ($stmt->affected_rows) {
            # code...
            $respuesta = array(
                'respuesta' => 'exito',
                'id_actualizado' => $stmt->insert_id
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        //throw $th;
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
}
if ($_POST['registro'] == 'eliminar') {

    $id_borrar = $_POST['id'];

    try {

        include_once "../connection/db_connection.php";
        $conn = mysqli_connect($host, $user, $pw, $db);
        $stmt = $conn->prepare('DELETE FROM admins WHERE id_admin = ?');
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
            'respuesta' => 'error'
        );
    }

    die(json_encode($respuesta));
}
