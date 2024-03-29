<?php
session_start();

require_once('../../../config/databases.php');
require_once('../../../config/config.php');

$droptable = "DROP TABLE IF EXISTS bpm_empresas";

$sucess = $conn->query($droptable);

// Empresas tablea mysql

$createTableEmp = "CREATE TABLE `bpm_empresas` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `NOME_EMPRESA` VARCHAR(80) NULL,
    `CNPJ` VARCHAR(80) NULL,
    `APELIDO_NBS` VARCHAR(5) NULL,
    `SISTEMA` VARCHAR(1) NULL,
    `EMPRESA_APOLLO` INT(10) NULL,
    `REVENDA_APOLLO` INT(10) NULL,
    `EMPRESA_NBS` INT(10) NULL,
    `ORGANOGRAMA_SENIOR` INT(3) NULL,
    `EMPRESA_SENIOR` INT(10) NULL,
    `FILIAL_SENIOR` INT(10) NULL,
    `ID_EMPRESA` INT(10) NULL,
    `SITUACAO` VARCHAR(1) NULL,
    `CONSORCIO` VARCHAR(1) NULL,
    `NUMERO_CAIXA` VARCHAR(5) NULL,
    `UF_GESTAO` VARCHAR(2) NULL,
    `BANDEIRA` VARCHAR(100) NULL,
    `LIMITE_NOTA_DIVERSA` VARCHAR(12) NULL,
    `INTEGRAR_TRIAGEM` VARCHAR(1) NULL,
    PRIMARY KEY (`id`))";

$execCreate = $conn->query($createTableEmp);


$url = "http://".$_SESSION['servidorOracle']."/".$_SESSION['smartshare']."/inc/smartApi.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$resultado = json_decode(curl_exec($ch));

foreach ($resultado->empresaSmart as $empSmart) {

    $querySmart = "INSERT INTO bpm_empresas 
                            (NOME_EMPRESA,CNPJ,APELIDO_NBS,SISTEMA,UF_GESTAO,CONSORCIO,NUMERO_CAIXA,FILIAL_SENIOR,ID_EMPRESA,EMPRESA_SENIOR,
                            ORGANOGRAMA_SENIOR,EMPRESA_APOLLO,REVENDA_APOLLO,SITUACAO,EMPRESA_NBS,BANDEIRA,LIMITE_NOTA_DIVERSA,INTEGRAR_TRIAGEM)
   
    VALUES ('" . $empSmart->NOME_EMPRESA ."',
            '" .str_pad($empSmart->CNPJ , 14 , '0' , STR_PAD_LEFT)."',
            '" . $empSmart->APELIDO_NBS ."',
            '" . $empSmart->SISTEMA . "',
            '" . $empSmart->UF_GESTAO . "' ,
            '" . $empSmart->CONSORCIO ."',
            '" . $empSmart->NUMERO_CAIXA ."',
            '" . $empSmart->FILIAL_SENIOR ."',
            '" . $empSmart->ID_EMPRESA ."',
            " . $empSmart->EMPRESA_SENIOR .",
            " . $empSmart->ORGANOGRAMA_SENIOR .",
            " . $empSmart->EMPRESA_APOLLO .",
            " . $empSmart->REVENDA_APOLLO .",
            '" . $empSmart->SITUACAO . "',
            '" . $empSmart->EMPRESA_NBS ."',
            '" . $empSmart->BANDEIRA ."',
            '" . $empSmart->LIMITE_NOTA_DIVERSA ."',
            '" . $empSmart->INTEGRAR_TRIAGEM ."'
            )";
    
    if (!$execQuery = $conn->query($querySmart)) {
        echo "Error: " . $querySmart . "<br>" . $conn->error;
    }
}                    

curl_close($ch);
