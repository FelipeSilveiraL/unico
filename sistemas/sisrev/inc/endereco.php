<?php 
require_once('../config/query.php');

$url = "http://10.100.1.215/unico_api/sisrev/estoque.json";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$resultado = json_decode(curl_exec($ch));

var_dump($resultado);
foreach ($resultado->itensEndereco AS $etiqLaser) {
    
  
    $insertEstoque = "INSERT INTO sisrev_etiqueta_estoque(LOCACAO_ZONA,LOCACAO_RUA,LOCACAO_ESTANTE,LOCACAO_PRATELEIRA,ITEM_ESTOQUE,LOCACAO_NUMERO,EMPRESA,REVENDA)
    VALUES ('" . $etiqLaser->LOCACAO_ZONA ."',
            '" . $etiqLaser->LOCACAO_RUA . "',
            '" . $etiqLaser->LOCACAO_ESTANTE . "' ,
            '" . $etiqLaser->LOCACAO_PRATELEIRA ."',
            '" . $etiqLaser->ITEM_ESTOQUE ."',
            '" . $etiqLaser->LOCACAO_NUMERO ."',
            '" . $etiqLaser->EMPRESA ."',
            '" . $etiqLaser->REVENDA ."');";

    if ($execQuery = $conn->query($insertEstoque)) {
        echo "Error: " . $insertEstoque . "<br>" . $conn->error;
    }
}

?>