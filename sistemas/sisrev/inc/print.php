<?php
require_once('../config/query.php');

// ------------------ ETIQUETA LASER -------------
$dropTableEstoque = "DROP TABLE IF EXISTS sisrev_etiqueta_estoque";

$sucesso = $conn->query($dropTableEstoque);


$createTableItem = "CREATE TABLE `sisrev_etiqueta_estoque` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `XZONA` VARCHAR(80) NULL,
    `XRUA` VARCHAR(10) NULL,
    `XESTANTE` VARCHAR(10) NULL,
    `XPRATELEIRA` VARCHAR(10) NULL,
    `XEMPRESA` VARCHAR(10) NULL,
    `XREVENDA` VARCHAR(10) NULL,
    `XNUMERO` VARCHAR(10) NULL,
    `XESTOQUE` VARCHAR(10) NULL,
    PRIMARY KEY (`id`))";


$execCreate = $conn->query($createTableItem);

$url = "http://10.100.1.215/unico_api/sisrev/api_estoque.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$resultado = json_decode(curl_exec($ch));

foreach ($resultado->$itensGaveta as $etiqLaser) {


    $insertEstoque = "INSERT INTO sisrev_etiqueta_estoque 
                            (XEMPRESA,XESTANTE,XESTOQUE,XNUMERO,XPRATELEIRA,XREVENDA,XRUA,XZONA)
   
    VALUES ('" . $etiqLaser->XEMPRESA ."',
            '" . $etiqLaser->XESTANTE . "',
            '" . $etiqLaser->XESTOQUE . "' ,
            '" . $etiqLaser->XNUMERO ."',
            '" . $etiqLaser->XPRATELEIRA ."',
            '" . $etiqLaser->XREVENDA ."',
            '" . $etiqLaser->XRUA ."',
            '" . $etiqLaser->XZONA ."'
            )";

        
    
    if (!$execQuery = $conn->query($insertEstoque)) {
        echo "Error: " . $insertEstoque . "<br>" . $conn->error;
    }
}

curl_close($ch);

//

$numeroId = $_POST['etiqueta'];
$copia = $_POST['copia'];

$buscaCarga .= " WHERE id_nota = '" . $numeroId . "' ";
$sucesso = $conn->query($buscaCarga);

echo $copia;
echo $numeroId;
exit;

for($i=0; $i <= $copia;){

    while($row = $sucesso->fetch_assoc()){
        echo "".$row['produto']."<br>
        &emsp;&emsp;NF ".$row['numero_nota']."<br>
        &emsp;&emsp;".$row['caixa']."";
    
    }
    
    $i++;
}

?>





<!-- <script>
window.onload = function () { window.print(); window.addEventListener("afterprint", function(event) { window.close(); });
    window.onafterprint(); } 
</script> -->