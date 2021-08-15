<?php

$carpeta = "../functions/";
$calidad = 35;

$img = $_FILES["image"]["tmp_name"];
$imgSize = $_FILES["image"]["size"];
$imgNombre = $_FILES["image"]["name"];

$imgRuta = $carpeta . $imgNombre;

$imgInfo = getimagesize($img);
$imgExt = $imgInfo['mime'];

switch ($imgExt) {
	case 'image/jpeg':
		$img = imagecreatefromjpeg($img);
		break;
	case 'image/png':
		$img = imagecreatefrompng($img);
		break;
	case 'image/gif':
		$img = imagecreatefromgif($img);
		break;
	default:
		$img = imagecreatefromjpeg($img);
}

/*
echo "Imagen: " . $img;
print "<br>";
echo "Size: " . $imgSize . " bytes";
print "<br>";
echo "Size: ".$imgSize/pow(1024,2)." MB";
print "<br>";
echo "Extension: " . $imgExt;
print "<br>";
echo "Nombre: " . $imgNombre;
print "<br>";
print_r($imgInfo);
*/

imagejpeg($img, $imgRuta, $calidad);