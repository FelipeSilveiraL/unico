<?php
require_once('../config/query.php');

// ------------------ ETIQUETA LASER -------------


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


while($row = $sucesso->fetch_assoc()){
        echo "".$row['produto']."<br>
        &emsp;&emsp;NF ".$row['numero_nota']."<br>
        &emsp;&emsp;".$row['caixa']."";
    
    }
    
    $i++;


?>





<!-- <script>
window.onload = function () { window.print(); window.addEventListener("afterprint", function(event) { window.close(); });
    window.onafterprint(); } 
</script> -->