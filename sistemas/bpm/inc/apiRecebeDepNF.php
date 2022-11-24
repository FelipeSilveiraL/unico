<?php
$excluiTabela2 = "DROP TABLE IF EXISTS bpm_nf_departamento";

$sucess = $conn->query($excluiTabela2);

$criaTabela2 = "CREATE TABLE `bpm_nf_departamento` (
  `ID_DEPARTAMENTO` INT NOT NULL,
  `NOME_DEPARTAMENTO` VARCHAR(45) NULL,
  `SITUACAO` VARCHAR(45) NULL,
  PRIMARY KEY (`ID_DEPARTAMENTO`) )";

$execTabela = $conn->query($criaTabela2);


$url = "http://".$_SESSION['servidorOracle']."/smartshare/inc/departamentoNF.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$result = json_decode(curl_exec($ch));

foreach ($result->dep as $departamento) {


    $queryDep = "INSERT INTO bpm_nf_departamento 
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