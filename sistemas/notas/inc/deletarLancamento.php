<?php

require_once('../config/query.php');

//Deletar lançemento
$deletar = "DELETE FROM cad_lancarnotas WHERE `ID_LANCARNOTAS` = " . $_GET['id'];
$aplicar = $connNOTAS->query($deletar);

//deletar anexo

$queryAnexo = "SELECT url_nota FROM cad_anexos WHERE ID_LANCARNOTA = " . $_GET['id'];
$aplicaquery = $connNOTAS->query($queryAnexo);

$caminhoNota = "/var/www/html/unico/sistemas/notas/";

while ($anexo = $aplicaquery->fetch_assoc()) {    
    unlink($caminhoNota . $anexo['url_nota']);
}

$deletarAnexo = "DELETE FROM cad_anexos WHERE `ID_LANCARNOTA` = " . $_GET['id'];
$aplicar = $connNOTAS->query($deletarAnexo);

header('Location: ../front/index.php?pg=1&msn=14');//deletado com sucesso!