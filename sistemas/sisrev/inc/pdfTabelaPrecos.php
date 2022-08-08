<?php

require '../../../vendor/autoload.php'; //autoload da biblioteca

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once('../config/query.php');


$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

if (!empty($_GET['empresa'])) {
  switch ($_GET['empresa']) {
    case '55':
      $tabela = 'sisrev_atualizacao_preco_triumph';
      $nomeEmpresa = 'Triumph';
      $data = [['Item', 'Descricao', 'Valor', 'Status', 'Valor Apollo'],];

      $queryListaPreco = "SELECT item, descricao, rrp as valor, status_item, rrp_apollo as valor_apollo FROM " . $tabela;
      $resultListaPreco = $conn->query($queryListaPreco);

      while ($listaPreco = $resultListaPreco->fetch_assoc()) {
        $data[] = array(
          $listaPreco['item'],
          $listaPreco['descricao'],
          'R$ ' . $listaPreco['valor'],
          'R$ ' . $listaPreco['valor_apollo'],
          $listaPreco['status_item'],
        );
      }
      break;

    case '56':
      $tabela = 'sisrev_atualizacao_preco_ducati';
      $nomeEmpresa = 'Ducati';
      $data = [['Item', 'Descricao', 'Valor', 'Status', 'Valor Apollo'],];

      $queryListaPreco = "SELECT item, descricao, rrp as valor, status_item, rrp_apollo as valor_apollo FROM " . $tabela;
      $resultListaPreco = $conn->query($queryListaPreco);

      while ($listaPreco = $resultListaPreco->fetch_assoc()) {
        $data[] = array(
          $listaPreco['item'],
          $listaPreco['descricao'],
          'R$ ' . $listaPreco['valor'],
          'R$ ' . $listaPreco['valor_apollo'],
          $listaPreco['status_item'],
        );
      }
      break;

    case '10':
      $tabela = 'sisrev_atualizacao_preco_honda';
      $nomeEmpresa = 'Honda';

      $data = [['Item', 'Descricao', 'Preco Avista', 'Preco Publico Atual', 'Preco Publico', 'Data Preco', 'Status']];

      $queryListaPreco = "SELECT * FROM " . $tabela;
      $resultListaPreco = $conn->query($queryListaPreco);

      while ($listaPreco = $resultListaPreco->fetch_assoc()) {
        $data[] = array(
          $listaPreco['item'],
          $listaPreco['descricao'],
          'R$ ' . $listaPreco['preco_avista'],
          'R$ ' . $listaPreco['preco_publico_atual'],
          'R$ ' . $listaPreco['preco_publico'],
          $listaPreco['dta_preco'],
          $listaPreco['status_item'],
        );
      }
  }

  $sheet->fromArray($data, null, 'A4');
  
  $sheet->setCellValue('A1', 'Lista de Preço - ' . $nomeEmpresa . '');
  $sheet->setCellValue('A2', 'Data/Hora: ' . date('d/m/Y - H:m') . '');
  
  $writer = new Xlsx($spreadsheet);
  $writer->save('../documentos/AP/relatorio.xlsx');
}