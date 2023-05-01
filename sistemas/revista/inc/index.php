<?php
session_start();
require_once('../config/query.php'); //chamar banco

//subir o arquivo para o servidor

//criar a pasta da edição

$caminhoPasta = '../documento/edicao' . $_POST['edicao'] . '';
$caminhoBanco = '../../unico/sistemas/revista'.str_replace('..', '', $caminhoPasta);

if (!is_dir($caminhoPasta)) {

    if (!mkdir($caminhoPasta, 0777, true)) {
        echo "Erro[01]: Não foi possível criar a pasta";
        exit;
    }
}

if ($_FILES['arquivo']['type'] === 'application/pdf') {
    //Subir o arquivo
    sleep(10);

    if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminhoPasta . "/" . $_FILES['arquivo']['name'])) {
        //query
        $insert = "INSERT INTO revista (id_usuario, nome_usuario, caminho, edicao)
        VALUES (" . $_SESSION['id_usuario'] . ", '" . $_SESSION['nome_usuario'] . "', '" . $caminhoBanco  . "/" . $_FILES['arquivo']['name'] . "'," . $_POST['edicao'] . " )";

        //aplicando a query
        if (!$result = $connBlog->query($insert)) {
            printf('Erro[03]: %s \n', $connBlog->error);
        }

        //fechar o banco
        $connBlog->close;
        header('location: ../front/index.php?pg=' . $_GET['pg'] . '&msn=11');

        //Volto para tela incial informando o usuário que foi salvo ou não a informação.
    } else {
        echo "Erro[03]: Arquivo não foi enviado! - CONTATE O ADMINISTRADOR DO SISTEMA<br />";
        exit;
    }
} else {
    header('location: ../front/index.php?pg=' . $_GET['pg'] . '&msn=10&erro=3');
}
