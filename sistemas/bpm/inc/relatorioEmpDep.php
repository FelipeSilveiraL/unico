<?php 
require_once('../config/query.php');

$empDepRH = "SELECT * FROM bpm_rh_emp_dep";

$sucesso = $conn->query($empDepRH);

$arquivo = 'empresa_departamento_rh.xls';

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
                            <th>Departamento</th>
                            <th>Situacao</th>
                            <th>Gerente Aprova</th>
                            <th>Superintendente Aprova</th>                               
                            <th>Lancar Multas</th>                     
                        </tr>
                    </thead>
                    <tbody>";

        while (($row_relatorio = $sucesso->fetch_assoc()) != FAlSE) {
            if ($row_relatorio['SITUACAO'] == 'A') {
                $situacao = 'ATIVO';
            } else {
                $situacao = 'DESATIVADO';
            }

            if ($row_relatorio['GERENTE_APROVA'] == 'S') {
                $gerAp = 'SIM';
            } else {
                $gerAp = 'NAO';
            }

            if ($row_relatorio['SUPERINTENDENTE_APROVA'] == 'S') {
                $supAp = 'SIM';
            } else {
                $supAp = 'NAO';
            }

            $html .= "
                        <tr>";
            $html .=  empty($row_relatorio['NOME_EMPRESA']) ? '<td>----------</td>' : '<td>' . $row_relatorio['NOME_EMPRESA'] . '</td>';
            $html .=  empty($row_relatorio['NOME_DEPARTAMENTO']) ? '<td>----------</td>' : '<td>' . $row_relatorio['NOME_DEPARTAMENTO'] . '</td>';
            $html .=  empty($situacao) ? '<td>----------</td>' : '<td>' . $situacao . '</td>';
            $html .=  empty($gerAp) ? '<td>----------</td>' : '<td>' . $gerAp . '</td>';
            $html .=  empty($supAp) ? '<td>----------</td>' : '<td>' . $supAp . '</td>';
            $html .=  empty($row_relatorio['LANCA_MULTAS']) ? '<td>----------</td>' : '<td>' . $row_relatorio['LANCA_MULTAS'] . '</td>';

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