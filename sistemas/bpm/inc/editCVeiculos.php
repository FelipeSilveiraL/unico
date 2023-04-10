<?php
session_start();
require_once('../config/query.php');

//data de hoje para o log
$date = date('Y-m-d H:i:s');

//buscando valor anterior
$query = "SELECT codigo_custo_erp FROM codigo_custo_veiculo WHERE id_codigo_custo_veiculo = ".$_GET['id_codigo'];
$resultquery = oci_parse($connBpmgp, $query);
oci_execute($resultquery);

if (($custoVeiculo = oci_fetch_array($resultquery, OCI_BOTH)) != false){
    $antigoERP = $custoVeiculo['CODIGO_CUSTO_ERP'];
}

//alterar
$update = "UPDATE codigo_custo_veiculo SET 

ID_EMPRESA = '".$_POST['id_empresa']."',
TIPO_CUSTO = '".$_POST['tipo_custo']."',
ANO_REFERENCIA = '".$_POST['ano']."',
CODIGO_CUSTO_ERP = '".$_POST['erp']."'

WHERE ID_CODIGO_CUSTO_VEICULO = ".$_GET['id_codigo'];

$resultUpdate = oci_parse($connBpmgp, $update);

if (oci_execute($resultUpdate)){

    //fazendo log de alteração
    $insertLog = "INSERT INTO bpm_log_custo_veiculo (id_usuario, id_codigo_custo_veiculo, custo_erp_anterior, custo_erp_atual, data_alteracao) 
                    VALUES ('".$_SESSION['id_usuario']."', '".$_GET['id_codigo']."', '".$antigoERP."', '".$_POST['erp']."', '".$date."')";
    $resultInsertLog = $conn->query($insertLog);
    $conn->close();
      
    header('Location: ../front/custoVeiculos.php?pg='.$_GET['pg'].'&msn=4');
    oci_free_statement($resultUpdate);
    oci_close($connBpmgp);
}else{
    $e = oci_error($resultUpdate);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
}
