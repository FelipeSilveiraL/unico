<?php

if ($_SESSION['count'] != null) {

  $displayOne = 'none';
  $displayTwo = 'block';
  $displayThree = 'none';
} else {

  if ($_GET['msn'] == 11) {
    $displayOne = 'none';
    $displayTwo = 'none';
    $displayThree = 'block';
  } else {
    $displayOne = 'block';
    $displayTwo = 'none';
    $displayThree = 'none';
  }
}

//verificando se tem arquivo esperando ser finalizado!
$queryIsNullPE = "SELECT id FROM sisrev_politicamente_exposto WHERE atualizado = 0";
$resultIsNullPE = $conn->query($queryIsNullPE);
$isnullpe = $resultIsNullPE->fetch_assoc();

if ($_GET['msn'] != 11) {
  if ($isnullpe['id'] != NULL and $_GET['msn'] != 12 and $_SESSION['count'] == null) {
    echo '<script>window.location.href = "politicamente_exposto.php?pg=' . $_GET['pg'] . '&tela=' . $_GET['tela'] . '&msn=12"</script>';
  }
}

//querys
//importados GERAL
$queryQuantidade = "SELECT COUNT(id) as quantidade FROM sisrev_politicamente_exposto";
$resultImportados = $conn->query($queryQuantidade);
$importados = $resultImportados->fetch_assoc();

//encontrados APOLLO
$queryQuantidadeES = "SELECT COUNT(id) as quantidade FROM sisrev_politicamente_exposto WHERE apollo = 'S'";
$resultImportadosES = $conn->query($queryQuantidadeES);
$importadosES = $resultImportadosES->fetch_assoc();

//não encontrados APOLLO
$queryQuantidadeNE = "SELECT COUNT(id) as quantidade FROM sisrev_politicamente_exposto WHERE apollo = 'N'";
$resultImportadosNE = $conn->query($queryQuantidadeNE);
$importadosNE = $resultImportadosNE->fetch_assoc();

//não alterados APOLLO
$queryQuantidadeNA = "SELECT COUNT(id) as quantidade FROM sisrev_politicamente_exposto WHERE apollo IS NULL";
$resultImportadosNA = $conn->query($queryQuantidadeNA);
$importadosNA = $resultImportadosNA->fetch_assoc();


//encontrados NBS
$queryQuantidadeNES = "SELECT COUNT(id) as quantidade FROM sisrev_politicamente_exposto WHERE nbs = 'S'";
$resultImportadosNES = $conn->query($queryQuantidadeNES);
$importadosNES = $resultImportadosNES->fetch_assoc();
//não encontrados nbs
$queryQuantidadeNNE = "SELECT COUNT(id) as quantidade FROM sisrev_politicamente_exposto WHERE nbs = 'N'";
$resultImportadosNNE = $conn->query($queryQuantidadeNNE);
$importadosNNE = $resultImportadosNNE->fetch_assoc();
//não alterados nbs
$queryQuantidadeNNA = "SELECT COUNT(id) as quantidade FROM sisrev_politicamente_exposto WHERE nbs IS NULL";
$resultImportadosNNA = $conn->query($queryQuantidadeNNA);
$importadosNNA = $resultImportadosNNA->fetch_assoc();


//encontrados nbs_ribeirao
$queryQuantidadeNRES = "SELECT COUNT(id) as quantidade FROM sisrev_politicamente_exposto WHERE nbs_ribeirao = 'S'";
$resultImportadosNRES = $conn->query($queryQuantidadeNRES);
$importadosNRES = $resultImportadosNRES->fetch_assoc();
//não encontrados nbs_ribeirao
$queryQuantidadeNRNE = "SELECT COUNT(id) as quantidade FROM sisrev_politicamente_exposto WHERE nbs_ribeirao = 'N'";
$resultImportadosNRNE = $conn->query($queryQuantidadeNRNE);
$importadosNRNE = $resultImportadosNRNE->fetch_assoc();
//não alterados nbs_ribeirao
$queryQuantidadeNRNA = "SELECT COUNT(id) as quantidade FROM sisrev_politicamente_exposto WHERE nbs_ribeirao IS NULL";
$resultImportadosNRNA = $conn->query($queryQuantidadeNRNA);
$importadosNRNA = $resultImportadosNRNA->fetch_assoc();

//TABELA

$tabelaRel = '<tr style="font-size: 15px">
                <th scope="row">1</th>
                <td>APOLLO</td>
                <td><span class="badge bg-info">' . $importados['quantidade'] . '</span></td>
                <td><span class="badge bg-success">' . $importadosES['quantidade'] . '</span></td>
                <td><span class="badge bg-warning">' . $importadosNE['quantidade'] . '</span></td>
                <td><span class="badge bg-danger">' . $importadosNA['quantidade'] . '</span></td>
              </tr>
              <tr style="font-size: 15px">
                <th scope="row">1</th>
                <td>NBS</td>
                <td><span class="badge bg-info">' . $importados['quantidade'] . '</span></td>
                <td><span class="badge bg-success">' . $importadosNES['quantidade'] . '</span></td>
                <td><span class="badge bg-warning">' . $importadosNNE['quantidade'] . '</span></td>
                <td><span class="badge bg-danger">' . $importadosNNA['quantidade'] . '</span></td>
              </tr>
              <tr style="font-size: 15px">
                <th scope="row">1</th>
                <td>NBS RIBEIRÂO</td>
                <td><span class="badge bg-info">' . $importados['quantidade'] . '</span></td>
                <td><span class="badge bg-success">' . $importadosNRES['quantidade'] . '</span></td>
                <td><span class="badge bg-warning">' . $importadosNRNE['quantidade'] . '</span></td>
                <td><span class="badge bg-danger">' . $importadosNRNA['quantidade'] . '</span></td>
              </tr>';
