<?php
session_start();

require_once('../../../config/databases.php');
require_once('../../../config/config.php');

$excluiTabela = "DROP TABLE IF EXISTS bpm_auditoria";

$sucess = $conn->query($excluiTabela);

$criaTabela = "CREATE TABLE `bpm_auditoria` (
  `ID_AUDITORIA` INT NOT NULL AUTO_INCREMENT,
  `LIMITE_NOTA_DESPESA` INT(5) NULL,
  `LIMITE_FECHAMENTO_CAIXA` INT(5) NULL,
  `LIMITE_NOTA_FISCAL` INT(5) NULL,
  PRIMARY KEY (`ID_AUDITORIA`) )";

$execTabela = $conn->query($criaTabela);


$url = "http://".$_SESSION['servidorOracle']."/".$_SESSION['smartshare']."/inc/auditoriaApi.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$resultado = json_decode(curl_exec($ch));

foreach ($resultado->auditoria as $bpm) {


    $queryAuditoria = "INSERT INTO bpm_auditoria 
                            (ID_AUDITORIA,LIMITE_NOTA_DESPESA,LIMITE_FECHAMENTO_CAIXA,LIMITE_NOTA_FISCAL
                            ) VALUES (
   
            " . $bpm->ID_AUDITORIA .",
            " . $bpm->LIMITE_NOTA_DESPESA .",
            " . $bpm->LIMITE_FECHAMENTO_CAIXA .",
            " . $bpm->LIMITE_NOTA_FISCAL ."
            )";

        
    
    if (!$execQuery = $conn->query($queryAuditoria)) {
        echo "Error: " . $queryAuditoria . "<br>" . $conn->error;
    }
}                    

curl_close($ch);



?>
