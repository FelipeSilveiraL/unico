<?php
require_once('../config/query.php');

/* TRABALHANDO QUAL TABELA */
$tipoRalatorio = $_POST['tipoRalatorio'];

//TIPO DE RALATÓRIO NÃO PODE VIR TODOS VAZIOS.
if (empty($tipoRalatorio)) {
    header('Location: ../front/processosFabricaRelatorios.php?pg=5&msn=10&erro=5');
    exit;
} else {
    foreach ($tipoRalatorio as $key => $value) {
        switch ($value) {
            case '1':
                $tabela = 'sisrev_carga_FA3';
                break;
            case '2':
                $tabela = 'sisrev_carga_FA4';
                break;
            case '3':
                $tabela = 'sisrev_carga_FLH';
                break;
            case '4':
                $tabela = 'sisrev_carga_FNT';
                break;
        }
    }
}

/* TRABALHANDO AS DATAS PARA A BUSCA */
$dataHoje = date('dmY');
//data movimentação
$inicial = DateTime::createFromFormat('Y-m-d', $_POST['dataMovimentacaoInicial']);
$final = DateTime::createFromFormat('Y-m-d', $_POST['dataMovimentacaoFinal']);
//data arquivo
$inicialArquivo = DateTime::createFromFormat('Y-m-d', $_POST['dataArquivo']);

//aplicando a regra do where
if (empty($_POST['dataMovimentacaoInicial'])) {

    if (empty($inicialArquivo)) {
        $dataInicial = "movimentacao = '" . $dataHoje . "'";
    } else {
        $dataInicial = "data_arquivo = '" . $inicialArquivo->format('dmY') . "'";
    }
} else {
    $dataInicial = "movimentacao = '" . $inicial->format('dmY') . "'";
}


/* MONTANDO A QUERY PARA BUSCAR OS DADOS */
