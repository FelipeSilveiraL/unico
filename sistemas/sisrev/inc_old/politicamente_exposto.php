<?php
session_start();
require_once('../config/query.php');



if ($_GET['confirma'] == 1) {
  header("Location: http://" . $_SESSION['servidorOracle'] . "/unico_api/sisrev/inc/politicamente_exposto.php?pg=".$_GET['pg']."&tela=".$_GET['tela']."&confirma=1");
} else {
  if ($_FILES['arquivo']["type"] === "text/csv") {

    //SUBINDO O ARQUIVO NO SERVIDOR

    $nome = date('dmYhi') . $_FILES['arquivo']['name'];

    $uploaddir = '/var/www/html/unico/sistemas/sisrev/documentos/PE/';
    $uploadfile = $uploaddir . basename($nome);


    if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploadfile)) {

      //SALVANDO LOG
      $queryLOG = "INSERT INTO sisrev_arquivo_PE (caminho, nome_arquivo , data, id_usuario) VALUES ('" . $uploadfile . "','" . $_FILES['arquivo']['name'] . "', '" . date('Y-m-d H:i:s') . "', '" . $_SESSION['id_usuario'] . "')";

      if (!$resultadoLOG = $conn->query($queryLOG)) {
        header('location: ../front/politicamente_exposto.php?pg=' . $_GET['pg'] . '&tela=' . $_GET['tela'] . '&msn=10&erro=1');
      } else {

        // 1 - Deletando a tabela com os dados antigos
        $resultDropPE = $conn->query($droptablePE);
        // 2 - Criando a tabela para receber os dados novos
        $resultCreatPE = $conn->query($createtablePE);
        // 3 - Inserindos os dados novos
        $object = fopen($uploadfile, 'r');
        $i = 1;
        while (($dados = fgetcsv($object, 1000, ";")) !== false) {

          if ($i != 1) {
            $insertPE = "INSERT INTO sisrev_politicamente_exposto (`CPF_PEP`,`Nome_PEP`)VALUES ('".utf8_encode($dados[0])."','".utf8_encode($dados[1])."')";

            if (!$resultInsertPE = $conn->query($insertPE)) {
              header('location: ../front/politicamente_exposto.php?pg=' . $_GET['pg'] . '&tela=' . $_GET['tela'] . '&msn=10&erro=4');
              exit();
            }
          }
          $i++;
        }
        //FINALIZADO
        $_SESSION['count'] = $i;
        header('location: ../front/politicamente_exposto.php?pg=' . $_GET['pg'] . '&tela=' . $_GET['tela'] . '');
      }
    } else {
      header('location: ../front/politicamente_exposto.php?pg=' . $_GET['pg'] . '&tela=' . $_GET['tela'] . '&msn=10&erro=2');
    }
  } else {
    header('location: ../front/politicamente_exposto.php?pg=' . $_GET['pg'] . '&tela=' . $_GET['tela'] . '&msn=10&erro=3');
  }
}// end if $_GET['confirma'] == 1
