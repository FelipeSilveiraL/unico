<?php
require_once('../config/query.php');

$updateRegraVendedores = "UPDATE departamento_vendas SET NOME_DEPARTAMENTO = '" . $_POST['departamento'] . "'
 WHERE id = " . $_GET['id_dep'];

$sucesso = oci_parse($connBpmgp, $updateRegraVendedores);

if (oci_execute($sucesso)) {
    header('location: ../front/depVendas.php?pg=' . $_GET['pg'] . '&msn=4'); //msn=4 Regra editada com sucesso.
} else {
    $e = oci_error($resultUpdateVendedores);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%" . ($e['offset'] + 1) . "s", "^");
    print  "\n</pre>\n";
}

oci_free_statement($sucesso);
oci_close($connBpmgp);

?>