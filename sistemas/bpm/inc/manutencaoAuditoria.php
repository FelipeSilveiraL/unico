<?php 
require_once('../config/query.php');

$limiteNotaDespesa = $_POST['limiteNotaDespesa'];
$limiteFechamentoCaixa = $_POST['limiteFechamentoCaixa'];
$limiteNF = $_POST['limiteNotaFiscal'];

$query = "UPDATE 
    auditoria 
        SET 
        LIMITE_NOTA_DESPESA = ".$limiteNotaDespesa.",
        LIMITE_FECHAMENTO_CAIXA = ".$limiteFechamentoCaixa.",
        LIMITE_NOTA_FISCAL = ".$limiteNF."
            WHERE
                 ID_AUDITORIA = 1";

    $sucesso = oci_parse($connBpmgp, $query);

    if(oci_execute($sucesso)){

        header('Location: ../front/manutencaoAuditoria.php?pg='.$_GET['pg'].'&msn=4');
        oci_free_statement($sucesso);

    }else{
        
        header('Location: ../front/manutencaoAuditoria.php?pg='.$_GET['pg'].'&msn=13');
        oci_free_statement($sucesso);

    }

oci_close($connBpmgp);
