<?php
require_once('../config/query.php');

//Editando regra Empresa Departamento

$updateEmpDep = "UPDATE EMPRESA_DEPARTAMENTO
                SET
                    GERENTE_APROVA = '".$_POST['gerap']."',
                    SUPERINTENDENTE_APROVA = '".$_POST['supap']."',
                    SITUACAO = '".$_POST['situacao']."'
                WHERE
                    ID_EMPDEP = '".$_POST['id_empdep']."' ";


$resultUptEmpDep = oci_parse($connBpmgp, $updateEmpDep);

if(oci_execute($resultUptEmpDep , OCI_COMMIT_ON_SUCCESS)) {
   header('location: ../front/rhEmpDep.php?pg='.$_GET['pg'].'&msn=4'); //msn=4 Regra editada com sucesso.
}else{
    $e = oci_error($resultUptEmpDep);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
}

oci_free_statement($resultUptEmpDep);
oci_close($connBpmgp);

?>