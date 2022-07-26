<?php
    session_start();

    //enviando para validar os dados!
    if(empty($_SESSION['id_usuario'])){
        header('location: front/login.php?pg=1');
    }else{
        header('location: front/index.php?pg=1');
    }
?>