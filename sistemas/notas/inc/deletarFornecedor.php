<?php
require_once('../../../config/databases.php');

$deletarFornecedor = "DELETE FROM cad_rateiofornecedor WHERE ID_RATEIOFORNECEDOR = ".$_GET['idRateioFornecedor'];

$deletarCentroCusto = "DELETE FROM cad_rateiocentrocusto WHERE ID_RATEIOFORNECEDOR = ".$_GET['idRateioFornecedor'];

$deletarBanco = "DELETE FROM cad_rateiobanco WHERE ID_RATEIOFORNECEDOR = ".$_GET['idRateioFornecedor'];

$fornecedor = $connNOTAS->query($deletarFornecedor);
$centroCusto = $connNOTAS->query($deletarCentroCusto);
$bancos = $connNOTAS->query($deletarBanco);

header('Location: ../front/fornecedor.php?msn=5');
?>