<?php
require_once('../../../config/databases.php');

$dataHoje = date('Y-m-d');

//Quando a nota é carimbada pelo robo no lançamento ao CRM. Isso quer dizer que o dbnotas_hom.carimbo = 1
$recebendoArquivo = $_GET['enviarArquivo'];

//Subindo a nota fiscal
$tipo_file = $_FILES['anexo']['type']; //Pegando qual é a extensão do arquivo
$nome_db = $_FILES['anexo']['name'];

if (empty($_GET['back'])) { //nota
    $caminho = "../documentos/notas/"; //caminho onde será salvo o FILE
} else { //boleto
    $caminho = "../documentos/boletos/"; //caminho onde será salvo o FILE
}

$nomeArquivo = date('dmYhi') . $_FILES['anexo']['name'];

if (move_uploaded_file($_FILES['anexo']['tmp_name'], $caminho . $nomeArquivo)) { //aplicando o salvamento
    echo "<span style='color: green'>SUCESSO: </span>Arquivo enviado para = " . $caminho;
} else {
    echo "<span id='erro'>Erro[1]: Arquivo não foi enviado! - CONTATE O ADMINISTRADOR DO SISTEMA</span><br />";
    echo $_FILES['anexo']['tmp_name'] . $caminho;

    exit;
} //se caso não salvar vai mostrar o erro!

/*Se o receber aquivo for igual a 1 ele vai estar recebendo o arquivo do salvarNota 
e caso ele seja nullo ele vai realizar o envio do anexo e salvar no banco de dados*/

if ($recebendoArquivo == NULL) {


    $insert = "INSERT INTO cad_anexos (ID_LANCARNOTA, url_nota) VALUES ('" . $_GET['idNota'] . "', '" . $caminho . $nomeArquivo . "')";

    if (!$resultInsert = $connNOTAS->query($insert)) {
        echo $insert . "<br />";
        printf('Erro[1]: %s\n', $connNOTAS->error);
        exit;
    } else {
        header('Location: roboLancarNota.php?back=1&idNota=' . $_GET['idNota'] . '');
    }
} else {
    //remover o aqruivo anterior
    $queryAnexo = "SELECT url_nota FROM cad_anexos WHERE ID = " . $_GET['idAnexo'];
    $aplicaquery = $connNOTAS->query($queryAnexo);

    if ($anexo = $aplicaquery->fetch_assoc()) {

        $caminhoNota = "/var/www/html/unico/sistemas/notas/" . substr($anexo['url_nota'], 3);

        unlink($caminhoNota);
    }
    $deletarAnexo = "DELETE FROM cad_anexos WHERE ID = " . $_GET['idAnexo'];
    $aplicar = $connNOTAS->query($deletarAnexo);

    //savar no banco de dados o novo arquivo
    $caminho = "../documentos/notas/"; //caminho onde será salvo o FILE
    $nomeArquivo = date('dmYhi') . $_FILES['anexo']['name'];

    $insert = "INSERT INTO cad_anexos (ID_LANCARNOTA, url_nota) VALUES ('" . $_GET['idNota'] . "', '" . $caminho . $nomeArquivo . "')";

    if (!$resultInsert = $connNOTAS->query($insert)) {
        echo $insert . "<br />";
        printf('Erro[1]: %s\n', $connNOTAS->error);
        exit;
    } else {
        header('Location: salvarNota.php?back=1');
    }
}
