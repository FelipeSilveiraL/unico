<?php
require_once('../config/query.php');

$verificando = "SELECT * FROM departamento_vendas WHERE nome_departamento = '" . $_POST['departamento'] . "'";

$sucesso = oci_parse($connBpmgp, $verificando);
oci_execute($sucesso);
$verificado = oci_fetch_array($sucesso);
if (!empty($verificado)) {
    oci_free_statement($connBpmgp);
    sleep(1);
    oci_close($connBpmgp);
    header('location: ../front/gerentes.php?pg=' . $_GET['pg'] . '&msn=16'); //msn=2 editado com sucesso
    die();
} else {
    $valor = trim($_POST['cpfValue']);
    $valor = str_replace(".", "", $valor);
    $valor = str_replace(",", "", $valor);
    $valor = str_replace("-", "", $valor);
    $valor = str_replace("/", "", $valor);

    $codigoLogin = $_POST['login_smartshare'];
    $codigoLogin = substr($codigoLogin, -5);

    $loginSmartshare = $_POST['login_smartshare'];
    $loginSmartshare = rtrim($loginSmartshare, $codigoLogin);


    $situacao = ($_POST['situacao'] == "A") ? "A" : $_POST['situacao'];
    $updateRegraGerentes = "UPDATE GERENTE
                SET
                    empresa = '" . $_POST['empresa'] . "',
                    departamento = '" . $_POST['departamento'] . "',
                    nome = '" . $_POST['nome'] . "',
                    cpf = '" . $valor . "',                
                    login_smartshare = '" . $loginSmartshare . "',
                    codigo_login_smartshare = '" . $codigoLogin . "',
                    situacao = '" . $situacao . "'
                WHERE
                    id_gerente = '" . $_GET['id_gerente'] . "'";

    $resultUpdateGerentes = oci_parse($connBpmgp, $updateRegraGerentes);

    if (oci_execute($resultUpdateGerentes)) {
        header('location: ../front/gerentes.php?pg=' . $_GET['pg'] . '&msn=4'); //msn=4 Regra editada com sucesso.
    } else {
        $e = oci_error($resultUpdateGerentes);
        print htmlentities($e['message']);
        print "\n<pre>\n";
        print htmlentities($e['sqltext']);
        printf("\n%" . ($e['offset'] + 1) . "s", "^");
        print  "\n</pre>\n";
    }
    oci_close($connBpmgp);
}
