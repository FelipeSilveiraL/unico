<?php

require_once('../../../config/databases.php');
require_once('../../../config/sqlSmart.php');

$caracteres = array(".", "-", "/");
$cnpj = str_replace($caracteres, "", $_POST['cnpjValue']);

function sanitizeString($str) {
    $str = preg_replace('/[áàãâä]/ui', 'a', $str);
    $str = preg_replace('/[éèêë]/ui', 'e', $str);
    $str = preg_replace('/[íìîï]/ui', 'i', $str);
    $str = preg_replace('/[óòõôö]/ui', 'o', $str);
    $str = preg_replace('/[úùûü]/ui', 'u', $str);
    $str = preg_replace('/[ç]/ui', 'c', $str);
    return $str;
}

$espace = trim($_POST['empresa']);

$car = sanitizeString($espace);

$upName = strtoupper($car);

    $empApollo = (!empty($_POST['empApollo'])) ? $_POST['empApollo'] : 0;
    $revApollo = (!empty($_POST['revApollo'])) ? $_POST['revApollo'] : 0;
    $empNbs = (!empty($_POST['empnbs'])) ? $_POST['empnbs'] : 0;
    $situacao = ($_POST['situacao'] == "A") ? "A" : $_POST['situacao'];

    $inserirNovaRegraEmp = "INSERT INTO empresa (nome_empresa,sistema,empresa_apollo,revenda_apollo,empresa_nbs,organograma_senior,
        empresa_senior,filial_senior,consorcio,situacao,numero_caixa,aprovador_caixa,uf_gestao,apelido_nbs,cnpj,bandeira,limite_nota_diversa,integrar_triagem) 
        VALUES (
        '".$upName."',
        '".$_POST['sistema']."',
        ".$empApollo.",
        ".$revApollo.",
        ".$empNbs.",
        ".$_POST['orgsenior'].", 
        ".$_POST['empresasenior'].",
        ".$_POST['filialsenior'].",
        '".$_POST['consorcio']."',
        '".$situacao."',
        ".$_POST['numero_caixa'].",
        '".$_POST['aproCaixa']."',
        '".$_POST['estado']."',
        '".$_POST['apnbs']."',
        ".$cnpj.",
        '".$_POST['bandeira']."',
        ".$_POST['limite_nota_diversa'].",
        '".$_POST['triagem']."'
        )";

$resultInsert = oci_parse($connBpmgp, $inserirNovaRegraEmp);

if(oci_execute($resultInsert, OCI_COMMIT_ON_SUCCESS)){
oci_free_statement($connBpmgp);
sleep(1);
oci_close($connBpmgp);
header('location: ../front/empresas.php?pg='.$_GET['pg'].'&msn=8');//msn=2 editado com sucesso
die();
}else{
    header('location: ../front/empresas.php?pg='.$_GET['pg'].'&msn=13');//msn=13 erro ao adicionar
}
  

?>