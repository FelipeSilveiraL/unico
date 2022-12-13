<?php
require_once('../config/query.php');

$query_users .= ' WHERE DS_USUARIO = "'.$_POST['id'].'"';

$resultadoLogin = $conn->query($query_users);

while ($login = $resultadoLogin->fetch_assoc()) {
   
    echo $login['DS_LOGIN'];
}

$conn->close();