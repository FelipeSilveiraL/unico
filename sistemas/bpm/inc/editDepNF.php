<?php
require_once('../config/query.php');

//Editando Regra Departamento
$updateDep = " UPDATE departamento_nf
            SET
                situacao = '".$_POST['situacao']."'
            WHERE 
                id_departamento = '".$_GET['id']."'";
                
$resultdep = oci_parse($connBpmgp, $updateDep);
oci_execute($resultdep);

header('location: ../front/departamentoNF.php?pg='.$_GET['pg'].'&msn=4');

oci_free_statement($resultdep);
oci_close($connBpmgp); 
?>