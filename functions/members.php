<?php
    include_once("../connection/db_connection.php");
    $conection = mysqli_connect($host, $user, $pw, $db);
    $id = $_GET["id"];
    $query = "SELECT * from miembros WHERE id=$id";
    $result = mysqli_query($conection, $query);
    while($row = mysqli_fetch_assoc($result)){
        $jsonRes = $row;
    }
    print_r(json_encode($jsonRes))
?>