<?php
require_once('../config/query.php');

//Deletando regra
$deleteAp = " DELETE FROM fornecedores_seminovos
            WHERE
                id_fornecedor = ".$_GET['id_fornecedor'];

$resultDelAp = oci_parse($connBpmgp, $deleteAp);

if (oci_execute($resultDelAp)) {    
   header('location: ../front/seminovos.php?pg='.$_GET['pg'].'&msn=5');
;//msn=3 deletado com sucesso
}else{
    $e = oci_error($resultDelAp);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
}

oci_close($connBpmgp); 
?>

