<?php
require_once('../config/query.php');

$deletarCentroCusto = "DELETE FROM `cad_rateiocentrocusto` WHERE `ID`=".$_GET['idCentroCusto'];
$aplicar = $connNOTAS->query($deletarCentroCusto);

header('Location: ../front/rateioFornecedor.php?idRateioFornecedor=' . $_GET['idRateioFornecedor'] . '#rateioFornecedor');

?>