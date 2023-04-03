<?php
require_once('../config/query.php');

$verifRegra = "SELECT
                id_empresa,
                id_departamento
            FROM
                aprovadores_rh
            WHERE
                    id_empresa = '".$_POST['empresa']."'
            AND id_departamento = '".$_POST['depto']."'";

            $resultVerif = oci_parse($connBpmgp, $verifRegra);
oci_execute($resultVerif);

while ($rowverif = oci_fetch_array($resultVerif, OCI_ASSOC)) {
    header('location: ../front/aprovadoresRH.php?pg='.$_GET['pg'].'&msn=16'); //Já existe uma empresa com esse departamento cadastrado!
}

if(oci_num_rows($resultVerif) == 0){

    //salvando nova regra
    $inserirNovaRegraAp = "INSERT INTO aprovadores_rh (
        aprovador_filial,
        aprovador_area,
        aprovador_marca,
        aprovador_superintendente,
        id_empresa,
        id_departamento,
        aprovador_gerente,
        situacao
    ) VALUES (
        '".$_POST['filial'] ."',
        '".$_POST['area']."',
        '".$_POST['marca']."',
        '".$_POST['super']."',
        '".$_POST['empresa']."',
        '".$_POST['depto']."', 
        '".$_POST['gerente']."',
        '".$_POST['situacao']."')";

    $resultInsert = oci_parse($connBpmgp, $inserirNovaRegraAp);

    if (oci_execute($resultInsert)) {    
        header('location: ../front/aprovadoresRH.php?pg='.$_GET['pg'].'&msn=8');
    }else{
        $e = oci_error($resultdep);
        print htmlentities($e['message']);
        print "\n<pre>\n";
        print htmlentities($e['sqltext']);
        printf("\n%".($e['offset']+1)."s", "^");
        print  "\n</pre>\n";
    }    
}

oci_free_statement($resultVerif);
oci_close($connBpmgp);
?>