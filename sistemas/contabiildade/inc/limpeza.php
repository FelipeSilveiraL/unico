<?php
session_start();
//iremos buscar a nota no SmartShare
require_once('../config/query.php');

$numeroPermitido = '1060';
$cdFluxo = $_POST['numeroSolicitacao'];

//VERIFICAR SE O FLUXO
$queryProcesso = "SELECT CD_PROCESSO FROM historico_fluxo WHERE cd_fluxo = " . $cdFluxo;

//preparando a declaração do select
$execProcesso = oci_parse($connSelbetti, $queryProcesso);

// executando a declaracao do select
oci_execute($execProcesso);

// verificando se a consulta retornou resultados
if ($execProcesso) {

    // recupero o resultado
    while ($processo = oci_fetch_array($execProcesso, OCI_ASSOC)) {

        if ($numeroPermitido == $processo['CD_PROCESSO']) {//possui permissão
            $_SESSION['cdFluxo'] = $cdFluxo;
            header('location: ../front/limpeza.php?pg='.$_GET['pg'].'&fluxo=true');

        } else {//não possui a permissão
            header('location: ../front/limpeza.php?pg='.$_GET['pg'].'&msn=10&erro=11');
        }
    }
    //caso nao encontre o resultado
    echo oci_num_rows($execProcesso) != 0 ?: header('location: ../front/limpeza.php?pg='.$_GET['pg'].'&msn=10&erro=12');

}

oci_free_statement($execProcesso);

oci_close($connSelbetti);