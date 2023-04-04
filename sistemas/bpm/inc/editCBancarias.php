<?php
require_once('../config/query.php');

//VALIDANDO CNPJ E CPF
$numeroDocumento = $_POST['documento'] == '1' ? $_POST['cpfValue'] : $_POST['cnpjValue'];
$tipoDoc = $_POST['documento'] == '1' ?  'CPF' : 'CNPJ';
$digito = $_POST['digito'];


$caracteres = array(".", "-", "/");
$cnpjCPF = str_replace($caracteres, "", $numeroDocumento);


//PEGANDO INFORMAÇÕES ANTIGAS
$queryContas = "SELECT CNPJ_CPF FROM contas_bancarias_fornecedor WHERE ID_CONTA = ".$_GET['id_conta'];
$resultado = oci_parse($connBpmgp, $queryContas);
oci_execute($resultado);

if(($contas= oci_fetch_array($resultado, OCI_BOTH)) != FALSE) {

    if($contas['CNPJ_CPF'] != $cnpjCPF){

        $queryCNPJCPF = "SELECT CNPJ_CPF FROM contas_bancarias_fornecedor WHERE CNPJ_CPF = '".$cnpjCPF."'";

        $resultadoCNPJCPF = oci_parse($connBpmgp, $queryCNPJCPF);        
        oci_execute($resultadoCNPJCPF);

        if(($rowUser= oci_fetch_array($resultadoCNPJCPF, OCI_BOTH)) != FALSE) {
            
            header('Location: ../front/contasBancarias.php?pg='.$_GET['pg'].'msn=19');;//CPF / CNPJ JA EXISTE
            exit;
        }
    }
}

$update = "UPDATE contas_bancarias_fornecedor SET
                NOME_EMPRESA = '".$_POST['nomeEmpresa']."',
                CNPJ_CPF = '".$cnpjCPF."', 
                BANCO = '".$_POST['banco']."' , 
                AGENCIA = '".$_POST['agencia']."',
                CONTA = '".$_POST['conta']."', 
                DIGITO = '".$digito."',
                TIPO_CPF_CNPJ = '".$tipoDoc."'
            WHERE ID_CONTA = '".$_GET['id_conta']."'";

$result = oci_parse($connBpmgp, $update);

if(oci_execute($result)){
    header('Location: ../front/contasBancarias.php?pg='.$_GET['pg'].'&msn=4');
}else{
    $e = oci_error($result);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
}

oci_free_statement($result);
oci_close($connBpmgp);

?>