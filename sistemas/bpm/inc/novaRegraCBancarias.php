<?php
require_once('../config/query.php');

//VALIDANDO CNPJ E CPF
$numeroDocumento = $_POST['documento'] == '1' ? $_POST['cpfValue'] : $_POST['cnpjValue'];
$tipoDoc = $_POST['documento'] == '1' ?  'CPF' : 'CNPJ';
$agencia = $_POST['agencia'] == null ? 0 : $_POST['agencia'];
$digito = $_POST['digito'] == null ? 0 : $_POST['digito'];
$conta = $_POST['conta'] == null ? 0 : $_POST['conta'];

$caracteres = array(".", "-", "/");
$cnpjCPF = str_replace($caracteres, "", $numeroDocumento);

//INSERÇÃO NO BANDO DE DADOS

$insert = "INSERT INTO contas_bancarias_fornecedor (NOME_EMPRESA, CNPJ_CPF, BANCO, AGENCIA, CONTA, DIGITO, TIPO_CPF_CNPJ)
VALUES ('".$_POST['nomeEmpresa']."', '".$cnpjCPF."', '".$_POST['banco']."', '".$agencia."', '".$conta."', '".$digito."','".$tipoDoc."')";

$result = oci_parse($connBpmgp, $insert);

if(oci_execute($result)){
    oci_free_statement($result);
    oci_close($connBpmgp);

    header('location: ../front/contasBancarias.php?pg='.$_GET['pg'].'&msn=8');
}else{
    $e = oci_error($result);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
    oci_free_statement($result);

oci_close($connBpmgp);
}

oci_free_statement($result);
oci_close($connBpmgp);
?>