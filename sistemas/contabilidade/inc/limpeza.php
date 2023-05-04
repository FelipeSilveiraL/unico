<?php
//iremos buscar a nota no SmartShare

require_once('../config/query.php');

//VERIFICAR SE O FLUXO TEM PERMISSÃO PARA EFETUAR A LIMPEZA

$queryProcesso = "SELECT CD_PROCESSO FROM historico_fluxo WHERE cd_processo = 1060 AND cd_fluxo = " . $_GET['numeroSolicitacao'];

//preparando a declaração do select
$execProcesso = oci_parse($connSelbetti, $queryProcesso);

// executando a declaracao do select
oci_execute($execProcesso);


if (oci_num_rows($execProcesso) == 0) {
    echo 'Solicitação nao tem permissão para executar essa ação';
} else {
    // recupero o resultado
    while ($processo = oci_fetch_array($execProcesso, OCI_ASSOC)) {
        echo 'Solicitação tem permissão: ' . $processo['CD_PROCESSO'];
    }
}

oci_free_statement($execProcesso);

oci_close($connSelbetti);

?>