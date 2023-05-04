<?php

$dataCom = $_GET['dataCom'];
$dataFim = $_GET['dataFim'];

?>
<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Empresas a Receber</title>
</head>

<body>

    <div><br>
        <p style="text-align: center;">COMISSÃO A PAGAR</p>
        <p style="text-align:center;"> PERÍODO: <?= $dataCom ?> A <?= $dataFim ?> </p>
        <table class="table table-borderless ">
            <thead>
                <tr>
                    <th scope="col">EMPRESA A RECEBER</th>
                    <th scope="col">TOTAL</th>
                    <th scope="col">EMPRESA DEVE PAGAR</th>
                    <th scope="col">TOTAL</th>
                    <th scope="col">BASE CALCULO</th>
                    <th scope="col">REPASSE</th>
                </tr>
            </thead>
            <tbody>
                <?php

                require_once('../../../config/sqlSmart.php');
                require_once('../../../config/databases.php');
                require_once('../config/query.php');

                $queryEmpresa .= ' WHERE ID_EMPRESA NOT IN (208) ORDER BY ID_EMPRESA ASC';

                $sucesso = oci_parse($connBpmgp, $queryEmpresa);
                oci_execute($sucesso);

                $anterior = NULL;

                while ($row = oci_fetch_array($sucesso, OCI_ASSOC)) {

                    $id_empresa = $row['ID_EMPRESA'];

                    $vendas = "SELECT * FROM sisrev_comissao WHERE XEMPRESA_VENDEDOR = " . $row['ID_EMPRESA'] . " and ID_EMPRESA != " . $row['ID_EMPRESA'] . " AND XVENDEDOR != '0' ORDER BY ID_EMPRESA ASC ";
                    $conexao = oci_parse($connBpmgp, $vendas);
                    oci_execute($conexao, OCI_COMMIT_ON_SUCCESS);

                    $anterior = null;

                    while ($tabela = oci_fetch_array($conexao, OCI_ASSOC)) {
                       
                        $somaValores = "SELECT SUM(XVAL_VENDA_VEICULO) as total_comissao FROM SISREV_COMISSAO WHERE XEMPRESA_VENDEDOR = " . $row['ID_EMPRESA'] . " AND ID_EMPRESA = " . $tabela['ID_EMPRESA'] . " AND XVENDEDOR != '0'";
                        $conexao2 = oci_parse($connBpmgp, $somaValores);
                        oci_execute($conexao2, OCI_COMMIT_ON_SUCCESS);
                        if ($valores = oci_fetch_array($conexao2, OCI_ASSOC)) {
                            $valor = $valores['TOTAL_COMISSAO'];
                        }
                        //verifica se existe numeros iguais e desconsidera, mostrando so 1
                        if (empty($anterior)) {

                            $anterior = $tabela['ID_EMPRESA'];
                            $queryEmpresa = "SELECT * FROM EMPRESA WHERE ID_EMPRESA = " . $anterior . "";
                            $conexaoEmpresa = oci_parse($connBpmgp, $queryEmpresa);
                            oci_execute($conexaoEmpresa, OCI_COMMIT_ON_SUCCESS);

                            if ($achou = oci_fetch_array($conexaoEmpresa, OCI_ASSOC)) {
                                $nomeApagar = $achou['NOME_EMPRESA'];
                            }

                            $nomeEmpresa = "SELECT * FROM EMPRESA WHERE ID_EMPRESA = " . $tabela['XEMPRESA_VENDEDOR'] . "";
                            $conexaoNome = oci_parse($connBpmgp, $nomeEmpresa);
                            oci_execute($conexaoNome, OCI_COMMIT_ON_SUCCESS);

                            if ($nome = oci_fetch_array($conexaoNome, OCI_ASSOC)) {
                                $nomePagar = $nome['NOME_EMPRESA'];
                            }
                            $notasCanceladas = "SELECT * FROM SISREV_COMISSAO_CANC WHERE ID_EMPRESA = " . $anterior . " AND XVENDEDOR != '0'";
                            $conexaoCan = oci_parse($connBpmgp, $notasCanceladas);
                            oci_execute($conexaoCan, OCI_COMMIT_ON_SUCCESS);

                            if ($canceladas = oci_fetch_array($conexaoCan, OCI_ASSOC)) {
                                $valorCancelada = $canceladas['XVAL_VENDA_VEICULO'];
                            }
                            // $valor = $valor - $valorCancelada;
                            echo "<tr>
                            <td>" . $nomePagar . "</td>
                            <td>" . number_format($valor, 2, ',', '.') . "</td>
                            <td>" . $nomeApagar . "</td>
                            </tr>";
                        } else if ($anterior != $tabela['ID_EMPRESA']) {
                            $anterior = $tabela['ID_EMPRESA'];
                            $teste = "SELECT * FROM EMPRESA WHERE ID_EMPRESA = " . $anterior . "";
                            $foi = oci_parse($connBpmgp, $teste);
                            oci_execute($foi, OCI_COMMIT_ON_SUCCESS);

                            if ($foda = oci_fetch_array($foi, OCI_ASSOC)) {
                                $nomeApagar = $foda['NOME_EMPRESA'];
                            }
                            $teste2 = "SELECT * FROM EMPRESA WHERE ID_EMPRESA = " . $tabela['XEMPRESA_VENDEDOR'] . "";
                            $foi2 = oci_parse($connBpmgp, $teste2);
                            oci_execute($foi2, OCI_COMMIT_ON_SUCCESS);

                            if ($foda2 = oci_fetch_array($foi2, OCI_ASSOC)) {
                                $nomePagar = $foda2['NOME_EMPRESA'];
                            }
                            $notasCanceladas = "SELECT * FROM SISREV_COMISSAO_CANC WHERE  ID_EMPRESA = " . $anterior . " AND XVENDEDOR != '0'";
                            $conexaoCan = oci_parse($connBpmgp, $notasCanceladas);
                            oci_execute($conexaoCan, OCI_COMMIT_ON_SUCCESS);

                            if ($canceladas = oci_fetch_array($conexaoCan, OCI_ASSOC)) {
                                $valorCancelada = $canceladas['XVAL_VENDA_VEICULO'];
                            }

                            echo "<tr>
                            <td>" . $nomePagar . "</td>
                            <td>" . number_format($valor, 2, ',', '.') . "</td>
                            <td>" . $nomeApagar . "</td>
                            </tr>";
                        }
                    }
                }
                oci_free_statement($conexao);
                oci_free_statement($conexao2);
                oci_free_statement($sucesso);
                oci_free_statement($foi);
                oci_free_statement($foi2);
                oci_close($connBpmgp);
                ?>
            </tbody>
        </table>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>