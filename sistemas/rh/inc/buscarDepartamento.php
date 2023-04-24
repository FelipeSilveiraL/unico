<?php

require_once ('../../../config/databases.php'); //Puxando banco de dados

$queryBuscarDepartamento = "SELECT
ED.id_departamento,
DR.nome_Departamento
from empresa_departamento ED
LEFT JOIN departamento_rh DR ON (ED.id_departamento = DR.id_departamento)
WHERE ED.id_empresa = ".$_POST['id']." AND ED.situacao = 'A' ORDER BY DR.NOME_DEPARTAMENTO";

$result = oci_parse($connBpmgp, $queryBuscarDepartamento);
oci_execute($result);


while($departamento = oci_fetch_array($result, OCI_ASSOC)){
    echo '<option value="'.$departamento['ID_DEPARTAMENTO'].'">'.$departamento['NOME_DEPARTAMENTO'].'</option>';
}


oci_free_statement($result);
oci_close($connBpmgp);


?>

