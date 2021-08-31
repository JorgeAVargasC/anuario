<?php

include("funciones/quitar_tildes.php");
include("../functions/comprimir_imagenes.php");

if ($_POST['registro'] == 'nuevo') {

  try {

    include_once "../connection/db_connection.php";
    $conn = mysqli_connect($host, $user, $pw, $db);

    $primerNombre = $_POST["primerNombre"];
    $primerApellido = $_POST["primerApellido"];
    echo "Primer Nombre: ".$primerNombre."<br>";
    echo "Primer Apellido: ".$primerApellido."<br>";

    if ($_FILES['imagen-miembro']['name'] != null ) {
      $fileSize = $_FILES['imagen-miembro']['size'];
      $fileExtensionsAllowed = ['jpeg', 'jpg', 'png'];
      $path = $_FILES['imagen-miembro']['name'];
      $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
      $validacion3 = true;

      if (!in_array($ext, $fileExtensionsAllowed)) {
        $validacion3 = false;
      }      
    } 

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
      echo "Url img: ".$imagen_url."<br>";
      echo "Se subió correctamente";
    } else {      
      echo ("nada");
    }      

  } catch (Exception $e) {
    //throw $th;
    $respuesta = array(
      'respuesta' => $e->getMessage()
    );
  }
}

?>






