<?php
session_start();

require_once('../../../config/databases.php');
require_once('../../../config/config.php');

$excluiTabela = "DROP TABLE IF EXISTS bpm_nf_emp_dep";

$sucess = $conn->query($excluiTabela);

$criaTabela = "CREATE TABLE `bpm_nf_emp_dep` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ID_EMPDEP` int(10) NULL,
  `ID_EMPRESA` int(10) NULL,
  `ID_DEPARTAMENTO` int(10) NULL,
  `SITUACAO` VARCHAR(1) NULL,
  `GERENTE_APROVA` VARCHAR(1) NULL,
  `SUPERINTENDENTE_APROVA` VARCHAR(1) NULL,
  `LANCA_MULTAS` VARCHAR(45) NULL,
  `GESTOR_AREA_APROVA_MULTAS` VARCHAR(45) NULL,
  `LANCA_NOTAS` VARCHAR(45) NULL,
  PRIMARY KEY (`id`) )";

$execTabela = $conn->query($criaTabela);


$url = "http://".$_SESSION['servidorOracle']."/".$_SESSION['smartshare']."/inc/empDepNFApi.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$resultado = json_decode(curl_exec($ch));

foreach ($resultado->empresaDep as $empdep) {


    $queryEmpDep = "INSERT INTO bpm_nf_emp_dep 
                            (ID_EMPDEP,ID_EMPRESA,ID_DEPARTAMENTO,SITUACAO,GERENTE_APROVA,
                            SUPERINTENDENTE_APROVA,LANCA_MULTAS,GESTOR_AREA_APROVA_MULTAS,LANCA_NOTAS) VALUES (
   
            '" . $empdep->ID_EMPDEP ."',
            '" . $empdep->ID_EMPRESA ."',
            '" . $empdep->ID_DEPARTAMENTO ."',
            '" . $empdep->SITUACAO ."',
            '" . $empdep->GERENTE_APROVA ."',
            '" . $empdep->SUPERINTENDENTE_APROVA . "' ,
            '" . $empdep->LANCA_MULTAS . "' ,
            '" . $empdep->GESTOR_AREA_APROVA_MULTAS . "',
            '" . $empdep->LANCA_NOTAS . "'
            )";

        
    
    if (!$execQuery = $conn->query($queryEmpDep)) {
        echo "Error: " . $queryEmpDep . "<br>" . $conn->error;
    }
}                    

curl_close($ch);



?>
