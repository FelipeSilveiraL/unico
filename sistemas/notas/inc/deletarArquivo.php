<?php
require_once('../../../config/databases.php'); //banco de dados

//deletar arquivo no banco

$queryAnexo = "SELECT url_nota FROM cad_anexos WHERE ID = " . $_GET['idAnexo'];
$aplicaquery = $connNOTAS->query($queryAnexo);

$caminhoNota = "/var/www/html/unico/sistemas/notas/";

while ($anexo = $aplicaquery->fetch_assoc()) {    
    unlink($caminhoNota . $anexo['url_nota']);
}

$deletarAnexo = "DELETE FROM cad_anexos WHERE ID = " . $_GET['idAnexo'];
$aplicar = $connNOTAS->query($deletarAnexo);

header('Location: ../front/editLancarnota.php?id='.$_GET['id'].'&msn=14');//deletado com sucesso!