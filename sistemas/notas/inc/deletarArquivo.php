<?php
require_once('../../../config/databases.php'); //banco de dados

//deletar arquivo no banco

$queryAnexo = "SELECT url_nota FROM cad_anexos WHERE ID = " . $_GET['idAnexo'];
$aplicaquery = $connNOTAS->query($queryAnexo);

while ($anexo = $aplicaquery->fetch_assoc()) {   
    
    $caminhoNota = "/var/www/html/unico/sistemas/notas/". substr($anexo['url_nota'], 3);

    unlink($caminhoNota);
}

$deletarAnexo = "DELETE FROM cad_anexos WHERE ID = " . $_GET['idAnexo'];
$aplicar = $connNOTAS->query($deletarAnexo);

header('Location: ../front/editLancarnota.php?id='.$_GET['id'].'&msn=14');//deletado com sucesso!