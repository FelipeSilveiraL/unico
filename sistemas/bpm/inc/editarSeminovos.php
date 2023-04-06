<?php
require_once('../config/query.php');

$queryForncedor = "SELECT SMARTSHARE_LOGIN FROM fornecedores_seminovos WHERE id_fornecedor = " . $_GET['id_fornecedor'];
$resFo = oci_parse($connBpmgp, $queryForncedor);
oci_execute($resFo);

while($fornecedor = oci_fetch_array($resFo, OCI_ASSOC)) {
    $loginSmart = $fornecedor['SMARTSHARE_LOGIN'];
}

$loginFormulario = strtolower($_POST['login']);

if($loginFormulario != '' AND $_POST['utilizaSmartshare'] == 'P' ){
    $loginFormulario = '';
}

if ($_POST['utilizaSmartshare'] == 'N') {

    if (!empty($loginSmart)) {
        //DESTAVIAR O USUARIO NA SELBETTI
        $querySelbetti = "UPDATE usuario SET st_ativo = 1 WHERE DS_LOGIN = '" . $loginSmart . "'";

        $resUS = oci_parse($connSelbetti, $querySelbetti);
        oci_execute($resUS);

        //excluir no BPM
        $loginSmart = '';
    }
    
} else {

    if ($loginSmart != $loginFormulario ) {
        //verificar se já não existe
        $queryForncedor = "SELECT SMARTSHARE_LOGIN FROM fornecedores_seminovos WHERE SMARTSHARE_LOGIN = '" . $loginFormulario  . "'";
        $resFoNov = oci_parse($connSelbetti, $queryForncedor);
        oci_execute($resFoNov);


        if (($fornecedor = oci_fetch_array($resFoNov, OCI_BOTH)) != FALSE) {
            header('Location: ../front/seminovos.php?pg='.$_GET['pg'].'&msn=8');
            exit;
        } else {
            $loginSmart = $loginFormulario ;
        }
    } else {
            $loginSmart = $loginFormulario ;
    }
}

$updateFornecedor = "UPDATE fornecedores_seminovos SET 
                        CNPJ = '" . $_POST['cnpj'] . "', 
                        RAZAO_SOCIAL = '" . $_POST['razao_social'] . "',
                        CIDADE = '" . $_POST['cidade'] . "',
                        UF = '" . $_POST['estados'] . "',
                        SMARTSHARE = '" . $_POST['utilizaSmartshare'] . "',
                        SMARTSHARE_LOGIN = '" . $loginFormulario . "',
                        EMAIL = '" . $_POST['email'] . "',
                        NOME_RESPONSAVEL = '" . strtoupper($_POST['nome_responsavel']) . "',
                        ATIVO = '" . $_POST['ativo'] . "' WHERE id_fornecedor = '" . $_GET['id_fornecedor'] . "'";

$resFoUp = oci_parse($connBpmgp, $updateFornecedor);

if (oci_execute($resFoUp)) {
    header('Location: ../front/seminovos.php?pg='.$_GET['pg'].'&msn=8');
} else {
    $e = oci_error($resFoUp);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%" . ($e['offset'] + 1) . "s", "^");
    print  "\n</pre>\n";
}



if($loginFormulario != ''){
    $updateFornecedor = "UPDATE fornecedores_seminovos SET 
    CNPJ = '" . $_POST['cnpj'] . "', 
    RAZAO_SOCIAL = '" . $_POST['razao_social'] . "',
    CIDADE = '" . $_POST['cidade'] . "',
    UF = '" . $_POST['estados'] . "',
    SMARTSHARE = '" . $_POST['utilizaSmartshare'] . "',
    SMARTSHARE_LOGIN = '" . $loginFormulario . "',
    EMAIL = '" . $_POST['email'] . "',
    NOME_RESPONSAVEL = '" . strtoupper($_POST['nome_responsavel']) . "',
    ATIVO = '" . $_POST['ativo'] . "' WHERE id_fornecedor = '" . $_GET['id_fornecedor'] . "'";

    $resFoUp = oci_parse($connBpmgp, $updateFornecedor);

    if (oci_execute($resFoUp)) {
    header('Location: ../front/seminovos.php?pg='.$_GET['pg'].'&msn=8');
    } else {
    $e = oci_error($resFoUp);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%" . ($e['offset'] + 1) . "s", "^");
    print  "\n</pre>\n";
    }

}

oci_close($connBpmgp);
oci_close($connSelbetti);