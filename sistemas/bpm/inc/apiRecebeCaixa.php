<?php
session_start();

require_once('../../../config/databases.php');
require_once('../../../config/config.php');

$droptable = "DROP TABLE IF EXISTS bpm_caixa_nf";

$sucess = $conn->query($droptable);

// Empresas tablea mysql

$createTableCaixa = "CREATE TABLE `bpm_caixa_nf` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `ID_EMPRESA` VARCHAR(80) NULL,
    `NOME_EMPRESA` VARCHAR(80) NULL,
    `NUMERO_CAIXA` VARCHAR(80) NULL,
    `USUARIO_CAIXA` VARCHAR(80) NULL,
    PRIMARY KEY (`id`))";

$execCreate = $conn->query($createTableCaixa);

$url = "http://".$_SESSION['servidorOracle']."/".$_SESSION['smartshare']."/inc/usCaixa.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$resultado = json_decode(curl_exec($ch));


foreach ($resultado->caixa as $caixaSmart) {


    $queryCaixa = "INSERT INTO bpm_caixa_nf 
                            (ID_EMPRESA,NOME_EMPRESA,NUMERO_CAIXA,USUARIO_CAIXA)
   
    VALUES ('" . $caixaSmart->ID_EMPRESA ."',
            '" . $caixaSmart->NOME_EMPRESA . "',
            '" . $caixaSmart->NUMERO_CAIXA . "' ,
            '" . $caixaSmart->USUARIO_CAIXA ."'
           
            )";

        
    
    if (!$execQuery = $conn->query($queryCaixa)) {
        echo "Error: " . $queryCaixa . "<br>" . $conn->error;
    }
}                    

curl_close($ch);


?>