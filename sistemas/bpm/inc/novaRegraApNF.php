<?php
require_once('../config/query.php');

$caracteres = array(",00", ".");

$verifRegra = "SELECT
                id_empresa,
                id_departamento
            FROM
                aprovadores_nf
            WHERE id_empresa = ".$_POST['empresa']." AND id_departamento = ".$_POST['depto']."";

$resultVerif = oci_parse($connBpmgp, $verifRegra);
oci_execute($resultVerif);

while ($rowverif = oci_fetch_array($resultVerif, OCI_ASSOC)) {
    header('location: ../front/aprovadoresNF.php?pg='.$_GET['pg'].'&msn=10&erro=13'); //Já existe uma empresa com esse departamento cadastrado!
}

if(oci_num_rows($resultVerif) == 0){
    //salvando nova regra
    $inserirNovaRegraAp = "INSERT INTO aprovadores_nf (
        aprovador_filial,
        aprovador_area,
        aprovador_marca,
        aprovador_superintendente,
        id_empresa,
        id_departamento,
        aprovador_gerente,
        situacao,
        LIMITE_AREA,
        LIMITE_MARCA,
        LIMITE_GERAL,
        LIMITE_SUPERITENDENTE

    ) VALUES (
        '".$_POST['filial'] ."',
        '".$_POST['area']."',
        '".$_POST['marca']."',
        '".$_POST['super']."',
        '".$_POST['empresa']."',
        '".$_POST['depto']."', 
        '".$_POST['gerente']."',
        '".$_POST['situacao']."',         
        '".$limitA = str_replace($caracteres, "", $_POST['limitA'])."', 
        '".$limitM = str_replace($caracteres, "", $_POST['limitM'])."', 
        '".$limitG = str_replace($caracteres, "", $_POST['limitG'])."', 
        '".$limitS = str_replace($caracteres, "", $_POST['limitS'])."')";

       
    $resultInsert = oci_parse($connBpmgp, $inserirNovaRegraAp);

    if (oci_execute($resultInsert)) {
        header('location: ../front/aprovadoresNF.php?pg='.$_GET['pg'].'&msn=8'); //msn 1 Salvo com sucesso!
    }else{
        $e = oci_error($resultInsert);
        print htmlentities($e['message']);
        print "\n<pre>\n";
        print htmlentities($e['sqltext']);
        printf("\n%".($e['offset']+1)."s", "^");
        print  "\n</pre>\n";
    }    
    oci_free_statement($resultInsert);
}

oci_free_statement($resultVerif);
oci_close($connBpmgp);
?>