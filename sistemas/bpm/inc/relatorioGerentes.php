<?php 
require_once('../config/query.php');

$gerentes = "SELECT * FROM bpm_gerentes";

$sucesso = $conn->query($gerentes);


$arquivo = 'gerentes.xls';

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
                        <th>ID_GERENTE</th>                                         
                        <th>EMPRESA</th>                        
                        <th>DEPARTAMENTO</th>
                        <th>CPF</th>
                        <th>LOGIN_SMARTSHARE</th>                        
                        <th>CODIGO_LOGIN_SMARTSHARE</th>
                        <th>Situacao</th>
                        </tr>
                    </thead>
                    <tbody>";

        while (($row_relatorio = $sucesso->fetch_assoc()) != FAlSE) {
            $situacao = ($row_relatorio['SITUACAO'] == 'A') ? 'ATIVO' : 'DESATIVADO';
            $html .= "
                <tr>";
                $html .=  empty($row_relatorio['ID_GERENTE']) ? '<td>----------</td>' : '<td>' . $row_relatorio['ID_GERENTE'] . '</td>';
                $html .=  empty($row_relatorio['EMPRESA']) ? '<td>----------</td>' : '<td>' . $row_relatorio['EMPRESA'] . '</td>';
                $html .=  empty($row_relatorio['DEPARTAMENTO']) ? '<td>----------</td>' : '<td>' . $row_relatorio['DEPARTAMENTO']  . '</td>';
                $html .=  empty($row_relatorio['CPF']) ? '<td>----------</td>' : '<td>' . $row_relatorio['CPF']  . '</td>';
                $html .=  empty($row_relatorio['LOGIN_SMARTSHARE']) ? '<td>----------</td>' : '<td>' . $row_relatorio['LOGIN_SMARTSHARE'] . '</td>';
                $html .=  empty($row_relatorio['CODIGO_LOGIN_SMARTSHARE']) ? '<td>----------</td>' : '<td>' . $row_relatorio['CODIGO_LOGIN_SMARTSHARE'] . '</td>';
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
        $conn->close();

?>