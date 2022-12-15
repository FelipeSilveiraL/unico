<?php
require_once('../config/query.php');

$query_users .= ' WHERE DS_USUARIO = "'.$_POST['id'].'"';

$resultadoLogin = $conn->query($query_users);

while ($login = $resultadoLogin->fetch_assoc()) {
   
    echo $login['DS_LOGIN'] . " / " . $login['CD_USUARIO'] ;
}

$conn->close();