<?php
require_once('../conf/conexao.php');

$dataHoje = date('Y-m-d');

//criando variavel para apenas salvar a nota
$recebendoArquivo = $_GET['enviarArquivo'];

//Subindo a nota fiscal
$tipo_file = $_FILES['anexo']['type']; //Pegando qual é a extensão do arquivo
$nome_db = $_FILES['anexo']['name'];

if(empty($_GET['back'])){//nota
    $caminho = "../documentos/notas/" . $_FILES['anexo']['name']; //caminho onde será salvo o FILE
}else{//boleto
    $caminho = "../documentos/boletos/" . $_FILES['anexo']['name']; //caminho onde será salvo o FILE
}

if (move_uploaded_file($_FILES['anexo']['tmp_name'], $caminho)) { //aplicando o salvamento
    echo "<span style='color: green'>SUCESSO: </span>Arquivo enviado para = " . $caminho;
} else {
    echo "<span id='erro'>Erro[1]: Arquivo não foi enviado! - CONTATE O ADMINISTRADOR DO SISTEMA</span><br />";
    echo $_FILES['anexo']['tmp_name'].$caminho;

    exit;
} //se caso não salvar vai mostrar o erro!

/*Se o receber aquivo for igual a 1 ele vai estar recebendo o arquivo do salvarNota 
e caso ele seja nullo ele vai realizar o envio do anexo e salvar no banco de dados*/

if ($recebendoArquivo == NULL) {

    $insert = "INSERT INTO cad_anexos (ID_LANCARNOTA, url_nota) VALUES ('".$_GET['idNota']."', '".$caminho."')";

    if (!$resultInsert = $connNOTAS->query($insert)) {
        echo $insert."<br />";
        printf('Erro[1]: %s\n', $connNOTAS->error);
        exit;
    } else {
        header('Location: roboLancarNota.php?back=1&idNota='.$_GET['idNota'].'');
    }
}
