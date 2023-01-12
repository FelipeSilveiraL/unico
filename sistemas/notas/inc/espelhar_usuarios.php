<?php
require_once('../../../config/databases.php'); //banco de dados

//vamos criar novos rateios que estão no $_POST['idUsuario'] para o $_GET['idUsuario']

//cad_rateiofornecedor buscando o pai
$buscarRateio = "SELECT * FROM cad_rateiofornecedor where ID_USUARIO = " . $_POST['idUsuarioadicionar'];
$aplicarBusca = $connNOTAS->query($buscarRateio);

//inserindo novo rateio filho
while ($rateioBusca = $aplicarBusca->fetch_assoc()) {

    //cad_rateiofornecedor
    $inserindoNovoRateio = "INSERT INTO cad_rateiofornecedor
    (ID_USUARIO,
    ID_FILIAL,
    ID_FORNECEDOR,
    ID_TIPOPAGAMENTO,
    ID_PERIODICIDADE,
    ID_TIPODESPESA,
    auditoria,
    obra,
    necessita_conferencia,
    relatorio_siscon,
    motivo_siscon,
    observacao,
    vencimento_tipo,
    vencimento,
    telefone,
    tipo_serv,    
    fornecedor,
    cpfcnpj_fornecedor,
    marketing,
    sistema,
    centro_custo_completo)
    VALUES
    (" . $_GET['idUsuario'] . ",
    '" . $rateioBusca['ID_FILIAL'] . "',
    "; $inserindoNovoRateio .= empty($rateioBusca['ID_FORNECEDOR']) ? 'NULL' : $rateioBusca['ID_FORNECEDOR']; $inserindoNovoRateio .= ",
    '" . $rateioBusca['ID_TIPOPAGAMENTO'] . "',
    '" . $rateioBusca['ID_PERIODICIDADE'] . "',
    '" . $rateioBusca['ID_TIPODESPESA'] . "',
    '" . $rateioBusca['auditoria'] . "',
    '" . $rateioBusca['obra'] . "',
    '" . $rateioBusca['necessita_conferencia'] . "',
    '" . $rateioBusca['relatorio_siscon'] . "',
    '" . $rateioBusca['motivo_siscon'] . "',
    '" . $rateioBusca['observacao'] . "',
    '" . $rateioBusca['vencimento_tipo'] . "',
    '" . $rateioBusca['vencimento'] . "',
    '" . $rateioBusca['telefone'] . "',
    '" . $rateioBusca['tipo_serv'] . "',
    '" . $rateioBusca['fornecedor'] . "',
    '" . $rateioBusca['cpfcnpj_fornecedor'] . "',
    '" . $rateioBusca['marketing'] . "',
    '" . $rateioBusca['sistema'] . "',
    '" . $rateioBusca['centro_custo_completo'] . "'
    )";
    $aplicarNovoRateio = $connNOTAS->query($inserindoNovoRateio);

    //cad_rateiocentrocusto - pegando o que acabou de salvar acima
    $queryPegaForncedor = "SELECT MAX(ID_RATEIOFORNECEDOR) as id_fornecedor FROM cad_rateiofornecedor";
    $aplicaPega = $connNOTAS->query($queryPegaForncedor);
    $pega = $aplicaPega->fetch_assoc();

    //cad_rateiocentrocusto - pegando o pai
    $queryForncedor = "SELECT * FROM cad_rateiocentrocusto WHERE ID_RATEIOFORNECEDOR = " . $rateioBusca['ID_RATEIOFORNECEDOR'];
    $aplicaqueryForncedor = $connNOTAS->query($queryForncedor);

    while ($fornecedorCentro = $aplicaqueryForncedor->fetch_assoc()) {
        //cad_rateiocentrocusto - inserindo novo filho
        $inserindoNovoCentroCusto = "INSERT INTO cad_rateiocentrocusto
        (ID_RATEIOFORNECEDOR,
        ID_CENTROCUSTO,
        ID_CENTROCUSTO_BPM,
        PERCENTUAL)
        VALUES
        (" . $pega['id_fornecedor'] . ",
        '" . $fornecedorCentro['ID_CENTROCUSTO'] . "',
        '" . $fornecedorCentro['ID_CENTROCUSTO_BPM'] . "',
        '" . $fornecedorCentro['PERCENTUAL'] . "')";
        $aplicaInserindoNovoCentro = $connNOTAS->query($inserindoNovoCentroCusto);
    }

    //cad_rateiobanco - pegando o pai
    $queryPegaBanco = "SELECT * FROM cad_rateiobanco WHERE id_rateiofornecedor = " . $rateioBusca['ID_RATEIOFORNECEDOR'];
    $aplicaqueryPegaBanco = $connNOTAS->query($queryPegaBanco);
    $bancoPai = $aplicaqueryPegaBanco->fetch_assoc();

    if ($bancoPai['ID_RATEIOBANCO'] != NULL) {
        echo 'AChei um' . $queryPegaBanco;
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
