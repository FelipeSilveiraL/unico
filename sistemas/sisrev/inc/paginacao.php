<?php
session_start();


require_once('../config/query.php');//query SISREV
$tela = basename($_SERVER['PHP_SELF']);



/* ################## CORES DO SISTEMAS  ################## */

$querySistemaCores .=  ' WHERE id_usuario = ' . $_SESSION['id_usuario'] . ' AND id_sistema = ' . $_SESSION['id_sistema'];
$resultado = $conn->query($querySistemaCores);

if (!$coressistema = $resultado->fetch_assoc()) { $color = "#fff"; } else { $color = $coressistema['color']; }



/* ################## PERMISSÕES  ################## */


//SEGUNDO EU VEJO SE TENHO PERMISSÃO PARA ESTAR NESTA TELA!

$queryModulosUser .= ' WHERE SUM.id_usuario = '.$_SESSION['id_usuario'];
$resultadoModulosUser = $conn->query($queryModulosUser);

while($modulosUser = $resultadoModulosUser->fetch_assoc()){
    $endereco = explode('?', $modulosUser['endereco'], 2);

    if($tela == $endereco[0]){
        //echo 'é igual';
    }else{
        //echo 'é diferente';
    }

}

/* ################## PAGINAÇÃO  ################## */

/* ==== PAGINAS ====*/
//index.php
if($tela == "index.php"){if($_GET['pg'] != NULL){echo '<script>window.location.href = "index.php";</script>';}}