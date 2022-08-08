<?php
require_once('../../../config/databases.php');

$droptable = "DROP TABLE IF EXISTS sisrev_empresas_bpmgp";

$sucess = $conn->query($droptable);

// Empresas tablea mysql

$createTableEmp = "CREATE TABLE `sisrev_empresas_bpmgp` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `NOME_EMPRESA` VARCHAR(80) NULL,
    `SISTEMA` VARCHAR(1) NULL,
    `EMPRESA_APOLLO` VARCHAR(10) NULL,
    `REVENDA_APOLLO` VARCHAR(10) NULL,
    `EMPRESA_NBS` VARCHAR(10) NULL,
    `ORGANOGRAMA_SENIOR` VARCHAR(3) NULL,
    `EMPRESA_SENIOR` VARCHAR(10) NULL,
    `FILIAL_SENIOR` VARCHAR(10) NULL,
    `ID_EMPRESA` VARCHAR(10) NULL,
    `SITUACAO` VARCHAR(1) NULL,
    `CONSORCIO` VARCHAR(1) NULL,
    `NUMERO_CAIXA` VARCHAR(5) NULL,
    `APROVADOR_CAIXA` VARCHAR(100) NULL,
    `UF_GESTAO` VARCHAR(2) NULL,
    PRIMARY KEY (`id`))";

$execCreate = $conn->query($createTableEmp);

$url = "http://10.100.1.215/smartshare/inc/smartApi.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$resultado = json_decode(curl_exec($ch));


foreach ($resultado->empresaSmart as $empSmart) {


    $querySmart = "INSERT INTO sisrev_empresas_bpmgp 
                            (NOME_EMPRESA,SISTEMA,UF_GESTAO,CONSORCIO,APROVADOR_CAIXA,NUMERO_CAIXA,FILIAL_SENIOR,ID_EMPRESA,EMPRESA_SENIOR,
                            ORGANOGRAMA_SENIOR,EMPRESA_APOLLO,REVENDA_APOLLO,SITUACAO,EMPRESA_NBS)
   
    VALUES ('" . $empSmart->NOME_EMPRESA ."',
            '" . $empSmart->SISTEMA . "',
            '" . $empSmart->UF_GESTAO . "' ,
            '" . $empSmart->CONSORCIO ."',
            '" . $empSmart->APROVADOR_CAIXA ."',
            '" . $empSmart->NUMERO_CAIXA ."',
            '" . $empSmart->FILIAL_SENIOR ."',
            '" . $empSmart->ID_EMPRESA ."',
            '" . $empSmart->EMPRESA_SENIOR ."',
            '" . $empSmart->ORGANOGRAMA_SENIOR ."',
            '" . $empSmart->EMPRESA_APOLLO ."',
            '" . $empSmart->REVENDA_APOLLO ."',
            '" . $empSmart->SITUACAO . "',
            '" . $empSmart->EMPRESA_NBS ."'
            )";

        
    
    if (!$execQuery = $conn->query($querySmart)) {
        echo "Error: " . $querySmart . "<br>" . $conn->error;
    }
}                    

curl_close($ch);


?>