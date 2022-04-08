<?php
session_start();


header('location: ../front/dashboard.php');

//SESSÕES DO SISTEMA
$_SESSION['ip_servidor'] = $_SERVER['REMOTE_ADDR'];


?>