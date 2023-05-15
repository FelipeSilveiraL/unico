<?php
session_start();
require_once('../../../config/query.php');


$queryVerificar = "SELECT * FROM usuarios_sistema_color WHERE id_usuario = " . $_SESSION['id_usuario'] . " AND id_sistema = " . $_SESSION['id_sistema'];
$resultVerificar = $conn->query($queryVerificar);

if ($vericiar = $resultVerificar->fetch_assoc()) {

    $insertColor = "UPDATE usuarios_sistema_color
    SET
    color = '" . $_GET['ArcoIris'] . "'
    WHERE id_usuario = '" . $_SESSION['id_usuario'] . "' AND id_sistema = " . $_SESSION['id_sistema'];
} else {

    $insertColor = "INSERT INTO usuarios_sistema_color
    (id_usuario,
    id_sistema,
    color)
    VALUES
    (" . $_SESSION['id_usuario'] . ",
    " . $_SESSION['id_sistema'] . ",
    '" . $_GET['ArcoIris'] . "')";
}

$resultadoColor = $conn->query($insertColor);

header('location: ../front/index.php?pg=1');

$conn->close();
