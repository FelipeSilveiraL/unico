<?php

require_once('../config/query.php');

$SelectDepVendas = "SELECT * FROM VENDEDORES WHERE DEPARTAMENTO = ".$_GET['id'];
$SUCESSO = oci_parse($connBpmgp, $SelectDepVendas);
oci_execute($SUCESSO);

while ($row = oci_fetch_array($SUCESSO, OCI_ASSOC)) {
    header('Location: ../front/depVendas.php?pg='.$_GET['pg'].'&msn=17');
}

if(oci_num_rows($SUCESSO) == 0){

    $DeletDepVendas = "DELETE FROM DEPARTAMENTO_VENDAS WHERE ID = ".$_GET['id'];
    $SUCESSO = oci_parse($connBpmgp, $DeletDepVendas);

   oci_execute($SUCESSO);

    header('Location: ../front/depVendas.php?pg='. $_GET['pg'] . '&msn=14'); 
    

    oci_free_statement($SUCESSO);
}

oci_free_statement($SUCESSO);
oci_close($connBpmgp);
