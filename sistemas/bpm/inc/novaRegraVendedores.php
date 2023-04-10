<?php
require_once('../config/query.php');


$cpf = trim($_POST['cpfVet']);
$cpf = str_replace(".", "", $cpf);
$cpf = str_replace(",", "", $cpf);
$cpf = str_replace("-", "", $cpf);
$cpf = str_replace("/", "", $cpf);

if (strlen($cpf) == 10) {
    $cpf = str_pad($cpf, 10, '0', STR_PAD_LEFT);
} else {
    $cpf = $cpf;
}

$verificaCadastro = "SELECT * FROM vendedores WHERE cpf = " . $cpf . " AND departamento = " . $_POST['departamento'] . " AND empresa = " . $_POST['empresa'] . " ";

$encontrou = oci_parse($connBpmgp, $verificaCadastro);
oci_execute($encontrou);

while ($row = oci_fetch_array($encontrou, OCI_ASSOC)) {
    header('location: ../front/vendedores.php?pg=' . $_GET['pg'] . '&msn=22');
}

if (oci_num_rows($encontrou) == 0) {

    $inserirNovaRegraGer = "INSERT INTO VENDEDORES (empresa,departamento,nome,cpf,login_smartshare,codigo_login_smartshare,situacao,cpf_alfa) 
            VALUES (
            '" . $_POST['empresa'] . "',
            '" . $_POST['departamento'] . "',
            '" . $_POST['nome'] . "',
            '" . $cpf . "',
            '" . trim($_POST['login_smartshare']) . "',
            '" . trim($_POST['cd_smartshare']) . "',
            '" . $_POST['situacao'] . "',
            '" . $cpf . "'
            )";

    $resultInsert = oci_parse($connBpmgp, $inserirNovaRegraGer);

    oci_execute($resultInsert);
    header('location: ../front/vendedores.php?pg=' . $_GET['pg'] . '&msn=8'); //msn=2 editado com sucesso
}
oci_free_statement($encontrou);
oci_close($connBpmgp);
