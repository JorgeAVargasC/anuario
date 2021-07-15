<?php

if (isset($_POST['miembro'])) {

    if ($_POST['miembro'] == 'nuevo') {  
        
        try {

            include_once "../connection/db_connection.php";
            $conn = mysqli_connect($host, $user, $pw, $db);


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

            
            $directorio = "../img/members/";        
            if (!is_dir($directorio)) {
                # code...
                mkdir($directorio, 0755, true);
            }

            date_default_timezone_set('America/Bogota');
            $path = $_FILES['imagen-miembro']['name'];
            $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
            $primerNombre_img = strtolower($primerNombre);
            $primerApellido_img = strtolower($primerApellido);
            $urlFoto = 'foto_' . $primerNombre_img . '_' . $primerApellido_img . '_' . date('Ymd_his') . '.' . $ext;

            if (move_uploaded_file($_FILES['imagen-miembro']['tmp_name'], $directorio . $urlFoto)) {
                # code...
                $imagen_url = $directorio . $urlFoto;  //Texto original it should change when every image would be on the same path
                
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

                        
            /*
            if (isset($_POST["academico"])) {
                $stmt = $conn->prepare("INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES (?, ?, ?)");
                $stmt->bind_param("ddd", $id, 10, 1);
                $stmt->execute();
            }
            if (isset($_POST["ludicas"])) {
                $stmt = $conn->prepare("INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES (?, ?, ?)");
                $stmt->bind_param("ddd", $id, 10, 2);
                $stmt->execute();
            }
            if (isset($_POST["logistica"])) {
                $stmt = $conn->prepare("INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES (?, ?, ?)");
                $stmt->bind_param("ddd", $id, 10, 3);
                $stmt->execute();
            }
            if (isset($_POST["patrocinio"])) {
                $stmt = $conn->prepare("INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES (?, ?, ?)");
                $stmt->bind_param("ddd", $id, 10, 4);
                $stmt->execute();
            }
            if (isset($_POST["publicidad"])) {
                $stmt = $conn->prepare("INSERT INTO cargos_de_miembros (miembro, cargo, comite) VALUES (?, ?, ?)");
                $stmt->bind_param("ddd", $id, 10, 5);
                $stmt->execute();
            }
            */
            
            /*
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
            }


            */
            
        } catch (Exception $e) {
            //throw $th;
            $respuesta = array(
                'respuesta' => $e->getMessage()
            );
        }

        die(json_encode($respuesta));
    }



    
} //---

?>