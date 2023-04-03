<?php
require_once('../config/query.php');

$consultaCaixa = "SELECT * FROM caixas_nf WHERE USUARIO_CAIXA = '".$_POST['userCaixa']."' AND  ID_EMPRESA = ".$_POST['empresa']." AND ID_CAIXA_EMPRESA = '".$_POST['nomeCaixa']."' ";


$resultUpdateEmp = oci_parse($connBpmgp, $consultaCaixa);

oci_execute($resultUpdateEmp);

while($rowcxus = oci_fetch_array($resultUpdateEmp, OCI_ASSOC)){
    header('location: ../front/userCaixa.php?pg='.$_GET['pg'].'&msn=23');//msn=5 usuario ja cadastrado
    break;
}
   
if(oci_num_rows($resultUpdateEmp) == 0){//Não existe, então faça o insert

    $inserirUsuarioCaixa= "INSERT INTO caixas_nf (id_empresa, usuario_caixa,ID_CAIXA_EMPRESA) VALUES (".$_POST['empresa'].", '".$_POST['userCaixa']."','".$_POST['nomeCaixa']."')";

    $resultInsert = oci_parse($connBpmgp, $inserirUsuarioCaixa);

    if(oci_execute($resultInsert, OCI_COMMIT_ON_SUCCESS)){
       /*  oci_free_statement($connBpmgp);
        sleep(1);
        oci_close($connBpmgp); */
        header('location: ../front/userCaixa.php?pg='.$_GET['pg'].'&msn=8');
        die();    
    }else{
        header('location: ../front/userCaixa.php?pg='.$_GET['pg'].'&msn=13');
    }

    oci_free_statement($resultInsert);
}

oci_close($connBpmgp);