<?php
session_start();
require_once('../config/query.php');

foreach ($_FILES['arquivo']['name'] as $key => $value) {

    $arquivo = $_FILES['arquivo']['type'][$key];
    $tempFile = $_FILES['arquivo']['tmp_name'][$key];
    $nome = $_FILES['arquivo']['name'][$key];

    if ($arquivo == 'text/plain') {

        $datahoje   = date('Y-m-d'); //data de hoje
        $dataBr = implode('', array_reverse(explode('-', $datahoje)));
        $folderName = substr($dataBr, 0, 4);

        $uploaddir = '/var/www/html/unico/sistemas/sisrev/documentos/CAR/' . $dataBr . '/';

        if (!is_dir($uploaddir)) { //verificand se tem o diretorio com a data de hj
            $criaPasta = mkdir($uploaddir, 0777); //cria a pasta se nao existir
        }

        $diretorio = $uploaddir . basename($nome);

        if (!chmod($uploaddir, 0777)) {
            header("location: ../front/processosFabrica.php?pg=" . $_GET['pg'] . "&msn=13"); //não foi criado diretório
            exit;
        } else {

            if (move_uploaded_file($tempFile, $diretorio)) {

                $diretorioArquivo = array(file($diretorio)); //lendo o conteudo do arquivo

                echo $diretorioArquivo;

                foreach ($diretorioArquivo as $array) {

                    $filial = substr($array[0], 40, 4); //numero da filial

                    switch ($filial) {
                        case '0054':
                            $codigoFabrica = "lb3";                           
                            break;
                        case '1551':
                            $codigoFabrica = "lqx";
                            break;
                        case '1225':
                            $codigoFabrica = "lmc";
                            break;
                        case '1682':
                            $codigoFabrica = "lme";
                            break;
                        case '1544':
                            $codigoFabrica = "las";
                            break;
                        case '1581':
                            $codigoFabrica = "lpz";
                            break;
                        case '1329':
                            $codigoFabrica = "pmu";
                            break;
                        case '1494':
                            $codigoFabrica = "lgf";
                            break;
                        case '1417':
                            $codigoFabrica = "l0s";
                            break;
                        case '4773':
                            $codigoFabrica = "lyf";
                            break;
                        case '4778':
                            $codigoFabrica = "l50";
                            break;
                        case '0032':
                            $codigoFabrica = "luc";
                            break;
                        case '4817':
                            $codigoFabrica = "sjp";
                            break;
                        default:
                            header("location: ../front/processosFabrica.php?pg=" . $_GET['pg'] . "&msn=10&erro=6"); //não reconheci filial
                            break;
                    }

                    //renomeando o file
                    $diretorioRename = $uploaddir . $codigoFabrica . $folderName . '.txt';
                    $filial = rename($diretorio, $diretorioRename);

                    //salvando BD
                    $inserirDb = "INSERT INTO sisrev_arquivo_car 
                                                (nome_arquivo,caminho,data,id_usuario) 
                                        VALUES 
                                                ('" . $nome . "',
                                                '" . $diretorioRename . "',
                                                '" . $datahoje . "',
                                                '" . $_SESSION['id_usuario'] . "')";

                    if ($resultado = $conn->query($inserirDb)) {
                        header("location: ../front/processosFabrica.php?pg=" . $_GET['pg'] . "&dataArquivo=" . $datahoje . "&msn=11");
                    } else {
                        header("location: ../front/processosFabrica.php?pg=" . $_GET['pg'] . "&msn=10&erro=1");
                    }
                }
            } else {
                header("location: ../front/processosFabrica.php?pg=" . $_GET['pg'] . "&msn=10&erro=2"); //não subiu file no server
            }
        }
    } else {
        header('Location: ../front/processosFabrica.php?pg=' . $_GET['pg'] . '&msn=10&erro=3'); //file nao permitido
        exit;
    }
}

$conn->close();
