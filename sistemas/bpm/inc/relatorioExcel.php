<?php

//chamando o banco
require_once('../config/query.php');

$relatorioExcel .= "ORDER BY NOME_EMPRESA ASC";
$resultado = $conn->query($relatorioExcel);
$arquivo = 'empresas.xls';

// Criamos uma tabela HTML com o formato da planilha
$html = "
<html>
    <style>
        td{
            border: solid 1px;
        }
    </style>
    <body>
        <table class='table table-sm' style='font-size:12px;'>
        <thead>
            <tr>				
                <th>Empresa</th>
                <th>Sistema</th>
                <th>Empresa Apollo</th>
                <th>Revenda Apollo</th>
                <th>Empresa NBS</th>
                <th>Organograma Senior</th>
                <th>Empresa Senior</th>
                <th>Filial Senior</th>
                <th>Consorcio</th>
                <th>Situacao</th>
            </tr>
        </thead>
        <tbody>";
        while (($row_relatorio = $resultado->fetch_assoc()) != FAlSE) {
            
            $situacao = ($row_relatorio['SITUACAO'] == 'A') ? 'ATIVO' : 'DESATIVADO';
            $consorcio = ($row_relatorio['CONSORCIO'] == 'S') ? 'SIM' : 'NAO';

            switch ($row_relatorio['SISTEMA']) {
                case 'A':
                    $sistema = 'APOLLO';
                    break;
                case 'N':
                    $sistema = 'BANCO NBS';
                    break;
                case 'H':
                    $sistema = 'BANCO HARLEY';
                    break;
                case ' ':
                    $sistema = 'NAO USA E.R.P';
                    break;
            }

            $html .= "
                    <tr>";
            $html .=  empty($row_relatorio['NOME_EMPRESA']) ? '<td>----------</td>' : '<td>' . $row_relatorio['NOME_EMPRESA'] . '</td>';
            $html .=  empty($sistema) ? '<td>----------</td>' : '<td>' . $sistema . '</td>';
            $html .=  empty($row_relatorio['EMPRESA_APOLLO']) ? '<td>----------</td>' : '<td>' . $row_relatorio['EMPRESA_APOLLO'] . '</td>';
            $html .=  empty($row_relatorio['REVENDA_APOLLO']) ? '<td>----------</td>' : '<td>' . $row_relatorio['REVENDA_APOLLO'] . '</td>';
            $html .=  empty($row_relatorio['EMPRESA_NBS']) ? '<td>----------</td>' : '<td>' . $row_relatorio['EMPRESA_NBS'] . '</td>';
            $html .=  empty($row_relatorio['ORGANOGRAMA_SENIOR']) ? '<td>----------</td>' : '<td>' . $row_relatorio['ORGANOGRAMA_SENIOR'] . '</td>';
            $html .=  empty($row_relatorio['EMPRESA_SENIOR']) ? '<td>----------</td>' : '<td>' . $row_relatorio['EMPRESA_SENIOR'] . '</td>';
            $html .=  empty($row_relatorio['FILIAL_SENIOR']) ? '<td>----------</td>' : '<td>' . $row_relatorio['FILIAL_SENIOR'] . '</td>';
            $html .=  empty($consorcio) ? '<td>----------</td>' : '<td>' . $consorcio . '</td>';
            $html .=  empty($situacao) ? '<td>----------</td>' : '<td>' . $situacao . '</td>';

            $html .= "
                    </tr>";
        }
        $html .= "</tbody>
        </table>
    </body>
</html>";

// ConfiguraÃ§Ãµes header para forÃ§ar o download
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: application/x-msexcel");
header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
header("Content-Description: PHP Generated Data");
// Envia o conteÃºdo do arquivo
echo $html;

?>