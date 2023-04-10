<?php
require_once('../config/query.php');

$verificando = "SELECT * FROM gerente WHERE empresa = '" . $_POST['empresa'] . "' AND departamento = " . $_POST['departamento'] . "";

$sucesso = oci_parse($connBpmgp, $verificando);
oci_execute($sucesso);

while ($verificado = oci_fetch_array($sucesso, OCI_ASSOC)) {
    header('location: ../front/gerentes.php?pg=' . $_GET['pg'] . '&msn=20');
}

if (oci_num_rows($sucesso) == 0) {

    $cpf = trim($_POST['cpfVet']);
    $cpf = str_replace(".", "", $cpf);
    $cpf = str_replace(",", "", $cpf);
    $cpf = str_replace("-", "", $cpf);
    $cpf = str_replace("/", "", $cpf);

    $loginSmartshare = $_POST['login_smartshare'];

    $inserirNovaRegraGer = "INSERT INTO GERENTE 
    (empresa,
    departamento,
    nome,cpf,
    login_smartshare,
    codigo_login_smartshare,
    situacao)

        VALUES (

    '" . $_POST['empresa'] . "',
    '" . $_POST['departamento'] . "',
    '" . $_POST['nome'] . "',
    '" . $cpf . "',
    '" . trim($_POST['login_smartshare']) . "',
    '" . trim($_POST['cd_smartshare']) . "',
    '" . $_POST['situacao'] . "'
    )";

    $resultInsert = oci_parse($connBpmgp, $inserirNovaRegraGer);
    oci_execute($resultInsert);
    header('location: ../front/gerentes.php?pg=' . $_GET['pg'] . '&msn=8');
    oci_free_statement($resultInsert);
    oci_close($connBpmgp);
}
