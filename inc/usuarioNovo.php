<?php

require_once('../config/databases.php');

//USUARIO
$nome = $_POST['nomeUsuario'];
$email = $_POST['email'];
$cpf = $_POST['cpf'];
$empresa = $_POST['empresa'];
$departamento = $_POST['departamento'];
$usuario = $_POST['usuario'];
$alterarSenha = !empty($_POST['trocarSenha']) ? 1 : 0;
$admin = !empty($_POST['admin']) ? 1 : 0;

//bcrypt
$options = ['cost' => 10];            
$senha =   password_hash($_POST['senha'], PASSWORD_DEFAULT, $options);

$usuario = "INSERT INTO usuarios(usuario, nome, cpf, empresa, depto, email, senha, admin, alterar_senha_login) 
                            VALUES
                                (
                                '".$usuario."',
                                '".$nome."',
                                '".$cpf."',
                                '".$empresa."',
                                '".$departamento."',
                                '".$email."',
                                '".$senha."',
                                '".$admin."',
                                '".$alterarSenha."'
                                )";

$resultado = $conn->query($usuario);

//SISTEMAS

//PEGAR ID_USUARIO
$queryIdusuario = "SELECT MAX(id_usuario) AS id_usuario FROM usuarios";
$resultado = $conn->query($queryIdusuario);
$idUsuario = $resultado->fetch_assoc();

//SALVA
foreach ($_POST['sistemas'] as $key => $value) {
    $queryInsert = "INSERT INTO cad_sis_user (id_sistema, id_usuario) VALUES ('".$value."', '".$idUsuario['id_usuario']."')";
    $resultado = $conn->query($queryInsert);
}

$conn->close();

header('location: ../front/iframeUsuarios.php?pg=1&conf=1&msn=8')
?>