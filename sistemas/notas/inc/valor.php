<?php
session_start();
require_once('../config/query.php');


//procurando o fornecedor

$queryFornecedor = "SELECT * FROM cad_rateiofornecedor WHERE filial = '" . $_POST['idFilial'] . "' AND cpfcnpj_fornecedor = '" . $_POST['id'] . "' AND id_usuario = '" . $_SESSION['id_usuario'] . "'";
$aplicaquery = $connNOTAS->query($queryFornecedor);
$fornecedorLancar = $aplicaquery->fetch_assoc();


//bucasndo o rateio
$queryRateio = "SELECT * FROM cad_rateiocentrocusto WHERE id_rateiofornecedor = " . $fornecedorLancar['id'];
$aplicarqueryrateio = $connNOTAS->query($queryRateio);

echo '<thead>
<tr>
  <th scope="col">Centro de Custo</th>
  <th scope="col">% Rateio</th>
  <th scope="col">Valor</th>
</tr>
</thead>';

echo  '<tbody>';

while ($rateio = $aplicarqueryrateio->fetch_assoc()) {
    echo '<tr>';
    echo '<td>' . $rateio['ID_CENTROCUSTO'] . '</td>';
    echo '<td>' . $rateio['PERCENTUAL'] . '</td>';

    $resultado = ($_POST['valor'] / $rateio['PERCENTUAL']) * 100;
    
    echo  '<td>' . $resultado . '</td>';
    echo '</tr>';
}

echo '</tbody>';
