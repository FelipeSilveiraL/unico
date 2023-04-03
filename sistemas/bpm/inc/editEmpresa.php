<?php
session_start();
require_once('../../../config/databases.php');
  require_once('../../../config/sqlSmart.php');

$caracteres = array(".", "-", "/");
$cnpj = str_replace($caracteres, "", $_POST['cnpjValue']);

//Editando Regra Empresa
$info = $_GET['id_empresa'];
$valueApollo = ($_POST['empApollo'] == NULL) ? '0' : $_POST['empApollo'];
$valueRevApollo = ($_POST['revApollo'] == NULL) ? '0' : $_POST['revApollo'];
$valueEmpNbs = ($_POST['empnbs'] == NULL) ? '0' : $_POST['empnbs'];
$orgSenior = ($_POST['orgsenior'] == NULL) ? '0' : $_POST['orgsenior'];
$empresaSenior = ($_POST['empresasenior'] == NULL) ? '0' : $_POST['empresasenior'];

$updateRegraEmp ="UPDATE empresa
            SET
                sistema = '".$_POST['sistema']."',
                empresa_apollo = '".$valueApollo."',
                revenda_apollo = '".$valueRevApollo."',
                empresa_nbs = '".$valueEmpNbs."',                
                organograma_senior = '".$orgSenior."',
                empresa_senior = '".$empresaSenior."',
                filial_senior = '".$_POST['filialsenior']."',
                consorcio ='".$_POST['consorcio']."',
                situacao ='".$_POST['situacao']."',
                numero_caixa ='".$_POST['numero_caixa']."',
                uf_gestao = '".$_POST['estado']."',
		        apelido_nbs = '".$_POST['apelidoNbs']."',
                bandeira = '".$_POST['bandeira']."',
                limite_nota_diversa = '".$_POST['limite_nota_diversa']."',
                CNPJ = '".$cnpj."',
                integrar_triagem = '".$_POST['triagem']."'
            WHERE
                id_empresa = '".$_GET['id_empresa']."'";
                

$resultUpdateEmp = oci_parse($connBpmgp, $updateRegraEmp);
if(oci_execute($resultUpdateEmp,OCI_COMMIT_ON_SUCCESS)){

    header('location: ../front/empresas.php?pg='.$_GET['pg'].'&msn=4');//msn=2 editado com sucesso
    
    oci_free_statement($resultUpdateEmp);
    oci_close($connBpmgp);
    
}

