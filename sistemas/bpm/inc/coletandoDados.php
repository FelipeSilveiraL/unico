<?php
require_once('../config/query.php');


if (!empty($_POST['idERP'])) { //estou editando
    $idEmpresa = $_POST['idEMPRESA'];
} else { //estou adicionando
    $idEmpresa = $_POST['id'];
}

//sabendo qual sistema o $_POST['empresa'] pertense

$queryEmpresa = "SELECT SISTEMA, EMPRESA_NBS, EMPRESA_APOLLO FROM empresa WHERE ID_EMPRESA = " . $idEmpresa;
$resultadoEmpresa = oci_parse($connBpmgp, $queryEmpresa);
oci_execute($resultadoEmpresa);

while ($empresa = oci_fetch_array($resultadoEmpresa, OCI_ASSOC)) {

    if (!empty($_POST['id'])) {
        $queryNBS = "SELECT DESCRICAO_CUSTO,CODIGO_CUSTO FROM custos_especificos WHERE ATIVO = 'S' ORDER BY DESCRICAO_CUSTO ASC";
        $queryApollo = "SELECT DES_DESPESA, DESPESA FROM vei_despesa WHERE INATIVO_CONSULTAS !='S' and EMPRESA = " . $empresa['EMPRESA_APOLLO'] . " order by DES_DESPESA ASC";
    } else if (!empty($custoVeiculo['ID_CODIGO_CUSTO_VEICULO']) && $_GET['id_codigo'] == NULL) {
        $queryNBS = "SELECT DESCRICAO_CUSTO FROM custos_especificos WHERE CODIGO_CUSTO = " . $custoVeiculo['CODIGO_CUSTO_ERP'];
        $queryApollo = "SELECT DES_DESPESA FROM vei_despesa WHERE EMPRESA = " . $empresa['EMPRESA_APOLLO'] . " AND DESPESA = " . $custoVeiculo['CODIGO_CUSTO_ERP'];
    } else {
        $queryNBS = "SELECT DESCRICAO_CUSTO, CODIGO_CUSTO FROM custos_especificos WHERE ATIVO = 'S' AND CODIGO_CUSTO = " . $_POST['idERP'];
        $queryApollo = "SELECT DES_DESPESA, DESPESA FROM vei_despesa WHERE  INATIVO_CONSULTAS !='S' AND DESPESA = " . $_POST['idERP'] . " AND EMPRESA = " . $empresa['EMPRESA_APOLLO'];
    }

    if ($empresa['SISTEMA'] == 'A') {

        //######################### APOLLO #########################

        $resultadoAPollo = oci_parse($connApollo, $queryApollo);

        oci_execute($resultadoAPollo);

        while ($empresaAPollo = oci_fetch_array($resultadoAPollo, OCI_ASSOC)) {

            if (!empty($custoVeiculo['ID_CODIGO_CUSTO_VEICULO'])  && $_GET['id_codigo'] == NULL) {
                echo '<td>' . $empresaAPollo['DES_DESPESA'] . '</td>';
            } else {
                echo '<option value="' . $empresaAPollo['DESPESA'] . '">' . $empresaAPollo['DES_DESPESA'] . ' [ ' . $empresaAPollo['DESPESA'] . ' ]</option>';
                echo '<option>-------------</option>';

                $queryApollo = "SELECT DES_DESPESA, DESPESA FROM vei_despesa WHERE  INATIVO_CONSULTAS !='S' AND EMPRESA = " . $empresa['EMPRESA_APOLLO'];
                $resultadoAPollo = oci_parse($connApollo, $queryApollo);
                oci_execute($resultadoAPollo);

                while ($empresaAPollo = oci_fetch_array($resultadoAPollo, OCI_ASSOC)) {
                    echo '<option value="' . $empresaAPollo['DESPESA'] . '">' . $empresaAPollo['DES_DESPESA'] . ' [ ' . $empresaAPollo['DESPESA'] . ' ]</option>';
                }
            }
        }
        oci_free_statement($resultadoAPollo);
    } else {

        $resultadoNBS = oci_parse($connNbs, $queryNBS);
        oci_execute($resultadoNBS);


        while ($empresaNBS = oci_fetch_array($resultadoNBS, OCI_ASSOC)) {

            if (!empty($custoVeiculo['ID_CODIGO_CUSTO_VEICULO'])) {

                echo '<td>' . $empresaNBS['DESCRICAO_CUSTO'] . '</td>';
            } else {
                echo '<option value="' . $empresaNBS['CODIGO_CUSTO'] . '">' . $empresaNBS['DESCRICAO_CUSTO'] . ' [ ' . $empresaNBS['CODIGO_CUSTO'] . ' ]</option>';
                echo '<option>-------------</option>';

                $queryNBS = "SELECT DESCRICAO_CUSTO, CODIGO_CUSTO FROM custos_especificos WHERE ATIVO = 'S'";
                $resultadoNBS = oci_parse($connNbs, $queryNBS);
                oci_execute($resultadoNBS);

                while($empresaNBS = oci_fetch_array($resultadoNBS, OCI_ASSOC)){
                    echo '<option value="' . $empresaNBS['CODIGO_CUSTO'] . '">' . $empresaNBS['DESCRICAO_CUSTO'] . ' [ ' . $empresaNBS['CODIGO_CUSTO'] . ' ]</option>';
                }
            }
        }
        oci_free_statement($resultadoNBS);
    }
}

oci_free_statement($resultadoEmpresa);
oci_close($connBpmgp);
oci_close($connApollo);
oci_close($connNbs);
