<?php 
session_start();

require_once('../../../config/databases.php');
require_once('../../../config/config.php');

$droptable = "DROP TABLE IF EXISTS bpm_mfp_web";

$sucess = $conn->query($droptable);

// Empresas tablea mysql

$createTableMfp = "CREATE TABLE `unico`.`bpm_mfp_web` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `id_perfil` INT NOT NULL,
    `perfil` VARCHAR(45) NULL,
    `descricao` VARCHAR(45) NULL,
    `link` VARCHAR(45) NULL,
    `id_link` VARCHAR(45) NULL,
    PRIMARY KEY (`id`))";
   

$execCreate = $conn->query($createTableMfp);

$url = "http://".$_SESSION['servidorOracle']."/".$_SESSION['smartshare']."/inc/mfpApi.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$resultado = json_decode(curl_exec($ch));


foreach ($resultado->links as $mfp) {


    $queryMfp = "INSERT INTO bpm_mfp_web 
                            (link,id_perfil,perfil,descricao,id_link)
   
    VALUES ('" . $mfp->LINK ."',
            '" . $mfp->CD_PERFIL . "',
            '" . $mfp->DS_PERFIL . "' ,
            '" . $mfp->DESCRICAO ."',
            '" . $mfp->ID_LINK ."'
            )";

        
    
    if (!$execQuery = $conn->query($queryMfp)) {
        echo "Error: " . $queryMfp . "<br>" . $conn->error;
    }
}                    

curl_close($ch);


?>