<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Efetuando carga</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        body {
            align-items: center;
            display: flex;
            justify-content: center;
            min-height: 97vh;
        }
    </style>
</head>
<?php require_once('text_politicamenteE.php');  ?>

<body>
    <div class="container-sm">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Carga - Politicamente exposto</h5>
                <br>
                <ul class="list-group">
                    <li class="list-group-item px-4 p-3"><?= $textAPOLLO ?></li>
                    <li class="list-group-item px-4 p-3"><?= $textNBS ?></li>
                    <li class="list-group-item px-4 p-3"><?= $textNBSR ?></li>
                    <li class="list-group-item px-4 p-3"><?= $textAll ?></li>
                </ul>
            </div>
        </div>
    </div>
</body>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</html>
<?php
require_once('../../../config/databases.php');

if (empty($_GET['confirma'])) {

    if ($_GET['part'] == 1) {
        //DESMARCAR TODOS PARA N APOLLO
        $update = "UPDATE FAT_CLIENTE SET PESSOA_POLITICAMENTE_EXPOSTA = 'N'";
        $updatePE = oci_parse($connApollo, $update);

        oci_execute($updatePE);

        if ($updatePE) {

            echo '<script>window.location.href = "./politicamente_exposto2.php?pg=' . $_GET['pg'] . '&part=2";</script>';

            oci_free_statement($updatePE);
        } else {
            $error = oci_error($connApollo);
            echo 'Deu erro Apollo: ' . $error['message'];
            exit();
        }
    }

    if ($_GET['part'] == 2) {
        //DESMARCAR TODOS PARA 0 NBS
        $updateNBS = "UPDATE CLIENTE_DIVERSO SET POLITICAMENTE_EXPOSTO = 0";
        $updatePENBS = oci_parse($connNbs, $updateNBS);

        if (oci_execute($updatePENBS)) {
            oci_free_statement($updatePENBS);


            echo '<script>window.location.href = "./politicamente_exposto2.php?pg=' . $_GET['pg'] . '&part=3";</script>';
        } else {
            $error = oci_error($connNbs);
            echo 'Deu erro Nbs: ' . $error['message'];
            exit();
        }
    }

    //DESMARCAR TODOS PARA 0 NBS_RIBEIRAO
    if ($_GET['part'] == 3) {
        $updateRI = "UPDATE CLIENTE_DIVERSO SET POLITICAMENTE_EXPOSTO = 0";
        $updatePERI = oci_parse($connNbsRibeirao, $updateRI);

        if (oci_execute($updatePERI, OCI_COMMIT_ON_SUCCESS)) {
            oci_free_statement($updatePERI);

            echo '<script>window.location.href = "./politicamente_exposto2.php?pg=' . $_GET['pg'] . '&part=4";</script>';
        } else {
            $error = oci_error($updatePERI);
            echo 'Deu erro Nbs Ribeirao: ' . $error['message'];
            exit();
        }
        echo '<script>window.location.href = "./politicamente_exposto2.php?pg=' . $_GET['pg'] . '&part=4";</script>';
    }
}


