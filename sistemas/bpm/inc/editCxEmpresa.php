<?php
require_once('../config/query.php');

$inserirUsuarioCaixa = "UPDATE caixa_empresa 
SET id_empresa = " . $_POST['empresa'] . ",
nome_caixa = '" . $_POST['nomeCaixa'] . "'";
$inserirUsuarioCaixa .= !empty($_POST['numeroCaixa']) ? ", numero_caixa_sistema = '" . $_POST['numeroCaixa'] . "'" : "";
$inserirUsuarioCaixa .= " WHERE id_caixa_empresa = " . $_GET['id'] . " ";

$resultInsert = oci_parse($connBpmgp, $inserirUsuarioCaixa);

if (oci_execute($resultInsert)) {
    oci_free_statement($resultInsert);
    header('location: ../front/caixaEmpresa.php?pg=' . $_GET['pg'] . '&msn=4'); //msn=1 adicionado com sucesso

} else {
    header('location: ../front/caixaEmpresa.php?pg=' . $_GET['pg'] . '&msn=13'); //msn=4 erro
}


oci_close($connBpmgp);
