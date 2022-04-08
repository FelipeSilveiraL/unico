<?php
    session_start();

    //enviando para validar os dados!
    if(empty($_SESSION['id_usuario'])){
        header('location: back/config.php');
    }else{
        header('location: front/dashboard.php');
    }