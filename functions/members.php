<?php
    include_once("../connection/db_connection.php");
    $conection = mysqli_connect($host, $user, $pw, $db);
    mysqli_set_charset($conection,"utf8");

    // Traigo los datos del miembro
    $id = $_GET["id"];
    $query = "SELECT * from miembros WHERE id=$id";
    $result = mysqli_query($conection, $query);
    while($row = mysqli_fetch_assoc($result)){
        $jsonMember = $row;
    }

    // Traigo sus cargos
    $query = "SELECT cargos.cargo, comites.comite FROM cargos_de_miembros JOIN cargos ON cargos_de_miembros.cargo=cargos.id LEFT JOIN comites ON cargos_de_miembros.comite=comites.id WHERE miembro=$id ORDER BY cargos.id ASC";
    $result = mysqli_query($conection, $query);
    $jsonCargos = array();
    while($row = mysqli_fetch_assoc($result)){
        $jsonCargos[] = $row;
    }

    $jsonRes = array();
    array_push($jsonRes, $jsonMember, $jsonCargos);
    print_r(json_encode($jsonRes));
?>