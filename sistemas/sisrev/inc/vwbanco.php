<?php

require_once('../config/query.php');

$filial = null;
if (isset($_POST['filial'])) {
    $filial = $_POST['filial'];
}
if ($filial !== null) {
    
    for ($i = 0; $i < count($filial); $i++) {
        
        $data = $_POST['data'];
        empty($data) ? $data = date('dmY') : ''; //verifica se a informação vindo esta vazia 
        
        $diretorioArquivo = '../documentos/CAR/' . $data . '/' . $filial[$i] . ''; //Salva o diretório dentro de uma variavel
        
        if (file_exists($diretorioArquivo)) { //verifica se o arquivo existe
            
            $handle = array(
                file($diretorioArquivo)//abre o arquivo
            );
            
            foreach ($handle as $row) { // para cada arquivo
                
                $ler = $row[0];//posição da primeira linha
                
                $inicio = substr($ler, 0, 3);//seleciona as 3 primeiras letras
                
                if ($inicio == 'FHI') { // se o arquivo começar com FHI, ele continua o processo
                    
                    $ler = $row[1]; //posição da segunda linha
                    
                    $FPI          = substr($ler, 0, 3); //salva a informação dentro da variavel
                    $movimentacao = substr($ler, 17, 8); //pega a movimentação,onde eu escolhi para ser a condição de comparação
                    $filial       = substr($ler, 40, 4);//seleciono o numero da empresa dentro do arquivo e renomeio para numero da filial
                    switch($filial){
                        case '0054':
                            $filial = '10';
                            break;
                        case '1225':
                            $filial = '12';
                            break;
                        case '1544':
                            $filial = '14';
                            break;
                        case '1329':
                            $filial = '16';
                            break;
                        case '1494':
                            $filial = '19';
                            break;
                        case '1417':
                            $filial = '20';
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
                    
                    //busca a coluna movimentacao do banco carga_wv
                    $verificaMovimentacao = "SELECT movimentacao FROM carga_vw_info;";
                    $setem                = $conn->query($verificaMovimentacao);
                    
                    //while que apresenta as movimentações do select anteior
                    while ($der = $setem->fetch_assoc()) {
                        if ($der['movimentacao'] == $movimentacao) { //se o arquivo estiver com a mesma data, ele exclui apenas as linhas dessa data(movimentação)
                            $delete  = "DELETE FROM carga_vw_info WHERE movimentacao = '" . $movimentacao . "';";
                            $success = $conn->query($delete);
                            break;
                        }
                    }
                    
                    
                    $i = 2; //contador para o próximo while mostrar documentos 
                    
                    while ($i < count($row)) { //while mostrar documentos
                        
                        $ler = $row[$i];
                        
                        $numeroIpi   = substr($ler, 118, 10);//seleciona a coluna do arquivo onde é o valor total do item
                        $numeroIpi   = ltrim($numeroIpi, '0');//retirar os zeros da fração
                        $numeroIpi   = substr_replace($numeroIpi, '.', -2, 0);//coloca um ponto para mostrar que é uma fração
                        $qntd        = substr($ler, 130, 6);//seleciona a coluna do arquivo onde é a quantidade
                        $qntd        = ltrim($qntd, '0');
                        $valorIpi    = substr($ler, 96, 10);//seleciona a coluna do arquivo onde é o valor IPI
                        $valorIpi    = substr_replace($valorIpi, '.', -2, 0);
                        $valorIpi    = ltrim($valorIpi, '0');
                        $numeroCaixa = substr($ler, 143, 9);//seleciona a coluna do arquivo onde é o numero de caixa
                        $numeroCaixa = ltrim($numeroCaixa, '0');
                        $nomeProduto = substr($ler, 65, 13);//seleciona a coluna do arquivo onde é o nome do produto
                        $nomeProduto = trim($nomeProduto);
                        if ($nomeProduto === '' OR '/') {//se tiver espaços em branco, antes ou uma / depois, ele retira esses caracteres
                            $nomeProduto = str_replace('/', '', $nomeProduto);
                            $nomeProduto = trim($nomeProduto);
                        }
                        $dataNota = substr($ler, 33, 8);//seleciona a coluna do arquivo onde é a data da nota
                        $dataNota = substr_replace($dataNota, '/', 2, 0);//{
                        $dataNota = substr_replace($dataNota, '/', 5, 0);//    apenas coloca / entre a data }
                        $dataNota = implode('-', array_reverse(explode('/', $dataNota)));
                        $cnpjForn = substr($ler, 162, 20); // se não houver fornecedor será substuido o valor por '-------'
                        if ($cnpjForn = '00000000000000') {
                            $cnpjForn = '-------';
                        } else {
                            $cnpjForn = substr($ler, 162, 20);
                        }
                        $numeroNota = substr($ler, 27, 6);
                        
                        $FP9 = substr($ler, 0, 3); 

                        if ($FP9 != 'FP9') {//o arquivo devera conter os primeiros caracteres como FP9 caso o valor seja diferente
                            break;//ele para o laço
                        }
                        
                        $inserirBancoDados = 'INSERT INTO carga_vw_info(numero_nota,data_nota,produto,caixa,tot_item,val_ipi,fornecedor,qtde,movimentacao,revenda,empresa) VALUES ("' . $numeroNota . '","' . $dataNota . '","' . $nomeProduto . '","' . $numeroCaixa . '","' . $numeroIpi . '","' . $valorIpi . '","' . $cnpjForn . '","' . $qntd . '","' . $movimentacao . '","' . $filial . '","1")';
                        $resultado         = $conn->query($inserirBancoDados); //Faz a inserção dentro do banco de dados
                        if ($resultado) { //se a inserção for um sucesso, ele redireciona para a pagina
                            header('location: ../front/processosFabrica.php?pg='.$_GET['pg'].'&msn=11');
                            $conn->close;
                        } else {
                            header('location: ../front/processosFabrica.php?pg='.$_GET['pg'].'&msn=10&erro=1');
                        }
                        $i++;
                    }
                    
                } else {
                    header('location: ../front/processosFabrica.php?pg='.$_GET['pg'].'&msn=10&erro=1');
                }
                
            }
            
        }
        
    }
    
} else {
    header('location: ../front/processosFabrica.php?pg='.$_GET['pg'].'&msn=15');
}