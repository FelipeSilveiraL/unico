<?php
session_start();

require_once('../config/query.php'); //query SISREV
$tela = basename($_SERVER['PHP_SELF']);

/* ################## CORES DO SISTEMAS  ################## */

$querySistemaCores .=  ' WHERE id_usuario = ' . $_SESSION['id_usuario'] . ' AND id_sistema = ' . $_SESSION['id_sistema'];
$resultado = $conn->query($querySistemaCores);

if (!$coressistema = $resultado->fetch_assoc()) {
    $color = "#fff";
} else {
    $color = $coressistema['color'];
}


/* ################## PAGINAÇÃO  ################## */

/* ==== PAGINAS ====*/
//index.php
if ($tela == "index.php") {
    if ($_GET['pg'] != NULL) {
        echo '<script>window.location.href = "index.php";</script>';
    }
} else {
    if ($_GET['pg'] == NULL) {
        echo '<script>window.location.href = "index.php";</script>';
        exit;
    } else {

        /* ################## PERMISSÕES  ################## */

        $queryModulosUser2 = array('1' => ' WHERE SM.id = ' . $_GET['pg'] . ' AND SUM.id_usuario = ' . $_SESSION['id_usuario']);

        $concatena = array_merge($queryModulosUser, $queryModulosUser2);
        $queryModulosUserA = $concatena[0] . $concatena[1];


        $resultadoModulosUser = $conn->query($queryModulosUserA);

        if (!$modulosUser = $resultadoModulosUser->fetch_assoc()) {
            echo '<script>window.location.href = "index.php";</script>';
            exit;
        }
    }
}
