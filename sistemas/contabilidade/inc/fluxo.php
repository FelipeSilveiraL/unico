<?php
session_start();

require_once('../config/query.php');

//sql
$idFluxo = $_GET['idFluxo'];

$deletes = array(
    'delete1' => "DELETE FROM HISTORICO_CAMPO_TEXTO WHERE cd_fluxo IN(" . $idFluxo . ")",

    'delete2' => "DELETE FROM HISTORICO_CAMPO_VALOR WHERE cd_fluxo IN(" . $idFluxo . ")",

    'delete3' => "DELETE FROM HISTORICO_OBSERVACAO_TAREFA WHERE cd_fluxo IN(" . $idFluxo . ")",

    'delete4' => "DELETE FROM HISTORICO_OPCAO_TAREFA WHERE cd_fluxo IN(" . $idFluxo . ")",

    'delete5' => "DELETE FROM HISTORICO_CAMINHO_FLUXO WHERE cd_fluxo IN(" . $idFluxo . ")",

    'delete6' => "DELETE FROM HISTORICO_TAREFA WHERE cd_fluxo IN(" . $idFluxo . ")",

    'delete7' => "DELETE FROM HISTORICO_FLUXO_INDICADOR WHERE cd_fluxo IN(" . $idFluxo . ")",

    'delete8' => "DELETE FROM HISTORICO_TAREFA_INDICADOR WHERE cd_fluxo IN(" . $idFluxo . ")",

    'delete9' => "DELETE FROM HISTORICO_VARIAVEL_FLUXO WHERE cd_fluxo IN(" . $idFluxo . ")",

    'delete10' => "DELETE FROM HISTORICO_VER_ANEXO_LIBERACAO WHERE cd_fluxo IN(" . $idFluxo . ")",

    'delete11' => "DELETE FROM HISTORICO_VERSAO_ANEXO WHERE cd_fluxo IN(" . $idFluxo . ")",

    'delete12' => "DELETE FROM HISTORICO_ANEXO WHERE cd_fluxo IN(" . $idFluxo . ")",

    'delete13' => "DELETE FROM HISTORICO_TAREFA WHERE cd_fluxo IN(" . $idFluxo . ")",

    'delete14' => "DELETE FROM historico_FLUXO WHERE cd_fluxo IN(" . $idFluxo . ")"
);

//aplicando no banco de dados

foreach ($deletes as $delete) {

    //aplicando no banco da selbetti
    $exeDelete = oci_parse($connSelbetti, $delete);

    oci_execute($exeDelete);

    oci_free_statement($exeDelete);


    //salvando logs tarefa
    $queryLogTarefa = "INSERT INTO contabilidade_log_tarefa (id_usuario, desc_tarefa) VALUES ('".$_SESSION['id_usuario']."', '".$delete."')";
    
    $execLogTarefa = $conn->query($queryLogTarefa);
}

//salvando log usuario
$queryLogUsuario = "INSERT INTO contabilidade_log_usuario (id_usuario, data, numero_fluxo) VALUES ('".$_SESSION['id_usuario']."', '".date('Y-m-d H:i:s')."', ".$idFluxo.")";

$exeLogUsuario = $conn->query($queryLogUsuario);

oci_close($connSelbetti);

header('location: ../front/limpeza.php?pg='.$_GET['pg'].'&msn=24');