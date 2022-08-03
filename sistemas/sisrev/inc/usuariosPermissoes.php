<?php
require_once('../config/query.php');

switch ($_GET['acao']) {
    case '1': //modulos

        //limpando geral
        $deleteGeral = "DELETE FROM sisrev_usuario_modulo WHERE id_usuario = " . $_GET['id_usuarios'];
        $result = $conn->query($deleteGeral);

        //adicionando apenas os selecionados
        foreach ($_POST['modulo'] as $key => $value) {
            $insert = "INSERT INTO sisrev_usuario_modulo (id_usuario, id_modulo) VALUES (" . $_GET['id_usuarios'] . "," . $value . ")";
            $resultinsert = $conn->query($insert);
        }
        break;

    case '2': //função
        //limpando geral
        $deleteGeral = "DELETE FROM sisrev_usuario_funcao WHERE id_usuario = " . $_GET['id_usuarios'];
        $result = $conn->query($deleteGeral);

        //adicionando apenas os selecionados
        foreach ($_POST['funcao'] as $key => $value) {
            $insert = "INSERT INTO sisrev_usuario_funcao (id_usuario, id_funcao) VALUES (" . $_GET['id_usuarios'] . "," . $value . ")";
            $resultinsert = $conn->query($insert);
        }
        break;
}

//Finalizando
header('Location: ../front/usuariosPermissoes.php?id_usuarios=' . $_GET['id_usuarios'] . '&pg=' . $_GET['pg'] . '&msn=8');
$conn->close();
