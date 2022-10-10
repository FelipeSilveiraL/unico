<?php
session_start();

require_once('../../../config/databases.php');
require_once('../../../config/config.php');

$excluiTabela = "DROP TABLE IF EXISTS bpm_rh_emp_dep";

$sucess = $conn->query($excluiTabela);

$criaTabela = "CREATE TABLE `bpm_rh_emp_dep` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ID_EMPDEP` VARCHAR(45) NULL,
  `NOME_EMPRESA` VARCHAR(45) NULL,
  `ID_DEPARTAMENTO` VARCHAR(45) NULL,
  `SITUACAO` VARCHAR(45) NULL,
  `GERENTE_APROVA` VARCHAR(45) NULL,
  `SUPERINTENDENTE_APROVA` VARCHAR(45) NULL,
  `NOME_DEPARTAMENTO` VARCHAR(45) NULL,
  PRIMARY KEY (`id`) )";

$execTabela = $conn->query($criaTabela);


$url = "http://".$_SESSION['servidorOracle']."/".$_SESSION['smartshare']."/inc/empDepApi.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$resultado = json_decode(curl_exec($ch));

foreach ($resultado->empresaDep as $empdep) {


    $queryEmpDep = "INSERT INTO bpm_rh_emp_dep 
                            (ID_EMPDEP,NOME_EMPRESA,ID_DEPARTAMENTO,SITUACAO,GERENTE_APROVA,
                            SUPERINTENDENTE_APROVA,NOME_DEPARTAMENTO) VALUES (
   
            '" . $empdep->ID_EMPDEP ."',
            '" . $empdep->NOME_EMPRESA ."',
            '" . $empdep->ID_DEPARTAMENTO ."',
            '" . $empdep->SITUACAO ."',
            '" . $empdep->GERENTE_APROVA ."',
            '" . $empdep->SUPERINTENDENTE_APROVA . "' ,
            '" . $empdep->NOME_DEPARTAMENTO . "' 
            )";

        
    
    if (!$execQuery = $conn->query($queryEmpDep)) {
        echo "Error: " . $queryEmpDep . "<br>" . $conn->error;
    }
}                    

curl_close($ch);



?>
