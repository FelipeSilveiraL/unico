<?php
require_once('../../../config/databases.php'); //banco de dados

$deletarCentroCusto = "DELETE FROM `cad_rateiocentrocusto` WHERE `ID_RATEIOCENTROCUSTO` = ".$_GET['idCentroCusto'];
$aplicar = $connNOTAS->query($deletarCentroCusto);

header('Location: ../front/rateioFornecedor.php?idRateioFornecedor=' . $_GET['idRateioFornecedor'] . '#rateioFornecedor');

?>