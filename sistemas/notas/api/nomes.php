<?php
session_start();

require_once('../config/query.php');
require_once('../../../config/config.php');

$idFilial = $_GET['filial'];
$cnpjFornecedor = $_GET['fornecedor'];

$url = "http://" . $_SESSION['servidorOracle'] . "/" . $_SESSION['smartshare'] . "/inc/nomes.php?idFilial=" . $idFilial . "&cnpjFornecedor=" . $cnpjFornecedor . "";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$resultado = json_decode(curl_exec($ch));

//var_dump($resultado);

//var_dump($resultado->centro_custo);

foreach ($resultado->centro_custo as $centroCusto) {
    $nomeFilial = $centroCusto->NOME_EMPRESA;
    $nomeFornecedor = $centroCusto->NOME_DEPARTAMENTO;
}

curl_close($ch);
