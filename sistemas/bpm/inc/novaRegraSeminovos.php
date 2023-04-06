<?php
require_once('../config/query.php');
require_once('../../../config/sqlSmart.php');


$caracteres = array(".", "-", "/");
$cnpj = str_replace($caracteres, "", $_POST['cnpj']);

/* VERIFICANDO SE O CNPJ JÁ NÃO FOI CADASTRADO */

$queryfornecedoresSeminovos .= " WHERE FS.cnpj = '" . $cnpj . "'";
$resultFornecedorS = oci_parse($connBpmgp, $queryfornecedoresSeminovos);
oci_execute($resultFornecedorS);


while ($rowFornecedor = oci_fetch_array($resultFornecedorS, OCI_ASSOC)) {
    header('Location: ../front/seminovos.php?pg=' . $_GET['pg'] . '&msn=19'); //ja cadastrado
}
oci_free_statement($resultFornecedorS);

/* CADASTRANDO */
if ($_POST['utilizaSmartshare'] == 'S') {
    $campo = ', smartshare_login';
    $value = ",'" . $_POST['login'] . "'";
}

//EFETUANDO O CADASTRO
$insertFornecedor = "INSERT INTO fornecedores_seminovos (CNPJ, RAZAO_SOCIAL, CIDADE, UF, SMARTSHARE, EMAIL, NOME_RESPONSAVEL, ATIVO" . $campo . ")
                        VALUES
                        ('" . $cnpj . "',
                        '" . strtoupper($_POST['razao_social']) . "',
                        '" . $_POST['cidade'] . "',
                        '" . $_POST['estados'] . "',
                        '" . $_POST['utilizaSmartshare'] . "',
                        '" . $_POST['email'] . "',
                        '" . strtoupper($_POST['nome_responsavel']) . "',
                        '" . $_POST['ativo'] . "'" . $value . ")";

$resultGes = oci_parse($connBpmgp, $insertFornecedor);

if (oci_execute($resultGes)) {

    if ($_POST['utilizaSmartshare'] == 'S') {
        //MANDAR EMAIL
        header('Location: enviar.php?id_drop=15&id_usuario=' . $_GET['id_usuario'] . '&msn=1&cnpj=' . $_POST['cnpj'] . '&razao=' . $_POST['razao_social'] . '&cidade=' . $_POST['cidade'] . '&estado=' . $_POST['estados'] . '&email=' . $_POST['email'] . '&responsavel=' . strtoupper($_POST['nome_responsavel']) . '&ativo=' . $_POST['ativo'] . '&pg=' . $_GET['pg'] . ''); //Cadastrado com Sucesso!
    } else {
        //APENAS VOLTA E AVISA QUE TERMINOU
        header('Location: ../front/seminovos.php?pg=' . $_GET['pg'] . '&msn=8'); //Cadastrado com Sucesso!
    }
    oci_free_statement($resultGes);
} else {
    $e = oci_error($resultGes);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%" . ($e['offset'] + 1) . "s", "^");
    print  "\n</pre>\n";
}

oci_close($connBpmgp);
