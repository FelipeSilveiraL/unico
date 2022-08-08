<?php
require_once('../config/query.php');    

    switch ($_GET['acao']) {

        case 1:
            $queryInsert = "INSERT INTO sisrev_modulos (nome, endereco) 
            VALUES ('".$_POST['nome']."', '".$_POST['endereco']."')";
            if (!$resultInsert = $conn->query($queryInsert)){
                printf("Erro ao inserir dados %s\n", $conn->error);
            }

            header('Location: ../front/telas_funcoes.php?pg='.$_GET['pg'].'&tela='.$_GET['tela'].'&msn=8');

            break;
        case 2:
            $queryUpdate = "UPDATE sisrev_modulos SET nome='".$_POST['nome']."', endereco='".$_POST['endereco']."' WHERE id='".$_GET['id']."'";
            if (!$resultUpdate = $conn->query($queryUpdate)){
                printf("Erro ao editar as informações %s\n", $conn->error);
            }
            
            header('Location: ../front/telas_funcoes.php?pg='.$_GET['pg'].'&tela='.$_GET['tela'].'&msn=4');
        
            break;

        case 3:
            $queryDeletar = "UPDATE sisrev_modulos SET deletar = '1' WHERE id='".$_GET['id']."'";
            if (!$resultDeletar = $conn->query($queryDeletar)){
                printf("Erro ao deletar as informações %s\n", $conn->error);
            }

            header('Location: ../front/telas_funcoes.php?pg='.$_GET['pg'].'&tela='.$_GET['tela'].'&msn=5');

            break;
    }
?>