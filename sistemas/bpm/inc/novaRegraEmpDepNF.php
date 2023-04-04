<?php
require_once('../config/query.php');

//Verificando se a regra já existe
$verifEmpDep = "SELECT
                *
                FROM
                empresa_departamento_nf
                WHERE
                    id_empresa = '".$_POST['empresa']."'
                AND id_departamento = '".$_POST['depto']."'";

$resultVerif = oci_parse($connBpmgp, $verifEmpDep);
oci_execute($resultVerif);

while($rowVerif = oci_fetch_array($resultVerif, OCI_ASSOC)) {
    header('location: ../front/nfEmpDep.php?pg='.$_GET['pg'].'&msn=16');//Já existe uma regra adicionada com a empresa e o departamento
}

if(oci_num_rows($resultVerif) == 0){

    //salvando nova regra
    $inserirNovaRegraEmpDep = "INSERT INTO empresa_departamento_nf (
        gerente_aprova,
        superintendente_aprova,
        id_empresa,
        id_departamento,
        situacao,
        lanca_multas,
        GESTOR_AREA_APROVA_MULTAS,
        lanca_notas
    ) VALUES (
        '".$_POST['gerap']."',
        '".$_POST['supap']."',
        '".$_POST['empresa']."',
        '".$_POST['depto']."',
        '".$_POST['situacao']."',
        '".$_POST['lancarMulta']."',
        '".$_POST['gestorAprovaM']."',
        '".$_POST['lancaNotas']."'
        )";

    $resultInsert = oci_parse($connBpmgp, $inserirNovaRegraEmpDep);

    if(oci_execute($resultInsert)){
        header('location: ../front/nfEmpDep.php?pg='.$_GET['pg'].'&msn=8'); //msn 1 Salvo com sucesso!
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