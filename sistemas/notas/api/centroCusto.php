<?php
session_start();

require_once('../config/query.php');
require_once('../../../config/config.php');

$droptable = "DROP TABLE IF EXISTS notas_centro_custo";

$sucess = $conn->query($droptable);

// Empresas tablea mysql

$createTableCentroCusto = "CREATE TABLE `notas_centro_custo` (
    `NOME_EMPRESA` VARCHAR(80) NOT NULL,
    `NOME_DEPARTAMENTO` VARCHAR(80) NOT NULL,
    `ID_DEPARTAMENTO` INT(11) NULL,
    `ID_EMPRESA` INT(11) NULL)";

$execCreate = $conn->query($createTableCentroCusto);

$url = "http://".$_SESSION['servidorOracle']."/".$_SESSION['smartshare']."/inc/centroCustoApi.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$resultado = json_decode(curl_exec($ch));

//var_dump($resultado);

//var_dump($resultado->centro_custo);

foreach ($resultado->centro_custo as $centroCusto) {

    $querySmart = "INSERT INTO notas_centro_custo 
                            (NOME_EMPRESA, NOME_DEPARTAMENTO, ID_DEPARTAMENTO, ID_EMPRESA)
   
    VALUES ('" . $centroCusto->NOME_EMPRESA ."',
            '" . $centroCusto->NOME_DEPARTAMENTO ."',
            '" . $centroCusto->ID_DEPARTAMENTO ."',
            '" . $centroCusto->ID_EMPRESA ."'
            )";        
    
    if (!$execQuery = $conn->query($querySmart)) {
        //echo "Error: " . $querySmart . "<br>" . $conn->error;
    }
}                    

curl_close($ch);


?>