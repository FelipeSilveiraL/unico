<?php
session_start();
//reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;
use FontLib\Table\Type\head;

$dataCom = $_GET['dataCom'];
$dataFim = $_GET['dataFim'];
$today = date('d/m/y H:i');
require_once('../../../config/session.php');
require_once('../../../vendor/autoload.php');

$html = '
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
<style>
  .break {
    page-break-before: always;
  }
</style>
<body>
    <div>
        <p style="text-align: center;font-size: 10px;">COMISSÃO A PAGAR</p>
        <p style="text-align:center;font-size: 10px;"> PERÍODO: '. $dataCom .' A '. $dataFim .' </p>
        <p style="float:right;font-size: 10px;"><span style="float:right;padding-right:10px;">EMISSÃO: '. $today  .'</span> </p>
            --------------------------------------------------------------------------------------------------------------------------------
        <table class="table table-borderless" style="font-size: 10px">
            <thead>
                <tr>
                    <th scope="col">EMPRESA A RECEBER</th>
                    <th scope="col" style="text-align:center;">TOTAL</th>
                    <th scope="col">EMPRESA DEVE PAGAR</th>
                    <th scope="col" style="text-align:center;">TOTAL</th>
                    <th scope="col" style="text-align:center;">BASE CALCULO</th>
                    <th scope="col">REPASSE</th>
                </tr>
            </thead>
            <tbody>';
                

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
                            //notas vendidas
                                $notas = "SELECT SUM(XVAL_VENDA_VEICULO) as total_comissao FROM SISREV_COMISSAO WHERE XEMPRESA_VENDEDOR = " . $anterior . " and ID_EMPRESA = " . $row['ID_EMPRESA'] . " AND XVENDEDOR != '0' ORDER BY ID_EMPRESA ASC ";
                                $semIdeia = oci_parse($connBpmgp, $notas);
                                oci_execute($semIdeia);
                                if($totalRow = oci_fetch_array($semIdeia,OCI_ASSOC)){
                                    $total = $totalRow['TOTAL_COMISSAO'];
                                }else{
                                    $total = 0;
                                }
                            //nome da empresa a receber 
                                $queryEmpresa = "SELECT * FROM EMPRESA WHERE ID_EMPRESA = " . $anterior . "";
                                $conexaoEmpresa = oci_parse($connBpmgp, $queryEmpresa);
                                oci_execute($conexaoEmpresa, OCI_COMMIT_ON_SUCCESS);

                                if ($achou = oci_fetch_array($conexaoEmpresa, OCI_ASSOC)) {
                                    $nomeApagar = $achou['NOME_EMPRESA'];
                                }

                            //nome da empresa que vai pagar
                                $nomeEmpresa = "SELECT * FROM EMPRESA WHERE ID_EMPRESA = " . $tabela['XEMPRESA_VENDEDOR'] . "";
                                $conexaoNome = oci_parse($connBpmgp, $nomeEmpresa);
                                oci_execute($conexaoNome, OCI_COMMIT_ON_SUCCESS);

                                if ($nome = oci_fetch_array($conexaoNome, OCI_ASSOC)) {
                                    $nomePagar = $nome['NOME_EMPRESA'];
                                }

                            //notas canceladas
                                $notasCanceladas = "SELECT * FROM SISREV_COMISSAO_CANC WHERE XEMPRESA_VENDEDOR = " . $row['ID_EMPRESA'] . " AND ID_EMPRESA = " . $tabela['ID_EMPRESA'] . " AND XVENDEDOR != '0'";
                            
                                $conexaoCan = oci_parse($connBpmgp, $notasCanceladas);
                                oci_execute($conexaoCan, OCI_COMMIT_ON_SUCCESS);
        
                                if ($canceladas = oci_fetch_array($conexaoCan, OCI_ASSOC)) {
                                    $valorCancelada = $canceladas['XVAL_VENDA_VEICULO'];
                                }

                                //calculo para a coluna do base calculo

                                $valor = $valor - abs($valorCancelada);
                           
                                $valorFinal = $valor - $total;

                                switch($anterior){
                                    case '5':
                                        $porcentagem = 3;
                                        $resultado = ($valorFinal * $porcentagem) / 100;
                                        break;
                                    case '56':
                                        $porcentagem = 3;
                                         $resultado = ($valorFinal * $porcentagem) / 100;
                                        break;
                                    case '56':
                                        $porcentagem = 3;
                                         $resultado = ($valorFinal * $porcentagem) / 100;
                                        break;
                                    default:
                                        $porcentagem = 5;
                                         $resultado = ($valorFinal * $porcentagem) / 100;
                                        break;
                                }
                                
                            $html .= "<tr style='height:50px'>
                            <td>" . $nomePagar . "</td>
                            <td style='text-align:center;'>" . number_format($valor, 2, ',', '.') . "</td>
                            <td>" . $nomeApagar . "</td>
                            <td style='text-align:center;'>".number_format($total, 2, ',', '.')."</td>
                            <td style='text-align:center;'>".number_format($valorFinal, 2, ',', '.')."</td>
                            <td>".number_format($resultado,2,',','.')."</td>
                            </tr>
                            <tr colspan='14' style='height:50px'><td></td></tr>";     
                        } else if ($anterior != $tabela['ID_EMPRESA']) {
                            
                            $anterior = $tabela['ID_EMPRESA'];

                            $notas = "SELECT SUM(XVAL_VENDA_VEICULO) as total_comissao FROM SISREV_COMISSAO WHERE XEMPRESA_VENDEDOR = " . $anterior . " and ID_EMPRESA = " . $row['ID_EMPRESA'] . "";
                            $semIdeia = oci_parse($connBpmgp, $notas);
                            oci_execute($semIdeia);
                            if($totalRow = oci_fetch_array($semIdeia,OCI_ASSOC)){
                                $total = $totalRow['TOTAL_COMISSAO'];
                            }else{
                                $total = 0;
                            }
                           //nome da empresa a receber 
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
                        
                            $notasCanceladas = "SELECT * FROM SISREV_COMISSAO_CANC WHERE XEMPRESA_VENDEDOR = " . $row['ID_EMPRESA'] . " AND ID_EMPRESA = " . $tabela['ID_EMPRESA'] . " AND XVENDEDOR != '0'";
                        
                            $conexaoCan = oci_parse($connBpmgp, $notasCanceladas);
                            oci_execute($conexaoCan, OCI_COMMIT_ON_SUCCESS);
    
                            if ($canceladas = oci_fetch_array($conexaoCan, OCI_ASSOC)) {
                                $valorCancelada = $canceladas['XVAL_VENDA_VEICULO'];
                            }else{
                                $valorCancelada = 0;
                            }

                            $valor = $valor - abs($valorCancelada);

                            $valorFinal = $valor - $total;

                            switch($anterior){
                                case '5':
                                    $porcentagem = 3;
                                    $resultado = ($valorFinal * $porcentagem) / 100;
                                    break;
                                case '56':
                                    $porcentagem = 3;
                                     $resultado = ($valorFinal * $porcentagem) / 100;
                                    break;
                                case '56':
                                    $porcentagem = 3;
                                     $resultado = ($valorFinal * $porcentagem) / 100;
                                    break;
                                default:
                                    $porcentagem = 5;
                                     $resultado = ($valorFinal * $porcentagem) / 100;
                                    break;
                            }
                            
                            $html .= "<tr style='height:50px'>
                            <td>" . $nomePagar . "</td>
                            <td style='text-align:center;'>" . number_format($valor, 2, ',', '.') . "</td>
                            <td>" . $nomeApagar . "</td>
                            <td style='text-align:center;'>". number_format($total, 2, ',', '.') ."</td>
                            <td style='text-align:center;'>".number_format($valorFinal, 2, ',', '.')."</td>
                            <td>".number_format($resultado,2,',','.')."</td>
                            </tr>
                            <tr colspan='14' style='height:50px'><td></td></tr>";
                        }
                    }
                }
           
                $html .='
            </tbody>
        </table>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>';

oci_close($connBpmgp);
/* 
echo $html;

exit; */

// instantiate and use the dompdf class
$dompdf = new Dompdf();

//habilitado o acesso ao download de assets remotos - Para funcionar o Bootstrap
$options = new Options();

//habilitado o acesso ao download de assets remotos - Para funcionar o Bootstrap
$options->set('isRemoteEnabled', true);

//habilitado o acesso ao download de assets remotos - Para funcionar o Bootstrap
$dompdf = new Dompdf($options);

//load body PDF
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait'); // portrait = retrato, landscape = paisagem

// Render the HTML as PDF
$dompdf->render();

// $dompdf->stream('relatorioComissoes.pdf', array("Attachment" => true));//true - Download false - Previa
$output = $dompdf->output();

file_put_contents('../documentos/COM/Relatório_comissao_revenda.pdf', $output);

header('Location: ../front/telaComissoes.php?pg='.$_GET['pg'].'&msg=1');
exit;
oci_free_statement($conexao);
oci_free_statement($conexao2);
oci_free_statement($sucesso);
oci_free_statement($foi);
oci_free_statement($foi2);
oci_free_statement($conexaoCan);
