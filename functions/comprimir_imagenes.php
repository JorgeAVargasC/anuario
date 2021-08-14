<?php

$img = $_FILES["image"]["tmp_name"];
$imgNombre = $_FILES["image"]["name"];

$imgInfo = getimagesize($img);
$imgExt = $imgInfo['mime'];

switch ($imgExt) {
	case 'image/jpeg': $img = imagecreatefromjpeg($img);
		break;
	case 'image/png': $img = imagecreatefrompng($img);
		break;
	case 'image/gif': $img = imagecreatefromgif($img);
		break;
	default: $img = imagecreatefromjpeg($img);
}

$carpeta = "../functions/";
$calidad = 35;
$imgRuta = $carpeta . $imgNombre;

imagejpeg($img, $imgRuta, $calidad);






/*
function compressImage($imgOriginal, $destino, $calidad){

	$imgInfo = getimagesize($imgOriginal);
	$mime = $imgInfo['mime'];

	switch ($mime) {
		case 'image/jpeg':
			$imgComprimida = imagecreatefromjpeg($imgOriginal);
			break;
		case 'image/png':
			$imgComprimida = imagecreatefrompng($imgOriginal);
			break;
		case 'image/gif':
			$imgComprimida = imagecreatefromgif($imgOriginal);
			break;
		default:
			$imgComprimida = imagecreatefromjpeg($imgOriginal);
	}

	imagejpeg($imgComprimida, $destino, $calidad);
	
}

// Ruta subida
$uploadPath = "uploads/";

// Si el fichero se ha enviado
$status = $statusMsg = '';
if (isset($_POST["submit"])) {
	$status = 'error';
	if (!empty($_FILES["image"]["name"])) {
		// File info 
		$fileName = basename($_FILES["image"]["name"]);
		$imageUploadPath = $uploadPath . $fileName;
		$fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);

		// Permitimos solo unas extensiones
		$allowTypes = array('jpg', 'png', 'jpeg', 'gif');
		if (in_array($fileType, $allowTypes)) {
			// Image temp source 
			$imageTemp = $_FILES["image"]["tmp_name"];

			// Comprimos el fichero
			$compressedImage = compressImage($imageTemp, $imageUploadPath, 5);

			if ($compressedImage) {
				$status = 'success';
				$statusMsg = "La imagen se ha subido satisfactoriamente.";
			} else {
				$statusMsg = "La compresion de la imagen ha fallado";
			}
		} else {
			$statusMsg = 'Lo sentimos, solo se permiten imágenes con estas extensiones: JPG, JPEG, PNG, & GIF.';
		}
	} else {
		$statusMsg = 'Por favor, selecciona una imagen.';
	}
}

// Mostrar el estado de la imagen 
echo $statusMsg;
*/
