<?php
require_once('../config/query.php');

switch ($_GET['acao']) {
    case '1': //Inserção na tabela sisrev_funcao
        $insertFuncao = "INSERT INTO sisrev_funcao (nome, descricao, id_modulos)
                        VALUES ('".$_POST['nome']."' ,'" .$_POST['descricao']. "', '" .$_POST['tela']. "')";

        if (!$resultInsertFuncao = $conn->query($insertFuncao)){
            printf("Erro ao inserir nova Função %s\n", $conn->error);
        }

        //Fechando o banco    
        $conn->close();
        
        header('Location: ../front/telas_funcoes.php?pg='.$_GET['pg'].'&tela='.$_GET['tela'].'&f=1&msn=8');
        
        break;    
    case '2': //Edição na tabela sisrev_funcao
        $updateFuncao = "UPDATE sisrev_funcao set descricao = '".$_POST['descricao']."', 
                                        id_modulos = '".$_POST['tela']."'
                            WHERE id_funcao = '".$_GET['id']."'";

        if (!$resultUpdateFuncao = $conn->query($updateFuncao)){
            printf("Erro ao editar a Função %s\n", $conn->error);
        }

        //Fechando o banco    
        $conn->close();

        header('Location: ../front/telas_funcoes.php?pg='.$_GET['pg'].'&tela='.$_GET['tela'].'&f=1&msn=4');

        break;
    case '3': //Apagando na tabela sisrev_funcao
        $deleteFuncao = "DELETE FROM sisrev_funcao WHERE id_funcao = '".$_GET['id']."'";

        if (!$resultDeleteFuncao = $conn->query($deleteFuncao)){
            printf("Erro ao deletar a Função %s\n", $conn->error);
        }
        
        //Fechando o banco    
        $conn->close();

        header('Location: ../front/telas_funcoes.php?pg='.$_GET['pg'].'&tela='.$_GET['tela'].'&f=1&msn=14');
        
        break;
    case '4':
        //Limpando todas as funções do usuário
        $queryLimpar = "DELETE FROM sisrev_usuario_funcao WHERE id_usuario = ".$_GET['id']."";
        $resultLimpar = $conn->query($queryLimpar);

        //Salvando todas as funções do usuário
        foreach ($_POST['funcao'] as $key => $value) {
        $queryInsert = "INSERT INTO sisrev_usuario_funcao (id_funcao, id_usuario) VALUES ('".$value."', '".$_GET['id']."')";
        $resultado = $conn->query($queryInsert);
        }

        //Fechando o banco    
        $conn->close();

        header('Location: ../front/usuarios.php?pg='.$_GET['pg'].'&msn=4');//msn 4 = Editado com sucesso!

        break;
        
}

?>