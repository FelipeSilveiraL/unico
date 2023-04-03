<?php
session_start();
require_once('../../../config/databases.php');

//Deletando regra
$deleteAp = " DELETE FROM caixas_nf
            WHERE
                ID_EMPRESA = '".$_GET['id_empresa']."' AND usuario_caixa = '".$_GET['usuario_caixa']."' AND id_caixa_empresa = '".$_GET['id_caixa_empresa']."' ";

$resultDelAp = oci_parse($conn, $deleteAp);

if (oci_execute($resultDelAp, OCI_COMMIT_ON_SUCCESS)) {    
    header('location: ../front/userCaixa.php?pg='.$_GET['pg'].'&msn=14');//msn=2 deletado com sucesso
}else{
    $e = oci_error($resultdep);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
}
oci_free_statement($conn);
oci_close($conn);

?>

