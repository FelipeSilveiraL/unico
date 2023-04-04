<?php
//chamando banco
require_once('../config/query.php');
//variaveis
$idGestor = $_POST['gestorVelho'];
$idGestorNovo = $_POST['gestorNovo'];

$queryCount = "SELECT id_aprovador, aprovador_filial, aprovador_area, aprovador_marca, aprovador_superintendente, aprovador_gerente, aprovador_gestor 
                FROM aprovadores_rh WHERE 
                aprovador_filial = '".$idGestor ."' OR
                aprovador_area = '".$idGestor ."' OR
                aprovador_marca = '".$idGestor ."' OR
                aprovador_superintendente = '".$idGestor ."' OR
                aprovador_gerente = '".$idGestor ."' OR
                aprovador_gestor = '".$idGestor ."'";
               
               
                
$resultadoCount = oci_parse($connBpmgp, $queryCount);
oci_execute($resultadoCount);

while(($count = oci_fetch_array($resultadoCount, OCI_BOTH)) != false)  {

    //APROVADOR_FILIAL
    if($count['APROVADOR_FILIAL'] == $idGestor){
        $update = "UPDATE aprovadores_rh SET aprovador_filial = '".$idGestorNovo ."' WHERE id_aprovador = ".$count['ID_APROVADOR']."";
        
        echo $update;
        echo '<br />';
        
        $resultado = oci_parse($connBpmgp, $update);
        oci_execute($resultado, OCI_COMMIT_ON_SUCCESS);
    }

    //APROVADOR_AREA
    if($count['APROVADOR_AREA'] == $idGestor){
        $update_APROVADOR_AREA = "UPDATE aprovadores_rh SET aprovador_area = '".$idGestorNovo ."' WHERE id_aprovador = ".$count['ID_APROVADOR']."";
        
        echo $update_APROVADOR_AREA;
        echo '<br />';
        $resultado_APROVADOR_AREA = oci_parse($connBpmgp, $update_APROVADOR_AREA);
        oci_execute($resultado_APROVADOR_AREA, OCI_COMMIT_ON_SUCCESS);
    }

    //APROVADOR_MARCA
    if($count['APROVADOR_MARCA'] == $idGestor){
        $update_APROVADOR_MARCA = "UPDATE aprovadores_rh SET aprovador_marca = '".$idGestorNovo ."' WHERE id_aprovador = ".$count['ID_APROVADOR']."";
        
        echo $update_APROVADOR_MARCA;
        echo '<br />';
        $resultado_APROVADOR_MARCA = oci_parse($connBpmgp, $update_APROVADOR_MARCA);
        oci_execute($resultado_APROVADOR_MARCA, OCI_COMMIT_ON_SUCCESS);
    }

    //APROVADOR_SUPERINTENDENTE
    if($count['APROVADOR_SUPERINTENDENTE'] == $idGestor){
        $update_APROVADOR_SUPERINTENDENTE = "UPDATE aprovadores_rh SET aprovador_superintendente = '".$idGestorNovo ."' WHERE id_aprovador = ".$count['ID_APROVADOR']."";
        
        echo $update_APROVADOR_SUPERINTENDENTE;
        echo '<br />';
        $resultado_APROVADOR_SUPERINTENDENTE = oci_parse($connBpmgp, $update_APROVADOR_SUPERINTENDENTE);
        oci_execute($resultado_APROVADOR_SUPERINTENDENTE, OCI_COMMIT_ON_SUCCESS);
    }
    
    //APROVADOR_GERENTE
    if($count['APROVADOR_GERENTE'] == $idGestor){
        $update_APROVADOR_GERENTE = "UPDATE aprovadores_rh SET aprovador_gerente = '".$idGestorNovo ."' WHERE id_aprovador = ".$count['ID_APROVADOR']."";
        
        echo $update_APROVADOR_GERENTE;
        echo '<br />';
        $resultado_APROVADOR_GERENTE = oci_parse($connBpmgp, $update_APROVADOR_GERENTE);
        oci_execute($resultado_APROVADOR_GERENTE, OCI_COMMIT_ON_SUCCESS);
    }

    //APROVADOR_GESTOR
    if($count['APROVADOR_GESTOR'] == $idGestor){
        $update_APROVADOR_GESTOR = "UPDATE aprovadores_rh SET aprovador_gestor = '".$idGestorNovo ."' WHERE id_aprovador = ".$count['ID_APROVADOR']."";
        
        echo $update_APROVADOR_GESTOR;
        echo '<br />';
        $resultado_APROVADOR_GESTOR = oci_parse($connBpmgp, $update_APROVADOR_GESTOR);
        oci_execute($resultado_APROVADOR_GESTOR, OCI_COMMIT_ON_SUCCESS);
    }

}

header('location: ../front/gestorRH.php?pg='.$_GET['pg'].'&msn=6');

oci_free_statement($resultadoCount);
oci_close($connBpmgp);
?>