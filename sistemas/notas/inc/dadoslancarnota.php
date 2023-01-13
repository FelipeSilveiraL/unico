<?php

$queryNotas = "SELECT * FROM cad_lancarnotas WHERE ID_USUARIO = '" . $_SESSION['nome_usuario'] . "' AND ID_LANCARNOTAS = " . $_GET['id'];
$aplicaquery = $connNOTAS->query($queryNotas);

if ($notasLancar = $aplicaquery->fetch_assoc()) {

    $filial = $notasLancar['ID_FILIAL'];
    $fornecedorNome = $notasLancar['nome_fornecedor'];
    $cpfcnpjFornecedor = $notasLancar['CNPJ'];
    $tipopagamento = $notasLancar['ID_TIPOPAGAMENTO'];
    $tipodespesa = $notasLancar['ID_PERIODICIDADE'];
    $auditoria = $notasLancar['auditoria'];
    $obra = $notasLancar['obra'];
    $marketing = $notasLancar['marketing'];
    $observacao = $notasLancar['observacao'];
    $vencimento = $notasLancar['vencimento'];
    $telefone = $notasLancar['telefone'];
    $carimbar = $notasLancar['carimbar'];
    $numeroNota = $notasLancar['numero_nota'];
    $serie = $notasLancar['serie_nota'];
    $emissao = $notasLancar['emissao'];
    $valor = $notasLancar['valor_nota'];


    if ($tipopagamento == '2') {//deposito bancario
        $buscaBancos = "SELECT  
                            CB.nome_banco, 
                            CB.agencia, 
                            CB.conta, 
                            CB.digito
                        FROM
                            cad_rateiobanco CB
                        WHERE ID_RATEIOFORNECEDOR = (SELECT ID_RATEIOFORNECEDOR FROM cad_rateiofornecedor WHERE cpfcnpj_fornecedor = '".$cpfcnpjFornecedor."' AND id_usuario = ".$_SESSION['id_usuario'].");";
        $aplicarBancos = $connNOTAS->query($buscaBancos);
        $bancos = $aplicarBancos->fetch_assoc();

        $nomeBanco = $bancos['nome_banco'];
        $agencia = $bancos['agencia'];
        $conta = $bancos['conta'];
        $digito = $bancos['digito'];
    }
} else {

    header('Location: ../front/index.php?pg=1&msn=10&erro=10'); //permissao negada

}
