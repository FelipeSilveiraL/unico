<?php
require_once('../config/query.php');

switch ($_GET['acao']) {
    case '1': //modulos

        //limpando geral
        $deleteGeral = "DELETE FROM bpm_usuario_modulo WHERE id_subModulo = 0 AND localizacao NOT IN (0) AND id_usuario = " . $_GET['id_usuarios'];
       
        $result = $conn->query($deleteGeral);

        $deleteGeral2 = "DELETE FROM bpm_usuario_modulo WHERE id_subModulo = 6 AND localizacao NOT IN (0) AND id_usuario = " . $_GET['id_usuarios'];

        $result2 = $conn->query($deleteGeral2);

        $deleteGeral3 = "DELETE FROM bpm_usuario_modulo WHERE id_subModulo = 7 AND localizacao NOT IN (0) AND id_usuario = " . $_GET['id_usuarios'];

        $result3 = $conn->query($deleteGeral3);
        //adicionando apenas os selecionados
        foreach ($_POST['modulo'] as $key => $value) {

            $sub = "SELECT sub_modulo, localizacao FROM bpm_modulos WHERE id = ".$value;
            $e = $conn->query($sub);
            $nomeModulo = $e->fetch_assoc();

            $insert = "INSERT INTO bpm_usuario_modulo (id_usuario, id_modulo, id_subModulo, localizacao) 
                        VALUES (" . $_GET['id_usuarios'] . "," . $value . ", ".$nomeModulo['sub_modulo'].", ".$nomeModulo['localizacao'].")";
           
            $resultinsert = $conn->query($insert);
        }
        break;

    case '2': //função
        //limpando geral
        $deleteGeral = "DELETE FROM bpm_usuario_funcao WHERE id_usuario = " . $_GET['id_usuarios'];
        $result = $conn->query($deleteGeral);
        array($_POST['funcao']);
        
        //adicionando apenas os selecionados
        foreach ($_POST['funcao'] as $key => $value) {
            $insert = "INSERT INTO bpm_usuario_funcao (id_usuario, id_funcao) VALUES (" . $_GET['id_usuarios'] . "," . $value . ")";
            $resultinsert = $conn->query($insert);
        }
        break;
    case '3': //sub_modulos
        //limpando geral
        $deleteGeral = "DELETE FROM bpm_usuario_modulo WHERE id_subModulo NOT IN (0) AND id_usuario = " . $_GET['id_usuarios'];
        $result = $conn->query($deleteGeral);

        //adicionando apenas os selecionados
        foreach ($_POST['modulo'] as $key => $value) {
           
            $sub = "SELECT sub_modulo, localizacao FROM bpm_modulos WHERE id = ".$value;
            $e = $conn->query($sub);
            $nomeModulo = $e->fetch_assoc();

            $localizacao = empty($nomeModulo['localizacao']) ? '0' : $nomeModulo['localizacao'];

            $insert = "INSERT INTO bpm_usuario_modulo (id_usuario, id_modulo, id_subModulo, localizacao) 
                        VALUES (" . $_GET['id_usuarios'] . "," . $value . ", '".$nomeModulo['sub_modulo']."', '".$localizacao."')";
            $resultinsert = $conn->query($insert);
        }
        break;
}

//Finalizando
header('Location: ../front/usuariosPermissoes.php?id_usuarios=' . $_GET['id_usuarios'] . '&pg=' . $_GET['pg'] . '&msn=8');
$conn->close();
