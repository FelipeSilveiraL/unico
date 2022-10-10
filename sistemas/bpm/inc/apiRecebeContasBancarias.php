<?php
session_start();

require_once('../../../config/databases.php');
require_once('../../../config/config.php');

$excluiTabela = "DROP TABLE IF EXISTS bpm_contas_bancarias";

$sucess = $conn->query($excluiTabela);

$criaTabela = "CREATE TABLE `bpm_contas_bancarias` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `CNPJ_CPF` VARCHAR(19) NOT NULL,
  `BANCO` VARCHAR(45) NULL,
  `NOME_EMPRESA` VARCHAR(80) NULL,
  `AGENCIA` VARCHAR(45) NULL,
  `CONTA` VARCHAR(45) NULL,
  `DIGITO` VARCHAR(45) NULL,
  `ID_CONTA` VARCHAR(45) NULL,
  PRIMARY KEY (`id`) )";

$execTabela = $conn->query($criaTabela);


$url = "http://".$_SESSION['servidorOracle']."/".$_SESSION['smartshare']."/inc/contasBancariasAPI.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$resultado = json_decode(curl_exec($ch));

foreach ($resultado->contas as $CB) {


    $queryCB = "INSERT INTO bpm_contas_bancarias 
                            (CNPJ_CPF,BANCO,NOME_EMPRESA,AGENCIA,CONTA,DIGITO,ID_CONTA) VALUES (
   
            '" . $CB->CNPJ_CPF ."',
            '" . $CB->BANCO ."',
            '" . $CB->NOME_EMPRESA ."',
            '" . $CB->AGENCIA ."',
            '" . $CB->CONTA ."',
            '" . $CB->DIGITO ."',
            '" . $CB->ID_CONTA . "' 
            )";

        
    
    if (!$execQuery = $conn->query($queryCB)) {
        echo "Error: " . $queryCB . "<br>" . $conn->error;
    }
}                    

curl_close($ch);



?>
