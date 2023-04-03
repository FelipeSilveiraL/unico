<?php
require_once('../funcoes/funcoes.php');
require_once('../config/query.php');

$espace = trim($_POST['nomedpto']);

$car = sanitizeString($espace);

$updpto = strtoupper($car);

//verificar se ja existe
$verdpto = "SELECT nome_departamento FROM departamento_rh WHERE NOME_DEPARTAMENTO = '".$updpto."'";

$resultrh = oci_parse($connBpmgp, $verdpto);
oci_execute($resultrh);

while($rowdpto = oci_fetch_array($resultrh, OCI_ASSOC)) {
    header('location: ../front/departamentoRH.php?pg='.$_GET['pg'].'&msn=4'); 
}

if(oci_num_rows($resultrh) == 0){    
    $insertDpto = "INSERT INTO departamento_rh (
        nome_departamento,
        situacao
    ) VALUES (
        '".$updpto."',
        '".$_POST['situacao']."'
    )";

    $resultInsert = oci_parse($connBpmgp, $insertDpto);
    
    if(oci_execute($resultInsert)){
        header('location: ../front/departamentoRH.php?pg='.$_GET['pg'].'&msn=4'); //msn dpto inserido com sucesso
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

oci_free_statement($resultrh);
oci_close($connBpmgp);

?>