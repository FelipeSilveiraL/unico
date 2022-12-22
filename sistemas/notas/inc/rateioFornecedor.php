<?php
session_start();

require_once('../config/query.php');

//checando campos
!empty($_POST['NomeFornecedor']) ?: header('Location: ../front/rateioFornecedor.php?msn=10&erro=5');

//remoção caracter
function seo_friendly_url($string)
{
    $string = str_replace(array('[\', \']'), '', $string);
    $string = preg_replace('/\[.*\]/U', '', $string);
    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
    $string = htmlentities($string, ENT_COMPAT, 'utf-8');
    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string);
    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/'), '-', $string);
    $string = str_replace('-', ' ', $string);

    return strtoupper(trim($string, '-'));
}

//trabalhando com o fornecedor
if (empty($_GET['idRateioFornecedor'])) { //cadastrando o fornecedor

    if (!empty($_POST['dias'])) {
        $dias = $_POST['dias'];
    } elseif (!empty($_POST['diasCorridos'])) {
        $dias =  $_POST['diasCorridos'];
    } else {
        $dias = 0;
    }

    //crio o id rateio fornecedor
    $insertFornecedor = "INSERT INTO cad_rateiofornecedor
    (id_usuario,
    filial,
    fornecedor,
    cpfcnpj_fornecedor,
    tipopagamento,
    tipodespesa,
    auditoria,
    obra,
    marketing,
    observacao,
    vencimento_tipo,
    vencimento,
    telefone,
    tipo_serv) VALUES
    
    (" . $_SESSION['id_usuario'] . ",
    '" . $_POST['filial'] . "',
    '" . $_POST['NomeFornecedor'] . "',
    '" . $_POST['cpfCnpjFor'] . "',
    '" . $_POST['tipoPagamento'] . "',
    '" . $_POST['tipodespesa'] . "',
    '" . $_POST['departamentoAuditoria'] . "',
    '" . $_POST['notasGrupo'] . "',
    '" . $_POST['notasMarketing'] . "',
    '" . seo_friendly_url($_POST['observacao']) . "',
    '" . $_POST['vencimento'] . "',
    '" . $dias . "',
    '" . $_POST['telefone'] . "',
    '" . seo_friendly_url($_POST['tipoServico']) . "')";

    if ($aplicarInsert = $connNOTAS->query($insertFornecedor)) {

        //pegando o ID_FORNECEDOR QUE ACABAMOS DE CRIAR
        $queryIdFornecedor = "SELECT MAX(id) as id_fornecedor FROM cad_rateiofornecedor";
        $aplicarIdFornecedor = $connNOTAS->query($queryIdFornecedor);
        $idForncedor = $aplicarIdFornecedor->fetch_assoc();

        //salvando dados do banco caso haja.

        if ($_POST['tipoPagamento'] == '2') {

            $insertbanco = "INSERT INTO cad_rateiobanco
            (ID_RATEIOFORNECEDOR,
            nome_banco,
            agencia,
            conta,
            digito)
            VALUES
            (" . $idForncedor['id_fornecedor'] . ",
            '" . $_POST['banco'] . "',
            '" . $_POST['agencia'] . "',
            '" . $_POST['conta'] . "',
            '" . $_POST['digito'] . "')";

            if (!$aplicarBanco = $connNOTAS->query($insertbanco)) {
                echo $insertbanco . "<br />";
                echo ("Error description [2]: " . $connNOTAS->error);
                exit;
            }
        }
        //voltar para cadastrar o rateio
        header('Location: ../front/rateioFornecedor.php?idRateioFornecedor='.$idForncedor['id_fornecedor'].'#rateioFornecedor');

    } else {
        echo $insertFornecedor . "<br />";
        echo ("Error description [1]: " . $connNOTAS->error);
    }

} else { //cadastro centro de custo ou editando o fornecedor

    //id rateio fornecedor vinculo ao centro de custo
    /* SELECT * FROM dbnotas.cad_rateiocentrocusto; */
}


$connNOTAS->close();