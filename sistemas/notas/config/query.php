<?php

require_once('../../../config/databases.php'); //banco de dados

//-------------------------//
$queryUsuarios = "SELECT
U.id_usuario, 
U.nome AS nome_usuario,
U.cpf,
CE.id AS id_empresa,
CE.nome AS empresa,
CD.id AS id_depto,
CD.nome AS departamento,
U.senha,
U.usuario,
U.id_usuario,
U.email,
U.admin,
U.alterar_senha_login,
U.deletar
FROM
usuarios U
LEFT JOIN cad_empresa CE ON (U.empresa = CE.id)
LEFT JOIN cad_depto CD ON (U.depto = CD.id) ";

$queryNotas = "SELECT 
CL.valor_nota,
CL.emissao,
CL.vencimento,
CL.numero_fluig,
F.nome_fornecedor fornecedor,
CF.nome empresa,
CS.nome status,
CS.id id_status
FROM
cad_lancarnotas AS CL
LEFT JOIN
cad_fornecedor F ON (CL.cnpj = F.CPF_CNPJ)
LEFT JOIN 
cad_filial CF ON (CL.id_filial = CF.ID_FILIAL)
LEFT JOIN
cad_status CS ON (CL.status_desc = CS.id) ";

/*===================================*/

$mesAnterior = '1'; //quantidade de meses anteriores
$dataMes = " AND CL.date_create BETWEEN '".date('Y-m', strtotime('-'.$mesAnterior.' months', strtotime(date('Y-m-d'))))."-01' AND '".date('Y-m')."-31'";

$queryCountLancando = "SELECT count(CL.id_lancarnotas) as countLancando FROM cad_lancarnotas CL WHERE CL.status_desc = 1 AND CL.deletar = 0 ".$dataMes;
$resultCountLancando = $connNOTAS->query($queryCountLancando);
$countLancando = $resultCountLancando->fetch_assoc();

$queryCountLancado = "SELECT count(CL.id_lancarnotas) as countLancado FROM cad_lancarnotas CL WHERE CL.status_desc = 3 AND CL.deletar = 0 ".$dataMes;
$resultCountLancado = $connNOTAS->query($queryCountLancado);
$countLancado = $resultCountLancado->fetch_assoc();

$queryCountPendentes = "SELECT count(CL.id_lancarnotas) as countPendentes FROM cad_lancarnotas CL WHERE CL.status_desc = 2 AND CL.deletar = 0 ".$dataMes;
$resultCountPendentes = $connNOTAS->query($queryCountPendentes);
$countPendentes = $resultCountPendentes->fetch_assoc();

$queryCountErros = "SELECT COUNT(CL.id_lancarnotas) as countErros FROM cad_lancarnotas CL LEFT JOIN cad_status CS ON CL.status_desc = CS.id WHERE CS.erro = 1 AND CL.deletar = 0";
$resultCountErros = $connNOTAS->query($queryCountErros);
$countErros = $resultCountErros->fetch_assoc();

/*===================================*/

$queryFilial = "SELECT ID_EMPRESA, NOME_EMPRESA, SISTEMA FROM bpm_empresas WHERE SITUACAO = 'A'";

/*===================================*/

$queryBancos = "SELECT * FROM bancos";

/*===================================*/

$queryFornecedor = "SELECT * FROM cad_rateiofornecedor";

?>
