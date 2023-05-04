<?php
session_start();
include '../config/conexaoSmart.php';
include '../../session/session.php';

$inserirUsuarioCaixa= "UPDATE caixa_empresa 
SET id_empresa = ".$_POST['empresa'].",
 nome_caixa = '".$_POST['nomeCaixa']."',
  numero_caixa_sistema = ".$_POST['numeroCaixa']." 
WHERE id_caixa_empresa = ".$_GET['id']." ";

$resultInsert = oci_parse($conn, $inserirUsuarioCaixa);

if(oci_execute($resultInsert, OCI_COMMIT_ON_SUCCESS)){
    oci_free_statement($conn);
    sleep(1);
    oci_close($conn);
    header('location: http://'.$_SESSION['ip_unico'].'/unico/sistemas/bpm/front/caixaEmpresa.php?pg='.$_GET['pg'].'&msn=4');//msn=1 adicionado com sucesso
    die();

}else{
    header('location: http://'.$_SESSION['ip_unico'].'/unico/sistemas/bpm/front/caixaEmpresa.php?pg='.$_GET['pg'].'&msn=13');//msn=4 erro
}