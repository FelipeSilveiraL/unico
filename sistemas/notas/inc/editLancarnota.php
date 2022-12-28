<?php
session_start();

require_once('../config/query.php');

//ALTUALIZAR OS DADOS
$carimbar = $_POST['carimbar'] == NULL ? 0 : 1;

$updateLancarNota = "UPDATE cad_lancarnotas
SET
`ID_FILIAL` = '" . $_POST['filial'] . "',
`ID_USUARIO` = '" . $_SESSION['nome_usuario'] . "',
`ID_TIPODESPESA` = '" . $_POST['tipodespesa'] . "',
`ID_TIPOPAGAMENTO` = '" . $_POST['tipoPagamento'] . "',
`CNPJ` = '" . $_POST['cpfCnpjFor'] . "',
`nome_fornecedor` = '" . $_POST['NomeFornecedor'] . "',
`auditoria` = '" . $_POST['departamentoAuditoria'] . "',
`marketing` = '" . $_POST['notasMarketing'] . "',
`obra` = '" . $_POST['notasGrupo'] . "',
`observacao` = '" . $_POST['observacao'] . "',
`numero_nota` = '" . $_POST['numeroNota'] . "',
`serie_nota` = '" . $_POST['serie'] . "',
`emissao` = '" . $_POST['emissao'] . "',
`vencimento` = '" . $_POST['vencimento'] . "',
`valor_nota` = '" . $_POST['valor'] . "',
`status_desc` = '1',
`telefone` = '" . $_POST['telefone'] . "',
`carimbar` = '" . $carimbar . "',
`tipo_serv` = '" . $_POST['tipoServico'] . "'
WHERE `ID_LANCARNOTAS` = " . $_GET['id'];

$aplicarUpdate = $connNOTAS->query($updateLancarNota);

//ATUALIZAR CENTRO DE CUSTO

//deleta
$limpar = "DELETE FROM cad_lancarnotas_centrocusto WHERE `ID_LANCARNOTAS`= " . $_GET['id'];
$aplicarLImpar = $connNOTAS->query($limpar);

//insere
$cont = 0;

while ($_POST['valorRateado' . $cont] != NULL) {
    $insertValorCentro = "INSERT INTO cad_lancarnotas_centrocusto
                            (`ID_LANCARNOTAS`,
                            `ID_CENTROCUSTO`,
                            `valor`,
                            `percentual`)
                            VALUES
                            (" . $_GET['id'] . ",
                            '" . $_POST['centroCusto' . $cont] . "',
                            '" . $_POST['valorRateado' . $cont] . "',
                            '" . $_POST['percentual' . $cont] . "')";
    $cont++;

    $aplicaValorCentro = $connNOTAS->query($insertValorCentro);
}


//SALVAR ANEXOS

$extPDF = 'application/pdf'; //PDF
$caminhoNota = "/var/www/html/unico/sistemas/notas/documentos/notas/";
$caminhoBoleto = "/var/www/html/unico/sistemas/notas/documentos/boletos/";

//nota
if ($_FILES['filenota']["type"] != NULL) {
    if ($_FILES['filenota']["type"] === $extPDF) {
        //SUBINDO O ARQUIVO NO SERVIDOR
        $nomeArquivo = date('dmYhi') . $_FILES['filenota']['name'];
        $uploadfile  = $caminhoNota . $nomeArquivo;

        if (move_uploaded_file($_FILES['filenota']['tmp_name'], $uploadfile)) {

            $insertAnexo = "INSERT INTO cad_anexos
        (`ID_LANCARNOTA`,
        `url_nota`)
        VALUES
        (" . $_GET['id'] . ",
        'documentos/notas/" . $nomeArquivo . "')";

            $aplicarAnexo = $connNOTAS->query($insertAnexo);
        } else {
            header('location: ../front/index.php?pg=1&msn=10&erro=2'); //não foi possivel salvar o arquivo
        }
    } else {
        header('location: ../front/index.php?pg=1&msn=10&erro=3'); //extensão do arquivo é invalida
    }
}

//boleto
if ($_FILES['fileboleto']["type"] != NULL) {
    if ($_FILES['fileboleto']["type"] === $extPDF) {
        //SUBINDO O ARQUIVO NO SERVIDOR
        $nomeArquivoBoleto = date('dmYhi') . $_FILES['fileboleto']['name'];
        $uploadfileB  = $caminhoBoleto . $nomeArquivoBoleto;

        if (move_uploaded_file($_FILES['fileboleto']['tmp_name'], $uploadfileB)) {
            $insertAnexo = "INSERT INTO cad_anexos
            (`ID_LANCARNOTA`,
            `url_nota`)
            VALUES
            (" . $_GET['id'] . ",
            'documentos/boletos/" . $nomeArquivoBoleto . "')";

            $aplicarAnexo = $connNOTAS->query($insertAnexo);
        } else {
            header('location: ../front/index.php?pg=1&msn=10&erro=2'); //não foi possivel salvar o arquivo
        }
    } else {
        header('location: ../front/index.php?pg=1&msn=10&erro=3'); //extensão do arquivo é invalida
    }
}

header('Location: ../front/index.php?pg=1&msn=4');//editado com sucesso!