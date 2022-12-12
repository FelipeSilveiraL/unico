<?php
require_once('../config/query.php');


$queryCidade .= ' WHERE estados_id = (SELECT id FROM estados WHERE sigla = "'.$_POST['id'].'" limit 1)';

$resultadoCidade = $conn->query($queryCidade);

while ($cidade = $resultadoCidade->fetch_assoc()) {
    echo '<option value="' . $cidade['nome'] . '">' . $cidade['nome'].'</option>';
}
$conn->close();