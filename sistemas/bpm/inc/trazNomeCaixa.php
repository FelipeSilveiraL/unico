<?php
require_once('../config/query.php');

$queryCaixaEmpresa .= ' WHERE ID_EMPRESA = "'.$_POST['id'].'"';

$resultadoCxEmpresa = $conn->query($queryCaixaEmpresa);

while ($caixaEmpresa = $resultadoCxEmpresa->fetch_assoc()) {
    echo '<option value="' . $caixaEmpresa['ID_CAIXA_EMPRESA'] . '">' . $caixaEmpresa['NOME_CAIXA'].'</option>';
}

$conn->close();