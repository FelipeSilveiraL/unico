<?php
require_once('../config/query.php');


$query_users .= ' WHERE DS_USUARIO ="'.$_POST['id'].'"';

$resultadoLogin = $conn->query($query_users);

while ($login = $resultadoLogin->fetch_assoc()) {
   
    echo '<option value="' . $login['DS_LOGIN'] . '' . $login['CD_USUARIO'] . '" selected>' . $login['DS_LOGIN'].'</option>';
}
$conn->close();