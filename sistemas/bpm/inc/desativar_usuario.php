<?php
session_start();
require_once('../config/query.php');

switch ($_GET['acao']) {    
    case '1'://ativar
        switch ($_GET['sistema']) {
            case 'Apollo':                
                header('Location: http://'.$_SESSION['servidorOracle'].'/unico_api/sisrev/desativar_usuario.php?sistema=Apollo&cpf='.$_GET['cpf'].'&ativo=S');
                break;            
            case 'Nbs':                
                header('Location: http://'.$_SESSION['servidorOracle'].'/unico_api/sisrev/desativar_usuario.php?sistema=Nbs&cpf='.$_GET['cpf'].'&ativo=S');                
                break;
        }
        break;    
    case '2'://desativar
        switch ($_GET['sistema']) {
            case 'Apollo':                
                header('Location: http://'.$_SESSION['servidorOracle'].'/unico_api/sisrev/desativar_usuario.php?sistema=Apollo&cpf='.$_GET['cpf'].'&ativo=N');
                break;            
            case 'Nbs':                
                header('Location: http://'.$_SESSION['servidorOracle'].'/unico_api/sisrev/desativar_usuario.php?sistema=Nbs&cpf='.$_GET['cpf'].'&ativo=N');                
                break;
        }        
        break;
}

?> 