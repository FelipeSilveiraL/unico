<?php
require_once('../config/query.php');

//vamos criar novos rateios que estão no $_POST['idUsuario'] para o $_GET['idUsuario']

//cad_rateiofornecedor buscando o pai
$buscarRateio = "SELECT * FROM cad_rateiofornecedor where id_usuario = " . $_POST['idUsuarioadicionar'];
$aplicarBusca = $connNOTAS->query($buscarRateio);

//inserindo novo rateio filho
while ($rateioBusca = $aplicarBusca->fetch_assoc()) {

    //cad_rateiofornecedor
    $inserindoNovoRateio = "INSERT INTO cad_rateiofornecedor
    (`id_usuario`,
    `filial`,
    `fornecedor`,
    `cpfcnpj_fornecedor`,
    `tipopagamento`,
    `tipodespesa`,
    `auditoria`,
    `obra`,
    `marketing`,
    `observacao`,
    `vencimento_tipo`,
    `vencimento`,
    `telefone`,
    `tipo_serv`)
    VALUES
    (" . $_GET['idUsuario'] . ",
    '" . $rateioBusca['filial'] . "',
    '" . $rateioBusca['fornecedor'] . "',
    '" . $rateioBusca['cpfcnpj_fornecedor'] . "',
    '" . $rateioBusca['tipopagamento'] . "',
    '" . $rateioBusca['tipodespesa'] . "',
    '" . $rateioBusca['auditoria'] . "',
    '" . $rateioBusca['obra'] . "',
    '" . $rateioBusca['marketing'] . "',
    '" . $rateioBusca['observacao'] . "',
    '" . $rateioBusca['vencimento_tipo'] . "',
    '" . $rateioBusca['vencimento'] . "',
    '" . $rateioBusca['telefone'] . "',
    '" . $rateioBusca['tipo_serv'] . "'
    )";
    $aplicarNovoRateio = $connNOTAS->query($inserindoNovoRateio);

    //cad_rateiocentrocusto - pegando o que acabou de salvar acima
    $queryPegaForncedor = "SELECT MAX(id) as id_fornecedor FROM cad_rateiofornecedor";
    $aplicaPega = $connNOTAS->query($queryPegaForncedor);
    $pega = $aplicaPega->fetch_assoc();

    //cad_rateiocentrocusto - pegando o pai
    $queryForncedor = "SELECT * FROM cad_rateiocentrocusto WHERE ID_RATEIOFORNECEDOR = " . $rateioBusca['id'];
    $aplicaqueryForncedor = $connNOTAS->query($queryForncedor);

    while ($fornecedorCentro = $aplicaqueryForncedor->fetch_assoc()) {
        //cad_rateiocentrocusto - inserindo novo filho
        $inserindoNovoCentroCusto = "INSERT INTO cad_rateiocentrocusto
        (`ID_RATEIOFORNECEDOR`,
        `ID_CENTROCUSTO`,
        `PERCENTUAL`)
        VALUES
        (" . $pega['id_fornecedor'] . ",
        '" . $fornecedorCentro['ID_CENTROCUSTO'] . "',
        '" . $fornecedorCentro['PERCENTUAL'] . "')";
        $aplicaInserindoNovoCentro = $connNOTAS->query($inserindoNovoCentroCusto);
    }

    //cad_rateiobanco - pegando o pai
    $queryPegaBanco = "SELECT * FROM cad_rateiobanco WHERE id_rateiofornecedor = " . $rateioBusca['id'];
    $aplicaqueryPegaBanco = $connNOTAS->query($queryPegaBanco);
    $bancoPai = $aplicaqueryPegaBanco->fetch_assoc();

    if ($bancoPai['id_rateiobanco'] != NULL) {
        //cad_rateiobanco - inserindo novo filho
        $inserindoNovobanco = "INSERT INTO cad_rateiobanco
        (`ID_RATEIOFORNECEDOR`,
        `nome_banco`,
        `agencia`,
        `conta`,
        `digito`)
        VALUES
        (" . $pega['id_fornecedor'] . ",
        '" . $bancoPai['nome_banco'] . "',
        '" . $bancoPai['agencia'] . "',
        '" . $bancoPai['conta'] . "',
        '" . $bancoPai['digito'] . "')";
        $aplicaNovobanco = $connNOTAS->query($inserindoNovobanco);
    }
}

header('Location: ../front/espelhar_usuarios.php?pg=4&tela=2&msn=4');
