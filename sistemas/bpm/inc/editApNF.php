<?php
require_once('../config/query.php');

$caracteres = array(",00", ".");

//Editando Regra
$updateRegra = "UPDATE aprovadores_nf
            SET
                aprovador_area = '".$_POST['area']."',
                aprovador_filial = '".$_POST['filial']."',                
                aprovador_marca = '".$_POST['marca']."',
                aprovador_gerente = '".$_POST['gerente']."',
                aprovador_superintendente = '".$_POST['super']."',
                situacao = '".$_POST['situacao']."',
                LIMITE_AREA = '".$limitA = str_replace($caracteres, "", $_POST['limitA'])."',
                LIMITE_MARCA = '".$limitM = str_replace($caracteres, "", $_POST['limitM'])."',
                LIMITE_GERAL = '".$limitG = str_replace($caracteres, "", $_POST['limitG'])."',
                LIMITE_SUPERITENDENTE = '".$limitS = str_replace($caracteres, "", $_POST['limitS'])."'
            WHERE
                id_aprovador = '".$_GET['id_aprovador']."'";

$resultUpdate = oci_parse($connBpmgp, $updateRegra);

if (oci_execute($resultUpdate)) {
    header('location: ../front/aprovadoresNF.php?pg='.$_GET['pg'].'&msn=4');//msn=2 editado com sucesso
}else{
    $e = oci_error($resultUpdate);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
}

oci_close($connBpmgp)

?>
