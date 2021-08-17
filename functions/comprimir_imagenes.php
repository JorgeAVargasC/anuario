<?php

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

	$resultado_subida = imagejpeg($imgComprimida, $destino, $calidad);
	return $resultado_subida;
}

?>