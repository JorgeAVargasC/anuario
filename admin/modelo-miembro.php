<?php

include("funciones/quitar_tildes.php");
include("../functions/comprimir_imagenes.php");

if ($_POST['registro'] == 'nuevo') {

  try {

    include_once "../connection/db_connection.php";
    $conn = mysqli_connect($host, $user, $pw, $db);

    $validacion1 = !empty($_POST['primerNombre']) && !empty($_POST['primerApellido']) && !empty($_POST['nombrePreferido']) && !empty($_POST['nombreEnRama']) && !empty($_POST['anioIngresoRama']) && !empty($_POST['anioSalidaRama']) && !empty($_POST['correo']) && !empty($_POST['celular']) && !empty($_POST['frase']);
    $sql1 = "SELECT * FROM comites";
    $array_comites = $conn->query($sql1);
    #$array_comites = $resultado->fetch_assoc();
    $validacion2 = false; 
    foreach($array_comites as $comite){
      $comite_format = strtolower(quitar_tildes($comite['comite']));
      if(isset($_POST[$comite_format])){
        $validacion2 = true;
      }
    }

    if ($_FILES['imagen-miembro']['name'] != null ) {
      $errors = [];
      $fileSize = $_FILES['imagen-miembro']['size'];
      $fileExtensionsAllowed = ['jpeg', 'jpg', 'png'];
      $path = $_FILES['imagen-miembro']['name'];
      $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
      $validacion3 = true;

      if (!in_array($ext, $fileExtensionsAllowed)) {
        $validacion3 = false;
      }      
    } 

    $validacion4 = false;
    $sql1 = "SELECT * FROM comites";
    $array_comites = $conn->query($sql1);

    if(isset($_POST["coordinador"])){
      foreach($array_comites as $comite){
        $comite_format = strtolower(quitar_tildes($comite['comite']));        
          if(isset($_POST["coord_".$comite_format])){
            $validacion4 = true;
          }
      }      
    }else{
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
      $estado = $_POST["estado"];
      $ocupacionActual = $_POST["ocupacionActual"];
      $contactos=$_POST["contactos"];

      date_default_timezone_set('America/Bogota');
      $primerNombre_img = strtolower(quitar_tildes($primerNombre));
      $primerApellido_img = strtolower(quitar_tildes($primerApellido));
      $urlFoto = 'foto_' . $primerNombre_img . '_' . $primerApellido_img . '_' . date('Ymd_his') . '.' . $ext;

      //subida foto
      $directorio = "../img/members/";
      if (!is_dir($directorio)) {
        mkdir($directorio, 0755, true);
      }

      if (move_uploaded_file($_FILES['imagen-miembro']['tmp_name'], $directorio . $urlFoto)) {
        $imagen_url = $directorio . $urlFoto;  //it should change when every image would be on the same path
        $imagen_resultado = "Se subi?? correctamente";
      } else {
        $respuesta = array(
          'respuesta' => error_get_last()
        );
      }      

      #LOGICA

      $sql = "INSERT INTO miembros (primerNombre, segundoNombre, nombrePreferido, primerApellido, segundoApellido, nombreEnRama, anioIngresoRama, anioSalidaRama, correo, celular, frase, urlFoto, urlLinkedin, estado, ocupacionActual, contactos) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssdsssddsdsssdss", $primerNombre, $segundoNombre, $nombrePreferido, $primerApellido, $segundoApellido, $nombreEnRama, $anioIngresoRama, $anioSalidaRama, $correo, $celular, $frase, $imagen_url, $urlLinkedin, $estado, $ocupacionActual, $contactos);
      $stmt->execute();
      $registros = $stmt->affected_rows;
      $stmt->close();
      if ($registros > 0) {
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
      $id_registro = $member['id'];

      $sql2 = "SELECT * FROM cargos";
      $array_cargos = $conn->query($sql2);
      // Cargos del miembro
      foreach ($array_cargos as $cargo) {
        $cargo_format = lcfirst(str_replace(' ', '', quitar_tildes($cargo['cargo'])));
        $cargo_id = $cargo["id"];
        
        if ($cargo_id != 9 && $cargo_id != 10) { // Generales
          if (isset($_POST[$cargo_format])) {
            $query = "INSERT INTO cargos_de_miembros (miembro, cargo) VALUES ($id_registro, $cargo_id)";
            $result = mysqli_query($conn, $query);
          }
        }else if ($cargo_id == 10) { // Voluntario del Comite
          foreach ($array_comites as $comite) {
            $comite_id = $comite["id"];
            $comite_format = strtolower(quitar_tildes($comite['comite']));
            if (isset($_POST[$comite_format])) {
              $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id_registro, $cargo_id, $comite_id)";
              $result = mysqli_query($conn, $query);
            }
          }
        }else if ($cargo_id == 9) { //Coordinador comites
          if (isset($_POST["coordinador"])) {
            foreach ($array_comites as $comite) {
              $comite_id = $comite["id"];
              $comite_format = strtolower(quitar_tildes($comite['comite']));
              if (isset($_POST["coord_" . $comite_format])) {
                $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id_registro, $cargo_id, $comite_id)";
                $result = mysqli_query($conn, $query);
              }            
            }
          }
        }
      }
    } else {
       if(!$validacion2){
        $respuesta = array(
          'respuesta' => 'error_vol_comite'
        );
      }else if(!$validacion3){
        $respuesta = array(
          'respuesta' => 'error_img'
        );
      }else if(!$validacion4){
        $respuesta = array(
          'respuesta' => 'error_coord_comite'
        );
      }
      else{
        $respuesta = array(
          'respuesta' => 'error'
        );
      }
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
  $id_registro = $_POST['id_registro'];
  try {

    include_once "../connection/db_connection.php";
    $conn = mysqli_connect($host, $user, $pw, $db);

    $validacion1 = !empty($_POST['primerNombre']) && !empty($_POST['primerApellido']) && !empty($_POST['nombrePreferido']) && !empty($_POST['nombreEnRama']) && !empty($_POST['anioIngresoRama']) && !empty($_POST['anioSalidaRama']) && !empty($_POST['correo']) && !empty($_POST['celular']) && !empty($_POST['frase']);

    $sql1 = "SELECT * FROM comites";
    $array_comites = $conn->query($sql1);
    #$array_comites = $resultado->fetch_assoc();
    $validacion2 = false; 
    foreach($array_comites as $comite){
      $comite_format = strtolower(quitar_tildes($comite['comite']));
      if(isset($_POST[$comite_format])){
        $validacion2 = true;
      }
    }

    if ($_FILES['imagen-miembro']['name'] != null ) {
      // $errors = [];
      $validacion3 = false;
      $fileSize = $_FILES['imagen-miembro']['size'];
      $fileExtensionsAllowed = ['jpeg', 'jpg', 'png'];
      $path = $_FILES['imagen-miembro']['name'];
      $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));

      if (in_array($ext, $fileExtensionsAllowed)) {
        $validacion3 = true;
      }
    } 

    $validacion4 = false;
    $sql1 = "SELECT * FROM comites";
    $array_comites = $conn->query($sql1);
   
    if(isset($_POST["coordinador"])){
      foreach($array_comites as $comite){
        $comite_format = strtolower(quitar_tildes($comite['comite']));        
          if(isset($_POST["coord_".$comite_format])){
            $validacion4 = true;
          }
      }      
    }else{
      $validacion4 = true;
    } 
   
    if ($validacion1 && $validacion2 && $validacion3 && $validacion4) {

      $primerNombre = $_POST['primerNombre'];
      $segundoNombre = $_POST["segundoNombre"];
      $primerApellido = $_POST["primerApellido"];
      $segundoApellido = $_POST["segundoApellido"];
      $nombrePreferido = $_POST["nombrePreferido"];
      $nombreEnRama = $_POST["nombreEnRama"];
      $anioIngresoRama = $_POST["anioIngresoRama"];
      $anioSalidaRama = $_POST["anioSalidaRama"];
      $correo = $_POST["correo"];
      $celular = $_POST["celular"];
      $frase = $_POST["frase"];
      $urlLinkedin = $_POST["urlLinkedin"];
      if(isset( $_POST["estado"])){
        $estado = $_POST["estado"];
      }else{
        $estado = 0;
      }

      date_default_timezone_set('America/Bogota');
      $primerNombre_img = strtolower(quitar_tildes($primerNombre));
      $primerApellido_img = strtolower(quitar_tildes($primerApellido));

      $sql = "SELECT * FROM miembros WHERE id=$id_registro";
      $resultado = $conn->query($sql);
      $miembro = $resultado->fetch_assoc();

      if($_FILES['imagen-miembro']['name'] != null ){
        $url_anterior = $miembro['urlFoto'];

        if (file_exists($url_anterior)) {
          unlink($url_anterior);
        }
       

        $urlFoto = 'foto_' . $primerNombre_img . '_' . $primerApellido_img . '_' . date('Ymd_his') . '.' . $ext;

        $directorio = "../img/members/";

        if (!is_dir($directorio)) {
          mkdir($directorio, 0755, true);
        }
        
        if (move_uploaded_file($_FILES['imagen-miembro']['tmp_name'], $directorio . $urlFoto)) {
          $imagen_url = $directorio . $urlFoto;  //it should change when every image would be on the same path
          $imagen_resultado = "Se subi?? correctamente";
        } else {
          $respuesta = array(
            'respuesta' => 'error_get_last()'
          );
        }
      }else{
        $imagen_url = $miembro['urlFoto'];
      }

      try {

        $sql = "UPDATE miembros SET primerNombre=?, segundoNombre=?, primerApellido=?, segundoApellido=?, nombrePreferido=?,nombreEnRama=?, anioIngresoRama=?, anioSalidaRama=?, correo=?, celular=?, frase=?, urlLinkedin=?, urlFoto=?, estado=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssisiisisssii", $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $nombrePreferido, $nombreEnRama, $anioIngresoRama, $anioSalidaRama, $correo, $celular, $frase, $urlLinkedin, $imagen_url, $estado, $id_registro);
        $stmt->execute();
        $registros = $stmt->affected_rows;
        $stmt->close();

        $filasAfectadas=0;
        $filasAfectadas+=$registros;        

        $sql2 = "SELECT cargo,comite FROM cargos_de_miembros WHERE miembro=$id_registro";
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

        foreach ($array_cargos as $cargo) {
          // Coordinador TET se convierte a coordinadorTET
          $cargo_format = lcfirst(str_replace(' ', '', quitar_tildes($cargo['cargo'])));
          $cargo_id = $cargo["id"];

          if ($cargo_id != 9 && $cargo_id != 10) {
            $sql00 = "SELECT * FROM cargos_de_miembros WHERE miembro = $id_registro AND cargo = $cargo_id";
            $resultado = $conn->query($sql00);
            $rows = $resultado->num_rows;

            if (isset($_POST[$cargo_format]) && !$rows) {
              $query = "INSERT INTO cargos_de_miembros (miembro, cargo) VALUES ($id_registro, $cargo_id)";
              $result = mysqli_query($conn, $query);
              $filasAfectadas+=1;
            } else if (!isset($_POST[$cargo_format]) && $rows) {
              $query = "DELETE FROM cargos_de_miembros WHERE miembro=$id_registro AND cargo=$cargo_id";
              $result = mysqli_query($conn, $query);
              $filasAfectadas+=1;
            }
          } else if ($cargo_id == 9) { #Coordinador Comite
            foreach ($array_comites as $comite) {
              $comite_id = $comite["id"];
              $comite_format = strtolower(quitar_tildes($comite['comite']));
              $resultado = $conn->query("SELECT * FROM cargos_de_miembros WHERE miembro = $id_registro AND cargo = $cargo_id AND comite = $comite_id");
              $rows = $resultado->num_rows;
              // Voluntario del Comite    
              if (isset($_POST["coord_" . $comite_format]) && !$rows) {
                $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id_registro, $cargo_id, $comite_id)";
                $result = mysqli_query($conn, $query);
                $filasAfectadas+=1;
              } else if (!isset($_POST["coord_" . $comite_format]) && $rows) {
                $query = "DELETE FROM cargos_de_miembros WHERE miembro=$id_registro AND cargo=$cargo_id AND comite=$comite_id";
                $result = mysqli_query($conn, $query);
                $filasAfectadas+=1;
              }
            }

            //$query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 9, 1);";
          } else if ($cargo_id == 10) { #voluntario - comite
            foreach ($array_comites as $comite) {
              $comite_id = $comite["id"];
              $comite_format = strtolower(quitar_tildes($comite['comite']));
              $resultado = $conn->query("SELECT * FROM cargos_de_miembros WHERE miembro = $id_registro AND cargo = $cargo_id AND comite = $comite_id");
              $rows = $resultado->num_rows;
              // Voluntario del Comite    
              if (isset($_POST[$comite_format]) && !$rows) {
                $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id_registro, $cargo_id, $comite_id)";
                $result = mysqli_query($conn, $query);
                $filasAfectadas+=1;
              } else if (!isset($_POST[$comite_format]) && $rows) {
                $query = "DELETE FROM cargos_de_miembros WHERE miembro=$id_registro AND cargo=$cargo_id AND comite=$comite_id";
                $result = mysqli_query($conn, $query);
                $filasAfectadas+=1;
              }
            }
          }
        }

        if ($filasAfectadas > 0) {
          # code...
          $respuesta = array(
            'respuesta' => 'exito'
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
    } else {
      if(!$validacion2){
        $respuesta = array(
          'respuesta' => 'error_vol_comite'
        );
      }else if(!$validacion3){
        $respuesta = array(
          'respuesta' => 'error_img'
        );
      }else if(!$validacion4){
        $respuesta = array(
          'respuesta' => 'error_coord_comite'
        );
      }
      else{
        $respuesta = array(
          'respuesta' => 'error'
        );
      }

      

    }

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


    $sql = "SELECT urlFoto FROM miembros WHERE id=$id_borrar";
    $resultado = $conn->query($sql);
    $miembro = $resultado->fetch_assoc();

    $url_foto = $miembro['urlFoto'];
    if (file_exists($url_foto)) {
      unlink($url_foto);
    }

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