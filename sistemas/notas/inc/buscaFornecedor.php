<?php
session_start();

require_once('../../../config/config.php');
require_once('../config/query.php');

$url = "http://" . $_SESSION['servidorOracle'] . "/" . $_SESSION['smartshare'] . "/inc/fornecedorApi.php?cpfCNPJ=" . $_POST['id'];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$resultado = json_decode(curl_exec($ch));

foreach ($resultado->nome_fornecedor as $nomefornecedor) {

    echo $nomefornecedor->NOME_EMPRESA . "-"; //0
}


if ($_POST['tipo'] == 1) {
    $queryFornecedor = "SELECT * FROM cad_rateiofornecedor WHERE filial = '" . $_POST['idFilial'] . "' AND cpfcnpj_fornecedor = '" . $_POST['id'] . "' AND id_usuario = '" . $_SESSION['id_usuario'] . "'";
    $aplicaquery = $connNOTAS->query($queryFornecedor);
    $fornecedorLancar = $aplicaquery->fetch_assoc();

    if ($fornecedorLancar['id'] != null) {
        //dados
        if ($fornecedorLancar['tipopagamento'] == 1) {
            echo '<option>Boleto</option>-';
        } else {
            echo '<option>Deposito</option>-';
        } //1
        echo $fornecedorLancar['tipo_serv'] . '-'; //2
        echo '<option value="' . $fornecedorLancar['tipodespesa'] . '">' . $fornecedorLancar['tipodespesa'] . '</option>-'; //3
        echo $fornecedorLancar['telefone'] . '-'; //4
        echo '<option value="' . $fornecedorLancar['auditoria'] . '">' . $fornecedorLancar['auditoria'] . '</option>-'; //5
        echo '<option value="' . $fornecedorLancar['obra'] . '">' . $fornecedorLancar['obra'] . '</option>-'; //6
        echo '<option value="' . $fornecedorLancar['marketing'] . '">' . $fornecedorLancar['marketing'] . '</option>-'; //7
        echo $fornecedorLancar['observacao'] . '-'; //8

        //banco
        if ($fornecedorLancar['tipopagamento'] == 2) {
            $querybancos = "SELECT * FROM cad_rateiobanco WHERE id_rateiofornecedor = " . $fornecedorLancar['id'];
            $aplicaQueryBanco = $connNOTAS->query($querybancos);
            $banco = $aplicaQueryBanco->fetch_assoc();

            echo '<option value="' . $banco['nome_banco'] . '">' . $banco['nome_banco'] . '</option>-'; //9
            echo $banco['agencia'] . '-'; //10
            echo $banco['conta'] . '-'; //11
            echo $banco['digito'] . '-'; //12

        }
    }
}

curl_close($ch);