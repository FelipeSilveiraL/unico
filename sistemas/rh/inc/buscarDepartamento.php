<?php

require_once ('../config/query.php'); //Puxando banco de dados

$queryBuscarDepartamento .= " WHERE ED.id_empresa = ".$_POST['id']." AND ED.situacao = 'A' ORDER BY DR.NOME_DEPARTAMENTO";

$result = oci_parse($connBpmgp, $queryBuscarDepartamento);
oci_execute($result);


while($departamento = oci_fetch_array($result, OCI_ASSOC)){
    echo '<option value="'.$departamento['ID_DEPARTAMENTO'].'">'.$departamento['NOME_DEPARTAMENTO'].'</option>';
}

if(oci_num_rows($result) == 0){
    echo '<option value="">Nenhum departamento encontrado</option>';
}


oci_free_statement($result);
oci_close($connBpmgp);


?>

