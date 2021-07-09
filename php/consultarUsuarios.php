<?php
    include 'conexion.php';
    $conection = mysqli_connect($host, $user, $pw, $db);
    $query = 'SELECT * from examenesunicauca_contribution'
    $result = mysqli_query($conection, $query);
    $jsonArray = array();
    while($row = mysqli_fetch_assoc($result)){
        $jsonArray[] = $row;
    }
    print_r($jsonArray)
?>