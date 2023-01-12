<?php

$idRateio = $_GET['idRateioFornecedor'];

$buscaFornecedor = "SELECT 
UBE.nome_empresa,
CP.nome AS periodicidade,
CR.*
FROM
cad_rateiofornecedor CR
LEFT JOIN
unico.bpm_empresas UBE ON (CR.id_filial = UBE.id_empresa)
LEFT JOIN
cad_periodicidade CP ON (CR.ID_PERIODICIDADE = CP.ID_PERIODICIDADE)
WHERE ID_RATEIOFORNECEDOR =  " . $idRateio;

$aplicarBusca = $connNOTAS->query($buscaFornecedor);

if ($fornecedor = $aplicarBusca->fetch_assoc()) {

    $filial = $fornecedor['ID_FILIAL'];
    $sistema = $fornecedor['sistema'];
    $nomeFilial = $fornecedor['nome_empresa'];
    $fornecedorNome = $fornecedor['fornecedor'];
    $cpfcnpjFornecedor = $fornecedor['cpfcnpj_fornecedor'];
    $tipopagamento = $fornecedor['ID_TIPOPAGAMENTO'];
    $tipoPeriodicidade = $fornecedor['periodicidade'];
    $idPeriodicidade = $fornecedor['ID_PERIODICIDADE'];
    $auditoria = $fornecedor['auditoria'];
    $obra = $fornecedor['obra'];
    $marketing = $fornecedor['marketing'];
    $observacao = $fornecedor['observacao'];
    $vencimentoTipo = $fornecedor['vencimento_tipo'];
    $vencimento = $fornecedor['vencimento'];
    $telefone = $fornecedor['telefone'];
    $tipoServ = $fornecedor['tipo_serv'];

    if($tipopagamento == 2){
        $buscaBancos = "SELECT * FROM cad_rateiobanco WHERE ID_RATEIOFORNECEDOR = " . $idRateio;
        $aplicarBancos = $connNOTAS->query($buscaBancos);
        $bancos = $aplicarBancos->fetch_assoc();

        $nomeBanco = $bancos['nome_banco'];
        $agencia = $bancos['agencia'];
        $conta = $bancos['conta'];
        $digito = $bancos['digito'];
    }

} else {
    echo $buscaFornecedor . "<br />";
    echo ("Error description [1]: " . $connNOTAS->error);
    exit;
}
