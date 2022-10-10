<?php
session_start();

require_once('../../../config/databases.php');
require_once('../../../config/config.php');

$excluiTabela = "DROP TABLE IF EXISTS bpm_rh_aprovadores";

$sucess = $conn->query($excluiTabela);

$criaTabela = "CREATE TABLE `bpm_rh_aprovadores` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ID_APROVADOR` VARCHAR(45) NULL,
  `APROVADOR_FILIAL` VARCHAR(45) NULL,
  `APROVADOR_AREA` VARCHAR(45) NULL,
  `APROVADOR_MARCA` VARCHAR(45) NULL,
  `APROVADOR_SUPERINTENDENTE` VARCHAR(45) NULL,
  `ID_EMPRESA` VARCHAR(45) NULL,
  `ID_DEPARTAMENTO` VARCHAR(45) NULL,
  `APROVADOR_GERENTE` VARCHAR(45) NULL,
  `SITUACAO` VARCHAR(45) NULL,
  `TIPO_REGISTRO` VARCHAR(45) NULL,
  `APROVADOR_GESTOR` VARCHAR(45) NULL,
  PRIMARY KEY (`id`) )";

$execTabela = $conn->query($criaTabela);


$url = "http://".$_SESSION['servidorOracle']."/".$_SESSION['smartshare']."/inc/aprovadoresApi.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$resultado = json_decode(curl_exec($ch));

foreach ($resultado->aprov as $aprovador) {


    $queryApr = "INSERT INTO bpm_rh_aprovadores  
                            (ID_APROVADOR,APROVADOR_FILIAL,APROVADOR_AREA,APROVADOR_MARCA,APROVADOR_SUPERINTENDENTE,
                            ID_EMPRESA,ID_DEPARTAMENTO,APROVADOR_GERENTE,SITUACAO,TIPO_REGISTRO,APROVADOR_GESTOR)
   
    VALUES ('" . $aprovador->ID_APROVADOR ."',
            '" . $aprovador->APROVADOR_FILIAL . "',
            '" . $aprovador->APROVADOR_AREA ."',
            '" . $aprovador->APROVADOR_MARCA ."',
            '" . $aprovador->APROVADOR_SUPERINTENDENTE ."',
            '" . $aprovador->ID_EMPRESA ."',
            '" . $aprovador->ID_DEPARTAMENTO ."',
            '" . $aprovador->APROVADOR_GERENTE . "' ,
            '" . $aprovador->SITUACAO . "' ,
            '" . $aprovador->TIPO_REGISTRO . "' ,
            '" . $aprovador->APROVADOR_GESTOR . "' 
            )";

        
    
    if (!$execQuery = $conn->query($queryApr)) {
        echo "Error: " . $queryApr . "<br>" . $conn->error;
    }
}                    
//API DEPARTAMENTO RH -------------------------------------------
curl_close($ch);

$excluiTabela2 = "DROP TABLE IF EXISTS bpm_rh_departamento";

$sucess = $conn->query($excluiTabela2);

$criaTabela2 = "CREATE TABLE `bpm_rh_departamento` (
  `ID_DEPARTAMENTO` INT NOT NULL,
  `NOME_DEPARTAMENTO` VARCHAR(45) NULL,
  `SITUACAO` VARCHAR(45) NULL,
  PRIMARY KEY (`ID_DEPARTAMENTO`) )";

$execTabela = $conn->query($criaTabela2);


$url = "http://".$_SESSION['servidorOracle']."/smartshare/inc/departamentoRH.php";
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
