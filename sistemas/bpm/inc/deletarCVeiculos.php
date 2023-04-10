<?php
require_once('../config/query.php');

//Deletando regra
$deleteAp = " DELETE FROM codigo_custo_veiculo
            WHERE
                ID_CODIGO_CUSTO_VEICULO =  ".$_GET['id_codigo'];

$resultDelAp = oci_parse($connBpmgp, $deleteAp);

if (oci_execute($resultDelAp)) {    
    header('location: ../front/custoVeiculos.php?pg='.$_GET['pg'].'&msn=14');//msn=14 deletado com sucesso
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