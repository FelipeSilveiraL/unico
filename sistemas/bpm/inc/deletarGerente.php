<?php
require_once('../config/query.php');

//Deletando regra
$deleteGerente = " DELETE FROM gerente
            WHERE
                id_gerente =  ".$_GET['id'];

$resultDelGerente = oci_parse($connBpmgp, $deleteGerente);

if (oci_execute($resultDelGerente)) {    
    header('location: ../front/gerentes.php?pg='.$_GET['pg'].'&msn=14');//msn=14 deletado com sucesso
}else{
    $e = oci_error($resultDelGerente);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
}
oci_free_statement($resultDelGerente);
oci_close($connBpmgp); 

?>

