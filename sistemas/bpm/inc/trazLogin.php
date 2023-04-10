<?php
require_once('../config/query.php');
require_once('../../../config/sqlSmart.php');

$queryUserApi .= " WHERE U.DS_USUARIO = '".$_POST['id']."'";

$resultadoLogin = oci_parse($connSelbetti, $queryUserApi);
oci_execute($resultadoLogin);

while ($login = oci_fetch_array($resultadoLogin)) {

    if($_POST['edit'] == true){
        echo '<option value="'.$login['DS_LOGIN'].'">'.$login['DS_LOGIN'] . "/" . $login['CD_USUARIO'].'</option>';
    }else{
        echo $login['DS_LOGIN'] . "/" . $login['CD_USUARIO'];
    }
}

oci_free_statement($resultadoLogin);
oci_close($connSelbetti);
