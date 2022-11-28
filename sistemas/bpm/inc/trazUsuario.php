<?php
require_once('../config/query.php');

$queryUsuario .= " WHERE nomfun = '".$_POST['id']."' ";

$resultadoUsuario = sqlsrv_query($connVetorh, $queryUsuario);

while ($usuario = sqlsrv_fetch_array($resultadoUsuario, SQLSRV_FETCH_ASSOC)) {
    $cpf = $usuario['numcpf'];
    echo '<option value="' . $cpf . '" selected>' . $cpf.'</option>';
}