if ($_GET['part'] == 4) {

    //BUSCAR CPF
    $queryBuscarCPF = "SELECT id, CPF_PEP, apollo, nbs, nbs_ribeirao FROM sisrev_politicamente_exposto WHERE atualizado = 0";
    $resultBuscaCPF = $conn->query($queryBuscarCPF);

    $count = 1;

    while ($buscaCPF = $resultBuscaCPF->fetch_assoc()) {

        $cpf = $buscaCPF['CPF_PEP'];

        //trabalhando com o CPF
        $totalCaracter = strlen($cpf);

        //manter sempre 11 caracteres o CPF
        while ($totalCaracter < 11) {
            $cpf = '0' . $cpf;
            $totalCaracter = strlen($cpf);
        }

        if ($count < 10000) {

            if (empty($buscaCPF['apollo'])) { //UPDATE APOLLO

               $queryencontre = "SELECT CLIENTE FROM FAT_CLIENTE WHERE CGCCPF = '" . $cpf . "'";

                $resultado = oci_parse($connApollo, $queryencontre);
                oci_execute($resultado);

                while($clienteApollo = oci_fetch_array($resultado, OCI_ASSOC)){
                    $idClienteApollo = $clienteApollo['CLIENTE'];
                }

                if (oci_num_rows($resultado) != 0) {
                    $updateApolloPE = "UPDATE FAT_CLIENTE SET PESSOA_POLITICAMENTE_EXPOSTA = 'S' WHERE CLIENTE = '" . $idClienteApollo . "'";

                    $apolloPE = oci_parse($connApollo, $updateApolloPE);
                    oci_execute($apolloPE);
                    oci_free_statement($apolloPE);

                    // S = ENCONTREI
                    $insertLogS = "UPDATE sisrev_politicamente_exposto SET apollo = 'S' WHERE `id`='" . $buscaCPF['id'] . "'";
                } else {
                    // N = NÂO ENCONTREI
                    $insertLogS = "UPDATE sisrev_politicamente_exposto SET apollo = 'N' WHERE `id`='" . $buscaCPF['id'] . "'";                    
                }

                $resultadoLogS = $conn->query($insertLogS);

                oci_free_statement($resultado);
            } // END UPDATE APOLLO

            //incluir os caracteres de (.) e (-)
            $primeira = substr($cpf, 0, 3) . ".";
            $segunda = substr($cpf, 3, 3) . ".";
            $terceira = substr($cpf, 6, 3) . "-";
            $quarta = substr($cpf, 9);

            $cpf = $primeira . $segunda . $terceira . $quarta;

             if (empty($buscaCPF['nbs'])) { //UPDATE NBS

                $queryencontreNBS = "SELECT COD_CLIENTE FROM CLIENTE_DIVERSO WHERE CPF = '" . $cpf . "'";
                $resultadoNBS = oci_parse($connNbs, $queryencontreNBS);
                oci_execute($resultadoNBS);

                while ($clienteNBS = oci_fetch_array($resultadoNBS, OCI_ASSOC)) {
                    $idClienteNbs = $clienteNBS['COD_CLIENTE'];
                }

                if (oci_num_rows($resultadoNBS) != 0) {

                    $updateApolloPENBS = "UPDATE CLIENTE_DIVERSO SET POLITICAMENTE_EXPOSTO = 1 WHERE COD_CLIENTE = '" . $idClienteNbs . "'";
                    $apolloPENBS = oci_parse($connNbs, $updateApolloPENBS);
                    oci_execute($apolloPENBS);

                    // S = ENCONTREI
                    $insertLogS = "UPDATE sisrev_politicamente_exposto SET nbs = 'S' WHERE `id`='" . $buscaCPF['id'] . "'";
                    
                } else {
                    // N = NÂO ENCONTREI
                    $insertLogS = "UPDATE sisrev_politicamente_exposto SET nbs = 'N' WHERE `id`='" . $buscaCPF['id'] . "'";                    
                }

                $resultadoLogS = $conn->query($insertLogS);
                oci_free_statement($resultadoNBS);
            } // END UPDATE NBS

            if (empty($buscaCPF['nbs_ribeirao'])) { //UPDATE NBS RIBEIRAO

                $queryencontreNBSR = "SELECT COD_CLIENTE FROM CLIENTE_DIVERSO WHERE CPF = '" . $cpf . "'";
                $resultadoNBSR = oci_parse($connNbsRibeirao, $queryencontreNBSR);
                oci_execute($resultadoNBSR);

                while ($clienteNBSR = oci_fetch_array($resultadoNBSR, OCI_ASSOC)) {
                    $idClienteNBSR = $clienteNBSR['COD_CLIENTE'];
                }

                if (oci_num_rows($resultadoNBSR) != 0) {
                    $updateApolloPENBSR = "UPDATE CLIENTE_DIVERSO SET POLITICAMENTE_EXPOSTO = 1 WHERE COD_CLIENTE = '" . $idClienteNBSR . "'";
                    $apolloPENBSR = oci_parse($connNbsRibeirao, $updateApolloPENBSR);
                    oci_execute($apolloPENBSR);  

                    // S = ENCONTREI
                    $insertLogSRI = "UPDATE sisrev_politicamente_exposto SET nbs_ribeirao = 'S' WHERE `id`='" . $buscaCPF['id'] . "'";
                } else {
                    // N = NÂO ENCONTREI
                    $insertLogSRI = "UPDATE sisrev_politicamente_exposto SET nbs_ribeirao = 'N' WHERE `id`='" . $buscaCPF['id'] . "'";
                } //END IF ENCONTRANDO O CLIENTE

                $resultadoLogSRI = $conn->query($insertLogSRI);

                oci_free_statement($resultadoNBSR);
            } // END UPDATE NBS RIBEIRAO 

            $insertLog = "UPDATE sisrev_politicamente_exposto SET atualizado = '1' WHERE id ='" . $buscaCPF['id'] . "'";
            $resultadoLog = $conn->query($insertLog);
        } else {
             echo '<script>document.location.reload(true);</script>';
            exit;
        } // END COUNT

        $count++;
    }

    header('location: ../front/politicamente_exposto.php?pg=' . $_GET['pg'] . '&msn=11');
}

//fechar banco sempre no final do arquivo!
oci_close($connApollo);
oci_close($connNbs);
oci_close($connNbsRibeirao);
$conn->close();

?>