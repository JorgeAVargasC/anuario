<?php
    include_once("../connection/db_connection.php");
    $conection = mysqli_connect($host, $user, $pw, $db);
    mysqli_set_charset($conection,"utf8");
    $validacion1 = !empty($_POST['primerNombre']) && !empty($_POST['primerApellido']) && !empty($_POST['nombrePreferido']) && !empty($_POST['nombreEnRama']) && !empty($_POST['anioIngresoRama']) && !empty($_POST['anioSalidaRama']) && !empty($_POST['correo']) && !empty($_POST['celular']) && !empty($_POST['frase']);
    $validacion2 = isset($_POST["academico"]) || isset($_POST["ludicas"]) || isset($_POST["logistica"]) || isset($_POST["patrocinio"]) || isset($_POST["publicidad"]);

    $currentDirectory = $_SERVER["DOCUMENT_ROOT"];
    $uploadDirectory = "/anuario/img/members/";
    $errors = []; // Store errors here
    $fileExtensionsAllowed = ['jpeg','jpg','png']; // These will be the only file extensions allowed 

    $fileName = $_FILES['urlFoto']['name'];
    $fileSize = $_FILES['urlFoto']['size'];
    $fileTmpName  = $_FILES['urlFoto']['tmp_name'];
    $fileType = $_FILES['urlFoto']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));

    if (! in_array($fileExtension,$fileExtensionsAllowed)) {
        $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
    }

    if ($fileSize > 2000000) {
        $errors[] = "File exceeds maximum size (4MB)";
    }

    $validacion3 = empty($errors);

    if (isset($_POST["coordinador"])) {
        $validacion4 = isset($_POST["coordinador-academico"]) || isset($_POST["coordinador-ludicas"]) || isset($_POST["coordinador-logistica"]) || isset($_POST["coordinador-patrocinio"]) || isset($_POST["coordinador-publicidad"]);
    }else{
        $validacion4 = true;
    }

    if ($validacion1 && $validacion2 && $validacion3 && $validacion4) {
        // Informacion del miembro
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

        // Subida de la foto
        $newFileName = 'foto_'.$primerNombre.'_'.$primerApellido.'.png';
        $uploadPath = $currentDirectory . $uploadDirectory . basename($newFileName); 
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
        if ($didUpload) {
            echo "<br>El archivo " . basename($newFileName) . " se subió correctamente <br>";
        } else {
            echo "<br>Ocurrió un error al subir la foto <br>";
        }

        $query = "INSERT INTO miembros (primerNombre, segundoNombre, nombrePreferido, primerApellido, segundoApellido, nombreEnRama, anioIngresoRama, anioSalidaRama, correo, celular, frase, urlFoto, urlLinkedin) VALUES ('$primerNombre', '$segundoNombre', $nombrePreferido, '$primerApellido', '$segundoApellido', '$nombreEnRama', $anioIngresoRama, $anioSalidaRama, '$correo', $celular, '$frase', '$newFileName', '$urlLinkedin');";    
        $result = mysqli_query($conection, $query);
        
        // Comites del voluntario

        $query = "SELECT id from miembros WHERE correo='$correo' AND celular=$celular;";
        $result = mysqli_query($conection, $query);
        while($row = mysqli_fetch_assoc($result)){
            $id = $row['id'];
        }
        if (isset($_POST["academico"])) {
            $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 10, 1);";
            $result = mysqli_query($conection, $query);
        }
        if (isset($_POST["ludicas"])) {
            $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 10, 2);";
            $result = mysqli_query($conection, $query);
        }
        if (isset($_POST["logistica"])) {
            $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 10, 3);";
            $result = mysqli_query($conection, $query);
        }
        if (isset($_POST["patrocinio"])) {
            $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 10, 4);";
            $result = mysqli_query($conection, $query);
        }
        if (isset($_POST["publicidad"])) {
            $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 10, 5);";
            $result = mysqli_query($conection, $query);
        }

        // Cargos del miembro
        if (isset($_POST["coordinadorTET"])) {
            $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 1, NULL);";
            $result = mysqli_query($conection, $query);
        }
        if (isset($_POST["webMaster"])) {
            $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 2, NULL);";
            $result = mysqli_query($conection, $query);
        }
        if (isset($_POST["coordinadoraWIE"])) {
            $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 3, NULL);";
            $result = mysqli_query($conection, $query);
        }
        if (isset($_POST["presidente"])) {
            $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 4, NULL);";
            $result = mysqli_query($conection, $query);
        }
        if (isset($_POST["viscepresidente"])) {
            $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 5, NULL);";
            $result = mysqli_query($conection, $query);
        }
        if (isset($_POST["fiscal"])) {
            $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 6, NULL);";
            $result = mysqli_query($conection, $query);
        }
        if (isset($_POST["tesorero"])) {
            $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 7, NULL);";
            $result = mysqli_query($conection, $query);
        }
        if (isset($_POST["secretario"])) {
            $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 8, NULL);";
            $result = mysqli_query($conection, $query);
        }
        if (isset($_POST["coordinador"])) {
            if (isset($_POST["coordinador-academico"])) {
                $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 9, 1);";
                $result = mysqli_query($conection, $query);
            }
            if (isset($_POST["coordinador-ludicas"])) {
                $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 9, 2);";
                $result = mysqli_query($conection, $query);
            }
            if (isset($_POST["coordinador-logistica"])) {
                $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 9, 3);";
                $result = mysqli_query($conection, $query);
            }
            if (isset($_POST["coordinador-patrocinio"])) {
                $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 9, 4);";
                $result = mysqli_query($conection, $query);
            }
            if (isset($_POST["coordinador-publicidad"])) {
                $query = "INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES ($id, 9, 5);";
                $result = mysqli_query($conection, $query);
            }
        }

        echo '<h2>El miembro fue añadido correctamente a la base de datos</h2>';
        echo    '<a href="/anuario/views/add-member.html">
                    <button>Agregar otro miembro</button>
                </a>';
        
    } else {
        echo 'Ocurrio un error en el formulario. Por favor repita el proceso';
        foreach ($errors as $error) {
            echo $error . "These are the errors" . "\n";
        }
    }

    // // Traigo los datos del miembro
    // $id = $_GET["id"];
    // $query = "SELECT * from miembros WHERE id=$id";
    // $result = mysqli_query($conection, $query);
    // while($row = mysqli_fetch_assoc($result)){
    //     $jsonMember = $row;
    // }

    // // Traigo sus cargos
    // $query = "SELECT cargos.cargo, comites.comite FROM cargos_de_miembros JOIN cargos ON cargos_de_miembros.cargo=cargos.id LEFT JOIN comites ON cargos_de_miembros.comite=comites.id WHERE miembro=$id ORDER BY cargos.id ASC";
    // $result = mysqli_query($conection, $query);
    // $jsonCargos = array();
    // while($row = mysqli_fetch_assoc($result)){
    //     $jsonCargos[] = $row;
    // }

    // $jsonRes = array();
    // array_push($jsonRes, $jsonMember, $jsonCargos);
    // print_r(json_encode($jsonRes));
?>