<?php 
require_once('../config/query.php');

$seminovos = "SELECT * FROM bpm_seminovos";

$sucesso = $conn->query($seminovos);


$arquivo = 'fornecedores_seminovos.xls';

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
                                    <th>CNPJ</th>
                                    <th>RAZÃO SOCIAL</th>
                                    <th>CIDADE</th>
                                    <th>UF</th>
                                    <th>SMARTSHARE</th>
                                    <th>SMARTSHARE LOGIN</th>
                                    <th>E-MAIL</th>
                                    <th>RESPONSAVEL</th>
                                    <th>ATIVO</th>                   
                                </tr>
                            </thead>
                            <tbody>";
        while (($row_relatorio = $sucesso->fetch_assoc()) != FAlSE) {

            $html .= "<tr>";
            $html .=  empty($row_relatorio['CNPJ']) ? '<td>----------</td>' : '<td>' . $row_relatorio['CNPJ'] . '</td>';
            $html .=  empty($row_relatorio['RAZAO_SOCIAL']) ? '<td>----------</td>' : '<td>' . $row_relatorio['RAZAO_SOCIAL'] . '</td>';
            $html .=  empty($row_relatorio['CIDADE']) ? '<td>----------</td>' : '<td>' . $row_relatorio['CIDADE'] . '</td>';
            $html .=  empty($row_relatorio['UF']) ? '<td>----------</td>' : '<td>' . $row_relatorio['UF'] . '</td>';
            $html .=  empty($row_relatorio['SMARTSHARE']) ? '<td>----------</td>' : '<td>' . $row_relatorio['SMARTSHARE'] . '</td>';
            $html .=  empty($row_relatorio['SMARTSHARE_LOGIN']) ? '<td>----------</td>' : '<td>' . $row_relatorio['SMARTSHARE_LOGIN'] . '</td>';
            $html .=  empty($row_relatorio['EMAIL']) ? '<td>----------</td>' : '<td>' . $row_relatorio['EMAIL'] . '</td>';
            $html .=  empty($row_relatorio['NOME_RESPONSAVEL']) ? '<td>----------</td>' : '<td>' . $row_relatorio['NOME_RESPONSAVEL'] . '</td>';
            $html .=  empty($row_relatorio['ATIVO']) ? '<td>----------</td>' : '<td>' . $row_relatorio['ATIVO'] . '</td>';

            $html .= "</tr>";
        }
        $html .= "</tbody>
                        </table>
                    </body>
                </html>";

        // Configurações header para forçar o download
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: application/x-msexcel");
        header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
        header("Content-Description: PHP Generated Data");
        // Envia o conteúdo do arquivo
        echo $html;

?>