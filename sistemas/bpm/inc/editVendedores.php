<?php
require_once('../config/query.php');

$valor = trim($_POST['cpfValue']);
$valor = str_replace(".", "", $valor);
$valor = str_replace(",", "", $valor);
$valor = str_replace("-", "", $valor);
$valor = str_replace("/", "", $valor);

if (strlen($valor) == 10) {
    $valor = str_pad($valor, 10, '0', STR_PAD_LEFT);
} else {
    $valor = $valor;
}

$codigoLogin = $_POST['login_smartshare'];
$codigoLogin = substr($codigoLogin, -5);

$loginSmartshare = $_POST['login_smartshare'];
$loginSmartshare = rtrim($loginSmartshare, $codigoLogin);


$updateRegraVendedores = "UPDATE vendedores
                    SET
                        empresa = '" . $_POST['empresa'] . "',
                        departamento = '" . $_POST['departamento'] . "',
                        nome = '" . $_POST['nome'] . "',
                        cpf = '" . $valor . "',                
                        login_smartshare = '" . $loginSmartshare . "',
                        codigo_login_smartshare = '" . $codigoLogin . "',
                        situacao = '" . $_POST['situacao'] . "',
                        cpf_alfa = '" . $valor . "'
                    WHERE
                        id_vendedor = '" . $_GET['id_vendedor'] . "'";

$resultUpdateVendedores = oci_parse($connBpmgp, $updateRegraVendedores);

oci_execute($resultUpdateVendedores);

header('location: ../front/vendedores.php?pg=' . $_GET['pg'] . '&msn=4'); //msn=4 Regra editada com sucesso.

oci_close($connBpmgp);