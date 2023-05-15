<?php
session_start();

//reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;


//chamando ele pelo autoload do vendor
require_once('../../../vendor/autoload.php');
require_once('../../../config/databases.php');
require_once('../../../config/sqlSmart.php');
require_once('../config/query.php');


$dateCom = $_GET['dateCom'];

$dateFim = $_GET['dateFim'];

$today = date('d/m/y H:i');

$nomeUsuario = $_GET['nome'];

$html = '
<!doctype html>
<html lang="pt-br">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Relatório detalhado</title>
</head>

<style>
  .break {
    page-break-before: always;
  }
</style>

<body>';

$empresas = "SELECT * FROM EMPRESA WHERE ID_EMPRESA NOT IN (208) ORDER BY ID_EMPRESA ASC";

$sucesso = oci_parse($connBpmgp, $empresas);
oci_execute($sucesso);

while ($emp = oci_fetch_array($sucesso, OCI_ASSOC)) {

  $anterior = NULL;

  $id_empresa = $emp['ID_EMPRESA'];  

  $html .= '<div id="tabelaComissao' . $emp['ID_EMPRESA'] . '"';
  // Verificar se o valor está zerado
  if ($valor == 0) {
    $html .= ' style="display: none;"'; // Ocultar a classe TabelaComissao
  } 
  $html .= '><br>';

  $html .= '
        <p style="text-align: center;">COMISSAO REVENDAS USADOS</p>
        <p style="text-align:center;"> PERÍODO: ' . $dateCom . '  A ' . $dateFim . '  </p>
        <span style="text-align:center;font-size: 10px;">Emitido por: ' . $nomeUsuario . '</span>
        <p style="padding-left:10px;">EMPRESA ORIGEM: ' . $emp['NOME_EMPRESA'] . '  <span style="float:right;padding-right:10px;">EMISSÃO: ' . $today . '</span> </p>
        <table class="table table-borderless">
      <thead>
        <tr style="text-align: center; font-size: 10px">
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
  oci_execute($conexao, OCI_COMMIT_ON_SUCCESS);

  //while da tabela sisrev_comissao
  while ($tabela = oci_fetch_array($conexao, OCI_ASSOC)) {

    if ($tabela['XEMPRESA_VENDEDOR'] == $id_empresa and $tabela['ID_EMPRESA'] != $id_empresa) {

      if ($tabela['XEMPRESA'] != $emp['EMPRESA_APOLLO']) {

        if (empty($anterior)) {

          $anterior = $tabela['ID_EMPRESA'];
        } else if ($anterior == $tabela['ID_EMPRESA']) {
          // Não exibe a linha de total de faturamento aqui
        } else {
          // Exibe a linha de total de faturamento aqui
          $html .= '<tr>
                    <td colspan="14">
                      <span style="font-size:9px;margin-top: 8px;"><b>__________________________________________________________________________________________________________________________ Total Faturamento: R$ <span id="valorTotal' . $emp['ID_EMPRESA'] . '">' . number_format($valor, 2, ',', '.') . '</span></span>
                    </td>
                  </tr>';

          $anterior = $tabela['ID_EMPRESA'];
          unset($valor);
        }
        $valorVeiculo = $tabela['XVAL_VENDA_VEICULO'];
        $valorVeiculo = floatval($valorVeiculo);

        $html .= '<tr style="font-size: 10px;text-align:center;margin-top:10px;">
                  <td>' . $tabela['XEMPRESA'] . '</td>
                  <td>' . $tabela['XREVENDA'] . '</td>
                  <td>' . number_format($tabela['XPROPOSTA'], 0, ',', '.') . '</td>
                  <td>' . number_format($tabela['XNRONOTA'], 0, ',', '.') . '</td>
                  <td>' . $tabela['XTRANSACAO'] . '</td>
                  <td>' . $tabela['XDTNOTA'] . '</td>
                  <td style="text-align:left;">' . $tabela['TIPO_VENDA'] . '</td>
                  <td>' . $tabela['XCHASSI'] . '</td>
                  <td>' . $tabela['XCODIGO_VEICULO'] . '</td>
                  <td style="text-align:left;">' . $tabela['XVENDEDOR'] . '</td>
                  <td>' . 'R$ ' . number_format($valorVeiculo, 2, ',', '.') . '</td>
                </tr>';

        $valor += $valorVeiculo;

        if (!empty($tabela['ID_CAN'])) { //mostrar as canceladas

          $valorVeiculoCAN = $tabela['VAL_VENDA_VEICULO_CAN'];
          $valorVeiculoCAN = floatval($valorVeiculoCAN);

          $html .= '<tr style="font-size: 10px;text-align:center;margin-top:10px;">
                    <td>' . $tabela['EMPRESA_CAN'] . '</td>
                    <td>' . $tabela['REVENDA_CAN'] . '</td>
                    <td>' . number_format($tabela['PROPOSTA_CAN'], 0, ',', '.') . '</td>
                    <td>' . number_format($tabela['NRONOTA_CAN'], 0, ',', '.') . '</td>
                    <td>' . $tabela['TRANSACAO_CAN'] . '</td>
                    <td>' . $tabela['DTNOTA_CAN'] . '</td>
                    <td style="text-align:left;">' . $tabela['TIPO_VENDA_CAN'] . '</td>
                    <td>' . $tabela['CHASSI_CAN'] . '</td>
                    <td>' . $tabela['CODIGO_VEICULO_CAN'] . '</td>
                    <td style="text-align:left;">' . $tabela['VENDEDOR_CAN'] . '</td>
                    <td>' . 'R$ ' . number_format($valorVeiculoCAN, 2, ',', '.') . '</td>
                  </tr>';

          $valor += $valorVeiculoCAN;
        }
      }
    }
  }

  $html .= '<tr>
            <td colspan="14">
              <span style="font-size:9px;"><b>_________________________________________________________________________________________________________  Total Faturamento: R$ <span id="valorTotal' . $emp['ID_EMPRESA'] . '">' . number_format($valor, 2, ',', '.')  . '</span></span>
            </td>
          </tr>';

  oci_free_statement($conexao);

  $html .= '
        </tbody>
      </table>
    </div>
    <p class="break"></p>'; /* Isso foi colocado apenas para melhorar a distribuição das informações na hora de imprimir. */

  unset($valor);
}


oci_free_statement($sucesso);

$html .= '
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>';

oci_close($connBpmgp);


/* echo $teste;
exit; */
// instantiate and use the dompdf class
$dompdf = new Dompdf();

//habilitado o acesso ao download de assets remotos - Para funcionar o Bootstrap
$options = new Options();

// Habilitar o acesso a assets remotos
$options->set('isRemoteEnabled', true);

 // Habilitar a execução de JavaScript
$options->set('isJavascriptEnabled', true);

//habilitado o acesso ao download de assets remotos - Para funcionar o Bootstrap
$dompdf = new Dompdf($options);

//load body PDF
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait'); // portrait = retrato, landscape = paisagem

// Render the HTML as PDF
$dompdf->render();

$dompdf->stream('relatorioComissoes.pdf', array("Attachment" => false)); //true - Download false - Previa
$output = $dompdf->output();

/* file_put_contents('../documentos/COM/Relatorio_detalhado.pdf', $output);

header('Location: ./relatorioApagar.php?pg='.$_GET['pg'].'&dataCom='.$dateCom.'&dataFim='.$dateFim.'&nome='.$nomeUsuario.''); */