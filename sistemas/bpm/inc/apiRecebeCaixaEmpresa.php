<?php
session_start();

require_once('../../../config/databases.php');
require_once('../../../config/config.php');

$droptable = "DROP TABLE IF EXISTS bpm_caixa_empresa";

$sucess = $conn->query($droptable);

// Empresas tablea mysql

$createTableCaixa = "CREATE TABLE `bpm_caixa_empresa` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `ID_CAIXA_EMPRESA` VARCHAR(80) NULL,
    `ID_EMPRESA` VARCHAR(80) NULL,
    `NOME_CAIXA` VARCHAR(80) NULL,
    `NUMERO_CAIXA_SISTEMA` VARCHAR(80) NULL,
    PRIMARY KEY (`id`))";

$execCreate = $conn->query($createTableCaixa);

$url = "http://".$_SESSION['servidorOracle']."/".$_SESSION['smartshare']."/inc/caixaEmpresaApi.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$resultado = json_decode(curl_exec($ch));


foreach ($resultado->caixa as $caixaSmart) {


    $queryCaixa = "INSERT INTO bpm_caixa_empresa 
                            (ID_CAIXA_EMPRESA,ID_EMPRESA,NOME_CAIXA,NUMERO_CAIXA_SISTEMA)
   
    VALUES ('" . $caixaSmart->ID_CAIXA_EMPRESA ."',
            '" . $caixaSmart->ID_EMPRESA . "',
            '" . $caixaSmart->NOME_CAIXA . "' ,
            '" . $caixaSmart->NUMERO_CAIXA_SISTEMA ."'
           
            )";

        
    
    if (!$execQuery = $conn->query($queryCaixa)) {
        echo "Error: " . $queryCaixa . "<br>" . $conn->error;
    }
}                    

curl_close($ch);


?>