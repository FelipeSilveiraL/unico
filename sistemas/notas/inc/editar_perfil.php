<?php

require_once('../../../config/databases.php');


//UPDATE UNICO
$update = "UPDATE usuarios SET 
            usuario='".$_POST['usuario']."', 
            nome='".$_POST['nomeUsuario']."', 
            cpf='".$_POST['cpf']."',
            empresa='".$_POST['empresa']."', 
            depto='".$_POST['departamento']."', 
            email='".$_POST['email']."'";

            if($_POST['senha'] != NULL){
                //bcrypt
                $options = ['cost' => 10];            
                $senha =   password_hash($_POST['senha'], PASSWORD_DEFAULT, $options);
                $update .= ", senha = '".$senha."'";
            }

$update .= " WHERE id_usuario = '".$_GET['id_usuario']."'";

if($resultUpdate = $conn->query($update)){    

    //UPDATE SMARTSHARE
    $queryProcurar = "SELECT id_usuario FROM cad_senhaBPM WHERE id_usuario = ".$_GET['id_usuario'];
    $resultProcurar = $connNOTAS->query($queryProcurar);
    $procurar = $resultProcurar->fetch_assoc();

    if(!empty($procurar['id_usuario'])){
        $updateUsuario = "UPDATE cad_senhaBPM SET usuario = '".$_POST['usuarioSmart']."', senha = '".md5($_POST['senhaSmart'])."' WHERE id_usuario = ".$_GET['id_usuario'];
        $resultUsuario = $connNOTAS->query($updateUsuario);
    }else{
        $insertUsuario = "INSERT INTO cad_senhaBPM (id_usuario, usuario, senha) VALUES (".$_GET['id_usuario'].", '".$_POST['usuarioSmart']."', '".md5($_POST['senhaSmart'])."')";        
        $resultUsuario = $connNOTAS->query($insertUsuario);
    }
    
    header('Location: ../front/index.php?msn=3');
   
}else{
    echo "Entre em contato com o administrador pois nao foi possivel editar o seu perfil!";
}