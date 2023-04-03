<?php

//chamando o banco
require_once('../config/query.php');

//Deletando Regra Aprovador Filial
$deleteAprovFilial = " DELETE FROM aprovadores_rh
                    WHERE
                        id_aprovador = '".$_GET['id']."'";

$resultDelAprovFilial = oci_parse($connBpmgp, $deleteAprovFilial);

if (oci_execute($resultDelAprovFilial)) {
    //msn=3 deletado com sucesso
   header('location: ../front/aprovadoresRH.php?pg='.$_GET['pg'].'&msn=14');//msn=2 deletado com sucesso
}else{
    $e = oci_error($resultDelAprovFilial);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
}

oci_close($connBpmgp);

?>