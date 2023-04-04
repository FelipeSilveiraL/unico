<?php

require_once('../config/query.php');

//Deletando regra
$deleteEmpDep = "DELETE FROM empresa_departamento_nf WHERE id_empdep = ".$_GET['id'];

$resultDelEmpDep = oci_parse($connBpmgp, $deleteEmpDep);

if (oci_execute($resultDelEmpDep)) {
     header('location: ../front/nfEmpDep.php?pg='.$_GET['pg'].'&msn=5');//msn=5 deletado com sucesso

}else{
    $e = oci_error($resultdep);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
}

oci_free_statement($resultDelEmpDep);
oci_close($connBpmgp); 

?>