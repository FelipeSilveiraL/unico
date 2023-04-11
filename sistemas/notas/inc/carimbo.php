<?php
require_once('../../../config/databases.php');

if ($_GET['cnpj'] == 1) { //smartshare
    $where = "cpfcnpj_fornecedor = '" . $_GET['idFornecedor'] . "' AND ";
    $selec = "ID_FILIAL = (";

    $queryEmpresa = "SELECT ID_EMPRESA FROM empresa WHERE CNPJ = '" . $_GET['filial'] . "' AND SITUACAO = 'A'";
    $resultado = oci_parse($connBpmgp, $queryEmpresa);
    oci_execute($resultado);

    while ($row = oci_fetch_array($resultado, OCI_ASSOC)) {
        $selec .= $row['ID_EMPRESA'];
    }
    oci_free_statement($resultado);
    $selec .= ") ";
} else { //fluig

    $where = "id_fornecedor = '" . $_GET['idFornecedor'] . "' AND ";
    $selec = "ID_FILIAL = (SELECT ID_FILIAL FROM cad_filial WHERE CNPJ = '" . $_GET['filial'] . "' LIMIT 1) ";
}

$queryRateio = "SELECT 
                    CR.percentual,
                    CR.ID_CENTROCUSTO_BPM
                FROM
                    cad_rateiocentrocusto CR
                WHERE
                CR.ID_RATEIOFORNECEDOR = (SELECT 
                        ID_RATEIOFORNECEDOR
                    FROM
                        cad_rateiofornecedor
                    WHERE ";
$queryRateio .= $where;

$queryRateio .= "
                        ID_USUARIO = (SELECT 
                                id_usuario
                            FROM
                                unico.usuarios
                            WHERE
                                email = '" . $_GET['email'] . "') AND
                        ";
$queryRateio .= $selec;

$queryRateio .= "       
                                LIMIT 1)";

$result = $connNOTAS->query($queryRateio);

/* echo $queryRateio; */

?>

<table>
    <tr>
        <td style="border: solid 1px; padding: 5px; text-align: center; " colspan="2">CENTRO DE CUSTO</td>
    </tr>

    <?php

    while ($custoCentro = $result->fetch_assoc()) {

        //pegando o nome do departamento em outro banco de dados
        $queryDepartamento = "SELECT NOME_DEPARTAMENTO FROM departamento_nf WHERE ID_DEPARTAMENTO = " . $custoCentro['ID_CENTROCUSTO_BPM'];
        $resultado = oci_parse($connBpmgp, $queryDepartamento);
        oci_execute($resultado);

        while ($row = oci_fetch_array($resultado, OCI_ASSOC)) {
            $nomeDepartamento = $row['NOME_DEPARTAMENTO'];
        }
        oci_free_statement($resultado);


        echo '<tr>
                    <td style="border: solid 1px; padding: 5px; ">' . $nomeDepartamento  . '</td>
                    <td style="border: solid 1px; padding: 5px; ">' . $custoCentro['percentual'] . '%</td>
                </tr>';
    }

    oci_close($connBpmgp);
    $connNOTAS->close();
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