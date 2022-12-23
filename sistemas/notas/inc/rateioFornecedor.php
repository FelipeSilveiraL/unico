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

function pontuacao($stingPontuacao)
{
    $stingPontuacao = str_replace(',', '.', $stingPontuacao);

    return $stingPontuacao;
}


if (!empty($_POST['dias'])) {
    $dias = $_POST['dias'];
} elseif (!empty($_POST['diasCorridos'])) {
    $dias =  $_POST['diasCorridos'];
} else {
    $dias = 0;
}

//trabalhando com o fornecedor
if (empty($_GET['idRateioFornecedor'])) { //cadastrando o fornecedor    

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
        header('Location: ../front/rateioFornecedor.php?idRateioFornecedor=' . $idForncedor['id_fornecedor'] . '#rateioFornecedor');
    } else {
        echo $insertFornecedor . "<br />";
        echo ("Error description [1]: " . $connNOTAS->error);
    }
} else { //cadastro centro de custo ou editando o fornecedor

    //editar formulario
    $updateFornecedor = "UPDATE cad_rateiofornecedor
    SET
    `filial` = '" . $_POST['filial'] . "',
    `fornecedor` = '" . $_POST['NomeFornecedor'] . "',
    `cpfcnpj_fornecedor` = '" . $_POST['cpfCnpjFor'] . "',
    `tipopagamento` = '" . $_POST['tipoPagamento'] . "',
    `tipodespesa` = '" . $_POST['tipodespesa'] . "',
    `auditoria` = '" . $_POST['departamentoAuditoria'] . "',
    `obra` = '" . $_POST['notasGrupo'] . "',
    `marketing` = '" . $_POST['notasMarketing'] . "',
    `observacao` = '" . seo_friendly_url($_POST['observacao']) . "',
    `vencimento_tipo` = '" . $_POST['vencimento'] . "',
    `vencimento` = '" . $dias . "',
    `telefone` = '" . $_POST['telefone'] . "',
    `tipo_serv` = '" . seo_friendly_url($_POST['tipoServico']) . "'
    WHERE `id` = " . $_GET['idRateioFornecedor'];

    $resultadoUpdate = $connNOTAS->query($updateFornecedor);

    if ($_POST['centroCusto'] != null) {
        //antes de salvar verificar se não passou dos 100%
        $queryPorcentual = "SELECT SUM(PERCENTUAL) AS porcentual FROM cad_rateiocentrocusto WHERE id_rateiofornecedor = " . $_GET['idRateioFornecedor'] . " GROUP BY id_rateiofornecedor";
        $aplicarPorcentual = $connNOTAS->query($queryPorcentual);
        $porcentual = $aplicarPorcentual->fetch_assoc();

        $porcentoFormulario = pontuacao($_POST['porcentual']);
        $somatorio = $porcentoFormulario + $porcentual['porcentual'];

        if ($somatorio > 100) {
            header('Location: ../front/rateioFornecedor.php?idRateioFornecedor=' . $_GET['idRateioFornecedor'] . '&msn=10&erro=8');
        } else {
            $queryDuplicado = "SELECT id_centrocusto FROM cad_rateiocentrocusto WHERE id_centrocusto = '" . $_POST['centroCusto'] . "' AND id_rateiofornecedor = " . $_GET['idRateioFornecedor'];
            $aplicarDuplicado = $connNOTAS->query($queryDuplicado);
            $duplicado = $aplicarDuplicado->fetch_assoc();

            if ($duplicado['id_centrocusto'] == NULL) {
                //inserindo novo centro custo
                $insertCentroCusto = "INSERT INTO cad_rateiocentrocusto
                                (`ID_RATEIOFORNECEDOR`,
                                `ID_CENTROCUSTO`,
                                `PERCENTUAL`)
                                VALUES
                                (" . $_GET['idRateioFornecedor'] . ",
                                '" . $_POST['centroCusto'] . "',
                                '" . pontuacao($_POST['porcentual']) . "')";

                $resultCentroCusto = $connNOTAS->query($insertCentroCusto);

                header('Location: ../front/rateioFornecedor.php?idRateioFornecedor=' . $_GET['idRateioFornecedor'] . '#rateioFornecedor');
            } else {
                header('Location: ../front/rateioFornecedor.php?idRateioFornecedor=' . $_GET['idRateioFornecedor'] . '&msn=10&erro=9');
            }
        }
    }else{
        header('Location: ../front/fornecedor.php');
    }
}


$connNOTAS->close();
