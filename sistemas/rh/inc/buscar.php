<?php
session_start();

require_once('../config/query.php');

//excluindo tabela temporaria antiga
$resultDrop = $conn->query("DROP TABLE rh_busca_colaborador");
//criando uma tabela temporaria
$queryCriando = "CREATE TABLE rh_busca_colaborador (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    cpf VARCHAR(20) NOT NULL,
    PRIMARY KEY (id))";
$resultCriando = $conn->query($queryCriando);

//verificando o tipo da busca
switch ($_POST['busca']) {
    case '1'://NOME
        $where = "WHERE nomfun LIKE '%".$_POST['nomeCompleto']."%'";
        break;
    
    case '2'://CPF
        $where = "WHERE numcpf = '".$_POST['cpf']."'";
        break;
}

//realizando a busca dentro da vetorh
$queryBusca = "SELECT nomfun, numcpf FROM Vetorh.dbo.v_func ".$where;

$colaboradores = sqlsrv_query($connVetorh, $queryBusca);

while (sqlsrv_fetch($colaboradores)) {
    $nome = sqlsrv_get_field($colaboradores, 0);
    $cpf = sqlsrv_get_field($colaboradores, 1);

    $insertColaborador = "INSERT INTO rh_busca_colaborador (nome, cpf) VALUES ('".$nome."','".$cpf ."')";
    $resultInsert = $conn->query($insertColaborador);
}

header('Location: ../front/buscar.php?pg='.$_GET['pg'].'&table=1');

$_SESSION['tipoPesquisa'] = $_POST['busca'];

$conn->close();