
<?php
session_start();
require_once('../config/query.php');

$data = empty($_POST['data']) ? date('dmY') : $_POST['data']; //verifica se a informação vindo esta vazia 


if (!empty($_POST['filial'])) {

    foreach ($_POST['filial'] as $key => $filial) {

        $diretorioArquivo = '../documentos/CAR/' . $data . '/' . $filial . ''; //Salva o diretório dentro de uma variavel

        $handle = array(
            file($diretorioArquivo) //abre o arquivo
        );

        foreach ($handle as $row) { // para cada arquivo

            $ler = $row[0]; //posição da primeira linha

            $inicio = substr($ler, 0, 3); //seleciona as 3 primeiras letras

            if ($inicio == 'FHI') { // se o arquivo começar com FHI, ele continua o processo

                $ler = $row[1]; //posição da segunda linha
                $lerInicio = $row[0]; //posição da primeira linha

                $FPI          = substr($ler, 0, 3); //salva a informação dentro da variavel              
                $filial       = substr($ler, 40, 4); //seleciono o numero da empresa dentro do arquivo e renomeio para numero da filial

                //data arquivo
                $dia = substr($lerInicio, 17, 2); //data do arquivo
                $mes = substr($lerInicio, 19, 2); //data do arquivo
                $ano = substr($lerInicio, 21, 4); //data do arquivo
                $dataArquivo = $ano . "-" . $mes . "-" . $dia;

                //data movimentação

                $dia = substr($ler, 17, 2); //data da movimentação
                $mes = substr($ler, 19, 2); //data do movimentação
                $ano = substr($ler, 21, 4); //data do movimentação                
                $movimentacao = $ano . "-" . $mes . "-" . $dia;

                switch ($filial) {
                    case '0054':
                        $filial = '1';
                        break;
                    case '1225':
                        $filial = '4';
                        break;
                    case '1544':
                        $filial = '6';
                        break;
                    case '1329':
                        $filial = '9';
                        break;
                    case '1494':
                        $filial = '19';
                        break;
                    case '1417':
                        $filial = '2';
                        break;
                    case '4773':
                        $filial = '85';
                        break;
                    case '4778':
                        $filial = '89';
                        break;
                    case '0032':
                        $filial = '101';
                        break;
                }

                //AGORA COLETANDO OS DADOS DO ARQUIVO E SALVANDO NO BANCO DE DADOS
                $i = 2; //contador para o próximo while mostrar documentos 

                while ($i < count($row)) { //while mostrar documentos

                    $ler = $row[$i];
                    $tipoRelatorio = substr($ler, 0, 3);
                    //seleciona as 3 primeiras letras de cada linha

                    switch ($tipoRelatorio) {

                        case 'FP9': //quando for FP9 ele executa as linhas abaixo
                            $numeroIpi   = substr($ler, 118, 10); //seleciona a coluna do arquivo onde é o valor total do item
                            $numeroIpi   = ltrim($numeroIpi, '0'); //retirar os zeros da fração
                            $numeroIpi   = substr_replace($numeroIpi, '.', -2, 0); //coloca um ponto para mostrar que é uma fração
                            $qntd        = substr($ler, 130, 6); //seleciona a coluna do arquivo onde é a quantidade
                            $qntd        = ltrim($qntd, '0');
                            $valorIpi    = substr($ler, 96, 10); //seleciona a coluna do arquivo onde é o valor IPI
                            $valorIpi    = substr_replace($valorIpi, '.', -2, 0);
                            $valorIpi    = ltrim($valorIpi, '0');
                            $numeroCaixa = substr($ler, 143, 10); //seleciona a coluna do arquivo onde é o numero de caixa
                            $numeroCaixa = ltrim($numeroCaixa, '0');
                            $nomeProduto = substr($ler, 50, 19); //seleciona a coluna do arquivo onde é o nome do produto
                            $dataNota    = substr($ler, 33, 8); //seleciona a coluna do arquivo onde é a data da nota
                            $dataNota    = substr_replace($dataNota, '/', 2, 0); //{
                            $dataNota    = substr_replace($dataNota, '/', 5, 0); //    apenas coloca / entre a data }
                            $dataNota    = implode('-', array_reverse(explode('/', $dataNota)));
                            $cnpjForn    = substr($ler, 162, 20); // se não houver fornecedor será substuido o valor por '-------'
                            if ($cnpjForn = '00000000000000') {
                                $cnpjForn = '-------';
                            } else {
                                $cnpjForn = substr($ler, 162, 20);
                            }
                            $numeroNota = substr($ler, 27, 6);

                            if ($tipoRelatorio != 'FP9') { //o arquivo devera conter os primeiros caracteres como FP9 caso o valor seja diferente
                                break; //ele para o laço
                            }

                            $inserirBancoDados = 'INSERT INTO sisrev_carga_vw_info(numero_nota,data_nota,produto,caixa,tot_item,val_ipi,fornecedor,qtde,movimentacao,revenda,empresa,tipo_rel,id_usuario) VALUES ("' . $numeroNota . '","' . $dataNota . '","' . $nomeProduto . '","' . $numeroCaixa . '","' . $numeroIpi . '","' . $valorIpi . '","' . $cnpjForn . '","' . $qntd . '","' . $movimentacao . '","' . $filial . '","1","' . $tipoRelatorio . '","' . $_SESSION['id_usuario'] . '")';
                            $resultado         = $conn->query($inserirBancoDados); //Faz a inserção dentro do banco de dados

                        case 'FA3':

                            
                            //VAMOS EXCLUIR DADOS ANTIGOS CASO A MOVIMENTAÇÃO É A MESMA
                            $verificaMov = "SELECT id, movimentacao FROM sisrev_carga_FA3 WHERE revenda = '".$filial."' AND movimentacao = '" . $movimentacao . "'";
                            $verificado = $conn->query($verificaMov);

                            while ($seDer = $verificado->fetch_assoc()) {
                                if ($seDer['movimentacao'] == $movimentacao) {
                                    $delete  = "DELETE FROM sisrev_carga_FA3 WHERE id = '" . $seDer['id'] . "'";
                                    $sucesso = $conn->query($delete);
                                    break;
                                }
                            }

                            $numeroNota2       = substr($ler, 3, 13);
                            $dataNota2         = substr($ler, 15, 8);
                            $vencimento2       = substr($ler, 23, 8);
                            $valorNota         = substr($ler, 31, 15);
                            $saldoDevedor      = substr($ler, 46, 15);
                            $valorDesconto     = substr($ler, 61, 14);

                            if ($valorDesconto == '00000000000000') {
                                $valorDesconto = null;
                            }
                            $valorAcrescimo     = substr($ler, 76, 14);
                            if ($valorAcrescimo == '00000000000000') {
                                $valorAcrescimo = null;
                            }
                            $dataParcial     = substr($ler, 91, 8);
                            if ($dataParcial == '00000000') {
                                $dataParcial = null;
                            }
                            $documentoBancario     = substr($ler, 99, 5);
                            if ($documentoBancario == '00000') {
                                $documentoBancario = null;
                            }
                            $numeroFabrica      = substr($ler, 115, 4);
                            $descricaoDocumento = substr($ler, 119, 19);

                            $inserirBancoDadosFa3 = 'INSERT INTO sisrev_carga_FA3(
                                revenda,
                                numero_nota,
                                data_nota,
                                vencimento,
                                valor_nota,
                                saldo_devedor,
                                valor_desconto,
                                valor_acrescimo,
                                data_parcial,
                                documento_bancario,
                                numero_fabrica,
                                descricao_documento,
                                movimentacao,
                                data_arquivo,
                                tipo_rel,
                                id_usuario) 
                            VALUES (
                                "' . $filial . '",
                                "' . $numeroNota2 . '",
                                "' . $dataNota2 . '",
                                "' . $vencimento2 . '",
                                "' . $valorNota . '",
                                "' . $saldoDevedor . '","
                                ' . $valorDesconto . '",
                                "' . $valorAcrescimo . '",
                                "' . $dataParcial . '",
                                "' . $documentoBancario . '",
                                "' . $numeroFabrica . '",
                                "' . $descricaoDocumento . '",
                                "' . $movimentacao . '",
                                "' . $dataArquivo . '",
                                "' . $tipoRelatorio . '",
                                "' . $_SESSION['id_usuario'] . '")';

                            $resultadoFa3 = $conn->query($inserirBancoDadosFa3); //Faz a inserção dentro do banco de dados

                            break;
                        case 'FA4':
                            
                            //VAMOS EXCLUIR DADOS ANTIGOS CASO A MOVIMENTAÇÃO É A MESMA
                            $verificaMovFA4 = "SELECT id, movimentacao FROM sisrev_carga_FA4 WHERE revenda = '".$filial."' AND movimentacao = '" . $movimentacao . "'";
                            $verificadoFA4 = $conn->query($verificaMovFA4);
                            
                            while ($deu = $verificadoFA4->fetch_assoc()) {
                                if ($deu['movimentacao'] == $movimentacao) {
                                    $delete  = "DELETE FROM sisrev_carga_FA4 WHERE id = '" . $deu['id'] . "'";
                                    echo $verificaMovFA4."<br >";
                                    echo $delete."<br />";
                                    /* $successo = $conn->query($delete); */
                                    break;
                                }
                            }

                            $tipoDescDocumento  = substr($ler, 3, 4);
                            $descricao          = substr($ler, 7, 40);
                            $dataLancamento     = substr($ler, 57, 8);
                            $metodoPagamento    = substr($ler, 65, 1);
                            $valorPagamento     = substr($ler, 66, 14);
                            $tipoDocumento      = substr($ler, 81, 4);
                            $descricaoDocumento = substr($ler, 85, 39);
                            $numeroDocumento    = substr($ler, 125, 9);
                            $dataDocumento      = substr($ler, 135, 8);
                            $metodoPagamento2   = substr($ler, 143, 1);
                            $valorDocumento     = substr($ler, 144, 14);


                            $inserirBancoDadosFa4 = 'INSERT INTO sisrev_carga_FA4(
                                revenda,
                                tipo_desc_documento,
                                descricao,
                                data_lancamento,
                                metodo_pagamento,
                                valor_pagamento,
                                tipo_documento,
                                descricao_documento,
                                numero_documento,
                                data_documento,
                                metodo_pagamento_2,
                                valor_documento,
                                movimentacao,
                                data_arquivo,
                                tipo_rel,
                                id_usuario) 
                            VALUES (
                                "' . $filial . '",
                                "' . $tipoDescDocumento . '",
                                "' . $descricao . '",
                                "' . $dataLancamento . '",
                                "' . $metodoPagamento . '",
                                "' . $valorPagamento . '",
                                "' . $tipoDocumento . '",
                                "' . $descricaoDocumento . '",
                                "' . $numeroDocumento . '",
                                "' . $dataDocumento . '",
                                "' . $metodoPagamento2 . '",
                                "' . $valorDocumento . '",
                                "' . $movimentacao . '",
                                "' . $dataArquivo . '",
                                "' . $tipoRelatorio . '",
                                "' . $_SESSION['id_usuario'] . '")';

                            $resultadoFa4 = $conn->query($inserirBancoDadosFa4); //Faz a inserção dentro do banco de dados
                            break;
                        
                        case 'FHF': //FIM DO ARQUIVO
                            //header('location: ../front/processosFabrica.php?pg=' . $_GET['pg'] . '&msn=11');
                            $conn->close;
                            break;
                    }
                    $i++;
                }
            } else {
                header('location: ../front/processosFabrica.php?pg=' . $_GET['pg'] . '&msn=10&erro=7');
            }
        }
    }
}
