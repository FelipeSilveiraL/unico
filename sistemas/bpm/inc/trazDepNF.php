<?php
require_once('../../../config/sqlSmart.php');
require_once('../config/query.php');

$empdepNF .= ' WHERE e.ID_EMPRESA = ' . $_POST['id'];

$resultadoDepNF = oci_parse($connBpmgp, $empdepNF);
oci_execute($resultadoDepNF);

while ($depNF = oci_fetch_array($resultadoDepNF, OCI_ASSOC)) {

    echo '<option value="' . $depNF['ID_DEPARTAMENTO'] . '">' . $depNF['NOME_DEPARTAMENTO'] . '</option>';
}

oci_free_statement($resultadoDepNF);
oci_close($connBpmgp);
?>