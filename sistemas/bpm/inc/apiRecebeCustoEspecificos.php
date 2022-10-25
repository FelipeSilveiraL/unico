<?php
session_start();
require_once('../../../config/databases.php');
require_once('../../../config/config.php');

$droptable = "DROP TABLE IF EXISTS bpm_custo_especificos";

$sucess = $conn->query($droptable);

// Empresas tablea mysql

$createTableCaixa = "CREATE TABLE `bpm_custo_especificos` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `DESCRICAO_CUSTO` VARCHAR(80) NULL,
    `CODIGO_CUSTO` VARCHAR(80) NULL,
    `COD_EMPRESA` VARCHAR(80) NULL,
    PRIMARY KEY (`id`))";

$execCreate = $conn->query($createTableCaixa);

$url = "http://".$_SESSION['servidorOracle']."/".$_SESSION['smartshare']."/inc/custoEspecificoAPI.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$resultado = json_decode(curl_exec($ch));


foreach ($resultado->despesa as $custoEspec) {


    $queryCustos = "INSERT INTO bpm_custo_especificos 
                            (DESCRICAO_CUSTO,
                            CODIGO_CUSTO,
                            COD_EMPRESA
                            )
   
    VALUES ('" . $custoEspec->DESCRICAO_CUSTO ."',
            '" . $custoEspec->CODIGO_CUSTO . "',
            '" . $custoEspec->COD_EMPRESA . "'
            )";

        
    
    if (!$execQuery = $conn->query($queryCustos)) {
        echo "Error: " . $queryCustos . "<br>" . $conn->error;
    }
}                    

curl_close($ch);

################ CODIGO CUSTO VEICULO API ################

$droptable = "DROP TABLE IF EXISTS bpm_codigo_custo_veiculo";

$sucess = $conn->query($droptable);

// Empresas tablea mysql

$createTableCaixa = "CREATE TABLE `bpm_codigo_custo_veiculo` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `ID_CODIGO_CUSTO_VEICULO` VARCHAR(80) NULL,
    `ID_EMPRESA` VARCHAR(80) NULL,
    `TIPO_CUSTO` VARCHAR(80) NULL,
    `ANO_REFERENCIA` VARCHAR(80) NULL,
    `CODIGO_CUSTO_ERP` VARCHAR(80) NULL,
    `PARCELA` VARCHAR(80) NULL,
    PRIMARY KEY (`id`))";

$execCreate = $conn->query($createTableCaixa);

$url = "http://".$_SESSION['servidorOracle']."/".$_SESSION['smartshare']."/inc/codigoCustoVeiculoAPI.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$resultado = json_decode(curl_exec($ch));


foreach ($resultado->despesa as $custoHistorico) {


    $queryHistorico = "INSERT INTO bpm_codigo_custo_veiculo 
                            (ID_CODIGO_CUSTO_VEICULO,
                            ID_EMPRESA,
                            TIPO_CUSTO,
                            ANO_REFERENCIA,
                            CODIGO_CUSTO_ERP,
                            PARCELA
                            )
   
    VALUES ('" . $custoHistorico->ID_CODIGO_CUSTO_VEICULO ."',
            '" . $custoHistorico->ID_EMPRESA . "',
            '" . $custoHistorico->TIPO_CUSTO . "',
            '" . $custoHistorico->ANO_REFERENCIA . "',
            '" . $custoHistorico->CODIGO_CUSTO_ERP . "',
            '" . $custoHistorico->PARCELA . "'
            )";

        
    
    if (!$execQuery = $conn->query($queryHistorico)) {
        echo "Error: " . $queryHistorico . "<br>" . $conn->error;
    }
}                    

curl_close($ch);





?>