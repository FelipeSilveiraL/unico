<?php
session_start();

require_once('../config/query.php');

//SALVANDO NOTA PARA LANÇAMENTO

$carimabar = $_POST['carimbar'] == NULL ? 0 : 1;

$insertNota = "INSERT INTO cad_lancarnotas
(`ID_FILIAL`,
`ID_USUARIO`,
`ID_TIPODESPESA`,
`ID_TIPOPAGAMENTO`,
`CNPJ`,
`auditoria`,
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
('".$_POST['filial']."',
'".$_POST['usuarioResponsavel']."',
'".$_POST['tipodespesa']."',
'".$_POST['tipoPagamento']."',
'".$_POST['cpfCnpjFor']."',
'".$_POST['departamentoAuditoria']."',
'".$_POST['notasGrupo']."',
'".$_POST['observacao']."',
'".$_POST['numeroNota']."',
'".strtoupper($_POST['serie'])."',
'".$_POST['emissao']."',
'".$_POST['vencimento']."',
'".$_POST['valor']."',
1,
'".date('Y-m-d')."',
'".$_POST['telefone']."',
'".$carimabar."',
'".strtoupper($_POST['tipoServico'])."')";

$aplicarInsertNota = $connNOTA->query($insertNota);

//SALVANDO VALOR DA NOTA COM O RATEIO

//SALVANDO O ARQUIVO DA NOTA/BOLETO