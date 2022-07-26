<?php

require '../../../vendor/autoload.php'; //autoload da biblioteca

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once('../config/query.php');

switch ($_GET['empresa']) {
    case '55':
      $tabela = 'sisrev_atualizacao_preco_triumph';
      $nomeEmpresa = 'Triumph';
      break;
    case '56':
      $tabela = 'sisrev_atualizacao_preco_ducati';
      $nomeEmpresa = 'Ducati';
      break;
    default:
      $tabela = 'sisrev_atualizacao_preco_triumph';
      $nomeEmpresa = 'Triumph';
  }
 
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$data = [ ['Item','Descricao', 'Valor', 'Status', 'Valor Apollo'], ];

$queryListaPreco = "SELECT item, descricao, rrp as valor, status_item, rrp_apollo as valor_apollo FROM " . $tabela;
$resultListaPreco = $conn->query($queryListaPreco);

while ($listaPreco = $resultListaPreco->fetch_assoc()) {
$data[] = array(
    $listaPreco['item'] ,
    $listaPreco['descricao'],
    'R$ ' . $listaPreco['valor'],
    'R$ ' . $listaPreco['valor_apollo'],  
    $listaPreco['status_item'], 
);
}
 
$sheet->fromArray($data, null, 'A4');

$sheet->setCellValue('A1','Lista de Preço - '.$nomeEmpresa.'');
$sheet->setCellValue('A2','Data/Hora: '.date('d/m/Y - H:m').'');
 
$writer = new Xlsx($spreadsheet);
$writer->save('../documentos/AP/relatorio.xlsx');