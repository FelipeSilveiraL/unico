<?php
require_once('../../../config/databases.php');

//query chamar acessos rápidos Sisrev
$queryAcessos = "SELECT * FROM bpm_modulos";

//query para chamar todos os usuário para cadastrar funções na tela de configurações
$queryUsers = "SELECT * FROM usuarios";


$queryFuncaoUser = "SELECT * FROM bpm_usuario_funcao ";

$queryFuncaoModulos = "SELECT 
                            SF.id_funcao,
                            SF.nome AS funcao,
                            SM.nome AS tela,
                            (SELECT nome FROM bpm_modulos WHERE id = SM.sub_modulo) as modulo,
                            SF.descricao,
                            SF.id_modulos
                        FROM
                            bpm_funcao SF
                        LEFT JOIN
                            bpm_modulos SM ON SF.id_modulos = SM.id";

$queryModulos = "SELECT * FROM bpm_modulos";

$queryModulosUser = array(
                    '1' => "SELECT 
                        U.nome AS usuario,
                        U.id_usuario,
                        SM.nome AS nome_modulo,
                        SM.endereco,
                        SM.icone,
                        SM.id AS id_modulo,
                        SM.sub_modulo
                    FROM
                        bpm_usuario_modulo SUM
                    LEFT JOIN
                        usuarios U ON (SUM.id_usuario = U.id_usuario)
                    LEFT JOIN
                        bpm_modulos SM ON (SUM.id_modulo = SM.id)");

//cores sistema
$querySistemaCores = "SELECT id_usuario, id_sistema, color FROM usuarios_sistema_color ";

$deletar = "SELECT NOME_EMPRESA,SISTEMA,EMPRESA_NBS,CONSORCIO,EMPRESA_APOLLO,REVENDA_APOLLO,ORGANOGRAMA_SENIOR,EMPRESA_SENIOR,FILIAL_SENIOR FROM bpm_empresas ";   

$queryTabela = "SELECT * FROM bpm_empresas where ID_EMPRESA NOT IN(302,208,261) ORDER BY id ASC;";

$editarTabela = "SELECT * FROM bpm_empresas ";

$relatorioExcel = "SELECT * FROM bpm_empresas where ID_EMPRESA NOT IN(302,208,261) ";

$query_users = "SELECT * FROM bpm_usuarios_smartshare";

$aprovadoresQuery = "SELECT
a.APROVADOR_FILIAL,
a.APROVADOR_AREA,
a.APROVADOR_MARCA,
a.APROVADOR_SUPERINTENDENTE,
a.ID_EMPRESA,
a.ID_DEPARTAMENTO,
a.APROVADOR_GERENTE,
e.NOME_EMPRESA,
d.NOME_DEPARTAMENTO,
a.SITUACAO, 
a.*
FROM
bpm_rh_aprovadores as a
INNER JOIN bpm_empresas as e ON a.ID_EMPRESA = e.ID_EMPRESA
INNER JOIN bpm_rh_departamento as d ON a.ID_DEPARTAMENTO = d.ID_DEPARTAMENTO";

$aprovNF = "SELECT * FROM bpm_nf_aprovadores";

$tabelaSeminovos = "SELECT * FROM bpm_seminovos";

$queryEstados = "SELECT * FROM estados";

$contasBancarias ="SELECT * FROM bpm_contas_bancarias";
