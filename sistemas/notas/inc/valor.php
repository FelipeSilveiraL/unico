<?php
session_start();
require_once('../config/query.php');
require_once('../function/caracteres.php');
require_once('../function/calculos.php');

//bucasndo o rateio
$queryRateio = "SELECT 
                  CRC.ID_CENTROCUSTO_BPM AS centrocusto,
                  CRC.percentual AS porcento,
                  CRC.ID_CENTROCUSTO_BPM 
                FROM
                  cad_rateiocentrocusto CRC
                LEFT JOIN
                  cad_rateiofornecedor CRF ON (CRC.ID_RATEIOFORNECEDOR = CRF.ID_RATEIOFORNECEDOR)
                WHERE
                  CRF.ID_FILIAL = " . $_POST['idFilial'] . " AND CRF.cpfcnpj_fornecedor = '" . $_POST['id'] . "' AND CRF.ID_USUARIO = " . $_SESSION['id_usuario'];

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

  $queryDepartamento = "SELECT * FROM DEPARTAMENTO_NF WHERE ID_DEPARTAMENTO = " . $rateio['ID_CENTROCUSTO_BPM'];
  $result = oci_parse($connBpmgp, $queryDepartamento);
  oci_execute($result);

  while ($departamento = oci_fetch_array($result, OCI_ASSOC)) {
    $dep = $departamento['NOME_DEPARTAMENTO'];
  }

  //trabalhando a porcentagem
  $valorCalculado = porcentagem_nx(pontuacao($_POST['valor']), pontuacao($rateio['porcento']));

  echo '<tr>';
  echo '<td>' . $dep . '</td>';
  echo '<td>' . $rateio['porcento'] . '</td>';
  echo '<td>R$ ' . number_format($valorCalculado, 2, ',', '.')   . '</td>';
  echo '</tr>';
}

echo '</tbody>';

oci_free_statement($result);
oci_close($connBpmgp);
