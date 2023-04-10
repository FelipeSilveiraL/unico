<?php 
session_start();
require_once('../config/query.php');
require_once('../../../config/sqlSmart.php');

$nomeGestor = $_POST['nomeGestor'];
$nomeGestor = ctype_digit($nomeGestor) ? true : false;

if ($nomeGestor == true){
    $nomeGestor = strlen($_POST['nomeGestor']);
    $nomeGestor = substr($_POST['nomeGestor'], 0 , -5);    
    $query_user .= " AND DS_USUARIO LIKE '%".strtoupper($_POST['nomeGestor'])."%' OR DS_LOGIN LIKE '%".strtolower($nomeGestor)."%'";
    
}else{

    $query_user .= " AND DS_USUARIO LIKE '%".strtoupper($_POST['nomeGestor'])."%' OR DS_LOGIN LIKE '%".strtolower($_POST['nomeGestor'])."%'";
}

$conexao = oci_parse($connSelbetti, $query_user);
oci_execute($conexao);

while($row = oci_fetch_array($conexao, OCI_ASSOC)){
    $login = $row['DS_LOGIN'];
    $usuario = $row['DS_USUARIO'];
}

oci_free_statement($conexao);

if($usuario != NULL){
    header('Location: ../front/gestorNF.php?pg='.$_GET['pg'].'&dado=1&login='.$login.'&usuario='.$usuario.'');
}else{
    header('Location: ./front/gestorNF.php?pg='.$_GET['pg'].'&erro=1');
}
oci_close($connSelbetti);