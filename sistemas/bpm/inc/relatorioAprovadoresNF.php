<?php 
require_once('../config/query.php');

$aprovadores = "SELECT
a.APROVADOR_FILIAL,
a.APROVADOR_AREA,
a.APROVADOR_MARCA,
a.APROVADOR_SUPERINTENDENTE,
a.ID_EMPRESA,
a.ID_DEPARTAMENTO,
a.APROVADOR_GERENTE,
e.NOME_EMPRESA,
d.NOME_DEPARTAMENTO,
a.SITUACAO, 
a.*
FROM
bpm_nf_aprovadores a
INNER JOIN bpm_empresas e ON a.ID_EMPRESA = e.ID_EMPRESA
INNER JOIN bpm_nf_departamento d ON a.ID_DEPARTAMENTO = d.ID_DEPARTAMENTO";

$sucesso = $conn->query($aprovadores);


$arquivo = 'aprovadores_nf.xls';

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
                            <th>Area</th>
                            <th>Filial</th>
                            <th>Marca</th>                        
                            <th>Gerente</th>
                            <th>Superintendente</th>
                            <th>Situacao</th>
                        </tr>
                    </thead>
                    <tbody>";

        while (($row_relatorio = $sucesso->fetch_assoc()) != FAlSE) {
            $situacao = ($row_relatorio['SITUACAO'] == 'A') ? 'ATIVO' : 'DESATIVADO';
            $html .= "
                        <tr>";
            $html .=  empty($row_relatorio['NOME_EMPRESA']) ? '<td>----------</td>' : '<td>' . $row_relatorio['NOME_EMPRESA'] . '</td>';
            $html .=  empty($row_relatorio['NOME_DEPARTAMENTO']) ? '<td>----------</td>' : '<td>' . $row_relatorio['NOME_DEPARTAMENTO'] . '</td>';
            $html .=  empty($row_relatorio['APROVADOR_AREA']) ? '<td>----------</td>' : '<td>' . $row_relatorio['APROVADOR_AREA']  . '</td>';
            $html .=  empty($row_relatorio['APROVADOR_FILIAL']) ? '<td>----------</td>' : '<td>' . $row_relatorio['APROVADOR_FILIAL']  . '</td>';
            $html .=  empty($row_relatorio['APROVADOR_MARCA']) ? '<td>----------</td>' : '<td>' . $row_relatorio['APROVADOR_MARCA'] . '</td>';
            $html .=  empty($row_relatorio['APROVADOR_GERENTE']) ? '<td>----------</td>' : '<td>' . $row_relatorio['APROVADOR_GERENTE'] . '</td>';
            $html .=  empty($row_relatorio['APROVADOR_SUPERINTENDENTE']) ? '<td>----------</td>' : '<td>' . $row_relatorio['APROVADOR_SUPERINTENDENTE'] . '</td>';
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