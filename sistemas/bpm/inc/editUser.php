<?php
session_start();

//chamando os bancos
require_once('../../../config/databases.php');

$nomeUser = strtoupper($_POST['inputUsuario']);
$emailUser = strtolower($_POST['inputEmail']);
$loginUser = strtolower($_POST['inputLogin']);
$cdUser = $_POST['inputCd'];

//Editando Regra Usuario SmartShare
$updateUserApi = " UPDATE usuario
                SET
                    ds_usuario = '".$nomeUser."',
                    ds_email = '".$emailUser."',
                    ds_login = '".$loginUser."'
                WHERE
                    cd_usuario = '".$cdUser."'";

$resultUserApi = oci_parse($connSelbetti, $updateUserApi);

if (oci_execute($resultUserApi)) {
    header('location: ../front/usersBPM.php?pg='.$_GET['pg'].'&msn=4'); //msn != NUll = Editado com Sucesso!
}else{
    $e = oci_error($resultUserApi);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
}

oci_close($connSelbetti);

?>