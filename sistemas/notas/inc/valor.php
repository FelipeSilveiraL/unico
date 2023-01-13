<?php
session_start();
require_once('../config/query.php');
require_once('../function/caracteres.php');
require_once('../function/calculos.php');

//bucasndo o rateio
$queryRateio = "SELECT 
                  CRC.ID_CENTROCUSTO_BPM AS centrocusto,
                  CRC.percentual AS porcento,
                  UBNFD.NOME_DEPARTAMENTO
                FROM
                  cad_rateiocentrocusto CRC
                LEFT JOIN
                  cad_rateiofornecedor CRF ON (CRC.ID_RATEIOFORNECEDOR = CRF.ID_RATEIOFORNECEDOR)
                LEFT JOIN
                  unico.bpm_nf_departamento UBNFD ON (CRC.ID_CENTROCUSTO_BPM = UBNFD.ID_DEPARTAMENTO)
                WHERE
                  CRF.ID_FILIAL = " . $_POST['idFilial'] . " AND CRF.cpfcnpj_fornecedor = '" . $_POST['id'] . "' AND CRF.ID_USUARIO = ".$_SESSION['id_usuario'];

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
  
  //trabalhando a porcentagem
  $valorCalculado = porcentagem_nx(pontuacao($_POST['valor']), pontuacao($rateio['porcento']));

  echo '<tr>';
  echo '<td>' . $rateio['NOME_DEPARTAMENTO'] . '</td>';
  echo '<td>' . $rateio['porcento'] . '</td>';
  echo  '<td class="dinheiro">R$ ' . round($valorCalculado, 2)  . '</td>';
  echo '</tr>';

}

echo '</tbody>';
