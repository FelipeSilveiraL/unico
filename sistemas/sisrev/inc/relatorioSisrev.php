<?php
require_once('../../../config/databases.php');
require_once('../../../config/session.php');
require_once('../../../config/sqlSmart.php');
require_once('../config/query.php');

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
  oci_execute($sucesso);

  while ($emp = oci_fetch_array($sucesso, OCI_ASSOC)) {

    $anterior = NULL;

    $id_empresa = $emp['ID_EMPRESA'];

    echo '<div><br>
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

    $conexao = oci_parse($connBpmgp, $vendas);
    oci_execute($conexao);

    //while da tabela sisrev_comissao
    while ($tabela = oci_fetch_array($conexao, OCI_ASSOC)) {

      if ($tabela['XEMPRESA_VENDEDOR'] == $id_empresa and $tabela['ID_EMPRESA'] != $id_empresa) {
        echo '<tr style="font-size:11px;text-align:center;margin-top:10px;">
                <td>' . $tabela['XEMPRESA'] . '</td>
                <td>' . $tabela['XREVENDA'] . '</td>
                <td>' . number_format($tabela['XPROPOSTA'], 0, ',', '.') . '</td>
                <td>' . number_format($tabela['XNRONOTA'], 0, ',', '.') . '</td>
                <td>' . $tabela['XTRANSACAO'] . '</td>
                <td>' . $tabela['XDTNOTA'] . '</td>
                <td>' . $tabela['TIPO_VENDA'] . '</td>
                <td>' . $tabela['XCHASSI'] . '</td>
                <td>' . $tabela['XCODIGO_VEICULO'] . '</td>
                <td>' . $tabela['XVENDEDOR'] . '</td>
                <td>' . 'R$ ' . number_format($tabela['XVAL_VENDA_VEICULO'], 2, ',', '.') . '</td>
              </tr>';

        if (!empty($tabela['ID_CAN'])) { //mostrar as canceladas

          echo '<tr style="font-size:11px;text-align:center;margin-top:10px;">
                  <td>' . $tabela['EMPRESA_CAN'] . '</td>
                  <td>' . $tabela['REVENDA_CAN'] . '</td>
                  <td>' . number_format($tabela['PROPOSTA_CAN'], 0, ',', '.') . '</td>
                  <td>' . number_format($tabela['NRONOTA_CAN'], 0, ',', '.') . '</td>
                  <td>' . $tabela['TRANSACAO_CAN'] . '</td>
                  <td>' . $tabela['DTNOTA_CAN'] . '</td>
                  <td>' . $tabela['TIPO_VENDA_CAN'] . '</td>
                  <td>' . $tabela['CHASSI_CAN'] . '</td>
                  <td>' . $tabela['CODIGO_VEICULO_CAN'] . '</td>
                  <td>' . $tabela['VENDEDOR_CAN'] . '</td>
                  <td>' . 'R$ -' . number_format($tabela['VAL_VENDA_VEICULO_CAN'], 2, ',', '.') . '</td>
                </tr>';
        }
      }
    }

    oci_free_statement($conexao);

    echo '
        </tbody>
      </table>
    </div>
    <p class="break"></p>'; /* Isso foi colocado apenas para melhorar a distribuição das informações na hora de imprimir. */
  }

  oci_free_statement($sucesso);

  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>

<?php
oci_close($connBpmgp);
?>