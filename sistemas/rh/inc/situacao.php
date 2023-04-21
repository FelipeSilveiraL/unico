<?php
require_once('../../../config/databases.php');

if ($_GET['acao'] == 1) {//desativar
    $updateHorario = "UPDATE horario_trabalho set situacao = 'D' WHERE id_horario = ".$_GET['idHorario'];
}else{//ativar
    $updateHorario = "UPDATE horario_trabalho set situacao = 'A' WHERE id_horario = ".$_GET['idHorario'];
}

$result = oci_parse($connBpmgp, $updateHorario);
oci_execute($result);

header('Location: ../front/horario.php?pg='.$_GET['pg'].'&msn=4');

oci_free_statement($result);
oci_close($connBpmgp);

?>