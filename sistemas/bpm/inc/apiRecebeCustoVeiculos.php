<?php
session_start();
require_once('../../../config/databases.php');
require_once('../../../config/config.php');

$droptable = "DROP TABLE IF EXISTS bpm_custo_veiculo";

$sucess = $conn->query($droptable);

// Empresas tablea mysql

$createTableCaixa = "CREATE TABLE `bpm_custo_veiculo` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `ID_CODIGO_CUSTO_VEICULO` VARCHAR(80) NULL,
    `NOME_EMPRESA` VARCHAR(80) NULL,
    `ID_EMPRESA` VARCHAR(80) NULL,
    `SISTEMA` VARCHAR(80) NULL,
    `EMPRESA_NBS` VARCHAR(80) NULL,
    `EMPRESA_APOLLO` VARCHAR(80) NULL,
    `TIPO_CUSTO` VARCHAR(80) NULL,
    `ANO_REFERENCIA` VARCHAR(80) NULL,
    `CODIGO_CUSTO_ERP` VARCHAR(80) NULL,
    PRIMARY KEY (`id`))";

$execCreate = $conn->query($createTableCaixa);

$url = "http://".$_SESSION['servidorOracle']."/".$_SESSION['smartshare']."/inc/custoVeiculoAPI.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$resultado = json_decode(curl_exec($ch));


foreach ($resultado->veiculo as $custoVeiculo) {


    $queryCusto = "INSERT INTO bpm_custo_veiculo 
                            (ID_CODIGO_CUSTO_VEICULO,
                            NOME_EMPRESA,
                            ID_EMPRESA,
                            SISTEMA,
                            EMPRESA_NBS,
                            EMPRESA_APOLLO,
                            TIPO_CUSTO,
                            ANO_REFERENCIA,
                            CODIGO_CUSTO_ERP)
   
    VALUES ('" . $custoVeiculo->ID_CODIGO_CUSTO_VEICULO ."',
            '" . $custoVeiculo->NOME_EMPRESA . "',
            '" . $custoVeiculo->ID_EMPRESA . "' ,
            '" . $custoVeiculo->SISTEMA ."',
            '" . $custoVeiculo->EMPRESA_NBS ."',
            '" . $custoVeiculo->EMPRESA_APOLLO ."',
            '" . $custoVeiculo->TIPO_CUSTO ."',
            '" . $custoVeiculo->ANO_REFERENCIA ."',
            '" . $custoVeiculo->CODIGO_CUSTO_ERP ."'
            )";

        
    
    if (!$execQuery = $conn->query($queryCusto)) {
        echo "Error: " . $queryCusto . "<br>" . $conn->error;
    }
}                    

curl_close($ch);

//--------------vei_despesas-------------------//

$droptable = "DROP TABLE IF EXISTS bpm_vei_despesa";

$sucess = $conn->query($droptable);

$createTableCaixa = "CREATE TABLE `bpm_vei_despesa` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `EMPRESA` INT(5) NULL,
    `DESPESA` INT(5) NULL,
    `DES_DESPESA` VARCHAR(80) NULL,
    `SINAL` VARCHAR(80) NULL,
    `INATIVO_CONSULTAS` VARCHAR(1) NULL,
    PRIMARY KEY (`id`))";

$execCreate = $conn->query($createTableCaixa);

$url = "http://".$_SESSION['servidorOracle']."/".$_SESSION['smartshare']."/inc/veiDespesaAPI.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$resultado = json_decode(curl_exec($ch));


foreach ($resultado->despesa as $veiDespesa) {


    $queroVeiDespesa = "INSERT INTO bpm_vei_despesa 
                            (EMPRESA,
                            DESPESA,
                            DES_DESPESA,
                            SINAL,
                            INATIVO_CONSULTAS
                           )
   
    VALUES ('" . $veiDespesa->EMPRESA ."',
            '" . $veiDespesa->DESPESA . "',
            '" . $veiDespesa->DES_DESPESA . "' ,
            '" . $veiDespesa->SINAL ."',
            '" . $veiDespesa->INATIVO_CONSULTAS ."'
            )";

        
    
    if (!$execQuery = $conn->query($queroVeiDespesa)) {
        echo "Error: " . $queroVeiDespesa . "<br>" . $conn->error;
    }
}                    

curl_close($ch);

?>