<?php

require_once('../config/databases.php');

$deletar = $_GET['deletar'];

$queryUpdate = "UPDATE usuarios SET deletar = ";
$queryUpdate .= $deletar;
$queryUpdate .= " WHERE id_usuario = '".$_GET['id_usuario']."'";

$resultado = $conn->query($queryUpdate);

$conn->close();

$msn = $deletar == 1 ? "5" : "6";

header('location: ../front/iframeUsuarios.php?pg=1&conf=1&id_usuario=22&msn='.$msn.'');