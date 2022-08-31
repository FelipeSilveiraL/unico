<?php
session_start();
require_once('../config/query.php');

$arquivo = $_FILES['arquivo']['type'];

$tempFile = $_FILES['arquivo']['tmp_name'];
$nome = $_FILES['arquivo']['name'];
$total = count($tempFile);

$i = 0;

while ($i <= $total) {

    if ($arquivo[$i] === 'text/plain') {

        $data   = date('Y-m-d');
        $dataBr = implode('', array_reverse(explode('-', $data)));

        $folderName = substr($dataBr, 0, 4);


        $uploaddir = '/var/www/html/unico/sistemas/sisrev/documentos/CAR/' . $dataBr . '/';


        if (is_dir($uploaddir)) {

            $uploadfile = $uploaddir . basename($nome[$i]);

            
            if (move_uploaded_file($tempFile[$i], $uploadfile)) {
                
                $diretorio = '../documentos/CAR/'.$dataBr.'/'.$nome[$i].'';

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
                $uploadfile = $uploaddir . basename($nome[$i]);

                //se o arquivo foi movido pra pasta criada
                if (move_uploaded_file($tempFile[$i], $uploadfile)) {

                    $diretorio = '../documentos/CAR/'.$dataBr.'/'.$nome[$i].'';

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
    } else {
        header("location: ../front/processosFabrica.php?pg=" . $_GET['pg'] . "&msn=10&erro=3");
    }
    
    $conn->close();

    $i++;
}
    
?>