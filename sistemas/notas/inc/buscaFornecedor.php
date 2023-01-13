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


if ($_POST['tipo'] == 1) { //lancarnotas.php
    $queryFornecedor = "SELECT * FROM cad_rateiofornecedor WHERE ID_FILIAL = '" . $_POST['idFilial'] . "' AND cpfcnpj_fornecedor = '" . $_POST['id'] . "' AND ID_USUARIO = '" . $_SESSION['id_usuario'] . "'";
    $aplicaquery = $connNOTAS->query($queryFornecedor);
    $fornecedorLancar = $aplicaquery->fetch_assoc();

    if ($fornecedorLancar['ID_RATEIOFORNECEDOR'] != null) {

        //dados
        if ($fornecedorLancar['ID_TIPOPAGAMENTO'] == 1) {
            echo '<option>Boleto</option>-';
        } else {
            echo '<option>Deposito</option>-';
        } //1

        echo $fornecedorLancar['tipo_serv'] . '-'; //2
        echo '<option value="' . $fornecedorLancar['ID_PERIODICIDADE'] . '">';

        switch ($fornecedorLancar['ID_PERIODICIDADE']) {
            case '1':
                echo 'AVULSA';
                break;

            case '5':
                echo 'ANUAL';
                break;
            case '7':
                echo 'AVULSA FUNILARIA';
                break;

            case '3':
                echo 'BIMESTRAL';
                break;
            case '2':
                echo 'MENSAL';
                break;

            case '4':
                echo 'SEMESTRAL';
                break;
            case '6':
                echo 'TRIAGEM';
                break;
        }

        echo '</option>-'; //3

        echo $fornecedorLancar['telefone'] . '-'; //4

        echo '<option value="' . $fornecedorLancar['auditoria'] . '">';
        echo $fornecedorLancar['auditoria'] == 0 ? "NÃO" : "SIM";
        echo '</option>-'; //5

        echo '<option value="' . $fornecedorLancar['obra'] . '">';
        echo $fornecedorLancar['obra'] == 0 ? "NÃO" : "SIM";
        echo '</option>-'; //6

        echo '<option value="' . $fornecedorLancar['marketing'] . '">';
        echo $fornecedorLancar['marketing'] == 0 ? "NÃO" : "SIM";
        echo '</option>-'; //7

        echo $fornecedorLancar['observacao'] . '-'; //8

        echo '<option value="' . $fornecedorLancar['sistema'] . '">';
        echo $fornecedorLancar['sistema'] == 1 ? "FLUIG" : "SMARTSHARE";
        echo '</option>-'; //9

        //banco
        if ($fornecedorLancar['ID_TIPOPAGAMENTO'] == 2) {
            $querybancos = "SELECT * FROM cad_rateiobanco WHERE id_rateiofornecedor = " . $fornecedorLancar['ID_RATEIOFORNECEDOR'];
            $aplicaQueryBanco = $connNOTAS->query($querybancos);
            $banco = $aplicaQueryBanco->fetch_assoc();

            echo '<option value="' . $banco['nome_banco'] . '">' . $banco['nome_banco'] . '</option>-'; //10
            echo $banco['agencia'] . '-'; //11
            echo $banco['conta'] . '-'; //12
            echo $banco['digito'] . '-'; //13

        }
    }
}

curl_close($ch);
