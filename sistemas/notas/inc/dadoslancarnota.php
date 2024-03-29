<?php

require_once('../function/periodicidade.php');
require_once('../function/caracteres.php');

$queryNotas = "SELECT 
                CL.*
            FROM
                cad_lancarnotas CL
            WHERE ID_LANCARNOTAS = " . $_GET['id'];

if (!$aplicaquery = $connNOTAS->query($queryNotas)) {
    echo ("Error description[1]: " . $connNOTAS->error);
}


if ($notasLancar = $aplicaquery->fetch_assoc()) {

    $filial = $notasLancar['ID_FILIAL'];

    //Buscar lá no bpm
    $resultFilialBpm = oci_parse($connBpmgp, $queryFilial." AND ID_EMPRESA = ".$notasLancar['ID_FILIAL']);
    oci_execute($resultFilialBpm);

    while($filialBpm = oci_fetch_array($resultFilialBpm, OCI_ASSOC)){
        $nomeFilial = $filialBpm['NOME_EMPRESA'];
    }
    oci_free_statement($resultFilialBpm);
    
    $fornecedorNome = $notasLancar['nome_fornecedor'];
    $cpfcnpjFornecedor = $notasLancar['CNPJ'];
    $tipopagamento = $notasLancar['ID_TIPOPAGAMENTO'];
    $tipodespesa = $notasLancar['ID_PERIODICIDADE'];
    $tipodespesaNome = periodicidade($notasLancar['ID_PERIODICIDADE']);
    $auditoria = $notasLancar['auditoria'];
    $obra = $notasLancar['obra'];
    $marketing = $notasLancar['marketing'];
    $observacao = $notasLancar['observacao'];
    $vencimento = formatarData($notasLancar['vencimento']);
    $telefone = $notasLancar['telefone'];
    $carimbar = $notasLancar['carimbar'];
    $numeroNota = $notasLancar['numero_nota'];
    $serie = $notasLancar['serie_nota'];
    $emissao = formatarData($notasLancar['emissao']);
    $valor = $notasLancar['valor_nota'];

    if ($tipopagamento == '2') { //deposito bancario
        $buscaBancos = "SELECT  
                            CB.nome_banco, 
                            CB.agencia, 
                            CB.conta, 
                            CB.digito
                        FROM
                            cad_rateiobanco CB
                        WHERE ID_RATEIOFORNECEDOR = (SELECT ID_RATEIOFORNECEDOR FROM cad_rateiofornecedor WHERE cpfcnpj_fornecedor = '" . $cpfcnpjFornecedor . "' AND id_usuario = " . $_SESSION['id_usuario'] . " AND id_filial = ".$notasLancar['ID_FILIAL'].")";

        if (!$aplicarBancos = $connNOTAS->query($buscaBancos)) {
            echo ("Error description[2]: " . $connNOTAS->error);
        }

        $bancos = $aplicarBancos->fetch_assoc();

        $nomeBanco = $bancos['nome_banco'];
        $agencia = $bancos['agencia'];
        $conta = $bancos['conta'];
        $digito = $bancos['digito'];
    }
} else {

    header('Location: ../front/index.php?pg=1&msn=10&erro=10'); //permissao negada

}
