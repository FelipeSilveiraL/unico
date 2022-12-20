<?php
session_start();

require_once('../../../config/config.php');
require_once('../config/query.php');

$url = "http://".$_SESSION['servidorOracle']."/".$_SESSION['smartshare']."/inc/fornecedorApi.php?cpfCNPJ=".$_POST['id'];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$resultado = json_decode(curl_exec($ch));

foreach ($resultado->nome_fornecedor as $nomefornecedor) {

    echo $nomefornecedor->NOME_EMPRESA;
}                    

curl_close($ch);



?>
