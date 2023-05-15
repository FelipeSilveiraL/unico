<?php
//chamando ele pelo autoload do vendor
require_once('../../../vendor/autoload.php');
require_once('../../../config/databases.php');
require_once('../../../config/sqlSmart.php');
require_once('../config/query.php');

//reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;

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