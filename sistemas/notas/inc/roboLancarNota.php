<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- v5.0.2-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Subindo Nota</title>
</head>

<?php
require_once('../../../config/databases.php');

if ($_GET['back'] != 1) { //lançamento da nota

    $dataHoje = date('Y-m-d');
    $email = $_GET['usuario'];
    $cnpjFornecedor = $_GET['cnpjFornecedor'];
    $cnpjFilial = $_GET['cnpjFilial'];
    $serie = $_GET['serie'];
    $numeroNota = $_GET['numeroNota'];
    $dataEmissao = $_GET['dataEmissao'];
    $valorNota = $_GET['valorNota'];
    $dataVencimento = $_GET['dataVencimento'];


    //Ajustando valores
    $caracteres = array('.', '/', '-', ',');
    $filial = str_replace($caracteres, '', $cnpjFilial);

    //verificando se informações estão faltanado
    if ($numeroNota == NULL || $dataEmissao == NULL || $valorNota == NULL) {
        $status = 2; //status = faltando informação
    } else {
        $status = 1; //status = aguardando lançamento
    }

    //buscando o ID da FILIAL
    $queryFilial = "SELECT ID_EMPRESA AS ID_FILIAL FROM unico.bpm_empresas WHERE CNPJ = '" . $filial . "' AND SITUACAO = 'A'";
    $resultadoFilial = $connNOTAS->query($queryFilial);
    $rowIdFilial = $resultadoFilial->fetch_assoc();

    //buscando o ID do USUÀRIO
    $queryUsuario = "SELECT id_usuario AS ID_USUARIO FROM unico.usuarios WHERE email =  '" . $email . "'";
    $resultadoUsuario = $connNOTAS->query($queryUsuario);
    $rowIdUsuario = $resultadoUsuario->fetch_assoc();



    //Salvando na tabela cad_lancarnotas
    $query = "SELECT * FROM cad_rateiofornecedor WHERE ID_USUARIO = '" . $rowIdUsuario['ID_USUARIO'] . "' AND ID_FILIAL = '" . $rowIdFilial['ID_FILIAL'] . "' AND cpfcnpj_fornecedor = " . $cnpjFornecedor . "";
    $result = $connNOTAS->query($query);

    //Salvando a nota no cad_lancarnotas
    if (!$row = $result->fetch_assoc()) {
        echo $query . "<br />";
        echo "<div class='container' id='erroFornecedor' style='margin-top: 10px;'><span style='color: red'>ERRO: </span>Fornecedor ainda não foi devidamente cadastrado</div>";

        exit;
    } else {

        //resolvendo a data de vencimento
        if (empty($dataVencimento)) {

            if ($row['vencimento_tipo'] == 0) {

                //limpando CNPJ da FILIAL
                $str = str_replace('/', '-', $dataEmissao);

                $vencimento =  date('d/m/Y', strtotime('+' . $row['vencimento'] . ' days', strtotime('' . $str . '')));
            } else {
                $vencimento = $row['vencimento'];
            }
        } else {
            $vencimento = $dataVencimento;
        }

        //salvando
        $insert = "INSERT INTO cad_lancarnotas 
                    (ID_FILIAL, 
                    ID_USUARIO, 
                    ID_TIPOPAGAMENTO,
                    ID_PERIODICIDADE,
                    nome_fornecedor, 
                    CNPJ, 
                    auditoria, 
                    obra,
                    marketing, 
                    relatorio_siscon, 
                    motivo_siscon, 
                    observacao, 
                    numero_nota, 
                    serie_nota, 
                    emissao, 
                    vencimento, 
                    valor_nota, 
                    status_desc,
                    date_create,
                    telefone) 
                VALUES 
                    ('" . $rowIdFilial['ID_FILIAL'] . "', 
                    '" . $rowIdUsuario['ID_USUARIO'] . "', 
                    '" . $row['ID_TIPOPAGAMENTO'] . "',
                    '" . $row['ID_PERIODICIDADE'] . "',   
                    '" . $row['fornecedor'] . "', 
                    '" . $cnpjFornecedor . "', 
                    '" . $row['auditoria'] . "', 
                    '" . $row['obra'] . "',";
        $insert .= empty($row['marketing'] ) ? "'0'," : "'" . $row['marketing'] . "',";

        $insert .= empty($row['relatorio_siscon']) ? "'0'," : "'" . $row['relatorio_siscon'] . "',";

        $insert .= empty($row['motivo_siscon']) ? "'0'," : "'" . $row['motivo_siscon'] . "',";

        $insert .= "
                    '" . $row['observacao'] . "', 
                    '" . $numeroNota . "', 
                    '" . $serie . "', 
                    '" . $dataEmissao . "', 
                    '" . $vencimento . "', 
                    '" . $valorNota . "', 
                    '" . $status . "',
                    '" . $dataHoje . "',
                    '" . $row['telefone'] . "')";

        if (!$resultInseret = $connNOTAS->query($insert)) {
            echo $insert . "<br />";
            printf('Erro[1]: %s\n', $connNOTAS->error);

            exit;
        } else {
            $queryPegandoNota = "SELECT MAX(ID_LANCARNOTAS) AS id_nota FROM cad_lancarnotas";
            $resultPegando = $connNOTAS->query($queryPegandoNota);
            $pegandoNota = $resultPegando->fetch_assoc();

            $idNota = $pegandoNota['id_nota'];
        }
    }
} else {
    //lançando o boleto, ai é apenas o robo que irá trabalhar!
    $idNota = $_GET['idNota'];
}
?>

<body>
    <br />
    <br />
    <div class="container py-2">
        <form method="POST" action="enviarAnexo.php?idNota=<?= $idNota ?>&back=<?= $_GET['back'] ?>" enctype="multipart/form-data" id="formNota">
            <div class="mb-3">
                <label for="formFile" class="form-label"><?= $_GET['back'] != 1 ? "Insira Nota Fiscal:" : "Insira o boleto:" ?></label>
                <input class="form-control" type="file" id="nota" name="anexo">
            </div>
            <button type="submit" class="btn btn-primary" id="formNota">Enviar</button>
        </form>
    </div>

</body>

</html>

<?php $connNOTAS->close(); ?>