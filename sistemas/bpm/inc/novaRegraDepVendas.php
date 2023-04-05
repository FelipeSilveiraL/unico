<?php
 require_once('../config/query.php');

$queryNomeDepartamento = "SELECT * FROM departamento_vendas WHERE nome_departamento = '" . $_POST['departamento'] . "'";


$sucesso = oci_parse($connBpmgp, $queryNomeDepartamento);
oci_execute($sucesso);

while ($verificado = oci_fetch_array($sucesso, OCI_ASSOC)) {
    header('location: ../front/depVendas.php?pg=' . $_GET['pg'] . '&msn=16'); //msn=16 ja existe no banco de dados
}

if (oci_num_rows($sucesso) == 0) {

    $inserirNovaRegraDepVendas = "INSERT INTO departamento_vendas (nome_departamento) VALUES ('" . $_POST['departamento'] . "')";
    
   
    $resultInsert = oci_parse($connBpmgp, $inserirNovaRegraDepVendas);
    
    if(oci_execute($resultInsert)){
        header('location:../front/depVendas.php?pg=' . $_GET['pg'] . '&msn=8');
    }
    oci_free_statement($resultInsert);
}

oci_close($connBpmgp);

?>