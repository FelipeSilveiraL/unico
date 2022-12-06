<?php
session_start();

require_once('../../../config/databases.php');
require_once('../../../config/config.php');

$droptable = "DROP TABLE IF EXISTS bpm_usuarios_smartshare";

$sucess = $conn->query($droptable);

// Usuarios tabela mysql

$createTableEmp = "CREATE TABLE `bpm_usuarios_smartshare` (
    `id` INT(22) NOT NULL AUTO_INCREMENT,
    `DS_USUARIO` VARCHAR(100) NULL,
    `DS_LOGIN` VARCHAR(45) NULL,
    `CD_USUARIO` VARCHAR(45) NULL,
    `DS_EMAIL` VARCHAR(150) NULL,
    `ST_ATIVO` VARCHAR(45) NULL,
    `DS_PAPEL` VARCHAR(120) NULL,
    PRIMARY KEY (`id`));
  ";

$execCreate = $conn->query($createTableEmp);

$url = "http://".$_SESSION['servidorOracle']."/".$_SESSION['smartshare']."/inc/UsersSelbettiApi.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$resultado = json_decode(curl_exec($ch));


foreach ($resultado->Users as $usersSelbetti) {


    $querySmart = "INSERT INTO bpm_usuarios_smartshare 
                            (DS_USUARIO,DS_LOGIN,CD_USUARIO,DS_EMAIL,ST_ATIVO,DS_PAPEL)
   
    VALUES ('" . $usersSelbetti->DS_USUARIO ."',
            '" . $usersSelbetti->DS_LOGIN . "',
            '" . $usersSelbetti->CD_USUARIO . "' ,
            '" . $usersSelbetti->DS_EMAIL ."',
            '" . $usersSelbetti->ST_ATIVO ."',
            '" . $usersSelbetti->DS_PAPEL ."'
            )";

        
    
    if (!$execQuery = $conn->query($querySmart)) {
        echo "Error: " . $querySmart . "<br>" . $conn->error;
    }
}                    

curl_close($ch);


?>