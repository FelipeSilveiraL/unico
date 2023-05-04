<?php
require_once('../config/query.php');

//Deletando regra
$deleteAp = " DELETE FROM caixa_empresa
            WHERE
            id_empresa = '".$_GET['id_empresa']."' AND nome_caixa = '".$_GET['nomeCaixa']."' ";

$resultDelAp = oci_parse($connBpmgp, $deleteAp);

if (oci_execute($resultDelAp)) {    
    header('location: ../front/caixaEmpresa.php?pg='.$_GET['pg'].'&msn=14');//msn=2 deletado com sucesso

    oci_free_statement($connresultDelApBpmgp);
}else{
    $e = oci_error($resultdep);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
}

oci_close($connBpmgp); 

?>

