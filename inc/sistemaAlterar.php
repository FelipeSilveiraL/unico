<?php
require_once('../config/databases.php');

switch ($_GET['acao']) {
    case '1': //Novo
        # code...
        $queryNovo = "INSERT INTO cad_sistemas (nome, endereco) VALUES ('".$_POST['nome']."', '".$_POST['endereco']."')";
        if(!$resultNovo = $conn->query($queryNovo)){
            printf("Erro[11]: %s\n", $conn->error);
        }

        //PEGAR id_sistema
        $query = "SELECT MAX(id) AS id_sistema FROM cad_sistemas";
        $resultado = $conn->query($query);
        $id_sistema = $resultado->fetch_assoc();

        //SALVA
        foreach ($_POST['variavel'] as $key => $value) {
            $insertvariaveis = "INSERT INTO cad_variaveis_sistemas (id_sistema, variavel) VALUES ('" . $id_sistema['id_sistema'] . "', '" . $value . "')";
            $result = $conn->query($insertvariaveis);
        }

        header('Location: ../front/sistema.php?pg=' . $_GET['pg'] . '&conf=' . $_GET['conf'] . '&msn=8');
        $conn->close();
        break;

    case '2': //Editar

        $queryPrimeiro = "UPDATE cad_sistemas SET nome='" . $_POST['nome'] . "', endereco='" . $_POST['endereco'] . "' WHERE id='" . $_GET['id_sistema'] . "'";
        $result = $conn->query($queryPrimeiro);

        //deletando para salvar
        $delete = "DELETE FROM cad_variaveis_sistemas WHERE id_sistema = '" . $_GET['id_sistema'] . "'";
        $result = $conn->query($delete);

        //salvando

        foreach ($_POST['variavel'] as $key => $value) {
            $insertvariaveis = "INSERT INTO cad_variaveis_sistemas (id_sistema, variavel) VALUES ('" . $_GET['id_sistema'] . "', '" . $value . "')";
            $result = $conn->query($insertvariaveis);
        }

        header('Location: ../front/sistema.php?pg=' . $_GET['pg'] . '&conf=' . $_GET['conf'] . '&msn=4');
        $conn->close();
        break;

    case '3': //excluir

        $deleteSistema = "UPDATE cad_sistemas SET deletar ='1' WHERE id = '" . $_GET['id_sistema'] . "'";
        $result = $conn->query($deleteSistema);

        header('Location: ../front/sistema.php?pg=' . $_GET['pg'] . '&conf=' . $_GET['conf'] . '&msn=5');
        $conn->close();
        break;
}
