<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Prueba comprimir imagenes</title>
</head>

<body>
  <form action="comprimir_imagenes.php" method="post" enctype="multipart/form-data">
    <label>Selecciona una imagen:</label>
    <br>
    <br>
    <input type="file" name="image">
    <br>
    <br>
    <input type="submit" name="submit" value="Subir">
  </form>
</body>

</html>