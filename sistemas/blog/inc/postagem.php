<?php
session_start();
require_once('../config/query.php');
require_once('../funcoes/funcoes.php');

switch ($_GET['funcao']) {
    case '1': // adicionar.


        $caminhoPasta = '../postagens/';
        $caminhoBanco = $caminhoPasta . date('dmY') . $_FILES['imagemVideo']['name'];

        //veficando o tipo do arquivo
        $queryTipo = "SELECT * FROM blog_file_upload WHERE type = '" . $_FILES['imagemVideo']['type'] . "' ";
        $result = $connBlog->query($queryTipo);

        if (!$tipo = $result->fetch_assoc()) {

            header('location: ../front/novaPostagem.php?pg=' . $_GET['pg'] . '&msn=10&erro=3'); //erro arquivo invalido

        } else {

            //sobe o arquivo
            if (move_uploaded_file($_FILES['imagemVideo']['tmp_name'], $caminhoBanco)) {

                //insert da postagem
                $insertPOstagem = "INSERT INTO `blog_post`
                (`id_post_user`,
                `tipo_postagem`,
                `tipo_arquivo`,
                `titulo`,
                `mensagem`,
                `file_img`,
                `data`,
                `data_drop`,
                `alerta_comentario`)
                VALUES
                (" . $_SESSION['id_usuario'] . ",
                ";
                $insertPOstagem .=  ($_POST['gridRadios'] == 'option1') ? 0 : 1;
                $insertPOstagem .= ",
                '" . $_FILES['imagemVideo']['type'] . "',
                '" . $_POST['titulo'] . "',
                '" . caracteres($_POST['mensagemTexto']) . "',
                '" . $caminhoBanco . "',
                '" . date('Y-m-d') . "',
                '";
                $insertPOstagem .= empty($_POST['dateDrop']) ? '0000-00-00' : $_POST['dateDrop'];
                $insertPOstagem .= "',
                " . $_POST['alertaDeComentarios'] . ")";

                if ($result = $connBlog->query($insertPOstagem)) {
                    header('location: ../front/novaPostagem.php?pg=' . $_GET['pg'] . '&msn=8'); //postagem realizado com sucesso
                } else {
                    header('location: ../front/novaPostagem.php?pg=' . $_GET['pg'] . '&msn=10&erro=14'); //não foi possivel realizar a postagem
                }
            } else {
                header('location: ../front/novaPostagem.php?pg=' . $_GET['pg'] . '&msn=10&erro=2'); //não foi possivek subir o arquivo
            }
        }

        break;

    case '2': // editar.
        # code...


        if (!empty($_FILES['imagemVideo']['name'])) {

            $caminhoPasta = '../postagens/';
            $caminhoBanco = $caminhoPasta . date('dmY') . $_FILES['imagemVideo']['name'];

            //veficando o tipo do arquivo
            $queryTipo = "SELECT * FROM blog_file_upload WHERE type = '" . $_FILES['imagemVideo']['type'] . "' ";
            $result = $connBlog->query($queryTipo);

            if (!$tipo = $result->fetch_assoc()) {

                header('location: ../front/novaPostagem.php?pg=' . $_GET['pg'] . '&msn=10&erro=3'); //erro arquivo invalido
                exit;
            } else {

                if (move_uploaded_file($_FILES['imagemVideo']['tmp_name'], $caminhoBanco)) {

                    $camposBanco = ",`file_img` = '" . $caminhoBanco . "', `tipo_arquivo` = '" . $_FILES['imagemVideo']['type'] . "' ";
                } else {
                    header('location: ../front/novaPostagem.php?pg=' . $_GET['pg'] . '&msn=10&erro=2'); //não foi possivek subir o arquivo
                    exit;
                }
            }
        }

        $updatePOstagem = " UPDATE `blog_post`
                                SET
                                `tipo_postagem` = ";
        $updatePOstagem .= ($_POST['gridRadios'] == 'option1') ? 0 : 1;
        $updatePOstagem .= ",
                                `titulo` = '" . $_POST['titulo'] . "',
                                `mensagem` = '" . caracteres($_POST['mensagemTexto']) . "',
                                `data_drop` = '";
        $updatePOstagem .= empty($_POST['dateDrop']) ? '0000-00-00' : $_POST['dateDrop'];
        $updatePOstagem .= "',
                                `alerta_comentario` = " . $_POST['alertaDeComentarios'] . $camposBanco . "                                
                                WHERE `id_postagem` = " . $_GET['id_postagem'];


        if ($result = $connBlog->query($updatePOstagem)) {
            header('location: ../front/novaPostagem.php?pg=' . $_GET['pg'] . '&msn=4&&id_post='. $_GET['id_postagem'].''); //editado com sucesso
        } else {
            header('location: ../front/novaPostagem.php?pg=' . $_GET['pg'] . '&msn=10&erro=15&id_post='. $_GET['id_postagem'].''); //não foi possivel realizar a edição
        }

        break;

    case '3': // desativar.
        $updateDeletar = "UPDATE `blog_post` SET `deletar` = '1' WHERE (`id_postagem` = '" . $_GET['id_post'] . "')";

        if ($result = $connBlog->query($updateDeletar)) {
            header('location: ../front/postagens.php?pg=' . $_GET['pg'] . '&msn=5'); //desativado com sucesso
        }

        break;

    case '4': // ativar.
        $updateAtivar = "UPDATE `blog_post` SET `deletar` = '0' WHERE (`id_postagem` = '" . $_GET['id_post'] . "')";
        if ($result = $connBlog->query($updateAtivar)) {
            header('location: ../front/postagens.php?pg=' . $_GET['pg'] . '&msn=6'); //Ativado com sucesso        
        }

        break;

    case '5': // excluir.
        # code...
        break;
}


$connBlog->clone();