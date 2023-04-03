<?php
require_once('../../../config/databases.php');
require_once('../../../config/sqlSmart.php');

$queryCaixaEmpresa .= ' WHERE ID_EMPRESA = "'.$_POST['id'].'"';

$userConexao = oci_parse($connBpmgp, $queryCaixaEmpresa);
oci_execute($userConexao,OCI_COMMIT_ON_SUCCESS);

while (($selbettiQuery = oci_fetch_array($userConexao, OCI_ASSOC)) != false) {
    echo '<option value="' . $selbettiQuery['ID_CAIXA_EMPRESA'] . '">' . $selbettiQuery['NOME_CAIXA'].'</option>';
}

oci_close($connBpmgp);