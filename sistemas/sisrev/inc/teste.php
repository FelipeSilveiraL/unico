<?php
//reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;

session_start();

// instantiate and use the dompdf class
$dompdf = new Dompdf(['enable_remote' => true]);

//habilitado o acesso ao download de assets remotos - Para funcionar o Bootstrap
$options = new Options();

//habilitado o acesso ao download de assets remotos - Para funcionar o Bootstrap
$options->set('isRemoteEnabled', TRUE);

//habilitado o acesso ao download de assets remotos - Para funcionar o Bootstrap
$dompdf = new Dompdf($options);

//load body PDF
$dompdf->loadHtml($_SESSION['html']);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait'); // portrait = retrato, landscape = paisagem

// Render the HTML as PDF
$dompdf->render();

$dompdf->stream('relatorioComissoes.pdf', array("Attachment" => false));//true - Download false - Previa
$output = $dompdf->output();

/* file_put_contents('../documentos/COM/Relatorio_detalhado.pdf', $output); */

/* header('Location: ./relatorioApagar.php?pg='.$_GET['pg'].'&dataCom='.$dateCom.'&dataFim='.$dateFim.'&nome='.$nomeUsuario.''); */

?>