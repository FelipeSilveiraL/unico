<?php
require_once('../../../config/databases.php');

//query chamar acessos rápidos bpm_modulos
$queryAcessos = "SELECT * FROM bpm_modulos";

//query para chamar todos os usuário para cadastrar funções na tela de configurações
$queryUsers = "SELECT * FROM usuarios";


$queryFuncaoUser = "SELECT * FROM bpm_usuario_funcao ";

$queryFuncaoModulos = "SELECT 
SF.id AS id_funcao,
SF.nome AS funcao,
SM.nome AS tela,
(SELECT 
        nome
    FROM
        bpm_modulos
    WHERE
        id = SM.sub_modulo) AS modulo,
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
                        SM.sub_modulo,
                        SM.pagina
                    FROM
                        bpm_usuario_modulo SUM
                    LEFT JOIN
                        usuarios U ON (SUM.id_usuario = U.id_usuario)
                    LEFT JOIN
                        bpm_modulos SM ON (SUM.id_modulo = SM.id)"
);

//cores sistema
$querySistemaCores = "SELECT id_usuario, id_sistema, color FROM usuarios_sistema_color ";

$deletar = "SELECT NOME_EMPRESA,SISTEMA,EMPRESA_NBS,CONSORCIO,EMPRESA_APOLLO,REVENDA_APOLLO,ORGANOGRAMA_SENIOR,EMPRESA_SENIOR,FILIAL_SENIOR FROM bpm_empresas ";

$queryTabela = "SELECT * FROM bpm_empresas where ID_EMPRESA NOT IN(208,382) ORDER BY ID_EMPRESA ASC;";

$editarTabela = "SELECT * FROM bpm_empresas ";

$relatorioExcel = "SELECT * FROM bpm_empresas where ID_EMPRESA NOT IN(208,382) ";

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

$aprovNF = "SELECT 
AP.ID_APROVADOR, AP.APROVADOR_FILIAL, AP.APROVADOR_AREA, AP.APROVADOR_MARCA, AP.APROVADOR_GERENTE, AP.APROVADOR_SUPERINTENDENTE, AP.SITUACAO, AP.TIPO_REGISTRO, AP.APROVADOR_GESTOR, AP.LIMITE_AREA, AP.LIMITE_MARCA, AP.LIMITE_GERAL,AP.LIMITE_SUPERITENDENTE,
E.NOME_EMPRESA,
D.NOME_DEPARTAMENTO
FROM
bpm_nf_aprovadores AP
LEFT JOIN 
bpm_empresas E ON (AP.ID_EMPRESA = E.ID_EMPRESA)
LEFT JOIN 
bpm_nf_departamento D ON (AP.ID_DEPARTAMENTO = D.ID_DEPARTAMENTO)";

$tabelaSeminovos = "SELECT * FROM bpm_seminovos";

$queryEstados = "SELECT * FROM estados";

$contasBancarias = "SELECT * FROM bpm_contas_bancarias";

$queryCustoVeiculo = "SELECT * FROM bpm_custo_veiculo";

$queryCidade = "SELECT * FROM cidades";

$queryUsuario = "SELECT numcpf FROM dbo.v_func";

$departamentosQuery = "SELECT * FROM bpm_rh_departamento";

$vendedoresQuery = "SELECT * FROM bpm_vendedores";

$gerentesQuery = "SELECT * FROM bpm_gerentes";

$depVendasQuery = "SELECT * FROM bpm_departamento_vendas";