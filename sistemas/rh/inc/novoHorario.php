<?php
require_once('../../../config/databases.php');
require_once('../funcoes/function.php');

//variaveis
$HoraInicioSemanal = removerCaracteres($_POST['HoraInicioSemanal']);
$HoraFinalSemanal = removerCaracteres($_POST['HoraFinalSemanal']);
$HoraInicioAlmocoSemanal = removerCaracteres($_POST['HoraInicioAlmocoSemanal']);
$HoraFinalAlmocoSemanal = removerCaracteres($_POST['HoraFinalAlmocoSemanal']);
$HoraInicioSabado = removerCaracteres($_POST['HoraInicioSabado']);
$HoraFinalSabado = removerCaracteres($_POST['HoraFinalSabado']);
$HoraInicioAlmocoSabado = removerCaracteres($_POST['HoraInicioAlmocoSabado']);
$HoraFinalAlmocoSabado = removerCaracteres($_POST['HoraFinalAlmocoSabado']);


$queryHorarioExiste = "SELECT * FROM horario_trabalho WHERE 

id_empresa = " . $_POST['empresa'] . " AND 

id_departamento = " . $_POST['departamento'] . " AND

segunda_sexta = '" . $HoraInicioSemanal . $HoraFinalSemanal . "'";

if (!empty($_POST['HoraInicioAlmocoSemanal'])) {
    $queryHorarioExiste .= " AND
    segunda_sexta_almoco =  '" . $HoraInicioAlmocoSemanal . $HoraFinalAlmocoSemanal . "'";
}

if (!empty($_POST['HoraInicioSabado'])) {
    $queryHorarioExiste .= " AND
    sabado = '" . $HoraInicioSabado . $HoraFinalSabado . "'";
}

if (!empty($_POST['HoraInicioAlmocoSabado'])) {
    $queryHorarioExiste .= " AND
    sabado_almoco = '" . $HoraInicioAlmocoSabado . $HoraFinalAlmocoSabado . "'";
}

$result = oci_parse($connBpmgp, $queryHorarioExiste);
oci_execute($result);

while ($horarioExistente = oci_fetch_array($result, OCI_ASSOC)) {
    header('Location: ../front/horario.php?pg=3&msn=20');
}

if (oci_num_rows($result) == 0) {



    if (empty($_GET['idHorario'])) {//novo horario
        $insertHorario = "INSERT INTO horario_trabalho 
        (id_empresa, 
        id_departamento, 
        segunda_sexta,";
        $insertHorario .= !empty(($_POST['HoraInicioAlmocoSemanal'])) ? 'segunda_sexta_almoco, ' : '';
        $insertHorario .= !empty(($_POST['HoraInicioSabado'])) ? 'sabado, ' : '';
        $insertHorario .= !empty(($_POST['HoraInicioAlmocoSabado'])) ? 'sabado_almoco, ' : '';
        $insertHorario .=  "
        situacao) 
        VALUES
        (" . $_POST['empresa'] . ",
        " . $_POST['departamento'] . ",
        '" . $HoraInicioSemanal . $HoraFinalSemanal . "',";
        $insertHorario .=  !empty(($_POST['HoraInicioAlmocoSemanal'])) ? "'" . $HoraInicioAlmocoSemanal . $HoraFinalAlmocoSemanal . "'," : '';
        $insertHorario .= !empty(($_POST['HoraInicioSabado'])) ? "'" . $HoraInicioSabado . $HoraFinalSabado . "'," : '';
        $insertHorario .= !empty(($_POST['HoraInicioAlmocoSabado'])) ? "'" . $HoraInicioAlmocoSabado . $HoraFinalAlmocoSabado . "'," : '';
        $insertHorario .=  "
        'A')";

        $resultInsert = oci_parse($connBpmgp, $insertHorario);
        oci_execute($resultInsert);
        oci_free_statement($resultInsert);

    }else{//editando novo horario

        $queryUpdate = "UPDATE horario_trabalho SET 
        id_empresa = ". $_POST['empresa'] .",
        id_departamento = ". $_POST['departamento'] .",
        segunda_sexta = '".$HoraInicioSemanal . $HoraFinalSemanal."'";

        $queryUpdate .=  !empty(($_POST['HoraInicioAlmocoSemanal'])) ? ", segunda_sexta_almoco = '" . $HoraInicioAlmocoSemanal . $HoraFinalAlmocoSemanal . "'" : '';
        $queryUpdate .= !empty(($_POST['HoraInicioSabado'])) ? ", sabado = '" . $HoraInicioSabado . $HoraFinalSabado . "'" : '';
        $queryUpdate .= !empty(($_POST['HoraInicioAlmocoSabado'])) ? ", sabado_almoco = '" . $HoraInicioAlmocoSabado . $HoraFinalAlmocoSabado . "'" : '';
        $queryUpdate .=  "

        WHERE        
        id_horario = ".$_GET['idHorario'];

        $result = oci_parse($connBpmgp, $queryUpdate);
        oci_execute($result);
        oci_free_statement($result);

        header('Location: ../front/horario.php?pg=3&msn=4');
        exit;
    }
}

header('Location: ../front/horario.php?pg=3&msn=8');


oci_free_statement($result);
oci_close($connBpmgp);
