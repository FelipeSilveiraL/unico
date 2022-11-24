<?php
session_start();
require_once('../config/query.php');

var_dump($_FILES['arquivo']);

exit;

foreach ($_FILES['arquivo']['name'] as $key => $value) {

    $arquivo = $_FILES['arquivo']['type'][$key];
    $tempFile = $_FILES['arquivo']['tmp_name'][$key];
    $nome = $_FILES['arquivo']['name'][$key];

    echo $value."<br>";
    exit;
        
    if ($arquivo == 'text/plain') {

        $data   = date('Y-m-d');
        $dataBr = implode('', array_reverse(explode('-', $data)));    
        $folderName = substr($dataBr, 0, 4);    
    
        $uploaddir = '/var/www/html/unico/sistemas/sisrev/documentos/CAR/' . $dataBr . '/';
    
    
        if (is_dir($uploaddir)) {
    
            $diretorio = $uploaddir . basename($nome);

            echo $diretorio."<br>";
            exit;
            
            if (move_uploaded_file($tempFile, $diretorio)) {
    
                $diretorioArquivo = array(file($diretorio));//lendo o conteudo do arquivo

                foreach ($diretorioArquivo as $array) {
    
                    $filial = substr($array[0], 40,4);//numero da filial
                    
                    switch ($filial) {
                        case '0054':
                            $filial = rename($diretorio, $uploaddir.'lb3' . $folderName . '.txt');
                            break;
                        case '1551':
                            $filial = rename($diretorio, $uploaddir.'lqx' . $folderName . '.txt');
                            break;
                        case '1225':
                            $filial = rename($diretorio, $uploaddir.'lmc' . $folderName . '.txt');
                            break;
                        case '1682':
                            $filial = rename($diretorio, $uploaddir.'lme' . $folderName . '.txt');
                            break;
                        case '1544':
                            $filial = rename($diretorio, $uploaddir.'las' . $folderName . '.txt');
                            break;
                        case '1581':
                            $filial = rename($diretorio, $uploaddir.'lpz' . $folderName . '.txt');
                            break;
                        case '1329':
                            $filial = rename($diretorio, $uploaddir.'pmu' . $folderName . '.txt');
                            break;
                        case '1494':
                            $filial = rename($diretorio, $uploaddir.'lgf' . $folderName . '.txt');
                            break;
                        case '1417':
                            $filial = rename($diretorio, $uploaddir.'l0s' . $folderName . '.txt');
                            break;
                        case '4773':
                            $filial = rename($diretorio, $uploaddir.'lyf' . $folderName . '.txt');
                            break;
                        case '4778':
                            $filial = rename($diretorio, $uploaddir.'l50' . $folderName . '.txt');
                            break;
                        case '0032':
                            $filial = rename($diretorio, $uploaddir.'luc' . $folderName . '.txt');
                            break;
                    }

                    exit;
                    
                
                    $inserirDb = "INSERT INTO sisrev_arquivo_car (nome_arquivo,caminho,data,id_usuario) VALUES ('".$nome."','".$diretorio."','".$data."','".$_SESSION['id_usuario']."') ";
    
                    $resultado = $conn->query($inserirDb);
    
                    if ($resultado) {
                        header("location: ../front/processosFabrica.php?pg=" . $_GET['pg'] . "&dataArquivo=" . $data . "&msn=11");
                    } else {
                        header("location: ../front/processosFabrica.php?pg=" . $_GET['pg'] . "&msn=10&erro=1");
                    }
                }
    
            } else {
                header("location: ../front/processosFabrica.php?pg=" . $_GET['pg'] . "&msn=10&erro=2");
            }
        }else {

            //cria a pasta se nao existir
            $criaPasta = mkdir($uploaddir, 0777);
    
            //se mudar a permissao do arquivo
            if (chmod($uploaddir, 0777)) {
    
                //mostra onde será salvo o arquivo
                $uploadfile = $uploaddir . basename($nome);
    
                //se o arquivo foi movido pra pasta criada
                if (move_uploaded_file($tempFile, $uploadfile)) {
    
                    $diretorio = '../documentos/CAR/'.$dataBr.'/'.$nome.'';
    
                    $diretorioArquivo = array(file($diretorio));
    
                    //para cada arquivo upado ele vai , abrir o arquivo, ler e renomear o arquivo
                    foreach ($diretorioArquivo as $array) {
    
                    $array1 = $array[0];
    
                    $filial = substr($array1, 40,4);
                    
                    switch ($filial) {
                        case '0054':
                            $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lb3' . $folderName . '.txt');
                            break;
                        case '1551':
                            $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lqx' . $folderName . '.txt');
                            break;
                        case '1225':
                            $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lmc' . $folderName . '.txt');
                            break;
                        case '1682':
                            $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lme' . $folderName . '.txt');
                            break;
                        case '1544':
                            $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/las' . $folderName . '.txt');
                            break;
                        case '1581':
                            $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lpz' . $folderName . '.txt');
                            break;
                        case '1329':
                            $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/pmu' . $folderName . '.txt');
                            break;
                        case '1494':
                            $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lgf' . $folderName . '.txt');
                            break;
                        case '1417':
                            $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/l0s' . $folderName . '.txt');
                            break;
                        case '4773':
                            $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lyf' . $folderName . '.txt');
                            break;
                        case '4778':
                            $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/l50' . $folderName . '.txt');
                            break;
                        case '0032':
                            $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/luc' . $folderName . '.txt');
                            break;
                    }
                    
                $inserirDb = "INSERT INTO sisrev_arquivo_car (nome_arquivo,caminho,data,id_usuario) VALUES ('".$nome."','".$uploadfile."','".$data."','".$_SESSION['id_usuario']."') ";
    
                $resultado = $conn->query($inserirDb);
    
                    if ($resultado) {
                        header("location: ../front/processosFabrica.php?pg=" . $_GET['pg'] . "&dataArquivo=" . $data . "&msn=11");
                    } else {
                        header("location: ../front/processosFabrica.php?pg=" . $_GET['pg'] . "&msn=10&erro=1");
                    }
                }
                } else {
                    header("location: ../front/processosFabrica.php?pg=" . $_GET['pg'] . "&msn=10&erro=2");
                }
            } else {
                header("location: ../front/processosFabrica.php?pg=" . $_GET['pg'] . "&msn=13");
            }
        }

        
    }else{
        header('Location: ../front/processosFabrica.php?pg=5&msn=10&erro=3');
        exit;
    }
    
}


