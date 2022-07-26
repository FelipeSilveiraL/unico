<?php
//-------------------------//
require_once('databases.php');

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

//-------------------------//
$queryEmpresa = "SELECT * FROM cad_empresa WHERE deletar = 0 ";

//-------------------------//
$queryDepartamento = "SELECT *  FROM cad_depto WHERE deletar = 0 ";

//-------------------------//
$queryUserSistema = "SELECT 
CSU.id_usuario,
CS.id AS id_sistema,
CS.nome AS nome_sistema,
CS.endereco AS endereco_sistema,
CS.icone AS icone_sistema,
CS.cor AS cor_sistema,
CS.deletar AS deletar_sistema
FROM
cad_sis_user CSU
LEFT JOIN cad_sistemas CS ON (CSU.id_sistema = CS.id) ";

//-------------------------//
$queryVariaveisSistema = "SELECT * FROM cad_variaveis_sistemas";


//-------------------------//
$querySistema = "SELECT * FROM cad_sistemas ";


//cores sistema
$querySistemaCores = "SELECT id_usuario, id_sistema, color FROM usuarios_sistema_color ";