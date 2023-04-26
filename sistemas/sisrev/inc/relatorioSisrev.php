<?php
require_once('../../../config/databases.php');
require_once('../../../config/session.php');
require_once('../../../config/sqlSmart.php');

$dateCom = $_GET['dateCom'];

$dateFim = $_GET['dateFim'];

?>
<!doctype html>
<html lang="pt-br">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Relatório Sisrev</title>
</head>
<style>
  .break {
    page-break-before: always;
  }

  .tabela {
    font-size: 15px;
  }
</style>

<body>
  <?php
  $today = date('d/m/y H:i');
  $empresas = "SELECT * FROM EMPRESA WHERE ID_EMPRESA NOT IN (208) ORDER BY ID_EMPRESA ASC";

  $sucesso = oci_parse($connBpmgp, $empresas);

  oci_execute($sucesso, OCI_COMMIT_ON_SUCCESS);

  while (($emp = oci_fetch_array($sucesso, OCI_ASSOC + OCI_RETURN_NULLS)) != FAlSE) {

    $anterior = NULL;

    $id_empresa = $emp['ID_EMPRESA'];

    echo '
        <div ><br>
        <p style="text-align: center;">COMISSAO REVENDAS USADOS</p>
        <p style="text-align:center;"> PERÍODO: ' . $dateCom . '  A ' . $dateFim . '  </p>
        <p style="padding-left:10px;">EMPRESA ORIGEM: ' . $emp['NOME_EMPRESA'] . ' <span style="float:right;padding-right:10px;">EMISSÃO: ' . $today . '</span> </p>
        <table class="table table-borderless ">
      <thead>
        <tr style="text-align: center;font-size:11px">
          <th scope="col">EMPRESA</th>
          <th scope="col">REVENDA</th>
          <th scope="col">PROPOSTA</th>
          <th scope="col">N.F</th>
          <th scope="col">TRANS</th>
          <th scope="col">DT. NOTA</th>
          <th scope="col">TIPO VENDA</th>
          <th scope="col">CHASSI</th>
          <th scope="col">VEICULO</th>
          <th scope="col">VENDEDOR</th>
          <th scope="col">VALOR NOTA</th>
        </tr>
      </thead>
      <tbody>';

    $vendas = "SELECT * FROM sisrev_comissao xve WHERE xve.XVENDEDOR != '0' ORDER BY xve.ID ASC";

    $conexao = oci_parse($connBpmgp, $vendas);
    oci_execute($conexao, OCI_COMMIT_ON_SUCCESS);

    //while da tabela sisrev_comissao
    while (($tabela = oci_fetch_array($conexao, OCI_ASSOC)) != FAlSE) {

      echo '<tr> <td colspan="14" >1/td></tr>';
      echo '<tr style="font-size:11px;text-align:center;">
             <td>' . $tabela['XEMPRESA'] . '</td>
             <td>' . $tabela['XREVENDA'] . '</td>
             <td>a</td>
             <td>a</td>
             <td>' . $tabela['XTRANSACAO'] . '</td>
             <td>' . $tabela['XDTNOTA'] . '</td>
             <td>' . $tabela['TIPO_VENDA'] . '</td>
             <td>' . $tabela['XCHASSI'] . '</td>
             <td>' . $tabela['XCODIGO_VEICULO'] . '</td>
             <td>' . $tabela['XVENDEDOR'] . '</td>
             <td>b</td>
             </tr>';

      /* if ($tabela['XEMPRESA_VENDEDOR'] == $id_empresa) {

        if ($tabela['ID_EMPRESA'] != $id_empresa) {

          // $tentativa = 'SELECT sum(t.XVAL_VENDA_VEICULO), t.ID_EMPRESA FROM sisrev_comissao t GROUP BY t.ID_EMPRESA';

          // $vamosVer = oci_parse($connBpmgp, $tentativa);
          // oci_execute($vamosVer);

          $atual = $tabela['ID_EMPRESA'];
          $valorAtual = $tabela['XVAL_VENDA_VEICULO'];

          if (empty($anterior)) {

            $anterior = $tabela['ID_EMPRESA'];
          } else if ($anterior != $atual) {
            $linha = '<span style="float:right;font-size:11px;margin-right:104px;margin-top: -1px;"><b>Total faturamento:  </b></span>';

            $anterior = $tabela['ID_EMPRESA'];
          } else {
            $linha = '';
          }

          //notas canceladas
          $queryCanc = "SELECT * FROM sisrev_comissao_canc WHERE XNRONOTA = '" . $tabela['XNRONOTA'] . "' ";

          $conexaoCanc = oci_parse($connBpmgp, $queryCanc);
          oci_execute($conexaoCanc, OCI_COMMIT_ON_SUCCESS);

          if ($teste = oci_fetch_array($conexaoCanc, OCI_ASSOC)) {

            $valorVenda2 = $teste['XVAL_VENDA_VEICULO'];
            $valorVenda2 = number_format($valorVenda2, 2, ',', '.');

            $numNota2 = $teste['XNRONOTA'];
            $numNota2 = number_format($numNota2, 0, ',', '.');

            $proposta2 = $teste['XPROPOSTA'];
            $proposta2 = number_format($proposta2, 0, ',', '.');

            echo '<tr style="font-size:11px;text-align:center;margin-top:10px;">
             <td>' . $teste['XEMPRESA'] . '</td>
             <td>' . $teste['XREVENDA'] . '</td>
             <td>' . $proposta2 . '</td>
             <td>' . $numNota2 . '</td>
             <td>' . $teste['XTRANSACAO'] . '</td>
             <td>' . $teste['XDTNOTA'] . '</td>
             <td> VENDA ' . $teste['TIPO_VENDA'] . '</td>
             <td>' . $teste['XCHASSI'] . '</td>
             <td>' . $teste['XCODIGO_VEICULO'] . '</td>
             <td>' . $teste['XVENDEDOR'] . '</td>
             <td>-' . $valorVenda2 . '</td>
             </tr>';
          }
          //notas emitidas

          $valorVenda = $tabela['XVAL_VENDA_VEICULO'];
          $valorVenda = number_format($valorVenda, 2, ',', '.');

          $numNota = $tabela['XNRONOTA'];
          $numNota = number_format($numNota, 0, ',', '.');

          $proposta = $tabela['XPROPOSTA'];
          $proposta = number_format($proposta, 0, ',', '.');

          echo '<tr> <td colspan="14" >' . $linha . '</td></tr>';
          echo '<tr style="font-size:11px;text-align:center;">
             <td>' . $tabela['XEMPRESA'] . '</td>
             <td>' . $tabela['XREVENDA'] . '</td>
             <td>' . $proposta . '</td>
             <td>' . $numNota . '</td>
             <td>' . $tabela['XTRANSACAO'] . '</td>
             <td>' . $tabela['XDTNOTA'] . '</td>
             <td>' . $tabela['TIPO_VENDA'] . '</td>
             <td>' . $tabela['XCHASSI'] . '</td>
             <td>' . $tabela['XCODIGO_VEICULO'] . '</td>
             <td>' . $tabela['XVENDEDOR'] . '</td>
             <td>' . $valorVenda . '</td>
             </tr>';
        }
      } */
    }


    echo  '<tr>
            <td colspan="14">
              <span style="float:right;font-size:11px;margin-right:104px;margin-top: -1px;"><b>Total faturamentoFIM: </b></span>
            </td>
          </tr>';
    echo '</tbody>
    </table>';

    echo '
      </div>';
    echo '<p class="break"></p>'; /* Isso foi colocado apenas para melhorar a distribuição das informações na hora de imprimir. */
  }

  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>