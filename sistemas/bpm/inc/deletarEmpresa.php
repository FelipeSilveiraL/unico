<?php
session_start();
// require_once('../config/query.php');
require_once('../../../config/databases.php');
require_once('../../../config/sqlSmart.php');

//Verificando se a empresa possui relacionamento em alguma outra tabela
$selectEmp = "SELECT 
                e.id_empresa AS tabela_empresa, 
                d.id_empresa AS tabela_empresaDepartamento,
                a.id_empresa AS tabela_aprovadoresRH,
                g.id_empresa AS tabela_gestorDireto
            FROM EMPRESA e
            LEFT JOIN empresa_departamento d ON (e.id_empresa = d.id_empresa) 
            LEFT JOIN aprovadores_rh a ON (e.id_empresa = a.id_empresa)
            LEFT JOIN gestor_direto g ON (e.id_empresa = g.id_empresa)
            WHERE e.id_empresa = '".$_GET['id']."' and rownum = 1";

$resultEmp = oci_parse($connBpmgp, $selectEmp);
oci_execute($resultEmp);

if(($rowEmp = oci_fetch_array($resultEmp, OCI_BOTH)) != FALSE) { 
                                                        
    if (($rowEmp['TABELA_EMPRESADEPARTAMENTO'] != NULL) || ($rowEmp['TABELA_APROVADORESRH'] != NULL) || ($rowEmp['TABELA_GESTORDIRETO'] != NULL)) {
        header('location: ../front/empresas.php?pg='.$_GET['pg'].'&msn=14');//msn=5 Empresa já possui relacionamento
    }else{       

    //Deletando regra
    $deleteEmpresa =" DELETE FROM empresa
                WHERE
                    id_empresa = '".$_GET['id']."'";
   
    $resultUpdateDeleteEmp = oci_parse($connBpmgp, $deleteEmpresa);
    oci_execute($resultUpdateDeleteEmp);
        
    header('location: ../front/empresas.php?pg=5&msn=14');//msn=3 Empresa deletada com sucesso
   
    }
}

oci_close($connBpmgp);

?>