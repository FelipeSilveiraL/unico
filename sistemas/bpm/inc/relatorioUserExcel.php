<?php

//chamando o banco
require_once('../config/query.php');
require_once('../../../config/databases.php');
require_once('../../../config/sqlSmart.php');

$queryUserApi .= " ORDER BY DS_USUARIO ASC";
$execSmartUser = oci_parse($connSelbetti, $queryUserApi );
oci_execute($execSmartUser,OCI_COMMIT_ON_SUCCESS);


$arquivo = 'usuario_smartshare.xls';

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
                    <th>Id Regra</th>
                    <th>Usuário</th>
                    <th>Papel</th>
                    <th>E-mail</th>
                    <th>Login</th>
                    <th>Situação</th>
                </tr>
            </thead>
            <tbody>";

while($row_relatorio = oci_fetch_array($execSmartUser, OCI_ASSOC)){
    $html .= "
                            <tr>";
    $html .=  empty($row_relatorio['CD_USUARIO']) ? '<td>----------</td>' : '<td>' . $row_relatorio['CD_USUARIO'] . '</td>';
    $html .=  empty($row_relatorio['DS_USUARIO']) ? '<td>----------</td>' : '<td>' . $row_relatorio['DS_USUARIO'] . '</td>';
    $html .=  empty($row_relatorio['DS_PAPEL']) ? '<td>----------</td>' : '<td>' . $row_relatorio['DS_PAPEL'] . '</td>';
    $html .=  empty($row_relatorio['DS_EMAIL']) ? '<td>----------</td>' : '<td>' . $row_relatorio['DS_EMAIL']  . '</td>';
    $html .=  empty($row_relatorio['DS_LOGIN']) ? '<td>----------</td>' : '<td>' . $row_relatorio['DS_LOGIN']  . '</td>';
    $html .=  ($row_relatorio['ST_ATIVO'] == 1) ? '<td>Ativo</td>' : '<td>Desativado</td>';
    $html .= "
                            </tr>";
}
$html .= "
            </tbody>
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