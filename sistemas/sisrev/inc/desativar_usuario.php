<?php
require_once('../../../config/session.php');
require_once('../../../config/sqlSmart.php');

switch ($_GET['acao']) {
    case '1': //ativar 
        switch ($_GET['sistema']) {
            case 'Apollo':
                $updateApolloGer = "UPDATE GER_USUARIO SET ativo = 'S' WHERE cpf = ".$_GET['cpf']."";
                $execUpdateApolloGer = oci_parse($connApollo, $updateApolloGer);
                oci_execute($execUpdateApolloGer);

                if (!$execUpdateApolloGer) {
                    $e = oci_error($connApollo);
                    trigger_error(htmlentities($e['Erro ao fazer o update do usuário na tabela GER_USUARIO do Apollo!']), E_USER_ERROR);
                }

                oci_free_statement($connApollo);
                oci_close($connApollo);

                $updateApolloFat = "UPDATE FAT_VENDEDOR SET ativo = 'S' WHERE cpf = ".$_GET['cpf']."";
                $execUpdateApolloFat = oci_parse($connApollo, $updateApolloFat);
                oci_execute($execUpdateApolloFat);

                if (!$execUpdateApolloFat) {
                    $e = oci_error($connApollo);
                    trigger_error(htmlentities($e['Erro ao fazer o update do usuário na tabela FAT_VENDEDOR do Apollo!']), E_USER_ERROR);
                }

                oci_free_statement($connApollo);
                oci_close($connApollo);

                header('Location: ../inc/desativarMysql.php?sistema='.$_GET['sistema'].'&cpf='.$_GET['cpf'].'&nome='.$_GET['nome'].'&acao='.$_GET['acao'].'&pg='.$_GET['pg'].'&tela='.$_GET['tela'].'');

                break;
            case 'Nbs':
                $updateAtivarNbs = "UPDATE EMPRESAS_USUARIOS SET demitido = 'N' WHERE cpf = '".$_GET['cpf']."' AND NOME = '".$_GET['nome']."'";
                $execAtivarNbs = oci_parse($connNbs, $updateAtivarNbs);
                oci_execute($execAtivarNbs);

                if (!$execAtivarNbs) {
                    $e = oci_error($connNbs);
                    trigger_error(htmlentities($e['Erro ao fazer o update do usuário no NBS!']), E_USER_ERROR);
                }

                oci_free_statement($connNbs);
                oci_close($connNbs);

                header('Location: ../inc/desativarMysql.php?sistema='.$_GET['sistema'].'&cpf='.$_GET['cpf'].'&nome='.$_GET['nome'].'&acao='.$_GET['acao'].'&pg='.$_GET['pg'].'&tela='.$_GET['tela'].'');

                break;
        }
        break;
    case '2': //desativar
        switch ($_GET['sistema']) {
            case 'Apollo':
                $updateApolloGer = "UPDATE GER_USUARIO SET ativo = 'N' WHERE cpf = ".$_GET['cpf']."";
                $execUpdateApolloGer = oci_parse($connApollo, $updateApolloGer);
                oci_execute($execUpdateApolloGer);

                if (!$execUpdateApolloGer) {
                    $e = oci_error($connApollo);
                    trigger_error(htmlentities($e['Erro ao fazer o update do usuário na tabela GER_USUARIO do Apollo!']), E_USER_ERROR);
                }

                oci_free_statement($connApollo);
                oci_close($connApollo);

                $updateApolloFat = "UPDATE FAT_VENDEDOR SET ativo = 'N' WHERE cpf = ".$_GET['cpf']."";
                $execUpdateApolloFat = oci_parse($connApollo, $updateApolloFat);
                oci_execute($execUpdateApolloFat);

                if (!$execUpdateApolloFat) {
                    $e = oci_error($connApollo);
                    trigger_error(htmlentities($e['Erro ao fazer o update do usuário na tabela FAT_VENDEDOR do Apollo!']), E_USER_ERROR);
                }

                oci_free_statement($connApollo);
                oci_close($connApollo);
                
                header('Location: ../inc/desativarMysql.php?sistema='.$_GET['sistema'].'&cpf='.$_GET['cpf'].'&acao='.$_GET['acao'].'&pg='.$_GET['pg'].'&tela='.$_GET['tela'].'');

                break;
            case 'Nbs':
                $updateDesativarNbs = "UPDATE EMPRESAS_USUARIOS SET demitido = 'S' WHERE cpf = '".$_GET['cpf']."' AND NOME = '".$_GET['nome']."'";
                $execDesativarNbs = oci_parse($connNbs, $updateDesativarNbs);
                oci_execute($execDesativarNbs);

                if (!$execDesativarNbs) {
                    $e = oci_error($connNbs);
                    trigger_error(htmlentities($e['Erro ao fazer o update do usuário no NBS!']), E_USER_ERROR);
                }

                oci_free_statement($connNbs);
                oci_close($connNbs);

                header('Location: ../inc/desativarMysql.php?sistema='.$_GET['sistema'].'&cpf='.$_GET['cpf'].'&nome='.$_GET['nome'].'&acao='.$_GET['acao'].'&pg='.$_GET['pg'].'&tela='.$_GET['tela'].'');

                break;
        }
        break;
}

?>
