<?php
require_once('../config/databases.php');

//SQL injection
$senhaSQL = mysqli_real_escape_string($conn, $_POST['passwordConfirm']);

//bcrypt
$options = ['cost' => 10];            
$senha =   password_hash($senhaSQL, PASSWORD_DEFAULT, $options);

//alterando senha
$updateSenha = "UPDATE usuarios SET senha='".$senha."', alterar_senha_login='0' WHERE id_usuario='".$_GET['id_usuario']."'";
$resulado = $conn->query($updateSenha);

$conn->close();

header('Location: ../front/login.php?msn=7');