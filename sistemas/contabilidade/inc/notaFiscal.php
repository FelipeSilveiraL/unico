<?php
session_start();

require_once('../config/query.php');

//MONTANDO A NOTA FISCAL
$selects = array(
    'select1' => "SELECT cvt.ds_valor AS filial FROM historico_campo_valor cvt WHERE cvt.cd_fluxo = " . $_SESSION['cdFluxo'] . " AND cvt.cd_campo = 12 AND cvt.cd_tarefa = (SELECT MAX(cd_tarefa) FROM historico_tarefa WHERE cd_fluxo = cvt.cd_fluxo)",

    'select2' => "SELECT cvt.ds_valor as numero_nota FROM historico_campo_valor cvt WHERE cvt.cd_fluxo = " . $_SESSION['cdFluxo'] . " AND cvt.cd_campo = 14 AND cvt.cd_tarefa = (SELECT MAX(cd_tarefa) FROM historico_tarefa WHERE cd_fluxo = cvt.cd_fluxo)",

    'select3' => "SELECT cvt.ds_valor as serie_nota FROM historico_campo_valor cvt WHERE cvt.cd_fluxo = " . $_SESSION['cdFluxo'] . " AND cvt.cd_campo = 15 AND cvt.cd_tarefa = (SELECT MAX(cd_tarefa) FROM historico_tarefa WHERE cd_fluxo = cvt.cd_fluxo)",

    'select4' => "SELECT cvt.ds_valor as cnpj_fornecedor FROM historico_campo_valor cvt WHERE cvt.cd_fluxo = " . $_SESSION['cdFluxo'] . " AND cvt.cd_campo = 16 AND cvt.cd_tarefa = (SELECT MAX(cd_tarefa) FROM historico_tarefa WHERE cd_fluxo = cvt.cd_fluxo)",

    'select5' => "SELECT cvt.ds_valor as nome_fornecedor FROM historico_campo_valor cvt WHERE cvt.cd_fluxo = " . $_SESSION['cdFluxo'] . " AND cvt.cd_campo = 17 AND cvt.cd_tarefa = (SELECT MAX(cd_tarefa) FROM historico_tarefa WHERE cd_fluxo = cvt.cd_fluxo)"
);

//extraindo os valores
foreach ($selects as $select) {
    $execNota = oci_parse($connSelbetti, $select);

    oci_execute($execNota);

    while ($nota = oci_fetch_array($execNota, OCI_ASSOC + OCI_RETURN_NULLS)) {
        foreach ($nota as $key => $value) {

            switch ($key) {
                case 'FILIAL':
                    $tamanho = 12;
                    $nome = 'Filial: ';
                    break;
                case 'NUMERO_NOTA':
                    $tamanho = 6;
                    $nome = 'Número Nota: ';
                    break;
                case 'SERIE_NOTA':
                    $tamanho = 6;
                    $nome = 'Série Nota: ';
                    break;
                case 'NOME_FORNECEDOR:':
                    $tamanho = 6;
                    $nome = 'Fornecedor: ';
                    break;
                case 'CNPJ_FORNECEDOR':
                    $tamanho = 6;
                    $nome = 'CNPJ Fornecedor: ';
                    $cnpj = $value; // CNPJ sem formatação
                    $value = substr($cnpj, 0, 2).".".substr($cnpj, 2, 3).".".substr($cnpj, 5, 3)."-".substr($cnpj, 8, 4)."/".substr($cnpj, 12, 2);
                    break;
            }
            echo '<div class="col-md-' . $tamanho . '">
                    <label for="validationDefault01" class="form-label">' . $nome . ' </label>
                    <input type="text" class="form-control" id="validationDefault01" value="' . $value . '" disabled>
                </div>';
        }
    }
    oci_free_statement($execNota);
}
oci_close($connSelbetti);