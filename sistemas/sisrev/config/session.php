<?php
session_start();
require_once('query.php');

//MODULOS
$queryModulosUser .= " WHERE SUM.id_usuario = " . $_SESSION['id_usuario'];
$resultadoModuloUser = $conn->query($queryModulosUser);

while ($modulosUserLocal = $resultadoModuloUser->fetch_assoc()) {

    switch ($modulosUserLocal['id_modulo']) {
        case '1':
            $_SESSION['configuracao'] = 'true';
            break;
        case '2':
            $_SESSION['moduloUsuario'] = 'true';
            break;
        case '3':
            $_SESSION['cadastroMF'] = 'true';
            break;
    }
}


//FUNÇÕES