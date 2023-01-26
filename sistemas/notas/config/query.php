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
CL.id_lancarnotas, 
CL.valor_nota,
CL.emissao,
CL.vencimento,
CL.numero_fluig,
CL.nome_fornecedor fornecedor,
CL.ID_FILIAL empresa,
CS.nome status,
CS.id id_status,
CL.numero_nota
FROM
cad_lancarnotas AS CL
LEFT JOIN
cad_status CS ON (CL.status_desc = CS.id) ";

/*===================================*/

$queryFilial = "SELECT ID_EMPRESA, NOME_EMPRESA, SISTEMA FROM bpm_empresas WHERE SITUACAO = 'A'";

/*===================================*/

$queryBancos = "SELECT * FROM bancos";

/*===================================*/

$queryFornecedor = "SELECT * FROM cad_rateiofornecedor";

$querytipodespesa = "SELECT * FROM cad_periodicidade CP";

//Verificando se tem nota com centro de custo incompleto
$queryCentroDeCustoIncompleto = "SELECT centro_custo_completo from cad_rateiofornecedor WHERE centro_custo_completo = 1";
$aplicaQueryIncompleto = $connNOTAS->query($queryCentroDeCustoIncompleto);
$incompletoCentroCusto = $aplicaQueryIncompleto->fetch_assoc();

if(!empty($incompletoCentroCusto['centro_custo_completo'])){
    $mostraAlert = "style= 'display: block'";
}else{
    $mostraAlert = "style= 'display: none'";
}
