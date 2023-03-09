<?php 
require_once('../config/query.php');

$caixaNF = "SELECT 
                 CNF.ID, CNF.NOME_EMPRESA, CNF.ID_EMPRESA, CNF.USUARIO_CAIXA, CNF.ID_CAIXA_EMPRESA, CE.nome_caixa
                  FROM
                      unico.bpm_caixa_nf CNF
                  LEFT JOIN bpm_caixa_empresa CE ON (CNF.id_caixa_empresa = CE.id_caixa_empresa) ";

$sucesso = $conn->query($caixaNF);

$arquivo = 'usuarios_caixa.xls';

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
                            <th>ID EMPRESA</th>
                            <th>USUARIO CAIXA</th>
                            <th>NOME CAIXA</th>
                            <th>Superintendente Aprova</th>                               
                            <th>Lancar Multas</th>                     
                        </tr>
                    </thead>
                    <tbody>";

        while (($row_relatorio = $sucesso->fetch_assoc()) != FAlSE) {
           

            $html .= "
                        <tr>";
            $html .=  empty($row_relatorio['NOME_EMPRESA']) ? '<td>----------</td>' : '<td>' . $row_relatorio['NOME_EMPRESA'] . '</td>';
            $html .=  empty($row_relatorio['ID_EMPRESA']) ? '<td>----------</td>' : '<td>' . $row_relatorio['ID_EMPRESA'] . '</td>';
            $html .=  empty($row_relatorio['USUARIO_CAIXA']) ? '<td>----------</td>' : '<td>' . $row_relatorio['USUARIO_CAIXA'] . '</td>';
            $html .=  empty($row_relatorio['NOME_CAIXA']) ? '<td>----------</td>' : '<td>' . $row_relatorio['NOME_CAIXA'] . '</td>';
           
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