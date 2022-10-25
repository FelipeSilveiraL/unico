<?php 
require_once('../config/query.php');
$contasBancarias = "SELECT * FROM bpm_contas_bancarias";

$sucesso = $conn->query($contasBancarias);

// Criamos uma tabela HTML com o formato da planilha
$arquivo = 'contas_bancarias_fornecedor.xls';

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
                                        <th>CNPJ / CPF</th>
                                        <th>BANCO</th>
                                        <th>AGENCIA</th>
                                        <th>CONTA</th>
                                        <th>DIGITO</th>                   
                                    </tr>
                                </thead>
                                <tbody>";
        while (($row_relatorio = $sucesso->fetch_assoc()) != FAlSE) {

            $html .= "<tr>";
                $html .=  empty($row_relatorio['CNPJ_CPF']) ? '<td>----------</td>' : '<td>' . $row_relatorio['CNPJ_CPF'] . '</td>';
                $html .=  empty($row_relatorio['BANCO']) ? '<td>----------</td>' : '<td>' . $row_relatorio['BANCO'] . '</td>';
                $html .=  empty($row_relatorio['AGENCIA']) ? '<td>----------</td>' : '<td>' . $row_relatorio['AGENCIA'] . '</td>';
                $html .=  empty($row_relatorio['CONTA']) ? '<td>----------</td>' : '<td>' . $row_relatorio['CONTA'] . '</td>';
                $html .=  empty($row_relatorio['DIGITO']) ? '<td>----------</td>' : '<td>' . $row_relatorio['DIGITO'] . '</td>';
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