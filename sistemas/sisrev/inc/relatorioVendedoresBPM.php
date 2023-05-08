<?php 
require_once('../config/query.php');

$vendedoresQuery = "SELECT * FROM sisrev_comissao WHERE xvendedor = '0'";

$conexao = oci_parse($connBpmgp,$vendedoresQuery);

oci_execute($conexao,OCI_COMMIT_ON_SUCCESS);



$arquivo = 'vendedores_bpm.xls';

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
                                    <th>NOME VENDEDOR</th>
                                    <th>CPF</th>
                                </tr>
                            </thead>
                            <tbody>";
            $anterior = null;
            while($row = oci_fetch_array($conexao,OCI_ASSOC)){
                $cpf = $row['XCPF'];
                
                $query = "SELECT NOME FROM FAT_VENDEDOR WHERE CPF = ".$cpf;
                $conexaoApollo = oci_parse($connApollo, $query);
                oci_execute($conexaoApollo);
            
                if($row2 = oci_fetch_array($conexaoApollo, OCI_ASSOC)){
                    $nomeVendedor = $row2['NOME'];
                }

                if (empty($anterior)) {
                $anterior = $cpf;
                $html .= "<tr>";
                $html .=  empty($nomeVendedor) ? '<td>----------</td>' : '<td>' . $nomeVendedor . '</td>';
                $html .=  empty($cpf) ? '<td>----------</td>' : '<td>' . $cpf . '</td>';
                $html .= "</tr>";

                }else if ($anterior != $cpf) {
                $anterior = $cpf;

                $html .= "<tr>";
                $html .=  empty($nomeVendedor) ? '<td>----------</td>' : '<td>' . $nomeVendedor . '</td>';
                $html .=  empty($cpf) ? '<td>----------</td>' : '<td>' . $cpf . '</td>';
                $html .= "</tr>";
                }
            
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