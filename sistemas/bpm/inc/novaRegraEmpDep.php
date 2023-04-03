<?php
require_once('../config/query.php');

//Verificando se a regra já existe
$verifEmpDep = "SELECT
                *
                FROM
                empresa_departamento
                WHERE
                    id_empresa = '".$_POST['empresa']."' AND id_departamento = '".$_POST['depto']."'";

$resultVerif = oci_parse($connBpmgp, $verifEmpDep);
oci_execute($resultVerif);

while($rowVerif = oci_fetch_array($resultVerif, OCI_ASSOC)) {
    header('location: ../front/rhEmpDep.php?pg='.$_GET['pg'].'&msn=18');
}

if(oci_num_rows($resultVerif) == 0){

    //salvando nova regra
    $inserirNovaRegraEmpDep = "INSERT INTO empresa_departamento (
        gerente_aprova,
        superintendente_aprova,
        id_empresa,
        id_departamento,
        situacao
    ) VALUES (
        '".$_POST['gerap']."',
        '".$_POST['supap']."',
        '".$_POST['empresa']."',
        '".$_POST['depto']."',
        '".$_POST['situacao']."')";
	
    $resultInsert = oci_parse($connBpmgp, $inserirNovaRegraEmpDep);
    oci_execute($resultInsert);

    header('location: ../front/rhEmpDep.php?pg='.$_GET['pg'].'&msn=8');
    oci_free_statement($resultInsert);

}

oci_free_statement($resultVerif);
oci_close($connBpmgp); 

?>