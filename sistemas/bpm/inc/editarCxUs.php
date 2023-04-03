<?php
session_start();
require_once('../../../config/databases.php');

$id = $_GET['id'];
$user = $_GET['user'];

$inserirUsuarioCaixa= "UPDATE caixas_nf SET usuario_caixa = '".$_POST['userCaixa']."', id_caixa_empresa = '".$_POST['nomeCaixa']."' WHERE ID_EMPRESA = '".$_POST['id_empresa']."' AND usuario_caixa = '".$user."' AND ID_CAIXA_EMPRESA = '".$id."'";

$resultInsert = oci_parse($connBpmgp, $inserirUsuarioCaixa);

if(oci_execute($resultInsert, OCI_COMMIT_ON_SUCCESS)){
    
    header('location: ../front/userCaixa.php?pg='.$_GET['pg'].'&msn=4');//msn=1 adicionado com sucesso
    
}else{
    header('location: ../front/userCaixa.php?pg='.$_GET['pg'].'&msn=13');//msn=4 erro
}

oci_free_statement($connBpmgp);
  
oci_close($connBpmgp);