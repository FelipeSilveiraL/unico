<?php
session_start();
/* esse sistema usa o $connNotas - (dbnotas) */


//VARIAVEIS DO SISTEMA
$_SESSION['id_sistema'] = $_GET['id_sistema'];



header('Location: ../front/index.php');

?>