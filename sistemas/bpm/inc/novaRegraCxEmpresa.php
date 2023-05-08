<?php 
require_once('../config/query.php');

//PESQUISANDO ANTES PARA VER SE JÁ NAO EXISTE.
$queryVerifica = "SELECT * FROM caixa_empresa WHERE nome_caixa = '".$_POST['nomeCaixa']."' AND id_empresa = ".$_POST['empresa']." ";

$success = oci_parse($connBpmgp,$queryVerifica);

oci_execute($success);

if($row = oci_fetch_array($success)){
    header('Location: ../front/caixaEmpresa.php?pg='.$_GET['pg'].'&msn=21');
}else{

    $insertQuery = "INSERT INTO caixa_empresa(
            id_empresa,
            nome_caixa,
            numero_caixa_sistema) 

    VALUES 
            (".$_POST['empresa'].",
            '".$_POST['nomeCaixa']."',
            ".$_POST['numeroCaixa'].")";
        
    $sucesso = oci_parse($connBpmgp,$insertQuery);
    

    oci_execute($sucesso);
    header('Location: ../front/caixaEmpresa.php?pg='.$_GET['pg'].'&msn=8');
}

oci_free_statement($success);
oci_close($connBpmgp);
?>