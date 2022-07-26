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

$updateUsuario = "UPDATE usuarios SET 
                        usuario='".$usuario."', 
                        nome='".$nome."', 
                        cpf='".$cpf."', 
                        empresa='".$empresa."', 
                        depto='".$departamento."', 
                        email='".$email."', ";

                        if($_POST['senha'] != NULL){
                            //bcrypt
                            $options = ['cost' => 10];            
                            $senha =   password_hash($_POST['senha'], PASSWORD_DEFAULT, $options);
                            $updateUsuario .= " senha = '".$senha."',";
                        }
$updateUsuario .=       "admin='".$admin."', 
                        alterar_senha_login='".$alterarSenha."' 
                    WHERE 
                        id_usuario='".$_GET['id_usuario']."'";

$resultado = $conn->query($updateUsuario);

//SISTEMAS

//LIMPA
$queryLimpando = "DELETE FROM cad_sis_user WHERE id_usuario = ".$_GET['id_usuario'];
$resultado = $conn->query($queryLimpando);

//SALVA
foreach ($_POST['sistemas'] as $key => $value) {
    $queryInsert = "INSERT INTO cad_sis_user (id_sistema, id_usuario) VALUES ('".$value."', '".$_GET['id_usuario']."')";
    $resultado = $conn->query($queryInsert);
}

$conn->close();

header('location: ../front/usuariosEditar.php?pg='.$_GET['pg'].'&conf='.$_GET['conf'].'&id_usuario='.$_GET['id_usuario'].'&msn=4')
?>