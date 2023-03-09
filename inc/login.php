<?php

require_once('../config/query.php');

require_once('../config/config.php');


//SQL injection
$usuario = mysqli_real_escape_string($conn, $_POST['username']);
$senha = mysqli_real_escape_string($conn, $_POST['password']);

//BUSCANDO USUÁRIO
$queryUsuarios .= "WHERE U.usuario = '" . $usuario . "'";
$resultadoUsuario = $conn->query($queryUsuarios);
$usuario = $resultadoUsuario->fetch_assoc();


if ($usuario['deletar'] == 1) {

    header('Location: ../front/login.php?pg='.$_GET['pg'].'&msn=1');//usuario desativado

} else {
    
    if (password_verify($senha, $usuario['senha'])) {

        if ($usuario['alterar_senha_login'] == 1) {

            header('Location: ../front/usuarioAlterar.php?pg='.$_GET['pg'].'&id_usuario=' . $usuario['id_usuario'] . '');

        } else {
            //SESSÕES DOS SISTEMAS REFERENTE AO USUÁRIO
            require_once('../config/session.php');
            header('Location: ../front/index.php?pg='.$_GET['pg'].'');
        }
    } else {
        header('Location: ../front/login.php?pg='.$_GET['pg'].'&msn=2');//usuario senha invalida
    }
}
