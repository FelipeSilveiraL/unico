<?php
require_once('../config/query.php');

/*===================================*/

$mesAnterior = '1'; //quantidade de meses anteriores
$dataMes = " AND CL.date_create BETWEEN '".date('Y-m', strtotime('-'.$mesAnterior.' months', strtotime(date('Y-m-d'))))."-01' AND '".date('Y-m')."-31'";

$queryCountLancando = "SELECT count(CL.id_lancarnotas) as countLancando FROM cad_lancarnotas CL WHERE CL.status_desc = 1 AND CL.ID_USUARIO = ".$_SESSION['id_usuario']." AND CL.deletar = 0 ".$dataMes;
$resultCountLancando = $connNOTAS->query($queryCountLancando);
if(!$countLancando = $resultCountLancando->fetch_assoc()){
    echo "Ops";
}

$queryCountLancado = "SELECT count(CL.id_lancarnotas) as countLancado FROM cad_lancarnotas CL WHERE CL.status_desc = 3 AND CL.ID_USUARIO = ".$_SESSION['id_usuario']." AND CL.deletar = 0 ".$dataMes;
$resultCountLancado = $connNOTAS->query($queryCountLancado);

if(!$countLancado = $resultCountLancado->fetch_assoc()){
    echo "Ops";
}

$queryCountPendentes = "SELECT count(CL.id_lancarnotas) as countPendentes FROM cad_lancarnotas CL WHERE CL.status_desc = 2 AND CL.ID_USUARIO = ".$_SESSION['id_usuario']." AND CL.deletar = 0 ".$dataMes;
$resultCountPendentes = $connNOTAS->query($queryCountPendentes);

if(!$countPendentes = $resultCountPendentes->fetch_assoc()){
    echo "Ops";
}

$queryCountErros = "SELECT COUNT(CL.id_lancarnotas) as countErros FROM cad_lancarnotas CL LEFT JOIN cad_status CS ON CL.status_desc = CS.id WHERE CS.erro = 1 AND CL.ID_USUARIO = ".$_SESSION['id_usuario']." AND CL.deletar = 0";
$resultCountErros = $connNOTAS->query($queryCountErros);

if(!$countErros = $resultCountErros->fetch_assoc()){
    echo "Ops";
}


?>