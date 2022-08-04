<?php
require_once('../config/query.php');

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