<?php
session_start();

//regras de administrador
switch ($_GET['pg']) {
    case 2:
        if($_SESSION['administrador'] == 0){
            header('location: ../index.php?pg=1');
            exit;
        }        
        break;
    }
?>