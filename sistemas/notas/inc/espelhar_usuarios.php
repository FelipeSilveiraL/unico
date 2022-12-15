<?php
require_once('../config/query.php');

switch ($_GET['acao']) {
    case '1': //ADIÇÃO
        if (!empty($_POST['idUsuarioadicionar'])) {

            $queryEspelho = "INSERT INTO cad_espelho (id_usuariopai, id_usuariofilho) VALUES ('" . $_POST['idUsuarioadicionar'] . "', '" . $_GET['idUsuario'] . "')";
            $msn = '8';
        } else {
            echo '<script>window.location.href = "../front/espelhar_usuarios.php?pg=' . $_GET['pg'] . '&tela=' . $_GET['tela'] . '&idUsuario=' . $_GET['idUsuario'] . '";</script>';
            exit;
        }
        break;

    case '2': //EXCLUIR
        $queryEspelho = "DELETE FROM cad_espelho WHERE id_usuariofilho = '" . $_GET['idUsuario'] . "' AND id_usuariopai = '" . $_GET['idUsuarioremover'] . "'";
        $msn = '1';
        break;
}

if (!$result = $connNOTAS->query($queryEspelho)) {
    echo "Erro[1]: Contate o administrador";
} else {
    echo '<script>window.location.href = "../front/espelhar_usuarios.php?pg=' . $_GET['pg'] . '&tela=' . $_GET['tela'] . '&idUsuario=' . $_GET['idUsuario'] . '&msn=' . $msn . '";</script>';
}
