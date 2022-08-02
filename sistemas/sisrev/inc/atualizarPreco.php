<?php
session_start();
require '../../../vendor/autoload.php'; //autoload da biblioteca
require_once('../config/query.php');
require_once('../../../config/config.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet; //classe responsável pela manipulação da planilha

$extXLSX = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";

!empty($_POST['empresa']) ?: header("location: ../front/atualizarPreco.php?pg=2");

switch ($_POST['empresa']) {
    case '55':
        //diretórios
        $caminho = "/var/www/html/unico/sistemas/sisrev/documentos/AP/triumph/";

        if ($_FILES['arquivo']["type"] === $extXLSX) {
            //SUBINDO O ARQUIVO NO SERVIDOR
            $uploadfile  = $caminho . date('dmYhi') . $_FILES['arquivo']['name'];

            if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploadfile)) {
                //log da carga
                $insertLog = "INSERT INTO sisrev_arquivo_ap (caminho, nome_arquivo, data, id_usuario, id_empresa, forcado";
                if($_POST['relatorio'] == 1){
                    $insertLog .= ', relatorio';
                }                
                $insertLog .= ") VALUES ('" . $uploadfile . "', '" . $_FILES['arquivo']['name'] . "','" . date('Y-m-d H:i:s') . "','" . $_SESSION['id_usuario'] . "','" . $_POST['empresa'] . "', '" . $_POST['forcarPreco'] . "'";

                if($_POST['relatorio'] == 1){
                    $insertLog .= ', 1';
                }                
                $insertLog .= ")";

                $result = $conn->query($insertLog);

                //limpar banco para receber as informações
                $truncate = "TRUNCATE sisrev_atualizacao_preco_triumph";
                $resultTruncate = $conn->query($truncate);

                //carrega os arquivos vindo da planilha
                $arquivo = $uploadfile;
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
                $spreadsheet = $reader->load($arquivo);
                $sheet = $spreadsheet->getActiveSheet();

                foreach ($sheet->getRowIterator(8) as $row) {

                    $cellInterator = $row->getCellIterator();
                    $cellInterator->setIterateOnlyExistingCells(false);


                    $query = "INSERT INTO sisrev_atualizacao_preco_triumph
                        (item,descricao,grupo,fiscal,rrp,total_invoice,uf)
                        VALUES (";

                    //Linha
                    foreach ($cellInterator as $cell) {
                        if (!is_null($cell)) {
                            $value = $cell->getCalculatedValue();
                            if (trim($value) != '') {
                                $query .= "'" . $value . "',";
                            }
                        }
                    }
                    $count = strlen($query) - 1;
                    $insert = substr($query, 0, $count) . ")";
                    $resultado = $conn->query($insert);
                }
            } else {
                header('location: ../front/atualizarPreco.php?pg=' . $_GET['pg'] . '&msn=10&erro=2'); //não foi possivel salvar o arquivo
            }

            //finalizado ele sera enviado para o apollo
            if ($_POST['relatorio'] == 1) {
                echo '<script>window.location.href = "../front/atualizarPreco.php?pg=' . $_GET['pg'] . '&empresa=' . $_POST['empresa'] . '&acao=1";</script>';
            } else {
                echo '<script>window.location.href = "http://' . $_SESSION['servidorOracle'] . '/unico_api/sisrev/inc/atualizacaoPecas.php?pg=' . $_GET['pg'] . '&empresa=' . $_POST['empresa'] . '&forcar=' . $_POST['forcarPreco'] . '&acao=1";</script>';
            }
        } else {
            header('location: ../front/atualizarPreco.php?pg=' . $_GET['pg'] . '&msn=10&erro=3'); //extensão do arquivo é invalida
        }

        break;

    case '56':

        //diretórios
        $caminho = "/var/www/html/unico/sistemas/sisrev/documentos/AP/ducati/";

        if ($_FILES['arquivo']["type"] === $extXLSX) {
            //SUBINDO O ARQUIVO NO SERVIDOR
            $uploadfile  = $caminho . date('dmYhi') . $_FILES['arquivo']['name'];

            if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploadfile)) {
                //log da carga
                //log da carga
                $insertLog = "INSERT INTO sisrev_arquivo_ap (caminho, nome_arquivo, data, id_usuario, id_empresa, forcado";
                if($_POST['relatorio'] == 1){
                    $insertLog .= ', relatorio';
                }                
                $insertLog .= ") VALUES ('" . $uploadfile . "', '" . $_FILES['arquivo']['name'] . "','" . date('Y-m-d H:i:s') . "','" . $_SESSION['id_usuario'] . "','" . $_POST['empresa'] . "', '" . $_POST['forcarPreco'] . "'";

                if($_POST['relatorio'] == 1){
                    $insertLog .= ', 1';
                }                
                $insertLog .= ")";

                $result = $conn->query($insertLog);

                //limpar banco para receber as informações
                $truncate = "TRUNCATE sisrev_atualizacao_preco_ducati";
                $resultTruncate = $conn->query($truncate);

                //carrega os arquivos vindo da planilha
                $arquivo = $uploadfile;
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
                $spreadsheet = $reader->load($arquivo);
                $sheet = $spreadsheet->getActiveSheet();

                foreach ($sheet->getRowIterator(8) as $row) {

                    $cellInterator = $row->getCellIterator();
                    $cellInterator->setIterateOnlyExistingCells(false);


                    $query = "INSERT INTO sisrev_atualizacao_preco_ducati
                            (item,descricao,quantidade,custo_dealer,rrp,ncm,substituiveis)
                            VALUES (";

                    //Linha
                    foreach ($cellInterator as $cell) {
                        if (!is_null($cell)) {
                            $value = $cell->getCalculatedValue();
                            if (trim($value) != '') {
                                $query .= "'" . $value . "',";
                            }
                        }
                    }
                    $count = strlen($query) - 1;
                    $insert = substr($query, 0, $count) . ")";
                    $resultado = $conn->query($insert);
                }
            } else {
                header('location: ../front/atualizarPreco.php?pg=' . $_GET['pg'] . '&msn=10&erro=2'); //não foi possivel salvar o arquivo
            }

            //finalizado ele sera enviado para o apollo
            if ($_POST['relatorio'] == 1) {
                echo '<script>window.location.href = "../front/atualizarPreco.php?pg=' . $_GET['pg'] . '&empresa=' . $_POST['empresa'] . '&acao=1";</script>';
            } else {
                echo '<script>window.location.href = "http://' . $_SESSION['servidorOracle'] . '/unico_api/sisrev/inc/atualizacaoPecas.php?pg=' . $_GET['pg'] . '&empresa=' . $_POST['empresa'] . '&forcar=' . $_POST['forcarPreco'] . '&acao=1";</script>';
            }
        } else {
            header('location: ../front/atualizarPreco.php?pg=' . $_GET['pg'] . '&msn=10&erro=3'); //extensão do arquivo é invalida
        }

        break;

    case '10':

        //log da carga
        $insertLog = "INSERT INTO sisrev_arquivo_ap (nome_arquivo, data, id_usuario,id_empresa";

        if($_POST['relatorio'] == 1){
            $insertLog .= ', relatorio';
        }                
        $insertLog .= ") VALUES ('Data usada: ".date('d/m/Y', strtotime($_POST['dataHistorico']))."','" . date('Y-m-d H:i:s') . "','" . $_SESSION['id_usuario'] . "','" . $_POST['empresa'] . "'";

        if($_POST['relatorio'] == 1){
            $insertLog .= ', 1';
        }                

        $insertLog .= ")";       
        
        $result = $conn->query($insertLog);

        if($_POST['relatorio'] == 1){
            echo '<script>window.location.href = "http://' . $_SESSION['servidorOracle'] . '/unico_api/sisrev/inc/atualizacaoPecas.php?pg=' . $_GET['pg'] . '&empresa=' . $_POST['empresa'] . '&relatorio=1&acao=1&data='.$_POST['dataHistorico'].'";</script>';
        }else{
            echo '<script>window.location.href = "http://' . $_SESSION['servidorOracle'] . '/unico_api/sisrev/inc/atualizacaoPecas.php?pg=' . $_GET['pg'] . '&empresa=' . $_POST['empresa'] . '&acao=1&data='.$_POST['dataHistorico'].'";</script>';
        }
        break;
} //fim switch


$conn->close();