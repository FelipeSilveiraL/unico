<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Efetuando carga</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        body {
            align-items: center;
            display: flex;
            justify-content: center;
            min-height: 97vh;
        }
    </style>
</head>
<?php require_once('text_politicamenteE.php') ?>

<body>
    <div class="container-sm">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Atualizando Preço Peças</h5>
                <br>
                <ul class="list-group">
                    <li class="list-group-item px-4 p-3">
                        <div class="d-flex align-items-center">
                            <strong>Aguarde - logo você será redirecionado!</strong>
                            <div class="spinner-border ms-auto text-danger" role="status" aria-hidden="true"></div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</html>

<?php
require_once('../../../session/session.php');
require_once('../../config/query.php');

$empresa = $_GET['empresa'];
$dataHoje = date('d/m/Y');
$count = 0;
$numMaximo = 1000;

switch ($empresa) {
    case '55': //TRIUMPH
        //coletando os dados
        $queryTriumph = "SELECT item, rrp FROM sisrev_atualizacao_preco_triumph WHERE status_item is null";
        $resultTriumph = $connUNICO->query($queryTriumph);

        while ($triumph = $resultTriumph->fetch_assoc()) {

            if ($count < $numMaximo) { //procurar no apollo o item
                $queryApolloItem = "SELECT 
                                        PIE.ITEM_ESTOQUE AS xitem_estoque,
                                        PIE.DES_ITEM_ESTOQUE AS xdes_item_estoque,
                                        PIE.PRECO_PUBLICO_ATUAL AS xpreco_atual            
                                    FROM PEC_ITEM_ESTOQUE PIE WHERE PIE.EMPRESA = " . $empresa . " AND PIE.ITEM_ESTOQUE_PUB = '" . $triumph['item'] . "'";

                $result = oci_parse($connApollo, $queryApolloItem);
                oci_execute($result);

                if ($triumphApollo = oci_fetch_array($result, OCI_ASSOC + OCI_RETURN_NULLS)) {

                    //############## HISTÓRCO DO ITEM ############## 

                    $queryItemHistorico = "SELECT PPH.ITEM_ESTOQUE FROM PEC_PRECO_HISTORICO PPH WHERE PPH.EMPRESA = " . $empresa . " AND PPH.ITEM_ESTOQUE = " . $triumphApollo['XITEM_ESTOQUE'];
                    $resultItemHistorico = oci_parse($connApollo, $queryItemHistorico);
                    oci_execute($resultItemHistorico);

                    if (!$itemHistorico = oci_fetch_array($resultItemHistorico, OCI_ASSOC + OCI_RETURN_NULLS)) {

                        $insertHistoricoItem = "INSERT INTO PEC_PRECO_HISTORICO (EMPRESA, ITEM_ESTOQUE, DTA_PRECO, PRECO_PUBLICO) VALUES (" . $empresa . ", " . $triumphApollo['XITEM_ESTOQUE'] . ", to_date('" . $dataHoje . "','dd/mm/yy'), '" . $triumphApollo['XPRECO_ATUAL'] . "')";
                        $resultinsertHistoricoItem = oci_parse($connApollo, $insertHistoricoItem);

                        oci_execute($resultinsertHistoricoItem);
                        oci_free_statement($resultinsertHistoricoItem);

                        /* $e = oci_error($resultinsertHistoricoItem);
                        print htmlentities($e['message']);
                        print "\n<pre>\n";
                        print htmlentities($e['sqltext']);
                        printf("\n%".($e['offset']+1)."s", "^");
                        print  "\n</pre>\n"; */
                    }

                    //############## REALIZANDO A COMPARAÇÃO DOS PREÇOS ##############

                    //MAIOR
                    if ($triumph['rrp'] > $triumphApollo['XPRECO_ATUAL']) {

                        //ATUALIZA PREÇO PUBICO ANTERIOR
                        $updateAnterior = "UPDATE PEC_ITEM_ESTOQUE SET PRECO_PUBLICO_ANTER = '" . $triumphApollo['XPRECO_ATUAL'] . "' WHERE EMPRESA = " . $empresa . " AND ITEM_ESTOQUE = '" . $triumphApollo['XITEM_ESTOQUE'] . "'";
                        $resultadoAnterior = oci_parse($connApollo, $updateAnterior);
                        oci_execute($resultadoAnterior);
                        oci_free_statement($resultadoAnterior);

                        //ATUALIZA PREÇO ATUAL
                        $updateAtual = "UPDATE PEC_ITEM_ESTOQUE SET PRECO_PUBLICO_ATUAL = '" . $triumph['rrp'] . "' WHERE EMPRESA = " . $empresa . " AND ITEM_ESTOQUE = '" . $triumphApollo['XITEM_ESTOQUE'] . "'";
                        $resultadoAtual = oci_parse($connApollo, $updateAtual);
                        oci_execute($resultadoAtual);
                        oci_free_statement($resultadoAtual);

                        //INFORMA USUARIO QUE FOI ALTERADO
                        $alerta = "UPDATE sisrev_atualizacao_preco_triumph SET status_item = 'Atualizado valor', rrp_apollo = " . $triumphApollo['XPRECO_ATUAL'] . "  WHERE item = '" . $triumph['item'] . "'";
                        $resultadoalerta = $connUNICO->query($alerta);
                    }

                    //MENOR
                    if ($triumph['rrp'] < $triumphApollo['XPRECO_ATUAL']) {
                        if ($_GET['forcar'] == 1) { //forçar = 1 foi autorizado pelo usuário
                            //ATUALIZA PREÇO PUBICO ANTERIOR
                            $updateAnterior = "UPDATE PEC_ITEM_ESTOQUE SET PRECO_PUBLICO_ANTER = '" . $triumphApollo['XPRECO_ATUAL'] . "' WHERE EMPRESA = " . $empresa . " AND ITEM_ESTOQUE = '" . $triumphApollo['XITEM_ESTOQUE'] . "'";
                            $resultadoAnterior = oci_parse($connApollo, $updateAnterior);
                            oci_execute($resultadoAnterior);
                            oci_free_statement($resultadoAnterior);

                            //ATUALIZA PREÇO ATUAL
                            $updateAtual = "UPDATE PEC_ITEM_ESTOQUE SET PRECO_PUBLICO_ATUAL = '" . $triumph['rrp'] . "' WHERE EMPRESA = " . $empresa . " AND ITEM_ESTOQUE = '" . $triumphApollo['XITEM_ESTOQUE'] . "'";
                            $resultadoAtual = oci_parse($connApollo, $updateAtual);
                            oci_execute($resultadoAtual);
                            oci_free_statement($resultadoAtual);

                            //INFORMA USUARIO QUE FOI ALTERADO
                            $alerta = "UPDATE sisrev_atualizacao_preco_triumph SET status_item = 'Atualizado valor', rrp_apollo = " . $triumphApollo['XPRECO_ATUAL'] . "  WHERE item = '" . $triumph['item'] . "'";
                            $resultadoalerta = $connUNICO->query($alerta);
                        } else {
                            $alerta = "UPDATE sisrev_atualizacao_preco_triumph SET status_item = 'Não atualizado, valor menor', rrp_apollo = " . $triumphApollo['XPRECO_ATUAL'] . "  WHERE item = '" . $triumph['item'] . "'";
                            $resultadoalerta = $connUNICO->query($alerta);
                        }
                    }

                    //IGUAL
                    if ($triumph['rrp'] == $triumphApollo['XPRECO_ATUAL']) {
                        $alerta = "UPDATE sisrev_atualizacao_preco_triumph SET status_item = 'Mesmo valor', rrp_apollo = " . $triumphApollo['XPRECO_ATUAL'] . "  WHERE item = '" . $triumph['item'] . "'";
                        $resultadoalerta = $connUNICO->query($alerta);
                    }

                    oci_free_statement($resultItemHistorico);
                } else {
                    $alerta = "UPDATE sisrev_atualizacao_preco_triumph SET status_item = 'Não encontrei' WHERE item = '" . $triumph['item'] . "'";
                    $resultadoalerta = $connUNICO->query($alerta);
                }

                oci_close($connApollo);
            } else {
                $part = 1 + empty($_GET['part']) ? 0 : $_GET['part'];
                header('Location: http://' . $_SERVER['SERVER_ADDR'] . '/unico_api/sisrev/inc/atualizacaoPecas.php?pg=' . $_GET['pg'] . '&empresa=' . $empresa . '&forcar=' . $_GET['forcar'] . '&acao=1&part=' . $part . '');
                exit;
            }

            $count++;
        }
        break;
    case '56': //DUCATI
        //coletando os dados
        $queryTriumph = "SELECT item, rrp FROM sisrev_atualizacao_preco_ducati WHERE status_item is null";
        $resultTriumph = $connUNICO->query($queryTriumph);

        while ($triumph = $resultTriumph->fetch_assoc()) {

            if ($count < $numMaximo) { //procurar no apollo o item
                $queryApolloItem = "SELECT 
                                            PIE.ITEM_ESTOQUE AS xitem_estoque,
                                            PIE.DES_ITEM_ESTOQUE AS xdes_item_estoque,
                                            PIE.PRECO_PUBLICO_ATUAL AS xpreco_atual            
                                        FROM PEC_ITEM_ESTOQUE PIE WHERE PIE.EMPRESA = " . $empresa . " AND PIE.ITEM_ESTOQUE_PUB = '" . $triumph['item'] . "'";

                $result = oci_parse($connApollo, $queryApolloItem);
                oci_execute($result);

                if ($triumphApollo = oci_fetch_array($result, OCI_ASSOC + OCI_RETURN_NULLS)) {

                    //############## HISTÓRCO DO ITEM ############## 

                    $queryItemHistorico = "SELECT PPH.ITEM_ESTOQUE FROM PEC_PRECO_HISTORICO PPH WHERE PPH.EMPRESA = " . $empresa . " AND PPH.ITEM_ESTOQUE = " . $triumphApollo['XITEM_ESTOQUE'];
                    $resultItemHistorico = oci_parse($connApollo, $queryItemHistorico);
                    oci_execute($resultItemHistorico);

                    if (!$itemHistorico = oci_fetch_array($resultItemHistorico, OCI_ASSOC + OCI_RETURN_NULLS)) {

                        $insertHistoricoItem = "INSERT INTO PEC_PRECO_HISTORICO (EMPRESA, ITEM_ESTOQUE, DTA_PRECO, PRECO_PUBLICO) VALUES (" . $empresa . ", " . $triumphApollo['XITEM_ESTOQUE'] . ", to_date('" . $dataHoje . "','dd/mm/yy'), '" . $triumphApollo['XPRECO_ATUAL'] . "')";
                        $resultinsertHistoricoItem = oci_parse($connApollo, $insertHistoricoItem);

                        oci_execute($resultinsertHistoricoItem);
                        oci_free_statement($resultinsertHistoricoItem);

                        /* $e = oci_error($resultinsertHistoricoItem);
                            print htmlentities($e['message']);
                            print "\n<pre>\n";
                            print htmlentities($e['sqltext']);
                            printf("\n%".($e['offset']+1)."s", "^");
                            print  "\n</pre>\n"; */
                    }

                    //############## REALIZANDO A COMPARAÇÃO DOS PREÇOS ##############

                    //MAIOR
                    if ($triumph['rrp'] > $triumphApollo['XPRECO_ATUAL']) {

                        //ATUALIZA PREÇO PUBICO ANTERIOR
                        $updateAnterior = "UPDATE PEC_ITEM_ESTOQUE SET PRECO_PUBLICO_ANTER = '" . $triumphApollo['XPRECO_ATUAL'] . "' WHERE EMPRESA = " . $empresa . " AND ITEM_ESTOQUE = '" . $triumphApollo['XITEM_ESTOQUE'] . "'";
                        $resultadoAnterior = oci_parse($connApollo, $updateAnterior);
                        oci_execute($resultadoAnterior);
                        oci_free_statement($resultadoAnterior);

                        //ATUALIZA PREÇO ATUAL
                        $updateAtual = "UPDATE PEC_ITEM_ESTOQUE SET PRECO_PUBLICO_ATUAL = '" . $triumph['rrp'] . "' WHERE EMPRESA = " . $empresa . " AND ITEM_ESTOQUE = '" . $triumphApollo['XITEM_ESTOQUE'] . "'";
                        $resultadoAtual = oci_parse($connApollo, $updateAtual);
                        oci_execute($resultadoAtual);
                        oci_free_statement($resultadoAtual);

                        //INFORMA USUARIO QUE FOI ALTERADO
                        $alerta = "UPDATE sisrev_atualizacao_preco_ducati SET status_item = 'Atualizado valor', rrp_apollo = " . $triumphApollo['XPRECO_ATUAL'] . "  WHERE item = '" . $triumph['item'] . "'";
                        $resultadoalerta = $connUNICO->query($alerta);
                    }

                    //MENOR
                    if ($triumph['rrp'] < $triumphApollo['XPRECO_ATUAL']) {
                        if ($_GET['forcar'] == 1) { //forçar = 1 foi autorizado pelo usuário
                            //ATUALIZA PREÇO PUBICO ANTERIOR
                            $updateAnterior = "UPDATE PEC_ITEM_ESTOQUE SET PRECO_PUBLICO_ANTER = '" . $triumphApollo['XPRECO_ATUAL'] . "' WHERE EMPRESA = " . $empresa . " AND ITEM_ESTOQUE = '" . $triumphApollo['XITEM_ESTOQUE'] . "'";
                            $resultadoAnterior = oci_parse($connApollo, $updateAnterior);
                            oci_execute($resultadoAnterior);
                            oci_free_statement($resultadoAnterior);

                            //ATUALIZA PREÇO ATUAL
                            $updateAtual = "UPDATE PEC_ITEM_ESTOQUE SET PRECO_PUBLICO_ATUAL = '" . $triumph['rrp'] . "' WHERE EMPRESA = " . $empresa . " AND ITEM_ESTOQUE = '" . $triumphApollo['XITEM_ESTOQUE'] . "'";
                            $resultadoAtual = oci_parse($connApollo, $updateAtual);
                            oci_execute($resultadoAtual);
                            oci_free_statement($resultadoAtual);

                            //INFORMA USUARIO QUE FOI ALTERADO
                            $alerta = "UPDATE sisrev_atualizacao_preco_ducati SET status_item = 'Atualizado valor', rrp_apollo = " . $triumphApollo['XPRECO_ATUAL'] . "  WHERE item = '" . $triumph['item'] . "'";
                            $resultadoalerta = $connUNICO->query($alerta);
                        } else {
                            $alerta = "UPDATE sisrev_atualizacao_preco_ducati SET status_item = 'Não atualizado, valor menor', rrp_apollo = " . $triumphApollo['XPRECO_ATUAL'] . "  WHERE item = '" . $triumph['item'] . "'";
                            $resultadoalerta = $connUNICO->query($alerta);
                        }
                    }

                    //IGUAL
                    if ($triumph['rrp'] == $triumphApollo['XPRECO_ATUAL']) {
                        $alerta = "UPDATE sisrev_atualizacao_preco_ducati SET status_item = 'Mesmo valor', rrp_apollo = " . $triumphApollo['XPRECO_ATUAL'] . "  WHERE item = '" . $triumph['item'] . "'";
                        $resultadoalerta = $connUNICO->query($alerta);
                    }

                    oci_free_statement($resultItemHistorico);
                } else {
                    $alerta = "UPDATE sisrev_atualizacao_preco_ducati SET status_item = 'Não encontrei' WHERE item = '" . $triumph['item'] . "'";
                    $resultadoalerta = $connUNICO->query($alerta);
                }

                oci_close($connApollo);
            } else {
                $part = 1 + empty($_GET['part']) ? 0 : $_GET['part'];
                header('Location: http://' . $_SERVER['SERVER_ADDR'] . '/unico_api/sisrev/inc/atualizacaoPecas.php?pg=' . $_GET['pg'] . '&empresa=' . $empresa . '&forcar=' . $_GET['forcar'] . '&acao=1&part=' . $part . '');
                exit;
            }

            $count++;
        }
        break;




    case '10':

        //limpandoHonda
        $truncateHonda = "TRUNCATE sisrev_atualizacao_preco_honda";
        $resultTruncate = $connUNICO->query($truncateHonda);

        $queryApolloPecas = "SELECT
        PIE.ITEM_ESTOQUE,
        PIE.DES_ITEM_ESTOQUE,
        PIE.PRECO_PUBLICO_ATUAL,
        PIE.PRECO_A_VISTA,
        PPH.PRECO_PUBLICO,
        PPH.DTA_PRECO
        FROM PEC_ITEM_ESTOQUE PIE, PEC_PRECO_HISTORICO PPH
        WHERE
        PIE.EMPRESA = 10 AND
        PIE.GRUPO = 2 AND
        PIE.CATEGORIA = 2 AND
        PIE.PRECO_PUBLICO_ANTER IS NOT NULL AND
        PPH.DTA_PRECO = to_date('" . date('d/m/Y', strtotime($_GET['data'])) . "', 'dd/mm/yy') AND
        
        PPH.EMPRESA = PIE.EMPRESA AND
        PPH.ITEM_ESTOQUE = PIE.ITEM_ESTOQUE
        
        ORDER BY PIE.ITEM_ESTOQUE_PUB";

        $stid = oci_parse($connApollo, $queryApolloPecas);
        oci_execute($stid);

        while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {            

            if($_GET['relatorio'] != 1){

                $updatePecasHonda = "UPDATE PEC_ITEM_ESTOQUE PIE 
                                        SET PIE.PRECO_PUBLICO_ATUAL = '".$row['PRECO_PUBLICO']."', PIE.PRECO_A_VISTA = '".$row['PRECO_PUBLICO']."' 
                                        WHERE PIE.ITEM_ESTOQUE = '".$row['ITEM_ESTOQUE']."' AND PIE.EMPRESA = '".$empresa."'";
                $resultUpdatePecasHonda = oci_parse($connApollo, $updatePecasHonda);
                oci_execute($resultUpdatePecasHonda);
                oci_free_statement($resultUpdatePecasHonda);

                if(!$resultUpdatePecasHonda){
                    $status = 'Nao atualizado';
                }else{
                    $status = "Atualizado";
                }
            }else{
                $status = "---";
            }

            $insertHonda = "INSERT INTO sisrev_atualizacao_preco_honda
            (item,
            descricao,
            preco_avista,
            preco_publico_atual,
            preco_publico,
            dta_preco,
            status_item)
            VALUES
            ('".$row['ITEM_ESTOQUE']."',
            '".$row['DES_ITEM_ESTOQUE']."',
            '".$row['PRECO_A_VISTA']."',
            '".$row['PRECO_PUBLICO_ATUAL']."',
            '".$row['PRECO_PUBLICO']."',
            '".date('d/m/Y', strtotime($row['DTA_PRECO']))."',
            '".$status."')";
            $resultInsertHonda = $connUNICO->query($insertHonda);                
        }

        /* $e = oci_error($resultinsertHistoricoItem);
        print htmlentities($e['message']);
        print "\n<pre>\n";
        print htmlentities($e['sqltext']);
        printf("\n%" . ($e['offset'] + 1) . "s", "^");
        print  "\n</pre>\n"; */

        oci_free_statement($stid);
        oci_close($connApollo);

        break;
}

echo '<script>window.location.href = "http://'.$_SESSION['ip_unico'].'/unico/sistemas/sisrev/front/atualizarPreco.php?pg=' . $_GET['pg'] . '&empresa=' . $empresa . '&acao=1";</script>';

?>