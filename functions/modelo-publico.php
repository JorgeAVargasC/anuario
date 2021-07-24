<?php

include("../functions/quitar_tildes.php");

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

    $errors = [];
    $fileSize = $_FILES['imagen-miembro']['size'];
    $fileExtensionsAllowed = ['jpeg', 'jpg', 'png'];
    $path = $_FILES['imagen-miembro']['name'];
    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));

    if ($_FILES['imagen-miembro']['name'] != null ) {
      $errors = [];
      $fileSize = $_FILES['imagen-miembro']['size'];
      $fileExtensionsAllowed = ['jpeg', 'jpg', 'png'];
      $path = $_FILES['imagen-miembro']['name'];
      $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));

      if (!in_array($ext, $fileExtensionsAllowed)) {
        $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
      }
      if ($fileSize > 1572864) {
        $errors[] = "File exceeds maximum size (1.5MB)";
      }
      $validacion3 = empty($errors);
    } else {      
      $validacion3 = false;
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
        }else if ($cargo_id == 9) { // Voluntario del Comite
          foreach ($array_comites as $comite) {
            $comite_id = $comite["id"];
            $comite_format = strtolower(quitar_tildes($comite['comite']));
            if (isset($_POST["coord_" . $comite_format])) {
              $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id_registro, $cargo_id, $comite_id)";
              $result = mysqli_query($conn, $query);
            }
          }
        }else if ($cargo_id == 10) { //Coordinador comites
          if (isset($_POST["coordinador"])) {
            foreach ($array_comites as $comite) {
              $comite_id = $comite["id"];
              $comite_format = strtolower(quitar_tildes($comite['comite']));
              if (isset($_POST[$comite_format])) {
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
