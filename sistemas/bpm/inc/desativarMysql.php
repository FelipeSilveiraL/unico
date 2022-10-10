<?php
session_start();
require_once('../config/query.php');

switch ($_GET['acao']) {
    case '1'://ativar 
        switch ($_GET['sistema']) {
            case 'Apollo':
                $updateApollo = "UPDATE cad_usuario_api 
                                SET 
                                    ativo = 'S'
                                WHERE
                                    cpf = '" .$_GET['cpf']. "'
                                AND sistema = '" .$_GET['sistema']. "'";

                $execUpdateApollo = $conn->query($updateApollo);

                if (!$execUpdateApollo = $conn->query($updateApollo)) {
                    echo "Error: " . $updateApollo . "<br>" . $conn->error;
                }

                header('Location: ../front/desativar_usuario.php?pg='.$_GET['pg'].'&tela='.$_GET['tela'].'&saida=1&cpf='.$_GET['cpf'].'');
                
                break;
            case 'Nbs':
                $updateNbs = "UPDATE cad_usuario_api 
                                SET 
                                    ativo = 'S'
                                WHERE
                                    cpf = '" .$_GET['cpf']. "'
                                AND sistema = '" .$_GET['sistema']. "'
                                AND nome = '".$_GET['nome']."'";

                $execUpdateNbs = $conn->query($updateNbs);

                if (!$execUpdateNbs = $conn->query($execUpdateNbs)) {
                    echo "Error: " . $execUpdateNbs . "<br>" . $conn->error;
                }

                header('Location: ../front/desativar_usuario.php?pg='.$_GET['pg'].'&tela='.$_GET['tela'].'&saida=1&cpf='.$_GET['cpf'].'');

                break;
        }
        break;
        
    case '2'://desativar
        switch ($_GET['sistema']) {
            case 'Apollo':
                $updateApollo = "UPDATE cad_usuario_api 
                                SET 
                                    ativo = 'N'
                                WHERE
                                    cpf = '" .$_GET['cpf']. "'
                                AND sistema = '" .$_GET['sistema']. "'";

                $execUpdate = $conn->query($updateApollo);

                if (!$execUpdate = $conn->query($updateApollo)) {
                    echo "Error: " . $updateApollo . "<br>" . $conn->error;
                }

                header('Location: ../front/desativar_usuario.php?pg='.$_GET['pg'].'&tela='.$_GET['tela'].'&saida=1&cpf='.$_GET['cpf'].'');

                break;
            case 'Nbs':
                $updateNbs = "UPDATE cad_usuario_api 
                                SET 
                                    ativo = 'N'
                                WHERE
                                    cpf = '" .$_GET['cpf']. "'
                                AND sistema = '" .$_GET['sistema']. "'
                                AND nome = '".$_GET['nome']."'";

                $execUpdateNbs = $conn->query($updateNbs);

                if (!$execUpdateNbs = $conn->query($execUpdateNbs)) {
                    echo "Error: " . $execUpdateNbs . "<br>" . $conn->error;
                }

                header('Location: ../front/desativar_usuario.php?pg='.$_GET['pg'].'&tela='.$_GET['tela'].'&saida=1&cpf='.$_GET['cpf'].'');

                break;
        }
        break;
}

?>