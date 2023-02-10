<?php
require_once('../../../config/databases.php');

if($_GET['cnpj'] == 1){
    $where = "cpfcnpj_fornecedor = '" . $_GET['idFornecedor'] . "' AND ";
    $selec = "ID_FILIAL = (SELECT ID_EMPRESA FROM unico.bpm_empresas WHERE CNPJ = '" . $_GET['filial'] . "' AND SITUACAO = 'A' LIMIT 1) ";
}else{
    $where = "id_fornecedor = '" . $_GET['idFornecedor'] . "' AND ";
    $selec = "ID_FILIAL = (SELECT ID_FILIAL FROM cad_filial WHERE CNPJ = '" . $_GET['filial'] . "' LIMIT 1) ";
}

$queryRateio = "SELECT 
                    CR.percentual,
                    DNF.NOME_DEPARTAMENTO
                FROM
                    cad_rateiocentrocusto CR
                LEFT JOIN
                    unico.bpm_nf_departamento DNF ON (CR.ID_CENTROCUSTO_BPM = DNF.ID_DEPARTAMENTO) 
                WHERE
                CR.ID_RATEIOFORNECEDOR = (SELECT 
                        ID_RATEIOFORNECEDOR
                    FROM
                        cad_rateiofornecedor
                    WHERE
                        ";
                        $queryRateio .= $where;
                        
                        $queryRateio .="
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
        echo '<tr>
                    <td style="border: solid 1px; padding: 5px; ">' . $custoCentro['NOME_DEPARTAMENTO'] . '</td>
                    <td style="border: solid 1px; padding: 5px; ">' . $custoCentro['percentual'] . '%</td>
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