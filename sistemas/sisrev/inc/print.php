<?php
require_once('../config/query.php');

// ------------------ ETIQUETA LASER -------------
$dropTableEstoque = "DROP TABLE IF EXISTS sisrev_etiqueta_estoque ";

$sucesso = $conn->query($dropTableEstoque);

$createTableEst = "CREATE TABLE `sisrev_etiqueta_estoque`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `LOCACAO_ZONA` VARCHAR(80) NULL,
    `LOCACAO_RUA` VARCHAR(80) NULL,
    `LOCACAO_ESTANTE` VARCHAR(80) NULL,
    `LOCACAO_PRATELEIRA` VARCHAR(80) NULL,
    `ITEM_ESTOQUE` VARCHAR(80) NULL,
    `LOCACAO_NUMERO` VARCHAR(80) NULL,
    `EMPRESA` VARCHAR(80) NULL,
    `REVENDA` VARCHAR(80) NULL,
    PRIMARY KEY (`id`))";
 
 $execCreate = $conn->query($createTableEst);

$url = "http://10.100.1.215/unico_api/sisrev/api_estoque.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$resultado = json_decode(curl_exec($ch));

foreach ($resultado->itensEndereco as $etiqLaser) {
    
  
    $insertEstoque = "INSERT INTO sisrev_etiqueta_estoque 
                            (LOCACAO_ZONA, 
                            LOCACAO_RUA,
                             LOCACAO_ESTANTE, 
                             LOCACAO_PRATELEIRA, 
                             ITEM_ESTOQUE, 
                             LOCACAO_NUMERO, 
                             EMPRESA, 
                             REVENDA)
   
    VALUES ('" . $etiqLaser->LOCACAO_ZONA ."',
            '" . $etiqLaser->LOCACAO_RUA . "',
            '" . $etiqLaser->LOCACAO_ESTANTE . "' ,
            '" . $etiqLaser->LOCACAO_PRATELEIRA ."',
            '" . $etiqLaser->ITEM_ESTOQUE ."',
            '" . $etiqLaser->LOCACAO_NUMERO ."',
            '" . $etiqLaser->EMPRESA ."',
            '" . $etiqLaser->REVENDA ."'
            )";

        
    
    if (!$execQuery = $conn->query($insertEstoque)) {
        echo "Error: " . $insertEstoque . "<br>" . $conn->error;
    }
}

curl_close($ch);

//

$produto = $_GET['produto'];
$produto = substr($produto, 3,6);
$empresa = $_GET['empresa'];

$buscaCarga .= " WHERE produto LIKE '%" . $produto . "%' ";
$sucesso = $conn->query($buscaCarga);


while($row = $sucesso->fetch_assoc()){
        echo "".$row['produto']."<br>
        &emsp;&emsp;NF ".$row['numero_nota']."<br>
        &emsp;&emsp;".$row['caixa']."<br>";
        $revenda = '1';
        $endereco = "SELECT * FROM sisrev_etiqueta_estoque WHERE REVENDA = '".$revenda."'";
        $deuCerto = $conn->query($endereco);

        while($enderecoMostra = $deuCerto->fetch_assoc()){
            echo '&emsp;'.$enderecoMostra['LOCACAO_ZONA'].'0'.$enderecoMostra['LOCACAO_RUA'].'&ensp;0'.$enderecoMostra['LOCACAO_ESTANTE'].'&ensp;'.$enderecoMostra['LOCACAO_PRATELEIRA'].'0'.$enderecoMostra['LOCACAO_NUMERO'].'';
        }
    }
    
    $i++;


?>





<script>
window.onload = function () { window.print(); window.addEventListener("afterprint", function(event) { window.close(); });
    window.onafterprint(); } 
</script>