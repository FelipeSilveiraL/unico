<?php
session_start();
require_once('../config/query.php');

if (empty($_GET['sistema'])) {
    $sistema = 'id_sistema IS NULL ';
    $valorSistema = "NULL";
} else {
    $sistema = 'id_sistema = ' . $_GET['sistema'];
    $valorSistema = $_GET['sistema'];
}


$queryVerificar = "SELECT * FROM usuarios_sistema_color WHERE id_usuario = " . $_SESSION['id_usuario'] . " AND " . $sistema;
$resultVerificar = $conn->query($queryVerificar );

if ($vericiar = $resultVerificar->fetch_assoc()) {

    $insertColor = "UPDATE usuarios_sistema_color
    SET
    color = '" . $_GET['ArcoIris'] . "'
    WHERE id_usuario = '" . $_SESSION['id_usuario'] . "' AND ".$sistema;

} else {

    $insertColor = "INSERT INTO usuarios_sistema_color
    (id_usuario,
    id_sistema,
    color)
    VALUES
    (" . $_SESSION['id_usuario'] . ",
    " . $valorSistema . ",
    '" . $_GET['ArcoIris'] . "')";
}

$resultadoColor = $conn->query($insertColor);

header('location: ../front/index.php?pg=1');

$conn->close();
