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

$cont = 0;

while ($rateio = $aplicarqueryrateio->fetch_assoc()) {
  echo '<tr>';
  echo '<td><input class="money" value="' . $rateio['ID_CENTROCUSTO'] . '" name="centroCusto' . $cont . '" readonly></td>';
  echo '<td><input class="money" value="' . $rateio['PERCENTUAL'] . '" name="percentual' . $cont . '" readonly></td>';

  $total = $_POST['valor'];
  $pctm = $rateio['PERCENTUAL'];
  $calculo = $total / 100 * $pctm;

  if ($calculo == $total) {
    $valor_descontado = $_POST['valor'];
  } else {
    $valor_descontado = $total - $total;
  }

  echo  '<td><input class="money" value="' . $valor_descontado . '" name="valorRateado' . $cont . '" readonly></td>';
  echo '</tr>';

  $cont++;
}

echo '</tbody>';
