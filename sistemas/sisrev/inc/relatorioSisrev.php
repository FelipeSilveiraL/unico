<?php
require_once ('../../../config/databases.php');
require_once ('../../../config/session.php');
require_once ('../../../config/sqlSmart.php');

$dateCom = $_GET['dateCom'];

$dateFim = $_GET['dateFim'];

?>
<!doctype html>
<html lang="en">

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
  $empresas = "SELECT NOME_EMPRESA,ID_EMPRESA,EMPRESA_APOLLO,REVENDA_APOLLO FROM EMPRESA WHERE ID_EMPRESA NOT IN (208) ORDER BY ID_EMPRESA ASC";

  $sucesso = oci_parse($connBpmgp, $empresas);

  oci_execute($sucesso, OCI_COMMIT_ON_SUCCESS);

  $anterior = NULL;
  
  
  $linha = null;
  while (($emp = oci_fetch_array($sucesso, OCI_ASSOC + OCI_RETURN_NULLS)) != FAlSE) {

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

    $vendas = "SELECT * FROM sisrev_notas_comissao ORDER BY ID ASC";

    $conexao = oci_parse($connBpmgp , $vendas);
    oci_execute($conexao, OCI_COMMIT_ON_SUCCESS);

    $anterior = null;
    $linha = null;

    //while da tabela sisrev_comissao
    while (($dadosComissao = oci_fetch_array($conexao, OCI_ASSOC)) != FAlSE) {

      $queryVendedor = "SELECT * FROM VENDEDORES WHERE CPF = " . $dadosComissao['XCPF'];
      $bpmCon = oci_parse($connBpmgp, $queryVendedor);
      oci_execute($bpmCon, OCI_COMMIT_ON_SUCCESS);

      if (($vendedorBPM = oci_fetch_array($bpmCon, OCI_ASSOC)) != FAlSE) {
        $numNota = $dadosComissao['XNRONOTA'];
        $numNota = number_format($numNota, 0, ',', '.');
        $nome = $vendedorBPM['NOME'];
        $nome = explode(' ', $nome);
        $nome = $nome[0] . ' ' . $nome[1] . ' ' . $nome[2];
        $valorVenda = $dadosComissao['XVAL_VENDA_VEICULO'];
        $valorVenda = number_format($valorVenda, 2, ',', '.');
        //se o vendedor for da mesma empresa de origem ele aparece na tabela

        if ($vendedorBPM['EMPRESA'] == $emp['ID_EMPRESA']) {
          //agora aqui ele separa se a nota fiscal do vendedor é da mesma empresa, se for ele desconsidera

          if ($dadosComissao['ID_EMPRESA'] != $emp['ID_EMPRESA']) {

            $queryCanceladas = "SELECT * FROM SISREV_COMISSAO_CANC WHERE XCODIGO_VEICULO = '" . $dadosComissao['XCODIGO_VEICULO'] . "' ";

            $canceladaConn = oci_parse($connBpmgp , $queryCanceladas);
            oci_execute($canceladaConn, OCI_COMMIT_ON_SUCCESS);

            while (($notaCancelada = oci_fetch_array($canceladaConn, OCI_ASSOC)) != FALSE) { //se encontrar ele ja vai listar junto como uma nota negativa

              $valorVenda2 = $notaCancelada['XVAL_VENDA_VEICULO'];
              $valorVenda2 = number_format($valorVenda2, 2, ',', '.');

              $queryTotal = "SELECT * FROM SISREV_COMISSAO_CANC WHERE XPROPOSTA = ".$dadosComissao['XPROPOSTA']."";

              $conexaoDeNovo = oci_parse($connBpmgp , $queryTotal);
              oci_execute($conexaoDeNovo, OCI_COMMIT_ON_SUCCESS);

              if($achou = oci_fetch_array($conexaoDeNovo, OCI_ASSOC)){
                $total = $valorVenda - $valorVenda2;
                $total = number_format($total, 0, ',', '.');
                $nome = $nomeVendedor['NOME'];
                $nome = explode(' ', $nome);
                $nome = $nome[0] . ' ' . $nome[1] . ' ' . $nome[2];
              }
              echo '<tr style="font-size: 11px;text-align:center;">
                  <td>' . $notaCancelada['XEMPRESA'] . '</td>
                  <td>' . $notaCancelada['XREVENDA'] . '</td>
                  <td>' . $notaCancelada['XPROPOSTA'] . '</td>
                  <td>' . $notaCancelada['XNRONOTA'] . '</td>
                  <td>' . $notaCancelada['XTRANSACAO'] . '</td>
                  <td>' . $notaCancelada['XDTNOTA'] . '</td>
                  <td>CANCELADA</td>
                  <td>' . $notaCancelada['XCHASSI'] . '</td>
                  <td>' . $notaCancelada['XCODIGO_VEICULO'] . '</td>
                  <td>' . $nome . '</td>
                  <td>-' . $valorVenda2 . '</td>';
            }

            $atual = $dadosComissao['ID_EMPRESA'];
           
            if (empty($anterior) ) {
              $anterior = $dadosComissao['ID_EMPRESA'];
              
            } else if ($anterior != $atual) {
              $linha = '<span style="float:right;font-size:11px;margin-right:185px;margin-top: -10px;"><b>Total faturamento: </b></span>';
              $anterior = $dadosComissao['ID_EMPRESA'];
               
            } else {
              $linha = '';
            }
            echo '<tr> <td colspan="11" >' . $linha . '</td></tr>';
            echo '<tr style="font-size:11px;text-align:center;">
            <td>' . $dadosComissao['XEMPRESA'] . '</td>
            <td>' . $dadosComissao['XREVENDA'] . '</td>
            <td>' . $dadosComissao['XPROPOSTA'] . '</td>
            <td>' . $dadosComissao['XNRONOTA'] . '</td>
            <td>' . $dadosComissao['XTRANSACAO'] . '</td>
            <td>' . $dadosComissao['XDTNOTA'] . '</td>
            <td>' . $dadosComissao['TIPO_VENDA'] . '</td>
            <td>' . $dadosComissao['XCHASSI'] . '</td>
            <td>' . $dadosComissao['XCODIGO_VEICULO'] . '</td>
            <td>' . $nome . '</td>
            <td>'.$hifen.'' . $valorVenda .'</td>
            </tr>';
            
          }
        }
      }
    }
    
    echo  '<tr><td colspan="11"><span style="float:right;font-size:11px;margin-right:185px"><b>Total faturamento: </b></span></td></tr>';
    echo '</tbody>
    
    </table>';
    
    echo '
      </div>
      <!-- Optional JavaScript; choose one of the two! -->
  
      <!-- Option 1: Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  
      <!-- Option 2: Separate Popper and Bootstrap JS -->
      <!--
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
      -->
        </body>
        
        </html>';
    echo '<p class="break">';
  }
  
  
  
  ?>