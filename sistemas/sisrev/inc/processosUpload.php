<?php
session_start();
require_once('../config/query.php');

$total = count($_FILES['arquivo']['tmp_name']);

$nome = $_FILES['arquivo']['name'];

for ($i = 0; $i < $total;) {
    $tempFile = $_FILES['arquivo']['tmp_name'][$i];
    
    $arquivo = $_FILES['arquivo']['type'][$i];
    
    if ($arquivo === 'text/plain') {
        
        $data   = date('Y-m-d');
        $dataBr = implode('', array_reverse(explode('-', $data)));
        
        $folderName = substr($dataBr, 0, 4);
        
        
        $uploaddir = '/var/www/html/unico/sistemas/sisrev/documentos/CAR/' . $dataBr . '/';
        
        
        if (is_dir($uploaddir)) {
            
            $uploadfile = $uploaddir . basename($_FILES['arquivo']['name'][$i]);
            
            
            if (move_uploaded_file($tempFile, $uploadfile)) {
                
                $diretorioArquivo = array(
                    file('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '')
                );
                
                foreach ($diretorioArquivo as $row => $array) {
                    
                    $array1 = $array[0];
                    $array1 = trim($array1);
                    $array1 = rtrim($array1, ' 00');
                    
                    $array1 = substr($array1, -4);
                    
                    switch ($array1) {
                        case '0054':
                            $array1 = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lb3' . $folderName . '.txt');
                            break;
                        case '1551':
                            $array1 = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lqx' . $folderName . '.txt');
                            break;
                        case '1225':
                            $array1 = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lmc' . $folderName . '.txt');
                            break;
                        case '1682':
                            $array1 = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lme' . $folderName . '.txt');
                            break;
                        case '1544':
                            $array1 = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/las' . $folderName . '.txt');
                            break;
                        case '1581':
                            $array1 = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lpz' . $folderName . '.txt');
                            break;
                        case '1329':
                            $array1 = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/pmu' . $folderName . '.txt');
                            break;
                        case '1494':
                            $array1 = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lgf' . $folderName . '.txt');
                            break;
                        case '1417':
                            $array1 = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/l0s' . $folderName . '.txt');
                            break;
                        case '4773':
                            $array1 = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lyf' . $folderName . '.txt');
                            break;
                        case '4778':
                            $array1 = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/l50' . $folderName . '.txt');
                            break;
                        case '0032':
                            $array1 = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/luc' . $folderName . '.txt');
                            break;
                    }
                    $array5     = $array[3];
                    $array5     = ltrim($array5, 2);
                    $numeroNota = substr($array5, 16, 16);
                    
                    $array6   = $array[3];
                    // $array6 = ltrim($array6,8);
                    $dataNota = substr($array5, 20, 39);
                    
                    
                    $inserirDb = "INSERT INTO sisrev_carga_vw_info (data_nota,numero_nota,produto,caixa,qtde,tot_item,val_ipi,seq,fornecedor) VALUES ('" . $numeroNota . "','" . $uploadfile . "','" . $data . "','" . $_SESSION['id_usuario'] . "');";
                    $resultado = $conn->query($inserirDb);
                }
                $inserirDb = "INSERT INTO sisrev_arquivo_car (nome_arquivo,caminho,data,id_usuario) VALUES ('" . $nome . "','" . $uploadfile . "','" . $data . "','" . $_SESSION['id_usuario'] . "');";
                $resultado = $conn->query($inserirDb);
                
                if ($resultado) {
                    header("location: ../front/processosFabrica.php?pg=" . $_GET['pg'] . "&dataArquivo=" . $data . "&msn=11");
                    $conn->close();
                } else {
                    header("location: ../front/processosFabrica.php?pg=" . $_GET['pg'] . "&msn=10&erro=1");
                }
            } else {
                header("location: ../front/processosFabrica.php?pg=" . $_GET['pg'] . "&msn=10&erro=2");
            }
        } else {
            
            //cria a pasta se nao existir
            $criaPasta = mkdir($uploaddir, 0777);
            
            //se mudar a permissao do arquivo
            if (chmod($uploaddir, 0777)) {
                
                //mostra onde será salvo o arquivo
                $uploadfile = $uploaddir . basename($_FILES['arquivo']['name'][$i]);
                
                //se o arquivo foi movido pra pasta criada
                if (move_uploaded_file($tempFile, $uploadfile)) {
                    $diretorioArquivo = array(
                        file('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '')
                    );
                    
                    //para cada arquivo upado ele vai , abrir o arquivo, ler e renomear o arquivo
                    foreach ($diretorioArquivo as $row => $array) {
                        
                        $array1 = $array[0];
                        $array1 = trim($array1);
                        $array1 = rtrim($array1, ' 00');
                        
                        $array1 = substr($array1, -4);
                        
                        
                        //Ele verifica dentro do arquivo se for o dn da empresa e renomeia
                        switch ($array1) {
                            case '0054':
                                $array1 = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lb3' . $folderName . '.txt');
                                break;
                            case '1551':
                                $array1 = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lqx' . $folderName . '.txt');
                                break;
                            case '1225':
                                $array1 = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lmc' . $folderName . '.txt');
                                break;
                            case '1682':
                                $array1 = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lme' . $folderName . '.txt');
                                break;
                            case '1544':
                                $array1 = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/las' . $folderName . '.txt');
                                break;
                            case '1581':
                                $array1 = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lpz' . $folderName . '.txt');
                                break;
                            case '1329':
                                $array1 = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/pmu' . $folderName . '.txt');
                                break;
                            case '1494':
                                $array1 = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lgf' . $folderName . '.txt');
                                break;
                            case '1417':
                                $array1 = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/l0s' . $folderName . '.txt');
                                break;
                            case '4773':
                                $array1 = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lyf' . $folderName . '.txt');
                                break;
                            case '4778':
                                $array1 = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/l50' . $folderName . '.txt');
                                break;
                            case '0032':
                                $array1 = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/luc' . $folderName . '.txt');
                                break;
                        }
                    }
                    //insere no bd o log do arquivo
                    $inserirDb = "INSERT INTO sisrev_arquivo_car (nome_arquivo,caminho,data,id_usuario) VALUES ('" . $nome . "','" . $uploadfile . "','" . $data . "','" . $_SESSION['id_usuario'] . "');";
                    $resultado = $conn->query($inserirDb);
                    //confere se foi inserido no banco de dados  
                    if ($resultado) {
                        header("location: ../front/processosFabrica.php?pg=" . $_GET['pg'] . "&dataArquivo=" . $data . "&msn=11");
                        $conn->close();
                        
                    } else {
                        header("location: ../front/processosFabrica.php?pg=" . $_GET['pg'] . "&msn=10&erro=1");
                    }
                } else {
                    header("location: ../front/processosFabrica.php?pg=" . $_GET['pg'] . "&msn=10&erro=2");
                }
            } else {
                header("location: ../front/processosFabrica.php?pg=" . $_GET['pg'] . "&msn=13");
            }
        }
        
    } else {
        header("location: ../front/processosFabrica.php?pg=" . $_GET['pg'] . "&msn=10&erro=3");
    }
    $conn->close();
    $i++;
}