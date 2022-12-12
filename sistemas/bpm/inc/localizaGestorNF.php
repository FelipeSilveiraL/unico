<?php 
session_start();
require_once('../config/query.php');

$nomeGestor = $_POST['nomeGestor'];
$nomeGestor = ctype_digit($nomeGestor) ? true : false;

if ($nomeGestor == true){
    $nomeGestor = strlen($_POST['nomeGestor']);
    $nomeGestor = substr($_POST['nomeGestor'], 0 , -5);
    
    $queryUserApi = " SELECT
        DS_USUARIO,
        DS_LOGIN,
        CD_USUARIO,
        DS_EMAIL
    FROM
       bpm_usuarios_smartshare
    WHERE
        ST_ATIVO = 1
    AND CD_USUARIO NOT IN ( 1, 23, 24, 22, 16681,
                                18110, 18111, 18112, 18113, 18484,
                                18485, 18486, 18529, 18340, 16680,
                                18782)
    AND DS_USUARIO LIKE '%".strtoupper($_POST['nomeGestor'])."%' OR DS_LOGIN LIKE '%".strtolower($nomeGestor)."%'";
    
}else{
    $queryUserApi = " SELECT
    DS_USUARIO,
    DS_LOGIN,
    CD_USUARIO,
    DS_EMAIL
FROM
   bpm_usuarios_smartshare
WHERE
    ST_ATIVO = 1
AND CD_USUARIO NOT IN ( 1, 23, 24, 22, 16681,
                            18110, 18111, 18112, 18113, 18484,
                            18485, 18486, 18529, 18340, 16680,
                            18782)
AND DS_USUARIO LIKE '%".strtoupper($_POST['nomeGestor'])."%' OR DS_LOGIN LIKE '%".strtolower($_POST['nomeGestor'])."%'";

}

$conexao = $conn->query($queryUserApi);

while($row = $conexao->fetch_assoc()){
    $login = $row['DS_LOGIN'];
    $usuario = $row['DS_USUARIO'];
}

if($usuario != NULL){
    header('Location: ../front/gestorNF.php?pg='.$_GET['pg'].'&dado=1&login='.$login.'&usuario='.$usuario.'');
}else{
    header('Location: ./front/gestorNF.php?pg='.$_GET['pg'].'&erro=1');
}
$conn->close();
?>
