<?php 
require_once('../config/query.php');

$custoEspecifico = "SELECT * FROM bpm_custo_veiculo";

$resultcxUs = $conn->query($custoEspecifico);

$arquivo = 'CUSTO_VEICULO.xls';
    
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
                                            <th>EMPRESA</th>
                                            <th>TIPO DE CUSTO</th>
                                            <th>ANO REFERÃŠNCIA</th>
                                            <th>CUSTO ERP</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
            while ($row_relatorio = $resultcxUs->fetch_assoc() ) {

                switch ($row_relatorio['TIPO_CUSTO']) {
                    case 'L':
                        $tipoCusto = 'Licenciamento';
                        break;                    
                    case 'M':
                        $tipoCusto = 'Multa';
                        break;
                    case 'T':
                        $tipoCusto = 'Triagem';
                        break;
                    case 'I':
                        $tipoCusto = 'IPVA';
                        break;    
                    default:
                        $tipoCusto = null;
                    break;  
                }

                $html .= "<tr>";
                    $html .=  empty($row_relatorio['NOME_EMPRESA']) ? '<td>----------</td>' : '<td>' . $row_relatorio['NOME_EMPRESA'] . '</td>';
                    $html .=  empty($tipoCusto) ? '<td>----------</td>' : '<td>' . $tipoCusto . '</td>';
                    $html .=  empty($row_relatorio['ANO_REFERENCIA']) ? '<td>----------</td>' : '<td>' . $row_relatorio['ANO_REFERENCIA'] . '</td>';
                    $html .=  empty($row_relatorio['CODIGO_CUSTO_ERP']) ? '<td>----------</td>' : '<td>' . $row_relatorio['CODIGO_CUSTO_ERP'] . '</td>';
                $html .= "</tr>";
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