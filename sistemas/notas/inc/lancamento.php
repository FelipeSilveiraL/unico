<?php
require_once('../config/query.php');

//SALVANDO NOTA PARA LANÇAMENTO
$carimbar = $_POST['carimbar'] == NULL ? 0 : 1;

$insertNota = "INSERT INTO cad_lancarnotas
(`ID_FILIAL`,
`ID_USUARIO`,
`ID_TIPODESPESA`,
`ID_TIPOPAGAMENTO`,
`CNPJ`,
`nome_fornecedor`,
`auditoria`,
`marketing`,
`obra`,
`observacao`,
`numero_nota`,
`serie_nota`,
`emissao`,
`vencimento`,
`valor_nota`,
`status_desc`,
`date_create`,
`telefone`,
`carimbar`,
`tipo_serv`)
VALUES
('" . $_POST['filial'] . "',
'" . $_POST['usuarioResponsavel'] . "',
'" . $_POST['tipodespesa'] . "',
'" . $_POST['tipoPagamento'] . "',
'" . $_POST['cpfCnpjFor'] . "',
'" . $_POST['NomeFornecedor'] . "',
'" . $_POST['departamentoAuditoria'] . "',
'" . $_POST['notasMarketing'] . "',
'" . $_POST['notasGrupo'] . "',
'" . $_POST['observacao'] . "',
'" . $_POST['numeroNota'] . "',
'" . strtoupper($_POST['serie']) . "',
'" . $_POST['emissao'] . "',
'" . $_POST['vencimento'] . "',
'" . $_POST['valor'] . "',
1,
'" . date('Y-m-d') . "',
'" . $_POST['telefone'] . "',
'" . $carimbar . "',
'" . strtoupper($_POST['tipoServico']) . "')";

$aplicarInsertNota = $connNOTAS->query($insertNota);

//PEGANDO A NOTA QUE ACABOU DE LANÇAR
$queryUltimoLancamento = "SELECT MAX(ID_LANCARNOTAS) AS id_lancarnotas FROM cad_lancarnotas";
$aplicarUltimo = $connNOTAS->query($queryUltimoLancamento);
$ultimo = $aplicarUltimo->fetch_assoc();

//SALVANDO VALOR DA NOTA COM O RATEIO
$cont = 0;

while ($_POST['valorRateado' . $cont] != NULL) {
    $insertValorCentro = "INSERT INTO cad_lancarnotas_centrocusto
                            (`ID_LANCARNOTAS`,
                            `ID_CENTROCUSTO`,
                            `valor`,
                            `percentual`)
                            VALUES
                            (" . $ultimo['id_lancarnotas'] . ",
                            '" . $_POST['centroCusto' . $cont] . "',
                            '" . $_POST['valorRateado' . $cont] . "',
                            '" . $_POST['percentual' . $cont] . "')";
    $cont++;

    $aplicaValorCentro = $connNOTAS->query($insertValorCentro);
}

//SALVANDO O ARQUIVO DA NOTA/BOLETO

$extPDF = 'application/pdf'; //PDF
$caminhoNota = "/var/www/html/unico/sistemas/notas/documentos/notas/";
$caminhoBoleto = "/var/www/html/unico/sistemas/notas/documentos/boletos/";


//nota
if ($_FILES['filenota']["type"] === $extPDF) {
    //SUBINDO O ARQUIVO NO SERVIDOR
    $nomeArquivo = date('dmYhi') . $_FILES['filenota']['name'];
    $uploadfile  = $caminhoNota . $nomeArquivo;

    if (move_uploaded_file($_FILES['filenota']['tmp_name'], $uploadfile)) {

        $insertAnexo = "INSERT INTO cad_anexos
        (`ID_LANCARNOTA`,
        `url_nota`)
        VALUES
        (" . $ultimo['id_lancarnotas'] . ",
        'documentos/notas/" . $nomeArquivo . "')";

        $aplicarAnexo = $connNOTAS->query($insertAnexo);
    } else {
        header('location: ../front/index.php?pg=1&msn=10&erro=2'); //não foi possivel salvar o arquivo
    }
} else {
    header('location: ../front/index.php?pg=1&msn=10&erro=3'); //extensão do arquivo é invalida
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
            (" . $ultimo['id_lancarnotas'] . ",
            'documentos/boletos/" . $nomeArquivoBoleto . "')";

            $aplicarAnexo = $connNOTAS->query($insertAnexo);
        } else {
            header('location: ../front/index.php?pg=1&msn=10&erro=2'); //não foi possivel salvar o arquivo
        }
    } else {
        header('location: ../front/index.php?pg=1&msn=10&erro=3'); //extensão do arquivo é invalida
    }
}

header('Location: ../front/index.php?pg=1&msn=8');