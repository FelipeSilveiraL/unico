<?php
session_start();

require_once('../../../config/databases.php');
require_once('../../../config/config.php');

$droptable = "DROP TABLE IF EXISTS bpm_vendedores";

$sucess = $conn->query($droptable);

// gerentes tablea mysql

$createVendedores = "CREATE TABLE `bpm_vendedores` (
    `ID_VENDEDOR` INT(10) NOT NULL ,
    `EMPRESA` INT(10) NULL,
    `DEPARTAMENTO` INT(10) NULL,
    `NOME` VARCHAR(100) NULL,
    `CPF` VARCHAR(15) NULL,
    `LOGIN_SMARTSHARE` VARCHAR(20) NULL,
    `CODIGO_LOGIN_SMARTSHARE` VARCHAR(6) NULL,
    `SITUACAO` VARCHAR(1) NULL,
    PRIMARY KEY (`ID_VENDEDOR`))";

$execCreate = $conn->query($createVendedores);

$url = "http://".$_SESSION['servidorOracle']."/".$_SESSION['smartshare']."/inc/vendedoresApi.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$resultado = json_decode(curl_exec($ch));


foreach ($resultado->vendedores as $empSmart) {


    $querySmart = "INSERT INTO bpm_vendedores
                            (ID_VENDEDOR,EMPRESA,DEPARTAMENTO,NOME,CPF,LOGIN_SMARTSHARE,CODIGO_LOGIN_SMARTSHARE,SITUACAO)
   
    VALUES ('" . $empSmart->ID_VENDEDOR ."',
            '" . $empSmart->EMPRESA ."',
            '" . $empSmart->DEPARTAMENTO ."',
            '" . $empSmart->NOME . "',
            '" . $empSmart->CPF . "' ,
            '" . $empSmart->LOGIN_SMARTSHARE ."',
            '" . $empSmart->CODIGO_LOGIN_SMARTSHARE ."',
            '" . $empSmart->SITUACAO ."'
            )";

        
    
    if (!$execQuery = $conn->query($querySmart)) {
        echo "<br><br><br><br><br>Error: " . $querySmart . "<br>" . $conn->error;
    }
}                    

curl_close($ch);


?>