$conn->close();


exit;

if ($arquivo  === 'text/plain') {

    $data   = date('Y-m-d');
    $dataBr = implode('', array_reverse(explode('-', $data)));

    $folderName = substr($dataBr, 0, 4);


    $uploaddir = '/var/www/html/unico/sistemas/sisrev/documentos/CAR/' . $dataBr . '/';


    if (is_dir($uploaddir)) {

        $uploadfile = $uploaddir . basename($nome);

        
        if (move_uploaded_file($tempFile, $uploadfile)) {
            
            $diretorio = '../documentos/CAR/'.$dataBr.'/'.$nome.'';

            $diretorioArquivo = array(file($diretorio));

            foreach ($diretorioArquivo as $array) {

                $array1 = $array[0];

                $filial = substr($array1, 40,4);
                
                switch ($filial) {
                    case '0054':
                        $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lb3' . $folderName . '.txt');
                        break;
                    case '1551':
                        $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lqx' . $folderName . '.txt');
                        break;
                    case '1225':
                        $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lmc' . $folderName . '.txt');
                        break;
                    case '1682':
                        $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lme' . $folderName . '.txt');
                        break;
                    case '1544':
                        $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/las' . $folderName . '.txt');
                        break;
                    case '1581':
                        $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lpz' . $folderName . '.txt');
                        break;
                    case '1329':
                        $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/pmu' . $folderName . '.txt');
                        break;
                    case '1494':
                        $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lgf' . $folderName . '.txt');
                        break;
                    case '1417':
                        $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/l0s' . $folderName . '.txt');
                        break;
                    case '4773':
                        $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lyf' . $folderName . '.txt');
                        break;
                    case '4778':
                        $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/l50' . $folderName . '.txt');
                        break;
                    case '0032':
                        $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/luc' . $folderName . '.txt');
                        break;
                }
                
            $inserirDb = "INSERT INTO sisrev_arquivo_car (nome_arquivo,caminho,data,id_usuario) VALUES ('".$nome."','".$uploadfile."','".$data."','".$_SESSION['id_usuario']."') ";

            $resultado = $conn->query($inserirDb);

                if ($resultado) {
                    header("location: ../front/processosFabrica.php?pg=" . $_GET['pg'] . "&dataArquivo=" . $data . "&msn=11");
                } else {
                    header("location: ../front/processosFabrica.php?pg=" . $_GET['pg'] . "&msn=10&erro=1");
                }
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
            $uploadfile = $uploaddir . basename($nome);

            //se o arquivo foi movido pra pasta criada
            if (move_uploaded_file($tempFile, $uploadfile)) {

                $diretorio = '../documentos/CAR/'.$dataBr.'/'.$nome.'';

                $diretorioArquivo = array(file($diretorio));

                //para cada arquivo upado ele vai , abrir o arquivo, ler e renomear o arquivo
                foreach ($diretorioArquivo as $array) {

                $array1 = $array[0];

                $filial = substr($array1, 40,4);
                
                switch ($filial) {
                    case '0054':
                        $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lb3' . $folderName . '.txt');
                        break;
                    case '1551':
                        $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lqx' . $folderName . '.txt');
                        break;
                    case '1225':
                        $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lmc' . $folderName . '.txt');
                        break;
                    case '1682':
                        $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lme' . $folderName . '.txt');
                        break;
                    case '1544':
                        $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/las' . $folderName . '.txt');
                        break;
                    case '1581':
                        $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lpz' . $folderName . '.txt');
                        break;
                    case '1329':
                        $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/pmu' . $folderName . '.txt');
                        break;
                    case '1494':
                        $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lgf' . $folderName . '.txt');
                        break;
                    case '1417':
                        $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/l0s' . $folderName . '.txt');
                        break;
                    case '4773':
                        $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/lyf' . $folderName . '.txt');
                        break;
                    case '4778':
                        $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/l50' . $folderName . '.txt');
                        break;
                    case '0032':
                        $filial = rename('../documentos/CAR/' . $dataBr . '/' . $_FILES['arquivo']['name'][$i] . '', '../documentos/CAR/' . $dataBr . '/luc' . $folderName . '.txt');
                        break;
                }
                
            $inserirDb = "INSERT INTO sisrev_arquivo_car (nome_arquivo,caminho,data,id_usuario) VALUES ('".$nome."','".$uploadfile."','".$data."','".$_SESSION['id_usuario']."') ";

            $resultado = $conn->query($inserirDb);

                if ($resultado) {
                    header("location: ../front/processosFabrica.php?pg=" . $_GET['pg'] . "&dataArquivo=" . $data . "&msn=11");
                } else {
                    header("location: ../front/processosFabrica.php?pg=" . $_GET['pg'] . "&msn=10&erro=1");
                }
            }
            } else {
                header("location: ../front/processosFabrica.php?pg=" . $_GET['pg'] . "&msn=10&erro=2");
            }
        } else {
            header("location: ../front/processosFabrica.php?pg=" . $_GET['pg'] . "&msn=13");
        }
    }
}