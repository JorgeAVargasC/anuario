<?php

function usuario_autenticado() {

    if (!revisar_usuario()) {
        # code...
        header('location: login.php');
        exit();
    }
}

function revisar_usuario() {

    return isset($_SESSION['usuario']);
}

session_start();
usuario_autenticado();

?>