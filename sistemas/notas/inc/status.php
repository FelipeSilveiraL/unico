<?php

require_once('../config/query.php');



switch ($_GET['status']) {
    case '1': //AGUARDANDO LANÇAMENTO        
        $queryNotas .= "WHERE CL.ID_USUARIO = '".$_SESSION['id_usuario']."' AND CL.status_desc = 1 AND CL.deletar = 0 ".$dataMes;
        $nomeTabela = 'Notas em lançamento <span>| deste mês</span>';
        break;

    case '2': //PENDENTE
        $queryNotas .= "WHERE CL.ID_USUARIO = '".$_SESSION['id_usuario']."' AND CL.status_desc = 2 AND CL.deletar = 0";
        $nomeTabela = 'Notas com dados pendentes';
        break;

    case '3': //LANÇADO        
        $queryNotas .= "WHERE CL.ID_USUARIO = '".$_SESSION['id_usuario']."' AND CL.status_desc = 3 AND CL.deletar = 0 ".$dataMes;
        $nomeTabela = 'Notas já lançadas <span>| deste mês</span>';
        break;

    case 'erro': //ERRO        
        $queryNotas .= "WHERE CL.ID_USUARIO = '".$_SESSION['id_usuario']."' AND CS.erro = 1 AND CL.deletar = 0";
        $nomeTabela = 'Notas com erro ';
        break;

    default:
        $queryNotas .= "WHERE CL.ID_USUARIO = '".$_SESSION['id_usuario']."' AND CL.deletar = 0 ".$dataMes;
        $nomeTabela = 'Todas as notas  <span>| deste mês</span>';
        break;
}

$resultado = $connNOTAS->query($queryNotas);