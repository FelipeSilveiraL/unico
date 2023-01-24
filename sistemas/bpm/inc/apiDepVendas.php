<?php
session_start();

require_once('../../../config/databases.php');
require_once('../../../config/config.php');

$excluiTabela = "DROP TABLE IF EXISTS bpm_departamento_vendas";

$sucess = $conn->query($excluiTabela);

$criaTabela = "CREATE TABLE `bpm_departamento_vendas` (
  `id` INT(10) NOT NULL AUTO_INCREMENT,	
  `ID_DEPARTAMENTO` VARCHAR(10) NOT NULL,
  `NOME_DEPARTAMENTO` VARCHAR(45) NULL,
  PRIMARY KEY (`ID`) )";

$execTabela = $conn->query($criaTabela);


$url = "http://".$_SESSION['servidorOracle']."/".$_SESSION['smartshare']."/inc/depVendasApi.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$resultado = json_decode(curl_exec($ch));

foreach ($resultado->dep as $empdep) {


    $queryEmpDep = "INSERT INTO bpm_departamento_vendas 
                            (ID_DEPARTAMENTO,NOME_DEPARTAMENTO) VALUES (
   
            '" . $empdep->ID ."',
            '" . $empdep->NOME_DEPARTAMENTO ."'
            )";

        
    
    if (!$execQuery = $conn->query($queryEmpDep)) {
        echo "<br><br><br><br><br><br><br><br>Error: " . $queryEmpDep . "<br>" . $conn->error;
    }
}                    

curl_close($ch);



?>
