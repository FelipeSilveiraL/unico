<?php

require_once('../config/query.php');

$deletarFornecedor = "DELETE FROM cad_rateiofornecedor WHERE id = ".$_GET['idRateioFornecedor'];

$deletarCentroCusto = "DELETE FROM cad_rateiocentrocusto WHERE id_rateiofornecedor = ".$_GET['idRateioFornecedor'];

$deletarBanco = "DELETE FROM cad_rateiobanco WHERE id_rateiofornecedor = ".$_GET['idRateioFornecedor'];

$fornecedor = $connNOTAS->query($deletarFornecedor);
$centroCusto = $connNOTAS->query($deletarCentroCusto);
$bancos = $connNOTAS->query($deletarBanco);

header('Location: ../front/fornecedor.php?msn=5');
?>