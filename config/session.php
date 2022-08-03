<?php
session_start();

/* ############ SESSÕES DO USUÁRIO ############ */
$_SESSION['id_usuario'] = $usuario['id_usuario'];
$_SESSION['usuario'] = $usuario['usuario'];
$_SESSION['nome_usuario'] = $usuario['nome_usuario'];
$_SESSION['cpf'] = $usuario['cpf'];
$_SESSION['id_empresa'] = $usuario['id_empresa'];            
$_SESSION['empresa'] = $usuario['empresa'];
$_SESSION['id_depto'] = $usuario['id_depto'];
$_SESSION['departamento'] = $usuario['departamento'];
$_SESSION['email'] = $usuario['email'];
$_SESSION['senha'] = $usuario['senha'];
$_SESSION['administrador'] = $usuario['admin'];
$_SESSION['alterar_senha_login'] = $usuario['alterar_senha_login'];            
$_SESSION['deletar'] = $usuario['deletar'];

?>