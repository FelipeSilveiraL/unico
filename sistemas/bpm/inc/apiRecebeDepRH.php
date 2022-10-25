<?php
session_start();

require_once('../../../config/databases.php');
require_once('../../../config/config.php');

$excluiTabela2 = "DROP TABLE IF EXISTS bpm_rh_departamento";

$sucess = $conn->query($excluiTabela2);

$criaTabela2 = "CREATE TABLE `bpm_rh_departamento` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ID_DEPARTAMENTO` INT NOT NULL,
  `NOME_DEPARTAMENTO` VARCHAR(45) NULL,
  `SITUACAO` VARCHAR(45) NULL,
  PRIMARY KEY (`id`) )";

$execTabela = $conn->query($criaTabela2);


$url = "http://".$_SESSION['servidorOracle']."/".$_SESSION['smartshare']."/inc/departamentoRH.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$result = json_decode(curl_exec($ch));

foreach ($result->dep as $departamento) {


    $queryDep = "INSERT INTO bpm_rh_departamento 
                            (ID_DEPARTAMENTO,NOME_DEPARTAMENTO,SITUACAO)
   
    VALUES ('" . $departamento->ID_DEPARTAMENTO ."',
            '" . $departamento->NOME_DEPARTAMENTO . "',
            '" . $departamento->SITUACAO ."'
            )";

        
    
    if (!$execQuery = $conn->query($queryDep)) {
        echo "Error: " . $queryDep . "<br>" . $conn->error;
    }
}                    

curl_close($ch);


?>
