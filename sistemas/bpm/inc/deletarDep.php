<?php
require_once('../config/query.php');


//Verificando se o departamento tem algum relacionamento em alguma outra tabela
$selectDep = "SELECT
                d.id_departamento  AS departamento,
                ed.id_departamento AS empresa_departamento,
                a.id_departamento  AS aprovadoresrh,
                g.id_departamento  AS gestordireto
            FROM
                departamento_rh      d
            LEFT JOIN empresa_departamento ed ON ( d.id_departamento = ed.id_departamento )
            LEFT JOIN aprovadores_rh       a ON ( d.id_departamento = a.id_departamento )
            LEFT JOIN gestor_direto        g ON ( d.id_departamento = g.id_departamento )
            WHERE
                    d.id_departamento = ".$_GET['id']." AND ROWNUM = 1";

$resultDep = oci_parse($connBpmgp, $selectDep);
oci_execute($resultDep);

if(($rowDep = oci_fetch_array($resultDep, OCI_BOTH)) != FALSE) { 

    if (($rowDep['EMPRESA_DEPARTAMENTO'] != NULL) || ($rowDep['APROVADORESRH'] != NULL) || ($rowDep['GESTORDIRETO'] != NULL)) {
        header('location: ../front/departamentoRH.php?pg='.$_GET['pg'].'&msn=17');//msn=5 Departamento já possui relação em outra tabela
    }else{
    //Deletando Departamento

    $deleteDep = "DELETE FROM departamento_rh
                WHERE
                    id_departamento = '".$_GET['id']."'";

    $resultDelDep = oci_parse($connBpmgp, $deleteDep);
    oci_execute($resultDelDep);

    header('location:../front/departamentoRH.php?pg='.$_GET['pg'].'&msn=5');//msn=3 deletado com sucesso

    }
    oci_free_statement($resultDelDep);
}

oci_free_statement($resultDep);
oci_close($connBpmgp);
