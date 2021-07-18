<?php

if ($_POST['registro'] == 'nuevo') {

  try {

    include_once "../connection/db_connection.php";
    $conn = mysqli_connect($host, $user, $pw, $db);

    $validacion1 = !empty($_POST['primerNombre']) && !empty($_POST['primerApellido']) && !empty($_POST['nombrePreferido']) && !empty($_POST['nombreEnRama']) && !empty($_POST['anioIngresoRama']) && !empty($_POST['anioSalidaRama']) && !empty($_POST['correo']) && !empty($_POST['celular']) && !empty($_POST['frase']);
    $validacion2 = isset($_POST["academico"]) || isset($_POST["ludicas"]) || isset($_POST["logistica"]) || isset($_POST["patrocinio"]) || isset($_POST["publicidad"]);


    $errors = [];
    $fileSize = $_FILES['imagen-miembro']['size'];
    $fileExtensionsAllowed = ['jpeg', 'jpg', 'png'];
    $path = $_FILES['imagen-miembro']['name'];
    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));

    if (!in_array($ext, $fileExtensionsAllowed)) {
      $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
    }
    if ($fileSize > 5000000) {
      $errors[] = "File exceeds maximum size (10MB)";
    }
    $validacion3 = empty($errors);
    if (isset($_POST["coordinador"])) {
      $validacion4 = isset($_POST["coord_academico"]) || isset($_POST["coord_ludicas"]) || isset($_POST["coord_logistica"]) || isset($_POST["coord_patrocinio"]) || isset($_POST["coord_publicidad"]);
    } else {
      $validacion4 = true;
    }



    if ($validacion1 && $validacion2 && $validacion3 && $validacion4) {
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

      date_default_timezone_set('America/Bogota');
      $primerNombre_img = strtolower($primerNombre);
      $primerApellido_img = strtolower($primerApellido);
      $urlFoto = 'foto_' . $primerNombre_img . '_' . $primerApellido_img . '_' . date('Ymd_his') . '.' . $ext;


      //subida foto
      $directorio = "../img/members/";
      if (!is_dir($directorio)) {
        # code...
        mkdir($directorio, 0755, true);
      }
      if (move_uploaded_file($_FILES['imagen-miembro']['tmp_name'], $directorio . $urlFoto)) {
        # code...
        $imagen_url = $directorio . $urlFoto;  //it should change when every image would be on the same path
        $imagen_resultado = "Se subió correctamente";
      } else {
        $respuesta = array(
          'respuesta' => error_get_last()
        );
      }

      #LOGICA

      $sql = "INSERT INTO miembros (primerNombre, segundoNombre, nombrePreferido, primerApellido, segundoApellido, nombreEnRama, anioIngresoRama, anioSalidaRama, correo, celular, frase, urlFoto, urlLinkedin) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssdsssddsdsss", $primerNombre, $segundoNombre, $nombrePreferido, $primerApellido, $segundoApellido, $nombreEnRama, $anioIngresoRama, $anioSalidaRama, $correo, $celular, $frase, $imagen_url, $urlLinkedin);
      $stmt->execute();
      $registros = $stmt->affected_rows;
      $stmt->close();
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

      $resultado = $conn->query("SELECT id FROM miembros WHERE correo='$correo' AND celular=$celular");
      $member = $resultado->fetch_assoc();
      $id = $member['id'];

      // Voluntario del Comite
      if (isset($_POST["academico"])) {
        $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 10, 1);";
        $result = mysqli_query($conn, $query);
      }
      if (isset($_POST["ludicas"])) {
        $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 10, 2);";
        $result = mysqli_query($conn, $query);
      }
      if (isset($_POST["logistica"])) {
        $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 10, 3);";
        $result = mysqli_query($conn, $query);
      }
      if (isset($_POST["patrocinio"])) {
        $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 10, 4);";
        $result = mysqli_query($conn, $query);
      }
      if (isset($_POST["publicidad"])) {
        $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 10, 5);";
        $result = mysqli_query($conn, $query);
      }

      // Cargos del miembro
      if (isset($_POST["coordinadorTET"])) {
        $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 1, NULL);";
        $result = mysqli_query($conn, $query);
      }
      if (isset($_POST["webMaster"])) {
        $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 2, NULL);";
        $result = mysqli_query($conn, $query);
      }
      if (isset($_POST["coordinadoraWIE"])) {
        $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 3, NULL);";
        $result = mysqli_query($conn, $query);
      }
      if (isset($_POST["presidente"])) {
        $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 4, NULL);";
        $result = mysqli_query($conn, $query);
      }
      if (isset($_POST["viscepresidente"])) {
        $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 5, NULL);";
        $result = mysqli_query($conn, $query);
      }
      if (isset($_POST["fiscal"])) {
        $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 6, NULL);";
        $result = mysqli_query($conn, $query);
      }
      if (isset($_POST["tesorero"])) {
        $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 7, NULL);";
        $result = mysqli_query($conn, $query);
      }
      if (isset($_POST["secretario"])) {
        $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 8, NULL);";
        $result = mysqli_query($conn, $query);
      }
      if (isset($_POST["coordinador"])) {
        if (isset($_POST["coord_academico"])) {
          $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 9, 1);";
          $result = mysqli_query($conn, $query);
        }
        if (isset($_POST["coord_ludicas"])) {
          $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 9, 2);";
          $result = mysqli_query($conn, $query);
        }
        if (isset($_POST["coord_logistica"])) {
          $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 9, 3);";
          $result = mysqli_query($conn, $query);
        }
        if (isset($_POST["coord_patrocinio"])) {
          $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 9, 4);";
          $result = mysqli_query($conn, $query);
        }
        if (isset($_POST["coord_publicidad"])) {
          $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 9, 5);";
          $result = mysqli_query($conn, $query);
        }
      }
    } else {
      $respuesta = array(
        'respuesta' => error_get_last()
      );
    }
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
    $stmt = $conn->prepare('DELETE FROM miembros WHERE id = ?');
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
