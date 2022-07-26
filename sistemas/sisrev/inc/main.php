<?php
session_start();

//VARIAVEIS DO SISTEMA
$_SESSION['id_sistema'] = $_GET['id_sistema'];

header('Location: ../front/index.php');

?>