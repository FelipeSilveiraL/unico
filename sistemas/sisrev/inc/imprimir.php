<?php 

require_once('../../../config/session.php');
require_once('../../../config/databases.php');
require_once('../../../config/sqlSmart.php');

?><!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Impressão etiqueta</title>
    <style>
        .container {
            display: grid;
            grid-template-columns: 200px 200px;
            grid-column-gap: 20px;
            grid-row-gap: 20px;
            justify-items: stretch;
            align-items: stretch;
            font-size: small;
            font-family: Geneva, Tahoma, sans-serif;
        }

        .div23 {
            page-break-before: always;
            page-break-inside: avoid;
        }

        .div24 {
            page-break-before: always;
            page-break-inside: avoid;
        }

        .div48 {
            page-break-before: always;
            page-break-inside: avoid;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php

        if (isset($_POST['etiqueta'])) {
            $produto = $_POST['etiqueta'];
            $revenda = $_POST['revenda'];
        }
        
        $count = count($produto);

        if ($produto !== null) {

            foreach ($produto as $prod) {

                $qtde = substr($prod, 34, 3);
                $caixa = substr($prod, 26, 8);
                $nf = substr($prod, 20, 6);
                $empresa = substr($prod, 19, 1);
                $prod = substr($prod, 0, 19);
                $produtoSem = str_replace(' ', '', $prod);
                $produtoSem = str_replace('/', '', $produtoSem);


                $itemEstoque .= " WHERE ITEM_ESTOQUE_PUB LIKE '%" . $produtoSem . "%' AND EMPRESA = '" . $empresa . "'";

                
                $execApolloEstoque = oci_parse($connApollo, $itemEstoque);
                oci_execute($execApolloEstoque);
                
                $row = oci_fetch_array($execApolloEstoque, OCI_BOTH);

                $nome = $row['ITEM_ESTOQUE'];
                $xEmpresa = $row['EMPRESA'];

                $itemApollo .= " WHERE ITEM_ESTOQUE = '" . $nome . "' AND EMPRESA = '" . $xEmpresa . "' AND REVENDA = '" . $revenda . "'";
                
                $execApolloItem = oci_parse($connApollo, $itemApollo);

                oci_execute($execApolloItem);

                $endereco = oci_fetch_array($execApolloItem, OCI_BOTH);

                $LOCACAO_ZONA = $endereco['LOCACAO_ZONA'];
                $LOCACAO_RUA = $endereco['LOCACAO_RUA'];
                $LOCACAO_ESTANTE = $endereco['LOCACAO_ESTANTE'];
                $LOCACAO_PRATELEIRA = $endereco['LOCACAO_PRATELEIRA'];
                $ITEM_ESTOQUE = $endereco['ITEM_ESTOQUE'];
                $LOCACAO_NUMERO = $endereco['LOCACAO_NUMERO'];
                $EMPRESA = $endereco['EMPRESA'];
                $REVENDA = $endereco['REVENDA'];

                $i = 1;

                while ($i <= $qtde) {


                    echo '
                        <div class="div' . $i . '" font face="Verdana">
                        ' . $prod . ' <br>
                        &emsp;&emsp;&emsp;&emsp;NF&ensp;' . $nf . '<br>
                        &emsp;&emsp;&emsp;&emsp;' . $caixa . '<br>
                        ' . $LOCACAO_ZONA . '0' . $LOCACAO_RUA . '&emsp;0' . $LOCACAO_ESTANTE . '&emsp;' . $LOCACAO_PRATELEIRA . '0' . $LOCACAO_NUMERO . '<br>
                        
                        ';

                    echo "</div>";
                    $i++;
                }
            }
        }
        ?>
    </div>
</body>

</html>

<script>
window.onload = function () { window.print(); window.addEventListener("afterprint", function(event) { window.close(); });
    window.onafterprint(); } 
</script>