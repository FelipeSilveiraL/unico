<?php
session_start();

require_once('../../../config/databases.php');
require_once('../../../config/config.php');

$excluiTabela = "DROP TABLE IF EXISTS bpm_seminovos";

$sucess = $conn->query($excluiTabela);

$criaTabela = "CREATE TABLE `bpm_seminovos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ID_FORNECEDOR` INT(3) NOT NULL,
  `CNPJ` VARCHAR(45) NULL,
  `RAZAO_SOCIAL` VARCHAR(80) NULL,
  `CIDADE` VARCHAR(45) NULL,
  `UF` VARCHAR(45) NULL,
  `SMARTSHARE` VARCHAR(45) NULL,
  `SMARTSHARE_LOGIN` VARCHAR(45) NULL,
  `EMAIL` VARCHAR(45) NULL,
  `NOME_RESPONSAVEL` VARCHAR(45) NULL,
  `ATIVO` VARCHAR(45) NULL,
  PRIMARY KEY (`id`) )";

$execTabela = $conn->query($criaTabela);


$url = "http://".$_SESSION['servidorOracle']."/".$_SESSION['smartshare']."/inc/seminovosAPI.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$resultado = json_decode(curl_exec($ch));

foreach ($resultado->aprov as $seminovos) {


    $querySeminovos = "INSERT INTO bpm_seminovos 
                            (ID_FORNECEDOR,CNPJ,RAZAO_SOCIAL,CIDADE,UF,SMARTSHARE,
                            SMARTSHARE_LOGIN,EMAIL,NOME_RESPONSAVEL,ATIVO) VALUES (
   
            '" . $seminovos->ID_FORNECEDOR ."',
            '" . $seminovos->CNPJ ."',
            '" . $seminovos->RAZAO_SOCIAL ."',
            '" . $seminovos->CIDADE ."',
            '" . $seminovos->UF ."',
            '" . $seminovos->SMARTSHARE . "' ,
            '" . $seminovos->SMARTSHARE_LOGIN . "' ,
            '" . $seminovos->EMAIL . "' ,
            '" . $seminovos->NOME_RESPONSAVEL . "' ,
            '" . $seminovos->ATIVO . "' 
            )";

        
    
    if (!$execQuery = $conn->query($querySeminovos)) {
        echo "Error: " . $querySeminovos . "<br>" . $conn->error;
    }
}                    

curl_close($ch);



?>
