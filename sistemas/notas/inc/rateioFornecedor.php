<?php
session_start();

require_once('../config/query.php');

//remoção caracter
function seo_friendly_url($string){
    $string = str_replace(array('[\', \']'), '', $string);
    $string = preg_replace('/\[.*\]/U', '', $string);
    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
    $string = htmlentities($string, ENT_COMPAT, 'utf-8');
    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
    $string = str_replace('-', ' ', $string);

    return strtoupper(trim($string, '-'));
}



if(empty($_GET['idRateioFornecedor'])){//cadastro o rateio

    if(empty($_POST['dias'])){ $dias = $_POST['diasCorridos']; }else{ $dias = $_POST['dias']; }

    //crio o id rateio fornecedor
    $insertFornecedor = "INSERT INTO 
    (id_usuario,
    filial,
    fornecedor,
    cpfcnpj_fornecedor,
    tipopagamento,
    tipodespesa,
    auditoria,
    obra,
    marketing,
    observacao,
    vencimento_tipo,
    vencimento,
    telefone,
    tipo_serv) VALUES
    
    (".$_SESSION['id_usuario'].",
    '".$_POST['filial']."',
    '".$_POST['NomeFornecedor']."',
    '".$_POST['cpfCnpjFor']."',
    '".$_POST['tipoPagamento']."',
    '".$_POST['tipodespesa']."',
    '".$_POST['departamentoAuditoria']."',
    '".$_POST['notasGrupo']."',
    '".$_POST['notasMarketing']."',
    '".seo_friendly_url($_POST['observacao'])."',
    '".$_POST['vencimento']."',
    '".$dias."',
    '".$_POST['telefone']."',
    '".seo_friendly_url($_POST['tipoServico'])."')";

    echo $insertFornecedor;



    //id rateio fornecedor vinculo ao banco
    /* SELECT * FROM dbnotas.cad_rateiobanco; */

}else{//cadastro centro de custo

    //id rateio fornecedor vinculo ao centro de custo
    /* SELECT * FROM dbnotas.cad_rateiocentrocusto; */

}












