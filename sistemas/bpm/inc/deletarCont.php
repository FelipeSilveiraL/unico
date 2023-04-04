<?php
require_once('../config/query.php');

//Deletando regra
$deleteAp = " DELETE FROM contas_bancarias_fornecedor WHERE ID_CONTA =  ".$_GET['id_conta'];

$resultDelAp = oci_parse($connBpmgp, $deleteAp);

if (oci_execute($resultDelAp)) {    
    header('location: ../front/contasBancarias.php?pg='.$_GET['pg'].'&msn=14'); //msn=2 deletado com sucesso
}else{
    $e = oci_error($resultDelAp);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
}

oci_free_statement($resultDelAp);

oci_close($connBpmgp); 

?>

