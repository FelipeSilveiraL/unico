<?php
require_once('../config/query.php');

//Editando Regra Departamento
$updateDep = " UPDATE departamento_rh
            SET
                situacao = '".$_POST['situacao']."'
            WHERE 
                id_departamento = ".$_GET['id']." ";

           
$resultdep = oci_parse($connBpmgp, $updateDep);

 if(oci_execute($resultdep,OCI_COMMIT_ON_SUCCESS)){
     header('location: ../front/departamentoRH.php?pg='.$_GET['pg'].'&msn=4');
     oci_free_statement($resultdep);
}else{
    $e = oci_error($resultdep);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
}
oci_free_statement($resultdep);
oci_close($connBpmgp); 

?>