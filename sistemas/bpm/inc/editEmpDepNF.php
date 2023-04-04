<?php
require_once('../config/query.php');

//Editando regra Empresa Departamento
$updateEmpDep = "UPDATE empresa_departamento_nf SET
                    gerente_aprova = '".$_POST['gerap']."',
                    superintendente_aprova = '".$_POST['supap']."',
                    situacao = '".$_POST['situacao']."',
                    lanca_multas = '".$_POST['lancarMultas']."',
                    GESTOR_AREA_APROVA_MULTAS = '".$_POST['gestorAprovaM']."', 
                    LANCA_NOTAS = '".$_POST['lancarNotaM']."'
                    WHERE id_empdep = ".$_GET['id_empdep'];

$resultUptEmpDep = oci_parse($connBpmgp, $updateEmpDep);

if(oci_execute($resultUptEmpDep,OCI_COMMIT_ON_SUCCESS)) {
    header('Location: ../front/nfEmpDep.php?pg='.$_GET['pg'].'&msn=4'); //msn=4 Regra editada com sucesso.
}else{
    $e = oci_error($resultUpdateEmp,OCI_COMMIT_ON_SUCCESS);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
}
oci_free_statement($resultUptEmpDep);
oci_close($connBpmgp);
?>