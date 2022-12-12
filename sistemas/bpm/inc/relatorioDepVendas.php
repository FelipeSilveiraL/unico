<?php 
require_once('../config/query.php');

$gerentes = "SELECT * FROM bpm_departamento_vendas";

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
                        <th>ID_DEPARTAMENTO</th>                                         
                        <th>NOME_DEPARTAMENTO</th>                        
                        
                        <th>Situacao</th>
                        </tr>
                    </thead>
                    <tbody>";

        while (($row_relatorio = $sucesso->fetch_assoc()) != FAlSE) {
            $situacao = ($row_relatorio['SITUACAO'] == 'A') ? 'ATIVO' : 'DESATIVADO';
            $html .= "
                <tr>";
                $html .=  empty($row_relatorio['ID_DEPARTAMENTO']) ? '<td>----------</td>' : '<td>' . $row_relatorio['ID_DEPARTAMENTO'] . '</td>';
                $html .=  empty($row_relatorio['NOME_DEPARTAMENTO']) ? '<td>----------</td>' : '<td>' . $row_relatorio['NOME_DEPARTAMENTO'] . '</td>';
              
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