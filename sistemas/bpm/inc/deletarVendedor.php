<?php
require_once('../config/query.php');

//Deletando regra
$deleteVendedor = " DELETE FROM vendedores
            WHERE
                id_vendedor =  ".$_GET['id'];

$resultDelVendedor = oci_parse($connBpmgp, $deleteVendedor);

if (oci_execute($resultDelVendedor)) {    
    header('location: ../front/vendedores.php?pg='.$_GET['pg'].'&msn=14');//msn=14 deletado com sucesso
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

