<?php

require_once('../config/query.php');

$queryRateio = "SELECT 
ID_CENTROCUSTO,
PERCENTUAL
FROM
    cad_rateiocentrocusto
WHERE
    ID_RATEIOFORNECEDOR = (SELECT 
        id
    FROM
        cad_rateiofornecedor
    WHERE
        cpfcnpj_fornecedor = '" . $_GET['cnpj'] . "'
            AND filial = '1.1 SERVOPA MATRIZ'
            AND id_usuario = '3')";

?>

<table>
    <tr>
        <td style="border: solid 1px; padding: 5px; text-align: center; " colspan="2">CENTRO DE CUSTO</td>
    </tr>

    <?php

    while ($custoCentro = $result->fetch_assoc()) {
        echo '<tr>
                    <td style="border: solid 1px; padding: 5px; ">' . $custoCentro['ID_CENTROCUSTO'] . '</td>
                    <td style="border: solid 1px; padding: 5px; ">' . $custoCentro['PERCENTUAL'] . '%</td>
                </tr>';
    }
    ?>
    <tr>
        <td colspan="2" style="border: solid 1px; padding: 5px; ">Data: _____/_____/_____</td>
    </tr>
    <tr>
        <td colspan="2" style="border: solid 1px; padding: 5px; ">Responsável: _________________________</td>
    </tr>
    <tr>
        <td colspan="2" style="border: solid 1px; padding: 5px; ">Diretoria: _________________________</td>
    </tr>
</table>