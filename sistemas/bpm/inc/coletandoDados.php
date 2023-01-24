<?php
require_once('../config/query.php'); //BPMGP_HOM($conn)

//sabendo qual sistema o $_POST['empresa'] pertense

$queryEmpresa = "SELECT SISTEMA, EMPRESA_NBS, EMPRESA_APOLLO FROM bpm_empresas WHERE ID_EMPRESA = ". $_POST['id'] ."";

$resultadoEmpresa = $conn->query($queryEmpresa);

if ($empresa = $resultadoEmpresa->fetch_assoc()) {
    
    if (!empty($_POST['id'])) {    
        $queryNBS = "SELECT DESCRICAO_CUSTO,CODIGO_CUSTO FROM bpm_custo_especificos WHERE ATIVO = 'S' ORDER BY DESCRICAO_CUSTO ASC";
        $queryApollo = "SELECT DES_DESPESA, DESPESA FROM bpm_vei_despesa WHERE INATIVO_CONSULTAS !='S' and EMPRESA = " . $empresa['EMPRESA_APOLLO'] . " order by DES_DESPESA ASC";
        
    } else if (!empty($custoVeiculo['ID_CODIGO_CUSTO_VEICULO']) && $_GET['id_codigo'] == NULL) {    
        $queryNBS = "SELECT DESCRICAO_CUSTO FROM custos_especificos WHERE CODIGO_CUSTO = " . $custoVeiculo['CODIGO_CUSTO_ERP'];
        $queryApollo = "SELECT DES_DESPESA FROM bpm_vei_despesa WHERE EMPRESA = " . $empresa['EMPRESA_APOLLO']. " AND DESPESA = " . $custoVeiculo['CODIGO_CUSTO_ERP'];
    } else {    
        $queryNBS = "SELECT DESCRICAO_CUSTO,CODIGO_CUSTO FROM bpm_custo_especificos WHERE ATIVO = 'S' ORDER BY DESCRICAO_CUSTO ASC";
        $queryApollo = "SELECT DES_DESPESA, DESPESA FROM bpm_vei_despesa WHERE  INATIVO_CONSULTAS !='S' and EMPRESA = " . $empresa['EMPRESA_APOLLO'] . " order by DES_DESPESA ASC";
    
    }

    if ($empresa['SISTEMA'] == 'A') {

        //######################### APOLLO #########################

        // if ($_GET['id_codigo'] != null) {
        //     $queryDescricao = "SELECT DES_DESPESA, DESPESA  FROM bpm_vei_despesa WHERE EMPRESA = " . $empresa['EMPRESA_APOLLO']  . " AND DESPESA = " . $custoERP;
            
        //     $resultadoDescricao = $conn->query($queryDescricao);

        //     if ($descricao = $resultadoDescricao->fetch_assoc()){
        //         echo '<option value="' . $descricao['DESPESA'] . '">' . $descricao['DES_DESPESA'] . ' [ '. $descricao['DESPESA'] .' ]</option><option value="">----------------</option>';
        //     } else {
        //         echo '<option>erro</option>';
        //     }
        //     $conn->close();
        // }

        $resultadoAPollo = $conn->query($queryApollo);

        while($empresaAPollo = $resultadoAPollo->fetch_assoc()) {

            if (!empty($custoVeiculo['ID_CODIGO_CUSTO_VEICULO'])  && $_GET['id_codigo'] == NULL) {
                echo '<td>' . $empresaAPollo['DES_DESPESA'] . '</td>';
            } else {
                echo '<option value="' . $empresaAPollo['DESPESA'] . '">' . $empresaAPollo['DES_DESPESA'] . ' [ '.$empresaAPollo['DESPESA'].' ]</option>';
            }
        }
    
       
    } else {

    //     //######################### NBS #########################

    //     if ($_GET['id_codigo'] != null) {

    //         $queryDescricao = "SELECT DESCRICAO_CUSTO, CODIGO_CUSTO FROM bpm_custo_especificos WHERE CODIGO_CUSTO = " . $custoERP;
            
    //         $resultadoDescricao = $conn->query($queryDescricao);

    //         if (($descricao = $resultadoDescricao->fetch_assoc()) != false) {
    //             echo '<option value="' . $descricao['CODIGO_CUSTO'] . '">' . $descricao['DESCRICAO_CUSTO'] . ' [ ' . $descricao['CODIGO_CUSTO'] . ' ]</option><option value="">----------------</option>';
    //         } else {
    //             echo '<option>erro 2</option>';
    //         }

    //     }

        $resultadoNBS = $conn->query($queryNBS);
        

        while (($empresaNBS = $resultadoNBS->fetch_assoc()) != false) {

            if (!empty($custoVeiculo['ID_CODIGO_CUSTO_VEICULO'])) {

                echo '<td>' . $empresaNBS['DESCRICAO_CUSTO'] . '</td>';
            } else {
                echo '<option value="' . $empresaNBS['CODIGO_CUSTO'] . '">' . $empresaNBS['DESCRICAO_CUSTO'] . ' [ ' . $empresaNBS['CODIGO_CUSTO'] . ' ]</option>';
            }
        }

        $conn->close();
    }
    
} else {
    echo '<option>erro 3</option>';
}

$conn->close();
?>