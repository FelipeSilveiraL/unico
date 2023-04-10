<?php
require_once('../config/query.php');
//PESQUISANDO ANTES PARA VER SE JÁ NAO EXISTE.

$query = "SELECT * FROM codigo_custo_veiculo WHERE 
                ID_EMPRESA = '" . $_POST['empresa'] . "' AND 
                TIPO_CUSTO = '" . $_POST['tipo_custo'] . "' AND 
                CODIGO_CUSTO_ERP = '" . $_POST['erp'] . "'";
$resultQuery = oci_parse($connBpmgp, $query);
oci_execute($resultQuery);

while ($empresa = oci_fetch_array($resultQuery, OCI_ASSOC)) {
    header('Location: ../front/custoVeiculos.php?pg=' . $_GET['pg'] . '&msn=20');
    oci_free_statement($resultQuery);
    oci_close($connBpmgp);
    exit;
}

if (oci_num_rows($resultQuery) == 0) {

    $insert = "INSERT INTO codigo_custo_veiculo 
    (ID_EMPRESA, TIPO_CUSTO, CODIGO_CUSTO_ERP)
    VALUES
    ('" . $_POST['empresa'] . "','" . $_POST['tipo_custo'] . "', '" . $_POST['erp'] . "')";
    $resultadoInsert = oci_parse($connBpmgp, $insert);

    if (oci_execute($resultadoInsert)) {
        header('Location: ../front/custoVeiculos.php?pg=' . $_GET['pg'] . '&msn=8');
        exit;
    } else {
        $e = oci_error($resultadoInsert);
        print htmlentities($e['message']);
        print "\n<pre>\n";
        print htmlentities($e['sqltext']);
        printf("\n%" . ($e['offset'] + 1) . "s", "^");
        print  "\n</pre>\n";
    }

    oci_free_statement($resultadoInsert);
    oci_close($connBpmgp);
}
