<?php
require_once('../config/query.php');

$queryUsuario .= " WHERE nomfun = '".$_POST['id']."' ";

$resultadoUsuario = sqlsrv_query($connVetorh, $queryUsuario);

if($usuario = sqlsrv_fetch_array($resultadoUsuario, SQLSRV_FETCH_ASSOC)) {

    $cpf = $usuario['numcpf'];
   
    echo '<option value="' . $cpf . '" >' . $cpf.'</option>';

}else{
    $cpf = "CPF não cadastrado na selbetti! Por favor cadastre";
    echo '<option value="1" >' . $cpf.'</option>';
}
