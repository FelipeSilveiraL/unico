<?php
session_start();
include '../../session/session.php';
include '../config/conexaoSmart.php';

//Deletando regra
$deleteAp = " DELETE FROM caixa_empresa
            WHERE
            id_empresa = '".$_GET['id_empresa']."' AND nome_caixa = '".$_GET['nomeCaixa']."' ";

$resultDelAp = oci_parse($conn, $deleteAp);

if (oci_execute($resultDelAp, OCI_COMMIT_ON_SUCCESS)) {    
    header('location: http://'.$_SESSION['ip_unico'].'/unico/sistemas/bpm/front/caixaEmpresa.php?pg='.$_GET['pg'].'&msn=14');//msn=2 deletado com sucesso
    oci_close($conn); 
    oci_free_statement($conn);
}else{
    $e = oci_error($resultdep);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
}

oci_close($conn); 

?>

