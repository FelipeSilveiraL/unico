<?php
session_start();

require_once('../config/query.php'); //query SISREV

$tela = basename($_SERVER['PHP_SELF']);
$pagina = $_GET['pg'];
$idUsuario = $_SESSION['id_usuario'];
$idSistema = $_SESSION['id_sistema'];

/* ################## CORES DO SISTEMAS  ################## */

if (!empty($idUsuario)) {
    $querySistemaCores .=  ' WHERE id_usuario = ' . $idUsuario . ' AND id_sistema = ' . $idSistema;
    $resultado = $conn->query($querySistemaCores);

    if (!$coressistema = $resultado->fetch_assoc()) {
        $color = "#fff";
    } else {
        $color = $coressistema['color'];
    }
} else {
    echo '<script>window.location.href = "../../../inc/unset.php";</script>';
}


/* ################## MODULOS  ################## */

/* ==== PAGINAS ====*/
if ($tela == "index.php") {
    if ($pagina != NULL) {
        echo '<script>window.location.href = "index.php";</script>';
    }
} else {
    if ($pagina == NULL) {
        echo '<script>window.location.href = "index.php";</script>';
        exit;
    } else {

        /* ################## PERMISSÕES  ################## */

        $queryModulosUser2 = array('1' => ' WHERE SM.id = ' . $pagina . ' AND SUM.id_usuario = ' . $idUsuario);

        $concatena = array_merge($queryModulosUser, $queryModulosUser2);
        $queryModulosUserA = $concatena[0] . $concatena[1];

        $resultadoModulosUser = $conn->query($queryModulosUserA);

        if (!$modulosUser = $resultadoModulosUser->fetch_assoc()) {
            echo '<script>window.location.href = "index.php";</script>';
            exit;
        }
    }
}

/* ################## FUNÇÕES  ################## */

$queryFuncaoUser .= "WHERE id_usuario = '" . $idUsuario . "' AND id_funcao IN ( ";

$queryA = "SELECT id_funcao FROM sisrev_funcao WHERE id_modulos = (SELECT id FROM sisrev_modulos WHERE endereco = '" . $tela . "')";
$resultadoA = $conn->query($queryA);

while ($a = $resultadoA->fetch_assoc()) {
    $queryFuncaoUser .= $a['id_funcao'] . ',';

    //caso tenha mais de uma permissão em cada tela!..... pagina de exemplo é a front/usuarios.php
    $validacao['idFuncao'][] = array(
        'funcao' => $a['id_funcao'],
    );
}

$count = strlen($queryFuncaoUser);
$sub = substr($queryFuncaoUser, 0, $count - 1);
$sub .= ")";

$resultadoFuncao = $conn->query($sub);

if ($resultadoFuncao != false) {
    if (!$funcao = $resultadoFuncao->fetch_assoc()) {
        $usuarioFuncao = 'style= "display: none"';
    }
}