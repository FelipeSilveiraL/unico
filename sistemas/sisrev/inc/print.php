<?php
require_once('../config/query.php');

// ------------------ ETIQUETA LASER -------------
$dropTableEstoque = "DROP TABLE IF EXISTS sisrev_etiqueta_estoque";

$sucesso = $conn->query($dropTableEstoque);


$createTableItem = "CREATE TABLE `sisrev_etiqueta_estoque` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `LOCACAO_ZONA` VARCHAR(80) NULL,
    `LOCACAO_RUA` VARCHAR(100) NULL,
    `LOCACAO_ESTANTE` VARCHAR(100) NULL,
    `LOCACAO_PRATELEIRA` VARCHAR(100) NULL,
    `EMPRESA` VARCHAR(100) NULL,
    `REVENDA` VARCHAR(100) NULL,
    `LOCACAO_NUMERO` VARCHAR(100) NULL,
    `ITEM_ESTOQUE` VARCHAR(100) NULL,
    PRIMARY KEY (`id`))";


$execCreate = $conn->query($createTableItem);

$url = "http://10.100.1.215/unico_api/sisrev/api_estoque.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$resultado = json_decode(curl_exec($ch));

foreach ($resultado->itensGaveta as $etiqLaser) {
  
    $insertEstoque = "INSERT INTO sisrev_etiqueta_estoque 
                            (EMPRESA,LOCACAO_ESTANTE,ITEM_ESTOQUE,LOCACAO_NUMERO,LOCACAO_PRATELEIRA,REVENDA,LOCACAO_RUA,LOCACAO_ZONA)
   
    VALUES ('" . $etiqLaser->EMPRESA ."',
            '" . $etiqLaser->LOCACAO_ESTANTE . "',
            '" . $etiqLaser->ITEM_ESTOQUE . "' ,
            '" . $etiqLaser->LOCACAO_NUMERO ."',
            '" . $etiqLaser->LOCACAO_PRATELEIRA ."',
            '" . $etiqLaser->REVENDA ."',
            '" . $etiqLaser->LOCACAO_RUA ."',
            '" . $etiqLaser->LOCACAO_ZONA ."'
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