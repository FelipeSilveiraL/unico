<?php
require_once('../config/query.php');    

    switch ($_GET['acao']) {

        case 1://ADICIONAR

            if($_POST['submodulo'] == 1){//SIM

                $moduloCAMPO = ",sub_modulo";
                $moduloVALUE = ",'".$_POST['modulo']."'";

            }elseif($_POST['submodulo'] == 2){//NÂO

                $moduloCAMPO = ",icone";
                $moduloVALUE = ",'".$_POST['icone']."'";

                $localizacao = ",localizacao";
                $localizacaoVALUE = ",'".$_POST['localizacao']."'";
            }else{
                $moduloCAMPO = ",pagina";
                $moduloVALUE = ",'".$_POST['modulo']."'";
            }

            $queryInsert = "INSERT INTO sisrev_modulos (nome, endereco ".$moduloCAMPO .$localizacao.") 
            VALUES ('".$_POST['nome']."', '".$_POST['endereco']."'".$moduloVALUE.$localizacaoVALUE .")";
            if (!$resultInsert = $conn->query($queryInsert)){
                
                printf("Erro ao inserir dados %s\n", $conn->error);
                exit;
            }

            header('Location: ../front/telas_funcoes.php?pg='.$_GET['pg'].'&tela='.$_GET['tela'].'&msn=8');

            break;
        case 2://EDITAR

            if($_POST['submodulo'] == 3){
                $sub = '0';
                $pag = $_POST['modulo'];

            }elseif($_POST['submodulo'] == 1){
                $pag = '0';
                $sub = $_POST['modulo'];
            }
            
            $queryUpdate = "UPDATE sisrev_modulos SET 
                                nome ='".$_POST['nome']."', 
                                endereco ='".$_POST['endereco']."',
                                sub_modulo = '"; $queryUpdate .= empty($sub) ? '0' : $sub; $queryUpdate .="',
                                icone = '"; $queryUpdate .= empty($_POST['icone']) ? '0' : $_POST['icone']; $queryUpdate .="',
                                localizacao = '"; $queryUpdate .= empty($_POST['localizacao']) ? '0' : $_POST['localizacao']; $queryUpdate .="',
                                pagina = '"; $queryUpdate .= empty($pag) ? '0' : $pag; $queryUpdate .="'
                            WHERE id= ".$_GET['id'];

            
            if (!$resultUpdate = $conn->query($queryUpdate)){
                printf("Erro ao editar as informações %s\n", $conn->error);
            }
            
            header('Location: ../front/telas_funcoes.php?pg='.$_GET['pg'].'&tela='.$_GET['tela'].'&msn=4');
        
            break;

        case 3://DELETAR
            $queryDeletar = "UPDATE sisrev_modulos SET deletar = '1' WHERE id='".$_GET['id']."'";
            if (!$resultDeletar = $conn->query($queryDeletar)){
                printf("Erro ao deletar as informações %s\n", $conn->error);
                exit;
            }
            header('Location: ../front/telas_funcoes.php?pg='.$_GET['pg'].'&tela='.$_GET['tela'].'&msn=5');
            break;
    }
