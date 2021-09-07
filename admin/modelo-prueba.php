<?php

include("funciones/quitar_tildes.php");
include("../functions/comprimir_imagenes.php");

if ($_POST['registro'] == 'nuevo') {

	try {

		include_once "../connection/db_connection.php";
		$conn = mysqli_connect($host, $user, $pw, $db);

		$primerNombre = $_POST["primerNombre"];
		$primerApellido = $_POST["primerApellido"];
		echo "Primer Nombre: " . $primerNombre . "<br>";
		echo "Primer Apellido: " . $primerApellido . "<br>";

		if ($_FILES['imagen-miembro']['name'] != null) {
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

		// PRUEBA COMPRIMIR IMAGENES

		// function compressImage($source, $destination, $quality)
		// {
		//   // Obtenemos la información de la imagen
		//   $imgInfo = getimagesize($source);
		//   $mime = $imgInfo['mime'];

		//   // Creamos una imagen
		//   switch ($mime) {
		//     case 'image/jpeg':
		//       $image = imagecreatefromjpeg($source);
		//       break;
		//     case 'image/png':
		//       $image = imagecreatefrompng($source);
		//       break;
		//     case 'image/gif':
		//       $image = imagecreatefromgif($source);
		//       break;
		//     default:
		//       $image = imagecreatefromjpeg($source);
		//   }

		//   // Guardamos la imagen
		//   imagejpeg($image, $destination, $quality);

		//   // Devolvemos la imagen comprimida
		//   return $destination;
		// }

		$source = $_FILES['imagen-miembro']['tmp_name'];

		// Obtenemos la información de la imagen
		$imgInfo = getimagesize($source);
		$mime = $imgInfo['mime'];
		$imgsize = $fileSize / 1024;
		$reduction = $imgsize / 50;
		$quality = 100 - $reduction;


		//$quality = 10;

		echo("FILESIZE: ".$fileSize. "Bytes");
		echo("<br>");
		echo("El tamaño original es de ". $imgsize." KB");
		echo("<br>");
		echo("Se reduce al :  " . $quality . " %");
		echo("<br>");

		// Creamos una imagen
		switch ($mime) {
			case 'image/jpeg':
				$image = imagecreatefromjpeg($source);
				break;
			case 'image/png':
				$image = imagecreatefrompng($source);
				break;
			case 'image/gif':
				$image = imagecreatefromgif($source);
				break;
			default:
				$image = imagecreatefromjpeg($source);
		}

		if (imagejpeg($image, $directorio . $urlFoto, $quality)) {
			$imagen_url = $directorio . $urlFoto;  //it should change when every image would be on the same path
			echo "Url img: " . $imagen_url . "<br>";
			echo "Se subió correctamente";
		} else {
			echo ("NADA QUE FUNCIONA PERRA");
		}
	} catch (Exception $e) {
		//throw $th;
		$respuesta = array(
			'respuesta' => $e->getMessage()
		);
	}
}
